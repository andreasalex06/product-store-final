<x-layout title="FAQ - Bantuan">

    {{-- Custom CSS untuk Accordion yang lebih cantik --}}
    @push('styles')
    <style>
        .accordion-item {
            border: none;
            margin-bottom: 1rem;
            border-radius: 1rem !important;
            overflow: hidden;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .accordion-button {
            border-radius: 1rem !important;
            font-weight: 600;
            color: #212529;
            background-color: #fff;
            padding: 1.25rem;
        }

        .accordion-button:not(.collapsed) {
            color: #b48b00; /* Warna gelap dari kuning warning */
            background-color: #fffbf0; /* Kuning sangat muda */
            box-shadow: inset 0 -1px 0 rgba(0,0,0,.125);
        }

        .accordion-button:focus {
            box-shadow: none; /* Hilangkan border biru default */
            border-color: rgba(0,0,0,.125);
        }

        /* Ikon panah (chevron) custom warna */
        .accordion-button:not(.collapsed)::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23b48b00'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
        }
    </style>
    @endpush

    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 mb-3">Pertanyaan Umum</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
            <p class="text-muted mt-3 col-lg-6 mx-auto">
                Temukan jawaban atas pertanyaan yang paling sering diajukan mengenai layanan, produk, dan proses pemesanan kami.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- ACCORDION --}}
                <div class="accordion" id="faqAccordion">

                    {{-- FAQ 1 --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeadingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne"
                                aria-expanded="true" aria-controls="faqOne">
                                Bagaimana cara melakukan checkout?
                            </button>
                        </h2>
                        <div id="faqOne" class="accordion-collapse collapse show" aria-labelledby="faqHeadingOne"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted lh-lg">
                                Untuk melakukan checkout, silakan ikuti langkah berikut:
                                <ol class="mb-0 mt-2">
                                    <li>Pilih produk dan klik tombol <strong>"Tambah ke Keranjang"</strong>.</li>
                                    <li>Buka halaman keranjang (ikon keranjang di menu atas).</li>
                                    <li>Klik tombol <strong>"Checkout"</strong>.</li>
                                    <li>Lengkapi alamat pengiriman dan pilih metode pembayaran.</li>
                                    <li>Klik <strong>"Konfirmasi Pesanan"</strong> untuk menyelesaikan transaksi.</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 2 --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeadingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
                                Apakah saya akan menerima email setelah lupa password?
                            </button>
                        </h2>
                        <div id="faqTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted lh-lg">
                                <i class="fas fa-check-circle text-success me-2"></i><strong>Ya, tentu saja.</strong>
                                <br><br>
                                Setelah Anda mengajukan permintaan reset password, sistem kami akan mengirimkan email berisi tautan untuk mengatur ulang password Anda.
                                Pastikan untuk memeriksa folder <strong>Spam</strong> atau <strong>Junk</strong> jika Anda tidak melihat email di kotak masuk utama dalam waktu 5-10 menit.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 3 --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeadingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqThree" aria-expanded="false" aria-controls="faqThree">
                                Apakah saya bisa membatalkan pesanan setelah checkout?
                            </button>
                        </h2>
                        <div id="faqThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted lh-lg">
                                <strong>Ya, Anda dapat membatalkan pesanan selama pesanan tersebut belum diproses atau dikirim.</strong>
                                <br><br>
                                Untuk membatalkan pesanan, silakan ikuti langkah berikut:
                                <ol class="mb-0 mt-2">
                                    <li>Buka halaman <strong>"Riwayat Pembelian"</strong> di akun Anda.</li>
                                    <li>Pilih pesanan yang ingin dibatalkan.</li>
                                    <li>Klik tombol <strong>"Batalkan Pesanan"</strong> dan konfirmasi pembatalan.</li>
                                </ol>
                                Jika pesanan sudah dalam proses pengiriman, silakan hubungi layanan pelanggan kami untuk informasi lebih lanjut.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 4 --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqFour" aria-expanded="false" aria-controls="faqFour">
                                Bagaimana jika produk yang saya pesan tidak kunjung tiba?
                            </button>
                        </h2>
                        <div id="faqFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted lh-lg">
                                <strong>Kami mohon maaf atas ketidaknyamanan ini.</strong>
                                <br><br>
                                Jika produk Anda belum tiba dalam estimasi waktu pengiriman yang dijanjikan, silakan lakukan langkah berikut:
                                <ol class="mb-0 mt-2">
                                    <li>Periksa status pengiriman di halaman <strong>"Riwayat Pembelian"</strong>.</li>
                                    <li>Jika status menunjukkan bahwa pesanan telah dikirim tetapi belum diterima, silakan hubungi layanan pelanggan kami dengan menyertakan nomor pesanan Anda.</li>
                                    <li>Tim kami akan membantu melacak pesanan Anda dan memberikan solusi terbaik.</li>
                                </ol>
                                Kami berkomitmen untuk memastikan setiap pesanan sampai ke tangan Anda tepat waktu.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 5 --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faqHeadingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faqFive" aria-expanded="false" aria-controls="faqFive">
                                Apakah data saya aman?
                            </button>
                        </h2>
                        <div id="faqFive" class="accordion-collapse collapse" aria-labelledby="faqHeadingFive"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted lh-lg">
                                <strong>Keamanan adalah prioritas kami.</strong>
                                <br>
                                Kami menggunakan enkripsi password standar industri (Bcrypt), proteksi CSRF, dan validasi data yang ketat
                                untuk memastikan informasi pribadi dan transaksi Anda tetap aman di platform kami.
                            </div>
                        </div>
                    </div>

                </div>

                {{-- CONTACT CTA --}}
                <div class="bg-light rounded-4 p-4 mt-5 text-center border border-dashed">
                    <h5 class="fw-bold mb-2">Masih memiliki pertanyaan?</h5>
                    <p class="text-muted small mb-3">Jika Anda tidak menemukan jawaban yang Anda cari, silakan hubungi tim support kami.</p>
                    <a href="#" class="btn btn-warning px-4 fw-bold rounded-pill">
                        <i class="fas fa-envelope me-2"></i> Hubungi Kami
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>
