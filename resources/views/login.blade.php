@extends('layouts.app')

@section('title', 'Masuk - POS Food Cat')

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
        padding: 1rem;
    }

    .login-shell {
        width: 100%;
        max-width: 860px;
        min-height: 520px;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(137, 168, 178, 0.4);
        display: flex;
        animation: fadeInUp 0.5s ease-out;
        position: relative;
        z-index: 2;
    }

    /* ===== Panel kiri: branding ===== */
    .login-brand {
        flex: 1 1 45%;
        background: linear-gradient(160deg, #6f939d 0%, #89A8B2 45%, #B3C8CF 100%);
        color: #fff;
        padding: 2.75rem 2.25rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .login-brand .paw-pattern {
        position: absolute;
        inset: 0;
        opacity: 0.12;
        font-size: 2.4rem;
        line-height: 1;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1.5rem;
        padding: 1.5rem;
        pointer-events: none;
        transform: rotate(-8deg) scale(1.3);
    }

    .login-brand .brand-top {
        position: relative;
        z-index: 1;
    }

    .login-brand .brand-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.18);
        border-radius: 2rem;
        padding: 0.4rem 0.9rem;
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 1.75rem;
    }

    .login-brand h2 {
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 0.6rem;
        line-height: 1.3;
    }

    .login-brand p {
        color: rgba(255,255,255,0.85);
        font-size: 0.92rem;
        margin-bottom: 0;
    }

    .cat-illustration {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        margin: 0.5rem 0 1rem;
    }

    .cat-illustration svg {
        width: 150px;
        height: auto;
        filter: drop-shadow(0 10px 18px rgba(0,0,0,0.15));
    }

    .brand-features {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }

    .brand-features .feature-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.88rem;
        color: rgba(255,255,255,0.92);
    }

    .brand-features .feature-item i {
        background: rgba(255,255,255,0.2);
        border-radius: 0.5rem;
        width: 30px;
        height: 30px;
        min-width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    /* ===== Panel kanan: form ===== */
    .login-form-panel {
        flex: 1 1 55%;
        background: #fdfcfb;
        padding: 2.75rem 2.5rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-form-panel h5 {
        color: #3d545c;
        font-weight: 800;
        font-size: 1.4rem;
        margin-bottom: 0.25rem;
    }

    .login-form-panel .subtitle {
        color: #8a9aa0;
        font-size: 0.88rem;
        margin-bottom: 1.75rem;
    }

    .input-icon-group {
        position: relative;
    }

    .input-icon-group .field-icon {
        position: absolute;
        top: 50%;
        left: 0.9rem;
        transform: translateY(-50%);
        color: #89A8B2;
        font-size: 1.05rem;
        pointer-events: none;
    }

    .login-form-panel .form-control {
        border-radius: 0.75rem;
        border: 1px solid #d9e3e6;
        padding: 0.65rem 0.9rem 0.65rem 2.6rem;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
        background: #f6f8f8;
    }

    .password-wrapper .form-control {
        padding-right: 2.75rem;
    }

    .login-form-panel .form-control:focus {
        border-color: #89A8B2;
        box-shadow: 0 0 0 0.2rem rgba(137, 168, 178, 0.3);
        background: #fff;
    }

    .login-form-panel .form-label {
        font-weight: 600;
        color: #5f7a82;
        font-size: 0.88rem;
    }

    .form-check-label {
        font-size: 0.85rem;
        color: #7c9199;
    }

    .btn-login {
        background: linear-gradient(135deg, #89A8B2, #6f939d);
        border: none;
        border-radius: 0.75rem;
        padding: 0.65rem;
        font-weight: 700;
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
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
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

    .toggle-password:hover { color: #4a636b; }

    @media (max-width: 767px) {
        .login-shell { flex-direction: column; }
        .login-brand { padding: 2rem 1.75rem 1.5rem; }
        .brand-features { display: none; }
        .login-form-panel { padding: 2rem 1.75rem; }
    }
</style>

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
                <h2>Kelola toko makanan kucingmu lebih rapi</h2>
                <p>Catat penjualan, stok, dan produk dalam satu tempat — cepat dan gampang dipantau.</p>
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
            <h5>Selamat datang kembali</h5>
            <p class="subtitle">Masuk untuk melanjutkan ke dashboard POS.</p>

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