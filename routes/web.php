<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\PenjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routing Index Page / Home Page
Route::get('/', [HomeController::class, 'index']);

// Routing Product Page
Route::prefix('category')->group(function (){
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/food-beverage', [ProductsController::class, 'foodBeverage']);
    Route::get('/beauty-health', [ProductsController::class, 'beautyHealth']);
    Route::get('/home-care', [ProductsController::class, 'homeCare']);
    Route::get('/baby-kid', [ProductsController::class, 'babyKid']);
});

// Routing User Page
Route::get('/user', [UserController::class, 'index']);

// Routing User Tambah
Route::get('/user/tambah', [UserController::class, 'tambah']);

// Routing Tambah Simpan
Route::post('/user/tambah_simpan', [UserController::class, 'tambahSimpan']);

// Routing User Ubah
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// Routing Ubah Simpan
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubahSimpan']);

// Routing Hapus User
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Routing Halaman Transaksi
Route::get('/transaksi', [PenjualanController::class, 'index']);

// Routing Level Page
Route::get('/level', [LevelController::class, 'index']);

// Routing Halaman Kategori
Route::get('/kategori', [KategoriController::class, 'index']);

// Routing Halaman Kategori Create dan Store
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController::class, 'store']);

// Routing Halaman Kategori Edit dan Update
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
Route::post('/kategori/update/{id}', [KategoriController::class, 'edit_simpan']);

// Routing Halaman Delete
Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);


// // Bootstrap default
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
