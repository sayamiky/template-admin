@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Card Selamat Datang -->
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-6">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->name }}! 🎉</h5>
                        <p class="mb-4">
                            Anda telah berhasil masuk ke sistem. Selamat bekerja dan semoga harimu menyenangkan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <!-- Card Jumlah Pengguna -->
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="ri-group-line"></i>
                                </span>
                            </div>
                        </div>
                        <span class="fw-medium d-block mb-1">Total Pengguna</span>
                        <h3 class="card-title mb-2">{{ $userCount }}</h3>
                    </div>
                </div>
            </div>
            <!-- Card Jumlah Role -->
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="ri-shield-user-line"></i>
                                </span>
                            </div>
                        </div>
                        <span class="fw-medium d-block mb-1">Total Role</span>
                        <h3 class="card-title mb-2">{{ $roleCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

