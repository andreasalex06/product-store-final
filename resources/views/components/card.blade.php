{{-- Letakkan style ini tepat di atas kode card atau di bagian atas file blade Anda --}}
<style>
    /* Style Khusus untuk Card Produk */
    .product-card {
        border: 1px solid #e0e0e0; /* Garis pinggir tipis */
        box-shadow: 0 4px 6px rgba(0,0,0,0.05); /* Bayangan awal halus */
        transition: all 0.3s ease; /* Transisi halus untuk semua efek */
        background-color: white;
    }

    /* Efek saat mouse diarahkan (Hover) */
    .product-card:hover {
        transform: translateY(-8px); /* Card naik ke atas 8 pixel */
        box-shadow: 0 12px 24px rgba(0,0,0,0.15) !important; /* Bayangan jadi tebal & luas */
        border-color: #ffc107; /* Border berubah jadi kuning (sesuai tema warning) */
    }
</style>

{{-- KODE CARD PRODUK --}}
{{-- Perhatikan class 'product-card' sudah ditambahkan di sini --}}
<div class="card h-100 product-card border-2 rounded-3" style="min-width: 200px; overflow: hidden;">

    {{-- BAGIAN GAMBAR --}}
    <a href="{{ route('products.show', $product) }}" class="text-decoration-none">
        <div class="ratio ratio-1x1 position-relative">
            {{-- Badge Kategori --}}
            <div class="position-absolute z-3 top-0 end-0 p-2">
                <span class="badge bg-white text-dark shadow-sm opacity-75">{{ $product->category->name }}</span>
            </div>

            <img loading="lazy" src="{{ asset('storage/products_image/' . $product->image) }}"
                 class="card-img-top"
                 alt="Gambar {{ $product->name }}" style="object-fit: cover;">
        </div>
    </a>

    <div class="card-body d-flex flex-column p-3">

        {{-- JUDUL --}}
        <a href="{{ route('products.show', $product) }}" class="text-decoration-none text-dark">
            <h6 class="card-title fw-bold mb-1 text-truncate">{{ $product->name }}</h6>
        </a>

        {{-- HARGA --}}
        <p class="card-subtitle text-primary fw-bold mb-2">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>

        {{-- DESKRIPSI --}}
        <p class="card-text text-secondary small flex-grow-1 mb-3" style="font-size: 0.85rem; line-height: 1.4;">
            {{ Str::limit($product->description, 45) }}
        </p>

        {{-- AREA AKSI --}}
        <div class="mt-auto border-top pt-2">

            {{-- Info Stok --}}
            <div class="d-flex justify-content-between align-items-center mb-2">
                <small class="text-muted" style="font-size: 0.75rem;">
                    @if($product->stock > 0)
                        <i class="fa-solid fa-box text-success me-1"></i> Stok: {{ $product->stock }} Kg
                    @else
                        <i class="fa-solid fa-circle-xmark text-danger me-1"></i> Habis
                    @endif
                </small>
            </div>

            {{-- Tombol --}}
            <div class="row g-2">
                @if ($product->stock > 0)
                    {{-- Tombol Keranjang --}}
                    <div class="col-4">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning w-100 btn-sm d-flex justify-content-center align-items-center"
                                    title="Tambah ke Keranjang" style="height: 32px;">
                                <i class="fa-solid fa-cart-plus"></i>
                            </button>
                        </form>
                    </div>

                    {{-- Tombol Beli --}}
                    <div class="col-8">
                        <form action="{{ route('checkout.now', $product->id) }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-warning w-100 btn-sm text-white fw-bold d-flex justify-content-center align-items-center"
                                    style="height: 32px; font-size: 0.8rem;">
                                Beli
                            </button>
                        </form>
                    </div>
                @else
                    <div class="col-12">
                        <button class="btn btn-secondary w-100 btn-sm" disabled style="height: 32px;">
                            Stok Habis
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
