@extends('layouts.admin')

@section('title', 'Profil Pengguna')

@section('content')
<h4 class="py-3 mb-4">
    <span class="text-muted fw-light">Pengaturan /</span> Akun
</h4>

<div class="row">
    <div class="col-md-12">
        {{-- Navigasi Tab --}}
        <ul class="nav nav-pills flex-column flex-md-row mb-4 gap-2 gap-lg-0" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
                    <i class="ri-user-line me-1_5"></i> Akun
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
                    <i class="ri-lock-password-line me-1_5"></i> Keamanan
                </button>
            </li>
        </ul>

        {{-- Konten Tab --}}
        <div class="tab-content p-0">
            {{-- Panel Tab Akun --}}
            <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">
                <div class="card mb-4">
                    <h5 class="card-header">Detail Profil</h5>
                    <div class="card-body">
                        @if (session('status') === 'profile-updated')
                        <div class="alert alert-success" role="alert">
                            Profil berhasil diperbarui.
                        </div>
                        @endif
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('assets/img/avatars/1.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah foto baru</span>
                                    <i class="ri-upload-2-line d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-3">
                                    <i class="ri-restart-line d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <div class="text-muted small">Diizinkan JPG, GIF or PNG. Ukuran Maksimal 800K.</div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Nama</label>
                                    <input class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" autofocus />
                                    @error('name', 'updateProfileInformation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror" type="text" id="email" name="email" value="{{ old('email', $user->email) }}" placeholder="john.doe@example.com" />
                                    @error('email', 'updateProfileInformation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-outline-secondary">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header">Hapus Akun</h5>
                    <div class="card-body">
                        <div class="mb-3 col-12 mb-0">
                            <div class="alert alert-warning">
                                <h6 class="alert-heading mb-1">Apakah Anda yakin ingin menghapus akun Anda?</h6>
                                <p class="mb-0">Setelah Anda menghapus akun Anda, semua datanya akan dihapus secara permanen.</p>
                            </div>
                        </div>
                        {{-- Ganti form ini dengan logika hapus akun yang sesuai jika diperlukan --}}
                        <form id="formAccountDeactivation" onsubmit="return false">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                                <label class="form-check-label" for="accountActivation">Saya mengonfirmasi penonaktifan akun saya</label>
                            </div>
                            <button type="submit" class="btn btn-danger deactivate-account">Nonaktifkan Akun</button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Panel Tab Keamanan --}}
            <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab">
                <div class="card mb-4">
                    <h5 class="card-header">Ubah Kata Sandi</h5>
                    <div class="card-body">
                        @if (session('status') === 'password-updated')
                        <div class="alert alert-success" role="alert">
                            Kata sandi berhasil diperbarui.
                        </div>
                        @endif
                        <form id="formAccountSettings" method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="current_password">Kata Sandi Saat Ini</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" type="password" name="current_password" id="current_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                    </div>
                                    @error('current_password', 'updatePassword')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="password">Kata Sandi Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control @error('password', 'updatePassword') is-invalid @enderror" type="password" id="password" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                    </div>
                                    @error('password', 'updatePassword')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                                    <div class="input-group input-group-merge">
                                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                        <span class="input-group-text cursor-pointer"><i class="ri-eye-off-line"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 mt-1">
                                    <h6 class="fw-medium">Persyaratan Kata Sandi:</h6>
                                    <ul class="ps-3 mb-0">
                                        <li class="mb-1">Minimal 8 karakter</li>
                                        <li class="mb-1">Mengandung satu huruf besar dan satu huruf kecil</li>
                                        <li>Mengandung satu angka atau simbol</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                                <button type="reset" class="btn btn-outline-secondary">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Skrip ini diperlukan untuk pratinjau unggah gambar di tab "Akun" --}}
<script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endpush