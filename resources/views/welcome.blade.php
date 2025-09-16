@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="d-flex align-items-center justify-content-center min-vh-100 bg-light bg-gradient">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5">
        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-5">
                
                {{-- Logo + Title --}}
                <div class="text-center mb-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 70px; height: 70px;">
                        <i class="bi bi-bank2 text-primary fs-1"></i>
                    </div>
                    <h2 class="fw-bold">Welcome Back</h2>
                    <p class="text-muted">Sign in to continue</p>
                </div>

                {{-- Alerts --}}
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @error('email')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @enderror

                {{-- Form --}}
                <form action="{{ route('login.submit') }}" method="POST" class="mt-4">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="email" 
                                class="form-control" placeholder="you@example.com"
                                required autofocus>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" 
                                class="form-control" placeholder="Enter your password"
                                required>
                        </div>
                      
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm">
                            <i class="bi bi-box-arrow-in-right me-2"></i> Sign In
                        </button>
                    </div>
                </form>

                {{-- Divider --}}
                <div class="text-center text-muted my-3">or</div>

               

                {{-- Register --}}
                <div class="text-center mt-4">
                    <p class="text-muted mb-0">
                        Don’t have an account? 
                        <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-none">Create one</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
