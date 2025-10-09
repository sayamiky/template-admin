{{-- resources/views/admin/users/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')

@section('content')
<h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manajemen /</span> Pengguna
</h4>
<div class="row">
    <div class="col-md-12">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <div id="notification-alert-container"></div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Daftar Pengguna</h5>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-end">
                        <i class="ri-add-line me-1"></i> Tambah Pengguna
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th style="width: 15%">Aksi</th>
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

{{-- Modal Konfirmasi Hapus dari Template Materio --}}
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus pengguna <strong id="userNameToDelete"></strong>?</p>
                <p class="text-danger">Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                {{-- Form ini akan dikirim via AJAX --}}
                <form id="deleteForm" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
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
        var table = $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.users.index') }}',
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'role',
                    name: 'role',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Menggunakan event listener modal Bootstrap
        var deleteModal = document.getElementById('deleteConfirmationModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var userName = button.getAttribute('data-name');
            var actionUrl = button.getAttribute('data-url');

            var modalBodyName = deleteModal.querySelector('#userNameToDelete');
            var deleteForm = deleteModal.querySelector('#deleteForm');

            modalBodyName.textContent = userName;
            deleteForm.setAttribute('action', actionUrl);
        });

        // Menangani submit form hapus via AJAX untuk modal Bootstrap
        $('#deleteForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    var modalInstance = bootstrap.Modal.getInstance(deleteModal);
                    modalInstance.hide();

                    // [PERBAIKAN] Tampilkan notifikasi alert Bootstrap yang hilang otomatis
                    var alertHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        response.success +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';

                    $('#notification-alert-container').html(alertHtml);

                    // Hilangkan notifikasi setelah 5 detik
                    setTimeout(function() {
                        $('.alert').fadeOut('slow', function() {
                            $(this).remove();
                        });
                    }, 5000);

                    table.ajax.reload();
                },
                error: function(xhr) {
                    var modalInstance = bootstrap.Modal.getInstance(deleteModal);
                    modalInstance.hide();
                    // Notifikasi error
                    var errorAlert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Gagal menghapus pengguna. Silakan coba lagi.' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
                    $('#notification-alert-container').html(errorAlert);
                }
            });
        });
    });
</script>
@endpush