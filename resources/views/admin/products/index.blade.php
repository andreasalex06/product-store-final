<x-admin-layout title="Manajemen Produk">
    <div class="container-fluid px-4">

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">Manajemen Produk</h2>
                <p class="text-muted small mb-0">Kelola katalog, harga, dan stok produk Anda.</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-3 px-4 shadow-sm">
                <i class="fas fa-plus me-2"></i>Tambah Produk
            </a>
        </div>

        {{-- Table Card --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr class="text-nowrap"> {{-- text-nowrap agar header tidak turun baris --}}
                                {{-- min-width: 300px agar kolom Produk lebar & lega --}}
                                <th class="py-3 ps-4 text-uppercase small fw-bold border-0" style="min-width: 250px;">
                                    Produk</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 150px;">
                                    Kategori</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 150px;">Harga
                                </th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 120px;">Stok (Kg)
                                </th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 200px;">Pembuat
                                </th>
                                <th class="py-3 pe-4 text-uppercase small fw-bold border-0"
                                    style="min-width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    {{-- Kolom Produk --}}
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 bg-light rounded me-3 d-flex align-items-center justify-content-center overflow-hidden border"
                                                style="width: 50px; height: 50px;">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/products_image/' . $product->image) }}"
                                                        alt="Img" class="w-100 h-100" style="object-fit: cover;">
                                                @else
                                                    <i class="fas fa-box text-secondary fa-lg"></i>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-1 fw-bold text-dark text-wrap" style="line-height: 1.4;">
                                                    {{ $product->name }}</h6>
                                                <p class="text-muted small mb-0 text-wrap"
                                                    style="max-width: 250px; line-height: 1.3;">
                                                    {{ Str::limit($product->description, 60) }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Kategori --}}
                                    <td class="text-nowrap">
                                        <span
                                            class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-10 rounded-pill px-3 py-2">
                                            {{ $product->category?->name ?? 'Uncategorized' }}
                                        </span>
                                    </td>

                                    {{-- Kolom Harga --}}
                                    <td class="text-nowrap">
                                        <span class="fw-bold text-dark">
                                            Rp {{ number_format($product->price, 0, ',', '.') }}
                                        </span>
                                    </td>

                                    {{-- Kolom Stok --}}
                                    <td class="text-nowrap">
                                        @if ($product->stock == 0)
                                            <span
                                                class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-10">Habis</span>
                                        @elseif($product->stock < 10)
                                            <span
                                                class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25">Menipis
                                                ({{ $product->stock }})</span>
                                        @else
                                            <span class="fw-semibold text-success">
                                                {{ $product->stock }} <small class="text-muted fw-normal"></small>
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Kolom Pembuat --}}
                                    <td class="text-nowrap">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary bg-opacity-10 text-primary fw-bold small me-2 d-flex align-items-center justify-content-center rounded-circle border border-primary border-opacity-10"
                                                style="width: 30px; height: 30px;">
                                                {{ substr($product->user?->name ?? 'A', 0, 1) }}
                                            </div>
                                            <span
                                                class="small text-dark fw-semibold">{{ $product->user?->name ?? 'Admin' }}</span>
                                        </div>
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="pe-4 text-nowrap">
                                        <div class="d-inline-flex gap-1">
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="btn btn-sm btn-light border text-dark" title="Edit">
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="btn btn-sm btn-light border text-danger hover-danger"
                                                    onclick="if(confirm('Hapus produk {{ $product->name }}?')) { this.closest('form').submit(); }"
                                                    title="Hapus">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                            <div class="bg-light rounded-circle p-4 mb-3">
                                                <i class="fas fa-box-open fa-3x text-muted opacity-50"></i>
                                            </div>
                                            <h6 class="text-dark fw-bold">Belum ada data produk</h6>
                                            <p class="text-muted small mb-3">Data produk yang Anda tambahkan akan muncul
                                                di sini.</p>
                                            <a href="{{ route('admin.products.create') }}"
                                                class="btn btn-primary btn-sm rounded-pill px-4">
                                                <i class="fas fa-plus me-2"></i>Tambah Produk
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer Card untuk Pagination --}}
            @if ($products->hasPages())
                <div class="card-footer bg-white border-top-0 py-3">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
