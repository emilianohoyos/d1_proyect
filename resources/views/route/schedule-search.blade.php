@extends('layout.default')
@section('title', 'Consultar Programación')


@push('js')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script>
        function showDeleteConfirmation(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción eliminará la programación seleccionada.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            let map = null;
            let markers = [];
            let polyline = null;
            const historyModalEl = document.getElementById('historyMapModal');

            function destroyMap() {
                if (map) {
                    markers.forEach(marker => map.removeLayer(marker));
                    markers = [];

                    if (polyline) {
                        map.removeLayer(polyline);
                        polyline = null;
                    }

                    map.remove();
                    map = null;
                }
            }

            function renderHistoryMap(points) {
                if (map) {
                    destroyMap();
                }

                map = L.map('history-map').setView([4.6097, -74.0817], 12);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors'
                }).addTo(map);

                const latlngs = [];
                points.forEach((point, index) => {
                    const lat = parseFloat((point.latitude ?? '').toString().replace(',', '.'));
                    const lng = parseFloat((point.longitude ?? '').toString().replace(',', '.'));

                    if (!Number.isNaN(lat) && !Number.isNaN(lng)) {
                        const markerColor = point.transaction_type === 'inicio'
                            ? 'green'
                            : (point.transaction_type === 'final' ? 'red' : 'blue');
                        const marker = L.circleMarker([lat, lng], {
                            radius: 7,
                            color: markerColor,
                            fillColor: markerColor,
                            fillOpacity: 0.9,
                            weight: 2,
                        }).addTo(map);
                        marker.bindPopup(`#${index + 1} — ${point.transaction_type ?? ''}<br>${point.time ?? ''}`);
                        markers.push(marker);
                        latlngs.push([lat, lng]);
                    }
                });

                if (latlngs.length > 1) {
                    polyline = L.polyline(latlngs, { color: '#0d6efd', weight: 4, opacity: 0.8 }).addTo(map);
                    map.fitBounds(polyline.getBounds(), { padding: [25, 25] });
                } else if (latlngs.length === 1) {
                    map.setView(latlngs[0], 15);
                }
            }

            async function loadHistoryMap(employeeId, date, label) {
                document.getElementById('historyMapModalLabel').textContent = `Seguimiento ${label}`;
                document.getElementById('history-meta').innerHTML = 'Cargando...';
                document.getElementById('history-map').innerHTML = '<div class="d-flex justify-content-center align-items-center h-100"><div class="spinner-border text-primary" role="status"></div></div>';

                try {
                    const response = await fetch(`/route-schedule/history-map?employee_id=${employeeId}&date=${date}`);
                    const payload = await response.json();

                    if (payload.status !== 'success') {
                        document.getElementById('history-map').innerHTML = '<div class="alert alert-warning">No se pudo cargar el recorrido.</div>';
                        return;
                    }

                    const info = payload.data;
                    document.getElementById('history-map').innerHTML = '';
                    document.getElementById('history-meta').innerHTML = `
                        <span class="badge bg-primary me-2">Empleado: ${info.employee?.name ?? '-'}</span>
                        <span class="badge bg-success me-2">Inicio: ${info.start_time ?? '-'}</span>
                        <span class="badge bg-danger">Fin: ${info.end_time ?? '-'}</span>
                    `;

                    if (!info.points || info.points.length === 0) {
                        document.getElementById('history-map').innerHTML = '<div class="alert alert-info">No hay puntos de ubicación para este empleado y fecha.</div>';
                        return;
                    }

                    renderHistoryMap(info.points);
                } catch (error) {
                    document.getElementById('history-map').innerHTML = '<div class="alert alert-danger">Error cargando el recorrido.</div>';
                }
            }

            document.querySelectorAll('.view-history-map').forEach(button => {
                button.addEventListener('click', function() {
                    const employeeId = this.getAttribute('data-employee-id');
                    const date = this.getAttribute('data-date');
                    const label = this.getAttribute('data-label');
                    loadHistoryMap(employeeId, date, label);
                });
            });

            if (historyModalEl) {
                historyModalEl.addEventListener('hidden.bs.modal', function() {
                    destroyMap();
                });
            }
        });
        </script>
@endpush

@push('css')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endpush

@section('content')
    <div class="card shadow">
        <div class="card-header text-white">
            <h4 class="mb-0">Consultar Programación de Rutas</h4>
        </div>
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('route.schedule.search') }}" method="GET">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Empleado</label>
                            <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id"
                                name="employee_id" required>
                                <option value="">Seleccione un empleado</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="month" class="form-label">Mes</label>
                            <input type="month" class="form-control @error('month') is-invalid @enderror" id="month"
                                name="month" value="{{ old('month', date('Y-m')) }}" required>
                            @error('month')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('route.index') }}" class="btn btn-secondary me-2">Regresar</a>
                    <button type="submit" class="btn btn-primary">Consultar</button>
                </div>
            </form>
        </div>
    </div>

    @if (isset($schedules) && $schedules->count())
        <div class="accordion" id="scheduleAccordion">
            <div class="card shadow mb-4">
                <div class="card-header text-white">
                    <h5 class="mb-0">Resultados para {{ $employees->find(request('employee_id'))->name }} - {{ request('month') }}</h5>
                </div>
            </div>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <form action="{{ route('route.schedule.search') }}" method="GET" class="mb-3">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{ request('employee_id') }}">
                        <input type="hidden" name="month" value="{{ request('month') }}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="selected_date" class="form-label">Filtrar por fecha</label>
                                    <input type="date" class="form-control" id="selected_date" name="selected_date" 
                                           value="{{ request('selected_date') }}" 
                                           min="{{ \Carbon\Carbon::parse(request('month'))->startOfMonth()->format('Y-m-d') }}"
                                           max="{{ \Carbon\Carbon::parse(request('month'))->endOfMonth()->format('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                    <a href="{{ route('route.schedule.search', ['employee_id' => request('employee_id'), 'month' => request('month')]) }}" 
                                         class="btn btn-secondary">Ver todos</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($schedules as $date => $details)
                <div class="card shadow mb-3">
                    <div class="card-header" id="heading{{ $loop->index }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false" 
                                        aria-controls="collapse{{ $loop->index }}">
                                    {{ date('d/m/Y', strtotime($date)) }}
                                </button>
                            </h6>
                            <button
                                type="button"
                                class="btn btn-sm btn-outline-primary view-history-map"
                                data-bs-toggle="modal"
                                data-bs-target="#historyMapModal"
                                data-employee-id="{{ request('employee_id') }}"
                                data-date="{{ $date }}"
                                data-label="{{ date('d/m/Y', strtotime($date)) }}"
                            >
                                Ver seguimiento
                            </button>
                        </div>
                    </div>
                    <div id="collapse{{ $loop->index }}" class="collapse" aria-labelledby="heading{{ $loop->index }}" 
                         data-parent="#scheduleAccordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Ruta</th>
                                            <th>Tienda</th>
                                            <th>Estado</th>
                                            <th>Hora visita</th>
                                            <th>Distancia</th>
                                            <th>Observaciones</th>
                                            <th>Mapa</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                            @php
                                                $statusColors = [
                                                    'pendiente'  => ['bg' => '#fff3cd', 'text' => '#856404'],
                                                    'completada' => ['bg' => '#d1e7dd', 'text' => '#0f5132'],
                                                    'atendida'   => ['bg' => '#d1e7dd', 'text' => '#0f5132'],
                                                ];
                                                $color = $statusColors[$detail->visit_status] ?? ['bg' => '#f8d7da', 'text' => '#842029'];
                                                $storeLat = (float) ($detail->routeStore->store->latitude ?? 0);
                                                $storeLng = (float) ($detail->routeStore->store->longitude ?? 0);
                                                $visitLat = (float) ($detail->latitude ?? 0);
                                                $visitLng = (float) ($detail->longitude ?? 0);
                                                $distanceM = null;
                                                if ($storeLat && $storeLng && $visitLat && $visitLng) {
                                                    $earthR = 6371000;
                                                    $dLat = deg2rad($visitLat - $storeLat);
                                                    $dLng = deg2rad($visitLng - $storeLng);
                                                    $a = sin($dLat/2)**2 + cos(deg2rad($storeLat)) * cos(deg2rad($visitLat)) * sin($dLng/2)**2;
                                                    $distanceM = round(2 * $earthR * asin(sqrt($a)));
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $detail->routeStore->route->name ?? '-' }}</td>
                                                <td>{{ $detail->routeStore->store->name ?? '-' }}</td>
                                                <td style="background-color: {{ $color['bg'] }}; color: {{ $color['text'] }}; font-weight: 600;">
                                                    {{ ucfirst($detail->visit_status) }}
                                                </td>
                                                <td>{{ $detail->real_visit_date ? \Carbon\Carbon::parse($detail->real_visit_date)->format('H:i:s') : '-' }}</td>
                                                <td>{{ $distanceM !== null ? $distanceM . ' m' : '-' }}</td>
                                                <td>{{ $detail->description }}</td>
                                                <td>
                                                    @if ($storeLat && $storeLng)
                                                        <button type="button"
                                                            class="btn btn-sm btn-outline-secondary btn-visit-map"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#visitMapModal"
                                                            data-store-lat="{{ $storeLat }}"
                                                            data-store-lng="{{ $storeLng }}"
                                                            data-store-name="{{ $detail->routeStore->store->name ?? '-' }}"
                                                            data-visit-lat="{{ $visitLat ?: '' }}"
                                                            data-visit-lng="{{ $visitLng ?: '' }}"
                                                        ><i class="fas fa-map-marker-alt"></i></button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('route.schedule.delete', $detail->id) }}" method="POST" class="d-inline" id="deleteForm{{ $detail->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" onclick="showDeleteConfirmation({{ $detail->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(isset($schedules))
        <div class="alert alert-info mt-4">No hay programación para los criterios seleccionados.</div>
    @endif

    <div class="modal fade" id="historyMapModal" tabindex="-1" aria-labelledby="historyMapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historyMapModalLabel">Seguimiento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="history-meta" class="mb-3"></div>
                    <div id="history-map" style="height: 500px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="visitMapModal" tabindex="-1" aria-labelledby="visitMapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="visitMapModalLabel">Ubicación de visita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2 d-flex gap-3">
                        <span><span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:#0d6efd;"></span> Tienda</span>
                        <span><span style="display:inline-block;width:12px;height:12px;border-radius:50%;background:#dc3545;"></span> Visita real</span>
                    </div>
                    <div id="visit-map" style="height: 500px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
    (function () {
        let visitMap = null;
        const visitMapModal = document.getElementById('visitMapModal');

        document.querySelectorAll('.btn-visit-map').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const storeLat = parseFloat(this.dataset.storeLat);
                const storeLng = parseFloat(this.dataset.storeLng);
                const storeName = this.dataset.storeName;
                const visitLat = parseFloat(this.dataset.visitLat);
                const visitLng = parseFloat(this.dataset.visitLng);

                document.getElementById('visitMapModalLabel').textContent = 'Ubicación: ' + storeName;

                setTimeout(function () {
                    if (visitMap) { visitMap.remove(); visitMap = null; }
                    visitMap = L.map('visit-map').setView([storeLat, storeLng], 16);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; OpenStreetMap contributors'
                    }).addTo(visitMap);

                    L.circleMarker([storeLat, storeLng], { radius: 9, color: '#0d6efd', fillColor: '#0d6efd', fillOpacity: 0.9 })
                        .addTo(visitMap)
                        .bindPopup('Tienda: ' + storeName)
                        .openPopup();

                    if (visitLat && visitLng && !isNaN(visitLat) && !isNaN(visitLng)) {
                        L.circleMarker([visitLat, visitLng], { radius: 9, color: '#dc3545', fillColor: '#dc3545', fillOpacity: 0.9 })
                            .addTo(visitMap)
                            .bindPopup('Visita real');
                        L.polyline([[storeLat, storeLng], [visitLat, visitLng]], { color: '#6c757d', dashArray: '6', weight: 2 }).addTo(visitMap);
                        visitMap.fitBounds([[storeLat, storeLng], [visitLat, visitLng]], { padding: [40, 40] });
                    }
                }, 300);
            });
        });

        if (visitMapModal) {
            visitMapModal.addEventListener('hidden.bs.modal', function () {
                if (visitMap) { visitMap.remove(); visitMap = null; }
            });
        }
    })();
</script>
@endpush
