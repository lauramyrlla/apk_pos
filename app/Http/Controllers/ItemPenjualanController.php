<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk; 
use App\Models\ItemPenjualan; 

class ItemPenjualanController extends Controller
{
    public function index()
    {
        $products = Produk::with('user')->latest()->paginate(10)->onEachSide(1); 
        return view('jenis.index', compact('products')); 
    }

    public function create()
    {
        return view('jenis.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255', 
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        $item = ItemPenjualan::find($id);

        if ($item) {
            $item->delete();
        }

        return redirect()->back()->with('success', 'Item berhasil dihapus!');
    }
}
