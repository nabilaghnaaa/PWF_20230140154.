<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Http\Requests; // Menentukan namespace untuk class ini

use Illuminate\Foundation\Http\FormRequest; // Import class FormRequest dari Laravel

class StoreProductRequest extends FormRequest // Deklarasi class StoreProductRequest yang extends FormRequest
{ // Buka blok class
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool // Fungsi untuk mengecek apakah user diizinkan membuat request ini (return boolean)
    { // Buka blok fungsi
        return true; // Return true untuk mengizinkan semua user membuat request ini
    } // Tutup blok fungsi

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array // Fungsi untuk mendapatkan aturan validasi yang apply ke request ini (return array)
    { // Buka blok fungsi
        return [ // Return array berisi aturan validasi
            'name' => 'required|string|max:255', // Field name: harus diisi, tipe string, max 255 karakter
            'quantity' => 'required|integer', // Field quantity: harus diisi, tipe integer
            'price' => 'required|numeric', // Field price: harus diisi, tipe numeric (bisa desimal)
        ]; // Tutup array
    } // Tutup blok fungsi

    public function messages(): array // Fungsi untuk mendapatkan pesan validasi custom (return array)
    { // Buka blok fungsi
        return [ // Return array berisi pesan error custom
            'name.required' => 'Nama produk wajib diisi.', // Pesan custom jika field name tidak diisi
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.', // Pesan custom jika field name melebihi 255 karakter

            'quantity.required' => 'Jumlah (kuantitas) produk wajib diisi.', // Pesan custom jika field quantity tidak diisi
            'quantity.integer' => 'Jumlah (kuantitas) produk harus berupa angka bulat (tidak boleh desimal).', // Pesan custom jika field quantity bukan integer

            'price.required' => 'Harga produk wajib diisi.', // Pesan custom jika field price tidak diisi
            'price.numeric' => 'Harga produk harus berupa angka yang valid (boleh desimal).', // Pesan custom jika field price bukan numeric
        ]; // Tutup array
    } // Tutup blok fungsi
} // Tutup blok class
