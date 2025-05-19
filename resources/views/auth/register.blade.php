@extends('layouts.auth')

@section('content')
    <!-- BEGIN register -->
    <div class="register">
        <!-- BEGIN register-content -->
        <div class="register-content">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1 class="text-center">Sign Up</h1>
                <p class="text-muted text-center">One Admin ID is all you need to access all the Admin services.</p>

                <div class="mb-3">
                    <label class="form-label">{{ __('Name') }} <span class="text-danger">*</span></label>
                    <input type="text" class="form-control form-control-lg fs-15px @error('name') is-invalid @enderror"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="e.g John Smith">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Email Address') }} <span class="text-danger">*</span></label>
                    <input type="email" class="form-control form-control-lg fs-15px @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="username@address.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Password') }} <span class="text-danger">*</span></label>
                    <input type="password"
                        class="form-control form-control-lg fs-15px @error('password') is-invalid @enderror" name="password"
                        required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('Confirm Password') }} <span class="text-danger">*</span></label>
                    <input type="password" class="form-control form-control-lg fs-15px" name="password_confirmation"
                        required autocomplete="new-password">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-theme btn-lg fs-15px fw-500 d-block w-100">
                        {{ __('Sign Up') }}
                    </button>
                </div>

                <div class="text-muted text-center">
                    Already have an Admin ID? <a href="{{ route('login') }}">Sign In</a>
                </div>
            </form>
        </div>
        <!-- END register-content -->
    </div>
    <!-- END register -->
@endsection
