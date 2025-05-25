@extends('layout.default')
@section('title', 'Programación del día ' . $date)

@section('content')
    <div class="card shadow">
        <div class="card-header text-white">
            <h4 class="mb-0">Programación del día {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }}</h4>
        </div>
        <div class="card-body">
            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-3">Regresar</a>
            @if ($schedules->count())
                <h5>Empleado: {{ $schedules->first()->employee->name ?? '-' }}</h5>
                <h6>Ruta: {{ $schedules->first()->routeStore->route->name ?? '-' }}</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tienda</th>
                                <th>Estado</th>
                                <th>Semana</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schedules as $detail)
                                <tr>
                                    <td>{{ $detail->routeStore->store->name ?? '-' }}</td>
                                    <td>{{ $detail->visit_status }}</td>
                                    <td>{{ $detail->week }}</td>
                                    <td>{{ $detail->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">No hay programación para este día</div>
            @endif
        </div>
    </div>
@endsection
