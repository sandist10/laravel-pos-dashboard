<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'process'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'process'])->name('register.process');

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/kasir', [KasirController::class, 'index'])->name('kasir');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');

Route::resource('kategori', KategoriController::class);

Route::resource('produk', ProdukController::class);

Route::resource('inventory', InventoryController::class);

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


