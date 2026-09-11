<div class="form-produk-card">
    @csrf

    <div class="mb-3-custom">
        <label>Nama Jenis</label><br>
        <input type="text" 
               name="nama_jenis"
               placeholder="Masukkan Kategori"
               class="form-control @error('nama_jenis') is-invalid @enderror"
               value="{{ old('nama_jenis', $jenis->nama_jenis ?? '') }}">
        @error('nama_jenis')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <button class="btn btn-simpan mt-2" type="submit">Simpan</button>
    <a href="{{ route('jenis.index') }}" class="btn btn-secondary mt-2 ms-2" style="padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">Kembali</a>
</div>