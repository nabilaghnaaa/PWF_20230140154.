<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\AuthorizationException;

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $products = Product::with('category')->paginate(5);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $users = User::orderBy('name')->get();
        return view('product.create', compact('users', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        try {
            Product::create($validated);
            return redirect()->route('product.index')->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan produk.');
        }
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product.view', compact('product'));
    }

    /**
     * EDIT WITH SPECIFIC ERROR
     */
    public function edit(Product $product)
    {
        try {
            $this->authorize('update', $product);

            $categories = Category::orderBy('name')->get();
            $users = User::orderBy('name')->get();

            return view('product.edit', compact('product', 'users', 'categories'));
            
        } catch (AuthorizationException $e) {
            // Pesan spesifik untuk UI
            return redirect()->route('product.index')
                ->with('error', 'Akses Ditolak: Hanya owner produk ini atau Admin yang memiliki izin untuk mengedit data.');
        }
    }

    /**
     * UPDATE WITH SPECIFIC ERROR
     */
    public function update(\App\Http\Requests\UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        try {
            $this->authorize('update', $product);

            $validated = $request->validated();
            $product->update($validated);

            return redirect()->route('product.index')->with('success', 'Product updated successfully.');

        } catch (AuthorizationException $e) {
            return redirect()->route('product.index')
                ->with('error', 'Gagal Update: Anda tidak memiliki otoritas. Perubahan hanya bisa dilakukan oleh owner atau Admin.');
        }
    }

    /**
     * DELETE WITH SPECIFIC ERROR
     */
    public function delete($id)
    {
        $product = Product::findOrFail($id);

        try {
            $this->authorize('delete', $product);

            $product->delete();

            return redirect()->route('product.index')->with('success', 'Product berhasil dihapus.');

        } catch (AuthorizationException $e) {
            return redirect()->route('product.index')
                ->with('error', 'Gagal Hapus: Tindakan ini dibatasi. Hanya owner produk atau Admin yang dapat menghapus data ini.');
        }
    }
}