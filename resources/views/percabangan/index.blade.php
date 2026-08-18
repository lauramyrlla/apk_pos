@include('layouts.navbar')

@extends('layouts.app')

@section('content')



<h1>ini halaman Percabangan</h1>


<html lang="id">
<body>

    <h2>Data</h2>
    <p id="hasil"></p>

<script>
    let nilai = 85;
    let status = (nilai >= 75) ? "Lulus" : "Tidak Lulus";
    
    // Tampilkan ke elemen <p id="hasil">
    document.getElementById('hasil').innerText = status;
</script>

</body>
</html>



