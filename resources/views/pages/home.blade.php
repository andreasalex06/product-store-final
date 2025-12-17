<x-layout title="Home">

    <div class="container mt-4">

        <div id="carouselExampleCaptions" class="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded-4 ratio ratio-21x9">
                <div class="carousel-item active">
                    <img src=" {{ asset('images/product1.jpg') }} " class="d-block w-100 carousel-img" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>New Iphone 17 Pro</h5>
                        <p>Produk terbaru dari Apple dengan spesifikasi terbaik.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/product2.jpg') }}" class="d-block w-100 carousel-img" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Canon GX7</h5>
                        <p>Menggunakan teknologi terdepan untuk hasil foto berkualitas tinggi.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/product3.jpg') }}" class="d-block w-100 carousel-img" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Macbook Air m4</h5>
                        <p>Dengan performa terbaik dan desain elegan.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
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
            ">
    </div>


    <div class="container konten-produk">

        {{-- Bagian Deskripsi Store --}}
        <div class="row align-items-center mb-5">

            {{-- Image --}}
            <div class="col-12 col-md-5 text-center mb-4 mb-md-0" style="max-width: 400px; margin: 0 auto;">
                <img src="{{ asset('images/hehe.png') }}" class="img-fluid" alt="Ilustrasi platform"
                    style="object-fit: contain;">
            </div>

            {{-- Text --}}
            <div class="col-12 col-md-7">
                <p class="lead fw-semibold text-muted text-center text-md-start p-4">
                    Kami hadir sebagai platform manajemen produk terintegrasi yang membantu Anda melacak,
                    mengelola, dan menampilkan inventaris dengan mudah.
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
                    <p class="card-text text-muted">Filter produk berdasarkan harga, nama, dan kategori secara instan.
                    </p>
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
            <a href="{{ route('products') }}" class="btn btn-warning btn-lg shadow-lg">Mulai Cari Sekarang <i
                    class="fa-solid fa-magnifying-glass"></i></a>
        </div>

    </div>

</x-layout>
