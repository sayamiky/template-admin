<x-admin-layout>
    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Akses /</span> Permissions
        </h4>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Permissions</h5>
                {{-- Tombol Tambah Permission --}}
                <a href="{{ route('permissions.create') }}" class="btn btn-primary">
                    <i class="ri-add-line me-1"></i> Tambah Permission
                </a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Permission</th>
                            <th>Guard</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @forelse ($permissions as $index => $permission)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><strong>{{ $permission->name }}</strong></td>
                                <td><span class="badge bg-label-secondary">{{ $permission->guard_name }}</span></td>
                                <td>
                                    <div class="d-flex">
                                        {{-- Tombol Edit --}}
                                        <a class="btn btn-sm btn-warning me-2"
                                            href="{{ route('permissions.edit', $permission->id) }}">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        {{-- Tombol Delete --}}
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deletePermissionModal" data-id="{{ $permission->id }}">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data permission.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deletePermissionModal" tabindex="-1" aria-labelledby="deletePermissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePermissionModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus permission ini?
                </div>
                <div class="modal-footer">
                    <form id="deletePermissionForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const deleteModal = document.getElementById('deletePermissionModal');
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const permissionId = button.getAttribute('data-id');
                    const form = document.getElementById('deletePermissionForm');
                    let action = "{{ route('permissions.destroy', ':id') }}";
                    action = action.replace(':id', permissionId);
                    form.setAttribute('action', action);
                });
            });
        </script>
    @endpush
</x-admin-layout>

