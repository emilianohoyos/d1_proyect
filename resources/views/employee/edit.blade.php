@extends('layout.default')

@section('title', 'Dashboard')

@push('js')
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/js/demo/dashboard.demo.js"></script>
@endpush

@section('content')


    <div class="card shadow">
        <div class="card-header text-white">
            <h4 class="mb-0">Editar Empleado</h4>
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

            <form action="{{ route('employee.update', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="document_type_id" class="form-label">Tipo de Documento</label>
                        <select class="form-select @error('document_type_id') is-invalid @enderror" id="document_type_id"
                            name="document_type_id">
                            <option value="">Seleccione...</option>
                            @foreach ($documentTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ old('document_type_id', $employee->document_type_id) == $type->id ? 'selected' : '' }}>
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
                            id="identification" name="identification"
                            value="{{ old('identification', $employee->identification) }}">
                        @error('identification')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $employee->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cellphone" class="form-label">Celular</label>
                        <input type="text" class="form-control @error('cellphone') is-invalid @enderror" id="cellphone"
                            name="cellphone" value="{{ old('cellphone', $employee->cellphone) }}">
                        @error('cellphone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="address" class="form-label">Dirección</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" value="{{ old('address', $employee->address) }}">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="status" class="form-label d-block">Estado</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="status" name="status" value="1"
                                {{ old('status', $employee->status) ? 'checked' : '' }}>
                            
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('employee.index') }}" class="btn btn-secondary me-2">Regresar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>


@endsection
