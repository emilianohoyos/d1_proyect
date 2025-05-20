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

                <div class="col-md-6">
                    <h5>Agregar Tiendas</h5>
                    <form action="{{ route('route.add-stores', $route->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="stores" class="form-label">Seleccionar Tiendas</label>
                            <select class="form-select" id="stores" name="stores[]" multiple size="10">
                                @foreach ($availableStores as $store)
                                    <option value="{{ $store->id }}">{{ $store->name }} - {{ $store->address }}</option>
                                @endforeach
                            </select>
                            @error('stores')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('route.index') }}" class="btn btn-secondary me-2">Regresar</a>
                            <button type="submit" class="btn btn-primary">Agregar Tiendas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
