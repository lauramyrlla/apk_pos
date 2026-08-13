@extends('layouts.app')

@section('title', 'Penjualan')

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

    .pagination-wrapper p {
        display: none !important;
    }

    .pagination-wrapper div:first-child {
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

    /* Tombol Detail */
    .btn-detail {
        background-color: #5f7a82;
        border-color: #5f7a82;
        color: #fff;
    }
    .btn-detail:hover {
        background-color: #4a636b;
        border-color: #4a636b;
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

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<h1>Halaman Penjualan</h1>
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
        
        <button class="btn btn-outline-secondery" type="submit">
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
        <a href="" class="btn btn-detail">Detail</a>
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