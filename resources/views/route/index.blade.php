@extends('layout.default')
@section('title', 'Rutas')

@section('content')
    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow">
            <div class="card-header text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Rutas</h4>
                    <div>
                        <a href="{{ route('route.schedule.search') }}" class="btn btn-info me-2">Consultar Programación</a>
                        <a href="{{ route('route.schedule.create') }}" class="btn btn-success me-2">Programar Rutas</a>
                        <a href="{{ route('route.create') }}" class="btn btn-primary">Nueva Ruta</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($routes as $route)
                                <tr>
                                    <td>{{ $route->name }}</td>
                                    <td>
                                        <a href="{{ route('route.stores', $route->id) }}"
                                            class="btn btn-sm btn-info">Gestionar Tiendas</a>
                                        <a href="{{ route('route.edit', $route->id) }}"
                                            class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('route.destroy', $route->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta ruta?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-center">No hay rutas registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
