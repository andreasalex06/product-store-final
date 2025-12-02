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

                    <div class="mb-3">
                        <label for="sort_by" class="text-light form-label">Urutkan Berdasarkan</label>
                        <select name="sort_by" id="sort_by" class="form-select mb-2">
                            <option value="created_at" @selected(($sortBy ?? 'created_at') == 'created_at')>Terbaru</option>
                            <option value="name" @selected(($sortBy ?? '') == 'name')>Nama Produk</option>
                            <option value="price" @selected(($sortBy ?? '') == 'price')>Harga</option>
                        </select>

                        <select name="sort_order" id="sort_order" class="form-select">
                            <option value="desc" @selected(($sortOrder ?? 'desc') == 'desc')>(Z-A/Termahal)</option>
                            <option value="asc" @selected(($sortOrder ?? '') == 'asc')>(A-Z/Termurah)</option>
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
                        <a href="{{ route('products') }}" class="flex-fill btn btn-danger btn-sm">Reset</a>
                        <button type="submit" class="flex-fill btn btn-primary btn-sm">Terapkan Filter</button>

                    </div>

                </div>
            </form>



        </div>
        <div class="row">

            @if ($products->isEmpty())
                <div class="alert alert-warning text-center mt-3" role="alert">
                    Produk tidak ditemukan dengan filter yang diterapkan.
                </div>
            @endif

            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                    <x-card :product="$product" />

                </div>
            @endforeach

        </div>

    </div>
</x-layout>
