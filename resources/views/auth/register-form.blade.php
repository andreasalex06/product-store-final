<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="bg-light">

<div class="container min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100 shadow-sm border border-3 rounded-3 overflow-hidden bg-white" style="max-width: 960px;">

        {{-- LEFT FORM --}}
        <div class="col-12 col-md-6 p-5">

            <h3 class="fw-bold text-center mb-2">Buat Akun</h3>
            <p class="text-muted text-center mb-4">
                Daftar untuk mulai berbelanja
            </p>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                {{-- NAME --}}
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Nama lengkap"
                           required>
                </div>

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
                           placeholder="Minimal 8 karakter"
                           required>
                </div>

                {{-- CONFIRM PASSWORD --}}
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Ulangi password"
                           required>
                </div>

                {{-- BUTTON --}}
                <button type="submit" class="btn btn-warning w-100 fw-semibold mb-3">
                    Register
                </button>

                {{-- LOGIN LINK --}}
                <p class="text-center mb-0">
                    Sudah punya akun?
                    <a href="{{ route('login.form') }}" class="fw-semibold text-decoration-none">
                        Login di sini
                    </a>
                </p>

            </form>
        </div>

        {{-- RIGHT IMAGE --}}
        <div class="col-md-6 d-none d-md-block position-relative p-0">

            {{-- Background --}}
            <div class="h-100 w-100"
                 style="
                    background-image: url('{{ asset('images/register-banner.jpg') }}');
                    background-size: cover;
                    background-position: center;
                    filter: brightness(0.6);
                 ">
            </div>

            {{-- Overlay --}}
            <div class="position-absolute top-0 start-0 w-100 h-100"
                 style="background: rgba(0,0,0,0.45);"></div>

            {{-- Text --}}
            <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
                <h2 class="fw-bold mb-2">Gabung Bersama Kami</h2>
                <p class="opacity-75 mb-0">
                    Buat akun dan nikmati kemudahan belanja online
                </p>
            </div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
