<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bank App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="min-h-screen grid lg:grid-cols-2">
        <div class="hidden lg:flex flex-col justify-between p-10 bg-gradient-to-br from-indigo-600 via-blue-600 to-cyan-500 text-white">
            <div class="text-2xl font-bold tracking-tight">The Other Bank</div>
            <div>
                <h2 class="text-4xl font-extrabold leading-tight">Banking, reimagined.</h2>
                <p class="mt-4 text-blue-100 text-lg">Simple. Secure. Seamless.</p>
            </div>
            <div class="text-sm text-blue-100">&copy; {{ date('Y') }} The Other Bank</div>
        </div>

        <div class="flex items-center justify-center p-6 sm:p-10">
            <div class="w-full max-w-md">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>


