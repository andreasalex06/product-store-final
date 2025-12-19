<x-layout title=" {{ $product->name }} ">
    <div class="container my-5">

        <div class="row">

            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/products_image/' . $product->image) }}" class="card-img-top p-3 rounded-5"
                        alt="Gambar {{ $product->name }}">
                </div>
            </div>

            <div class="col-lg-7">

                <h1 class="fs-1 fw-bold text-dark mb-2">{{ $product->name }}</h1>

                <hr>

                <div class="card shadow-sm border-light">
                    <h5 class="fs-5 text-secondary mb-3">Deskripsi Produk</h5>
                    <p class="fs-5 lead text-secondary">
                        {{ $product->description }}
                    </p>
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <div class="d-flex align-items-baseline mb-4">
                        <span class="fs-2 text-muted me-2">Harga:</span>
                        <span class="fs-2 fw-bolder text-success">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    </div>
                    <div>
                        <a href=" {{ route('products') }} " class="btn btn-secondary">KEMBALI</a>
                        @can('update', $product)
                            <a href=" {{ route('products.edit', $product->id) }} " class="btn btn-success">EDIT</a>
                        @endcan
                        @can('delete', $product)
                            <a href=" {{ route('products.delete', $product->id) }} " class="btn btn-danger">DELETE</a>
                        @endcan
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-layout>
