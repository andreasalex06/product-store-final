<x-layout title="{{ $blog->title }}">

    @push('styles')
    <style>
        /* Styling khusus agar konten teks terlihat profesional (Editorial Look) */
        .blog-content {
            color: #333;
            letter-spacing: 0.2px;
            font-family: 'Georgia', 'Times New Roman', serif; /* Font Serif enak untuk baca panjang */
        }
        .blog-content p {
            margin-bottom: 1.5rem;
        }
        /* Dropcap (Huruf pertama besar) */
        .blog-content p:first-child::first-letter {
            float: left;
            font-size: 3.5rem;
            line-height: 0.8;
            font-weight: bold;
            padding-right: 8px;
            padding-top: 4px;
            color: #ffc400; /* Warna kuning eFish */
        }
    </style>
    @endpush

    <div class="container py-3">
        <div class="row justify-content-center">
            <div class="col-lg-9 col-xl-8">

                {{-- Breadcrumb Modern --}}
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb bg-transparent p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none text-muted small fw-bold text-uppercase">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('blogs.index') }}" class="text-decoration-none text-muted small fw-bold text-uppercase">Blog</a>
                        </li>
                        <li class="breadcrumb-item active small fw-bold text-warning text-uppercase" aria-current="page">
                            Detail Artikel
                        </li>
                    </ol>
                </nav>

                {{-- Header Artikel --}}
                <div class="text-center mb-5">
                    <h1 class="fw-bold text-dark display-5 mb-3 lh-sm">{{ $blog->title }}</h1>

                    {{-- Meta Data Penulis & Tanggal --}}
                    <div class="d-flex justify-content-center align-items-center gap-3 text-muted small">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded-circle p-1 border me-2">
                                <i class="fas fa-user-circle fa-lg text-secondary"></i>
                            </div>
                            <span class="fw-semibold text-dark">Admin eFish</span>
                        </div>
                        <span class="text-muted">•</span>
                        <span>{{ $blog->created_at->format('d F Y') }}</span>
                        <span class="text-muted">•</span>
                        <span><i class="far fa-clock me-1"></i> {{ $blog->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                {{-- Gambar Utama --}}
                <div class="mb-5 overflow-hidden rounded-4 shadow-sm position-relative">
                    @if($blog->image)
                        <img src="{{ asset('storage/' . $blog->image) }}"
                             alt="{{ $blog->title }}"
                             class="img-fluid w-100"
                             style="max-height: 500px; object-fit: cover;">
                    @else
                        <div class="bg-light w-100 d-flex align-items-center justify-content-center text-muted" style="height: 400px;">
                            <div class="text-center">
                                <i class="fas fa-image fa-4x opacity-25 mb-3"></i>
                                <p>Tidak ada gambar</p>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Konten Artikel --}}
                <div class="bg-white p-2 p-md-0">
                    <div class="blog-content lh-lg fs-5">
                        {{-- Render konten dengan aman tapi tetap memproses baris baru --}}
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                </div>

                {{-- Footer Artikel / Share / Back --}}
                <div class="mt-5 pt-5 border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('blogs.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Blog
                    </a>

                    {{-- Tombol Share Dummy --}}
                    <div class="d-flex gap-2">
                        <span class="text-muted small align-self-center me-2 d-none d-sm-inline">Bagikan:</span>
                        <button class="btn btn-sm btn-light border rounded-circle"><i class="fab fa-facebook-f"></i></button>
                        <button class="btn btn-sm btn-light border rounded-circle"><i class="fab fa-twitter"></i></button>
                        <button class="btn btn-sm btn-light border rounded-circle"><i class="fab fa-whatsapp"></i></button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
