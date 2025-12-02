<x-layout title="Daftar Produk">
    <div class="container mt-1">
        <div class="container d-flex bg-success rounded-3 px-4 py-2 align-items-center justify-content-between my-2">
            <h3 class="text-light">Daftar Produk</h3>

            <form method="GET" action="{{ route('products') }}" class="d-flex rounded">

                <div class="container">

                    <div class="mb-3">
                        <label for="search" class="text-light form-label">Nama Produk</label>
                        <input type="text" name="search" id="search" class="form-control"
                            value="{{ $searchQuery ?? '' }}" placeholder="Cari berdasarkan nama...">
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="text-light form-label">Kategori</label>
                        <select name="category_id" id="category_id" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{-- Pertahankan pilihan kategori saat ini --}} @selected($category_id == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="container">

                    <div class="row mb-3">
                        <label class="form-label text-light">Rentang Harga</label>
                        <div class="col-6">
                            <input type="number" name="min_price" class="form-control" placeholder="Min Harga"
                                value="{{ $minPrice ?? '' }}" min="0">
                        </div>
                        <div class="col-6">
                            <input type="number" name="max_price" class="form-control" placeholder="Max Harga"
                                value="{{ $maxPrice ?? '' }}" min="0">
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-center gap-2">
                        {{-- Tombol untuk Reset Filter --}}
                        <a href="{{ route('products') }}" class="flex-fill btn btn-danger btn-sm">Reset</a>
                        <button type="submit" class="flex-fill btn btn-primary btn-sm">Terapkan Filter</button>

                    </div>

                </div>
            </form>



        </div>
        <div class="row">

            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                    <x-card :product="$product" />

                </div>
            @endforeach

        </div>

    </div>
</x-layout>
