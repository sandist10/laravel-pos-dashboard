<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>POS Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">

    <!-- Navbar (mobile only) -->
    <header
        class="md:hidden fixed top-0 left-0 right-0 bg-white shadow-md z-30 flex items-center justify-between px-4 py-3">
        <button onclick="toggleSidebar()" class="text-gray-700 focus:outline-none">
            ☰
        </button>
        <h1 class="font-bold text-gray-700">POS Dashboard</h1>
    </header>

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-screen w-64 bg-white shadow-md border-r transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out z-40 overflow-y-auto">
        <div class="px-6 py-4 text-center border-b sticky top-0 bg-white">
            <h1 class="text-lg font-bold text-gray-700">DASHBOARD</h1>
            <p class="text-xs text-gray-400">Point of Sales</p>
        </div>

        <nav class="mt-4 px-4 space-y-2 text-sm text-gray-700 pb-6">
            <a href="/" class="flex items-center px-3 py-2 rounded-lg bg-gray-100 font-medium">
                <span class="mr-2">🏠</span> Dashboard
            </a>

            <p class="mt-4 text-xs font-semibold text-gray-400 uppercase">Menu Kasir</p>
            <a href="{{ route('kasir') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('kasir') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">💰</span> Kasir
            </a>
            <a href="{{ route('transaksi') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('transaksi') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">🧾</span> Transaksi
            </a>

            <p class="mt-4 text-xs font-semibold text-gray-400 uppercase">Menu Produk</p>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">📦</span> Produk
            </a>
            <div class="ml-6 space-y-1">
                <a href="#" class="block px-3 py-1 text-gray-600 hover:text-gray-900">Kategori</a>
                <a href="#" class="block px-3 py-1 text-gray-600 hover:text-gray-900">Makanan</a>
                <a href="#" class="block px-3 py-1 text-gray-600 hover:text-gray-900">Minuman</a>
                <a href="#" class="block px-3 py-1 text-gray-600 hover:text-gray-900">Stok</a>
            </div>

            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">💲</span> Harga
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">🛒</span> Pesanan
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">🚚</span> Supplier
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">📥</span> Receive
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">📤</span> Issued
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">👥</span> Karyawan
            </a>
        </nav>
    </aside>

    <!-- Overlay untuk mobile -->
    <div id="overlay" onclick="toggleSidebar()"
        class="fixed inset-0 bg-black bg-opacity-40 hidden z-30 md:hidden"></div>

    <!-- Konten utama -->
    <main
        class="md:ml-64 mt-12 md:mt-0 flex-1 p-4 md:p-6 overflow-y-auto h-[calc(100vh-3rem)] md:h-screen">
        @yield('content')
    </main>

    <script>
        // Toggle sidebar + overlay
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>

</html>
