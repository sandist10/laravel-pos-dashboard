@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="bg-white shadow-sm border-b px-6 py-4 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">💰 Kasir POS</h1>
                <p class="text-sm text-gray-600">Sistem Point of Sale</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600">Kasir: <span class="font-semibold">Admin</span></p>
                <p class="text-xs text-gray-500" id="currentDateTime"></p>
            </div>
        </div>
    </div>

    <div class="px-4 sm:px-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- ======== DAFTAR PRODUK ======== -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-5">
                <h2 class="text-lg font-bold text-gray-800 mb-4">📦 Daftar Produk</h2>

                <!-- Search & Filter -->
                <div class="mb-4">
                    <input
                        type="text"
                        id="searchProduct"
                        placeholder="🔍 Cari produk..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>

                <!-- Kategori Filter -->
                <div class="flex gap-2 mb-4 overflow-x-auto pb-2">
                    @foreach ($categories as $cat)
                        <button onclick="filterCategory('{{ $cat }}')"
                            data-category="{{ $cat }}"
                            class="category-btn px-4 py-2 text-sm rounded-lg whitespace-nowrap transition {{ $cat === 'Semua' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            {{ $cat }}
                        </button>
                    @endforeach
                </div>

                <!-- Grid Produk -->
                <div id="productGrid" class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-4 gap-4 max-h-[calc(100vh-400px)] overflow-y-auto pr-2">
                    @foreach ($products as $product)
                    <div class="product-card bg-white border-2 border-gray-200 rounded-xl shadow-sm hover:shadow-lg hover:border-blue-400 transition overflow-hidden flex flex-col cursor-pointer"
                         data-category="{{ $product['kategori'] }}"
                         data-name="{{ strtolower($product['nama']) }}"
                         onclick='addToCart(@json($product))'>
                        <!-- Gambar -->
                        <div class="aspect-square bg-gray-100 overflow-hidden">
                            <img src="{{ $product['gambar'] }}"
                                 alt="{{ $product['nama'] }}"
                                 class="w-full h-full object-cover hover:scale-110 transition duration-300">
                        </div>

                        <!-- Info -->
                        <div class="p-3 flex flex-col flex-grow">
                            <span class="text-xs px-2 py-1 bg-blue-100 text-blue-800 rounded-full mb-2 w-fit">
                                {{ $product['kategori'] }}
                            </span>
                            <h3 class="text-gray-800 font-semibold text-sm mb-1 line-clamp-2">{{ $product['nama'] }}</h3>
                            <p class="text-blue-600 font-bold text-base">Rp {{ number_format($product['harga'], 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Stok: {{ $product['stok'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        <!-- ======== KERANJANG & CHECKOUT ======== -->
        <div class="bg-white rounded-xl shadow-md p-5 flex flex-col h-fit lg:sticky lg:top-4">
            <h2 class="text-lg font-bold text-gray-800 mb-4">🛒 Keranjang Belanja</h2>

            <!-- Cart Items -->
            <div id="cartItems" class="flex-1 overflow-y-auto max-h-[300px] mb-4 border rounded-lg">
                <div id="emptyCart" class="text-center py-12 text-gray-400">
                    <div class="text-6xl mb-2">🛒</div>
                    <p class="text-sm">Keranjang masih kosong</p>
                    <p class="text-xs">Klik produk untuk menambah</p>
                </div>
            </div>

            <!-- Summary -->
            <div class="border-t pt-4 space-y-3">
                <!-- Subtotal -->
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-semibold" id="subtotal">Rp 0</span>
                </div>

                <!-- Diskon -->
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Diskon</span>
                    <input type="number" id="discountInput" value="0" min="0"
                        class="w-24 text-right border border-gray-300 rounded px-2 py-1 text-sm"
                        onchange="updateTotal()">
                </div>

                <!-- Pajak (10%) -->
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Pajak (10%)</span>
                    <span class="font-semibold" id="tax">Rp 0</span>
                </div>

                <!-- Total -->
                <div class="flex justify-between text-lg font-bold text-blue-600 border-t pt-3">
                    <span>TOTAL</span>
                    <span id="grandTotal">Rp 0</span>
                </div>

                <!-- Uang Diterima -->
                <div class="mt-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Uang Diterima</label>
                    <input type="number" id="cashInput"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 text-lg font-semibold focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="0" onchange="calculateChange()">
                </div>

                <!-- Kembalian -->
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-semibold text-green-800">Kembalian</span>
                        <span class="text-xl font-bold text-green-600" id="change">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-4 space-y-2">
                <button onclick="processTransaction()"
                    class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                    <span>✓</span>
                    <span>Proses Transaksi</span>
                </button>
                <button onclick="clearCart()"
                    class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                    <span>✕</span>
                    <span>Batalkan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Cart data
    let cart = [];

    // Update current date time
    function updateDateTime() {
        const now = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        };
        document.getElementById('currentDateTime').textContent = now.toLocaleDateString('id-ID', options);
    }
    updateDateTime();
    setInterval(updateDateTime, 60000);

    // Add to cart
    function addToCart(product) {
        const existingItem = cart.find(item => item.id === product.id);

        if (existingItem) {
            if (existingItem.qty < product.stok) {
                existingItem.qty++;
            } else {
                alert('Stok tidak mencukupi!');
                return;
            }
        } else {
            cart.push({
                ...product,
                qty: 1
            });
        }

        renderCart();
        updateTotal();
    }

    // Remove from cart
    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        renderCart();
        updateTotal();
    }

    // Update quantity
    function updateQty(productId, change) {
        const item = cart.find(item => item.id === productId);
        if (item) {
            const newQty = item.qty + change;
            if (newQty > 0 && newQty <= item.stok) {
                item.qty = newQty;
                renderCart();
                updateTotal();
            } else if (newQty > item.stok) {
                alert('Stok tidak mencukupi!');
            }
        }
    }

    // Render cart
    function renderCart() {
        const cartContainer = document.getElementById('cartItems');
        const emptyCart = document.getElementById('emptyCart');

        if (cart.length === 0) {
            emptyCart.style.display = 'block';
            cartContainer.innerHTML = '';
            cartContainer.appendChild(emptyCart);
            return;
        }

        emptyCart.style.display = 'none';

        let html = '<div class="divide-y">';
        cart.forEach(item => {
            const subtotal = item.harga * item.qty;
            html += `
                <div class="p-3 hover:bg-gray-50">
                    <div class="flex justify-between items-start mb-2">
                        <div class="flex-1">
                            <h4 class="font-semibold text-sm text-gray-800">${item.nama}</h4>
                            <p class="text-xs text-gray-500">Rp ${item.harga.toLocaleString('id-ID')}</p>
                        </div>
                        <button onclick="removeFromCart(${item.id})"
                            class="text-red-500 hover:text-red-700 ml-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            <button onclick="updateQty(${item.id}, -1)"
                                class="w-7 h-7 bg-gray-200 hover:bg-gray-300 rounded flex items-center justify-center font-bold">
                                -
                            </button>
                            <span class="w-8 text-center font-semibold">${item.qty}</span>
                            <button onclick="updateQty(${item.id}, 1)"
                                class="w-7 h-7 bg-blue-600 hover:bg-blue-700 text-white rounded flex items-center justify-center font-bold">
                                +
                            </button>
                        </div>
                        <span class="font-bold text-blue-600">Rp ${subtotal.toLocaleString('id-ID')}</span>
                    </div>
                </div>
            `;
        });
        html += '</div>';

        cartContainer.innerHTML = html;
    }

    // Update total
    function updateTotal() {
        const subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);
        const discount = parseInt(document.getElementById('discountInput').value) || 0;
        const tax = Math.round((subtotal - discount) * 0.1);
        const grandTotal = subtotal - discount + tax;

        document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        document.getElementById('tax').textContent = 'Rp ' + tax.toLocaleString('id-ID');
        document.getElementById('grandTotal').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');

        calculateChange();
    }

    // Calculate change
    function calculateChange() {
        const subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);
        const discount = parseInt(document.getElementById('discountInput').value) || 0;
        const tax = Math.round((subtotal - discount) * 0.1);
        const grandTotal = subtotal - discount + tax;
        const cash = parseInt(document.getElementById('cashInput').value) || 0;
        const change = cash - grandTotal;

        document.getElementById('change').textContent = 'Rp ' + (change >= 0 ? change : 0).toLocaleString('id-ID');

        if (change < 0 && cash > 0) {
            document.getElementById('change').classList.add('text-red-600');
            document.getElementById('change').classList.remove('text-green-600');
        } else {
            document.getElementById('change').classList.add('text-green-600');
            document.getElementById('change').classList.remove('text-red-600');
        }
    }

    // Process transaction
    function processTransaction() {
        if (cart.length === 0) {
            alert('Keranjang masih kosong!');
            return;
        }

        const subtotal = cart.reduce((sum, item) => sum + (item.harga * item.qty), 0);
        const discount = parseInt(document.getElementById('discountInput').value) || 0;
        const tax = Math.round((subtotal - discount) * 0.1);
        const grandTotal = subtotal - discount + tax;
        const cash = parseInt(document.getElementById('cashInput').value) || 0;

        if (cash < grandTotal) {
            alert('Uang yang diterima kurang!');
            return;
        }

        const change = cash - grandTotal;

        // Show success message
        alert(`Transaksi Berhasil!\n\nTotal: Rp ${grandTotal.toLocaleString('id-ID')}\nUang Diterima: Rp ${cash.toLocaleString('id-ID')}\nKembalian: Rp ${change.toLocaleString('id-ID')}`);

        // Clear cart
        clearCart();
    }

    // Clear cart
    function clearCart() {
        if (cart.length > 0) {
            if (confirm('Yakin ingin membatalkan transaksi?')) {
                cart = [];
                document.getElementById('discountInput').value = 0;
                document.getElementById('cashInput').value = '';
                renderCart();
                updateTotal();
            }
        }
    }

    // Filter by category
    function filterCategory(category) {
        // Update button styles
        document.querySelectorAll('.category-btn').forEach(btn => {
            if (btn.dataset.category === category) {
                btn.classList.remove('bg-gray-200', 'text-gray-700');
                btn.classList.add('bg-blue-600', 'text-white');
            } else {
                btn.classList.remove('bg-blue-600', 'text-white');
                btn.classList.add('bg-gray-200', 'text-gray-700');
            }
        });

        // Filter products
        const products = document.querySelectorAll('.product-card');
        products.forEach(product => {
            if (category === 'Semua' || product.dataset.category === category) {
                product.style.display = 'flex';
            } else {
                product.style.display = 'none';
            }
        });
    }

    // Search products
    document.getElementById('searchProduct').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const products = document.querySelectorAll('.product-card');

        products.forEach(product => {
            const productName = product.dataset.name;
            if (productName.includes(searchTerm)) {
                product.style.display = 'flex';
            } else {
                product.style.display = 'none';
            }
        });
    });
</script>
@endsection
