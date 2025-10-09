<x-admin-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Manajemen Akses / Permissions /</span> Edit Permission
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Edit Permission</h5>
                    <div class="card-body">
                        {{-- Form action akan kita implementasikan pada tahap selanjutnya --}}
                        <form action="{{ route('permissions.update', $permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Permission</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $permission->name) }}"
                                    placeholder="Masukkan nama permission" required />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="guard_name" class="form-label">Guard Name</label>
                                <input type="text" class="form-control" id="guard_name" name="guard_name"
                                    value="{{ $permission->guard_name }}" readonly />
                                <div class="form-text">Guard name tidak dapat diubah.</div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <a href="{{ route('permissions.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
