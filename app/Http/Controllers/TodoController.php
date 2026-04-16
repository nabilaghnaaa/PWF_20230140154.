<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth; 

class TodoController extends Controller
{
    // 🔹 TAMPIL DATA (FIX VIEW)
    public function index()
    {
        $todos = Todo::all();
        return view('todo', compact('todos'));
    }

    // 🔹 HALAMAN CREATE
    public function create()
    {
        return view('todo.create');
    }

    // 🔥 STORE + VALIDASI
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(), 
        ]);

        return redirect('/todo')->with('success', 'Todo berhasil ditambahkan');
    }

    // 🔥 UPDATE + VALIDASI
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3|max:100',
            'description' => 'required',
        ]);

        $todo = Todo::findOrFail($id);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
            // 'user_id' => Auth::id(), // Opsional: update user_id jika perlu
        ]);

        return redirect('/todo')->with('success', 'Todo berhasil diupdate');
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        Todo::findOrFail($id)->delete();

        return redirect('/todo')->with('success', 'Todo berhasil dihapus');
    }
}