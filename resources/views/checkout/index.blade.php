<x-layout title="Checkout">
    <style>
        /* --- CSS ASLI ANDA (TIDAK DIUBAH) --- */
        .qty-container {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 2px;
            width: fit-content;
        }

        .qty-btn {
            width: 28px;
            height: 28px;
            border: none;
            background: #f8f9fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            color: #333;
        }

        .qty-btn:hover {
            background: #e9ecef;
            color: #000;
        }

        .qty-input {
            width: 40px;
            border: none;
            background: transparent;
            text-align: center;
            font-weight: bold;
            font-size: 0.85rem;
            outline: none;
        }

        .qty-input::-webkit-outer-spin-button,
        .qty-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Form Modern Styling */
        .form-modern {
            border: 1px solid #ced4da;
            border-radius: 10px !important;
            padding: 0.75rem 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-modern:focus {
            border-color: #ffc107;
            box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.15);
        }

        .checkout-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            background: #fff;
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
        }

        .dashed-line {
            border-top: 2px dashed #e9ecef;
            margin: 1.5rem 0;
        }

        /* --- TAMBAHAN KECIL UNTUK ERROR AGAR RAPI --- */
        /* Memastikan border merah muncul saat error */
        .is-invalid {
            border-color: #dc3545 !important;
        }
        /* Style teks error di bawah input */
        .invalid-feedback {
            font-size: 0.85rem;
            margin-top: 0.25rem;
            color: #dc3545;
            display: block; /* Pastikan muncul */
        }
    </style>

    <div class="container my-5">
        <div class="mb-5 text-center">
            <h1 class="fw-bold h2">Penyelesaian Pesanan</h1>
            <p class="text-muted">Lengkapi detail pengiriman dan periksa kembali pesanan Anda.</p>
        </div>

        <div class="row g-4 justify-content-center">
            {{-- KOLOM KIRI: INFORMASI PENGIRIMAN --}}
            <div class="col-lg-7 ">
                <div class="card checkout-card p-4 bg-secondary bg-opacity-10">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        Informasi Pengiriman
                    </h5>

                    <form action="{{ route('checkout.process') }}" method="POST" id="main-form">
                        @csrf
                        @if (isset($product))
                            <input type="hidden" name="direct_product_id" value="{{ $product->id }}">
                        @endif

                        {{-- ALAMAT --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-muted text-uppercase">Alamat Lengkap</label>
                            {{-- Validasi Address --}}
                            <textarea name="address"
                                      class="form-control bg-light form-modern @error('address') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Masukkan alamat pengiriman lengkap...">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- PHONE --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">Nomor WhatsApp</label>
                                {{-- Validasi Phone --}}
                                <input type="number" name="phone"
                                       class="form-control bg-light form-modern @error('phone') is-invalid @enderror"
                                       value="{{ old('phone') }}" placeholder="0812xxxx">
                                @error('phone')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- PAYMENT METHOD --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label small fw-bold text-muted text-uppercase">Metode Pembayaran</label>
                                {{-- Validasi Payment --}}
                                <select name="payment_method" class="form-select bg-light form-modern cursor-pointer @error('payment_method') is-invalid @enderror">
                                    <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank Mandiri</option>
                                    <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>COD (Bayar di Tempat)</option>
                                </select>
                                @error('payment_method')
                                    <div class="invalid-feedback fw-bold">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="dashed-line"></div>

                        <h5 class="fw-bold mb-4">Item Pesanan</h5>

                        {{-- Validasi Error Global (Stok Habis/Dll) --}}
                        @if(session('error'))
                            <div class="alert alert-danger border-0 rounded-3 mb-3 small">
                                <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                            </div>
                        @endif

                        <div class="list-group rounded-3 list-group-flush">
                            @foreach ($items as $item)
                                @php $currentQty = old('items.'.$item->product->id.'.quantity', $item->quantity); @endphp
                                <div class="list-group-item p-2 border-0 mb-3 product-row">
                                    <div class="d-flex gap-3">
                                        <img src="{{ asset('storage/products_image/' . $item->product->image) }}" class="product-img">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between">
                                                <h6 class="fw-bold mb-1 text-dark">{{ $item->product->name }}</h6>
                                                <span class="fw-bold item-subtotal">
                                                    Total : Rp {{ number_format($item->product->price * $currentQty, 0, ',', '.') }}
                                                </span>
                                            </div>
                                            <p class="text-muted small mb-2">Rp {{ number_format($item->product->price, 0, ',', '.') }} / Kg</p>

                                            <div class="qty-container">
                                                <button type="button" class="qty-btn minus-btn"><i class="fas fa-minus"></i></button>
                                                <input type="number" name="items[{{ $item->product->id }}][quantity]"
                                                    class="qty-input" data-id="{{ $item->product->id }}"
                                                    data-price="{{ $item->product->price }}"
                                                    value="{{ $currentQty }}" min="1" readonly>
                                                <button type="button" class="qty-btn plus-btn"><i class="fas fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </form>
                </div>
            </div>

            {{-- KOLOM KANAN: RINGKASAN --}}
            <div class="col-lg-4 ">
                <div class="card checkout-card p-4 sticky-top bg-secondary bg-opacity-10 " style="top: 2rem; z-index: 10;">
                    <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-muted text-uppercase">Kode Promo</label>

                        @if (session('success'))
                            <div class="alert alert-success border-0 small py-2 rounded-3 mb-3">
                                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('coupon.apply') }}" method="POST" id="coupon-form">
                            @csrf
                            <div id="hidden-qty-container"></div>
                            <div class="input-group">
                                {{-- Validasi Kupon --}}
                                <input type="text" name="coupon_code"
                                    class="form-control bg-light border-0 rounded-start-3 py-2 @error('coupon_code') is-invalid @enderror"
                                    placeholder="Masukkan kode..." value="{{ session('coupon_code') }}"
                                    style="border-radius: 10px 0 0 10px !important;">
                                <button type="button" onclick="submitAction('apply')" class="btn btn-dark px-3 fw-bold"
                                    style="border-radius: 0 10px 10px 0 !important;">Cek</button>
                            </div>
                            @error('coupon_code')
                                <div class="text-danger small mt-1 fw-bold">{{ $message }}</div>
                            @enderror
                        </form>

                        @if (session('coupon'))
                            <div class="mt-3 p-3 bg-light border rounded-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-success d-block fw-bold">KUPON TERPASANG</small>
                                    <span class="fw-bold text-dark">{{ session('coupon')['code'] }}</span>
                                </div>
                                <button type="button" onclick="submitAction('remove')"
                                    class="btn btn-sm btn-outline-danger px-3 rounded-pill fw-bold">Hapus</button>
                            </div>
                        @endif
                    </div>

                    <div class="bg-light p-3 rounded-4 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small fw-bold">Subtotal</span>
                            <span class="fw-bold" id="display-subtotal">Rp {{ number_format(session('coupon')['last_total'] ?? $total, 0, ',', '.') }}</span>
                        </div>
                        @if (session('coupon'))
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small fw-bold">Diskon</span>
                                <span class="text-success fw-bold" id="display-discount"
                                    data-discount="{{ session('coupon')['discount'] }}">- Rp {{ number_format(session('coupon')['discount'], 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">Total Akhir</span>
                            <h4 class="fw-bold mb-0" id="display-total-akhir">
                                Rp {{ number_format((session('coupon')['last_total'] ?? $total) - (session('coupon')['discount'] ?? 0), 0, ',', '.') }}
                            </h4>
                        </div>
                    </div>

                    <button type="submit" form="main-form"
                        class="btn btn-warning w-100 py-3 fw-bold rounded-4 shadow-sm text-uppercase">
                        Bayar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT ASLI (TIDAK DIUBAH) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.qty-container').forEach(container => {
                const input = container.querySelector('.qty-input');
                const plusBtn = container.querySelector('.plus-btn');
                const minusBtn = container.querySelector('.minus-btn');

                plusBtn.addEventListener('click', () => {
                    input.value = parseInt(input.value) + 1;
                    updateUI();
                });
                minusBtn.addEventListener('click', () => {
                    if (input.value > 1) {
                        input.value = parseInt(input.value) - 1;
                        updateUI();
                    }
                });
            });

            function updateUI() {
                let grandTotal = 0;
                document.querySelectorAll('.qty-input').forEach(i => {
                    const price = parseFloat(i.dataset.price);
                    const qty = parseInt(i.value) || 0;
                    const sub = price * qty;
                    grandTotal += sub;

                    const row = i.closest('.product-row');
                    row.querySelector('.item-subtotal').innerText = 'Rp ' + sub.toLocaleString('id-ID');
                });

                document.getElementById('display-subtotal').innerText = 'Rp ' + grandTotal.toLocaleString('id-ID');
                const disc = parseFloat(document.getElementById('display-discount')?.dataset.discount || 0);
                document.getElementById('display-total-akhir').innerText = 'Rp ' + Math.max(0, grandTotal - disc)
                    .toLocaleString('id-ID');
            }
        });

        function submitAction(type) {
            const form = document.getElementById('coupon-form');
            const container = document.getElementById('hidden-qty-container');
            container.innerHTML = '';
            form.action = type === 'apply' ? "{{ route('coupon.apply') }}" : "{{ route('coupon.remove') }}";

            document.querySelectorAll('.qty-input').forEach(input => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = `items[${input.dataset.id}][quantity]`;
                hiddenInput.value = input.value;
                container.appendChild(hiddenInput);
            });
            form.submit();
        }
    </script>
</x-layout>
