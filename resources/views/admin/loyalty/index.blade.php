<x-admin-layout title="Admin - Loyalty Management">
    <div class="container py-5">
        <div class="row g-4">
            {{-- Kolom Kiri: Set Poin Global --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Pengaturan Poin</h5>
                        <form action="{{ route('admin.loyalty.updatePoints') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="small fw-bold text-muted text-uppercase">Poin Per Transaksi</label>
                                <input type="number" name="points_value" class="form-control form-control-lg bg-light border-0"
                                       value="{{ $pointsConfig->value ?? 0 }}">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold">Update Poin</button>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">
                    <div class="card-body p-4">
                        <h6 class="fw-bold"><i class="fas fa-info-circle me-2"></i>Info Admin</h6>
                        <p class="small mb-0 opacity-75">Perubahan poin akan langsung berdampak pada saat user menekan tombol 'Proses Pesanan' di halaman checkout.</p>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Manage Voucher --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="fw-bold mb-0">Daftar Voucher Hadiah</h5>
                            <button class="btn btn-outline-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#addRewardModal">
                                + Tambah Voucher
                            </button>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="text-muted small">
                                    <tr>
                                        <th>Nama Voucher</th>
                                        <th>Poin Dibutuhkan</th>
                                        <th>Potongan</th>
                                        <th>Kode Kupon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rewards as $reward)
                                    <tr>
                                        <td class="fw-bold text-dark">{{ $reward->name }}</td>
                                        <td><span class="badge bg-warning bg-opacity-10 text-dark">{{ $reward->points_required }} Poin</span></td>
                                        <td class="text-success fw-bold">Rp {{ number_format($reward->discount_amount) }}</td>
                                        <td><code class="text-primary fw-bold">{{ $reward->coupon_code }}</code></td>
                                        <td>
                                            <form action="{{ route('admin.loyalty.destroyReward', $reward->id) }}" method="POST" onsubmit="return confirm('Hapus voucher ini?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-link text-danger p-0"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Voucher --}}
    <div class="modal fade" id="addRewardModal" tabindex="-1 shadow">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <form action="{{ route('admin.loyalty.storeReward') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 p-4">
                        <h5 class="fw-bold mb-0">Tambah Voucher Hadiah</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4 pt-0">
                        <div class="mb-3">
                            <label class="small fw-bold">Nama Voucher</label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: Diskon Hemat 25rb" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold">Butuh Poin</label>
                                <input type="number" name="points_required" class="form-control" placeholder="100" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold">Nilai Diskon (Rp)</label>
                                <input type="number" name="discount_amount" class="form-control" placeholder="25000" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small fw-bold">Kode Kupon (Harus Unik)</label>
                            <input type="text" name="coupon_code" class="form-control" placeholder="CONTOH: HEMAT25" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4 pt-0">
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2">Simpan Voucher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
