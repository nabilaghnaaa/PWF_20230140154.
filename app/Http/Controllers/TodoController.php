<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Http\Controllers; // Menentukan namespace untuk class ini

use Illuminate\Http\Request; // Import class Request dari Laravel
use App\Models\Todo; // Import model Todo
use Illuminate\Support\Facades\Auth; // Import Auth facade untuk autentikasi 

class TodoController extends Controller // Deklarasi class TodoController yang extends Controller
{ // Buka blok class
    // 🔹 TAMPIL DATA (FIX VIEW)
    public function index() // Fungsi untuk menampilkan daftar semua todo
    { // Buka blok fungsi
        $todos = Todo::all(); // Query ambil semua data todo dari database
        return view('todo', compact('todos')); // Return/tampilkan view dengan data todos
    } // Tutup blok fungsi

    // 🔹 HALAMAN CREATE
    public function create() // Fungsi untuk menampilkan form tambah todo
    { // Buka blok fungsi
        return view('todo.create'); // Return/tampilkan view form create todo
    } // Tutup blok fungsi

    // 🔥 STORE + VALIDASI
    public function store(Request $request) // Fungsi untuk menyimpan data todo baru dari form
    { // Buka blok fungsi
        $request->validate([ // Validasi semua data yang dikirim dari form
            'title' => 'required|min:3|max:100', // Field title harus diisi, min 3 karakter, max 100 karakter
            'description' => 'required', // Field description harus diisi
        ]); // Tutup validasi

        Todo::create([ // Buat record todo baru di database
            'title' => $request->title, // Isi field title dengan input dari form
            'description' => $request->description, // Isi field description dengan input dari form
            'user_id' => Auth::id(), // Isi field user_id dengan ID user yang sedang login
        ]); // Tutup create

        return redirect('/todo')->with('success', 'Todo berhasil ditambahkan'); // Redirect ke halaman /todo dengan pesan sukses
    } // Tutup blok fungsi

    // 🔥 UPDATE + VALIDASI
    public function update(Request $request, $id) // Fungsi untuk update data todo dengan data dari form dan ID parameter
    { // Buka blok fungsi
        $request->validate([ // Validasi semua data yang dikirim dari form
            'title' => 'required|min:3|max:100', // Field title harus diisi, min 3 karakter, max 100 karakter
            'description' => 'required', // Field description harus diisi
        ]); // Tutup validasi

        $todo = Todo::findOrFail($id); // Cari data todo berdasarkan ID, jika tidak ada maka error 404

        $todo->update([ // Update record todo yang ditemukan
            'title' => $request->title, // Update field title dengan input baru dari form
            'description' => $request->description, // Update field description dengan input baru dari form
            // 'user_id' => Auth::id(), // Opsional: update user_id jika perlu
        ]); // Tutup update

        return redirect('/todo')->with('success', 'Todo berhasil diupdate'); // Redirect ke halaman /todo dengan pesan sukses
    } // Tutup blok fungsi

    // 🔹 DELETE
    public function destroy($id) // Fungsi untuk menghapus todo dengan ID parameter
    { // Buka blok fungsi
        Todo::findOrFail($id)->delete(); // Cari todo berdasarkan ID (jika tidak ada maka error 404) lalu hapus dari database

        return redirect('/todo')->with('success', 'Todo berhasil dihapus'); // Redirect ke halaman /todo dengan pesan sukses
    } // Tutup blok fungsi

    public function toggle(Todo $todo) // Fungsi untuk toggle status completed todo (todo di-inject via route model binding)
    { // Buka blok fungsi
        // Mengubah status boolean
        $todo->update([ // Update record todo
            'is_completed' => !$todo->is_completed // Toggle field is_completed dari true ke false atau sebaliknya
        ]); // Tutup update

        return back(); // Kembali ke halaman sebelumnya
    } // Tutup blok fungsi
} // Tutup blok class