<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin Dashboard' }} | eFish Admin</title>

    {{-- BOOTSTRAP 5 & ICONS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- CUSTOM CSS --}}
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-gold: #ffc400;
        }

        body {
            background-color: #f3f4f6; /* Abu-abu sangat muda agar konten menonjol */
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        /* --- SIDEBAR STYLE --- */
        .sidebar {
            width: var(--sidebar-width);
            background: #1e2125; /* Dark Theme */
            color: #adb5bd;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1045;
            transition: transform 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            background-color: rgba(0,0,0,0.1);
            text-decoration: none;
        }

        .sidebar-brand span {
            color: var(--primary-gold);
        }

        .nav-link {
            color: #adb5bd;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .nav-link:hover {
            color: #fff;
            background-color: rgba(255,255,255,0.05);
        }

        .nav-link.active {
            color: #fff;
            background-color: rgba(255, 196, 0, 0.1); /* Gold transparan */
            border-left-color: var(--primary-gold);
            font-weight: 600;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #6c757d;
            padding: 1.5rem 1.5rem 0.5rem;
            font-weight: 700;
        }

        /* --- MAIN CONTENT STYLE --- */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease-in-out;
        }

        .top-navbar {
            height: 64px;
            background: #fff;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1040;
        }

        /* --- RESPONSIVE (MOBILE) --- */
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%); /* Sembunyikan sidebar di mobile */
            }

            .sidebar.show {
                transform: translateX(0); /* Munculkan saat class 'show' aktif */
            }

            .main-content {
                margin-left: 0; /* Konten full width di mobile */
            }

            /* Overlay saat sidebar muncul di mobile */
            .sidebar-overlay {
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.5);
                z-index: 1044;
                display: none;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- OVERLAY UNTUK MOBILE --}}
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- SIDEBAR --}}
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
           eFish Dashboard
        </a>

        <div class="overflow-auto flex-grow-1 py-3">
            <nav class="nav flex-column">

                <div class="sidebar-heading">Core</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </a>

                <div class="sidebar-heading">Master Data</div>
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box-open"></i> Produk & Stok
                </a>
                
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Pengguna
                </a>

                <div class="sidebar-heading">Marketing</div>
                <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-ticket"></i> Kupon Diskon
                </a>
                <a href="{{ route('admin.loyalty.index') }}" class="nav-link {{ request()->routeIs('admin.loyalty.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gift"></i> Rewards Poin
                </a>

                <div class="sidebar-heading">Konten</div>
                <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-newspaper"></i> Blog & Artikel
                </a>
                <a href="{{ route('admin.landing.index') }}" class="nav-link {{ request()->routeIs('admin.landing.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-desktop"></i> Landing Page
                </a>
            </nav>
        </div>

        {{-- Sidebar Footer (Logout) --}}
        <div class="p-3 border-top border-secondary">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 btn-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN LAYOUT --}}
    <div class="main-content">

        {{-- TOP NAVBAR --}}
        <header class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                {{-- Toggle Button (Mobile Only) --}}
                <button class="btn btn-light border d-lg-none" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>

                {{-- Tombol Lihat Website --}}
                <a href="{{ route('home') }}" class="btn btn-light btn-sm border fw-bold text-muted d-none d-md-inline-block" target="_blank">
                    <i class="fa-solid fa-globe me-1"></i> Lihat Website
                </a>
            </div>

            {{-- Admin Profile Dropdown --}}
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none text-dark dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="text-end me-2 d-none d-sm-block">
                        <small class="d-block fw-bold">{{ Auth::user()->name }}</small>
                        <small class="d-block text-muted" style="font-size: 0.75rem;">Administrator</small>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0d6efd&color=fff"
                         alt="Admin" class="rounded-circle" width="40" height="40">
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                    <li><h6 class="dropdown-header">Akun</h6></li>
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="p-4">
            {{ $slot }}
        </main>

        {{-- FOOTER ADMIN --}}
        <footer class="mt-auto py-3 px-4 bg-white border-top">
            <div class="text-center text-muted small">
                &copy; {{ date('Y') }} <strong>eFish Admin Panel</strong>. All rights reserved.
            </div>
        </footer>
    </div>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Script Sederhana untuk Toggle Sidebar di Mobile
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>
</html>
