<x-layout title="Blog & Artikel">

    {{-- Custom CSS untuk Efek Hover --}}
    @push('styles')
    <style>
        .blog-card {
            transition: all 0.3s ease;
        }
        .blog-card:hover {
            transform: translateY(-10px); /* Efek naik */
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        .blog-img-wrapper {
            overflow: hidden;
            height: 220px;
        }
        .blog-img-wrapper img {
            transition: transform 0.5s ease;
        }
        .blog-card:hover .blog-img-wrapper img {
            transform: scale(1.05); /* Efek zoom in halus pada gambar */
        }
    </style>
    @endpush

    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 mb-3">Blog Seputar Ikan</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
            <p class="text-muted mt-3 w-75 mx-auto">
                Temukan tips, resep, dan informasi menarik seputar dunia perikanan
            </p>
        </div>

        {{-- GRID BLOG --}}
        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <article class="card h-100 border-2 shadow-sm rounded-4 overflow-hidden blog-card">

                        {{-- Gambar --}}
                        <div class="blog-img-wrapper position-relative">
                            <a href="{{ route('blogs.show', $blog->slug) }}">
                                @if($blog->image)
                                    <img src="{{ asset('storage/' . $blog->image) }}" class="w-100 h-100 object-fit-cover" alt="{{ $blog->title }}">
                                @else
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-image fa-3x opacity-25"></i>
                                    </div>
                                @endif
                            </a>

                            {{-- Badge Tanggal (Overlay) --}}
                            <div class="position-absolute top-0 start-0 m-3 bg-white rounded-3 shadow-sm text-center px-2 py-1">
                                <span class="d-block fw-bold fs-5 lh-1 text-dark">{{ $blog->created_at->format('d') }}</span>
                                <span class="d-block small text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">
                                    {{ $blog->created_at->format('M') }}
                                </span>
                            </div>
                        </div>

                        {{-- Konten --}}
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="mb-2">
                                <small class="text-warning fw-bold text-uppercase" style="font-size: 0.75rem;">
                                    <i class="fas fa-tag me-1"></i> Artikel
                                </small>
                            </div>

                            <h5 class="card-title fw-bold mb-3">
                                <a href="{{ route('blogs.show', $blog->slug) }}" class="text-decoration-none text-dark stretched-link">
                                    {{ Str::limit($blog->title, 50) }}
                                </a>
                            </h5>

                            <p class="card-text text-muted small flex-grow-1">
                                {{ Str::limit(strip_tags($blog->content), 100) }}
                            </p>

                            <div class="mt-3 pt-3 border-top d-flex justify-content-between align-items-center">
                                <span class="small text-muted">
                                    <i class="far fa-clock me-1"></i> {{ $blog->created_at->diffForHumans() }}
                                </span>
                                <span class="fw-bold text-warning small">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                </span>
                            </div>
                        </div>
                    </article>
                </div>
            @empty
                {{-- Empty State --}}
                <div class="col-12 text-center py-5">
                    <div class="bg-light rounded-circle p-5 d-inline-block mb-3">
                        <i class="fas fa-newspaper fa-4x text-muted opacity-50"></i>
                    </div>
                    <h4 class="fw-bold text-muted">Belum ada artikel</h4>
                    <p class="text-secondary">Nantikan update terbaru dari kami segera.</p>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($blogs->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</x-layout>
