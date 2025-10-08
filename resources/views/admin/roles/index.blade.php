@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Roles</h1>

        <!-- Button Create -->
        <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Create</a>

        <!-- Form Cari -->
        <form action="{{ route('roles.index') }}" method="GET" class="mb-3 d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari role..."
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary">Cari</button>
        </form>

        <!-- List Data -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>
                            <!-- Button Update -->
                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Update</a>
                            <!-- Button Hapus -->
                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
