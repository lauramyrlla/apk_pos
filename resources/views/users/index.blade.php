@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<style>
    body {
        background: linear-gradient(135deg, #B3C8CF 0%, #E5E1DA 100%);
        min-height: 100vh;
    }

    .container.mt-4 h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #4a636b;
        margin-bottom: 1rem;
        text-align: left;
    }

    .table {
        background: #fdfcfb;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(137, 168, 178, 0.15);
    }

    .table thead tr {
        background: linear-gradient(135deg, #89A8B2, #B3C8CF);
        color: #fff;
    }

    .table thead th {
        border: none;
        font-weight: 600;
        padding: 0.75rem;
    }

    .table tbody tr {
        border-bottom: 1px solid #e5e1da;
    }

    .table tbody tr:hover {
        background-color: #f2f6f7;
    }

    .table tbody td {
        padding: 0.65rem 0.75rem;
        color: #5f7a82;
        vertical-align: middle;
    }

    .table .text-muted {
        color: #9caeb3 !important;
    }

    .pagination .page-link {
        color: #89A8B2;
        border: 1px solid #d9e3e6;
    }

    .pagination .page-item.active .page-link {
        background-color: #89A8B2;
        border-color: #89A8B2;
    }

    .pagination .page-link:hover {
        background-color: #f2f6f7;
        color: #6f939d;
    }

    /* Sembunyiin teks "Showing X to Y of Z results" */
    .pagination-wrapper p {
        display: none;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
    }

    /* Warna tombol Edit Akun & Hapus disesuaikan biar tidak mencolok */
    .btn-edit-akun {
        background-color: #89A8B2;
        border-color: #89A8B2;
        color: #fff;
    }
    .btn-edit-akun:hover {
        background-color: #6f939d;
        border-color: #6f939d;
        color: #fff;
    }

    .btn-hapus {
        background-color: #a9746e;
        border-color: #a9746e;
        color: #fff;
    }
    .btn-hapus:hover {
        background-color: #925f59;
        border-color: #925f59;
        color: #fff;
    }
</style>

<div class="container mt-4">
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