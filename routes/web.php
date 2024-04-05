<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\POSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\WelcomeController;
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
// Route::get('/', [HomeController::class, 'index']);

// Routing index page welcomeCOntroller
Route::get('/', [WelcomeController::class, 'index']);

// Routing Group CRUD User
Route::group(['prefix' => 'user'], function() {
    // Route menampilkan halaman awal user
    Route::get('/', [UserController::class, 'index']);
    // Route menampilkan halaman user dalam bentuk datatable
    Route::post('/list', [UserController::class, 'list']);

    // Route menampilkan halaman form tambah user
    Route::get('/create', [UserController::class, 'create']);
    // Route menyimpan data user baru
    Route::post('/', [UserController::class,'store']);

    //Route menampilkan detail user berdasarkan id
    Route::get('/{id}', [UserController::class, 'show']);

    // Route menampilkan halaman edit form user
    Route::get('/{id}/edit', [UserController::class, 'edit']);
    // Route menyimpan data user yang telah diubah
    Route::put('/{id}', [UserController::class, 'update']);

    // Route menghapus data user berdasarkan id
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

// Routing Group CRUD Level
Route::group(['prefix' => 'level'], function() {
    // Route menampilkan halaman awal level
    Route::get('/', [LevelController::class, 'index']);
    // Route menampilkan list level
    Route::post('/list', [LevelController::class, 'list']);

    // Route menampilkan halaman form tambah level
    Route::get('/create', [LevelController::class, 'create']);
    // Route menyimpan data level baru
    Route::post('/', [LevelController::class,'store']);

    // Route menampilkan halaman edit form level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);
    // Route menyimpan data level yang telah diubah
    Route::put('/{id}', [LevelController::class, 'update']);

    // Route menghapus data level berdasarkan id
    Route::delete('/{id}', [LevelController::class, 'destroy']);
});

// Routing Group CRUD Kategori
Route::group(['prefix' => 'kategori'], function() {
    // Route menampilkan halaman awal Kategori
    Route::get('/', [KategoriController::class, 'index']);
    // Route menampilkan list Kategori
    Route::post('/list', [KategoriController::class, 'list']);

    // Route menampilkan halaman form tambah kategori
    Route::get('/create', [KategoriController::class, 'create']);
    // Route menyimpan data kategori baru
    Route::post('/', [KategoriController::class,'store']);

    // Route menampilkan halaman edit form kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);
    // Route menyimpan data kategori yang telah diubah
    Route::put('/{id}', [KategoriController::class, 'update']);

    // Route menghapus data kategori berdasarkan id
    Route::delete('/{id}', [KategoriController::class, 'destroy']);
});

// Routing Group CRUD barang
Route::group(['prefix' => 'barang'], function() {
    // Route menampilkan halaman awal barang
    Route::get('/', [BarangController::class, 'index']);
    // Route menampilkan list barang
    Route::post('/list', [BarangController::class, 'list']);

    // Route menampilkan halaman form tambah barang
    Route::get('/create', [BarangController::class, 'create']);
    // Route menyimpan data barang baru
    Route::post('/', [BarangController::class,'store']);

    //Route menampilkan detail barang berdasarkan id
    Route::get('/{id}', [BarangController::class, 'show']);

    // Route menampilkan halaman edit form barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);
    // Route menyimpan data barang yang telah diubah
    Route::put('/{id}', [BarangController::class, 'update']);

    // Route menghapus data barang berdasarkan id
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

// Routing Group CRUD Stok
Route::group(['prefix' => 'stok'], function() {
    // Route menampilkan halaman awal Stok
    Route::get('/', [StokController::class, 'index']);
    // Route menampilkan list Stok
    Route::post('/list', [StokController::class, 'list']);

    // Route menampilkan halaman form tambah Stok
    Route::get('/create', [StokController::class, 'create']);
    // Route menyimpan data Stok baru
    Route::post('/', [StokController::class,'store']);

    // Route menampilkan halaman edit form Stok
    Route::get('/{id}/edit', [StokController::class, 'edit']);
    // Route menyimpan data Stok yang telah diubah
    Route::put('/{id}', [StokController::class, 'update']);

    // Route menghapus data Stok berdasarkan id
    Route::delete('/{id}', [StokController::class, 'destroy']);
});

// // Routing Product Page
// Route::prefix('category')->group(function (){
//     Route::get('/', [ProductsController::class, 'index']);
//     Route::get('/food-beverage', [ProductsController::class, 'foodBeverage']);
//     Route::get('/beauty-health', [ProductsController::class, 'beautyHealth']);
//     Route::get('/home-care', [ProductsController::class, 'homeCare']);
//     Route::get('/baby-kid', [ProductsController::class, 'babyKid']);
// });

// // Routing User Page
// Route::get('/user', [UserController::class, 'index']);

// // Routing form user
// Route::get('/user/form', [UserController::class, 'form']);

// // Routing User Tambah
// Route::get('/user/tambah', [UserController::class, 'tambah']);

// // Routing Tambah Simpan
// Route::post('/user/tambah_simpan', [UserController::class, 'tambahSimpan']);

// // Routing User Ubah
// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// // Routing Ubah Simpan
// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubahSimpan']);

// // Routing Hapus User
// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// // Routing Halaman Transaksi
// Route::get('/transaksi', [PenjualanController::class, 'index']);

// // Routing Level Page
// Route::get('/level', [LevelController::class, 'index']);

// // Routing Form Level
// Route::get('/level/form', [LevelController::class, 'form']);

// // Routing Halaman Kategori
// Route::get('/kategori', [KategoriController::class, 'index']);

// // Routing Halaman Kategori Create dan Store
// Route::get('/kategori/create', [KategoriController::class, 'create']);
// Route::post('/kategori', [KategoriController::class, 'store']);

// // Routing Halaman Kategori Edit dan Update
// Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
// Route::post('/kategori/update/{id}', [KategoriController::class, 'edit_simpan']);

// // Routing Halaman Delete
// Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

// // Routing Resource User
// Route::resource('user', POSController::class);

// // Routing m_user index
// Route::get('/m_user', [POSController::class, 'index']);

// // Routing m_user tampil user
// Route::get('/m_user/tampil/{id}', [POSController::class, 'show']);

// // Routing m_user tambah user
// Route::get('/m_user/tambah', [POSController::class, 'create']);
// Route::post('/m_user', [POSController::class, 'store']);

// // Routing m_user edit user
// Route::get('/m_user/ubah/{id}', [POSController::class, 'edit']);
// Route::post('/m_user/ubah_simpan/{id}', [POSController::class, 'update']);

// // Routing m_user hapus user
// Route::get('/m_user/hapus/{id}', [POSController::class, 'destroy']);

