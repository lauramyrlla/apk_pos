@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')


<div class="text-center container mt-4 dashboard-page py-4">
    <!-- Row 1: Today's Sales -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Penjualan Hari Ini</h1>
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
            <h1>Status Kas & Pembayaran</h1>
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
            <h1>Status Stok Kritis</h1>
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
            <h1>Produk Terlaris</h1>
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