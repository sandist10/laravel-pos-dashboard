<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="h-full bg-gray-100 flex items-center justify-center p-6">

<div class="w-full max-w-md">

    <div class="text-center mb-8">
        <svg class="mx-auto h-12 w-12 text-primary-600" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                  d="M12 6v6l4 2" />
        </svg>
        <h2 class="mt-4 text-2xl font-bold text-gray-800">Masuk ke Sistem</h2>
        <p class="text-gray-500 text-sm">Gunakan akun dummy untuk masuk</p>
    </div>

    <div class="bg-white shadow-xl rounded-xl p-6 border border-gray-200">

        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required value="admin@example.com"
                       class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-primary-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" required value="password123"
                       class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-primary-500">
            </div>

            <button type="submit"
                    class="w-full py-3 bg-primary-600 text-black rounded-lg hover:bg-primary-700 transition">
                Login
            </button>
        </form>

        <p class="mt-4 text-center text-sm text-gray-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar Sekarang</a>
        </p>
    </div>

</div>
</body>
</html>
