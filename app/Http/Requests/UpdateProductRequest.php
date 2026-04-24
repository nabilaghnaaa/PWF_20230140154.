<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Http\Requests; // Menentukan namespace untuk class ini

use Illuminate\Foundation\Http\FormRequest; // Import class FormRequest dari Laravel

class UpdateProductRequest extends FormRequest // Deklarasi class UpdateProductRequest yang extends FormRequest
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
            'name' => 'sometimes|string|max:255', // Field name: opsional (sometimes), tipe string, max 255 karakter
            'qty' => 'sometimes|integer', // Field qty: opsional (sometimes), tipe integer
            'price' => 'sometimes|numeric', // Field price: opsional (sometimes), tipe numeric (bisa desimal)
            'user_id' => 'sometimes|exists:users,id', // Field user_id: opsional (sometimes), harus ada di tabel users kolom id
        ]; // Tutup array
    } // Tutup blok fungsi

    /**
     * Custom validation messages
     */
    public function messages(): array // Fungsi untuk mendapatkan pesan validasi custom (return array)
    { // Buka blok fungsi
        return [ // Return array berisi pesan error custom
            'name.string' => 'Nama produk harus berupa teks.', // Pesan custom jika field name bukan string
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.', // Pesan custom jika field name melebihi 255 karakter

            'qty.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).', // Pesan custom jika field qty bukan integer

            'price.numeric' => 'Harga produk harus berupa angka yang valid.', // Pesan custom jika field price bukan numeric

            'user_id.exists' => 'User yang dipilih tidak ditemukan di database.', // Pesan custom jika field user_id tidak ada di database
        ]; // Tutup array
    } // Tutup blok fungsi
} // Tutup blok class