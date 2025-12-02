{{-- File ini secara otomatis menerima variabel $product --}}

<div class="card shadow-sm h-100">

    <img src="{{ asset('images/product.jpg') }}" class="card-img-top" alt="Gambar {{ $product->name }}"
        style="object-fit: cover; height: 200px;">

    <div class="card-body d-flex flex-column">

        <div class="d-flex justify-content-between">
            <h5 class="card-title text-primary">{{ $product->name }}</h5>
            <span> {{ $product->category->name }} </span>

        </div>

        <h4 class="card-subtitle mb-2 text-danger">
            Rp {{ number_format($product->price, 0, ',', '.') }}
        </h4>

        <p class="card-text text-muted mb-4 flex-grow-1">
            {{ Str::limit($product->description, 50) }}
        </p>



        <div class="mt-auto d-flex gap-1">
            <a href="{{ route('products.show', ['id' => $product->id]) }}" class="btn btn-secondary ">Detail</a>

            <a class="text-decoration-none btn btn-success"
                href=" {{ route('products.edit', ['id' => $product->id]) }} ">Edit</a>

            <form action=" {{ route('products.delete', ['id' => $product->id]) }} " method="POST">
                @csrf
                <button type="submit" onclick=" return confirm('apakah anda yakin ingin mengapus produk?')"
                    class="btn btn-danger">Delete</button>
            </form>


        </div>
    </div>

</div>
