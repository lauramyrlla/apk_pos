<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Requests\Jenis\UpdateRequest;
use App\Http\Requests\Jenis\StoreRequest;
use App\Models\Jenis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Jenis::class);

        $keyword = $request->input('search');

        $jenisList = Jenis::with('user')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama_jenis', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama_jenis')
            ->paginate(10)
            ->withQueryString();

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

        $data = [
            'user_id'    => Auth::id(),
            'nama_jenis' => $dataReq['nama_jenis'],
        ];

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
            'user_id'    => Auth::id(),
            'nama_jenis' => $dataReq['nama_jenis'],
        ];

        $jenis->update($data);

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil diperbarui.');
    }

    public function destroy(Jenis $jenis)
    {
        $this->authorize('delete', $jenis);

        DB::table('produk')->where('jenis_id', $jenis->id)->update(['jenis_id' => null]);

        $jenis->delete();

        return redirect()->route('jenis.index')->with('success', 'Jenis berhasil dihapus.');
    }
}