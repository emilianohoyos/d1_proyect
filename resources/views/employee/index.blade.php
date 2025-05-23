@extends('layout.default')

@section('title', 'Dashboard')

@push('css')
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
@endpush

@push('js')
    {{-- <script src="/assets/plugins/@highlightjs/cdn-assets/highlight.min.js"></script> --}}
    {{-- <script src="/assets/js/demo/highlightjs.demo.js"></script> --}}
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


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Empleados</h4>
            <a href="{{ route('employee.create') }}" class="btn btn-primary">Nuevo Empleado</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" id="table-default">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tipo Doc</th>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Celular</th>
                            <th>Dirección</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>{{ $employee->id }}</td>
                                <td>{{ $employee->documentType->name ?? '' }}</td>
                                <td>{{ $employee->identification }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->cellphone }}</td>
                                <td>{{ $employee->address }}</td>
                                <td>{{ $employee->user->name ?? '' }}</td>
                                <td>{{ $employee->user->email ?? '' }}</td>
                                <td>
                                    @if ($employee->status)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('employee.edit', $employee->id) }}"
                                        class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('employee.destroy', $employee->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este empleado?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">No hay empleados registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
