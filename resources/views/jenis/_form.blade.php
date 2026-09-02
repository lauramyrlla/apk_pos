<div class="form-produk-card">

    @csrf

    @if (!empty($jenis->foto))
        <div class="mb-3-custom">
            <label>Foto Saat Ini</label><br>
            <img src="{{ asset('storage/' . $jenis->foto) }}"
                 width="150"
                 class="img-thumbnail">
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="mb-3-custom">
                <label>🐾 Gambar</label>
                <input type="file"
                       name="foto"
                       onchange="previewImage(this)"
                       class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col">
            <div class="mb-3-custom">
                <label>Preview Foto</label><br>
                <img id="preview" class="img-thumbnail mt-2" style="display:none" width="150">
            </div>
        </div>
    </div>

    <div class="mb-3-custom">
        <label>Nama Jenis</label><br>
        <input type="text" name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $jenis->nama) ?? '' }}">
        @error('name')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- BENTUK DROPDOWN JENIS PRODUK SUDAH DIHAPUS DARI SINI -->

    <button class="btn btn-simpan mt-2" type="submit">Simpan</button>
    <a href="{{ route('jenis.index') }}" class="btn btn-secondary mt-2 ms-2" style="padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">Kembali</a>

</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const file = input.files[0];

    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}
</script>
