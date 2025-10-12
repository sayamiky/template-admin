@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Manajemen / Pengguna /</span> Edit
</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Formulir Edit Pengguna</h5>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" placeholder="Masukkan Nama Lengkap" required />
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="Masukkan Email Aktif" required />
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password">Kata Sandi Baru</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="············" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                        </div>
                        <div class="form-text"> Kosongkan jika tidak ingin mengubah kata sandi. </div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="············" aria-describedby="password_confirmation" />
                            <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                        </div>
                    </div>

                    {{-- [PERBAIKAN] Mengubah value checkbox ke nama role --}}
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <div class="row">
                            @foreach ($roles as $role)
                            <div class="col-md-3">
                                <div class="form-check">
                                    {{-- 1. Value diubah ke $role->name --}}
                                    {{-- 2. Pengecekan 'checked' menggunakan $role->name --}}
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}" id="role-{{ $role->id }}" @if(in_array($role->name, $userRoles)) checked @endif>
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('roles')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection