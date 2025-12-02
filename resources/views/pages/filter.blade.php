<x-layout title="filter">
    <div class="container mt-1">
        <div class="container d-flex bg-secondary rounded-3 p-2 align-items-center justify-content-between my-2">
            <h2 class="text-light">Daftar Produk {{ $currentCategory['name'] }} </h2>
            <div>

                @foreach ($categories as $category)
                    <a href=" {{ route('products.category', ['category_id' => $category['id']]) }} "
                        class="btn btn-success"> {{ $category['name'] }} </a>
                @endforeach
            </div>
        </div>

        @if ($products->isEmpty())
            <div class="alert alert-warning">
                Tidak ada produk yang ditemukan dalam kategori ini.
            </div>
        @else
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">

                        <x-card :product="$product" />

                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>
