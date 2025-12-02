<x-layout title="Form Produk">
    <div class="container mt-4">

        <h2>Form Input Produk</h2>

        {{-- Atur method post dan kelas validasi --}}
        <form method="post" class="was-validated">
            @csrf {{-- Wajib untuk semua form method POST di Laravel --}}

            {{-- Input Nama Produk --}}
            <x-form.group for="name" label="Nama Produk">
                <input type="text" name="name" id="name" class="form-control" required
                    value="{{ old('name') ?? ($product->name ?? '') }}">
            </x-form.group>

            {{-- Input Deskripsi (Textarea) --}}
            <x-form.group for="description" label="Deskripsi Produk">
                <textarea name="description" id="description" class="form-control" required>{{ old('description') ?? ($product->description ?? '') }}</textarea> {{-- Nilai Textarea harus di antara tag --}}
            </x-form.group>

            {{-- Input Harga (Gunakan type="number" untuk input numerik) --}}
            <x-form.group for="price" label="Harga">
                <input type="number" name="price" id="price" class="form-control" required min="0"
                    value="{{ old('price') ?? ($product->price ?? '') }}">
            </x-form.group>

            <label for="category" class="mb-2">Kategori</label>
            <select class="form-select" aria-label="Default select example" name="category_product_id" required>
                @foreach ($categories as $category)
                    <option @selected($category->id == (old('category_product_id') ?? ($product->category_product_id ?? ''))) value=" {{ $category->id }} "> {{ $category->name }} </option>
                @endforeach
            </select>

            {{-- Tombol Submit --}}
            <div class="mb-3 mt-3">
                <button type="submit" class="btn btn-primary">Simpan Produk</button>
            </div>

        </form>
    </div>
</x-layout>
