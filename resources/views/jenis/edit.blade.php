@extends('layouts.app')

@section('title', 'Edit Jenis')

@section('content')
<div class="form-jenis-wrapper container py-4">
    <h4>Edit Jenis</h4>

    <form action="{{ route('jenis.update', $jenis) }}" method="POST">
        @method('PUT')
        @include('jenis._form')
    </form>
</div>
@endsection