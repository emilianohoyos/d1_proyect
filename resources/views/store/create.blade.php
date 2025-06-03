@extends('layout.default')
@section('title', isset($store) ? 'Editar Tienda' : 'Nueva Tienda')

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Cuando cambia el departamento
            $('#department_id').change(function() {
                let departmentId = $(this).val();
                $('#municipality_id').empty().append('<option value="">Seleccione un municipio</option>')
                    .prop('disabled', true);
                $('#neighborhood_id').empty().append('<option value="">Seleccione un barrio</option>').prop(
                    'disabled', true);
                alert(departmentId);
                if (departmentId) {
                    $.get(`/municipalities/${departmentId}`, function(data) {
                        if (data.length > 0) {
                            $('#municipality_id').prop('disabled', false);
                            $.each(data, function(key, municipality) {
                                $('#municipality_id').append(
                                    `<option value="${municipality.id}">${municipality.name}</option>`
                                );
                            });
                        }
                    });
                }
            });

            // Cuando cambia el municipio
            $('#municipality_id').change(function() {
                let municipalityId = $(this).val();
                $('#neighborhood_id').empty().append('<option value="">Seleccione un barrio</option>').prop(
                    'disabled', true);

                if (municipalityId) {
                    $.get(`/neighborhoods/${municipalityId}`, function(data) {
                        if (data.length > 0) {
                            $('#neighborhood_id').prop('disabled', false);
                            $.each(data, function(key, neighborhood) {
                                $('#neighborhood_id').append(
                                    `<option value="${neighborhood.id}">${neighborhood.name}</option>`
                                );
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush

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
                        <label for="name_charge" class="form-label">Encargado</label>
                        <input type="text" class="form-control @error('name_charge') is-invalid @enderror"
                            id="name_charge" name="name_charge" value="{{ old('name_charge', $store->name_charge ?? '') }}">
                        @error('name_charge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="department_id" class="form-label">Departamento</label>
                        <select class="form-control" id="department_id" name="department_id">
                            <option value="">Seleccione un departamento</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                        @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="municipality_id" class="form-label">Municipio</label>
                        <select class="form-control" id="municipality_id" name="municipality_id" disabled>
                            <option value="">Seleccione un municipio</option>
                        </select>
                        @error('municipality_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="neighborhood_id" class="form-label">Barrio</label>
                        <select class="form-control" id="neighborhood_id" name="neighborhood_id" disabled>
                            <option value="">Seleccione un barrio</option>
                        </select>

                        @error('neighborhood_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
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
                        <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority">
                            <option value="">Seleccione...</option>
                            <option value="1" {{ old('priority', $store->priority ?? '') == 1 ? 'selected' : '' }}>
                                Alto</option>
                            <option value="2" {{ old('priority', $store->priority ?? '') == 2 ? 'selected' : '' }}>
                                Medio</option>
                            <option value="3" {{ old('priority', $store->priority ?? '') == 3 ? 'selected' : '' }}>
                                Bajo</option>
                        </select>
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
                            checked {{ old('status', isset($store) ? $store->status : false) ? 'checked' : '' }}>
                        {{-- <label class="form-check-label" for="status">Activo</label> --}}
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
