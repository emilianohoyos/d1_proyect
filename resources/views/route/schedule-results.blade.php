@extends('layout.default')
@section('title', 'Resultados de Programación')

@section('content')
    <div class="card shadow">
        <div class="card-header text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Programación de {{ $employee->name }} - {{ $monthName }}</h4>
                <a href="{{ route('route.schedule.search') }}" class="btn btn-secondary">Nueva Consulta</a>
            </div>
        </div>
        <div class="card-body">
            @if ($schedules->isEmpty())
                <div class="alert alert-info">
                    No hay programación registrada para este empleado en el mes seleccionado.
                </div>
            @else
                @foreach ($schedules as $date => $daySchedules)
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">
                                {{ Carbon\Carbon::parse($date)->locale('es')->isoFormat('dddd, D [de] MMMM [de] YYYY') }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ruta</th>
                                            <th>Tienda</th>
                                            <th>Dirección</th>
                                            <th>Prioridad</th>
                                            <th>Estado</th>
                                            <th>Semana</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($daySchedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->routeStore->route->name }}</td>
                                                <td>{{ $schedule->routeStore->store->name }}</td>
                                                <td>{{ $schedule->routeStore->store->address }}</td>
                                                <td>{{ $schedule->routeStore->store->priority }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $schedule->visit_status === 'pendiente'
                                                            ? 'warning'
                                                            : ($schedule->visit_status === 'completada'
                                                                ? 'success'
                                                                : 'danger') }}">
                                                        {{ ucfirst($schedule->visit_status) }}
                                                    </span>
                                                </td>
                                                <td>Semana {{ $schedule->week }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
