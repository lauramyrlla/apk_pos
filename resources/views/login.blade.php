@extends('layouts.app')

@section('title', 'ini Halaman Ujicoba')

@section('content')
<style>
    .login-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: linear-gradient(135deg, #B3C8CF 0%, #E5E1DA 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .login-card {
        width: 22rem;
        border: none;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 20px 45px rgba(137, 168, 178, 0.35);
        animation: fadeInUp 0.5s ease-out;
        position: relative;
        z-index: 2;
    }

    .login-card .card-header {
        background: linear-gradient(135deg, #89A8B2, #B3C8CF);
        color: #fff;
        border: none;
        padding: 1.5rem 1rem;
        font-weight: 600;
        font-size: 1.25rem;
        letter-spacing: 0.5px;
    }

    .login-card .card-body {
        background: #fdfcfb;
        padding: 2rem 1.75rem;
    }

    .login-card .form-control {
        border-radius: 0.75rem;
        border: 1px solid #d9e3e6;
        padding: 0.6rem 0.9rem;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
        background: #f6f8f8;
    }

    .login-card .form-control:focus {
        border-color: #89A8B2;
        box-shadow: 0 0 0 0.2rem rgba(137, 168, 178, 0.3);
        background: #fff;
    }

    .login-card .form-label {
        font-weight: 500;
        color: #5f7a82;
    }

    .btn-login {
        background: linear-gradient(135deg, #89A8B2, #6f939d);
        border: none;
        border-radius: 0.75rem;
        padding: 0.6rem;
        font-weight: 600;
        color: #fff;
        width: 100%;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(137, 168, 178, 0.4);
        color: #fff;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="login-wrapper">
    <div class="card login-card text-center">
        <h5 class="card-header">🔐 Login POS</h5>
        <div class="card-body">
            <form action="{{ route('auth') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('email')
                        <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 text-start">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    @error('password')
                        <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection