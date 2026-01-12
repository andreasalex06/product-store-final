<x-layout title="Riwayat Pembelian">
    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 mb-3">Riwayat Pembelian</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
        </div>

        @if ($orders->isEmpty())
            {{-- EMPTY STATE --}}
            <div class="text-center py-5">
                <div class="bg-light rounded-circle p-5 d-inline-block mb-4">
                    <i class="fas fa-receipt fa-4x text-muted opacity-50"></i>
                </div>
                <h4 class="fw-bold text-muted mb-3">Belum ada riwayat pembelian</h4>
                <p class="text-secondary col-md-6 mx-auto mb-4">
                    Kamu belum melakukan transaksi apapun. Yuk, mulai belanja sekarang!
                </p>
                <a href="{{ route('products.index') }}" class="btn btn-warning px-5 py-2 rounded-pill fw-bold shadow-sm text-dark">
                    <i class="fas fa-shopping-bag me-2"></i> Mulai Belanja
                </a>
            </div>
        @else
            {{-- ORDER LIST --}}
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-header bg-white py-3">
                            <h6 class="fw-bold m-0"><i class="fas fa-history me-2 text-warning"></i>Daftar Transaksi</h6>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light text-secondary small text-uppercase">
                                    <tr>
                                        <th class="ps-4 py-3">ID Order</th>
                                        <th class="py-3">Tanggal</th>
                                        <th class="py-3">Total Belanja</th>
                                        <th class="py-3">Pembayaran</th>
                                        <th class="py-3">Status</th>
                                        <th class="text-end py-3 pe-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            {{-- ID Order --}}
                                            <td class="ps-4 fw-bold text-primary font-monospace">
                                                #{{ $order->id }}
                                            </td>

                                            {{-- Tanggal --}}
                                            <td class="text-muted small">
                                                <i class="far fa-calendar-alt me-1"></i>
                                                {{ $order->created_at->format('d M Y') }}
                                            </td>

                                            {{-- Total --}}
                                            <td class="fw-bold text-success">
                                                Rp {{ number_format($order->total, 0, ',', '.') }}
                                            </td>

                                            {{-- Metode Pembayaran --}}
                                            <td>
                                                <span class="badge bg-light text-dark border fw-normal text-uppercase">
                                                    {{ $order->payment_method }}
                                                </span>
                                            </td>

                                            {{-- Status (Logic Sederhana) --}}
                                            <td>
                                                {{-- Anda bisa mengganti ini dengan $order->status jika ada di database --}}
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3">
                                                    Selesai
                                                </span>
                                            </td>

                                            {{-- Aksi --}}
                                            <td class="text-end pe-4">
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                   class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-bold"
                                                   title="Lihat Detail">
                                                    Detail <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</x-layout>
