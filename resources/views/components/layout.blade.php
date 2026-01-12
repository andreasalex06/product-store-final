<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $title ?? 'Parna Jaya' }} </title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    {{-- SWIPER CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- CUSTOM CSS --}}
    @stack('styles')

    <style>
        /* CSS KHUSUS UNTUK DROPDOWN AGAR PROPER & RESPONSIVE */

        /* 1. Tampilan Desktop: Floating Card */
        @media (min-width: 992px) {
            .user-dropdown-menu {
                width: 220px;
                margin-top: 10px; /* Jarak dari navbar */
                animation: fadeIn 0.2s ease-in-out;
            }
            /* Efek hover item dropdown */
            .dropdown-item:hover, .dropdown-item:focus {
                background-color: #fff3cd; /* Kuning muda (warning-subtle) */
                color: #000;
                border-radius: 8px; /* Tumpul */
            }
        }

        /* 2. Tampilan Mobile: Flat & Indented */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #fff;
                padding-bottom: 1rem;
            }
            .user-dropdown-menu {
                border: none;
                box-shadow: none !important;
                background-color: #f8f9fa; /* Abu-abu muda agar beda dengan background utama */
                margin-left: 1rem; /* Menjorok ke dalam */
                margin-right: 1rem;
                border-radius: 12px;
            }
        }

        /* 3. Animasi Halus */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* 4. User Toggle Style */
        .user-toggle {
            transition: background-color 0.3s;
        }
        .user-toggle:hover {
            background-color: rgba(0,0,0,0.05); /* Abu sangat muda saat hover */
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- NAVIGASI --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container-fluid px-4">

            {{-- 1. BRAND / LOGO --}}
            <a class="navbar-brand fw-bold text-warning fs-4" href="{{ route('home') }}">
                Parna Jaya
            </a>

            {{-- 2. TOMBOL TOGGLER --}}
            <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- 3. CONTENT --}}
            <div class="collapse navbar-collapse mt-3 mt-lg-0" id="navbarNav">

                {{-- A. MENU KIRI --}}
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-semibold">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active text-warning bg-dark rounded-3 px-3' : '' }}" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.index') ? 'active text-warning bg-dark rounded-3 px-3' : '' }}" href="{{ route('products.index') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('faq') ? 'active text-warning bg-dark rounded-3 px-3' : '' }}" href="{{ route('faq') }}">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('discussions.index') ? 'active text-warning bg-dark rounded-3 px-3' : '' }}" href="{{ route('discussions.index') }}">Diskusi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active text-warning bg-dark rounded-3 px-3' : '' }}" href="{{ route('blogs.index') }}">Blog</a>
                    </li>
                </ul>

                {{-- B. MENU KANAN --}}
                <ul class="navbar-nav ms-auto align-items-lg-center gap-2 gap-lg-3">

                    @auth
                        {{-- 1. Poin User (Tampil di navbar langsung) --}}
                        <li class="nav-item">
                            <a href="{{ route('loyalty.index') }}" class="text-decoration-none d-inline-block w-100">
                                <div class="bg-warning bg-opacity-10 border border-warning border-opacity-25 px-3 py-2 py-lg-1 rounded-pill d-flex align-items-center justify-content-center shadow-sm">
                                    <i class="fas fa-coins text-warning me-2"></i>
                                    <span class="fw-bold text-dark small">
                                        {{ number_format(Auth::user()->points, 0, ',', '.') }} Poin
                                    </span>
                                </div>
                            </a>
                        </li>

                        {{-- 2. Icon Keranjang & Pesanan --}}
                        <li class="nav-item d-flex gap-3 my-2 my-lg-0 justify-content-center justify-content-lg-start">
                            <a class="nav-link position-relative {{ request()->routeIs('cart.index') ? 'active text-warning bg-dark rounded-3 px-3' : '' }}"
                                href="{{ route('cart.index') }}" title="Keranjang">
                                <i class="fa-solid fa-basket-shopping fa-lg"></i>
                                <span class="ms-2 fw-semibold">Keranjang</span>
                            </a>
                            <a class="nav-link {{ request()->routeIs('orders.index') ? 'active text-warning bg-dark rounded-3 px-3' : '' }}"
                                href="{{ route('orders.index') }}" title="Pesanan Saya">
                                <i class="fa-solid fa-box fa-lg"></i>
                                <span class="ms-2 fw-semibold">Pesanan</span>
                            </a>
                        </li>

                        {{-- 3. DROPDOWN USER (RESPONSIVE) --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle user-toggle d-flex align-items-center gap-2 px-2 py-1 rounded-pill border border-transparent"
                               href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://ui-avatars.com/api/?name={{ substr(Auth::user()->name, 0, 1) }}&background=ffdd57&color=000000&size=64&rounded=true"
                                    alt="Avatar" class="rounded-circle shadow-sm" width="32" height="32">
                                <span class="fw-bold small d-none d-lg-block text-dark">{{ Auth::user()->name }}</span>
                                <span class="fw-bold small d-lg-none text-dark">Menu Akun</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2 user-dropdown-menu">
                                {{-- Header Mobile (Optional) --}}
                                <li class="d-lg-none px-3 py-2 text-muted small fw-bold text-uppercase">
                                    Halo, {{ Auth::user()->name }}
                                </li>

                                <li>
                                    <a class="dropdown-item py-2" href="{{ route('profile') }}">
                                        <i class="fas fa-user-circle me-2 text-warning"></i> Profile Saya
                                    </a>
                                </li>

                                @if (auth()->user()->role === 'admin')
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.dashboard') }}">
                                            <i class="fas fa-tachometer-alt me-2 text-danger"></i> Dashboard Admin
                                        </a>
                                    </li>
                                @endif

                                <li><hr class="dropdown-divider my-2"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger fw-semibold">
                                            <i class="fas fa-sign-out-alt me-2" style="width: 20px;"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>

                    @else
                        {{-- GUEST BUTTONS --}}
                        <li class="nav-item d-flex gap-2 mt-3 mt-lg-0">
                            <a href="{{ route('login.form') }}" class="btn btn-warning px-4 fw-bold shadow-sm rounded-pill w-100 w-lg-auto">Login</a>
                            <a href="{{ route('register.form') }}" class="btn btn-outline-warning text-dark px-4 fw-bold rounded-pill w-100 w-lg-auto">Register</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    {{-- FLASH MESSAGES --}}
    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    {{-- MAIN CONTENT --}}
    <main class="flex-grow-1">
        {{ $slot }}
    </main>

    {{-- FOOTER --}}
    <footer class="footer-modern bg-dark text-white mt-auto pt-5 pb-4">
        <div class="container">
            <div class="row gy-4">
                <div class="col-12 col-md-6 col-lg-4">
                    <h5 class="text-uppercase fw-bold text-light mb-3">Parna Jaya</h5>
                    <p class="text-light opacity-75">Belanja ikan segar dan produk terbaik untuk masakan Anda dengan mudah.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white fs-5 opacity-75 hover-light"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white fs-5 opacity-75 hover-light"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white fs-5 opacity-75 hover-light"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-6 col-md-3 col-lg-2">
                    <h6 class="text-uppercase fw-bold mb-3">Produk</h6>
                    <ul class="list-unstyled small opacity-75">
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">Ikan Segar</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">Frozen Food</a></li>
                        <li class="mb-1"><a href="#" class="text-white text-decoration-none">Bumbu</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <h6 class="text-uppercase fw-bold mb-3">Kontak</h6>
                    <p class="small opacity-75 mb-1"><i class="fas fa-home me-2"></i> Jakarta, Indonesia</p>
                    <p class="small opacity-75 mb-1"><i class="fas fa-envelope me-2"></i> andreasalexyz@gmail.com</p>
                    <p class="small opacity-75 mb-1"><i class="fas fa-phone me-2"></i> +62 8999999367</p>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <div class="text-center small opacity-75">
                Hak Cipta © <script>document.write(new Date().getFullYear())</script> <strong class="text-warning">Parna Jaya</strong>. Semua hak dilindungi.
            </div>
        </div>
    </footer>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
