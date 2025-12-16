<x-layout title="Riwayat Pembelian">

<div class="container py-4">

    <h3 class="mb-4 fw-bold">Riwayat Pembelian</h3>

    @if ($orders->isEmpty())
        <div class="alert alert-info">
            Kamu belum memiliki riwayat pembelian.
        </div>
    @else

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">ID</th>
                                <th>Tanggal</th>
                                <th>Total</th>
                                <th>Metode Pembayaran</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td class="fw-semibold">
                                        #{{ $order->id }}
                                    </td>

                                    <td>
                                        {{ $order->created_at->format('d M Y') }}
                                    </td>

                                    <td class="fw-bold text-success">
                                        Rp {{ number_format($order->total, 0, ',', '.') }}
                                    </td>

                                    <td class="text-capitalize">
                                        {{ $order->payment_method }}
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            Selesai
                                        </span>
                                    </td>

                                    <td class="text-end">
                                        <a href="{{ route('orders.show', $order->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    @endif

</div>

</x-layout>
