<div class="form-produk-card">
    @csrf

    <div class="row">
        <!-- Input Upload Foto -->
        <div class="col">
            <div class="mb-3-custom">
                <label>Gambar</label>

                <div class="upload-dropzone" id="dropzone">
                    <p class="upload-text">Tarik file ke sini, atau</p>
                    <button type="button" class="btn btn-pilih-file" id="btnPilihFile">Pilih file</button>
                    <p class="upload-hint">PNG, JPG · maks 2MB</p>
                </div>

                <input type="file"
                       id="fotoInput"
                       name="foto"
                       accept="image/png, image/jpeg, image/jpg"
                       class="d-none @error('foto') is-invalid @enderror">

                @error('foto')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Preview Foto -->
        <div class="col">
            <div class="mb-3-custom">
                <label>Preview foto</label>
                <div class="preview-box">
                    @if (!empty($produk->foto))
                        <img id="preview" src="{{ asset('storage/' . $produk->foto) }}" class="preview-img" style="max-width: 100%; height: auto; display: block;">
                    @else
                        <img id="preview" class="preview-img" style="display: none; max-width: 100%; height: auto;">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Dropdown Relasi Jenis Produk -->
    <div class="mb-3-custom">
        <label>Jenis Produk</label><br>
        <select name="jenis_id" class="form-control @error('jenis_id') is-invalid @enderror">
            <option value="">-- Pilih Jenis Produk --</option>
            @foreach ($jenis as $item)
                <option value="{{ $item->id }}" 
                    {{ old('jenis_id', $produk->jenis_id ?? '') == $item->id ? 'selected' : '' }}>
                    {{ $item->nama_jenis }}
                </option>
            @endforeach
        </select>
        @error('jenis_id')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Nama Produk (Disesuaikan ke 'name') -->
    <div class="mb-3-custom">
        <label>Nama Produk</label><br>
        <input type="text" name="name" 
               class="form-control @error('name') is-invalid @enderror" 
               value="{{ old('name', $produk->nama ?? '') }}"
               placeholder="Masukan Nama Produk"> 
        @error('name')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Harga Beli (Disesuaikan ke 'purchase_price') -->
    <div class="mb-3-custom">
        <label>Harga Beli</label><br>
        <input type="number" name="purchase_price"
               class="form-control @error('purchase_price') is-invalid @enderror"
               value="{{ old('purchase_price', $produk->harga_beli ?? '') }}"
               placeholder="Masukan Harga Beli">
        @error('purchase_price')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Harga Jual (Disesuaikan ke 'selling_price') -->
    <div class="mb-3-custom">
        <label>Harga Jual</label><br>
        <input type="number" name="selling_price"
               class="form-control @error('selling_price') is-invalid @enderror"
               value="{{ old('selling_price', $produk->harga_jual ?? '') }}"
               placeholder="Masukan Harga Jual"> 
        @error('selling_price')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Stok (Disesuaikan ke 'stock') -->
    <div class="mb-3-custom">
        <label>Stok</label><br>
        <input type="number" name="stock"
               class="form-control @error('stock') is-invalid @enderror"
               value="{{ old('stock', $produk->stok ?? '') }}"
               placeholder="Masukan Jumlah Stok"> 
        @error('stock')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Tombol Aksi -->
    <button class="btn btn-simpan mt-2" type="submit">Simpan</button>
    <a href="{{ route('produk.index') }}" class="btn btn-secondary mt-2 ms-2" style="padding: 10px 20px; border-radius: 8px; text-decoration: none; display: inline-block;">Kembali</a>
</div>

<!-- Script Preview & Drag-and-Drop -->
<script>
function renderPreview(file) {
    const preview = document.getElementById('preview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const dropzone = document.getElementById('dropzone');
    const fotoInput = document.getElementById('fotoInput');
    const btnPilihFile = document.getElementById('btnPilihFile');

    if (!dropzone || !fotoInput) return;

    // Trigger klik input file
    dropzone.addEventListener('click', function (e) {
        fotoInput.click();
    });

    if (btnPilihFile) {
        btnPilihFile.addEventListener('click', function (e) {
            e.stopPropagation();
            fotoInput.click();
        });
    }

    fotoInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            renderPreview(this.files[0]);
        }
    });

    ['dragover', 'dragenter'].forEach(evt => {
        dropzone.addEventListener(evt, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('dragover');
        });
    });

    ['dragleave', 'drop'].forEach(evt => {
        dropzone.addEventListener(evt, function (e) {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('dragover');
        });
    });

    dropzone.addEventListener('drop', function (e) {
        const files = e.dataTransfer.files;
        if (files && files.length > 0) {
            fotoInput.files = files;
            renderPreview(files[0]);
        }
    });
});
</script>