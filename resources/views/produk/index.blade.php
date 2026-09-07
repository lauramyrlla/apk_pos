@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<div class="container produk-page py-4">

    <h1 class="mb-3">🐾 Halaman Produk</h1>

    @can('create', App\Models\Produk::class)
        <a href="{{ route('produk.create') }}" class="btn btn-buat mb-3"> Tambah</a>
    @endcan

    <form action="{{ route('produk.index') }}" method="GET" class="mb-3">
        <div class="input-group">
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