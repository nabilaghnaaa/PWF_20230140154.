<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Todo;

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
| TODO (NEW - TAMBAHAN KAMU)
|--------------------------------------------------------------------------
*/

Route::get('/todo', function () {
    $todos = Todo::with('user')->get();
    return view('todo', compact('todos'));
});

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

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
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::get('/product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    /*
    |--------------------------------------------------------------------------
    | EXPORT PRODUCT (TAMBAHAN)
    |--------------------------------------------------------------------------
    */

    Route::get('/export', function () {
        return "Export berhasil";
    })->name('export')->middleware('can:export-product');

});

require __DIR__.'/auth.php';