@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Manajemen / Role /</span> Edit
</h4>

<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Formulir Edit Role</h5>
      <div class="card-body">
                    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Nama Role --}}
                        <div class="mb-4">
                            <label class="form-label" for="name">Nama Role</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="cth: operator"
                                value="{{ old('name', $role->name) }}" />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Hak Akses --}}
                        <h5 class="mb-3">Hak Akses Role</h5>
                        <div class="table-responsive">
                            <table class="table table-flush-spacing">
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap fw-medium">
                                            Akses Administrator
                                            <i class="ri-information-line" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Memberikan akses penuh ke semua fitur"></i>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll" />
                                                <label class="form-check-label" for="selectAll"> Pilih Semua </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @foreach ($permissionGroups as $groupName => $permissions)
                                    <tr>
                                        <td class="text-nowrap fw-medium">{{ ucwords($groupName) }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap">
                                                @foreach ($permissions as $permission)
                                                <div class="form-check me-3 me-lg-5 mb-2">
                                                    <input class="form-check-input permission-checkbox" type="checkbox"
                                                        name="permissions[]" value="{{ $permission->name }}"
                                                        id="permission-{{ $permission->id }}"
                                                        {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }} />
                                                    <label class="form-check-label text-capitalize"
                                                        for="permission-{{ $permission->id }}">
                                                        {{-- Mengambil kata setelah tanda hubung, cth: 'list', 'create' --}}
                                                        {{ str_replace('-', ' ', explode('-', $permission->name)[1] ?? $permission->name) }}
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Simpan Perubahan</button>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-label-secondary">Batal</a>
                        </div>
                    </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
{{-- Skrip untuk fungsionalitas 'Pilih Semua' --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('selectAll');
    const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

    selectAllCheckbox.addEventListener('change', function () {
        permissionCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    permissionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Jika ada satu permission yang tidak dicentang, maka 'Pilih Semua' juga tidak dicentang
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            }
            // Cek apakah semua permission sudah dicentang
            else {
                const allChecked = Array.from(permissionCheckboxes).every(c => c.checked);
                selectAllCheckbox.checked = allChecked;
            }
        });
    });
});
</script>
@endpush

