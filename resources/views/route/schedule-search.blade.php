@extends('layout.default')
@section('title', 'Consultar Programación')


@push('js')
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
        </script>
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
                        <h6 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $loop->index }}" aria-expanded="false" 
                                    aria-controls="collapse{{ $loop->index }}">
                                {{ date('d/m/Y', strtotime($date)) }}
                            </button>
                        </h6>
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
                                            <th>Semana</th>
                                            <th>Descripción</th>
                                            <th>Compra</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $detail)
                                            <tr>
                                                <td>{{ $detail->routeStore->route->name ?? '-' }}</td>
                                                <td>{{ $detail->routeStore->store->name ?? '-' }}</td>
                                                <td>{{ $detail->visit_status }}</td>
                                                <td>{{ $detail->week }}</td>
                                                <td>{{ $detail->description }}</td>
                                                <td>{{ $detail->is_purchase === '1' ? 'Sí' : 'No' }}</td>
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
@endsection

@section('scripts')
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
</script>
@endsection
