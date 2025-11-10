<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'profit_today' => 23560000,
            'goods_received' => 1500350,
            'loss_estimate' => 35000,
            'sales_data' => [50000, 60000, 100000, 200000, 975000], // contoh data grafik
            'transactions' => Transaction::latest()->take(4)->get(),
            'popular_products' => Product::orderBy('sold', 'desc')->take(4)->get(),
        ];

        return view('dashboard', compact('data'));
    }
}
