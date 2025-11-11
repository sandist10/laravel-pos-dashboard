<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    // Data dummy produk
    private function getDummyProducts()
    {
        return [
            [
                'id' => 1,
                'nama' => 'Nasi Goreng Spesial',
                'kategori' => 'Makanan',
                'harga' => 25000,
                'stok' => 50,
                'gambar' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=300&h=300&fit=crop'
            ],
            [
                'id' => 2,
                'nama' => 'Mie Goreng',
                'kategori' => 'Makanan',
                'harga' => 20000,
                'stok' => 45,
                'gambar' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=300&h=300&fit=crop'
            ],
            [
                'id' => 3,
                'nama' => 'Es Teh Manis',
                'kategori' => 'Minuman',
                'harga' => 5000,
                'stok' => 100,
                'gambar' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=300&h=300&fit=crop'
            ],
            [
                'id' => 4,
                'nama' => 'Kopi Hitam',
                'kategori' => 'Minuman',
                'harga' => 8000,
                'stok' => 80,
                'gambar' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=300&h=300&fit=crop'
            ],
            [
                'id' => 5,
                'nama' => 'Cappuccino',
                'kategori' => 'Minuman',
                'harga' => 15000,
                'stok' => 60,
                'gambar' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=300&h=300&fit=crop'
            ],
            [
                'id' => 6,
                'nama' => 'Ayam Goreng Crispy',
                'kategori' => 'Makanan',
                'harga' => 30000,
                'stok' => 35,
                'gambar' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=300&h=300&fit=crop'
            ],
            [
                'id' => 7,
                'nama' => 'Sate Ayam',
                'kategori' => 'Makanan',
                'harga' => 28000,
                'stok' => 40,
                'gambar' => 'https://images.unsplash.com/photo-1529563021893-cc83c992d75d?w=300&h=300&fit=crop'
            ],
            [
                'id' => 8,
                'nama' => 'Jus Jeruk',
                'kategori' => 'Minuman',
                'harga' => 12000,
                'stok' => 70,
                'gambar' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=300&h=300&fit=crop'
            ],
            [
                'id' => 9,
                'nama' => 'Kentang Goreng',
                'kategori' => 'Snack',
                'harga' => 15000,
                'stok' => 90,
                'gambar' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=300&h=300&fit=crop'
            ],
            [
                'id' => 10,
                'nama' => 'Burger Beef',
                'kategori' => 'Makanan',
                'harga' => 35000,
                'stok' => 30,
                'gambar' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&h=300&fit=crop'
            ],
            [
                'id' => 11,
                'nama' => 'Smoothie Strawberry',
                'kategori' => 'Minuman',
                'harga' => 18000,
                'stok' => 55,
                'gambar' => 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=300&h=300&fit=crop'
            ],
            [
                'id' => 12,
                'nama' => 'Roti Bakar Coklat',
                'kategori' => 'Snack',
                'harga' => 10000,
                'stok' => 75,
                'gambar' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=300&h=300&fit=crop'
            ],
        ];
    }

    public function index()
    {
        $products = $this->getDummyProducts();
        $categories = ['Semua', 'Makanan', 'Minuman', 'Snack'];

        return view('kasir.index', compact('products', 'categories'));
    }
}
