<div class="card shadow-sm h-100">

    <div class="ratio ratio-1x1 position-relative">
        <div class="position-absolute position-relative z-3 d-flex justify-content-end align-items-end">
            <span class="badge bg-secondary position-absolute mb-2 me-2">{{ $product->category->name }}</span>
        </div>
        <img loading="lazy" src="{{ asset('storage/products_image/' . $product->image) }}" class="card-img-top"
            alt="Gambar {{ $product->name }}" style="object-fit: cover;">
    </div>

    <div class="card-body d-flex flex-column">

        <div class="d-flex justify-content-between column align-items-center">
            <p class="card-title">{{ $product->name }}</p>

        </div>

        <p class="card-subtitle text-danger">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>

        <p class="card-text text-muted flex-grow-1">
            {{ Str::limit($product->description, 50) }}
        </p>

        <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('products.show', ['id' => $product->id]) }}"
                class="btn btn-sm rounded-3"><i class="fa-solid fa-info"></i></a>

            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="">
                @csrf
                <button type="submit" class="btn btn-sm rounded-3">
                    <i class="fa-solid fa-basket-shopping"></i>
                </button>
            </form>

            @auth
                <a class="text-decoration-none btn btn-sm rounded-3"
                    href=" {{ route('products.edit', ['id' => $product->id]) }} "><i class="fa-solid fa-pen-to-square"></i></a>

                <form action=" {{ route('products.delete', ['id' => $product->id]) }} " method="POST">
                    @csrf
                    <button type="submit" onclick=" return confirm('apakah anda yakin ingin mengapus produk?')"
                        class="btn btn-sm rounded-3"><i class="fa-solid fa-trash"></i></button>
                </form>
            @endauth

        </div>
    </div>

</div>
