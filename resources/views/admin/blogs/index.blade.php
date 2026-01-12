<x-admin-layout title="Kelola Blog">
    <div class="container-fluid px-4">

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">Manajemen Blog</h2>
                <p class="text-muted small mb-0">Kelola artikel, berita, dan informasi terbaru.</p>
            </div>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary rounded-3 px-4 shadow-sm">
                <i class="fas fa-pen-nib me-2"></i>Tulis Blog Baru
            </a>
        </div>

        {{-- Alert Sukses --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table Card --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr class="text-nowrap">
                                <th class="py-3 ps-4 text-uppercase small fw-bold border-0" style="min-width: 100px;">Gambar</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 300px;">Judul & Konten</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 150px;">Tanggal Terbit</th>
                                <th class="py-3 text-end pe-4 text-uppercase small fw-bold border-0" style="min-width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($blogs as $blog)
                                <tr>
                                    {{-- Kolom Gambar --}}
                                    <td class="ps-4">
                                        <div class="bg-light rounded overflow-hidden border border-light" style="width: 80px; height: 50px;">
                                            @if($blog->image)
                                                <img src="{{ asset('storage/' . $blog->image) }}" alt="Thumbnail" class="w-100 h-100" style="object-fit: cover;">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Kolom Judul --}}
                                    <td>
                                        <h6 class="mb-1 fw-bold text-dark text-wrap" style="line-height: 1.4;">{{ $blog->title }}</h6>
                                        {{-- Opsional: Menampilkan snippet konten jika ada kolom excerpt/body --}}
                                        {{-- <p class="text-muted small mb-0 text-wrap">{{ Str::limit(strip_tags($blog->content), 60) }}</p> --}}
                                    </td>

                                    {{-- Kolom Tanggal --}}
                                    <td>
                                        <div class="text-muted small">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            {{ $blog->created_at->format('d M Y') }}
                                        </div>
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="pe-4 text-end">
                                        <div class="d-inline-flex gap-2">
                                            {{-- Tombol Edit (Pastikan route ada, jika belum gunakan #) --}}
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}"
                                               class="btn btn-sm btn-light border text-warning hover-warning"
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                        class="btn btn-sm btn-light border text-danger hover-danger"
                                                        onclick="if(confirm('Apakah Anda yakin ingin menghapus blog ini?')) { this.closest('form').submit(); }"
                                                        title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5">
                                        <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                            <div class="bg-light rounded-circle p-4 mb-3">
                                                <i class="fas fa-newspaper fa-3x text-muted opacity-50"></i>
                                            </div>
                                            <h6 class="text-dark fw-bold">Belum ada artikel blog</h6>
                                            <p class="text-muted small mb-3">Mulai menulis untuk membagikan informasi kepada pelanggan.</p>
                                            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm rounded-pill px-4">
                                                <i class="fas fa-plus me-2"></i>Tulis Blog
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer Pagination --}}
            @if(method_exists($blogs, 'hasPages') && $blogs->hasPages())
                <div class="card-footer bg-white border-top-0 py-3">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
