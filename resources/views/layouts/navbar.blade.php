<nav class="navbar navbar-expand-lg navbar-light bg-light"> 
    <div class="container"> 
        <a class="navbar-brand" href="#">POS</a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
            <span class="navbar-toggler-icon"></span> 
        </button> 
        <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
                <li class="nav-item"> 
                    <!\
                    
                    -- 1. PERBAIKAN: Menghapus 'disabled' & memperbaiki nama route menjadi 'dashboard' -->
                    <a class="nav-link {{ Request::Is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a> 
                </li> 

                <li class="nav-item">
    <a class="nav-link {{ Request::Is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
</li>
                <li class="nav-item"> 
                    <a class="nav-link {{ Request::Is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a> 
                </li>
            </ul> 
            
            <!-- 2. PERBAIKAN: Mengubah 'rout' menjadi 'route' pada fungsi logout -->
            <form action="{{ route('logout') }}" method="POST" class="d-flex align-items-center m-0"> 
                @csrf 
                <button type="submit" class="btn btn-danger btn-sm px-3 fw-bold">Logout</button> 
            </form> 
        </div> 
    </div> 
</nav>
