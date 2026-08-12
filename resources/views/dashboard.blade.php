@extends('layouts.app')

@section('title', 'Dashboard')

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

    .card {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(137, 168, 178, 0.2);
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 14px 30px rgba(137, 168, 178, 0.3);
    }

    .card .card-header {
        background: linear-gradient(135deg, #89A8B2, #B3C8CF);
        color: #fff;
        border: none;
        font-weight: 600;
        padding: 0.9rem 1.1rem;
    }

    .card .card-body {
        background: #fdfcfb;
        padding: 1.25rem;
    }

    .card .card-title {
        color: #4a636b;
        font-weight: 700;
        margin-bottom: 0;
    }

    h3 {
        font-size: 1.15rem;
        font-weight: 600;
        color: #5f7a82;
        text-align: left;
        margin-bottom: 0.75rem;
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
</style>

<div class="text-center container mt-4">
    <!-- Row 1: Today's Sales -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Today's Sales</h1>
        </div>
        <!-- Kolom Kiri: Total Nilai Penjualan -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total Nilai Penjualan Hari ini
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_penjualan']) }}</h5>
                </div>
            </div>
        </div>
        <!-- Kolom Kanan: Jumlah Transaksi -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Jumlah Transaksi Hari ini
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $ringkasan['total_transaksi'] }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 2: Cash & Payment Status -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Cash & Payment Status</h1>
        </div>
        <!-- Kolom Kiri: Total Pembayaran Tunai -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total pembayaran tunai
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_cash']) }}</h5>
                </div>
            </div>
        </div>
        <!-- Kolom Kanan: Total Pembayaran Non-Tunai -->
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header">
                    Total pembayaran non-tunai
                </div>
                <div class="card-body">
                    <h5 class="card-title">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Row 3: Critical Inventory Status -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Critical Inventory Status</h1>
        </div>
        <div class="col-md-6">
            <h3>Daftar produk stok rendah</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkStokRendah as $index => $produk)
                        <tr>
                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $produkStokRendah->links() }}
            </div>
        </div>
        <div class="col-md-6">
            <h3>Produk habis stok</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produkStokHabis as $index => $produk)
                        <tr>
                            <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                            <td>{{ $produk->nama }}</td>
                            <td>{{ $produk->stok }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted text-center">
                                Seluruh produk berada dalam kondisi stok aman.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {{ $produkStokHabis->links() }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Best Seller Products</h1>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Unit Terjual</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produkTerlaris as $produk)
                    <tr>
                        <td>{{ $produk->nama }}</td>
                        <td>{{ $produk->stok }}</td>
                        <td>{{ $produk->total_terjual }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted text-center">
                            Seluruh produk berada dalam kondisi stok aman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection