@extends('layout.default')
@section('title', 'Gestionar Tiendas de la Ruta')

@section('content')
    <div class="card shadow">
        <div class="card-header text-white">
            <h4 class="mb-0">Gestionar Tiendas de la Ruta: {{ $route->name }}</h4>
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

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Agregar Tiendas</h5>
                    <form action="{{ route('route.add-stores', $route->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="neighborhood" class="form-label">Filtrar por Barrio</label>
                            <select class="form-select" id="neighborhood" onchange="filterStoresByNeighborhood()">
                                <option value="">Todos los barrios</option>
                                @foreach ($neighborhoods as $neighborhood)
                                    <option value="{{ $neighborhood->id }}">{{ $neighborhood->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="stores" class="form-label">Seleccionar Tiendas</label>
                            <select class="form-select" id="stores" name="stores[]" multiple size="10">
                                @foreach ($availableStores as $store)
                                    <option value="{{ $store->id }}" data-neighborhood="{{ $store->neighborhood_id }}">
                                        {{ $store->name }} - {{ $store->address }}
                                    </option>
                                @endforeach
                            </select>
                            @error('stores')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-info me-2" onclick="selectAllStores()">Seleccionar
                                    Todas</button>
                                <button type="button" class="btn btn-info" id="addNeighborhoodBtn"
                                    onclick="selectNeighborhoodStores()" style="display: none;">Agregar Barrio</button>
                            </div>
                            <div>
                                <a href="{{ route('route.index') }}" class="btn btn-secondary me-2">Regresar</a>
                                <button type="submit" class="btn btn-primary">Agregar Tiendas</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <h5>Tiendas Asignadas</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($route->stores as $store)
                                    <tr>
                                        <td>{{ $store->name }}</td>
                                        <td>{{ $store->address }}</td>
                                        <td>
                                            <form
                                                action="{{ route('route.remove-store', ['route' => $route->id, 'store' => $store->id]) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('¿Estás seguro de quitar esta tienda de la ruta?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Quitar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No hay tiendas asignadas a esta ruta</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterStoresByNeighborhood() {
            const neighborhoodId = document.getElementById('neighborhood').value;
            const storeOptions = document.getElementById('stores').options;
            const addNeighborhoodBtn = document.getElementById('addNeighborhoodBtn');

            // Mostrar/ocultar el botón de Agregar Barrio
            addNeighborhoodBtn.style.display = neighborhoodId ? 'inline-block' : 'none';

            for (let option of storeOptions) {
                const storeNeighborhoodId = option.getAttribute('data-neighborhood');
                if (!neighborhoodId || storeNeighborhoodId === neighborhoodId) {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            }
        }

        function selectAllStores() {
            const storeSelect = document.getElementById('stores');
            const neighborhoodId = document.getElementById('neighborhood').value;

            for (let option of storeSelect.options) {
                const storeNeighborhoodId = option.getAttribute('data-neighborhood');
                if (!neighborhoodId || storeNeighborhoodId === neighborhoodId) {
                    option.selected = true;
                }
            }
        }

        function selectNeighborhoodStores() {
            const neighborhoodId = document.getElementById('neighborhood').value;
            if (!neighborhoodId) {
                alert('Por favor seleccione un barrio primero');
                return;
            }

            const storeSelect = document.getElementById('stores');
            for (let option of storeSelect.options) {
                const storeNeighborhoodId = option.getAttribute('data-neighborhood');
                if (storeNeighborhoodId === neighborhoodId) {
                    option.selected = true;
                }
            }
        }

        // Asegurarse de que el filtro se aplique al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            filterStoresByNeighborhood();
        });
    </script>
@endsection
