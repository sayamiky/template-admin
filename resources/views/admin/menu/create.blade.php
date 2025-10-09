<x-admin-layout>
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manajemen / Menu /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Formulir Tambah Menu</h5>
                <div class="card-body">
                    {{-- Form mengarah ke route 'menus.store' dengan metode POST --}}
                    <form action="{{ route('menus.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" value="{{ old('name') }}"
                                placeholder="Masukkan Nama Menu" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="route" class="form-label">URL</label>
                            <input type="text" class="form-control @error('route') is-invalid @enderror"
                                id="route" name="route" value="{{ old('route') }}"
                                placeholder="Masukkan URL Menu" required />
                            @error('route')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                id="icon" name="icon" value="{{ old('icon') }}"
                                placeholder="Masukkan Nama Icon (opsional)" />
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent Menu</label>
                            <select id="parent_id" name="parent_id"
                                class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">-- Tidak Ada --</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ old('parent_id') == $parent->id ? 'selected' : '' }}>{{ $parent->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Urutan</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror"
                                id="order" name="order" value="{{ old('order') }}"
                                placeholder="Masukkan Urutan Menu" min="1" />
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
