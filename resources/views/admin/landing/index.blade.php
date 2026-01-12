<x-admin-layout title="Kelola Landing Page">
    <div class="container-fluid px-4">

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">CMS Landing Page</h2>
                <p class="text-muted small mb-0">Sesuaikan tampilan halaman utama website Anda.</p>
            </div>
            <button type="submit" form="mainForm" class="btn btn-primary rounded-3 px-4 shadow-sm">
                <i class="fas fa-save me-2"></i>Simpan Perubahan
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">

            {{-- KOLOM KIRI: FORM TEKS UTAMA --}}
            <div class="col-lg-8">
                <form id="mainForm" action="{{ route('admin.landing.update') }}" method="POST">
                    @csrf

                    {{-- 1. HERO SECTION --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-bottom-0 py-3">
                            <h5 class="fw-bold m-0 text-primary">Hero Section</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-muted">Badge / Label Kecil</label>
                                <input type="text" name="hero_badge" class="form-control"
                                    value="{{ $settings['hero_badge'] ?? 'Supplier Ikan Segar No. 1' }}"
                                    placeholder="Contoh: Promo Spesial">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold small text-uppercase text-muted">Judul Utama</label>
                                <div class="input-group">
                                    <input type="text" name="hero_title" class="form-control"
                                        value="{{ $settings['hero_title'] ?? 'Kualitas Ikan Terbaik <br> <span class="text-warning">Langsung ke Dapurmu</span>' }}">
                                    <span class="input-group-text bg-light text-muted small"><i class="fas fa-code"></i> HTML</span>
                                </div>
                                <div class="form-text small">Gunakan <code>&lt;br&gt;</code> untuk baris baru.</div>
                            </div>
                            <div class="mb-0">
                                <label class="form-label fw-bold small text-uppercase text-muted">Deskripsi Singkat</label>
                                <textarea name="hero_desc" class="form-control" rows="3">{{ $settings['hero_desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- 2. FITUR / KEUNGGULAN --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-bottom-0 py-3">
                            <h5 class="fw-bold m-0 text-primary">Keunggulan (3 Fitur)</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-uppercase text-muted">Judul Section</label>
                                <input type="text" name="why_title" class="form-control fw-bold"
                                    value="{{ $settings['why_title'] ?? 'Mengapa Memilih Kami?' }}">
                            </div>

                            <div class="row g-3">
                                {{-- Fitur 1 --}}
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 border h-100">
                                        <div class="badge bg-primary mb-2">Fitur 1</div>
                                        <div class="mb-2">
                                            <input type="text" name="feature_1_title" class="form-control form-control-sm fw-bold mb-2"
                                                value="{{ $settings['feature_1_title'] ?? 'Stok Real-Time' }}" placeholder="Judul">
                                            <textarea name="feature_1_desc" class="form-control form-control-sm" rows="3" placeholder="Deskripsi">{{ $settings['feature_1_desc'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- Fitur 2 --}}
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 border h-100">
                                        <div class="badge bg-info mb-2">Fitur 2</div>
                                        <div class="mb-2">
                                            <input type="text" name="feature_2_title" class="form-control form-control-sm fw-bold mb-2"
                                                value="{{ $settings['feature_2_title'] ?? 'Pengiriman Instan' }}" placeholder="Judul">
                                            <textarea name="feature_2_desc" class="form-control form-control-sm" rows="3" placeholder="Deskripsi">{{ $settings['feature_2_desc'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                {{-- Fitur 3 --}}
                                <div class="col-md-4">
                                    <div class="p-3 bg-light rounded-3 border h-100">
                                        <div class="badge bg-warning text-dark mb-2">Fitur 3</div>
                                        <div class="mb-2">
                                            <input type="text" name="feature_3_title" class="form-control form-control-sm fw-bold mb-2"
                                                value="{{ $settings['feature_3_title'] ?? 'Layanan Terbaik' }}" placeholder="Judul">
                                            <textarea name="feature_3_desc" class="form-control form-control-sm" rows="3" placeholder="Deskripsi">{{ $settings['feature_3_desc'] ?? '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 3. VISI MISI --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-5">
                        <div class="card-header bg-white border-bottom-0 py-3">
                            <h5 class="fw-bold m-0 text-primary">Visi & Misi</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3">Visi Perusahaan</h6>
                                    <div class="mb-3">
                                        <label class="form-label small text-muted">Judul Visi</label>
                                        <input type="text" name="visi_title" class="form-control"
                                            value="{{ $settings['visi_title'] ?? 'Menjadi Pilihan Utama' }}">
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small text-muted">Isi Visi</label>
                                        <textarea name="visi_text" class="form-control" rows="4">{{ $settings['visi_text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3">Misi Perusahaan</h6>
                                    <div class="mb-3">
                                        <label class="form-label small text-muted">Judul Misi</label>
                                        <input type="text" name="misi_title" class="form-control"
                                            value="{{ $settings['misi_title'] ?? 'Melayani Sepenuh Hati' }}">
                                    </div>
                                    <div class="mb-0">
                                        <label class="form-label small text-muted">Isi Misi</label>
                                        <textarea name="misi_text" class="form-control" rows="4">{{ $settings['misi_text'] ?? '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- KOLOM KANAN: PARTNER / LOGO --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px; z-index: 100;">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <h5 class="fw-bold m-0 text-dark"><i class="fas fa-handshake me-2"></i>Logo Partner</h5>
                    </div>
                    <div class="card-body">
                        {{-- Form Upload --}}
                        <div class="bg-light p-3 rounded-3 mb-4 border border-dashed">
                            <h6 class="fw-bold small mb-3">Tambah Partner Baru</h6>
                            <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <input type="text" name="partner_name" class="form-control form-control-sm" placeholder="Nama Partner" required>
                                </div>
                                <div class="mb-2">
                                    <input type="file" name="partner_logo" class="form-control form-control-sm" accept="image/*" required>
                                </div>
                                <button class="btn btn-dark btn-sm w-100 fw-bold">
                                    <i class="fas fa-upload me-1"></i> Upload Logo
                                </button>
                            </form>
                        </div>

                        {{-- List Partner --}}
                        <h6 class="fw-bold small text-muted mb-3">Daftar Partner ({{ count($partners) }})</h6>
                        <div class="list-group list-group-flush border rounded-3 overflow-hidden" style="max-height: 400px; overflow-y: auto;">
                            @forelse ($partners as $partner)
                                <div class="list-group-item d-flex align-items-center justify-content-between px-3 py-2">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-white border rounded p-1 me-3" style="width: 50px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                            <img src="{{ asset('storage/' . $partner->image) }}" class="mw-100 mh-100">
                                        </div>
                                        <span class="small fw-semibold text-truncate" style="max-width: 100px;">{{ $partner->name }}</span>
                                    </div>

                                    <form action="{{ route('admin.partner.destroy', $partner->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-link text-danger p-0 btn-sm" onclick="return confirm('Hapus logo ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="text-center py-4 text-muted small">
                                    Belum ada partner.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
