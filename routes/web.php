<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/kasir', [KasirController::class, 'index'])->name('kasir');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');

Route::resource('kategori', KategoriController::class);

Route::resource('produk', ProdukController::class);

Route::resource('inventory', InventoryController::class);