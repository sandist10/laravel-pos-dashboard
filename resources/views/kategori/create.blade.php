@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="{{ route('kategori.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4">
                <span>←</span>
                <span>Kembali ke Daftar Kategori</span>
            </a>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Kategori Baru</h1>
            <p class="text-gray-600 text-sm mt-1">Isi form di bawah untuk menambahkan kategori produk baru</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf

                <!-- Nama Kategori -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                        placeholder="Contoh: Makanan, Minuman, Snack">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('description') border-red-500 @enderror"
                        placeholder="Deskripsi kategori (opsional)">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 justify-end">
                    <a href="{{ route('kategori.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>

        <!-- Info -->
        <!-- <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <span class="text-2xl">⚠️</span>
                <div>
                    <h3 class="font-semibold text-yellow-900">Perhatian</h3>
                    <p class="text-sm text-yellow-800 mt-1">
                        Pastikan nama kategori jelas dan mudah dipahami. Kategori yang sudah dibuat dapat diedit atau dihapus kapan saja.
                    </p>
                </div>
            </div>
        </div> -->
    </div>
@endsection

