<style>
    body {
        background: linear-gradient(135deg, #B3C8CF 0%, #E5E1DA 100%);
        min-height: 100vh;
    }

    .form-user-card {
        background: #fdfcfb;
        border-radius: 0.75rem;
        box-shadow: 0 8px 20px rgba(137, 168, 178, 0.15);
        padding: 1.75rem;
        max-width: 560px;
    }

    .form-user-card .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #4a636b;
    }

    .form-user-card .form-control,
    .form-user-card .form-select {
        border: 1px solid #d9e3e6;
        border-radius: 0.5rem;
        padding: 0.55rem 0.8rem;
        color: #5f7a82;
    }

    .form-user-card .form-control:focus,
    .form-user-card .form-select:focus {
        border-color: #89A8B2;
        box-shadow: 0 0 0 0.2rem rgba(137, 168, 178, 0.25);
    }

    .form-user-card .form-control.is-invalid,
    .form-user-card .form-select.is-invalid {
        border-color: #a9746e;
    }

    .form-user-card .invalid-feedback {
        color: #a9746e;
    }

    /* Tombol Simpan senada tombol Tambah di halaman Produk */
    .form-user-card .btn-success {
        background-color: #4a636b;
        border-color: #4a636b;
    }
    .form-user-card .btn-success:hover {
        background-color: #3a4f56;
        border-color: #3a4f56;
    }

    /* Tombol Kembali senada tombol Edit di halaman Produk */
    .form-user-card .btn-secondary {
        background-color: #89A8B2;
        border-color: #89A8B2;
        color: #fff;
    }
    .form-user-card .btn-secondary:hover {
        background-color: #6f939d;
        border-color: #6f939d;
        color: #fff;
    }
</style>

<div class="form-user-card">

    @csrf

    <!-- Input Nama -->
    <div class="mb-3">
        <label class="form-label">Nama</label>
        <input type="text" 
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name ?? '') }}">
        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Input Email -->
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" 
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email ?? '') }}">
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Input Password -->
    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" 
               name="password"
               class="form-control @error('password') is-invalid @enderror">
        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Dropdown Role -->
    <div class="mb-3">
        <label class="form-label">Role</label>
        <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $role)
                <option value="{{ $role->id }}"
                 @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                    {{ ucfirst($role->name) }}
                </option>
            @endforeach
        </select>
        @error('role_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Tombol Aksi -->
    <button type="submit" class="btn btn-success">Simpan</button>

    <!-- 🛠️ PERBAIKAN DI SINI: Mengubah admin.users menjadi admin.users.index -->
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Kembali</a>

</div>