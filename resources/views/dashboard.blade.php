@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">

    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Dashboard Point of Sales</h1>

    {{-- Statistik Utama --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Laba Kotor Hari Ini</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">Rp{{ number_format($data['profit_today'], 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Penerimaan Barang</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">Rp{{ number_format($data['goods_received'], 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Estimasi Kerugian</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">Rp{{ number_format($data['loss_estimate'], 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Transaksi Selesai</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">{{ count($data['transactions']) }}</p>
        </div>
    </div>

    {{-- Grafik Penjualan --}}
    <div class="bg-white border rounded-2xl shadow-sm p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Grafik Penjualan</h2>
        <div class="relative h-64">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- ===== Data Dummy Ditambahkan Di Sini ===== --}}
        @php
            // Data dummy untuk transaksi hari ini
            $data['transactions'] = [
                (object)[ 'transaction_id' => 'TRX-001', 'amount' => 35000, 'status' => 'selesai' ],
                (object)[ 'transaction_id' => 'TRX-002', 'amount' => 18500, 'status' => 'pending' ],
                (object)[ 'transaction_id' => 'TRX-003', 'amount' => 72000, 'status' => 'selesai' ],
                (object)[ 'transaction_id' => 'TRX-004', 'amount' => 15000, 'status' => 'pending' ],
                (object)[ 'transaction_id' => 'TRX-005', 'amount' => 42000, 'status' => 'selesai' ],
            ];

            // Data dummy untuk produk populer
            $data['popular_products'] = [
                (object)[ 'name' => 'Teh Botol Sosro', 'stock' => 34 ],
                (object)[ 'name' => 'Mie Sedap Goreng', 'stock' => 12 ],
                (object)[ 'name' => 'Aqua 600ml', 'stock' => 50 ],
                (object)[ 'name' => 'Chitato BBQ 68g', 'stock' => 21 ],
            ];
        @endphp
        {{-- ========================================== --}}

        {{-- Transaksi --}}
        <div class="bg-white border rounded-2xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Transaksi Hari Ini</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border-separate border-spacing-y-1">
                    <thead class="text-gray-600 text-xs uppercase">
                        <tr>
                            <th class="p-2 text-left">ID</th>
                            <th class="p-2 text-right">Jumlah</th>
                            <th class="p-2 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['transactions'] as $trx)
                        <tr class="bg-gray-50 hover:bg-gray-100">
                            <td class="p-3 rounded-l-lg">{{ $trx->transaction_id }}</td>
                            <td class="p-3 text-right">Rp{{ number_format($trx->amount, 0, ',', '.') }}</td>
                            <td class="p-3 text-center rounded-r-lg">
                                <span class="
                                    px-2 py-1 text-xs rounded-full font-medium
                                    {{ $trx->status == 'selesai'
                                        ? 'bg-green-100 text-green-700'
                                        : 'bg-yellow-100 text-yellow-700'
                                    }}
                                ">
                                    {{ ucfirst($trx->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Produk Populer --}}
        <div class="bg-white border rounded-2xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Produk Populer</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm border-separate border-spacing-y-1">
                    <thead class="text-gray-600 text-xs uppercase">
                        <tr>
                            <th class="p-2 text-left">Nama Produk</th>
                            <th class="p-2 text-right">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['popular_products'] as $prod)
                        <tr class="bg-gray-50 hover:bg-gray-100">
                            <td class="p-3 rounded-l-lg">{{ $prod->name }}</td>
                            <td class="p-3 text-right rounded-r-lg">{{ $prod->stock }} pcs</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{-- ChartJS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('salesChart').getContext('2d');
new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['1', '2', '3', '4', '5'],
        datasets: [{
            label: 'Penjualan Harian',
            data: @json($data['sales_data']),
            borderColor: '#3b82f6',
            backgroundColor: 'rgba(59,130,246,0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: { grid: { color: '#e5e7eb' }},
            x: { grid: { display: false }},
        }
    }
});
</script>
@endsection
