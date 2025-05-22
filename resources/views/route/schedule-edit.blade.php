@extends('layout.default')
@section('title', 'Editar Programación de Rutas')

@section('content')
    <div class="card shadow">
        <div class="card-header text-white">
            <h4 class="mb-0">Editar Programación de Rutas</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @php
                // Crear un array de rutas con sus tiendas para usar en JS
                $routesWithStores = $routes->mapWithKeys(function ($route) {
                    return [$route->id => $route->stores->pluck('name')->toArray()];
                });
            @endphp

            <script>
                // Pasar el array de rutas y tiendas a JS
                window.routesWithStores = @json($routesWithStores);
            </script>

            <form action="{{ route('route.schedule.update', $schedule->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha Inicial (dd/mm/aaaa)</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date" value="{{ old('start_date', $schedule->visit_date) }}"
                                required placeholder="Seleccione fecha">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">Fecha Final (dd/mm/aaaa)</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date" value="{{ old('end_date', $schedule->visit_date) }}" required
                                placeholder="Seleccione fecha">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5>Semana 1</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Ruta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $week1Days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                                    @endphp
                                    @foreach ($week1Days as $index => $day)
                                        <tr>
                                            <td>{{ $day }}</td>
                                            <td>
                                                <select class="form-select route-select" name="week1_routes[]"
                                                    data-day="week1-{{ $index }}" required>
                                                    <option value="">Seleccione una ruta</option>
                                                    @foreach ($routes as $route)
                                                        <option value="{{ $route->id }}"
                                                            {{ old('week1_routes.' . $index, $week1Routes[$index] ?? '') == $route->id ? 'selected' : '' }}>
                                                            {{ $route->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <ul class="store-list" id="stores-week1-{{ $index }}"></ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5>Semana 2</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Día</th>
                                        <th>Ruta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $week2Days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                                    @endphp
                                    @foreach ($week2Days as $index => $day)
                                        <tr>
                                            <td>{{ $day }}</td>
                                            <td>
                                                <select class="form-select route-select" name="week2_routes[]"
                                                    data-day="week2-{{ $index }}" required>
                                                    <option value="">Seleccione una ruta</option>
                                                    @foreach ($routes as $route)
                                                        <option value="{{ $route->id }}"
                                                            {{ old('week2_routes.' . $index, $week2Routes[$index] ?? '') == $route->id ? 'selected' : '' }}>
                                                            {{ $route->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <ul class="store-list" id="stores-week2-{{ $index }}"></ul>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">Empleado</label>
                            <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id"
                                name="employee_id" required>
                                <option value="">Seleccione un empleado</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id', $schedule->employees_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('route.index') }}" class="btn btn-secondary me-2">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Programación</button>
                </div>
            </form>
        </div>
    </div>

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Función para actualizar la lista de tiendas
                function updateStoreList(select) {
                    const dayKey = select.getAttribute('data-day');
                    const routeId = select.value;
                    const storeList = document.getElementById('stores-' + dayKey);
                    storeList.innerHTML = '';
                    if (routeId && window.routesWithStores[routeId]) {
                        window.routesWithStores[routeId].forEach(function(store) {
                            const li = document.createElement('li');
                            li.textContent = store;
                            storeList.appendChild(li);
                        });
                    }
                }
                // Inicializar listas al cargar
                document.querySelectorAll('.route-select').forEach(function(select) {
                    updateStoreList(select);
                    select.addEventListener('change', function() {
                        updateStoreList(this);
                    });
                });
            });
        </script>
    @endpush
@endsection
