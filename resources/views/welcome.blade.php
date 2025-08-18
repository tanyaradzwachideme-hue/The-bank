@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="bg-white/80 backdrop-blur rounded-2xl shadow-xl p-8">
    <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        {{-- Login Form --}}
        @if (session('status'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif
        @error('email')
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">{{ $message }}</div>
        @enderror
        <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    required autofocus>
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" 
                    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            {{-- Submit Button --}}
            <div>
                <button type="submit" class="btn btn-primary w-full">
                    Login
                </button>
            </div>
        </form>

        {{-- Register Link --}}
        <p class="text-center text-sm text-gray-600 mt-4">
            Don’t have an account? 
            <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Register</a>
        </p>
    </div>
</div>
@endsection
