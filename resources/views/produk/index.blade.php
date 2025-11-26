@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Daftar Produk</h1>
                <p class="text-gray-600 text-sm mt-1">Kelola semua produk untuk sistem POS Anda</p>
            </div>
            <div class="flex gap-2">
                <button onclick="openKategoriModal()"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                    <span>+</span>
                    <span>Tambah Kategori</span>
                </button>
                <a href="{{ route('produk.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                    <span>+</span>
                    <span>Tambah Produk</span>
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">×</button>
            </div>
        @endif

        <!-- Filter & Search -->
        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <form method="GET" action="{{ route('produk.index') }}" class="flex flex-col sm:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <input type="text" name="search" value="{{ $search ?? '' }}" 
                        placeholder="Cari produk..." 
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <!-- Filter Kategori -->
                <div class="flex gap-2 overflow-x-auto">
                    @foreach ($categories as $cat)
                        <a href="{{ route('produk.index', ['kategori' => $cat, 'search' => $search ?? '']) }}"
                            class="px-4 py-2 rounded-lg whitespace-nowrap transition {{ ($kategori ?? 'Semua') === $cat ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            {{ $cat }}
                        </a>
                    @endforeach
                </div>

                <!-- Button Search -->
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    🔍 Cari
                </button>
            </form>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Produk</p>
                        <p class="text-2xl font-bold text-gray-800">{{ count($products) }}</p>
                    </div>
                    <!-- <div class="text-4xl">📦</div> -->
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Stok</p>
                        <p class="text-2xl font-bold text-gray-800">{{ array_sum(array_column($products, 'stok')) }}</p>
                    </div>
                    <!-- <div class="text-4xl">📊</div> -->
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Kategori Aktif</p>
                        <p class="text-2xl font-bold text-gray-800">{{ count(array_unique(array_column($products, 'kategori'))) }}</p>
                    </div>
                    <!-- <div class="text-4xl">🏷️</div> -->
                </div>
            </div>
        </div>

        <!-- Grid Produk -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($products as $product)
                <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition overflow-hidden flex flex-col">
                    <!-- Gambar Produk -->
                    <div class="aspect-square bg-gray-100 overflow-hidden">
                        <img src="{{ $product['gambar'] }}" 
                             alt="{{ $product['nama'] }}" 
                             class="w-full h-full object-cover hover:scale-110 transition duration-300">
                    </div>

                    <!-- Info Produk -->
                    <div class="p-4 flex-1 flex flex-col">
                        <!-- Kategori Badge -->
                        <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full mb-2 w-fit">
                            {{ $product['kategori'] }}
                        </span>

                        <!-- Nama Produk -->
                        <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $product['nama'] }}</h3>

                        <!-- Deskripsi -->
                        <p class="text-gray-600 text-sm mb-3 flex-1">{{ $product['deskripsi'] }}</p>

                        <!-- Harga & Stok -->
                        <div class="flex justify-between items-center mb-3">
                            <div>
                                <p class="text-xs text-gray-500">Harga</p>
                                <p class="text-lg font-bold text-green-600">Rp {{ number_format($product['harga'], 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500">Stok</p>
                                <p class="text-lg font-bold {{ $product['stok'] < 20 ? 'text-red-600' : 'text-gray-800' }}">
                                    {{ $product['stok'] }}
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <a href="{{ route('produk.edit', $product['id']) }}" 
                               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded-lg transition text-sm font-medium">
                                ✏️ Edit
                            </a>
                            <form action="{{ route('produk.destroy', $product['id']) }}" method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="flex-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg transition text-sm font-medium">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl shadow p-12 text-center">
                        <span class="text-6xl mb-4 block">🔍</span>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Produk Tidak Ditemukan</h3>
                        <p class="text-gray-600 mb-4">Tidak ada produk yang sesuai dengan pencarian Anda</p>
                        <a href="{{ route('produk.index') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                            ← Kembali ke semua produk
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Info Card -->
        <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <span class="text-2xl">💡</span>
                <div>
                    <h3 class="font-semibold text-blue-900">Tips Manajemen Produk</h3>
                    <p class="text-sm text-blue-800 mt-1">
                        Pastikan stok produk selalu terisi. Produk dengan stok di bawah 20 akan ditandai dengan warna merah.
                        Gunakan filter kategori untuk mempermudah pencarian produk.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div id="kategoriModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4 hidden">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800">Tambah Kategori Baru</h2>
                <button onclick="closeKategoriModal()" class="text-gray-400 hover:text-gray-600 text-2xl">
                    ×
                </button>
            </div>

            <!-- Modal Body -->
            <form action="{{ route('kategori.store') }}" method="POST" class="p-6">
                @csrf

                <!-- Nama Kategori -->
                <div class="mb-4">
                    <label for="modal_name" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="modal_name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Contoh: Makanan, Minuman, Snack">
                </div>

                <!-- Deskripsi -->
                <div class="mb-6">
                    <label for="modal_description" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="description" id="modal_description" rows="3"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                        placeholder="Deskripsi kategori (opsional)"></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeKategoriModal()"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        💾 Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openKategoriModal() {
            const modal = document.getElementById('kategoriModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeKategoriModal() {
            const modal = document.getElementById('kategoriModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
            // Reset form
            document.getElementById('modal_name').value = '';
            document.getElementById('modal_description').value = '';
        }

        // Close modal when clicking outside
        document.getElementById('kategoriModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeKategoriModal();
            }
        });

        // Close modal with ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeKategoriModal();
            }
        });
    </script>
@endsection

