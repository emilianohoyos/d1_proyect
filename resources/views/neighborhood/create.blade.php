@extends('layout.default')
@section('title', 'Nuevo Barrio')

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
            });
        });
    </script>
@endpush
@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="mb-0">Nuevo Barrio</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('neighborhood.store') }}" method="POST">
            @csrf
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
                    <label for="name" class="form-label">Barrio</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label d-block">Estado</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" checked>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('neighborhood.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
