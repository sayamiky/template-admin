{{-- resources/views/admin/roles/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manajemen Role')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Manajemen /</span> Role
</h4>
<div class="row">
    <div class="col-md-12">
        <div id="notification-alert-container"></div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">Daftar Role</h5>
                <a href="{{ route('admin.roles.create') }}" class="btn btn-info float-end">
                    <i class="ri-add-line me-1"></i> Tambah Role
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="roles-table">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Nama Role</th>
                                <th>Guard</th>
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

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus role <strong id="dataNameToDelete"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
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
        var table = $('#roles-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.roles.index') }}",
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

        var deleteModal = document.getElementById('deleteConfirmationModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var dataName = button.getAttribute('data-name');
            var actionUrl = button.getAttribute('data-url');

            deleteModal.querySelector('#dataNameToDelete').textContent = dataName;
            deleteModal.querySelector('#deleteForm').setAttribute('action', actionUrl);
        });

        $('#deleteForm').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                url: url,
                type: 'POST', // Tetap POST karena form
                data: {
                    _token: form.find('input[name="_token"]').val(), // Kirim CSRF token
                    _method: 'DELETE' // Kirim method spoofing secara eksplisit
                },
                success: function(response) {
                    var modalInstance = bootstrap.Modal.getInstance(deleteModal);
                    modalInstance.hide();

                    var alertHtml = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
                        response.success +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';

                    $('#notification-alert-container').html(alertHtml);

                    setTimeout(function() {
                        $('.alert').fadeOut('slow', function() {
                            $(this).remove();
                        });
                    }, 5000);

                    table.ajax.reload();
                },
                error: function(xhr) {
                    console.error('Gagal menghapus data.', xhr.responseText); // Log respons error untuk debug
                    var modalInstance = bootstrap.Modal.getInstance(deleteModal);
                    modalInstance.hide();
                    var errorAlert = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                        'Gagal menghapus data. Silakan coba lagi.' +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                        '</div>';
                    $('#notification-alert-container').html(errorAlert);
                }
            });
        });
    });
</script>
@endpush