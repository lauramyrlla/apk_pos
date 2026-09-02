<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use App\Models\User;
use App\Policies\DashboardPolicy;
use App\Models\Penjualan;
use App\Models\Produk;
use App\Models\ItemPenjualan;
use App\Policies\ItemPenjualanPolicy;
use App\Policies\PenjualanPolicy;
use App\Policies\ProdukPolicy;
use App\Models\Jenis;
use App\Policies\JenisPolicy;


class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
    User::class => DashboardPolicy::class,
    Produk::class => ProdukPolicy::class,
    Jenis::class => JenisPolicy::class,   // ← baris baru
    Penjualan::class => PenjualanPolicy::class,
    ItemPenjualan::class => ItemPenjualan::class
];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); 

        Paginator::useBootstrapFive();
        Carbon::setLocale('id');
    }
}
