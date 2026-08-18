@include('layouts.navbar')

@extends('layouts.app')

@section('content')


<h1 class="h3 mb-4 text-gray-800">ini halaman Perulangan</h1>


<html lang="id">
<body>

    <h2>Daftar Perulangan</h2>
    <ul id="daftar-item"></ul>

    <script>
        const wadah = document.getElementById('daftar-item');

        // Perulangan 5 kali
        for (let i = 1; i <= 5; i++) {
            const li = document.createElement('li');
            li.textContent = 'Baris ke-' + i;
            wadah.appendChild(li);
        }
    </script>

</body>
</html>

