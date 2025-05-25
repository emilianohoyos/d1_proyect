@extends('layouts.auth')

@section('content')
    <!-- BEGIN login -->
    <div class="login">
        <!-- BEGIN login-content -->
        <div class="login-content">
            <form method="POST" action="{{ route('login') }}" id="login-form">
                @csrf
                <h1 class="text-center">Iniciar Sesión</h1>
                <div class="text-muted text-center mb-4">
                    Por tu seguridad, por favor verificar identidad.
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-3">
                    <label class="form-label">{{ __('Email Address') }}</label>
                    <input type="email" class="form-control form-control-lg fs-15px @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="username@address.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="d-flex">
                        <label class="form-label">{{ __('Password') }}</label>
                    </div>
                    <input type="password"
                        class="form-control form-control-lg fs-15px @error('password') is-invalid @enderror" name="password"
                        required autocomplete="current-password" placeholder="Enter your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label fw-500" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-theme btn-lg d-block w-100 fw-500 mb-3">
                    {{ __('Sign In') }}
                </button>
            </form>
        </div>
        <!-- END login-content -->
    </div>
    <!-- END login -->
@endsection
