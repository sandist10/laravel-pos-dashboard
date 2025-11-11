<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    // Data dummy bahan baku
    private function getDummyInventory()
    {
        return [
            [
                'id' => 1,
                'nama' => 'Beras Premium',
                'kategori' => 'Bahan Pokok',
                'satuan' => 'Kg',
                'stok' => 150,
                'stok_minimum' => 50,
                'harga_beli' => 12000,
                'supplier' => 'PT Beras Jaya',
                'tanggal_masuk' => '2025-11-01',
                'keterangan' => 'Beras kualitas premium untuk nasi goreng'
            ],
            [
                'id' => 2,
                'nama' => 'Minyak Goreng',
                'kategori' => 'Bahan Pokok',
                'satuan' => 'Liter',
                'stok' => 80,
                'stok_minimum' => 30,
                'harga_beli' => 15000,
                'supplier' => 'CV Minyak Sejahtera',
                'tanggal_masuk' => '2025-11-05',
                'keterangan' => 'Minyak goreng untuk memasak'
            ],
            [
                'id' => 3,
                'nama' => 'Daging Ayam',
                'kategori' => 'Protein',
                'satuan' => 'Kg',
                'stok' => 25,
                'stok_minimum' => 10,
                'harga_beli' => 35000,
                'supplier' => 'Peternakan Maju',
                'tanggal_masuk' => '2025-11-10',
                'keterangan' => 'Daging ayam segar untuk menu ayam goreng'
            ],
            [
                'id' => 4,
                'nama' => 'Daging Sapi',
                'kategori' => 'Protein',
                'satuan' => 'Kg',
                'stok' => 15,
                'stok_minimum' => 5,
                'harga_beli' => 120000,
                'supplier' => 'Peternakan Maju',
                'tanggal_masuk' => '2025-11-10',
                'keterangan' => 'Daging sapi untuk burger dan sate'
            ],
            [
                'id' => 5,
                'nama' => 'Telur Ayam',
                'kategori' => 'Protein',
                'satuan' => 'Butir',
                'stok' => 200,
                'stok_minimum' => 50,
                'harga_beli' => 2500,
                'supplier' => 'Peternakan Telur Segar',
                'tanggal_masuk' => '2025-11-08',
                'keterangan' => 'Telur ayam untuk berbagai menu'
            ],
            [
                'id' => 6,
                'nama' => 'Tepung Terigu',
                'kategori' => 'Bahan Pokok',
                'satuan' => 'Kg',
                'stok' => 50,
                'stok_minimum' => 20,
                'harga_beli' => 10000,
                'supplier' => 'Toko Bahan Kue',
                'tanggal_masuk' => '2025-11-03',
                'keterangan' => 'Tepung untuk roti dan kue'
            ],
            [
                'id' => 7,
                'nama' => 'Gula Pasir',
                'kategori' => 'Bumbu',
                'satuan' => 'Kg',
                'stok' => 40,
                'stok_minimum' => 15,
                'harga_beli' => 13000,
                'supplier' => 'PT Gula Manis',
                'tanggal_masuk' => '2025-11-02',
                'keterangan' => 'Gula untuk minuman dan masakan'
            ],
            [
                'id' => 8,
                'nama' => 'Garam',
                'kategori' => 'Bumbu',
                'satuan' => 'Kg',
                'stok' => 30,
                'stok_minimum' => 10,
                'harga_beli' => 5000,
                'supplier' => 'CV Garam Laut',
                'tanggal_masuk' => '2025-11-01',
                'keterangan' => 'Garam untuk bumbu masakan'
            ],
            [
                'id' => 9,
                'nama' => 'Kopi Bubuk',
                'kategori' => 'Minuman',
                'satuan' => 'Kg',
                'stok' => 20,
                'stok_minimum' => 8,
                'harga_beli' => 45000,
                'supplier' => 'Kopi Nusantara',
                'tanggal_masuk' => '2025-11-07',
                'keterangan' => 'Kopi bubuk arabica untuk menu kopi'
            ],
            [
                'id' => 10,
                'nama' => 'Teh Celup',
                'kategori' => 'Minuman',
                'satuan' => 'Box',
                'stok' => 15,
                'stok_minimum' => 5,
                'harga_beli' => 25000,
                'supplier' => 'Distributor Teh',
                'tanggal_masuk' => '2025-11-06',
                'keterangan' => 'Teh celup untuk menu minuman'
            ],
            [
                'id' => 11,
                'nama' => 'Susu Segar',
                'kategori' => 'Minuman',
                'satuan' => 'Liter',
                'stok' => 35,
                'stok_minimum' => 15,
                'harga_beli' => 18000,
                'supplier' => 'Peternakan Sapi Perah',
                'tanggal_masuk' => '2025-11-09',
                'keterangan' => 'Susu segar untuk cappuccino dan smoothie'
            ],
            [
                'id' => 12,
                'nama' => 'Kentang',
                'kategori' => 'Sayuran',
                'satuan' => 'Kg',
                'stok' => 45,
                'stok_minimum' => 20,
                'harga_beli' => 12000,
                'supplier' => 'Petani Sayur',
                'tanggal_masuk' => '2025-11-04',
                'keterangan' => 'Kentang untuk kentang goreng'
            ],
        ];
    }

    public function index()
    {
        $inventory = $this->getDummyInventory();
        $categories = array_unique(array_column($inventory, 'kategori'));
        
        return view('inventory.index', compact('inventory', 'categories'));
    }

    public function create()
    {
        $categories = ['Bahan Pokok', 'Protein', 'Sayuran', 'Bumbu', 'Minuman'];
        $satuan = ['Kg', 'Gram', 'Liter', 'Ml', 'Butir', 'Pcs', 'Box', 'Pack'];
        
        return view('inventory.create', compact('categories', 'satuan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'supplier' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        return redirect()->route('inventory.index')->with('success', 'Bahan baku berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $inventory = $this->getDummyInventory();
        $item = collect($inventory)->firstWhere('id', (int)$id);
        
        if (!$item) {
            return redirect()->route('inventory.index')->with('error', 'Bahan baku tidak ditemukan!');
        }

        $categories = ['Bahan Pokok', 'Protein', 'Sayuran', 'Bumbu', 'Minuman'];
        $satuan = ['Kg', 'Gram', 'Liter', 'Ml', 'Butir', 'Pcs', 'Box', 'Pack'];
        
        return view('inventory.edit', compact('item', 'categories', 'satuan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string',
            'satuan' => 'required|string',
            'stok' => 'required|integer|min:0',
            'stok_minimum' => 'required|integer|min:0',
            'harga_beli' => 'required|numeric|min:0',
            'supplier' => 'required|string|max:255',
            'tanggal_masuk' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        return redirect()->route('inventory.index')->with('success', 'Bahan baku berhasil diupdate!');
    }

    public function destroy($id)
    {
        return redirect()->route('inventory.index')->with('success', 'Bahan baku berhasil dihapus!');
    }
}

