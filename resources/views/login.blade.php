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
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .card-header svg {
        width: 24px;
        height: 24px;
        fill: #fff;
        flex-shrink: 0;
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

    /* Toggle mata buat lihat password */
    .password-wrapper {
        position: relative;
    }

    .password-wrapper .form-control {
        padding-right: 2.75rem;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 0.9rem;
        transform: translateY(-50%);
        background: none;
        border: none;
        padding: 0;
        color: #89A8B2;
        cursor: pointer;
        display: flex;
        align-items: center;
    }

    .toggle-password:hover {
        color: #4a636b;
    }

    .toggle-password svg {
        width: 20px;
        height: 20px;
    }
</style>

<div class="login-wrapper">
    <div class="card login-card text-center">
        <h5 class="card-header">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <path d="M8 1a3.5 3.5 0 0 0-3.5 3.5V7H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1h-.5V4.5A3.5 3.5 0 0 0 8 1zm2.5 6h-5V4.5a2.5 2.5 0 0 1 5 0V7z"/>
            </svg>
            Masuk POS
        </h5>
        <div class="card-body">
            <form action="{{ route('auth') }}" method="POST">
                @csrf
                <div class="mb-3 text-start">
                    <label for="exampleInputEmail1" class="form-label">Alamat email</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    @error('email')
                        <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4 text-start">
                    <label for="exampleInputPassword1" class="form-label">Kata sandi</label>
                    <div class="password-wrapper">
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Tampilkan kata sandi">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-login">Masuk</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('exampleInputPassword1');
        const eyeIcon = document.getElementById('eyeIcon');

        const eyeOpen = `<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                          <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>`;

        const eyeClosed = `<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 2.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                            <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                            <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z"/>
                            <path d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>`;

        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeIcon.innerHTML = isPassword ? eyeClosed : eyeOpen;
            toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
        });
    });
</script>
@endsection