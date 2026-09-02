<?php

namespace App\Http\Requests\Jenis; 

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama Jenis wajib diisi.',
            'foto.image'    => 'File yang diupload harus berupa gambar.',
            'foto.mimes'    => 'Ekstensi gambar harus JPG, JPEG, atau PNG.',
            'foto.max'      => 'Ukuran gambar maksimal adalah 2MB.',
        ];
    }
}
