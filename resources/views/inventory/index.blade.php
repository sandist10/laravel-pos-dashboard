@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Inventory Bahan Baku</h1>
                <p class="text-gray-600 text-sm mt-1">Kelola stok bahan baku untuk operasional</p>
            </div>
            <a href="{{ route('inventory.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                <span>+</span>
                <span>Tambah Bahan Baku</span>
            </a>
        </div>

        <!-- Alert Success -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-green-700 font-bold">×</button>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Total Item</p>
                        <p class="text-2xl font-bold text-gray-800">{{ count($inventory) }}</p>
                    </div>
                    <!-- <div class="text-4xl">📦</div> -->
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Stok Rendah</p>
                        <p class="text-2xl font-bold text-red-600">
                            {{ count(array_filter($inventory, fn($item) => $item['stok'] <= $item['stok_minimum'])) }}
                        </p>
                    </div>
                    <!-- <div class="text-4xl">⚠️</div> -->
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Kategori</p>
                        <p class="text-2xl font-bold text-gray-800">{{ count($categories) }}</p>
                    </div>
                    <!-- <div class="text-4xl">🏷️</div> -->
                </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm">Nilai Inventory</p>
                        <p class="text-lg font-bold text-green-600">
                            Rp {{ number_format(array_sum(array_map(fn($item) => $item['stok'] * $item['harga_beli'], $inventory)), 0, ',', '.') }}
                        </p>
                    </div>
                    <!-- <div class="text-4xl">💰</div> -->
                </div>
            </div>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-xl shadow p-4 mb-6">
            <div class="flex flex-wrap gap-2">
                <button onclick="filterCategory('Semua')" 
                    class="filter-btn px-4 py-2 bg-blue-600 text-white text-sm rounded-lg transition">
                    Semua
                </button>
                @foreach ($categories as $cat)
                    <button onclick="filterCategory('{{ $cat }}')" 
                        class="filter-btn px-4 py-2 bg-gray-200 text-gray-700 text-sm rounded-lg hover:bg-gray-300 transition">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Bahan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Stok</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Harga Beli</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Supplier</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($inventory as $index => $item)
                            <tr class="hover:bg-gray-50 transition inventory-row" data-category="{{ $item['kategori'] }}">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $item['nama'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $item['keterangan'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $item['kategori'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold {{ $item['stok'] <= $item['stok_minimum'] ? 'text-red-600' : 'text-gray-900' }}">
                                        {{ $item['stok'] }}
                                    </div>
                                    <div class="text-xs text-gray-500">Min: {{ $item['stok_minimum'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item['satuan'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    Rp {{ number_format($item['harga_beli'], 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                    {{ $item['supplier'] }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($item['stok'] <= $item['stok_minimum'])
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            ⚠️ Stok Rendah
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            ✓ Aman
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex gap-2">
                                        <a href="{{ route('inventory.edit', $item['id']) }}"
                                            class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('inventory.destroy', $item['id']) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus bahan baku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Info Card -->
        <!-- <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <div class="flex items-start gap-3">
                <span class="text-2xl">💡</span>
                <div>
                    <h3 class="font-semibold text-yellow-900">Tips Manajemen Inventory</h3>
                    <p class="text-sm text-yellow-800 mt-1">
                        Pastikan stok bahan baku selalu di atas stok minimum. Item dengan status "Stok Rendah" perlu segera di-restock. 
                        Lakukan stock opname secara berkala untuk memastikan data akurat.
                    </p>
                </div>
            </div>
        </div> -->
    </div>

    <script>
        function filterCategory(category) {
            // Update button styles
            document.querySelectorAll('.filter-btn').forEach(btn => {
                if (btn.textContent.trim() === category) {
                    btn.classList.remove('bg-gray-200', 'text-gray-700');
                    btn.classList.add('bg-blue-600', 'text-white');
                } else {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                }
            });
            
            // Filter rows
            document.querySelectorAll('.inventory-row').forEach(row => {
                if (category === 'Semua' || row.dataset.category === category) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
@endsection

