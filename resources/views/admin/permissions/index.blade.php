@extends('layouts.admin')

@section('title', 'Manajemen Izin Akses')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Manajemen /</span> Permission
</h4>
<div class="row">
    <div class="col-md-12">
        <div id="notification-alert-container"></div>

        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Daftar Izin Akses (Permissions)</h5>
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-info float-end">
                    <i class="ri-add-line me-1"></i> Tambah Izin Akses
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="permissions-table">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Guard</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Body tabel akan diisi oleh DataTables --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus permission <strong id="permission-name"></strong>?</p>
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
        // Inisialisasi DataTables
        var table = $('#permissions-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.permissions.index') }}',
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
                    data: 'guard_name',
                    name: 'guard_name'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Event listener untuk menampilkan modal konfirmasi hapus
        $('#deleteConfirmationModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var name = button.data('name');

            var modal = $(this);
            modal.find('#permission-name').text(name);
            modal.find('#deleteForm').attr('action', url);
        });

        // Event listener untuk submit form hapus via AJAX
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
                    // Tampilkan notifikasi error jika ada
                    var errorMsg = 'Gagal menghapus data. Silakan coba lagi.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
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