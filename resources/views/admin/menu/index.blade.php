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
        <h5 class="card-title mb-0">Daftar Menu</h5>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
            <i class="ri-add-line me-1"></i> Tambah Menu
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="menus-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Parent</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Body tabel akan diisi oleh DataTables --}}
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
        // Inisialisasi DataTable
        var table = $('#menus-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.menus.index') }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'route',
                    name: 'route'
                },
                {
                    data: 'icon',
                    name: 'icon'
                },
                {
                    data: 'order',
                    name: 'order'
                },
                {
                    data: 'parent_id',
                    name: 'parent_id'
                }, // Asumsi nama kolom di db adalah parent_id
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Event handler untuk menampilkan modal konfirmasi hapus
        $('#menus-table').on('click', '.delete-btn', function() {
            var menuName = $(this).data('name');
            var deleteUrl = $(this).data('url');

            $('#menu-name-to-delete').text(menuName);
            $('#deleteForm').attr('action', deleteUrl);
        });

        // Event handler untuk submit form hapus via AJAX
        $('#deleteForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'DELETE'
                },
                success: function(response) {
                    $('#deleteConfirmationModal').modal('hide');
                    table.ajax.reload(); // Muat ulang data tabel

                    // Tampilkan notifikasi sukses
                    var alertHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        response.success +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
                    $('#notification-alert-container').html(alertHtml);

                    // Hilangkan notifikasi setelah 5 detik
                    setTimeout(function() {
                        $('.alert').fadeOut('slow');
                    }, 5000);
                },
                error: function(xhr) {
                    $('#deleteConfirmationModal').modal('hide');
                    console.error('Gagal menghapus data.', xhr.responseJSON);

                    // Tampilkan notifikasi error (opsional)
                    var errorMsg = xhr.responseJSON && xhr.responseJSON.error ? xhr.responseJSON.error : 'Terjadi kesalahan.';
                    var alertHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        errorMsg +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
                    $('#notification-alert-container').html(alertHtml);
                }
            });
        });
    });
</script>
@endpush
