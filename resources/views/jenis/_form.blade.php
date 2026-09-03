<div class="form-produk-card">

    @csrf

    <div class="row">
        <div class="col">
            <div class="mb-3-custom">
                <label>Gambar</label>

                <div class="upload-dropzone" id="dropzone" onclick="document.getElementById('fotoInput').click()">
                    <p class="upload-text">Tarik file ke sini, atau</p>
                    <button type="button" class="btn btn-pilih-file">Pilih file</button>
                    <p class="upload-hint">PNG, JPG · maks 2MB</p>
                </div>

                <input type="file"
                       id="fotoInput"
                       name="foto"
                       accept="image/png, image/jpeg, image/jpg"
                       onchange="previewImage(this)"
                       class="d-none @error('foto') is-invalid @enderror">

                @error('foto')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="col">
            <div class="mb-3-custom">
                <label>Preview foto</label>
                <div class="preview-box">
                    @if (!empty($jenis->foto))
                        <img id="preview" src="{{ asset('storage/' . $jenis->foto) }}" class="preview-img">
                    @else
                        <img id="preview" class="preview-img" style="display:none">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3-custom">
        <label>Nama jenis</label><br>
        <input type="text" name="name"
               placeholder="Masukan Kategori"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $jenis->nama) ?? '' }}">
        @error('name')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>

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

(function () {
    const dropzone = document.getElementById('dropzone');
    const fotoInput = document.getElementById('fotoInput');

    ['dragover', 'dragenter'].forEach(evt => {
        dropzone.addEventListener(evt, function (e) {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(evt => {
        dropzone.addEventListener(evt, function (e) {
            e.preventDefault();
            dropzone.classList.remove('dragover');
        });
    });

    dropzone.addEventListener('drop', function (e) {
        const files = e.dataTransfer.files;
        if (files.length) {
            fotoInput.files = files;
            previewImage(fotoInput);
        }
    });
})();
</script>