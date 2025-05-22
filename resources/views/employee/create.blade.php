@extends('layout.default')

@section('title', 'Dashboard')

@push('js')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')


    <div class="card shadow">
        <div class="card-header  text-white">
            <h4 class="mb-0">Crear Empleado</h4>
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

            <form action="{{ route('employee.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="document_type_id" class="form-label">Tipo de Documento</label>
                        <select class="form-select @error('document_type_id') is-invalid @enderror" id="document_type_id"
                            name="document_type_id">
                            <option value="">Seleccione...</option>
                            @foreach ($documentTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('document_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}</option>
                            @endforeach
                        </select>
                        @error('document_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="identification" class="form-label">Identificación</label>
                        <input type="text" class="form-control @error('identification') is-invalid @enderror"
                            id="identification" name="identification" value="{{ old('identification') }}">
                        @error('identification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="user_type_id" class="form-label">Tipo de usuario</label>
                        <select class="form-select @error('user_type_id') is-invalid @enderror" id="user_type_id"
                            name="user_type_id">
                            <option value="">Seleccione...</option>
                            <option value="USUARIO" {{ old('user_type_id') == 'USUARIO' ? 'selected' : '' }}>USUARIO
                            </option>
                            <option value="ADMINISTRADOR" {{ old('user_type_id') == 'ADMINISTRADOR' ? 'selected' : '' }}>
                                ADMINISTRADOR</option>
                        </select>
                        @error('user_type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cellphone" class="form-label">Celular</label>
                        <input type="text" class="form-control @error('cellphone') is-invalid @enderror" id="cellphone"
                            name="cellphone" value="{{ old('cellphone') }}">
                        @error('cellphone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address') }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">

                    <div class="col-md-6">
                        <label for="status" class="form-label d-block">Estado</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                {{ old('status') ? 'checked' : '' }}>

                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="mb-3">Datos de Usuario</h5>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="user_name" class="form-label">Usuario</label>
                        <input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name"
                            name="user_name" value="{{ old('user_name') }}">
                        @error('user_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('user_email') is-invalid @enderror" id="user_email"
                            name="user_email" value="{{ old('user_email') }}">
                        @error('user_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="user_password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control @error('user_password') is-invalid @enderror"
                            id="user_password" name="user_password">
                        @error('user_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="user_password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="user_password_confirmation"
                            name="user_password_confirmation">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary me-2">Guardar</button>
                    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>


@endsection
