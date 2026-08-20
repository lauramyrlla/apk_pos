@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<style>
    body {
        background: linear-gradient(135deg, #B3C8CF 0%, #E5E1DA 100%);
        min-height: 100vh;
    }

    .container.py-4 h1 {
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

    .table tbody td,
    .table tbody th {
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

    .hilangkan-teks-pagination p {
        display: none !important;
    }
    .hilangkan-teks-pagination div:first-child {
        display: none !important;
    }

    /* Tombol Create disesuaikan biar senada, gak nabrak tema */
    .btn-buat {
        background-color: #4a636b;
        border-color: #4a636b;
        color: #fff;
    }
    .btn-buat:hover {
        background-color: #3a4f56;
        border-color: #3a4f56;
        color: #fff;
    }

    /* Warna tombol Edit & Hapus disesuaikan biar tidak mencolok */
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

<div class="container py-4">

    <h1 class="mb-3">🐾 Halaman Produk</h1>

    @can('create', App\Models\Produk::class)
        <a href="{{ route('produk.create') }}" class="btn btn-buat mb-3"> Tambah</a>
    @endcan

    <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
        <div class="input-group" style="max-width: 400px;">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Cari nama produk"
            >
            <button class="btn btn-outline-secondary" type="submit">
                Cari
            </button>
        </div>
    </form>

    <table class="table table-striped table-hover align-middle">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Pengguna</th>
          <th scope="col">Foto</th>
          <th scope="col">Nama</th>
          <th scope="col">Harga Beli</th>
          <th scope="col">Harga Jual</th>
          <th scope="col">Stok</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
     @forelse ($products as $product)
    <tr>
        <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
        <td>{{ $product->user?->name ?? 'Tidak Ada Pengguna' }}</td>
        <td>
            <img src="{{ asset('storage/'.$product->foto) }}" width="40" height="40" class="img-thumbnail" style="object-fit: cover;">
        </td>

        <td>{{ $product->nama }}</td>
        <td>{{ $product->harga_beli }}</td>
        <td>{{ $product->harga_jual }}</td>
        <td>{{ $product->stok }}</td>
        <td>
            <div class="d-flex align-items-center gap-1">
                @can('update', $product)
                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-edit-akun btn-sm">Edit</a>
                @endcan
                
                <span class="text-muted">||</span>
                
                @can('delete', $product)
                <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-hapus btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                        Hapus
                    </button>
                </form>
                @endcan
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="8" class="text-center py-4 text-muted">
            <h4>🐾 Data tidak tersedia.</h4>
        </td>
    </tr>
    @endforelse
      </tbody>
    </table>

    <div class="d-flex justify-content-end mt-4 hilangkan-teks-pagination">
        {{ $products->links() }}
    </div>

</div>

@endsection