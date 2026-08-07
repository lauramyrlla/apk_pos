@extends('layouts.app') 

@section('title', 'Dashboard') 

@section('content') 
@include('layouts.navbar') 

<!-- 🟢 PERBAIKAN: Dibungkus dengan container agar grid row & col berfungsi normal -->
<div class="container mt-4"> 

    <div class="text-center mb-4"> 
        <h1> Ringkasan Hari Ini 
            <!-- 🟢 PERBAIKAN: Memperbaiki tanda petik penutup class text-muted -->
            <small class="text-muted"> ({{ $tanggalHariIni->translatedFormat('l, d F Y') }}) </small> 
        </h1> 
    </div> 

    <!-- Bagian 1: Today's Sales --> 
    <div class="row text-center mb-4"> 
        @can('viewAny', App\Models\User::class)
        <div class="col-md-12"> 
            <h1 class="text-start">Today's Sales</h1> 
        </div> 
        <div class="col-md-6 mb-3"> 
            <div class="card h-100"> 
                <div class="card-header fw-bold bg-light"> Total Nilai Penjualan Hari Ini </div> 
                <div class="card-body d-flex align-items-center justify-content-center"> 
                    <h5 class="card-title my-2"> Rp {{ number_format($ringkasan['total_penjualan']) }} </h5> 
                </div> 
            </div> 
        </div> 
        <div class="col-md-6 mb-3"> 
            <div class="card h-100"> 
                <div class="card-header fw-bold bg-light"> Jumlah Transaksi Hari ini </div> 
                <div class="card-body d-flex align-items-center justify-content-center"> 
                    <h5 class="card-title my-2">{{ $ringkasan['total_transaksi'] }} </h5> 
                </div> 
            </div> 
        </div> 
    </div> 

    <!-- Bagian 2: Cash & Payment Status --> 
    <div class="row text-center mb-4"> 
        <div class="col-md-12"> 
            <h1 class="text-start">Cash & Payment Status</h1> 
        </div> 
        <div class="col-md-6 mb-3"> 
            <div class="card h-100"> 
                <div class="card-header fw-bold bg-light"> Total pembayaran tunai </div> 
                <div class="card-body d-flex align-items-center justify-content-center"> 
                    <h5 class="card-title my-2">Rp {{ number_format($ringkasan['total_cash']) }}</h5> 
                </div> 
            </div> 
        </div> 
        <div class="col-md-6 mb-3"> 
            <div class="card h-100"> 
                <div class="card-header fw-bold bg-light"> Total pembayaran non-tunai </div> 
                <div class="card-body d-flex align-items-center justify-content-center"> 
                    <h5 class="card-title my-2">Rp {{ number_format($ringkasan['total_non_tunai']) }}</h5> 
                </div> 
            </div> 
        </div> 
    </div> 
    @endcan
    <!-- Bagian 3: Critical Inventory Status --> 
    <div class="row mb-4"> 
        <div class="col-md-12"> 
            <h1>Critical Inventory Status</h1> 
        </div> 
    </div> 
    
    <div class="row mb-4"> 
        <div class="col-md-6 mb-3"> 
            <h3>Daftar produk stok rendah</h3> 
            <table class="table table-bordered"> 
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
                            <td colspan="3" class="text-muted text-center"> Seluruh produk berada dalam kondisi stok aman. </td> 
                        </tr> 
                    @endforelse 
                </tbody> 
            </table> 
            {{ $produkStokRendah->links() }} 
        </div> 
        
        <div class="col-md-6 mb-3"> 
            <h3>Produk habis stok</h3> 
            <table class="table table-bordered"> 
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
                            <td colspan="3" class="text-muted text-center"> Seluruh produk berada dalam kondisi stok aman. </td> 
                        </tr> 
                    @endforelse 
                </tbody> 
            </table> 
            {{ $produkStokHabis->links() }} 
        </div> 
    </div> 

    <!-- Bagian 4: Best Seller Products --> 
    <div class="row mb-5"> 
        <div class="col-md-12"> 
            <h1>Best Seller Products</h1> 
        </div> 
        <div class="col-md-12"> 
            <table class="table table-bordered"> 
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
                            <td colspan="3" class="text-muted text-center"> Seluruh produk berada dalam kondisi stok aman. </td> 
                        </tr> 
                    @endforelse 
                </tbody> 
            </table> 
        </div> 
    </div> 

</div> <!-- 🟢 PERBAIKAN: Penutup tag container -->
@endsection
