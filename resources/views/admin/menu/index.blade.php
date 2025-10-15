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
        <h5 class="card-title">Manajemen Menu</h5>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-info">
            <i class="ri-add-line me-1"></i> Tambah Menu
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover" id="menu-table">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Menu</th>
                        <th>Route</th>
                        <th class="text-center">Urutan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    {{-- Data akan diisi oleh DataTables --}}
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
        $('#menu-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.menus.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'menu_name',
                    name: 'name'
                }, // Kolom `name` asli untuk searching/ordering
                {
                    data: 'route',
                    name: 'permission_name',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'order',
                    name: 'order'
                },
                {
                    data: 'status',
                    name: 'status',
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Menangani populasi data modal saat akan ditampilkan
        $('#deleteConfirmationModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var menuName = button.data('menu-name');
            var form = $('#deleteForm');
            var modalMenuName = $('#menu-name-to-delete');

            form.attr('action', url);
            modalMenuName.text(menuName);
        });


        let successAlert = $('.alert-success');

        // Periksa apakah elemen alert tersebut ada di halaman
        if (successAlert.length) {
            // Setelah 4 detik (4000 milidetik), jalankan fungsi berikut
            setTimeout(function() {
                // Lakukan efek fade out selama 0.5 detik (500 milidetik)
                successAlert.fadeOut(500, function() {
                    // Setelah efek fade out selesai, hapus elemen alert dari DOM
                    $(this).remove();
                });
            }, 4000); // Waktu tunggu sebelum fade out dimulai
        }
    });
</script>
@endpush