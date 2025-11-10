<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        // Data dummy untuk contoh tampilan
        $data = [
            ['id' => 1, 'nama' => 'Nasi Goreng', 'harga' => 20000],
            ['id' => 2, 'nama' => 'Es Teh Manis', 'harga' => 5000],
            ['id' => 3, 'nama' => 'Mie Ayam', 'harga' => 15000],
            ['id' => 4, 'nama' => 'Firli Juan', 'harga' => 99999],
            ['id' => 5, 'nama' => 'Firli Juan', 'harga' => 99999],
            ['id' => 6, 'nama' => 'Firli Juan', 'harga' => 99999],
            ['id' => 7, 'nama' => 'Firli Juan', 'harga' => 99999],
        ];

        return view('kasir.index', compact('data'));
    }
}
