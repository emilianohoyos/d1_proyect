@extends('layout.default')
@section('title', 'Resultados de Búsqueda de Programación')

@section('content')
    <div class="card shadow">
        <div class="card-header text-white">
            <h4 class="mb-0">Programación de {{ $employee->name }} - {{ $monthName }}</h4>
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

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Día</th>
                            <th>Semana</th>
                            <th>Ruta</th>
                            <th>Tiendas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($schedules as $date => $daySchedules)
                            @php
                                $firstSchedule = $daySchedules->first();
                                $routes = $daySchedules->groupBy('routeStore.route.name');
                            @endphp
                            @foreach ($routes as $routeName => $routeSchedules)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</td>
                                    <td>{{ $firstSchedule->day_week }}</td>
                                    <td>{{ $firstSchedule->week }}</td>
                                    <td><strong>{{ $routeName }}</strong></td>
                                    <td>
                                        <ul class="mb-0">
                                            @foreach ($routeSchedules as $schedule)
                                                <li>{{ $schedule->routeStore->store->name }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        <a href="{{ route('route.schedule.edit', $firstSchedule->id) }}"
                                            class="btn btn-sm btn-primary">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('route.schedule.search') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </div>
    </div>
@endsection
