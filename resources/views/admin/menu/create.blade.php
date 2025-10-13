@extends('layouts.admin')

@section('title', 'Tambah Menu')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manajemen / Menu /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Formulir Tambah Menu</h5>
                <div class="card-body">
                    <form action="{{ route('admin.menus.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="cth: Manajemen Pengguna" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="url" class="form-label">URL</label>
                            <input type="text" class="form-control @error('route') is-invalid @enderror" id="route"
                                name="route" value="{{ old('route') }}" placeholder="cth: admin.users" />
                            <div class="form-text">Biarkan kosong jika ini adalah menu parent.</div>
                            @error('route')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" class="form-control @error('icon') is-invalid @enderror" id="icon"
                                name="icon" value="{{ old('icon') }}" placeholder="cth: ri-user-line" />
                            <div class="form-text">Gunakan nama ikon dari <a href="https://remixicon.com/"
                                    target="_blank">Remix Icon</a>.</div>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Urutan</label>
                            <input type="text" class="form-control @error('order') is-invalid @enderror" id="order"
                                name="order" value="{{ old('order') }}" placeholder="cth: 1" />
                            {{-- <div class="form-text">Gunakan nama ikon dari <a href="https://remixicon.com/" target="_blank">Remix Icon</a>.</div> --}}
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent Menu</label>
                            <select id="parent_id" name="parent_id"
                                class="form-select @error('parent_id') is-invalid @enderror">
                                <option value="">Tidak Ada Parent</option>
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

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
