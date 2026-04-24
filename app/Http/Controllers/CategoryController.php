<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ: Menampilkan semua category
    public function index()
    {
        // Ambil semua category + jumlah product di tiap category
        $categories = Category::withCount('products')->get();

        return view('category.index', compact('categories'));
    }

    // CREATE: Tampilkan form tambah category
    public function create()
    {
        return view('category.create');
    }

    // STORE: Simpan data category baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required'
        ]);

        // Simpan ke database
        Category::create([
            'name' => $request->name
        ]);

        return redirect('/category')->with('success', 'Category berhasil ditambahkan');
    }

    // EDIT: Tampilkan form edit category
    public function edit($id)
    {
        // Cari data category berdasarkan ID
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    // UPDATE: Update data category
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required'
        ]);

        // Cari data lalu update
        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name
        ]);

        return redirect('/category')->with('success', 'Category berhasil diupdate');
    }

    // DELETE: Hapus category
    public function destroy($id)
    {
        // Cari data category
        $category = Category::findOrFail($id);

        // Hapus dari database
        $category->delete();

        return redirect('/category')->with('success', 'Category berhasil dihapus');
    }
}