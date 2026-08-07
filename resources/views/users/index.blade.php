@extends('layouts.app')

@section('title', 'Users')

@section('content')

@include('layouts.navbar')

<h1>Halaman Produk</h1>
<!-- 🛠️ PERBAIKAN: Nama route diganti dari 'users.create' menjadi 'admin.users.create' -->
<a href="" class="btn btn-secondary">Create</a>

<form action="{{ route('admin.produk.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control" 
            placeholder="Search username or email"
        >
        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
@foreach($products as $product)
<tr>
    <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
    <td>{{ $product->user->name }}</td>
    <td>{{ $product->foto }}</td>
    <td>{{ $product->nama }}</td>
    <td>{{ $product->harga_beli }}</td>
    <td>{{ $product->harga_jual }}</td>
    <td>{{ $product->stok }}</td>

    <td>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">
            Edit Akun
        </a>
        ||
        <!-- 🛠️ PERBAIKAN: Mengisi action dengan route destroy dan method POST -->
       <form action="" method="" class="d-inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm(' Apakah anda yakin akan menghapu user ini?')">
                Hapus
            </button>
        </form>
    </td>
</tr>
@empaty 
<tr>
    <td collspan=8><h1>Data tidak tersedia.</h1></td>
</tr>
@endforeach
</tbody>
</table>
{{ $products->links() }}

