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
            'nama_jenis' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nama_jenis.required' => 'Nama Jenis wajib diisi.',
            'nama_jenis.string'   => 'Nama Jenis harus berupa teks.',
            'nama_jenis.max'      => 'Nama Jenis maksimal 255 karakter.',
        ];
    }
}