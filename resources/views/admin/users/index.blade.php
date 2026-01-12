<x-admin-layout title="User Management">
    <div class="container-fluid px-4">

        {{-- Header Section --}}
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h2 class="fw-bold text-dark mb-0">Manajemen User</h2>
                <p class="text-muted small mb-0">Kelola data pengguna dan hak akses aplikasi.</p>
            </div>
            {{-- Jika ingin menambah user manual, tombol bisa ditaruh di sini --}}
        </div>

        {{-- Table Card --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary">
                            <tr class="text-nowrap">
                                <th class="py-3 ps-4 text-uppercase small fw-bold border-0" style="width: 50px;">ID</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 300px;">Pengguna</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 150px;">Role</th>
                                <th class="py-3 text-uppercase small fw-bold border-0" style="min-width: 150px;">Tanggal Bergabung</th>
                                <th class="py-3 text-end pe-4 text-uppercase small fw-bold border-0" style="min-width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                {{-- Kolom ID --}}
                                <td class="ps-4 fw-semibold text-muted">#{{ $user->id }}</td>

                                {{-- Kolom Pengguna (Nama & Email Digabung) --}}
                                <td>
                                    <div class="d-flex align-items-center">
                                        {{-- Avatar Circle dari Inisial Nama --}}
                                        <div class="flex-shrink-0 avatar-circle bg-primary bg-opacity-10 text-primary fw-bold fs-5 me-3 d-flex align-items-center justify-content-center rounded-circle border border-primary border-opacity-10"
                                             style="width: 45px; height: 45px;">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-bold text-dark">{{ $user->name }}</h6>
                                            <p class="text-muted small mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Role --}}
                                <td>
                                    @if($user->role === 'admin')
                                        <span class="badge bg-dark text-white border border-dark rounded-pill px-3 py-2">
                                            <i class="fas fa-user-shield me-1"></i> Admin
                                        </span>
                                    @else
                                        <span class="badge bg-light text-secondary border border-secondary border-opacity-25 rounded-pill px-3 py-2">
                                            <i class="fas fa-user me-1"></i> User
                                        </span>
                                    @endif
                                </td>

                                {{-- Kolom Tanggal Bergabung (Optional, pakai created_at jika ada) --}}
                                <td>
                                    <span class="text-muted small">
                                        <i class="far fa-calendar-alt me-1"></i>
                                        {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                                    </span>
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="pe-4 text-end">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                                class="btn btn-sm btn-light border text-danger hover-danger"
                                                onclick="if(confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')) { this.closest('form').submit(); }"
                                                title="Hapus User">
                                            <i class="fas fa-trash-alt"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="d-flex flex-column align-items-center justify-content-center py-4">
                                        <div class="bg-light rounded-circle p-4 mb-3">
                                            <i class="fas fa-users-slash fa-3x text-muted opacity-50"></i>
                                        </div>
                                        <h6 class="text-dark fw-bold">Tidak ada data user</h6>
                                        <p class="text-muted small mb-0">Belum ada user yang terdaftar di sistem.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Footer Pagination (Jika pakai paginate di controller) --}}
            @if(method_exists($users, 'hasPages') && $users->hasPages())
                <div class="card-footer bg-white border-top-0 py-3">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
