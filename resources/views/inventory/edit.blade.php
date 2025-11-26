@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('inventory.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4">
                <span>←</span>
                <span>Kembali ke Inventory</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Edit Bahan Baku</h1>
            <p class="text-gray-600 text-sm mt-1">Perbarui informasi bahan baku</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('inventory.update', $item['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Bahan -->
                    <div class="md:col-span-2">
                        <label for="nama" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Bahan Baku <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $item['nama']) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama') border-red-500 @enderror"
                            placeholder="Contoh: Beras Premium, Minyak Goreng">
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
                                <option value="{{ $cat }}" {{ old('kategori', $item['kategori']) === $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Satuan -->
                    <div>
                        <label for="satuan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Satuan <span class="text-red-500">*</span>
                        </label>
                        <select name="satuan" id="satuan" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('satuan') border-red-500 @enderror">
                            <option value="">Pilih Satuan</option>
                            @foreach ($satuan as $unit)
                                <option value="{{ $unit }}" {{ old('satuan', $item['satuan']) === $unit ? 'selected' : '' }}>
                                    {{ $unit }}
                                </option>
                            @endforeach
                        </select>
                        @error('satuan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div>
                        <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                            Stok Saat Ini <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok" id="stok" value="{{ old('stok', $item['stok']) }}" required min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stok') border-red-500 @enderror"
                            placeholder="100">
                        @error('stok')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stok Minimum -->
                    <div>
                        <label for="stok_minimum" class="block text-sm font-semibold text-gray-700 mb-2">
                            Stok Minimum <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok_minimum" id="stok_minimum" value="{{ old('stok_minimum', $item['stok_minimum']) }}" required min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('stok_minimum') border-red-500 @enderror"
                            placeholder="20">
                        <p class="text-xs text-gray-500 mt-1">Batas minimum stok untuk peringatan</p>
                        @error('stok_minimum')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Harga Beli -->
                    <div>
                        <label for="harga_beli" class="block text-sm font-semibold text-gray-700 mb-2">
                            Harga Beli (per satuan) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-2 text-gray-500">Rp</span>
                            <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli', $item['harga_beli']) }}" required min="0"
                                class="w-full pl-12 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('harga_beli') border-red-500 @enderror"
                                placeholder="15000">
                        </div>
                        @error('harga_beli')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Supplier -->
                    <div>
                        <label for="supplier" class="block text-sm font-semibold text-gray-700 mb-2">
                            Supplier <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="supplier" id="supplier" value="{{ old('supplier', $item['supplier']) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('supplier') border-red-500 @enderror"
                            placeholder="Nama supplier">
                        @error('supplier')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Masuk -->
                    <div>
                        <label for="tanggal_masuk" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Masuk <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', $item['tanggal_masuk']) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_masuk') border-red-500 @enderror">
                        @error('tanggal_masuk')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="md:col-span-2">
                        <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Keterangan
                        </label>
                        <textarea name="keterangan" id="keterangan" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('keterangan') border-red-500 @enderror"
                            placeholder="Keterangan tambahan (opsional)">{{ old('keterangan', $item['keterangan']) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Current Info -->
                <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                    <h3 class="font-semibold text-gray-700 mb-3">Informasi Saat Ini</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Stok Saat Ini</p>
                            <p class="font-bold text-gray-900">{{ $item['stok'] }} {{ $item['satuan'] }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Stok Minimum</p>
                            <p class="font-bold text-gray-900">{{ $item['stok_minimum'] }} {{ $item['satuan'] }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Harga Beli</p>
                            <p class="font-bold text-gray-900">Rp {{ number_format($item['harga_beli'], 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Total Nilai</p>
                            <p class="font-bold text-green-600">Rp {{ number_format($item['stok'] * $item['harga_beli'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 justify-end mt-6">
                    <a href="{{ route('inventory.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Update Bahan Baku
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

