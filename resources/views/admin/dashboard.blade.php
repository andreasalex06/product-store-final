<x-admin-layout title="Admin Dashboard">

    {{-- Custom CSS untuk Efek Hover Dashboard --}}
    @push('styles')
    <style>
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        }
        .icon-wrapper {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.5rem;
        }
    </style>
    @endpush

    <div class="container-fluid px-4">

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">Dashboard</h2>
                <p class="text-muted small mb-0">Selamat datang kembali, <span class="fw-bold text-primary">{{ auth()->user()->name }}</span>!</p>
            </div>
            <div class="text-end">
                <span class="badge bg-white text-dark border shadow-sm px-3 py-2 rounded-pill">
                    <i class="far fa-calendar-alt me-2"></i> {{ now()->format('d M Y') }}
                </span>
            </div>
        </div>

        {{-- Grid Menu --}}
        <div class="row g-4">

            {{-- 1. Manajemen Produk --}}
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-wrapper bg-primary bg-opacity-10 text-primary">
                                    <i class="fa-solid fa-box-open"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Produk</h6>
                                    <small class="text-muted d-block lh-sm">Kelola katalog & harga</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 2. Manajemen User --}}
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-wrapper bg-info bg-opacity-10 text-info">
                                    <i class="fa-solid fa-users"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Pengguna</h6>
                                    <small class="text-muted d-block lh-sm">Kelola akun user</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 3. Manajemen Stok (Shortcut ke Produk) --}}
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.products.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-wrapper bg-success bg-opacity-10 text-success">
                                    <i class="fa-solid fa-clipboard-check"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Stok Barang</h6>
                                    <small class="text-muted d-block lh-sm">Cek ketersediaan stok</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 4. Manajemen Kupon --}}
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.coupons.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-wrapper bg-warning bg-opacity-10 text-warning">
                                    <i class="fa-solid fa-ticket-alt"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Kupon Diskon</h6>
                                    <small class="text-muted d-block lh-sm">Atur kode promo</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 5. Manajemen Blog --}}
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.blogs.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-wrapper bg-danger bg-opacity-10 text-danger">
                                    <i class="fa-solid fa-newspaper"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Blog & Artikel</h6>
                                    <small class="text-muted d-block lh-sm">Tulis konten berita</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 6. Manajemen Landing Page --}}
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.landing.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-wrapper bg-dark bg-opacity-10 text-dark">
                                    <i class="fa-solid fa-desktop"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Landing Page</h6>
                                    <small class="text-muted d-block lh-sm">Edit tampilan home</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            {{-- 7. Manajemen Rewards --}}
            <div class="col-xl-3 col-md-6">
                <a href="{{ route('admin.loyalty.index') }}" class="text-decoration-none">
                    <div class="card border-0 shadow-sm rounded-4 h-100 dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-wrapper bg-secondary bg-opacity-10 text-secondary">
                                    <i class="fa-solid fa-gift"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Rewards</h6>
                                    <small class="text-muted d-block lh-sm">Kelola hadiah poin</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </div>
</x-admin-layout>
