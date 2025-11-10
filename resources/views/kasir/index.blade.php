@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-6">Kasir</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- ======== DAFTAR PRODUK ======== -->
        <div class="bg-white rounded-xl shadow p-4 sm:p-5">
            <div class="mb-4">
                <input 
                    type="text" 
                    placeholder="Cari produk..." 
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <!-- Kategori -->
            <div class="flex gap-2 mb-4 overflow-x-auto">
                <button class="px-4 py-1.5 bg-blue-600 text-white text-sm rounded-full whitespace-nowrap">Semua</button>
                <button class="px-4 py-1.5 bg-gray-200 text-gray-700 text-sm rounded-full whitespace-nowrap hover:bg-gray-300">Makanan</button>
                <button class="px-4 py-1.5 bg-gray-200 text-gray-700 text-sm rounded-full whitespace-nowrap hover:bg-gray-300">Minuman</button>
            </div>

            <!-- Grid produk -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 xl:grid-cols-3 gap-4">
                @forelse ($data as $item)
                <div class="bg-white border rounded-xl shadow-sm hover:shadow-md transition overflow-hidden flex flex-col">
                    <!-- Gambar -->
                    <div class="aspect-square bg-gray-100 flex items-center justify-center">
                        @if(!empty($item['gambar']))
                            <img src="{{ asset('storage/' . $item['gambar']) }}" alt="{{ $item['nama'] }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://via.placeholder.com/300x300?text=No+Image" alt="{{ $item['nama'] }}" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- Info -->
                    <div class="p-2 flex flex-col flex-grow">
                        <h3 class="text-gray-800 font-semibold text-sm line-clamp-1">{{ $item['nama'] }}</h3>
                        <p class="text-gray-600 text-sm">Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
                        <button 
                            class="mt-2 bg-blue-500 text-white text-sm py-1 rounded-lg hover:bg-blue-600 transition active:scale-95">
                            Tambah
                        </button>
                    </div>
                </div>
                @empty
                <p class="col-span-full text-center text-gray-500 mt-4">Tidak ada produk.</p>
                @endforelse
            </div>
        </div>

        <!-- ======== TRANSAKSI PENJUALAN ======== -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow p-4 sm:p-6 flex flex-col gap-4">
            <h2 class="font-semibold text-lg text-gray-800 mb-2">Transaksi Penjualan</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700">
                            <th class="border p-2 text-left">Nama Barang</th>
                            <th class="border p-2 text-center">Qty</th>
                            <th class="border p-2 text-right">Harga</th>
                            <th class="border p-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border p-2">Nasi Goreng</td>
                            <td class="border p-2 text-center">2</td>
                            <td class="border p-2 text-right">Rp15.000</td>
                            <td class="border p-2 text-right">Rp30.000</td>
                        </tr>
                        <tr>
                            <td class="border p-2">Es Teh</td>
                            <td class="border p-2 text-center">1</td>
                            <td class="border p-2 text-right">Rp5.000</td>
                            <td class="border p-2 text-right">Rp5.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Rincian total -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between mb-1"><span>Subtotal</span><span>Rp35.000</span></div>
                    <div class="flex justify-between mb-1"><span>Uang Diterima</span><span>Rp40.000</span></div>
                    <div class="flex justify-between font-semibold text-green-600"><span>Kembalian</span><span>Rp5.000</span></div>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between mb-1"><span>Subtotal</span><span>Rp35.000</span></div>
                    <div class="flex justify-between mb-1"><span>Diskon</span><span>Rp0</span></div>
                    <div class="flex justify-between mb-1"><span>Pajak</span><span>Rp3.500</span></div>
                    <div class="flex justify-between font-bold text-lg text-gray-800"><span>Total</span><span>Rp38.500</span></div>
                </div>
            </div>

            <!-- Tombol aksi -->
            <div class="flex flex-col sm:flex-row justify-between gap-3 mt-4">
                <button class="flex-1 bg-green-600 text-white py-3 rounded-lg hover:bg-green-700 transition font-semibold">
                    Proses Transaksi
                </button>
                <button class="flex-1 bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition font-semibold">
                    Batalkan
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
