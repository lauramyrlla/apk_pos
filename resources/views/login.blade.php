@extends('layouts.app')

@section('title', 'Masuk - POS Food Cat')

@section('content')

<div class="login-wrapper">
    <div class="login-shell">

        {{-- Panel kiri: branding --}}
        <div class="login-brand">
            <div class="paw-pattern">
                @for ($i = 0; $i < 15; $i++)
                    🐾
                @endfor
            </div>

            <div class="brand-top">
                <div class="brand-badge">🐾 POS Food Cat</div>
                <h2>Sistem Pengelolaan Toko Makanan Kucing</h2>
                <p>Pantau stok produk dan catat transaksi penjualan harian dengan cepat, aman, dan efisien.</p>
            </div>

            <div class="cat-illustration">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                    <!-- Ekor -->
                    <path d="M155 150 Q185 130 175 90 Q170 70 150 75" fill="none" stroke="#fff" stroke-width="12" stroke-linecap="round" opacity="0.95"/>
                    <!-- Badan -->
                    <ellipse cx="100" cy="150" rx="55" ry="38" fill="#fff" opacity="0.95"/>
                    <!-- Kepala -->
                    <circle cx="100" cy="90" r="42" fill="#fff" opacity="0.95"/>
                    <!-- Telinga kiri -->
                    <path d="M68 62 L58 30 L92 55 Z" fill="#fff" opacity="0.95"/>
                    <path d="M70 58 L64 40 L84 54 Z" fill="#89A8B2"/>
                    <!-- Telinga kanan -->
                    <path d="M132 62 L142 30 L108 55 Z" fill="#fff" opacity="0.95"/>
                    <path d="M130 58 L136 40 L116 54 Z" fill="#89A8B2"/>
                    <!-- Mata -->
                    <ellipse cx="85" cy="88" rx="5" ry="7" fill="#4a636b"/>
                    <ellipse cx="115" cy="88" rx="5" ry="7" fill="#4a636b"/>
                    <!-- Hidung -->
                    <path d="M96 102 L104 102 L100 108 Z" fill="#d18b3c"/>
                    <!-- Mulut -->
                    <path d="M100 108 Q94 116 86 112" fill="none" stroke="#4a636b" stroke-width="2.5" stroke-linecap="round"/>
                    <path d="M100 108 Q106 116 114 112" fill="none" stroke="#4a636b" stroke-width="2.5" stroke-linecap="round"/>
                    <!-- Kumis kiri -->
                    <path d="M55 95 L78 92" stroke="#4a636b" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
                    <path d="M55 105 L78 102" stroke="#4a636b" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
                    <!-- Kumis kanan -->
                    <path d="M145 95 L122 92" stroke="#4a636b" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
                    <path d="M145 105 L122 102" stroke="#4a636b" stroke-width="1.5" stroke-linecap="round" opacity="0.6"/>
                    <!-- Corak pipi -->
                    <circle cx="70" cy="105" r="8" fill="#89A8B2" opacity="0.3"/>
                    <circle cx="130" cy="105" r="8" fill="#89A8B2" opacity="0.3"/>
                    <!-- Mangkuk makanan -->
                    <ellipse cx="100" cy="182" rx="30" ry="8" fill="#4a636b" opacity="0.25"/>
                    <path d="M75 172 Q75 190 100 190 Q125 190 125 172 Z" fill="#d18b3c" opacity="0.9"/>
                    <ellipse cx="100" cy="172" rx="25" ry="7" fill="#e7ab63"/>
                </svg>
            </div>

            <div class="brand-features">
                <div class="feature-item">
                    <i class="bi bi-graph-up-arrow"></i> Pantau penjualan real-time
                </div>
                <div class="feature-item">
                    <i class="bi bi-box-seam"></i> Kelola stok & jenis produk
                </div>
                <div class="feature-item">
                    <i class="bi bi-shield-check"></i> Akses aman berbasis peran
                </div>
            </div>
        </div>

        {{-- Panel kanan: form --}}
        <div class="login-form-panel">
            <h5>Siap Melayani Pelanggan?</h5>
            <p class="subtitle">Masuk ke akun Anda untuk mulai mencatat penjualan hari ini.</p>

            <form action="{{ route('auth') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Alamat email</label>
                    <div class="input-icon-group">
                        <i class="bi bi-envelope field-icon"></i>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="nama@email.com">
                    </div>
                    @error('email')
                        <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Kata sandi</label>
                    <div class="input-icon-group password-wrapper">
                        <i class="bi bi-lock field-icon"></i>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="••••••••">
                        <button type="button" class="toggle-password" id="togglePassword" aria-label="Tampilkan kata sandi">
                            <i class="bi bi-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="badge text-bg-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('exampleInputPassword1');
        const eyeIcon = document.getElementById('eyeIcon');

        toggleBtn.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            eyeIcon.classList.toggle('bi-eye', !isPassword);
            eyeIcon.classList.toggle('bi-eye-slash', isPassword);
            toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
        });
    });
</script>
@endsection