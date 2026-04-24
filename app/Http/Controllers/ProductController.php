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

class ProductController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        // Product + relasi category (biar bisa tampil nama category)
        $products = Product::with('category')->paginate(5);

        return view('product.index', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer',
            'price' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
            // CATEGORY VALIDATION
            'category_id' => 'required|exists:categories,id',
        ], [
            // CATEGORY VALIDATION MESSAGE
            'category_id.required' => 'Category wajib dipilih.',
            'category_id.exists' => 'Category tidak valid.',
        ]);

        try {
            Product::create($validated);

            return redirect()
                ->route('product.index')
                ->with('success', 'Product created successfully.');

        } catch (QueryException $e) {

            Log::error('Product store database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while creating product.');

        } catch (\Throwable $e) {

            Log::error('Product store unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred while creating product.');
        }
    }

    public function create()
    {
        // Ambil semua category untuk dropdown select di form create product
        $categories = Category::orderBy('name')->get();

        $users = User::orderBy('name')->get();

        return view('product.create', compact('users', 'categories'));
    }

    public function show($id)
    {
        // Load category agar bisa ditampilkan di detail product
        $product = Product::with('category')->findOrFail($id);

        return view('product.view', compact('product'));
    }

    public function update(\App\Http\Requests\UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validated();

        // (category_id ikut ter-update kalau ada di request)
        $product->update($validated);

        return redirect()
            ->route('product.index')
            ->with('success', 'Product updated successfully.');
    }

    public function edit(Product $product)
    {
        //Ambil category untuk dropdown edit product
        $categories = Category::orderBy('name')->get();

        $users = User::orderBy('name')->get();

        return view('product.edit', compact('product', 'users', 'categories'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->route('product.index')
            ->with('success', 'Product berhasil dihapus');
    }
}