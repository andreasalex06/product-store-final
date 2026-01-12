<x-layout title="{{ $product->name }}">
    <style>
        :root { --cta-color: #ffc107; }
        .product-image-container {
            background: #fdfdfd;
            border: 1px solid #f0f0f0;
            border-radius: 1.5rem;
            overflow: hidden;
        }
        .btn-cta {
            border-radius: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: transform 0.2s ease;
        }
        .btn-cta:active { transform: scale(0.98); }
        .review-card {
            border-radius: 1rem;
            border: 1px solid #f1f1f1;
            background: #fff;
        }
        @media (max-width: 768px) {
            .display-mobile-first { order: -1; } /* Gambar tetap di atas pada mobile */
            .product-title { font-size: 1.75rem; }
        }
    </style>

    <div class="container mt-4 mt-lg-5 mb-5">
        <div class="row g-4 g-lg-5">
            {{-- KOLOM GAMBAR (Sticky pada Desktop) --}}
            <div class="col-lg-7 display-mobile-first">
                <div class="position-sticky" style="top: 2rem;">
                    <div class="product-image-container shadow-sm">
                        <img src="{{ asset('storage/products_image/' . $product->image) }}"
                             class="img-fluid w-100"
                             style="object-fit: cover; min-height: 400px; max-height: 600px;"
                             alt="{{ $product->name }}">
                    </div>
                </div>
            </div>

            {{-- KOLOM DETAIL --}}
            <div class="col-lg-5">
                {{-- Breadcrumb minimalis --}}
                <nav aria-label="breadcrumb" class="mb-3 d-none d-md-block">
                    <ol class="breadcrumb small">
                        <li class="breadcrumb-item"><a href="/" class="text-muted text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item active fw-bold text-dark">{{ $product->name }}</li>
                    </ol>
                </nav>

                {{-- Rating Summary --}}
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="px-3 py-1 bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 rounded-pill small fw-bold">
                        ★ {{ $product->avg_rating }}
                    </div>
                    <span class="text-muted small">({{ $product->reviews->count() }} Ulasan Pelanggan)</span>
                </div>

                <h1 class="product-title fw-bold text-dark mb-2">{{ $product->name }}</h1>
                <h2 class="h3 fw-bold text-warning mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>

                <div class="mb-5">
                    <h6 class="text-uppercase small fw-bold text-muted mb-2">Deskripsi Produk</h6>
                    <p class="text-secondary lh-lg" style="font-size: 0.95rem;">
                        {{ $product->description }}
                    </p>
                </div>

                {{-- CTA AREA --}}
                <div class="fixed-bottom p-3 bg-white border-top d-lg-none shadow-lg" style="z-index: 1030;">
                    {{-- Navigasi CTA khusus Mobile (Sticky di bawah) --}}
                    <div class="d-flex gap-2">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark btn-cta w-100 py-3">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </form>
                        <form action="{{ route('checkout.now', $product->id) }}" method="GET" class="flex-grow-1">
                            <button type="submit" class="btn btn-warning btn-cta w-100 py-3 text-dark">
                                Beli Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <div class="d-none d-lg-block border-top pt-4">
                    {{-- CTA khusus Desktop --}}
                    <div class="d-flex gap-3">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            <button type="submit" class="btn btn-outline-dark btn-cta w-100 py-3">
                                + Keranjang
                            </button>
                        </form>
                        <form action="{{ route('checkout.now', $product->id) }}" method="GET" class="flex-grow-1">
                            <button type="submit" class="btn btn-warning btn-cta w-100 py-3 text-dark">
                                Beli Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEKSI REVIEW --}}
        <div class="row mt-5 pt-lg-5">
            {{-- TULIS REVIEW (Form Validation Sesi 9) --}}
            <div class="col-lg-4 mb-5">
                <div class="p-4 bg-white border rounded-4 shadow-sm">
                    <h5 class="fw-bold mb-4">Tulis Ulasan</h5>
                    <form action="{{ route('review.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Beri Rating</label>
                            <select name="rating" class="form-select border-0 bg-light rounded-3">
                                <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                                <option value="4">⭐⭐⭐⭐ Bagus</option>
                                <option value="3">⭐⭐⭐ Cukup</option>
                                <option value="2">⭐⭐ Kurang</option>
                                <option value="1">⭐ Buruk</option>
                            </select>
                            @error('rating') <div class="text-danger small mt-1">[cite: 299]</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted">Komentar</label>
                            <textarea name="comment" rows="4" class="form-control border-0 bg-light rounded-3" placeholder="Apa pendapat Anda tentang produk ini?">{{ old('comment') }}</textarea>
                            @error('comment') <div class="text-danger small mt-1">[cite: 299]</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 rounded-3 fw-bold">Kirim Ulasan</button>
                    </form>
                </div>
            </div>

            {{-- LIST REVIEW --}}
            <div class="col-lg-8 ps-lg-5">
                <h5 class="fw-bold mb-4">Ulasan Pilihan</h5>
                @forelse($product->reviews()->latest()->get() as $review)
                    <div class="review-card p-4 mb-3 shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="fw-bold d-block">{{ $review->user->name ?? 'Pelanggan' }}</span>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                            <div class="text-warning small">
                                @for($i=1; $i<=5; $i++)
                                    {{ $i <= $review->rating ? '★' : '☆' }}
                                @endfor
                            </div>
                        </div>
                        <p class="text-secondary mb-0" style="font-size: 0.9rem;">"{{ $review->comment }}"</p>
                    </div>
                @empty
                    <div class="text-center py-5 bg-light rounded-4">
                        <i class="far fa-comment-dots fa-2x text-muted mb-3 d-block"></i>
                        <p class="text-muted">Belum ada ulasan. Jadilah yang pertama!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-layout>
