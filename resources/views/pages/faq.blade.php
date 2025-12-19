<x-layout title="FAQ">
    <div class="container py-5 col-7">
        <h2 class="mb-4 text-center">Frequently Asked Questions</h2>

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
                    <div class="accordion-body">
                        Untuk melakukan checkout, tambahkan produk ke keranjang,
                        lalu buka halaman keranjang dan klik tombol <strong>Checkout</strong>.
                        Lengkapi alamat dan metode pembayaran, kemudian konfirmasi pesanan.
                    </div>
                </div>
            </div>

            {{-- FAQ 2 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeadingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
                        Apakah saya akan menerima email setelah checkout?
                    </button>
                </h2>
                <div id="faqTwo" class="accordion-collapse collapse" aria-labelledby="faqHeadingTwo"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Ya. Setelah checkout berhasil, sistem akan otomatis
                        mengirimkan email berisi <strong>invoice pembelian</strong>
                        ke alamat email yang terdaftar.
                    </div>
                </div>
            </div>

            {{-- FAQ 3 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeadingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqThree" aria-expanded="false" aria-controls="faqThree">
                        Apakah saya bisa mengedit atau menghapus produk?
                    </button>
                </h2>
                <div id="faqThree" class="accordion-collapse collapse" aria-labelledby="faqHeadingThree"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Produk hanya dapat diedit atau dihapus oleh
                        <strong>user yang membuat produk tersebut</strong>.
                        Hal ini dijaga menggunakan sistem authorization (Policy).
                    </div>
                </div>
            </div>

            {{-- FAQ 4 --}}
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeadingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#faqFour" aria-expanded="false" aria-controls="faqFour">
                        Bagaimana jika email invoice tidak masuk?
                    </button>
                </h2>
                <div id="faqFour" class="accordion-collapse collapse" aria-labelledby="faqHeadingFour"
                    data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        Silakan periksa folder <em>Spam</em>.
                        Jika masih tidak ada, pastikan alamat email benar
                        atau hubungi admin melalui halaman kontak.
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
                    <div class="accordion-body">
                        Ya. Kami menjaga keamanan data pengguna dengan sistem
                        autentikasi, validasi, dan penyimpanan data yang aman
                        sesuai standar aplikasi web modern.
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
