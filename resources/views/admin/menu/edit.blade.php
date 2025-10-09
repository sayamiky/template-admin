<x-admin-layout>
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manajemen / Pengguna /</span> Edit
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Edit Pengguna</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('menus.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label" for="name">Nama Menu</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="Nama Menu"
                                value="{{ old('name', $menu->name) }}" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="route">URL</label>
                            <input type="text" class="form-control @error('route') is-invalid @enderror" id="route"
                                name="route" placeholder="/menu-url" value="{{ old('route', $menu->route) }}" required />
                            @error('route')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror"
                                id="icon" name="icon" value="{{ old('icon', $menu->icon) }}"
                                placeholder="Masukkan Nama Icon (opsional)" />
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="parent_id">Parent Menu</label>
                            <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id"
                                name="parent_id">
                                <option value="">-- Tidak Ada --</option>
                                @foreach ($parents as $parent)
                                    <option value="{{ $parent->id }}"
                                        {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->name }}
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
                                id="order" name="order" value="{{ old('order', $menu->order) }}"
                                placeholder="Masukkan Urutan Menu" min="1" />
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
