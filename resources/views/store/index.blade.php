@extends('layout.default')
@section('title', 'Tiendas')

@push('css')
    <link href="/assets/plugins/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="/assets/plugins/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
    <link href="/assets/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet">
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
    <script src="/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="/assets/js/d1/project.js"></script>
    <script src="/assets/plugins/dist/jquery.js"></script>
    {{-- <script src="/assets/js/demo/sidebar-scrollspy.demo.js"></script> --}}
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Tiendas</h4>
            <a href="{{ route('store.create') }}" class="btn btn-primary">Nueva Tienda</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle mb-0" id="table-default">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Encargado</th>
                            <th>Teléfono 1</th>
                            <th>Teléfono 2</th>
                            <th>Email</th>
                            <th>Barrio</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stores as $store)
                            <tr>
                                <td>{{ $store->id }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->address }}</td>
                                <td>{{ $store->name_charge }}</td>
                                <td>{{ $store->phone_1 }}</td>
                                <td>{{ $store->phone_2 }}</td>
                                <td>{{ $store->email }}</td>
                                <td>{{ $store->neighborhood->name ?? '' }}</td>

                                <td>
                                    @if ($store->status)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-secondary">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('store.downloadQR', $store->id) }}"
                                        class="btn btn-sm btn-primary">Generar QR</a>
                                    <a href="{{ route('store.edit', $store->id) }}"
                                        class="btn btn-sm btn-warning">Editar</a>
                                    <form action="{{ route('store.toggle-status', $store->id) }}" method="POST"
                                        class="d-inline toggle-status-form">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $store->status ? 'btn-danger' : 'btn-success' }}">
                                            {{ $store->status ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('store.destroy', $store->id) }}" method="POST"
                                        class="d-inline delete-form"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar esta tienda?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No hay tiendas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Manejar el formulario de toggle-status
            const toggleForms = document.querySelectorAll('.toggle-status-form');
            toggleForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const button = this.querySelector('button');
                    const action = button.textContent.trim();
                    const storeName = this.closest('tr').querySelector('td:nth-child(2)')
                        .textContent;

                    Swal.fire({
                        title: `¿Estás seguro de ${action.toLowerCase()} esta tienda?`,
                        text: `La tienda "${storeName}" será ${action === 'Desactivar' ? 'desactivada' : 'activada'}.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, continuar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });

            // Manejar el formulario de eliminar
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const storeName = this.closest('tr').querySelector('td:nth-child(2)')
                        .textContent;

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: `La tienda "${storeName}" será eliminada permanentemente.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
