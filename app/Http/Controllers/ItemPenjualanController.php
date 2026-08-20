<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; 
use App\Models\Jenis; 

class JenisController extends Controller
{
    public function index()
    {
        // Tetap kirim $products ke halaman utama index
        $products = Produk::with('user')->latest()->paginate(10)->onEachSide(1); 

        return view('jenis.index', compact('products')); 
    }

    public function create()
    {
        // Kembalikan ke folder aslinya: resources/views/jenis/create.blade.php
        return view('jenis.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255', 
        ]);

        // Ini memanggil model Jenis yang sudah diberi $fillable tadi
        Jenis::create([
            'nama_jenis' => $request->nama_jenis, 
        ]);

        return redirect()->route('jenis.index')->with('success', 'Kategori baru berhasil ditambahkan!');
    }
}
