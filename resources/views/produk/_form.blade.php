<style>
    body {
        background: linear-gradient(135deg, #B3C8CF 0%, #E5E1DA 100%);
        min-height: 100vh;
    }

    .form-produk-card {
        background: #fdfcfb;
        border-radius: 0.75rem;
        box-shadow: 0 8px 20px rgba(137, 168, 178, 0.15);
        padding: 1.75rem;
        max-width: 640px;
    }

    .form-produk-card label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #4a636b;
        margin-bottom: 0.3rem;
        display: inline-block;
    }

    .form-produk-card .mb-3-custom {
        margin-bottom: 1.1rem;
    }

    .form-produk-card .form-control {
        border: 1px solid #d9e3e6;
        border-radius: 0.5rem;
        padding: 0.55rem 0.8rem;
        color: #5f7a82;
    }

    .form-produk-card .form-control:focus {
        border-color: #89A8B2;
        box-shadow: 0 0 0 0.2rem rgba(137, 168, 178, 0.25);
    }

    .form-produk-card .form-control.is-invalid {
        border-color: #a9746e;
    }

    .form-produk-card .invalid-feedback {
        color: #a9746e;
    }

    .form-produk-card .img-thumbnail {
        border: 1px solid #e5e1da;
        border-radius: 0.5rem;
        background: #fff;
    }

    .form-produk-card .btn-simpan {
        background-color: #4a636b;
        border-color: #4a636b;
        color: #fff;
        font-weight: 600;
        padding: 0.55rem 1.4rem;
        border-radius: 0.5rem;
    }

    .form-produk-card .btn-simpan:hover {
        background-color: #3a4f56;
        border-color: #3a4f56;
        color: #fff;
    }
</style>

<div class="form-produk-card">

    @csrf

    @if (!empty($produk->foto))
        <div class="mb-3-custom">
            <label>Foto Saat Ini</label><br>
            <img src="{{ asset('storage/' . $produk->foto) }}"
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
        <label>Nama Produk</label><br>
        <input type="text" name="name" 
               class="form-control @error('name') is-invalid @enderror" 
               value="{{ old('name', $produk->nama) ?? '' }}"> 
        @error('name')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3-custom">
        <label>Harga Beli</label><br>
        <input type="number" name="purchase_price"
               class="form-control @error('purchase_price') is-invalid @enderror"
               value="{{ old('purchase_price', $produk->harga_beli) ?? '' }}">
        @error('purchase_price')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3-custom">
        <label>Harga Jual</label><br>
        <input type="number" name="selling_price"
               class="form-control @error('selling_price') is-invalid @enderror"
               value="{{ old('selling_price', $produk->harga_jual) ?? '' }}"> 
        @error('selling_price')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-3-custom">
        <label>Stok</label><br>
        <input type="number" name="stock"
               class="form-control @error('stock') is-invalid @enderror"
               value="{{ old('stock', $produk->stok) ?? '' }}"> 
        @error('stock')
            <div class="invalid-feedback d-block"> 
                {{ $message }}
            </div>
        @enderror
    </div>

    <button class="btn btn-simpan mt-2" type="submit">Simpan</button>

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