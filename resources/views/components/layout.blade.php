<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $title ?? 'Andre' }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="..." crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body>

    {{-- navigasi --}}
    <nav class="navbar navbar-expand-lg shadow sticky-top" style="background-color: #ffffff;">
        <div class="container-fluid px-4">

            {{-- Brand --}}
            <a class="navbar-brand fw-bold text-warning" href="{{ route('home') }}">Alibobo</a>

            <div class="d-flex justify-content-center align-items-center">

                {{-- Mobile toggle --}}
                <div class="d-lg-none d-flex gap-2 me-2">
                    @guest
                        <a href="{{ route('login.form') }}" class="btn btn-primary btn-sm">Login</a>
                        <a href="{{ route('register.form') }}" class="btn btn-outline-primary btn-sm">Register</a>
                    @endguest
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            {{-- Navbar content --}}
            <div class="collapse navbar-collapse" id="navbarNav">

                {{-- LEFT MENU --}}
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->routeIs('home') ? 'active fw-bold' : '' }}"
                            href="{{ route('home') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold {{ request()->routeIs('products') ? 'active fw-bold' : '' }}"
                            href="{{ route('products') }}">
                            Produk
                        </a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('products.create') ? 'active fw-semibold' : '' }}"
                                href="{{ route('products.create') }}">
                                Tambah Produk
                            </a>
                        </li>
                    @endauth

                </ul>

                {{-- RIGHT MENU --}}
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    @auth
                        {{-- Keranjang --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('cart.index') ? 'active fw-semibold' : '' }}"
                                href="{{ route('cart.index') }}">
                                <i class="fa-solid fa-basket-shopping"></i> Keranjang
                            </a>
                        </li>

                        {{-- Pesanan --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('orders.index') ? 'active fw-semibold' : '' }}"
                                href="{{ route('orders.index') }}">
                                <i class="fa-solid fa-box"></i> Pesanan
                            </a>
                        </li>

                        @auth
                            <span class="border-warning border-2 border-start ps-2">Halo, {{ Auth::user()->name }} </span>
                        @endauth
                        {{-- Logout --}}
                        <li class="nav-item ms-3">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login.form') }}" class="btn btn-primary btn-sm me-1">Login</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('register.form') }}" class="btn btn-outline-primary btn-sm">Register</a>
                        </li>
                    @endguest

                </ul>
            </div>

        </div>
    </nav>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif



    {{ $slot }}

    <footer class="footer-modern bg-dark text-white mt-5 pt-5 pb-4">
        <div class="container">

            <div class="row gy-4">

                {{-- Brand + Deskripsi --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <h5 class="text-uppercase fw-bold text-light mb-3">Alibobo</h5>
                    <p class="text-light opacity-75">
                        Solusi teknologi modern untuk membantu bisnis berkembang di era digital.
                    </p>

                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-white fs-5 opacity-75 hover-light">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-white fs-5 opacity-75 hover-light">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-white fs-5 opacity-75 hover-light">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-white fs-5 opacity-75 hover-light">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                {{-- Produk --}}
                <div class="col-6 col-md-3 col-lg-2">
                    <h6 class="text-uppercase fw-bold mb-3">Produk</h6>
                    <ul class="list-unstyled small">
                        <li>Web Development</li>
                        <li>Accounting</li>
                        <li>UI/UX</li>
                        <li>Pricing</li>
                    </ul>
                </div>

                {{-- Kontak --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <h6 class="text-uppercase fw-bold mb-3">Kontak</h6>
                    <p class="small opacity-75 mb-1">
                        <i class="fas fa-home me-2"></i> Jakarta, Indonesia
                    </p>
                    <p class="small opacity-75 mb-1">
                        <i class="fas fa-envelope me-2"></i> andreasalexyz@gmail.com
                    </p>
                    <p class="small opacity-75 mb-1">
                        <i class="fas fa-phone me-2"></i> +62 8999999367
                    </p>
                </div>

            </div>

            <hr class="border-secondary my-4">

            {{-- Copyright --}}
            <div class="text-center small opacity-75">
                Hak Cipta ©
                <script>
                    document.write(new Date().getFullYear())
                </script>
                <strong class="text-warning">Alibobo</strong>. Semua hak dilindungi.
            </div>

        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
