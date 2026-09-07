@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<div class="container penjualan-page py-4">

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<h1>🐾 Halaman Penjualan</h1>
<a href="{{ route('penjualan.create') }}" class="btn btn-buat mb-3">Tambah</a>

<form action="{{ route('penjualan.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input
        type="text"
        name="search"
        value="{{ request()->search }}"
        class="form-control"
        placeholder="Cari penjualan"
        >
        
        <button class="btn btn-outline-secondary" type="submit">
            Cari 
        </button>
    </div>
</form>
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal Transaksi</th>
            <th scope="col">Kasir</th>
            <th scope="col">Total Pembayaran</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sales as $sale)
    <tr>
        <th scope="row">{{$sales->firstItem() + $loop->index}}</th>
        <td>{{$sale->created_at->translatedFormat('d-m-Y H:i:s')}}</td>
        <td>{{$sale->user->name}}</td>
        <td>Rp. {{number_format($sale->total_pembayaran)}}</td>
        <td>{{$sale->metode_pembayaran}}</td>
        <td>{{$sale->status}}</td>
        <td class="d-flex gap-2">
            <!-- PERBAIKAN: Menambahkan parameter $sale dan menutup kurung sintaks Blade }} dengan benar -->
            <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-detail">Detail</a>
            @can('view', $sale)
            ||
            <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-edit-akun">Edit</a>
            @endcan
            @can('delete', $sale)
            ||
            <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-hapus" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                    Hapus
                </button>
            </form>
            @endcan
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7">Data Tidak Ditemukan</td>
    </tr>
    @endforelse
    </tbody>
</table>
<div class="d-flex justify-content-end mt-4 pagination-wrapper">
    {{$sales->links()}}
</div>
</div>

@endsection
