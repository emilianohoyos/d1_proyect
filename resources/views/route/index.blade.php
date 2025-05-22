@extends('layout.default')
@section('title', 'Rutas')
@push('css')
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
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
    <script src="/assets/js/d1/project.js"></script>
    {{-- <script src="/assets/js/demo/sidebar-scrollspy.demo.js"></script> --}}
@endpush
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
                    <table class="table table-bordered" id="table-default">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Tiendas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($routes as $route)
                                <tr>
                                    <td>{{ $route->route_name }}</td>
                                    <td>{{ $route->count_store }}</td>
                                    <td>
                                        <a href="{{ route('route.stores', $route->route_id) }}"
                                            class="btn btn-sm btn-info">Gestionar Tiendas</a>
                                        <a href="{{ route('route.edit', $route->route_id) }}"
                                            class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('route.destroy', $route->route_id) }}" method="POST"
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
