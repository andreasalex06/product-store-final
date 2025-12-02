<x-layout title="home">

    <div class="container mt-4">
        {{-- Hapus bg-success dari container luar agar konten lain tidak terpengaruh --}}

        {{-- Jumbotron Utama: Flex container yang menampung 2 kolom 50% --}}
        <div class="mb-4 rounded-3 d-flex flex-wrap overflow-hidden" style="min-height: 400px;">
            {{-- Hapus padding: 0 !important; agar padding internal col-md-6 bekerja --}}

            {{-- Kolom Kiri: Gambar (50% Desktop, 100% Mobile) --}}
            <div class="col-md-6 col-12"
                style="
                    background: url('{{ asset('images/banner.jpg') }}') no-repeat center center;
                    background-size: cover;
                    /* Mengatur tinggi gambar di mobile/kecil (wajib agar gambar terlihat) */
                    min-height: 250px;
                ">
                {{-- Div ini dibiarkan kosong --}}
            </div>

            {{-- Kolom Kanan: Konten Teks (50% Desktop, 100% Mobile) --}}
            <div class="col-md-6 col-12 p-5 d-flex align-items-center bg-success text-white">
                {{-- Gunakan bg-success di sini dan text-white --}}

                {{-- Konten Jumbotron --}}
                <div class="py-3 py-md-0">

                    <h1 class="display-5 fw-bold">Website Product Store</h1>

                    <p class="fs-5">
                        Website ini dibuat untuk memantau stok barang yang tersedia, memiliki filter yang mampu melihat
                        stok produk berdasarkan harga atau urutan huruf.
                    </p>

                    <a href="{{ route('products') }}" class="btn btn-light btn-lg">Lihat Produk</a>

                </div>
            </div>
        </div>
        {{-- Akhir Jumbotron --}}

    </div>

</x-layout>
