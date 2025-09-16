@extends('layouts.auth')

@section('content')
<div class="card shadow-lg border-0">
    <div class="card-body p-5">
        <div class="text-center mb-4">
            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                <i class="bi bi-person-plus text-primary fs-2"></i>
            </div>
            <h2 class="h4 mb-2">Create Account</h2>
            <p class="text-muted">Join The Other Bank today</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="form-control" placeholder="Enter first name" required>
                        </div>
                        @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Surname</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="surname" value="{{ old('surname') }}"
                                   class="form-control" placeholder="Enter surname" required>
                        </div>
                        @error('surname')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="form-control" placeholder="Enter email address" required>
                </div>
                @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password"
                                   class="form-control" placeholder="Create password" required>
                        </div>
                        @error('password')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password_confirmation"
                                   class="form-control" placeholder="Confirm password" required>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">ID Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                            <input type="text" name="id_number" value="{{ old('id_number') }}"
                                   class="form-control" placeholder="Enter ID number" required>
                        </div>
                        @error('id_number')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                   class="form-control" placeholder="Enter phone number" required>
                        </div>
                        @error('phone_number')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt"></i></span>
                    <textarea name="address" class="form-control" rows="2" placeholder="Enter your address" required>{{ old('address') }}</textarea>
                </div>
                @error('address')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Account Type</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-bank"></i></span>
                    <select name="account_type" class="form-select" required>
                        <option value="" {{ old('account_type') ? '' : 'selected' }}>Select account type</option>
                        <option value="Savings Account" {{ old('account_type') === 'Savings Account' ? 'selected' : '' }}>Savings Account</option>
                        <option value="Debt Account" {{ old('account_type') === 'Debt Account' ? 'selected' : '' }}>Debt Account</option>
                        <option value="Credit Account" {{ old('account_type') === 'Credit Account' ? 'selected' : '' }}>Credit Account</option>
                    </select>
                </div>
                @error('account_type')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-custom-primary">
                    <i class="bi bi-person-plus me-2"></i>Create Account
                </button>
            </div>
        </form>

        <div class="text-center">
            <p class="text-muted mb-0">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-decoration-none fw-medium">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection
