<x-layout title="Daftar Produk">

    <style>
        /* Force single column on very small screens (<=360px) */
        @media (max-width: 360px) {
            .product-col {
                flex: 0 0 100% !important;
                max-width: 100% !important;
            }
        }
    </style>

    <div class="container mt-3">

        {{-- Tombol filter untuk mobile --}}
        <button class="btn btn-outline-secondary btn-sm d-md-none mb-2" type="button" data-bs-toggle="collapse"
            data-bs-target="#filter" aria-expanded="false" aria-controls="filterSidebar">
            Tampilkan Filter
        </button>

        <div class="row">

            {{-- SIDEBAR FILTER --}}
            <div class="col-md-3 mb-3">
                <div class="collapse d-md-block" id="filter">
                    <div class="rounded-4 border border-2 p-3" style="background-color: #f3f3f3">

                        <h5 class="fw-bold mb-3">Filter Produk</h5>

                        <form method="GET" action="{{ route('products.index') }}" class="w-100">

                            {{-- Nama Produk --}}
                            <div class="mb-3">
                                <label class="form-label">Nama Produk</label>
                                <input type="text" name="search" class="form-control form-control-sm"
                                    value="{{ $searchQuery ?? '' }}" placeholder="Cari produk...">
                            </div>

                            {{-- Kategori --}}
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="category_id" class="form-select form-select-sm">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(($category_id ?? null) == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Sorting --}}
                            <div class="mb-3">
                                <label class="form-label">Urutkan</label>
                                <select name="sort_by" class="form-select form-select-sm mb-1">
                                    <option value="created_at" @selected(($sortBy ?? 'created_at') == 'created_at')>Terbaru</option>
                                    <option value="name" @selected($sortBy == 'name')>Nama</option>
                                    <option value="price" @selected($sortBy == 'price')>Harga</option>
                                </select>

                                <select name="sort_order" class="form-select form-select-sm">
                                    <option value="desc" @selected(($sortOrder ?? 'desc') == 'desc')>Z-A / Termahal</option>
                                    <option value="asc" @selected($sortOrder == 'asc')>A-Z / Termurah</option>
                                </select>
                            </div>

                            {{-- Harga --}}
                            <div class="mb-3">
                                <label class="form-label">Rentang Harga</label>
                                <div class="d-flex gap-2">
                                    <input type="number" name="min_price" class="form-control form-control-sm"
                                        placeholder="Min" min="0" value="{{ $minPrice ?? '' }}">
                                    <input type="number" name="max_price" class="form-control form-control-sm"
                                        placeholder="Max" min="0" value="{{ $maxPrice ?? '' }}">
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.index') }}" class="btn btn-danger btn-sm w-50">Reset</a>
                                <button type="submit" class="btn btn-primary btn-sm w-50">Filter</button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>

            {{-- PRODUK --}}
            <div class="col-md-9">

                <h3 class="mb-2">Daftar Produk</h3>

                <div class="row g-3">
                    @if ($products->isEmpty())
                        <div class="col-12">
                            <div class="alert alert-warning text-center">Produk tidak ditemukan.</div>
                        </div>
                    @endif

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-2">
                        @foreach ($products as $product)
                            <div class="col">
                                <x-card :product="$product" />
                            </div>
                        @endforeach
                    </div>

                </div>

                {{-- Pagination --}}
                <div class="d-flex justify-content-between align-items-center my-3 flex-wrap gap-2">
                    {{ $products->links() }}

                    <div class="text-muted small">
                        @if ($products->total() > 0)
                            Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }}
                            dari {{ $products->total() }} produk
                        @else
                            Menampilkan 0 produk
                        @endif
                    </div>
                </div>

            </div>

        </div>
    </div>

</x-layout>
