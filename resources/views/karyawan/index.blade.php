@extends('layouts.app')

@section('content')
<div class="page-heading">
    <h3>Profil Saya</h3>
</div>

<div class="page-content">
    <div class="max-w-3xl mx-auto">

        <!-- logout button -->
        <div class="bg-white shadow rounded-lg p-6 relative">

            <form action="{{ route('logout') }}" method="POST" class="absolute top-4 right-4">
                @csrf
                <button
                    class="px-3 py-1.5 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                    Logout
                </button>
            </form>


            <div class="flex items-center gap-4">

                <!-- Foto profil -->
                <img src="https://ui-avatars.com/api/?name=User+Name&background=0D8ABC&color=fff&size=120"
                    class="w-24 h-24 rounded-full shadow" alt="Foto Profil">

                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Nama Pengguna</h2>
                    <p class="text-gray-500">email@example.com</p>

                    <span class="inline-block mt-2 px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded">
                        Administrator
                    </span>
                </div>
            </div>

            <hr class="my-6">

            <!-- Informasi Detail -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Username</p>
                    <p class="font-medium text-gray-800">admin01</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Nomor Telepon</p>
                    <p class="font-medium text-gray-800">081234567890</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Tanggal Bergabung</p>
                    <p class="font-medium text-gray-800">12 Jan 2023</p>
                </div>

                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm text-gray-500">Role</p>
                    <p class="font-medium text-gray-800">Admin</p>
                </div>

            </div>

            <div class="mt-6 text-right">
                <a href="#"
                    class="inline-block px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Edit Profil
                </a>
            </div>
        </div>

    </div>
</div>
@endsection