<x-admin-layout title="Edit Blog">
    <div class="container-fluid px-4">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">Edit Blog</h2>
                <p class="text-muted small mb-0">Perbarui artikel blog Anda.</p>
            </div>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary rounded-3 px-4 shadow-sm">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>

        {{-- Form Card --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
            <div class="card-body p-4">

                {{-- Form Edit --}}
                <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Wajib untuk proses Update --}}

                    <div class="row g-4">
                        {{-- Judul --}}
                        <div class="col-12">
                            <label for="title" class="form-label fw-bold">Judul Artikel</label>
                            <input type="text"
                                   class="form-control @error('title') is-invalid @enderror"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $blog->title) }}"
                                   placeholder="Masukkan judul blog...">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Gambar Saat Ini & Upload Baru --}}
                        <div class="col-12">
                            <label class="form-label fw-bold">Gambar Sampul</label>

                            {{-- Preview Gambar Lama --}}
                            @if($blog->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $blog->image) }}"
                                         alt="Current Image"
                                         class="img-thumbnail rounded-3"
                                         style="height: 150px; object-fit: cover;">
                                    <div class="form-text">Gambar saat ini. Biarkan kosong jika tidak ingin mengubah.</div>
                                </div>
                            @endif

                            <input type="file"
                                   class="form-control @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Konten --}}
                        <div class="col-12">
                            <label for="content" class="form-label fw-bold">Konten Artikel</label>
                            <textarea class="form-control @error('content') is-invalid @enderror"
                                      id="content"
                                      name="content"
                                      rows="10"
                                      placeholder="Tulis konten blog di sini...">{{ old('content', $blog->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="col-12 d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-light border">Reset</button>
                            <button type="submit" class="btn btn-primary px-4 fw-bold">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-admin-layout>
