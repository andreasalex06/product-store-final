<x-layout title="Checkout">

    <div class="container p-3 mt-4 mb-4">

        <div class="border p-3 border-2 rounded-3">

            <h3 class="mb-3">Checkout</h3>

            {{-- FORM CHECKOUT --}}
            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf

                {{-- Alamat --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat Pengiriman</label>
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="3" required>{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Telepon --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Telepon</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                        value="{{ old('phone') }}" required>
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Metode Pembayaran --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                    <select name="payment_method" class="form-select" required>
                        <option value="">Pilih metode…</option>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cod">COD (Bayar di tempat)</option>
                        <option value="ewallet">E-Wallet (Dana/OVO/GoPay)</option>
                    </select>
                </div>

                {{-- RINGKASAN ORDER --}}
                <div class="p-3 bg-light rounded mb-3">
                    <h5>Ringkasan Pesanan</h5>
                    <p>Total Produk: <strong>{{ $cart->items->count() }}</strong></p>
                    <p>Total Pembayaran:
                        <strong>
                            Rp {{ number_format($cart->total(), 0, ',', '.') }}
                        </strong>
                    </p>
                </div>

                <button class="btn btn-success w-100">Proses Checkout</button>

            </form>
        </div>

    </div>

</x-layout>
