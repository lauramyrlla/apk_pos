<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    <div class="container"> 
        <a class="navbar-brand" href="#">POS</a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="navbar-toggler-icon"></span> 
        </button> 
        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::Is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a> 
                </li> 

                <li class="nav-item">
                    <a class="nav-link {{ Request::Is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">Users</a>
                </li>
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::Is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::is('perulangan') ? 'active' : '' }}" href="{{ route('perulangan.index') }}">Perulangan</a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::is('percabangan') ? 'active' : '' }}" href="{{ route('percabangan.index') }}">Percabangan</a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Varian</a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Tipe Data</a> 
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
    .btn-logout {
        background-color: #a9746e;
        border-color: #a9746e;
        color: #fff;
    }
    .btn-logout:hover {
        background-color: #925f59;
        border-color: #925f59;
        color: #fff;
    }
</style>