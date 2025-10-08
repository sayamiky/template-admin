<x-admin-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Akses /</span> Roles
        </h4>

        {{-- Menampilkan pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Roles</h5>
                {{-- Tombol Tambah Role --}}
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    <i class="ri-add-line me-1"></i> Tambah Role
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Role</th>
                            <th>Guard</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($roles as $index => $role)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $role->name }}</strong></td>
                                <td><span class="badge bg-label-secondary">{{ $role->guard_name }}</span></td>
                                <td>
                                    <div class="d-flex">
                                        {{-- Tombol Edit --}}
                                        <a class="btn btn-sm btn-warning me-2" href="{{ route('roles.edit', $role->id) }}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        {{-- Tombol Delete --}}
                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $role->id }}" data-bs-toggle="modal"
                                            data-bs-target="#deleteRoleModal">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data role.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Delete Role -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus role ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteModal = document.getElementById('deleteRoleModal');
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const roleId = button.getAttribute('data-id');
                    const form = document.getElementById('deleteForm');
                    // Menggunakan route('roles.destroy') sesuai dengan resource controller
                    const action = "{{ route('roles.destroy', ':id') }}".replace(':id', roleId);
                    form.setAttribute('action', action);
                });
            });
        </script>
    @endpush
</x-admin-layout>

