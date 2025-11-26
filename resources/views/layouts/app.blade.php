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
            <a href="/"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 
          {{ request()->is('/') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                </span> Dashboard
            </a>

            <p class="mt-4 text-xs font-semibold text-gray-400 uppercase">Menu Kasir</p>
            <a href="{{ route('kasir') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('kasir') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125Z" />
                    </svg>
                </span> Kasir
            </a>
            <a href="{{ route('transaksi') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('transaksi') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                </span> Transaksi
            </a>

            <p class="mt-4 text-xs font-semibold text-gray-400 uppercase">Menu Produk</p>
            <a href="{{ route('produk.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('produk') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6.878V6a2.25 2.25 0 0 1 2.25-2.25h7.5A2.25 2.25 0 0 1 18 6v.878m-12 0c.235-.083.487-.128.75-.128h10.5c.263 0 .515.045.75.128m-12 0A2.25 2.25 0 0 0 4.5 9v.878m13.5-3A2.25 2.25 0 0 1 19.5 9v.878m0 0a2.246 2.246 0 0 0-.75-.128H5.25c-.263 0-.515.045-.75.128m15 0A2.25 2.25 0 0 1 21 12v6a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 18v-6c0-.98.626-1.813 1.5-2.122" />
                    </svg>
                </span> Produk
            </a>
            <a href="{{ route('kategori.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('kategori*') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                </span> Kategori
            </a>

            <!-- <p class="mt-3 text-xs font-semibold text-gray-400 uppercase pl-3">Filter Kategori</p>
            <div class="ml-6 space-y-1">
                <a href="{{ route('produk.index', ['kategori' => 'Makanan']) }}" class="block px-3 py-1 text-gray-600 hover:text-gray-900">🍜 Makanan</a>
                <a href="{{ route('produk.index', ['kategori' => 'Minuman']) }}" class="block px-3 py-1 text-gray-600 hover:text-gray-900">☕ Minuman</a>
                <a href="{{ route('produk.index', ['kategori' => 'Snack']) }}" class="block px-3 py-1 text-gray-600 hover:text-gray-900">🍿 Snack</a>
            </div> -->

            <p class="mt-4 text-xs font-semibold text-gray-400 uppercase">Menu Inventory</p>
            <a href="{{ route('inventory.index') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('inventory*') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                </span> Bahan Baku
            </a>
            <!-- <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">🚚</span> Supplier
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">📥</span> Stok Masuk
            </a>
            <a href="#" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100">
                <span class="mr-2">📤</span> Stok Keluar
            </a> -->
            <a href="{{ route('karyawan') }}" class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 {{ request()->is('karyawan*') ? 'bg-gray-200 font-semibold' : '' }}">
                <span class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span> Profile
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