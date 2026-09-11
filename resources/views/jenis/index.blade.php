@extends('layouts.app')

@section('title', 'Jenis')

@section('content')

@include('layouts.navbar')

<div class="container penjualan-page py-4">

    <h1 class="mb-3">🐾 Halaman Jenis Produk</h1>

    @can('create', App\Models\Jenis::class)
        <a href="{{ route('jenis.create') }}" class="btn btn-buat mb-3"> Tambah</a>
    @endcan

    <form action="{{ route('jenis.index') }}" method="GET" class="mb-3">
        <div class="input-group search-input">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                class="form-control"
                placeholder="Cari nama jenis"
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
          <th scope="col">Jenis</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
         @forelse ($jenisList as $jenis)
    <tr>
        <th scope="row">{{ $jenisList->firstItem() + $loop->index }}</th>
        <td>{{ $jenis->user?->name ?? 'Tidak Ada Pengguna' }}</td>
        <td>{{ $jenis->nama_jenis }}</td>
        <td>
            <div class="d-flex align-items-center gap-1">
                @can('update', $jenis)
                    <a href="{{ route('jenis.edit', $jenis) }}" class="btn btn-edit-akun btn-sm">Edit</a>
                @endcan

                <span class="text-muted">||</span>

                @can('delete', $jenis)
                <form action="{{ route('jenis.destroy', $jenis) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-hapus btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus jenis ini?')">
                        Hapus
                    </button>
                </form>
                @endcan
            </div>
        </td>
    </tr>

    @empty
    <tr>
        <td colspan="4" class="text-center py-4 text-muted">
            <h4>🐾 Data tidak tersedia.</h4>
        </td>
    </tr>
    @endforelse
      </tbody>
    </table>

    <div class="d-flex justify-content-end mt-4 hilangkan-teks-pagination">
        {{ $jenisList->links() }}
    </div>

</div>

@endsection