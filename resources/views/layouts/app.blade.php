<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Bank App' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Tailwind + Vite client --}}
</head>
<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center font-sans">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-3xl font-extrabold text-center text-blue-700 mb-8 tracking-wide">
            🏦 Welcome to the Bank
        </h1>

        {{-- Main Content --}}
        <div>
            @yield('content')
        </div>
    </div>
</body>
</html>
