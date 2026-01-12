<x-layout title="Profil Saya">
    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h6 class="text-warning fw-bold text-uppercase ls-2">Akun Saya</h6>
            <h1 class="fw-bold display-5 mb-3">Profil Pengguna</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
        </div>

        <div class="row g-4">

            {{-- KOLOM KIRI: KARTU IDENTITAS --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                    <div class="card-body text-center p-5">

                        {{-- Avatar --}}
                        <div class="mb-4 position-relative d-inline-block">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=ffc400&color=000&size=128&rounded=true"
                                 alt="{{ $user->name }}"
                                 class="rounded-circle shadow-sm p-1 bg-white"
                                 style="width: 120px; height: 120px;">

                            {{-- Badge Role --}}
                            <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-dark border border-white">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>

                        {{-- Nama & Email --}}
                        <h4 class="fw-bold text-dark mb-1">{{ $user->name }}</h4>
                        <p class="text-muted small mb-4">{{ $user->email }}</p>

                        {{-- Statistik Singkat (Opsional) --}}
                        <div class="d-flex justify-content-center gap-3 mb-4">
                            <div class="bg-light px-3 py-2 rounded-3 border">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.65rem;">Poin</small>
                                <span class="fw-bold text-warning">{{ number_format($user->points ?? 0) }}</span>
                            </div>
                            <div class="bg-light px-3 py-2 rounded-3 border">
                                <small class="text-muted d-block text-uppercase fw-bold" style="font-size: 0.65rem;">Bergabung</small>
                                <span class="fw-bold text-dark">{{ $user->created_at->format('Y') }}</span>
                            </div>
                        </div>

                        {{-- Tombol Edit --}}
                        <button class="btn btn-outline-dark rounded-pill px-4 w-100 fw-bold"
                                data-bs-toggle="modal"
                                data-bs-target="#editProfileModal">
                            <i class="fas fa-edit me-2"></i> Edit Profil
                        </button>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN: DETAIL INFORMASI --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h5 class="fw-bold m-0 text-dark"><i class="fas fa-id-card me-2 text-warning"></i>Informasi Pribadi</h5>
                    </div>
                    <div class="card-body p-4 pt-0">

                        <div class="row g-4">
                            {{-- Nama Lengkap --}}
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold text-uppercase mb-1">Nama Lengkap</label>
                                <div class="p-3 bg-light rounded-3 border d-flex align-items-center">
                                    <i class="fas fa-user text-secondary me-3 opacity-50"></i>
                                    <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold text-uppercase mb-1">Alamat Email</label>
                                <div class="p-3 bg-light rounded-3 border d-flex align-items-center">
                                    <i class="fas fa-envelope text-secondary me-3 opacity-50"></i>
                                    <span class="fw-semibold text-dark">{{ $user->email }}</span>
                                </div>
                            </div>

                            {{-- Tanggal Bergabung --}}
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold text-uppercase mb-1">Tanggal Bergabung</label>
                                <div class="p-3 bg-light rounded-3 border d-flex align-items-center">
                                    <i class="far fa-calendar-alt text-secondary me-3 opacity-50"></i>
                                    <span class="fw-semibold text-dark">{{ $user->created_at->isoFormat('D MMMM Y') }}</span>
                                </div>
                            </div>

                            {{-- Status Akun --}}
                            <div class="col-md-6">
                                <label class="small text-muted fw-bold text-uppercase mb-1">Status Akun</label>
                                <div class="p-3 bg-light rounded-3 border d-flex align-items-center">
                                    <i class="fas fa-check-circle text-success me-3"></i>
                                    <span class="fw-semibold text-success">Aktif / Terverifikasi</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 border-secondary opacity-10">

                        <div class="alert alert-warning border-0 bg-warning bg-opacity-10 d-flex align-items-center rounded-3" role="alert">
                            <i class="fas fa-shield-alt text-warning fs-4 me-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0 text-dark">Keamanan Akun</h6>
                                <p class="mb-0 small text-muted">Pastikan password Anda kuat dan jangan bagikan kepada siapapun.</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Include Modal Edit (Pastikan file ini ada) --}}
    @include('profile.edit-modal')

</x-layout>
