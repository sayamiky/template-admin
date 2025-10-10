<x-admin-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Manajemen /</span> Menu
        </h4>

        {{-- Pesan sukses --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Menu</h5>
                <a href="{{ route('menus.create') }}" class="btn btn-primary">
                    <i class="ri-add-line me-1"></i> Tambah Menu
                </a>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Menu</th>
                            <th>Parent</th>
                            <th>Route</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $menu->name }}</strong>
                                    @if ($menu->children->count() > 0)
                                        <ul class="ms-3 mt-2">
                                            @foreach ($menu->children as $child)
                                                <li>
                                                    {{ $child->name }}
                                                    <div class="d-inline-flex ms-2">
                                                        <a href="{{ route('menus.edit', $child->id) }}"
                                                            class="btn btn-sm btn-warning me-1">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                        <button class="btn btn-sm btn-danger delete-btn"
                                                            data-id="{{ $child->id }}" data-bs-toggle="modal"
                                                            data-bs-target="#deleteMenuModal">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </button>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>
                                <td>{{ $menu->parent?->name ?? '-' }}</td>
                                <td>{{ $menu->route ?? '-' }}</td>
                                <td>{{ $menu->order ?? '-' }}</td>
                                <td>
                                    @if ($menu->is_active)
                                        <span class="badge bg-label-success">Aktif</span>
                                    @else
                                        <span class="badge bg-label-secondary">Nonaktif</span>
                                    @endif
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-sm btn-warning">
                                            <i class="ri-pencil-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                            data-id="{{ $menu->id }}" data-bs-toggle="modal"
                                            data-bs-target="#deleteMenuModal">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Belum ada data menu.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMenuModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus menu ini? Submenu di dalamnya juga akan ikut terhapus.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form method="POST" id="deleteForm">
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
                const deleteModal = document.getElementById('deleteMenuModal');
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const menuId = button.getAttribute('data-id');
                    const form = document.getElementById('deleteForm');
                    const action = "{{ route('menus.destroy', ':id') }}".replace(':id', menuId);
                    form.setAttribute('action', action);
                });
            });
        </script>
    @endpush
</x-admin-layout>
