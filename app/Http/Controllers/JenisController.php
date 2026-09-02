<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\Jenis\UpdateRequest;
use App\Http\Requests\Jenis\StoreRequest;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Jenis::class);

        $keyword = $request->input('search');

        if ($keyword) {
            $jenisList = Jenis::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();
        } else {
            $jenisList = Jenis::latest()->paginate(10)->withQueryString();
        }

        return view('jenis.index', compact('jenisList'));
    }

    public function create()
    {
        $this->authorize('create', Jenis::class);

        $jenis = new Jenis();

        return view('jenis.create', compact('jenis'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Jenis::class);

        $dataReq = $request->validated();

        $data['user_id'] = Auth::id();
        $data['nama'] = $dataReq['name'];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('jenis', 'public');
        }

        Jenis::create($data);

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Jenis $jenis)
    {
        $this->authorize('update', $jenis);

        return view('jenis.edit', compact('jenis'));
    }

    public function update(UpdateRequest $request, Jenis $jenis)
    {
        $this->authorize('update', $jenis);

        $dataReq = $request->validated();

        $data = [
            'user_id' => Auth::id(),
            'nama'    => $dataReq['name'],
        ];

        if ($request->hasFile('foto')) {
            if ($jenis->foto && Storage::disk('public')->exists($jenis->foto)) {
                Storage::disk('public')->delete($jenis->foto);
            }
            $data['foto'] = $request->file('foto')->store('jenis', 'public');
        }

        $jenis->update($data);

        return redirect()->route('jenis.edit', $jenis->id)->with('success', 'Jenis berhasil diperbarui.');
    }

    public function destroy(Jenis $jenis)
    {
        $this->authorize('delete', $jenis);

        // Produk yang memakai jenis ini otomatis jadi tanpa jenis (jenis_id null)
        DB::table('produk')->where('jenis_id', $jenis->id)->update(['jenis_id' => null]);

        if ($jenis->foto) {
            Storage::disk('public')->delete($jenis->foto);
        }

        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus.');
    }
}