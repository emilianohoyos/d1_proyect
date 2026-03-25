@extends('layout.default')
@section('title', 'Tiendas')

@push('css')
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
    <link href="/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="anonymous">
    <style>
        #map-container {
            height: 400px;
            width: 100%;
        }
    </style>
@endpush

@push('js')
    <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script>
    <script src="/assets/js/demo/highlightjs.demo.js"></script>
    <script src="/assets/plugins/datatables.net/js/dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="/assets/plugins/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/assets/js/d1/project.js"></script>
    <script src="/assets/plugins/dist/jquery.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="anonymous"></script>
    {{-- <script src="/assets/js/demo/sidebar-scrollspy.demo.js"></script> --}}
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tiendas</h4>
            <a href="{{ route('store.create') }}" class="btn btn-primary">Nueva Tienda</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" id="table-default">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Encargado</th>
                            <th>Teléfono 1</th>
                            <th>Teléfono 2</th>
                            <th>Email</th>
                            <th>Barrio</th>
                            <th>Estado</th>
                            <th>Nuevo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stores as $store)
                            <tr>
                                <td>{{ $store->id }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->address }}</td>
                                <td>{{ $store->name_charge }}</td>
                                <td>{{ $store->phone_1 }}</td>
                                <td>{{ $store->phone_2 }}</td>
                                <td>{{ $store->email }}</td>
                                <td>{{ $store->neighborhood->name ?? '' }}</td>

                                <td>
                                    @if ($store->status)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($store->is_new)
                                        <span class="badge bg-info">Si</span>
                                    @else
                                        <span class="badge bg-light text-dark">No</span>
                                    @endif
                                </td>
                                <td>
                                @if($store->latitude && $store->longitude)
                                    <button type="button" class="btn btn-sm btn-info show-map-btn" 
                                        data-lat="{{ str_replace(',', '.', $store->latitude) }}" 
                                        data-lng="{{ str_replace(',', '.', $store->longitude) }}" 
                                        data-name="{{ $store->name }}" 
                                        data-address="{{ $store->address }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#mapModal">
                                        Ver mapa
                                    </button>
                                    @endif
                                    <a href="{{ route('store.edit', $store->id) }}"
                                        class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('store.toggle-status', $store->id) }}" method="POST"
                                        class="d-inline toggle-status-form">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $store->status ? 'btn-danger' : 'btn-success' }}">
                                            {{ $store->status ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('store.destroy', $store->id) }}" method="POST"
                                        class="d-inline delete-form"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta tienda?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                  
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No hay tiendas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar el mapa -->
    <div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mapModalLabel">Ubicación de la tienda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="map-container"></div>
                    <div class="mt-2">
                        <p><strong>Nombre:</strong> <span id="store-name"></span></p>
                        <p><strong>Dirección:</strong> <span id="store-address"></span></p>
                        <p><strong>Coordenadas:</strong> <span id="store-coordinates"></span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mapa de Leaflet
            let map;
            let marker;
            
            // Inicializar el mapa cuando se abre el modal
            $('#mapModal').on('shown.bs.modal', function (e) {
                // Si el mapa ya está inicializado, destruirlo
                if (map) {
                    map.remove();
                    map = null;
                }
                
                // Obtener datos del botón que abrió el modal
                const button = e.relatedTarget;
                const lat = parseFloat(button.getAttribute('data-lat'));
                const lng = parseFloat(button.getAttribute('data-lng'));
                const name = button.getAttribute('data-name');
                const address = button.getAttribute('data-address');
                
                // Actualizar información en el modal
                document.getElementById('store-name').textContent = name;
                document.getElementById('store-address').textContent = address;
                document.getElementById('store-coordinates').textContent = `${lat}, ${lng}`;
                
                // Inicializar el mapa
                map = L.map('map-container').setView([lat, lng], 15);
                
                // Añadir capa de OpenStreetMap (gratuito)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                // Añadir marcador
                marker = L.marker([lat, lng]).addTo(map);
                marker.bindPopup(`<b>${name}</b><br>${address}`).openPopup();
                
                // Actualizar el tamaño del mapa después de que se muestre el modal
                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            });
            
            // Limpiar el mapa cuando se cierra el modal
            $('#mapModal').on('hidden.bs.modal', function () {
                if (map) {
                    map.remove();
                    map = null;
                }
            });
            // Manejar el formulario de toggle-status
            const toggleForms = document.querySelectorAll('.toggle-status-form');
            toggleForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const button = this.querySelector('button');
                    const action = button.textContent.trim();
                    const storeName = this.closest('tr').querySelector('td:nth-child(2)')
                        .textContent;

                    Swal.fire({
                        title: `¿Estás seguro de ${action.toLowerCase()} esta tienda?`,
                        text: `La tienda "${storeName}" será ${action === 'Desactivar' ? 'desactivada' : 'activada'}.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, continuar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });

            // Manejar el formulario de eliminar
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const storeName = this.closest('tr').querySelector('td:nth-child(2)')
                        .textContent;

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: `La tienda "${storeName}" será eliminada permanentemente.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
    
    <!-- Bootstrap JS para los modales -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
