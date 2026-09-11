@extends('layouts.app')

@section('content')
<div class="form-produk-wrapper">
    <h4>Tambah Produk</h4>

   
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @include('produk._form')
    </form>
</div>
@endsection