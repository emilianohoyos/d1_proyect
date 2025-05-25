@extends('layout.default')
@section('title', 'Consultar Programación')

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
        <div class="card shadow mt-4">
            <div class="card-header text-white">
                <h5 class="mb-0">Resultados para {{ $employee->name }} - {{ $monthName }}</h5>
            </div>
            <div class="card-body">
                @foreach ($schedules as $date => $details)
                    <div class="mb-3">
                        <h6 class="mb-1">{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Ruta</th>
                                        <th>Tienda</th>
                                        <th>Estado</th>
                                        <th>Semana</th>
                                        <th>Descripción</th>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif(isset($schedules))
        <div class="alert alert-info mt-4">No hay programación para los criterios seleccionados.</div>
    @endif
@endsection
