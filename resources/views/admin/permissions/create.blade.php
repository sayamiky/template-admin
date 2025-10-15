@extends('layouts.admin')

@section('title', 'Tambah Izin Akses')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manajemen / Izin Akses /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Formulir Tambah Izin Akses</h5>
                <div class="card-body">
                    <form action="{{ route('admin.permissions.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Izin Akses (Permission)</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Contoh: dashboard.view" required />
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
