@extends('layouts.app')

@section('title', 'POS')

@section('content')

@include('layouts.navbar')

<style>
    body {
        background: linear-gradient(135deg, #B3C8CF 0%, #E5E1DA 100%);
        min-height: 100vh;
    }

    .container.py-4 h4 {
        font-weight: 700;
        color: #4a636b;
    }

    .card {
        background: #fdfcfb;
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(137, 168, 178, 0.15);
    }

    /* Daftar produk (kiri) */
    .form-control:focus {
        border-color: #89A8B2;
        box-shadow: 0 0 0 0.2rem rgba(137, 168, 178, 0.25);
    }

    .btn-outline-primary {
        color: #4a636b;
        border-color: #d9e3e6;
        background: #fff;
    }
    .btn-outline-primary:hover {
        background-color: #f2f6f7;
        border-color: #89A8B2;
        color: #4a636b;
    }

    .btn-primary {
        background-color: #89A8B2;
        border-color: #89A8B2;
    }
    .btn-primary:hover {
        background-color: #6f939d;
        border-color: #6f939d;
    }

    /* Tabel keranjang (kanan) */
    .table {
        background: #fdfcfb;
        margin-bottom: 0;
    }

    .table thead tr {
        background: linear-gradient(135deg, #89A8B2, #B3C8CF);
        color: #fff;
    }

    .table thead th {
        border: none;
        font-weight: 600;
        padding: 0.7rem;
    }

    .table tbody tr {
        border-bottom: 1px solid #e5e1da;
    }

    .table tbody td {
        padding: 0.6rem 0.7rem;
        color: #5f7a82;
        vertical-align: middle;
    }

    .card-footer {
        background: #f2f6f7;
        border-top: 1px solid #e5e1da;
        padding: 1rem 1.25rem;
    }

    .card-footer strong {
        color: #4a636b;
        display: block;
        margin-bottom: 0.6rem;
    }

    /* Tombol checkout senada tombol Tambah di halaman Produk */
    .btn-success {
        background-color: #4a636b;
        border-color: #4a636b;
    }
    .btn-success:hover {
        background-color: #3a4f56;
        border-color: #3a4f56;
    }

    /* Tombol hapus/batal senada tombol Hapus di halaman Produk */
    .btn-danger {
        background-color: #a9746e;
        border-color: #a9746e;
    }
    .btn-danger:hover {
        background-color: #925f59;
        border-color: #925f59;
    }

    .btn-outline-danger {
        color: #a9746e;
        border-color: #a9746e;
    }
    .btn-outline-danger:hover {
        background-color: #a9746e;
        border-color: #a9746e;
        color: #fff;
    }

    .btn-danger.btn-sm {
        background-color: #a9746e;
        border-color: #a9746e;
    }
</style>

<div class="container py-4">

    @if(session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

    <h4 class="mb-3">
        🐾 {{ $mode === 'edit' ? 'Edit Penjualan' : "Tambah Penjualan" }}
    </h4>

    <div class="row">

        {{-- ===================== PRODUK ===================== --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="max-height:70vh; overflow:auto">
                    
                    <!-- PERBAIKAN 1: Merapikan struktur form pencarian produk agar tidak tabrakan -->
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Cari produk..."
                                onkeyup="this.form.submit()">
                        </form>
                    </div>>

                    @foreach($products as $product)
                    <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="col-7">
                            <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <div class="d-flex align-items-center gap-2">

                                    {{-- Gambar produk --}}

                                    {{-- Nama & harga --}}
                                    <div>
                                        <div class="fw-semibold">🍖 {{ $product->nama }}</div>
                                        <small class="text-muted">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</small>
                                    </div>

                                </div>
                            </button>
                        </div>

                        <div class="col-3">
                            <input type="number" name="quantity" value="1" min="1" class="form-control" {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                        </div>

                        <div class="col-2">
                            <button class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">+</button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ===================== KERANJANG ===================== --}}
        <div class="col-md-6">
            <div class="card">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sale->itemPenjualan as $item)
                        <tr>
                            <td>{{ $item->produk->nama }}</td>
                            <td>Rp.{{number_format($item->produk->harga_jual)}}</td>
                            <td>
                                <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                    @csrf @method('PUT')
                                    <input type="number" name="quantity"
                                        value="{{ $item->kuantitas }}"
                                        class="form-control form-control-sm"
                                        style="width: 70px;">
                                </form>
                            </td>
                            <td >Rp {{ number_format($item->subtotal) }}</td>
                            <td>
                               @if(auth()->user()->role_id === 1)
                                <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                    @csrf  @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-3 text-muted">
                                🐾 Keranjang masih kosong
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="card-footer">
                    <strong>Total: Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</strong>
                    
                    <form method="POST"
                        action="{{ route('penjualan.update', $sale->id) }}"
                        onsubmit="return confirm('Yakin ingin checkout?')" class="mt-2">
                    @csrf
                    @method('PUT')

                        <select name="payment_method" class="form-select mb-2" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        <button class="btn btn-success w-100" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            Checkout
                        </button>
                    </form>
                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin membatalkan transaksi?')" >
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            Batal Transaksi
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@endsection