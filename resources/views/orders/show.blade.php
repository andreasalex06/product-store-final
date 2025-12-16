<x-layout title="Detail Pesanan">

<div class="container p-5">

    <h3 class="fw-bold mb-4">Detail Pesanan {{ $order->id }}</h3>

    {{-- CARD INFO PEMBELI --}}
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body">

            <h5 class="fw-semibold mb-3">Informasi Pesanan</h5>

            <div class="row g-3">

                <div class="col-md-6">
                    <p class="mb-1 text-muted">Alamat Pengiriman</p>
                    <p class="fw-semibold">{{ $order->address }}</p>
                </div>

                <div class="col-md-3">
                    <p class="mb-1 text-muted">Telepon</p>
                    <p class="fw-semibold">{{ $order->phone }}</p>
                </div>

                <div class="col-md-3">
                    <p class="mb-1 text-muted">Metode Pembayaran</p>
                    <span class="badge bg-primary px-3 py-2">
                        {{ strtoupper($order->payment_method) }}
                    </span>
                </div>

                <div class="col-md-4">
                    <p class="mb-1 text-muted">Tanggal Pemesanan</p>
                    <p class="fw-semibold">{{ $order->created_at->format('d M Y') }}</p>
                </div>

            </div>

        </div>
    </div>

    {{-- PRODUK DALAM PESANAN --}}
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body">

            <h5 class="fw-semibold mb-3">Produk Dalam Pesanan</h5>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Harga</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="fw-semibold">
                                    {{ $item->product->name }}
                                </td>

                                <td class="text-center">
                                    {{ $item->quantity }}
                                </td>

                                <td class="text-end">
                                    Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}
                                </td>

                                <td class="fw-bold text-end text-success">
                                    Rp {{ number_format($item->price_at_purchase * $item->quantity, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    {{-- TOTAL PEMBAYARAN --}}
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">

            <h4 class="mb-0 fw-bold">Total Pembayaran:</h4>

            {{-- get total order --}}
            <h3 class="mb-0 fw-bold text-success">
                Rp {{ number_format($order->total, 0, ',', '.') }}
            </h3>

        </div>
    </div>

</div>

</x-layout>
