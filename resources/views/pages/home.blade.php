<x-layout title="Home">

    <div class="container mt-4">

        {{-- Jumbotron / Hero Section --}}
        <div class="mb-4 rounded-3 d-flex flex-wrap overflow-hidden" style="min-height: 400px;">

            <div class="col-md-6 col-12"
                style="
                    background: url('{{ asset('images/banner.jpg') }}') no-repeat center center;
                    background-size: cover;
                    min-height: 250px;
                ">
            </div>

            <div class="col-md-6 col-12 p-5 d-flex align-items-center bg-success text-white">

                <div class="py-3 py-md-0">

                    <h1 class="display-5 fw-bold">Selamat Datang di Toko Produk Kami!</h1>

                    <p class="fs-5">
                        Telusuri koleksi produk terbaik kami. Website ini dirancang untuk memantau stok barang yang tersedia,
                        dan dilengkapi dengan fitur filter canggih yang mampu melihat produk berdasarkan harga, kategori, atau urutan nama produk.
                    </p>

                    <a href="{{ route('products') }}" class="btn btn-light btn-lg">Lihat Semua Produk</a>

                </div>
            </div>
        </div>

    </div>

    <div class="container mb-3 d-flex flex-column align-items-center justify-content-center">
        <h4 class="mt-4">Mengapa Memilih Kami?</h4>
        <hr
            style="
                width: 70px;
                height: 3px;
                background-color: #000000;
                border: none;
                margin-top: 5px;
                margin-bottom: 30px; /* Jarak lebih besar ke konten di bawah */
                opacity: 1;
            "
        >
    </div>


    <div class="container konten-produk">

        {{-- Bagian Deskripsi Store --}}
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <p class="lead text-muted">
                    Kami hadir sebagai platform manajemen produk terintegrasi yang membantu Anda melacak, mengelola, dan menampilkan inventaris Anda dengan mudah.
                    Fokus utama kami adalah akurasi stok dan kemudahan pencarian, sehingga Anda selalu tahu apa yang Anda miliki dan pelanggan Anda dapat menemukan apa yang mereka cari dengan cepat.
                </p>
            </div>
        </div>

        {{-- Bagian Fitur Utama / Statistik --}}
        <div class="row text-center mb-5">

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 p-4 border-0">
                    <i class="fas fa-boxes fa-3x text-success mb-3"></i>
                    <h5 class="card-title fw-bold">Stok Real-Time</h5>
                    <p class="card-text text-muted">Pemantauan inventaris yang selalu terbarukan dan akurat.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 p-4 border-0">
                    <i class="fas fa-search-dollar fa-3x text-primary mb-3"></i>
                    <h5 class="card-title fw-bold">Filter Cepat</h5>
                    <p class="card-text text-muted">Filter produk berdasarkan harga, nama, dan kategori secara instan.</p>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100 p-4 border-0">
                    <i class="fas fa-layer-group fa-3x text-warning mb-3"></i>
                    <h5 class="card-title fw-bold">Kategori Terstruktur</h5>
                    <p class="card-text text-muted">Produk diorganisir dalam kategori yang jelas dan mudah diakses.</p>
                </div>
            </div>

        </div>

        <div class="text-center mt-5 mb-5">
            <h2 class="fw-bold">Siap Mencari Produk Terbaik?</h2>
            <p class="lead mb-4">Jelajahi seluruh katalog produk kami dan temukan apa yang Anda butuhkan.</p>
            <a href="{{ route('products') }}" class="btn btn-success btn-lg shadow-lg">Mulai Cari Sekarang →</a>
        </div>

    </div>

</x-layout>
