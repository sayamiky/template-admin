<x-admin-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Role: {{ $role->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update', $role->id) }}" method="POST">
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
                            <a href="{{ route('roles.index') }}" class="btn btn-label-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    {{-- Script untuk fungsionalitas "Pilih Semua" --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('.permission-checkbox');

            selectAll.addEventListener('change', function(e) {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = e.target.checked;
                });
            });
        });
    </script>
    @endpush
</x-admin-layout>