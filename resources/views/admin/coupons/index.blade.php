<x-admin-layout title="Kelola Kupon">
    <div class="container-fluid px-4">

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">Manajemen Kupon</h2>
                <p class="text-muted small mb-0">Kelola kode promo dan diskon harga produk.</p>
            </div>
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary rounded-3 px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i>Tambah Kupon
            </a>
        </div>

        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table Card --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr class="text-nowrap">
                                <th class="py-3 ps-4 text-uppercase small fw-bold border-0" style="min-width: 150px;">Kode Kupon</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 120px;">Tipe</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 150px;">Nilai Potongan</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 150px;">Batas Pakai</th>
                                <th class="py-3 pe-4 text-uppercase small fw-bold border-0" style="min-width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $coupon)
                                <tr>
                                    {{-- Kolom Kode --}}
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded p-2 me-3 d-flex align-items-center justify-content-center border border-primary border-opacity-10" style="width: 40px; height: 40px;">
                                                <i class="fas fa-ticket-alt"></i>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark font-monospace h6 mb-0">{{ $coupon->code }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Tipe --}}
                                    <td>
                                        @if($coupon->type == 'percent')
                                            <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 rounded-pill px-3 py-2">
                                                Persentase (%)
                                            </span>
                                        @else
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">
                                                Nominal (Rp)
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Kolom Nilai --}}
                                    <td>
                                        <span class="fw-bold text-dark fs-6">
                                            {{ $coupon->type == 'percent' ? $coupon->value . '%' : 'Rp ' . number_format($coupon->value, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    {{-- Kolom Maks Penggunaan --}}
                                    <td>
                                        <span class="text-muted">
                                            <i class="fas fa-users me-1 text-secondary"></i> {{ $coupon->max_uses }} kali
                                        </span>
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="pe-4">
                                        <div class="d-inline-flex gap-2">
                                            {{-- Tombol Edit --}}
                                            {{-- Pastikan route edit sudah ada, jika belum ganti href="#" --}}
                                            <a href="#"
                                               class="btn btn-sm btn-light border text-dark hover-warning"
                                               title="Edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="btn btn-sm btn-light border text-danger hover-danger"
                                                        onclick="if(confirm('Apakah Anda yakin ingin menghapus kupon {{ $coupon->code }}?')) { this.closest('form').submit(); }"
                                                        title="Hapus">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                            <div class="bg-light rounded-circle p-4 mb-3">
                                                <i class="fas fa-ticket-alt fa-3x text-muted opacity-50"></i>
                                            </div>
                                            <h6 class="text-dark fw-bold">Belum ada kupon</h6>
                                            <p class="text-muted small mb-3">Buat kupon diskon pertama Anda untuk menarik pelanggan.</p>
                                            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                                                <i class="fas fa-plus me-2"></i>Tambah Kupon
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer Pagination --}}
            @if(method_exists($coupons, 'hasPages') && $coupons->hasPages())
                <div class="card-footer bg-white border-top-0 py-3">
                    {{ $coupons->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
