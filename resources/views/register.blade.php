@extends('layouts.auth')

@section('content')
<div class="bg-white/80 backdrop-blur rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-center mb-6">Create Account</h2>

    @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium">First Name</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Surname</label>
            <input type="text" name="surname" value="{{ old('surname') }}"
                   class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            @error('surname')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Password</label>
            <input type="password" name="password"
                   class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            @error('password')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Confirm Password</label>
            <input type="password" name="password_confirmation"
                   class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">ID Number</label>
            <input type="text" name="id_number" value="{{ old('id_number') }}"
                   class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            @error('id_number')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                   class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
            @error('phone_number')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Address</label>
            <textarea name="address"
                      class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>{{ old('address') }}</textarea>
            @error('address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Account Type</label>
            <select name="account_type"
                    class="w-full p-2 border rounded-lg focus:ring focus:ring-blue-300" required>
                <option value="" {{ old('account_type') ? '' : 'selected' }}>-- Select --</option>
                <option value="Savings Account" {{ old('account_type') === 'Savings Account' ? 'selected' : '' }}>Savings Account</option>
                <option value="Debt Account" {{ old('account_type') === 'Debt Account' ? 'selected' : '' }}>Debt Account</option>
                <option value="Credit Account" {{ old('account_type') === 'Credit Account' ? 'selected' : '' }}>Credit Account</option>
            </select>
            @error('account_type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <button type="submit" class="btn btn-primary w-full">
            Register
        </button>
    </form>
</div>
@endsection
