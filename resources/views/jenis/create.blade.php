@extends('layouts.app')

@section('content')
<div class="form-jenis-wrapper container py-4">
    <h4>Tambah Jenis</h4>

    <form action="{{ route('jenis.store') }}" method="POST">
        @include('jenis._form')
    </form>
</div>
@endsection