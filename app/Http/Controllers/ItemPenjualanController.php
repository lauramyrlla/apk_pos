<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\ItemPenjualan;
use App\Models\Penjualan;

class ItemPenjualanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $produk    = Produk::findOrFail($request->product_id);
        $penjualan = Penjualan::where('user_id', auth()->id())
            ->where('status', 'OPEN')
            ->firstOrFail();

        $item = $penjualan->itemPenjualan()->where('produk_id', $produk->id)->first();

        if ($item) {
            $item->kuantitas    += $request->quantity;
            $item->harga_satuan  = $produk->harga_jual;
            $item->subtotal      = $item->kuantitas * $produk->harga_jual;
            $item->save();
        } else {
            $penjualan->itemPenjualan()->create([
                'produk_id'    => $produk->id,
                'kuantitas'    => $request->quantity,
                'harga_satuan' => $produk->harga_jual,
                'subtotal'     => $produk->harga_jual * $request->quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $item   = ItemPenjualan::findOrFail($id);
        $produk = $item->produk;

        $item->kuantitas    = $request->quantity;
        $item->harga_satuan = $produk->harga_jual;
        $item->subtotal     = $produk->harga_jual * $request->quantity;
        $item->save();

        return redirect()->back()->with('success', 'Jumlah item diperbarui');
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