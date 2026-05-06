<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'stock' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Category wajib dipilih.',
            'category_id.exists' => 'Category tidak ditemukan.',

            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

            'price.required' => 'Harga produk wajib diisi.',
            'price.integer' => 'Harga produk harus berupa angka bulat.',
            'price.min' => 'Harga produk tidak boleh kurang dari 0.',

            'stock.integer' => 'Stok produk harus berupa angka bulat.',
            'stock.min' => 'Stok produk tidak boleh kurang dari 0.',

            'description.string' => 'Deskripsi produk harus berupa teks.',
        ];
    }
}