@extends('layout.default')
@section('title', 'Programación de Rutas')

@section('content')
    <div class="card shadow">
        <div class="card-header text-white">
            <h4 class="mb-0">Programación de Rutas</h4>
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

            <form action="{{ route('route.schedule.store') }}" method="POST" id="scheduleForm">
                @csrf
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Fecha Inicial (dd/mm/aaaa)</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date"
                                value="{{ old('start_date', isset($model) ? $model->start_date->format('Y-m-d') : '') }}"
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
                                id="end_date" name="end_date"
                                value="{{ old('end_date', isset($model) ? $model->end_date->format('Y-m-d') : '') }}"
                                required placeholder="Seleccione fecha">
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
                                                <select class="form-select route-select week1" name="week1_routes[]"
                                                    required data-week="1" data-day="{{ $index }}">
                                                    <option value="">Seleccione una ruta</option>
                                                    @foreach ($routes as $route)
                                                        <option value="{{ $route->id }}"
                                                            {{ old('week1_routes.' . $index) == $route->id ? 'selected' : '' }}>
                                                            {{ $route->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                                                <select class="form-select route-select week2" name="week2_routes[]"
                                                    required data-week="2" data-day="{{ $index }}">
                                                    <option value="">Seleccione una ruta</option>
                                                    @foreach ($routes as $route)
                                                        <option value="{{ $route->id }}"
                                                            {{ old('week2_routes.' . $index) == $route->id ? 'selected' : '' }}>
                                                            {{ $route->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
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
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('route.index') }}" class="btn btn-secondary me-2">Regresar</a>
                    <button type="submit" class="btn btn-primary">Generar Programación</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Guardar las rutas disponibles para cada select
                const routeOptions = {};
                document.querySelectorAll('.week1, .week2').forEach((select, idx) => {
                    routeOptions[idx] = Array.from(select.options).map(opt => ({
                        value: opt.value,
                        text: opt.text
                    }));
                });

                function updateAllSelects() {
                    const selects = document.querySelectorAll('.week1, .week2');
                    // Obtener todos los valores seleccionados (excepto vacíos)
                    let selectedValues = Array.from(selects)
                        .map(s => s.value)
                        .filter(v => v !== '');

                    // Forzar que solo la primera ocurrencia de cada valor permanezca seleccionada
                    const seen = {};
                    selects.forEach((select, idx) => {
                        if (select.value && seen[select.value]) {
                            select.value = '';
                        }
                        if (select.value) {
                            seen[select.value] = true;
                        }
                    });

                    // Actualizar los valores seleccionados después de limpiar duplicados
                    selectedValues = Array.from(selects)
                        .map(s => s.value)
                        .filter(v => v !== '');

                    selects.forEach((select, idx) => {
                        // Guardar el valor actual
                        const currentValue = select.value;
                        // Limpiar opciones
                        select.innerHTML = '';
                        // Volver a agregar opciones, deshabilitando las seleccionadas en otros selects
                        routeOptions[idx].forEach(opt => {
                            const option = document.createElement('option');
                            option.value = opt.value;
                            option.text = opt.text;
                            // Deshabilitar si está seleccionada en otro select
                            if (opt.value !== '' && selectedValues.includes(opt.value) &&
                                currentValue !== opt.value) {
                                option.disabled = true;
                            }
                            // Seleccionar si es el valor actual
                            if (opt.value === currentValue) {
                                option.selected = true;
                            }
                            select.appendChild(option);
                        });
                    });
                }

                // Inicializar selects al cargar
                updateAllSelects();

                // Escuchar cambios, focus y click en selects de ambas semanas
                document.querySelectorAll('.week1, .week2').forEach(select => {
                    select.addEventListener('change', function() {
                        updateAllSelects();
                    });
                    select.addEventListener('focus', updateAllSelects);
                    select.addEventListener('click', updateAllSelects);
                });

                // Validar el formulario antes de enviar
                document.getElementById('scheduleForm').addEventListener('submit', function(e) {
                    const selects = document.querySelectorAll('.week1, .week2');
                    const values = Array.from(selects).map(select => select.value);
                    const hasDuplicates = arr => arr.filter((v, i, a) => v && a.indexOf(v) !== i).length > 0;
                    if (hasDuplicates(values)) {
                        e.preventDefault();
                        alert('No se pueden seleccionar rutas duplicadas en la programación.');
                    }
                });
            });
        </script>
    @endpush
@endsection
