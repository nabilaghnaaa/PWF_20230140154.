<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

/*
|--------------------------------------------------------------------------
| Auth API
|--------------------------------------------------------------------------
| Endpoint untuk login dan mendapatkan access_token.
*/
Route::post('/login', [AuthController::class, 'getToken']);

/*
|--------------------------------------------------------------------------
| Product API
|--------------------------------------------------------------------------
| GET product bisa diakses tanpa token.
| POST, PUT, DELETE product wajib menggunakan token Sanctum.
*/
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/product', [ProductController::class, 'store']);
    Route::put('/product/{id}', [ProductController::class, 'update']);
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Category API
|--------------------------------------------------------------------------
| Sesuai tugas, semua endpoint category menggunakan token.
*/
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::get('/category/{id}', [CategoryController::class, 'show']);
    Route::put('/category/{id}', [CategoryController::class, 'update']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
});