<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
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
                'deskripsi' => 'Nasi goreng dengan telur, ayam, dan sayuran',
                'gambar' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=400&h=400&fit=crop'
            ],
            [
                'id' => 2,
                'nama' => 'Mie Goreng',
                'kategori' => 'Makanan',
                'harga' => 20000,
                'stok' => 45,
                'deskripsi' => 'Mie goreng dengan sayuran segar',
                'gambar' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=400&h=400&fit=crop'
            ],
            [
                'id' => 3,
                'nama' => 'Es Teh Manis',
                'kategori' => 'Minuman',
                'harga' => 5000,
                'stok' => 100,
                'deskripsi' => 'Es teh manis segar',
                'gambar' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&h=400&fit=crop'
            ],
            [
                'id' => 4,
                'nama' => 'Kopi Hitam',
                'kategori' => 'Minuman',
                'harga' => 8000,
                'stok' => 80,
                'deskripsi' => 'Kopi hitam original tanpa gula',
                'gambar' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=400&fit=crop'
            ],
            [
                'id' => 5,
                'nama' => 'Cappuccino',
                'kategori' => 'Minuman',
                'harga' => 15000,
                'stok' => 60,
                'deskripsi' => 'Cappuccino dengan foam lembut',
                'gambar' => 'https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=400&h=400&fit=crop'
            ],
            [
                'id' => 6,
                'nama' => 'Ayam Goreng Crispy',
                'kategori' => 'Makanan',
                'harga' => 30000,
                'stok' => 35,
                'deskripsi' => 'Ayam goreng crispy dengan bumbu rahasia',
                'gambar' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?w=400&h=400&fit=crop'
            ],
            [
                'id' => 7,
                'nama' => 'Sate Ayam',
                'kategori' => 'Makanan',
                'harga' => 28000,
                'stok' => 40,
                'deskripsi' => 'Sate ayam dengan bumbu kacang',
                'gambar' => 'https://images.unsplash.com/photo-1529563021893-cc83c992d75d?w=400&h=400&fit=crop'
            ],
            [
                'id' => 8,
                'nama' => 'Jus Jeruk',
                'kategori' => 'Minuman',
                'harga' => 12000,
                'stok' => 70,
                'deskripsi' => 'Jus jeruk segar tanpa gula',
                'gambar' => 'https://images.unsplash.com/photo-1600271886742-f049cd451bba?w=400&h=400&fit=crop'
            ],
            [
                'id' => 9,
                'nama' => 'Kentang Goreng',
                'kategori' => 'Snack',
                'harga' => 15000,
                'stok' => 90,
                'deskripsi' => 'Kentang goreng crispy dengan saus',
                'gambar' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=400&h=400&fit=crop'
            ],
            [
                'id' => 10,
                'nama' => 'Burger Beef',
                'kategori' => 'Makanan',
                'harga' => 35000,
                'stok' => 30,
                'deskripsi' => 'Burger dengan daging sapi premium',
                'gambar' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=400&h=400&fit=crop'
            ],
            [
                'id' => 11,
                'nama' => 'Smoothie Strawberry',
                'kategori' => 'Minuman',
                'harga' => 18000,
                'stok' => 55,
                'deskripsi' => 'Smoothie strawberry segar',
                'gambar' => 'https://images.unsplash.com/photo-1505252585461-04db1eb84625?w=400&h=400&fit=crop'
            ],
            [
                'id' => 12,
                'nama' => 'Roti Bakar Coklat',
                'kategori' => 'Snack',
                'harga' => 10000,
                'stok' => 75,
                'deskripsi' => 'Roti bakar dengan selai coklat',
                'gambar' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=400&h=400&fit=crop'
            ],
        ];
    }

    public function index(Request $request)
    {
        $products = $this->getDummyProducts();
        
        // Filter berdasarkan kategori jika ada
        $kategori = $request->get('kategori');
        if ($kategori && $kategori !== 'Semua') {
            $products = array_filter($products, function($product) use ($kategori) {
                return $product['kategori'] === $kategori;
            });
        }

        // Filter berdasarkan pencarian
        $search = $request->get('search');
        if ($search) {
            $products = array_filter($products, function($product) use ($search) {
                return stripos($product['nama'], $search) !== false;
            });
        }

        // Daftar kategori untuk filter
        $categories = ['Semua', 'Makanan', 'Minuman', 'Snack'];

        return view('produk.index', compact('products', 'categories', 'kategori', 'search'));
    }

    public function create()
    {
        $categories = ['Makanan', 'Minuman', 'Snack', 'Paket'];
        return view('produk.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        // Dalam implementasi nyata, data akan disimpan ke database
        // Untuk dummy, kita hanya redirect dengan pesan sukses
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $products = $this->getDummyProducts();
        $product = collect($products)->firstWhere('id', (int)$id);
        
        if (!$product) {
            return redirect()->route('produk.index')->with('error', 'Produk tidak ditemukan!');
        }

        $categories = ['Makanan', 'Minuman', 'Snack', 'Paket'];
        return view('produk.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
        ]);

        // Dalam implementasi nyata, data akan diupdate ke database
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy($id)
    {
        // Dalam implementasi nyata, data akan dihapus dari database
        
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}

