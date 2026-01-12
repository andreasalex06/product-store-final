<x-layout title="Forum Diskusi">
    <div class="container py-5">

        {{-- HEADER SECTION --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 mb-3">Forum Diskusi</h1>
            <div class="mx-auto" style="width: 80px; height: 4px; background-color: #ffc400; border-radius: 2px;"></div>
            <p class="text-muted mt-3 col-lg-6 mx-auto">
                Punya pertanyaan seputar produk atau layanan kami? Tanyakan di sini dan Admin kami akan segera menjawabnya.
            </p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- FORM BUAT PERTANYAAN --}}
                @auth
                    <div class="card shadow-sm border-0 rounded-4 mb-5 overflow-hidden">
                        <div class="card-header bg-warning bg-opacity-10 py-3">
                            <h6 class="fw-bold m-0 text-dark"><i class="fas fa-pen-to-square me-2"></i>Buat Pertanyaan Baru</h6>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('discussions.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-bold text-muted">Judul Pertanyaan</label>
                                    <input type="text" name="subject" class="form-control rounded-3"
                                           placeholder="Contoh: Kapan stok Ikan Mas tersedia kembali?" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label small fw-bold text-muted">Detail Pertanyaan</label>
                                    <textarea name="question" class="form-control rounded-3" rows="4"
                                              placeholder="Jelaskan detail pertanyaan Anda di sini..." required></textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold shadow-sm">
                                        <i class="fas fa-paper-plane me-2"></i> Kirim Pertanyaan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- GUEST CTA --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-5 bg-primary bg-opacity-10">
                        <div class="card-body p-4 text-center">
                            <div class="mb-3">
                                <i class="fas fa-user-lock fa-2x text-primary opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-dark">Ingin bertanya?</h5>
                            <p class="text-muted small mb-3">Silakan login terlebih dahulu untuk membuat pertanyaan baru di forum.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm">
                                Login Sekarang
                            </a>
                        </div>
                    </div>
                @endauth

                {{-- LIST DISKUSI --}}
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h5 class="fw-bold m-0">Diskusi Terbaru <span class="text-muted fw-normal">({{ $discussions->count() }})</span></h5>
                </div>

                @forelse($discussions as $item)
                    <div class="card mb-4 shadow-sm border-0 rounded-4">
                        <div class="card-body p-4">

                            {{-- Header Card: User Info & Status --}}
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->user->name) }}&background=random&color=fff&size=64&rounded=true"
                                         alt="Avatar" width="45" height="45" class="rounded-circle shadow-sm">

                                    <div>
                                        <h6 class="fw-bold m-0 text-dark">{{ $item->user->name }}</h6>
                                        <span class="text-muted small" style="font-size: 0.8rem;">
                                            <i class="far fa-clock me-1"></i> {{ $item->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>

                                @if($item->is_answered)
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 rounded-pill px-3 py-2">
                                        <i class="fas fa-check-circle me-1"></i> Dijawab
                                    </span>
                                @else
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border border-secondary border-opacity-25 rounded-pill px-3 py-2">
                                        <i class="fas fa-hourglass-half me-1"></i> Menunggu
                                    </span>
                                @endif
                            </div>

                            {{-- Content Pertanyaan --}}
                            <div class="mb-4">
                                <h5 class="fw-bold text-dark mb-2">{{ $item->subject }}</h5>
                                <p class="text-muted lh-base mb-0">{{ $item->question }}</p>
                            </div>

                            {{-- Jawaban Admin --}}
                            @if($item->is_answered)
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-warning position-relative">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 24px; height: 24px;">
                                            <i class="fas fa-crown" style="font-size: 12px;"></i>
                                        </div>
                                        <span class="fw-bold text-dark small">Admin {{ $item->admin->name }}</span>
                                        <span class="badge bg-dark text-white" style="font-size: 0.6rem;">OFFICIAL</span>
                                    </div>
                                    <p class="mb-0 text-dark small lh-lg">
                                        {{ $item->answer }}
                                    </p>
                                </div>
                            @endif

                            {{-- Form Jawab (Khusus Admin) --}}
                            @if(Auth::check() && Auth::user()->role === 'admin' && !$item->is_answered)
                                <hr class="my-4 border-secondary opacity-10">
                                <form action="{{ route('discussions.answer', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <label class="fw-bold small text-danger mb-2">
                                        <i class="fas fa-user-shield me-1"></i> Jawab sebagai Admin:
                                    </label>
                                    <div class="input-group">
                                        <textarea name="answer" class="form-control" rows="1" placeholder="Tulis jawaban..." required></textarea>
                                        <button class="btn btn-dark" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                @empty
                    {{-- Empty State --}}
                    <div class="text-center py-5">
                        <div class="bg-light rounded-circle p-4 d-inline-block mb-3">
                            <i class="far fa-comments fa-3x text-muted opacity-50"></i>
                        </div>
                        <h5 class="fw-bold text-muted">Belum ada diskusi</h5>
                        <p class="text-secondary small">Jadilah yang pertama bertanya di forum ini!</p>
                    </div>
                @endforelse

                {{-- Pagination (Jika ada) --}}
                @if(method_exists($discussions, 'hasPages') && $discussions->hasPages())
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $discussions->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-layout>
