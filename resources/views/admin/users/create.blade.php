@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manajemen / Pengguna /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Formulir Tambah Pengguna</h5>
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama Lengkap" required />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Aktif" required />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="············" aria-describedby="password" required />
                                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                            </div>
                            @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="············" aria-describedby="password_confirmation" required />
                                <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="roles" class="form-label">Role</label>
                            <select id="roles" name="roles[]" class="form-select @error('roles') is-invalid @enderror" multiple>
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-text"> Tahan tombol (Ctrl) atau (Command) untuk memilih lebih dari satu role. </div>
                            @error('roles')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

