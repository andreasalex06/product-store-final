<x-admin-layout title="Tambah Produk">

    <h4 class="mb-4 fw-semibold">Tambah Produk</h4>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data"
        class="card border-0 shadow-sm p-4">

        @csrf

        {{-- Nama Produk --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="category_product_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_product_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Harga</label>
            <input type="number" name="price" class="form-control" value="{{ old('price') }}" min="0"
                required>
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Stok</label>
            <input type="number" name="stock" class="form-control" value="{{ old('stock') }}" min="0"
                required>
        </div>

        {{-- Gambar --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Gambar Produk</label>
            <input type="file" name="image" class="form-control" accept="image/*" required>
        </div>

        {{-- Action --}}
        <div class="d-flex gap-2">
            <button class="btn btn-success">
                <i class="fa-solid fa-save"></i> Simpan
            </button>

            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Batal
            </a>

        </div>

    </form>

</x-admin-layout>
