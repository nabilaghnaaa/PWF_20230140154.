<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Http\Controllers; // Menentukan namespace untuk class ini

use App\Models\Category; // Import model Category
use Illuminate\Http\Request; // Import class Request dari Laravel

class CategoryController extends Controller // Deklarasi class CategoryController yang extends Controller
{ // Buka blok class
    // READ: Menampilkan semua category
    public function index() // Fungsi untuk menampilkan daftar semua category
    { // Buka blok fungsi
        // Ambil semua category + jumlah product di tiap category
        $categories = Category::withCount('products')->get(); // Query ambil semua category dengan hitung jumlah products

        return view('category.index', compact('categories')); // Return/tampilkan view dengan data categories
    } // Tutup blok fungsi

    // CREATE: Tampilkan form tambah category
    public function create() // Fungsi untuk menampilkan form tambah category
    { // Buka blok fungsi
        return view('category.create'); // Return/tampilkan view form create category
    } // Tutup blok fungsi

    // STORE: Simpan data category baru
    public function store(Request $request) // Fungsi untuk menyimpan data category baru dari form
    { // Buka blok fungsi
        // Validasi input
        $request->validate([ // Validasi data yang dikirim dari form
            'name' => 'required' // Field name harus diisi (required)
        ]); // Tutup validasi

        // Simpan ke database
        Category::create([ // Buat record category baru di database
            'name' => $request->name // Isi field name dengan input dari form
        ]); // Tutup create

        return redirect('/category')->with('success', 'Category berhasil ditambahkan'); // Redirect ke halaman category dengan pesan sukses
    } // Tutup blok fungsi

    // EDIT: Tampilkan form edit category
    public function edit($id) // Fungsi untuk menampilkan form edit category dengan ID parameter
    { // Buka blok fungsi
        // Cari data category berdasarkan ID
        $category = Category::findOrFail($id); // Cari category berdasarkan ID, jika tidak ada maka error 404

        return view('category.edit', compact('category')); // Return/tampilkan view dengan data category
    } // Tutup blok fungsi

    // UPDATE: Update data category
    public function update(Request $request, $id) // Fungsi untuk update data category dengan data dari form dan ID parameter
    { // Buka blok fungsi
        // Validasi input
        $request->validate([ // Validasi data yang dikirim dari form
            'name' => 'required' // Field name harus diisi (required)
        ]); // Tutup validasi

        // Cari data lalu update
        $category = Category::findOrFail($id); // Cari category berdasarkan ID, jika tidak ada maka error 404
        $category->update([ // Update record category yang ditemukan
            'name' => $request->name // Update field name dengan input baru dari form
        ]); // Tutup update

        return redirect('/category')->with('success', 'Category berhasil diupdate'); // Redirect ke halaman category dengan pesan sukses
    } // Tutup blok fungsi

    // DELETE: Hapus category
    public function destroy($id) // Fungsi untuk menghapus category dengan ID parameter
    { // Buka blok fungsi
        // Cari data category
        $category = Category::findOrFail($id); // Cari category berdasarkan ID, jika tidak ada maka error 404

        // Hapus dari database
        $category->delete(); // Hapus record category dari database

        return redirect('/category')->with('success', 'Category berhasil dihapus'); // Redirect ke halaman category dengan pesan sukses
    } // Tutup blok fungsi
} // Tutup blok class