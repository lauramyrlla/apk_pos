@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<div class="container users-page py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>🐾Halaman Pengguna</h1>
        </div>
    </div>

    <a href="{{ route('admin.users.create') }}" class="btn btn-secondary mb-3">Tambah</a>

    <form action="{{ route('admin.users.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                class="form-control" 
                placeholder="Cari nama pengguna atau email"
            >
            <button class="btn btn-outline-secondary" type="submit">
                Cari
            </button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">Peran</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $users->firstItem() + $loop->index }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-edit-akun">
                            Edit Akun
                        </a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-hapus" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-muted text-center">
                        Data tidak tersedia.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="pagination-wrapper">
        {{ $users->links() }}
    </div>
</div>

@endsection