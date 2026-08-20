@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<h4>Tambah Pengguna</h4>

<!-- Form diarahkan ke rute user, bukan produk -->
<form action="{{ route('admin.users.store') }}" method="POST">
    <!-- 🛠️ PERBAIKAN UTAMA: Memanggil '_form' milik folder users, bukan produk -->
    @include('users._form')
</form>
@endsection
