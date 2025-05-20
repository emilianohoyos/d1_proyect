@extends('layout.default')
@section('title', isset($route) ? 'Editar Ruta' : 'Nueva Ruta')

@section('content')

    <div class="card shadow">
        <div class="card-header text-white ">
            <h4 class="mb-0">{{ isset($route) ? 'Editar Ruta' : 'Nueva Ruta' }}</h4>
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

            <form action="{{ isset($route) ? route('route.update', $route->id) : route('route.store') }}" method="POST">
                @csrf
                @if (isset($route))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        name="name" value="{{ old('name', $route->name ?? '') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('route.index') }}" class="btn btn-secondary me-2">Regresar</a>
                    <button type="submit" class="btn btn-primary">{{ isset($route) ? 'Actualizar' : 'Guardar' }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
