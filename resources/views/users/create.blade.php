@extends('layouts.app')

@section('content')
@include('layouts.navbar')
<div class="form-user-wrapper">
    <h4>Tambah Pengguna</h4>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @include('users._form')
    </form>
</div>
@endsection