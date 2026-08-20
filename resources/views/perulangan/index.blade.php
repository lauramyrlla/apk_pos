@extends('layouts.app')

@section('content')

@include('layouts.navbar')

    <div class="container mt-4">
        <h1 class="h3 mb-4 text-gray-800">Ini Halaman Perulangan</h1>

        <h2>Daftar Perulangan</h2>
        <ul id="daftar-item">
            {{-- Perulangan 5 kali menggunakan Blade Laravel --}}
            @for ($i = 1; $i <= 5; $i++)
                <li>Baris ke-{{ $i }}</li>
            @endfor
        </ul>
    </div>
@endsection
