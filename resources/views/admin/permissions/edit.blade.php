@extends('layouts.admin')

@section('title', 'Edit Izin Akses')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Manajemen / Izin Akses /</span> Edit
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Formulir Edit Izin Akses</h5>
                <div class="card-body">
                    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Izin Akses (Permission)</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $permission->name) }}" placeholder="Contoh: view_dashboard" required />
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

