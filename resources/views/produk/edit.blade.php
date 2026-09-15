@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="form-produk-wrapper">
<h4>Edit Produk</h4>
</div>

<form action="{{ route('produk.update', $produk) }}"
      method="POST"
      enctype="multipart/form-data">
@method('PUT')

@include('produk._form')
</form>
@endsection
