@extends('layout.default')
@section('title', 'Editar Barrio')

@push('js')
<script>
    $(document).ready(function() {
        const departmentSelect = $('#department_id');
        const municipalitySelect = $('#municipality_id');
        // This will be the ID of the municipality to pre-select, from old input or the model's current value
        const targetMunicipalityId = "{{ old('municipality_id', $neighborhood->municipality_id) }}";

        function loadMunicipalities(departmentId, selectedMunicipalityId) {
            municipalitySelect.empty().append('<option value=\"\">Cargando...</option>');
            if (!departmentId) { // No department selected or empty value
                municipalitySelect.empty().append('<option value=\"\">Seleccione un departamento primero</option>').prop('disabled', true);
                return;
            }

            municipalitySelect.prop('disabled', true); // Disable while loading

            $.get(`/municipalities/${departmentId}`, function(data) {
                municipalitySelect.empty().append('<option value=\"\">Seleccione un municipio</option>');
                if (data.length > 0) {
                    municipalitySelect.prop('disabled', false);
                    $.each(data, function(key, municipality) {
                        let option = $('<option></option>').attr('value', municipality.id).text(municipality.name);
                        if (municipality.id == selectedMunicipalityId) {
                            option.prop('selected', true);
                        }
                        municipalitySelect.append(option);
                    });
                } else {
                    municipalitySelect.append('<option value=\"\">No hay municipios para este departamento</option>').prop('disabled', true);
                }
            }).fail(function() {
                municipalitySelect.empty().append('<option value=\"\">Error al cargar municipios</option>').prop('disabled', true);
            });
        }

        // Initial load for municipalities:
        // The department dropdown is already correctly selected by Blade's 'selected' attribute based on old input or model data.
        // We get its current value and load/pre-select municipalities accordingly.
        let currentDepartmentId = departmentSelect.val();
        if (currentDepartmentId) {
            loadMunicipalities(currentDepartmentId, targetMunicipalityId);
        } else {
            // No department initially selected (e.g. new record, or department was null, or 'Seleccione...' is chosen)
            municipalitySelect.empty().append('<option value=\"\">Seleccione un departamento primero</option>').prop('disabled', true);
        }

        // On department change:
        departmentSelect.change(function() {
            let newDepartmentId = $(this).val();
            // When department changes, we don't pre-select a specific municipality automatically;
            // the user will need to choose one from the newly loaded list.
            loadMunicipalities(newDepartmentId, null);
        });
    });
</script>
@endpush

@section('content')
<div class="card shadow">
    <div class="card-header">
        <h4 class="mb-0">Editar Barrio</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('neighborhood.update', $neighborhood) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="department_id" class="form-label">Departamento</label>
                    <select class="form-select @error('department_id') is-invalid @enderror" id="department_id" name="department_id">
                        <option value="">Seleccione un departamento</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->department_id }}"
                                    {{ (old('department_id', $neighborhood->municipality->department_id ?? '') == $department->department_id) ? 'selected' : '' }}>
                                {{ $department->department_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="municipality_id" class="form-label">Municipio</label>
                    <select class="form-select @error('municipality_id') is-invalid @enderror" id="municipality_id" name="municipality_id" {{ old('department_id', $neighborhood->municipality ? $neighborhood->municipality->department_id : '') ? '' : 'disabled' }}>
                        <option value="">Seleccione un municipio</option>
                        {{-- Options will be populated by JavaScript --}}
                    </select>
                    @error('municipality_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4">
                    <label for="name" class="form-label">Nombre del Barrio</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $neighborhood->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="status" class="form-label d-block">Estado</label>
                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{ old('status', $neighborhood->status) ? 'checked' : '' }}>
                        <label class="form-check-label" for="status">Activo</label>
                    </div>
                    @error('status')
                        <div class="invalid-feedback d-block">{{ $message }}</div> {{-- Ensure this shows if error exists --}}
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Actualizar Barrio</button>
                    <a href="{{ route('neighborhood.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection