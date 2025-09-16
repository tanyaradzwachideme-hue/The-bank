<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Bank App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="min-vh-100 d-flex">
        <div class="d-none d-lg-flex flex-column justify-content-between p-5 auth-sidebar text-white position-relative">
            <div class="position-relative z-1">
                <div class="h3 fw-bold mb-0">The Other Bank</div>
            </div>
            <div class="position-relative z-1">
                <h2 class="display-4 fw-bold mb-3">Banking, reimagined.</h2>
                <p class="fs-5 opacity-90 mb-4">Simple. Secure. Seamless.</p>
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-white bg-opacity-20 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-shield-check fs-4"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">Secure Banking</div>
                        <small class="opacity-75">Your money is safe with us</small>
                    </div>
                </div>
            </div>
            <div class="position-relative z-1">
                <div class="small opacity-75">&copy; {{ date('Y') }} The Other Bank</div>
            </div>
        </div>

        <div class="flex-fill d-flex align-items-center justify-content-center p-4">
            <div class="w-100 fade-in" style="max-width: 450px;">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>


