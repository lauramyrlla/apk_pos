<?php

namespace App\Http\Requests\Produk;

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
            'jenis_id'       => ['required', 'exists:jenis,id'],
            'name'           => ['required', 'string', 'max:255'],
            'purchase_price' => ['required', 'integer', 'min:0'],
            'selling_price'  => ['required', 'integer', 'min:0'],
            'stock'          => ['required', 'integer', 'min:0'],
            'foto'           => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'jenis_id.required'       => 'Jenis produk wajib dipilih.',
            'jenis_id.exists'         => 'Jenis produk yang dipilih tidak valid.',
            'name.required'           => 'Nama produk wajib diisi.',
            'purchase_price.required' => 'Harga beli wajib diisi.',
            'selling_price.required'  => 'Harga jual wajib diisi.',
            'stock.required'          => 'Stok wajib diisi.',
            'foto.image'              => 'File harus berupa gambar.',
            'foto.max'                => 'Ukuran foto maksimal 2MB.',
        ];
    }
}