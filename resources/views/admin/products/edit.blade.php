<x-admin-layout title="Edit Produk">

    <h4 class="mb-4 fw-semibold">Edit Produk</h4>

    <form action="{{ route('admin.products.update', $product->id) }}"
          method="POST"
          enctype="multipart/form-data"
          class="card border-0 shadow-sm p-4">

        @csrf
        @method('PUT')

        {{-- Nama Produk --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $product->name) }}"
                   required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="description"
                      class="form-control"
                      rows="3">{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Kategori --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Kategori</label>
            <select name="category_product_id"
                    class="form-select"
                    required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_product_id', $product->category_product_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Harga --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Harga</label>
            <input type="number"
                   name="price"
                   class="form-control"
                   value="{{ old('price', $product->price) }}"
                   min="0"
                   required>
        </div>

        {{-- Stok --}}
        <div class="mb-3">
            <label class="form-label fw-semibold">Stok dalam (Kg)</label>
            <input type="number"
                   name="stock"
                   class="form-control"
                   value="{{ old('stock', $product->stock) }}"
                   min="0"
                   required>
        </div>

        {{-- Gambar Lama --}}
        @if ($product->image)
            <div class="mb-3">
                <label class="form-label fw-semibold">Gambar Saat Ini</label>
                <div>
                    <img src="{{ asset('storage/products_image/' . $product->image) }}"
                         alt="Product Image"
                         class="img-thumbnail"
                         style="max-height: 150px;">
                </div>
            </div>
        @endif

        {{-- Ganti Gambar --}}
        <div class="mb-4">
            <label class="form-label fw-semibold">Ganti Gambar (Opsional)</label>
            <input type="file"
                   name="image"
                   class="form-control"
                   accept="image/*">
        </div>

        {{-- Action --}}
        <div class="d-flex gap-2">
            <button class="btn btn-primary">
                <i class="fa-solid fa-save"></i> Update
            </button>

            <a href="{{ route('admin.products.index') }}"
               class="btn btn-secondary">
                Batal
            </a>
        </div>

    </form>

</x-admin-layout>
