@extends('layouts.app')

@section('content')
<div class="p-4 sm:p-6 bg-gray-100 min-h-screen">
    <h1 class="text-2xl font-bold mb-6 text-center sm:text-left">Riwayat Pembelian</h1>

    <div class="bg-white p-4 sm:p-6 rounded-xl shadow overflow-x-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
            <h2 class="font-semibold text-lg text-gray-700">Daftar Transaksi</h2>

            <input 
                type="text" 
                placeholder="Cari transaksi..." 
                class="border border-gray-300 rounded-lg px-3 py-2 w-full sm:w-64 focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
        </div>

        <!-- Tabel untuk layar besar -->
        <div class="hidden md:block">
            <table class="w-full text-sm border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border p-2 text-left">ID</th>
                        <th class="border p-2 text-left">Tanggal</th>
                        <th class="border p-2 text-right">Total</th>
                        <th class="border p-2 text-left">Kasir</th>
                        <th class="border p-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $trx)
                    <tr class="border-t hover:bg-gray-50 transition">
                        <td class="p-2">{{ $trx['id'] }}</td>
                        <td class="p-2">{{ \Carbon\Carbon::parse($trx['tanggal'])->format('d M Y') }}</td>
                        <td class="p-2 text-right">Rp{{ number_format($trx['total'], 0, ',', '.') }}</td>
                        <td class="p-2">{{ $trx['kasir'] }}</td>
                        <td class="p-2 text-center">
                            @if($trx['status'] === 'Selesai')
                                <span class="px-2 py-1 bg-green-100 text-green-600 rounded text-xs">Selesai</span>
                            @else
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-600 rounded text-xs">Pending</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tampilan kartu untuk layar kecil -->
        <div class="grid gap-4 md:hidden">
            @foreach ($transactions as $trx)
            <div class="border rounded-lg p-4 shadow-sm hover:shadow-md transition">
                <div class="flex justify-between items-center mb-2">
                    <h3 class="font-semibold text-gray-800">Transaksi #{{ $trx['id'] }}</h3>
                    @if($trx['status'] === 'Selesai')
                        <span class="px-2 py-1 bg-green-100 text-green-600 rounded text-xs">Selesai</span>
                    @else
                        <span class="px-2 py-1 bg-yellow-100 text-yellow-600 rounded text-xs">Pending</span>
                    @endif
                </div>
                <p class="text-gray-600 text-sm">
                    <span class="font-medium">Tanggal:</span> {{ \Carbon\Carbon::parse($trx['tanggal'])->format('d M Y') }}
                </p>
                <p class="text-gray-600 text-sm">
                    <span class="font-medium">Kasir:</span> {{ $trx['kasir'] }}
                </p>
                <p class="text-gray-600 text-sm">
                    <span class="font-medium">Total:</span> Rp{{ number_format($trx['total'], 0, ',', '.') }}
                </p>
            </div>
            @endforeach
        </div>

        <!-- Pesan jika kosong -->
        @if (count($transactions) === 0)
        <p class="text-center text-gray-500 mt-4">Belum ada transaksi yang tercatat.</p>
        @endif
    </div>
</div>
@endsection
