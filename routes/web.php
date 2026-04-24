<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
// use App\Models\Todo; // ❌ tidak dipakai, boleh dihapus

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| About Page
|--------------------------------------------------------------------------
*/

Route::get('/about', [AboutController::class, 'index'])
    ->middleware(['auth'])
    ->name('about');

/*
|--------------------------------------------------------------------------
| TODO (SUDAH DIBUNGKUS AUTH 🔥)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
    Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
    Route::post('/todo/store', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::patch('/todo/{todo}/toggle', [TodoController::class, 'toggle'])->name('todo.toggle');

});

/*
|--------------------------------------------------------------------------
| Profile + Product + Category
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Product CRUD
    |--------------------------------------------------------------------------
    */

    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    // CATEGORY
    Route::resource('category', CategoryController::class);

    /*
    |--------------------------------------------------------------------------
    | EXPORT PRODUCT (SUDAH INCLUDE CATEGORY)
    |--------------------------------------------------------------------------
    */

    Route::get('/export', function () {

        $products = \App\Models\Product::with(['user', 'category'])->get();

        $csv = "Name,Qty,Price,Category,Owner\n";

        foreach ($products as $p) {
            $owner = $p->user->name ?? 'Unknown';
            $category = $p->category->name ?? '-';

            $csv .= "{$p->name},{$p->qty},{$p->price},{$category},{$owner}\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename=products.csv');

    })->name('export')->middleware('can:export-product');

});

require __DIR__.'/auth.php';