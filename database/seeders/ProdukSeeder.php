<?php

namespace Database\Seeders;

use App\Models\Jenis;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada User dan Jenis terlebih dahulu untuk relasi
        $user = User::first() ?? User::factory()->create();
        $jenis = Jenis::first() ?? Jenis::factory()->create();

        Produk::factory()->count(100)->create([
            'user_id'  => $user->id,
            'jenis_id' => $jenis->id,
        ]);
    }
}