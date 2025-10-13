@extends('layouts.admin')

@section('title', 'Manajemen Menu')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Manajemen /</span> Menu
</h4>
<!-- Notifikasi -->
<div id="notification-alert-container">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Manajemen Menu</h5>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
            <i class="ri-add-line me-2"></i> Tambah Menu
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table id="menu-table" class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Parent</th>
                        <th>Route</th>
                        <th class="text-center">Urutan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($menus as $parentMenu)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- Kolom Nama Menu dengan struktur bersarang --}}
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="{{ $parentMenu->icon }} me-3"></i>
                                <strong>{{ $parentMenu->name }}</strong>
                            </div>

                            {{-- Daftar untuk children --}}
                            @if ($parentMenu->children->isNotEmpty())
                            <ul class="list-unstyled mt-2 ps-4 mb-0">
                                @foreach ($parentMenu->children->sortBy('order') as $childMenu)
                                <li class="d-flex justify-content-between align-items-center py-1 border-top">
                                    {{-- Nama child --}}
                                    <div class="d-flex align-items-center">
                                        <i class="{{ $childMenu->icon }} me-3"></i>
                                        <span>{{ $childMenu->name }}</span>
                                    </div>
                                    {{-- Tombol aksi untuk child --}}
                                    <div class="d-inline-flex">
                                        <a href="{{ route('admin.menus.edit', $childMenu->id) }}" class="btn btn-sm btn-primary me-1">
                                            <i class="ri-edit-line"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger"
                                            data-url="{{ route('admin.menus.destroy', $childMenu->id) }}" data-bs-toggle="modal"
                                            data-bs-target="#deleteConfirmationModal">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @endif
                        </td>
                        {{-- Kolom Parent untuk baris parent --}}
                        <td>-</td>
                        {{-- Kolom Route untuk baris parent --}}
                        <td>{{ $parentMenu->route ?? '-' }}</td>
                        {{-- Kolom Urutan untuk baris parent --}}
                        <td class="text-center">{{ $parentMenu->order }}</td>
                        {{-- Kolom Status untuk baris parent --}}
                        <td class="text-center">
                            @if ($parentMenu->is_active)
                            <span class="badge bg-label-success">Aktif</span>
                            @else
                            <span class="badge bg-label-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        {{-- Kolom Aksi untuk baris parent --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('admin.menus.edit', $parentMenu->id) }}" class="btn btn-sm btn-primary me-2">
                                    <i class="ri-edit-line"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-url="{{ route('admin.menus.destroy', $parentMenu->id) }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmationModal">
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data menu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus menu <strong id="menu-name-to-delete"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus!</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Inisialisasi DataTables pada tabel HTML
        $('#menu-table').DataTable({
            "ordering": false, // Nonaktifkan sorting bawaan karena struktur kompleks
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ entri",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // SweetAlert untuk konfirmasi penghapusan
        $('.form-delete').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });
    });
</script>
@endpush