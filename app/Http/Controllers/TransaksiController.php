<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        // Data contoh (bisa diganti dari database nanti)
        $transactions = [
            ['id' => 1, 'tanggal' => '2025-11-09', 'total' => 75000, 'kasir' => 'Andi', 'status' => 'Selesai'],
            ['id' => 2, 'tanggal' => '2025-11-08', 'total' => 42000, 'kasir' => 'Budi', 'status' => 'Selesai'],
            ['id' => 3, 'tanggal' => '2025-11-07', 'total' => 120000, 'kasir' => 'Siti', 'status' => 'Pending'],
        ];

        return view('transaksi.index', compact('transactions'));
    }
}
