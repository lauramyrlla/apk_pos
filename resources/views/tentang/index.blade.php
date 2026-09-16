@extends('layouts.app')

@section('title', 'Tentang')

@section('content')

@include('layouts.navbar')

<div class="container tentang-page py-4">

    <h1 class="mb-3">🐾 Tentang Petshop</h1>

        <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3" style="padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">Kembali</a>
         <br>
         <br>
    <div class="card">
        <div class="card-header">
            Profil Toko
        </div>
        <div class="card-body">
            <p class="lead mb-4">
                Petshop kami menyediakan makanan kucing berkualitas tinggi serta berbagai kebutuhan kucing lainnya
                seperti mangkuk makan, water fountain, hingga produk perawatan kesehatan kucing — semua untuk anabul kesayangan Anda.
            </p>

            <hr>

            <div class="mb-4">
                <h3> Produk yang Kami Sediakan</h3>
                <ul class="mb-0">
                    <li>Makanan &amp; camilan kucing</li>
                    <li>Perlengkapan makan &amp; minum (mangkuk, water fountain)</li>
                    <li>Produk perawatan &amp; kesehatan kucing</li>
                    <li>Kebutuhan kucing lainnya</li>
                </ul>
            </div>

            <hr>

            <div class="mb-4">
                <h3>📍 Alamat Toko</h3>
                <p class="text-muted mb-0">Jl. Kucing Bahagia No. 123, Blok C, Kota Bandung, Jawa Barat</p>
            </div>

            <div>
                <h3>📞 Kontak & Layanan</h3>
                <p class="mb-1"><strong>WhatsApp:</strong> 0812-3456-7890</p>
                <p class="mb-0"><strong>Email:</strong> support@foodcat.com</p>
            </div>
        </div>
    </div>

</div>

@endsection