<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 shadow shadow-sm border border-3 rounded-3 overflow-hidden bg-white" style="max-width: 960px;">

        {{-- LEFT IMAGE SIDE --}}
        <div class="col-md-6 d-none d-md-block position-relative p-0">

            {{-- Background Image --}}
            <div class="h-100 w-100"
                 style="
                    background-image: url('{{ asset('images/login-banner.jpg') }}');
                    background-size: cover;
                    background-position: center;
                 ">
            </div>

            {{-- Overlay --}}
            <div class="position-absolute top-0 start-0 w-100 h-100"
                 style="background: rgba(0,0,0,0.45);"></div>

            {{-- Text --}}
            <div class="position-absolute top-50 start-50 translate-middle text-white text-center ">
                <h2 class="fw-bold mb-2">Selamat Datang</h2>
                <p class="opacity-75 mb-0">
                    Masuk untuk melanjutkan ke akun kamu
                </p>
            </div>
        </div>

        {{-- RIGHT FORM --}}
        <div class="col-12 col-md-6 p-5">

            <h3 class="fw-bold text-center mb-2">Login</h3>
            <p class="text-muted text-center mb-4">
                Silakan masuk ke akun kamu
            </p>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                {{-- EMAIL --}}
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           placeholder="email@example.com"
                           required>
                </div>

                {{-- PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           placeholder="••••••••"
                           required>
                </div>

                {{-- REMEMBER --}}
                <div class="mb-3 form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-warning w-100 fw-semibold mb-3">
                    Login
                </button>

                {{-- REGISTER --}}
                <p class="text-center mb-0">
                    Belum punya akun?
                    <a href="{{ route('register.form') }}" class="fw-semibold text-decoration-none">
                        Daftar sekarang
                    </a>
                </p>

            </form>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
