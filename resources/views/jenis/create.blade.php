@extends('layouts.app')

@section('content')
<div class="form-jenis-wrapper">
    <h4>Tambah Jenis</h4>

    <form action="..." method="POST" enctype="multipart/form-data">
        @include('jenis._form')
    </form>
</div>
@endsection