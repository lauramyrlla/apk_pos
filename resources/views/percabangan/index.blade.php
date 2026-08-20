@extends('layouts.app')

@section('content')
    @include('layouts.navbar')

    <div class="container mt-4">
        <h1>Ini Halaman Percabangan</h1>

        <h2>Data</h2>
        
        {{-- Logika Percabangan Laravel (Blade) --}}
        @php
            $nilai = 85;
        @endphp
        
        <p id="hasil">
            @if($nilai >= 75)
                Lulus
            @else
                Tidak Lulus
            @endif
        </p>
    </div>
@endsection
