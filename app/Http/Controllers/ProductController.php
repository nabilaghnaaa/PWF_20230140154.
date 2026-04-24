<?php // Deklarasi blok PHP untuk kode server-side

namespace App\Http\Controllers; // Menentukan namespace untuk class ini

use App\Models\Category; // Import model Category
use App\Models\Product; // Import model Product
use App\Models\User; // Import model User
use Illuminate\Http\Request; // Import class Request dari Laravel
use Illuminate\Database\QueryException; // Import exception untuk database errors
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // Import trait untuk authorization
use Illuminate\Support\Facades\Auth; // Import Auth facade untuk autentikasi
use Illuminate\Support\Facades\Log; // Import Log facade untuk logging
use Illuminate\Auth\Access\AuthorizationException; // Import exception untuk authorization errors

class ProductController extends Controller // Deklarasi class ProductController yang extends Controller
{ // Buka blok class
    use AuthorizesRequests; // Gunakan trait AuthorizesRequests untuk authorization methods

    public function index() // Fungsi untuk menampilkan daftar semua product
    { // Buka blok fungsi
        $products = Product::with('category')->paginate(5); // Query ambil semua product dengan relasi category dan pagination 5 item per halaman
        return view('product.index', compact('products')); // Return/tampilkan view dengan data products
    } // Tutup blok fungsi

    public function create() // Fungsi untuk menampilkan form tambah product
    { // Buka blok fungsi
        $categories = Category::orderBy('name')->get(); // Query ambil semua category diurutkan berdasarkan nama
        $users = User::orderBy('name')->get(); // Query ambil semua user diurutkan berdasarkan nama
        return view('product.create', compact('users', 'categories')); // Return/tampilkan view form create dengan data users dan categories
    } // Tutup blok fungsi

    public function store(Request $request) // Fungsi untuk menyimpan data product baru dari form
    { // Buka blok fungsi
        $validated = $request->validate([ // Validasi semua data yang dikirim dari form
            'name' => 'required|string|max:255', // Field name harus diisi, tipe string, max 255 karakter
            'qty' => 'required|integer', // Field qty harus diisi dan tipe integer
            'price' => 'required|numeric', // Field price harus diisi dan tipe numeric
            'user_id' => 'required|exists:users,id', // Field user_id harus diisi dan harus ada di tabel users
            'category_id' => 'required|exists:categories,id', // Field category_id harus diisi dan harus ada di tabel categories
        ]); // Tutup validasi

        try { // Mulai try-catch block untuk handle error
            Product::create($validated); // Buat record product baru di database dengan data yang sudah divalidasi
            return redirect()->route('product.index')->with('success', 'Product created successfully.'); // Redirect ke halaman product.index dengan pesan sukses
        } catch (\Exception $e) { // Jika terjadi exception apapun
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan produk.'); // Redirect ke halaman sebelumnya dengan pesan error dan input lama
        } // Tutup catch block
    } // Tutup blok fungsi

    public function show($id) // Fungsi untuk menampilkan detail product dengan ID parameter
    { // Buka blok fungsi
        $product = Product::with('category')->findOrFail($id); // Cari product berdasarkan ID dengan relasi category, jika tidak ada maka error 404
        return view('product.view', compact('product')); // Return/tampilkan view dengan data product detail
    } // Tutup blok fungsi

    /**
     * EDIT WITH SPECIFIC ERROR
     */
    public function edit(Product $product) // Fungsi untuk menampilkan form edit product (product di-inject via route model binding)
    { // Buka blok fungsi
        try { // Mulai try-catch block untuk handle authorization exception
            $this->authorize('update', $product); // Cek authorization - apakah user boleh update product ini

            $categories = Category::orderBy('name')->get(); // Query ambil semua category diurutkan berdasarkan nama
            $users = User::orderBy('name')->get(); // Query ambil semua user diurutkan berdasarkan nama

            return view('product.edit', compact('product', 'users', 'categories')); // Return/tampilkan view edit dengan data product, users, dan categories
            
        } catch (AuthorizationException $e) { // Jika authorization ditolak
            // Pesan spesifik untuk UI
            return redirect()->route('product.index') // Redirect ke halaman product.index
                ->with('error', 'Akses Ditolak: Hanya owner produk ini atau Admin yang memiliki izin untuk mengedit data.'); // Dengan pesan error khusus
        } // Tutup catch block
    } // Tutup blok fungsi

    /**
     * UPDATE WITH SPECIFIC ERROR
     */
    public function update(\App\Http\Requests\UpdateProductRequest $request, $id) // Fungsi untuk update data product dengan data dari form dan ID parameter (validasi via UpdateProductRequest)
    { // Buka blok fungsi
        $product = Product::findOrFail($id); // Cari product berdasarkan ID, jika tidak ada maka error 404

        try { // Mulai try-catch block untuk handle authorization exception
            $this->authorize('update', $product); // Cek authorization - apakah user boleh update product ini

            $validated = $request->validated(); // Ambil data yang sudah divalidasi dari UpdateProductRequest
            $product->update($validated); // Update record product dengan data yang divalidasi

            return redirect()->route('product.index')->with('success', 'Product updated successfully.'); // Redirect ke halaman product.index dengan pesan sukses

        } catch (AuthorizationException $e) { // Jika authorization ditolak
            return redirect()->route('product.index') // Redirect ke halaman product.index
                ->with('error', 'Gagal Update: Anda tidak memiliki otoritas. Perubahan hanya bisa dilakukan oleh owner atau Admin.'); // Dengan pesan error khusus
        } // Tutup catch block
    } // Tutup blok fungsi

    /**
     * DELETE WITH SPECIFIC ERROR
     */
    public function delete($id) // Fungsi untuk menghapus product dengan ID parameter
    { // Buka blok fungsi
        $product = Product::findOrFail($id); // Cari product berdasarkan ID, jika tidak ada maka error 404

        try { // Mulai try-catch block untuk handle authorization exception
            $this->authorize('delete', $product); // Cek authorization - apakah user boleh delete product ini

            $product->delete(); // Hapus record product dari database

            return redirect()->route('product.index')->with('success', 'Product berhasil dihapus.'); // Redirect ke halaman product.index dengan pesan sukses

        } catch (AuthorizationException $e) { // Jika authorization ditolak
            return redirect()->route('product.index') // Redirect ke halaman product.index
                ->with('error', 'Gagal Hapus: Tindakan ini dibatasi. Hanya owner produk atau Admin yang dapat menghapus data ini.'); // Dengan pesan error khusus
        } // Tutup catch block
    } // Tutup blok fungsi
} // Tutup blok class