@extends('layout.default')
@section('title', isset($store) ? 'Editar Tienda' : 'Nueva Tienda')

@section('content')

    <div class="card shadow">
        <div class="card-header text-white ">
            <h4 class="mb-0">{{ isset($store) ? 'Editar Tienda' : 'Nueva Tienda' }}</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($store) ? route('store.update', $store->id) : route('store.store') }}" method="POST">
                @csrf
                @if (isset($store))
                    @method('PUT')
                @endif
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $store->name ?? '') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address', $store->address ?? '') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name_charge" class="form-label">Encargado</label>
                        <input type="text" class="form-control @error('name_charge') is-invalid @enderror"
                            id="name_charge" name="name_charge" value="{{ old('name_charge', $store->name_charge ?? '') }}">
                        @error('name_charge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="neighborhood_id" class="form-label">Barrio</label>
                        <select class="form-select @error('neighborhood_id') is-invalid @enderror" id="neighborhood_id"
                            name="neighborhood_id">
                            <option value="">Seleccione...</option>
                            @foreach ($neighborhoods as $neighborhood)
                                <option value="{{ $neighborhood->id }}"
                                    {{ old('neighborhood_id', $store->neighborhood_id ?? '') == $neighborhood->id ? 'selected' : '' }}>
                                    {{ $neighborhood->name }}</option>
                            @endforeach
                        </select>
                        @error('neighborhood_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="phone_1" class="form-label">Teléfono 1</label>
                        <input type="text" class="form-control @error('phone_1') is-invalid @enderror" id="phone_1"
                            name="phone_1" value="{{ old('phone_1', $store->phone_1 ?? '') }}">
                        @error('phone_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone_2" class="form-label">Teléfono 2</label>
                        <input type="text" class="form-control @error('phone_2') is-invalid @enderror" id="phone_2"
                            name="phone_2" value="{{ old('phone_2', $store->phone_2 ?? '') }}">
                        @error('phone_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $store->email ?? '') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="priority" class="form-label">Prioridad</label>
                        <input type="number" class="form-control @error('priority') is-invalid @enderror" id="priority"
                            name="priority" value="{{ old('priority', $store->priority ?? '') }}">
                        @error('priority')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"
                        rows="2">{{ old('descripcion', $store->descripcion ?? '') }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label d-block">Estado</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                            {{ old('status', isset($store) ? $store->status : false) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Activo</label>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('store.index') }}" class="btn btn-secondary me-2">Regresar</a>
                    <button type="submit"
                        class="btn btn-primary">{{ isset($store) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
