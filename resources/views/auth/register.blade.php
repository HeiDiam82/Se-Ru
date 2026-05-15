@extends('layouts.app')

@section('content')
<div class="min-h-screen flex">
    <!-- Right: Form Section -->
    <div class="w-full lg:w-1/2 flex items-center justify-center bg-[#Fdfcf0] px-8 sm:px-16 lg:px-24">
        <div class="max-w-md w-full">
            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-[#4A0404] mb-2">Mulai Langkah Pertama</h2>
                <p class="text-gray-600">Buat akun Se-Ru Anda secara gratis untuk mulai mencari dan menyewa ruko impian.</p>
            </div>

            <form class="space-y-5" action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                    <input id="name" name="name" type="text" required autofocus class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0404] focus:border-transparent transition duration-200" placeholder="Budi Santoso">
                </div>

                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <input id="email" name="email" type="email" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0404] focus:border-transparent transition duration-200" placeholder="nama@email.com">
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                    <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0404] focus:border-transparent transition duration-200" placeholder="Minimal 8 karakter">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0404] focus:border-transparent transition duration-200" placeholder="Ulangi kata sandi">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-[#4A0404] hover:bg-opacity-90 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4A0404] transition duration-200">
                        Daftar Akun
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}" class="font-bold text-[#D2B48C] hover:text-[#4A0404] transition">Masuk di sini</a></p>
            </div>
        </div>
    </div>

    <!-- Left (Actually Right visually): Image Section -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-[#4A0404]">
        <img class="absolute inset-0 h-full w-full object-cover opacity-60 mix-blend-overlay" src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Premium Retail Space">
        <div class="absolute inset-0 bg-gradient-to-t from-[#4A0404] via-transparent to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end p-16 text-white h-full w-full items-end text-right">
            <h2 class="text-4xl font-bold mb-4 tracking-tight">Kembangkan Usaha Anda<br>Bersama Kami.</h2>
            <p class="text-lg text-gray-300 max-w-md">Temukan kemudahan dalam mencari ruang ritel yang sesuai dengan gaya bisnis Anda, dengan proses yang cepat dan transparan.</p>
        </div>
    </div>
</div>
@endsection
