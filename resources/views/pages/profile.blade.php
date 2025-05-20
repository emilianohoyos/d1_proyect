@extends('layouts.app')

@section('title', 'Profile')

@push('styles')
    <link href="{{ asset('assets/plugins/lity/dist/lity.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/lity/dist/lity.min.js') }}"></script>
@endpush

@section('content')
    <!-- BEGIN profile -->
    <div class="profile">
        <!-- BEGIN profile-header -->
        <div class="profile-header">
            <div class="profile-header-cover"></div>
            <div class="profile-header-content">
                <div class="profile-header-img">
                    <img src="{{ asset('assets/img/user/profile.jpg') }}" alt="">
                </div>
                <div class="profile-header-info">
                    <h4>{{ Auth::user()->name }}</h4>
                    <p>{{ Auth::user()->email }}</p>
                </div>
            </div>
        </div>
        <!-- END profile-header -->

        <!-- BEGIN profile-container -->
        <div class="profile-container">
            <!-- BEGIN profile-sidebar -->
            <div class="profile-sidebar">
                <div class="desktop-sticky-top">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Member Since</label>
                        <input type="text" class="form-control" value="{{ Auth::user()->created_at->format('F d, Y') }}"
                            readonly>
                    </div>
                </div>
            </div>
            <!-- END profile-sidebar -->

            <!-- BEGIN profile-content -->
            <div class="profile-content">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile Information</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END profile-content -->
        </div>
        <!-- END profile-container -->
    </div>
    <!-- END profile -->
@endsection
