<x-layout title="Keranjang Belanja">

<div class="container py-4">

    <h2 class="mb-4">Keranjang Belanja</h2>

    {{-- Jika cart kosong --}}
    @if ($cart->items->isEmpty())
        <div class="alert alert-info">
            Keranjang kamu masih kosong.
        </div>
        <a href="{{ route('products') }}" class="btn btn-primary">Belanja Sekarang</a>
    @else

        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($cart->items as $item)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('storage/products_image/' . $item->product->image) }}"
                                         style="width: 60px; height: 60px; object-fit:cover;"
                                         class="rounded">
                                    <span>{{ $item->product->name }}</span>
                                </div>
                            </td>

                            <td>Rp {{ number_format($item->price_at_purchase, 0, ',', '.') }}</td>

                            <td>
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex gap-2">
                                    @csrf
                                    @method('PUT')

                                    <input type="number"
                                           name="quantity"
                                           class="form-control"
                                           style="width: 70px;"
                                           min="1"
                                           value="{{ $item->quantity }}">

                                    <button class="btn btn-sm btn-primary">Update</button>
                                </form>
                            </td>

                            <td>
                                Rp {{ number_format($item->quantity * $item->price_at_purchase, 0, ',', '.') }}
                            </td>

                            <td>
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Hapus item ini?')">X</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{-- Total --}}
        <div class="mt-4 p-3 bg-light rounded">
            <h4>Total: <strong>Rp {{ number_format($cart->total(), 0, ',', '.') }}</strong></h4>
        </div>

        <a href="{{ route('checkout.index') }}" class="btn btn-success mt-3">
            Lanjut ke Checkout
        </a>

    @endif
</div>

</x-layout>
