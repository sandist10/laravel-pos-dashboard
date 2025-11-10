@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Dashboard Point of Sales</h1>

    <!-- Statistik Utama -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="p-4 bg-white shadow rounded-xl text-center sm:text-left">
            <p class="text-gray-500 text-sm">Laba Kotor Hari Ini</p>
            <h2 class="text-xl font-bold text-gray-800">Rp{{ number_format($data['profit_today'], 0, ',', '.') }}</h2>
        </div>
        <div class="p-4 bg-white shadow rounded-xl text-center sm:text-left">
            <p class="text-gray-500 text-sm">Penerimaan Barang</p>
            <h2 class="text-xl font-bold text-gray-800">Rp{{ number_format($data['goods_received'], 0, ',', '.') }}</h2>
        </div>
        <div class="p-4 bg-white shadow rounded-xl text-center sm:text-left">
            <p class="text-gray-500 text-sm">Estimasi Kerugian</p>
            <h2 class="text-xl font-bold text-gray-800">Rp{{ number_format($data['loss_estimate'], 0, ',', '.') }}</h2>
        </div>
        <div class="p-4 bg-white shadow rounded-xl text-center sm:text-left">
            <p class="text-gray-500 text-sm">Transaksi Selesai</p>
            <h2 class="text-xl font-bold text-gray-800">{{ count($data['transactions']) }}</h2>
        </div>
    </div>

    <!-- Grafik Penjualan -->
    <div class="bg-white p-4 sm:p-6 rounded-xl shadow mb-6 overflow-x-auto">
        <h2 class="text-lg font-semibold mb-4 text-gray-700">Grafik Penjualan</h2>
        <div class="w-full min-w-[300px]">
            <canvas id="salesChart" class="max-w-full"></canvas>
        </div>
    </div>

    <!-- Tabel Transaksi dan Produk Populer -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Transaksi -->
        <div class="bg-white p-4 shadow rounded-xl overflow-x-auto">
            <h2 class="font-semibold mb-2 text-gray-700">Transaksi Hari Ini</h2>
            <table class="w-full text-sm border-collapse min-w-[400px]">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">ID</th>
                        <th class="border p-2 text-right">Jumlah</th>
                        <th class="border p-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['transactions'] as $trx)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-2">{{ $trx->transaction_id }}</td>
                        <td class="p-2 text-right">Rp{{ number_format($trx->amount, 0, ',', '.') }}</td>
                        <td class="p-2 text-center">
                            <span class="px-2 py-1 text-xs rounded 
                                {{ $trx->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ ucfirst($trx->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Produk Populer -->
        <div class="bg-white p-4 shadow rounded-xl overflow-x-auto">
            <h2 class="font-semibold mb-2 text-gray-700">Produk Populer</h2>
            <table class="w-full text-sm border-collapse min-w-[300px]">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border p-2 text-left">Nama Produk</th>
                        <th class="border p-2 text-right">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['popular_products'] as $prod)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-2">{{ $prod->name }}</td>
                        <td class="p-2 text-right">{{ $prod->stock }} pcs</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ChartJS -->
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
            borderColor: '#36A2EB',
            backgroundColor: 'rgba(54,162,235,0.1)',
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
@endsection
