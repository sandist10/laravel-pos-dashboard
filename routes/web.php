<?php

use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/kasir', [KasirController::class, 'index'])->name('kasir');

Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');