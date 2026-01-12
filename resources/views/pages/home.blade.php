<x-layout title="Home">
    {{-- Custom CSS --}}
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <style>
            /* Modern Gradient & Utilities */
            :root {
                --primary-gold: #ffc400;
                --dark-overlay: rgba(0, 0, 0, 0.6);
            }

            /* Glassmorphism Effect */
            .glass-card {
                background: rgba(33, 37, 41, 0.85);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .glass-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5) !important;
                border-color: var(--primary-gold);
            }

            .text-shadow-strong {
                text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            }

            /* --- SWIPER CSS --- */
            .swiper-wrapper {
                transition-timing-function: linear !important;
                /* WAJIB: Agar jalan mulus */
            }

            .partner-section {
                background: #fff;
                position: relative;
                overflow: hidden;
                width: 100%;
                /* Full Width */
            }

            .partner-logo {
                width: 140px;
                height: 70px;
                object-fit: contain;
                filter: grayscale(100%) opacity(0.5);
                transition: all 0.3s ease;
            }

            .partner-logo:hover {
                filter: grayscale(0%) opacity(1);
                transform: scale(1.1);
            }

            .swiper-slide {
                width: auto;
                display: flex;
                justify-content: center;
                align-items: center;
            }
        </style>
    @endpush

    {{-- HERO SECTION --}}
    <header class="position-relative w-100 overflow-hidden d-flex align-items-center"
        style="min-height: 60vh; background-image: url('{{ asset('images/hero.jpg') }}'); background-size: cover; background-position: center;">

        {{-- Overlay --}}
        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: linear-gradient(to right, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 50%, rgba(0,0,0,0.2) 100%); z-index: 1;">
        </div>

        {{-- Content --}}
        <div class="container position-relative z-2 py-5">
            <div class="row align-items-center justify-content-center justify-content-md-start">
                {{--
                PERUBAHAN RESPONSIF:
                1. col-lg-8: Memberikan ruang lebih di laptop kecil agar teks tidak terlalu turun.
                2. px-3: Padding kiri-kanan agar teks tidak mentok layar di HP.
            --}}
                <div
                    class="col-12 col-md-10 col-lg-8 col-xl-7 mx-auto mx-md-0 text-center text-md-start text-white px-3 px-md-0">

                    <span class="d-inline-block py-1 px-3 rounded-pill bg-light text-dark fw-bold mb-3 shadow-sm fs-6">
                        <i class="fas fa-certificate me-2"></i>Supplier Ikan Segar No. 1
                    </span>

                    {{--
                    PERUBAHAN FONT:
                    Mengubah batas bawah clamp dari 2.5rem ke 2rem agar aman di layar HP kecil (320px).
                --}}
                    <h1 class="fw-bolder mb-3 lh-1 text-warning text-shadow"
                        style="font-size: clamp(2rem, 5vw, 4.5rem);">
                        {!! $settings['hero_title'] ??
                            'Kualitas Ikan Terbaik <br> <span class="text-warning fst-italic">Langsung ke Dapurmu</span>' !!}
                    </h1>

                    <p class="lead mb-4 opacity-90 fw-light text-shadow fs-6 fs-md-5 mx-auto mx-md-0"
                        style="max-width: 550px;">
                        {{ $settings['hero_desc'] ?? 'Kami menghadirkan kesegaran laut Indonesia langsung ke depan pintu Anda dengan standar kualitas tertinggi dan pengiriman instan.' }}
                    </p>

                    {{--
                    PERUBAHAN TOMBOL:
                    w-100 w-sm-auto: Di HP tombol full width, di Tablet ke atas ukurannya menyesuaikan teks.
                --}}
                    <div
                        class="d-flex flex-column flex-sm-row gap-3 justify-content-center justify-content-md-start mb-2">
                        <a href="{{ route('products.index') }}"
                            class="btn btn-warning btn-lg fw-bold px-4 py-2 rounded-pill shadow-lg w-100 w-sm-auto">
                            <i class="fas fa-shopping-cart me-2"></i> Belanja Sekarang
                        </a>

                        <a href="#about"
                            class="btn btn-outline-light btn-lg fw-bold px-4 py-2 rounded-pill w-100 w-sm-auto">
                            Pelajari Kami
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <div class="container py-2 my-3">

        {{-- KEUNGGULAN --}}
        <div class="text-center mb-5" id="about">
            <h2 class="fw-bold display-6">{{ $settings['why_title'] ?? 'Mengapa Memilih Kami?' }}</h2>
            <div class="mx-auto mt-3" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;">
            </div>
        </div>

        <div class="row g-4 pb-5">
            {{-- Feature 1 --}}
            <div class="col-md-4">
                <div class="card glass-card bg-dark h-100 p-4 text-center border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-4"
                            style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-box fa-2xl"></i>
                        </div>
                        <h4 class="card-title text-white fw-bold mb-3">
                            {{ $settings['feature_1_title'] ?? 'Stok Real-Time' }}</h4>
                        <p class="card-text text-white-50">
                            {{ $settings['feature_1_desc'] ?? 'Sistem inventaris canggih memastikan Anda selalu mendapatkan informasi ketersediaan stok yang akurat.' }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- Feature 2 --}}
            <div class="col-md-4">
                <div class="card glass-card bg-dark h-100 p-4 text-center border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-4"
                            style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-truck-fast fa-2xl"></i>
                        </div>
                        <h4 class="card-title text-white fw-bold mb-3">
                            {{ $settings['feature_2_title'] ?? 'Pengiriman Instan' }}</h4>
                        <p class="card-text text-white-50">
                            {{ $settings['feature_2_desc'] ?? 'Armada logistik kami siap mengantar pesanan ikan segar langsung ke depan pintu Anda dalam hitungan jam.' }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- Feature 3 --}}
            <div class="col-md-4">
                <div class="card glass-card bg-dark h-100 p-4 text-center border-0 rounded-4">
                    <div class="card-body">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-circle mb-4"
                            style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-headset fa-2xl"></i>
                        </div>
                        <h4 class="card-title text-white fw-bold mb-3">
                            {{ $settings['feature_3_title'] ?? 'Layanan Prioritas' }}</h4>
                        <p class="card-text text-white-50">
                            {{ $settings['feature_3_desc'] ?? 'Tim support kami berdedikasi 24/7 untuk memastikan pengalaman belanja Anda menyenangkan.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- VISI & MISI --}}
        <div class="text-center mb-5" id="about">
            <h2 class="fw-bold display-6">Visi & Misi</h2>
            <div class="mx-auto mt-3" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;">
            </div>
        </div>

        <div class="row g-0 rounded-4 overflow-hidden shadow-lg mb-5 my-5">
            <div class="col-lg-5 position-relative d-none d-lg-block" style="min-height: 400px;">
                <img src="{{ asset('images/visi-misi.jpg') }}" alt="Visi Misi"
                    class="w-100 h-100 object-fit-cover position-absolute top-0 start-0">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-warning opacity-25"></div>
            </div>
            <div class="col-lg-7 bg-dark text-white p-5 d-flex flex-column justify-content-center position-relative">
                <i class="fas fa-quote-right position-absolute text-warning opacity-10"
                    style="top: 30px; right: 40px; font-size: 4rem;"></i>
                <div class="position-relative z-1">
                    <div class="mb-5">
                        <span class="badge bg-warning text-dark mb-2">Visi Kami</span>
                        <h3 class="fw-bold mb-3">{{ $settings['visi_title'] ?? 'Menjadi Pilihan Utama' }}</h3>
                        <p class="text-white-50 lh-lg">
                            {{ $settings['visi_text'] ?? 'Menjadi pemimpin pasar dalam penyediaan hasil laut berkualitas tinggi.' }}
                        </p>
                    </div>
                    <hr class="border-secondary opacity-50 my-4">
                    <div>
                        <span class="badge bg-warning border border-warning text-dark mb-2">Misi Kami</span>
                        <h3 class="fw-bold mb-3">{{ $settings['misi_title'] ?? 'Melayani Sepenuh Hati' }}</h3>
                        <p class="text-white-50 lh-lg">
                            {{ $settings['misi_text'] ?? 'Memberikan pelayanan prima dan menjaga kualitas produk terbaik.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div> {{-- <<< PENUTUP CONTAINER UTAMA (PENTING!) --}}


    {{-- PARTNER SECTION (Ditaruh DI LUAR Container utama agar bisa Full Width) --}}
    <div class="partner-section py-2">
        <div class="container text-center mb-4">
            <h5 class="text-muted fw-bold text-uppercase ls-2">Dipercaya Oleh Partner Kami</h5>
        </div>

        <div class="swiper partnerSwiper" style="width: 100%; padding: 20px 0;">
            <div class="swiper-wrapper">
                @if (isset($partners) && $partners->count() > 0)
                    @php
                        $displayPartners = collect();
                        // Logic Loop Aman
                        for ($i = 0; $i < 10; $i++) {
                            $displayPartners = $displayPartners->concat($partners);
                            if ($displayPartners->count() >= 20) {
                                break;
                            }
                        }
                    @endphp

                    @foreach ($displayPartners as $partner)
                        <div class="swiper-slide">
                            <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ $partner->name }}"
                                class="partner-logo">
                        </div>
                    @endforeach
                @else
                    <div class="swiper-slide w-100"><span class="text-muted">Belum ada partner.</span></div>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var swiper = new Swiper(".partnerSwiper", {
                    loop: true,
                    speed: 3000,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: false
                    },
                    slidesPerView: 2,
                    spaceBetween: 30,
                    breakpoints: {
                        640: {
                            slidesPerView: 3,
                            spaceBetween: 30
                        },
                        768: {
                            slidesPerView: 4,
                            spaceBetween: 40
                        },
                        1024: {
                            slidesPerView: 6,
                            spaceBetween: 50
                        },
                    },
                    allowTouchMove: false,
                });
            });
        </script>
    @endpush
</x-layout>
