<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand brand-badge" href="#">
            <span class="brand-icon">🐾</span>
            <span class="brand-text">POS <span class="brand-accent">Food Cat</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('jenis') ? 'active' : '' }}" href="{{ route('jenis.index') }}">Jenis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
                </li>
            </ul>

            <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center m-0">
                @csrf
                <button type="submit" class="btn btn-logout btn-sm px-3 fw-bold">Keluar</button>
            </form>
        </div>
    </div>
</nav>

<style>
    .navbar {
        padding-top: .7rem;
        padding-bottom: .7rem;
        border-bottom: 1px solid #d9e3e6;
    }

    /* Brand */
    .brand-badge {
        display: flex;
        align-items: center;
        gap: .5rem;
        padding: .3rem .8rem;
        border-radius: 50px;
        background: linear-gradient(135deg, #E5E1DA 0%, #B3C8CF 100%);
        transition: transform .15s ease;
    }
    .brand-badge:hover {
        transform: translateY(-1px);
    }
    .brand-icon {
        font-size: 1.15rem;
    }
    .brand-text {
        font-weight: 700;
        letter-spacing: .3px;
        color: #4a636b;
        font-size: 1rem;
        text-transform: none;
    }
    .brand-accent {
        color: #89A8B2;
        font-weight: 800;
    }

    /* Nav links */
    .navbar-nav .nav-link {
        color: #5f7a82;
        font-weight: 500;
        padding: .5rem .9rem;
        border-radius: 8px;
        margin: 0 2px;
        position: relative;
        transition: background-color .15s ease, color .15s ease;
    }
    .navbar-nav .nav-link:hover {
        background-color: #f2f6f7;
        color: #4a636b;
    }
    .navbar-nav .nav-link.active {
        color: #fff;
        background-color: #89A8B2;
        font-weight: 600;
    }

    /* Logout button */
    .btn-logout {
        background-color: #a9746e;
        border-color: #a9746e;
        color: #fff;
        border-radius: 50px;
    }
    .btn-logout:hover {
        background-color: #925f59;
        border-color: #925f59;
        color: #fff;
    }
</style>