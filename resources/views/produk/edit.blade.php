@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('produk.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4">
                <span>←</span>
                <span>Kembali ke Daftar Produk</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Produk</h1>
            <p class="text-gray-600 text-sm mt-1">Perbarui informasi produk</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('produk.update', $product['id']) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Produk -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Produk <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $product['nama']) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                            placeholder="Contoh: Nasi Goreng Spesial">
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori" id="kategori" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kategori') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat }}" {{ old('kategori', $product['kategori']) === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="harga" class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-2 text-gray-500">Rp</span>
                            <input type="number" name="harga" id="harga" value="{{ old('harga', $product['harga']) }}" required min="0"
                                class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga') border-red-500 @enderror"
                                placeholder="25000">
                        </div>
                        @error('harga')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', $product['stok']) }}" required min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stok') border-red-500 @enderror"
                            placeholder="50">
                        @error('stok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Gambar URL (Optional) -->
                    <div>
                        <label for="gambar" class="block text-sm font-semibold text-gray-700 mb-2">
                            URL Gambar (Opsional)
                        </label>
                        <input type="url" name="gambar" id="gambar" value="{{ old('gambar', $product['gambar'] ?? '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="https://example.com/image.jpg">
                        <p class="text-xs text-gray-500 mt-1">Masukkan URL gambar produk</p>
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                            placeholder="Deskripsi produk (opsional)">{{ old('deskripsi', $product['deskripsi'] ?? '') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Product Preview -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="font-semibold text-gray-700 mb-3">Preview Produk Saat Ini</h3>
                    <div class="bg-white rounded-lg shadow p-4 max-w-sm">
                        <div class="aspect-square bg-gray-200 rounded-lg mb-3 overflow-hidden">
                            @if(isset($product['gambar']))
                                <img src="{{ $product['gambar'] }}" alt="{{ $product['nama'] }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-gray-400 text-4xl">🖼️</span>
                                </div>
                            @endif
                        </div>
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full mb-2">
                            {{ $product['kategori'] }}
                        </span>
                        <h4 class="font-bold text-gray-800 mb-2">{{ $product['nama'] }}</h4>
                        <p class="text-sm text-gray-600 mb-3">{{ $product['deskripsi'] ?? 'Tidak ada deskripsi' }}</p>
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-xs text-gray-500">Harga</p>
                                <p class="text-lg font-bold text-green-600">Rp {{ number_format($product['harga'], 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Stok</p>
                                <p class="text-lg font-bold text-gray-800">{{ $product['stok'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 justify-end mt-6">
                    <a href="{{ route('produk.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        💾 Update Produk
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <span class="text-2xl">⚠️</span>
                <div>
                    <h3 class="font-semibold text-yellow-900">Catatan</h3>
                    <p class="text-sm text-yellow-800 mt-1">
                        Data produk ini bersifat dummy dan tidak akan tersimpan ke database. Untuk implementasi nyata, 
                        hubungkan dengan database dan tambahkan fitur upload gambar.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

