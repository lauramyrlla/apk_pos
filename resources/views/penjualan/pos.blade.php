@extends('layouts.app')

@section('title', 'POS')

@section('content')

@include('layouts.navbar')

<div class="container penjualan-page py-4">

    @if(session('errors'))
        <div class="alert alert-danger">
            {{ session('errors') }}
        </div>
    @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">
            🐾 {{ $mode === 'edit' ? 'Edit Penjualan' : "Tambah Penjualan" }}
        </h4>

         <a href="{{ route('penjualan.index') }}" class="btn btn-secondary mt-3" style="padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">Kembali</a>
    </div>

    <div class="row">

        {{-- ===================== PRODUK ===================== --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-body" style="max-height:70vh; overflow:auto">
                    
                    <div class="mb-3">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Cari produk..."
                                onkeyup="this.form.submit()">
                        </form>
                    </div>

                    @foreach($products as $product)
                    <form method="POST" action="{{ route('itempenjualan.store') }}" class="row mb-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="col-7">
                            <button class="btn btn-outline-primary w-100 text-start p-2 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                <div class="d-flex align-items-center gap-2">

                                    <div>
                                        <div class="fw-semibold"> {{ $product->nama }}</div>
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
                                        min="1"
                                        class="form-control form-control-sm"
                                        style="width: 70px;"
                                        onchange="this.form.submit()">
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

                        <select name="payment_method" id="payment_method" class="form-select mb-2"
                            onchange="toggleMetodeBayar()"
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            <option value="">Pilih Pembayaran</option>
                            <option value="CASH">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>

                        {{-- Muncul kalau CASH --}}
                        <div id="cashBox" class="mb-2" style="display:none;">
                            <label class="form-label small">Uang Dibayar</label>
                            <input type="number" name="uang_dibayar" id="uang_dibayar"
                                class="form-control" placeholder="Masukkan nominal uang"
                                oninput="hitungKembalian()">
                            <small class="text-muted">Kembalian: Rp <span id="kembalianPreview">0</span></small>
                        </div>

                        {{-- Muncul kalau QRIS --}}
                        <div id="qrisBox" class="mb-2 text-center" style="display:none;">
                            {!! QrCode::size(200)->generate($qrisData) !!}
                            <div class="small text-muted">Scan QR untuk membayar Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</div>
                        </div>

                        <button class="btn btn-success w-100" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            Checkout
                        </button>
                    </form>

                    <script>
                    function toggleMetodeBayar() {
                        const val = document.getElementById('payment_method').value;
                        document.getElementById('cashBox').style.display = val === 'CASH' ? 'block' : 'none';
                        document.getElementById('qrisBox').style.display = val === 'QRIS' ? 'block' : 'none';
                    }

                    function hitungKembalian() {
                        const total = {{ $sale->total_pembayaran }};
                        const bayar = parseInt(document.getElementById('uang_dibayar').value) || 0;
                        const kembalian = bayar - total;
                        document.getElementById('kembalianPreview').innerText =
                            (kembalian > 0 ? kembalian : 0).toLocaleString('id-ID');
                    }
                    </script>

                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}" method="POST"
                    onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"class="mt-3" >
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