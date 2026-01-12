<x-layout title="Detail Pesanan #{{ $order->id }}">
    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h6 class="text-warning fw-bold text-uppercase ls-2">Transaksi</h6>
            <h1 class="fw-bold display-5 mb-3">Detail Pesanan</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
        </div>

        {{-- NAVIGASI KEMBALI --}}
        <div class="mb-4">
            <a href="{{ route('orders.index') }}" class="text-decoration-none text-muted small fw-bold hover-warning">
                <i class="fas fa-arrow-left me-2"></i> KEMBALI KE RIWAYAT
            </a>
        </div>

        <div class="row g-4">

            {{-- KOLOM KIRI: INFO ORDER & ITEM --}}
            <div class="col-lg-8">

                {{-- CARD STATUS & ALAMAT --}}
                <div class="card border-2 shadow-sm rounded-4 mb-4 overflow-hidden">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small text-uppercase fw-bold">ID Pesanan</span>
                            <h5 class="fw-bold text-dark m-0">#{{ $order->id }}</h5>
                        </div>

                        {{-- Status Badge --}}
                        {{-- Ganti logic status sesuai kebutuhan --}}
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">
                            <i class="fas fa-check-circle me-1"></i> Selesai
                        </span>
                    </div>

                    <div class="card-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-muted small text-uppercase mb-2"><i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman</h6>
                                <p class="text-dark mb-0 lh-sm">{{ $order->address }}</p>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h6 class="fw-bold text-muted small text-uppercase mb-1"><i class="fas fa-phone me-2"></i>Kontak</h6>
                                    <p class="text-dark mb-0">{{ $order->phone }}</p>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-muted small text-uppercase mb-1"><i class="far fa-credit-card me-2"></i>Pembayaran</h6>
                                    <p class="text-dark mb-0 text-capitalize">{{ $order->payment_method }}</p>
                                </div>
                            </div>
                        </div>

                        <hr class="border-secondary opacity-10 my-4">

                        <div class="d-flex align-items-center text-muted small">
                            <i class="far fa-clock me-2"></i> Dipesan pada: {{ $order->created_at->format('d M Y, H:i') }} WIB
                        </div>
                    </div>
                </div>

                {{-- CARD ITEM PRODUK --}}
                <div class="card border-2 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-white rounded-4 py-3">
                        <h6 class="fw-bold m-0"><i class="fas fa-box-open me-2 text-warning"></i>Daftar Produk</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle table-hover mb-0">
                                <thead class="bg-light text-secondary small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3">Produk</th>
                                        <th class="py-3">Harga</th>
                                        <th class="py-3 text-center">Jml</th>
                                        <th class="py-3 pe-4 text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="rounded-4">
                                    @foreach ($order->items as $item)
                                        <tr class="rounded-4">
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="bg-light rounded p-1 border" style="width: 50px; height: 50px;">
                                                        <img src="{{ asset('storage/products_image/' . $item->product->image) }}"
                                                             alt="" class="w-100 h-100 object-fit-cover rounded">
                                                    </div>
                                                    <div>
                                                        <h6 class="fw-bold text-dark mb-0 small">{{ $item->product->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted small">
                                                Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center fw-bold small">
                                                x{{ $item->quantity }}
                                            </td>
                                            <td class="text-end pe-4 fw-bold text-dark">
                                                Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: RINGKASAN PEMBAYARAN --}}
            <div class="col-lg-4">
                <div class="card border-2 shadow-sm rounded-4 bg-white p-4">
                    <h5 class="fw-bold mb-4">Rincian Pembayaran</h5>

                    @php
                        $subtotal = $order->items->sum(fn($item) => $item->price_at_purchase * $item->quantity);
                        $discount = $subtotal - $order->total;
                    @endphp

                    <div class="d-flex justify-content-between mb-2 small text-muted">
                        <span>Total Harga ({{ $order->items->sum('quantity') }} barang)</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>

                    @if ($discount > 0)
                        <div class="d-flex justify-content-between mb-2 small text-muted">
                            <span>Diskon</span>
                            <span class="text-danger fw-bold">- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between mb-4 small text-muted">
                        <span>Biaya Pengiriman</span>
                        <span class="text-success fw-bold">Gratis</span>
                    </div>

                    <hr class="border-secondary opacity-25 my-3">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold text-dark">Total Bayar</span>
                        <h4 class="mb-0 fw-bold text-primary">Rp {{ number_format($order->total, 0, ',', '.') }}</h4>
                    </div>

                    <a href="{{ route('discussions.index') }}" class="btn btn-warning w-100 py-3 fw-bold rounded-pill text-dark shadow-sm">
                        <i class="fas fa-question-circle me-2"></i> Tanya Admin
                    </a>

                    <div class="text-center mt-3">
                        <small class="text-muted fst-italic">Terima kasih telah berbelanja di Parna Jaya.</small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
