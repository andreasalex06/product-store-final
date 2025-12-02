<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $title ?? 'Andre' }} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="..." crossorigin="anonymous" />
</head>

<body>

    {{-- navigasi --}}
    <nav class="sticky-top navbar navbar-expand-lg bg-light">
        <div class="container-fluid px-5">
            <a class="navbar-brand" href=" {{ route('home') }} ">Andre</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href=" {{ route('home') }} ">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('products') }} ">Product</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href=" {{ route('products.create') }} ">Tambah Product</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    {{ $slot }}

    <footer class="bg-dark text-white mt-5 pt-5 pb-4">
        <div class="container text-center text-md-left">

            <div class="row text-center text-md-left">

                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-primary">Andre Dev</h5>
                    <p class="text-secondary">
                        Menyediakan solusi teknologi terdepan untuk membantu bisnis Anda bertumbuh dan berkembang
                        di era digital.
                    </p>
                    <div class="social-links mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin-in fa-lg"></i></a>
                    </div>
                </div>
                <hr class="w-100 clearfix d-md-none">

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-white">Produk</h5>
                    <p>
                        <a href="#" class="text-white" style="text-decoration: none;">Web Development</a>
                    </p>
                    <p>
                        <a href="#" class="text-white" style="text-decoration: none;">Accounting</a>
                    </p>
                    <p>
                        <a href="#" class="text-white" style="text-decoration: none;">UI/UX</a>
                    </p>
                    <p>
                        <a href="#" class="text-white" style="text-decoration: none;">Pricing</a>
                    </p>
                </div>
                <hr class="w-100 clearfix d-md-none">

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-white">Perusahaan</h5>
                    <p>
                        <a href="#" class="text-white" style="text-decoration: none;">Tentang Kami</a>
                    </p>
                </div>
                <hr class="w-100 clearfix d-md-none">

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4 font-weight-bold text-white">Kontak</h5>
                    <p>
                        <i class="fas fa-home mr-3 text-secondary"></i> Jakarta, Indonesia
                    </p>
                    <p>
                        <i class="fas fa-envelope mr-3 text-secondary"></i> andreasalexyz@gmail.com
                    </p>
                    <p>
                        <i class="fas fa-phone mr-3 text-secondary"></i> +62 8999999367
                    </p>
                </div>
            </div>

            <hr class="mb-4 bg-secondary">

            <div class="row align-items-center justify-content-center">
                <div class="d-flex justify-content-center col-md-7 col-lg-8">
                    <p class="text-center text-md-start">
                        Hak Cipta ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="#" style="text-decoration: none;">
                            <strong class="text-primary">AndreDev</strong>
                        </a>. Semua hak dilindungi.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</body>

</html>
