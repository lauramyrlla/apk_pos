<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Tambahan import untuk relasi kasir
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
    use HasFactory;
    
    protected $table = 'penjualan';
    
    protected $fillable = [
        'user_id',
        'total_pembayaran',
        'metode_pembayaran',
        'status'
    ];

    /**
     * 💡 KUNCI JAWABAN: Fungsi ini yang menghubungkan data Penjualan ke tabel Users (Kasir)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemPenjualan(): HasMany
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }
}
