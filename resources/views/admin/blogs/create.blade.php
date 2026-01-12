<x-admin-layout title="Tulis Blog">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-4">Buat Artikel Baru</h5>
                        <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="fw-bold small mb-1">Judul Artikel</label>
                                <input type="text" name="title" class="form-control bg-light border-0" placeholder="Masukkan judul..." required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold small mb-1">Upload Banner</label>
                                <input type="file" name="image" class="form-control bg-light border-0" required>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold small mb-1">Isi Artikel</label>
                                <textarea name="content" rows="10" class="form-control bg-light border-0" placeholder="Tuliskan isi blog di sini..." required></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-5 rounded-pill fw-bold">Terbitkan</button>
                                <a href="{{ route('admin.blogs.index') }}" class="btn btn-light px-5 rounded-pill fw-bold">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
