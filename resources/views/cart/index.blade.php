<x-layout title="Keranjang Belanja">
    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 mb-3">Keranjang Belanja</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
        </div>

        @if ($cart->items->isEmpty())
            {{-- EMPTY STATE --}}
            <div class="text-center py-5">
                <div class="bg-light rounded-circle p-5 d-inline-block mb-4">
                    <i class="fas fa-shopping-basket fa-4x text-muted opacity-50"></i>
                </div>
                <h4 class="fw-bold text-muted mb-3">Keranjang kamu masih kosong</h4>
                <p class="text-secondary col-md-6 mx-auto mb-4">
                    Sepertinya kamu belum menambahkan produk apapun. Yuk, mulai belanja sekarang!
                </p>
                <a href="{{ route('products.index') }}" class="btn btn-warning px-5 py-2 rounded-pill fw-bold shadow-sm text-dark">
                    <i class="fas fa-search me-2"></i> Jelajahi Produk
                </a>
            </div>
        @else
            <div class="row g-4">
                {{-- LIST ITEMS --}}
                <div class="col-lg-8">
                    <div class="card border-2 shadow-sm rounded-4 overflow-hidden mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="fw-bold m-0"><i class="fas fa-list me-2 text-warning"></i>Daftar Item ({{ $cart->items->count() }})</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover">
                                <thead class="bg-light text-secondary small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3" style="min-width: 250px;">Produk</th>
                                        <th class="py-3" style="min-width: 120px;">Harga</th>
                                        <th class="py-3" style="min-width: 100px;">Jumlah</th>
                                        <th class="py-3" style="min-width: 120px;">Subtotal</th>
                                        <th class="text-center py-3" style="width: 50px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->items as $item)
                                        <tr>
                                            {{-- Kolom Produk --}}
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bg-light rounded p-2 border" style="width: 70px; height: 70px;">
                                                        <img src="{{ asset('storage/products_image/' . $item->product->image) }}"
                                                             alt="{{ $item->product->name }}"
                                                             class="w-100 h-100 object-fit-cover rounded">
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-1">{{ $item->product->name }}</h6>
                                                        <small class="text-muted">{{ $item->product->category->name ?? 'Umum' }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- Kolom Harga --}}
                                            <td>
                                                <span class="text-muted">Rp {{ number_format($item->product->price, 0, ',', '.') }}</span>
                                            </td>

                                            {{-- Kolom Jumlah --}}
                                            <td>
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="number"
                                                           name="quantity"
                                                           class="form-control form-control-sm text-center fw-bold border-secondary border-opacity-25 rounded-3"
                                                           style="width: 70px;"
                                                           min="1"
                                                           max="{{ $item->product->stock }}"
                                                           value="{{ $item->quantity }}"
                                                           onchange="this.form.submit()">
                                                </form>
                                            </td>

                                            {{-- Kolom Subtotal --}}
                                            <td>
                                                <span class="fw-bold text-success">
                                                    Rp {{ number_format($item->quantity * $item->product->price, 0, ',', '.') }}
                                                </span>
                                            </td>

                                            {{-- Kolom Aksi --}}
                                            <td class="text-center pe-3">
                                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-sm btn-light text-danger border-0 rounded-circle"
                                                            style="width: 35px; height: 35px;"
                                                            onclick="return confirm('Hapus item ini dari keranjang?')"
                                                            title="Hapus Item">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('products.index') }}" class="text-decoration-none text-muted small fw-bold">
                            <i class="fas fa-arrow-left me-1"></i> Lanjutkan Belanja
                        </a>
                        <small class="text-muted fst-italic">*Harga dapat berubah sewaktu-waktu</small>
                    </div>
                </div>

                {{-- SUMMARY CARD --}}
                <div class="col-lg-4">
                    <div class="card border-2 shadow-sm rounded-4 bg-white p-4 h-100">
                        <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>

                        <div class="d-flex justify-content-between mb-2 small text-muted">
                            <span>Total Harga ({{ $cart->items->sum('quantity') }} barang)</span>
                            <span>Rp {{ number_format($cart->total(), 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4 small text-muted">
                            <span>Diskon</span>
                            <span class="text-success fw-bold">Rp 0</span> {{-- Logic diskon jika ada --}}
                        </div>

                        <hr class="border-secondary opacity-25 my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold text-dark">Total Tagihan</span>
                            <h4 class="mb-0 fw-bold text-primary">Rp {{ number_format($cart->total(), 0, ',', '.') }}</h4>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="btn btn-warning w-100 py-3 fw-bold rounded-pill text-dark shadow-sm mb-3">
                            <i class="fas fa-lock me-2"></i> Lanjut ke Checkout
                        </a>

                        <div class="text-center">
                            <small class="text-muted" style="font-size: 0.7rem;">
                                <i class="fas fa-shield-alt me-1 text-success"></i> Transaksi Aman & Terpercaya
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- Script UX (Enter Key Support) --}}
    @push('scripts')
    <script>
        document.querySelectorAll('input[name="quantity"]').forEach(input => {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.form.submit();
                }
            });
        });
    </script>
    @endpush
</x-layout>
