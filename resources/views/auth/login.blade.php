@extends('layouts.app')

@section('content')

<div class="min-h-screen flex">
    <!-- Left: Image Section -->
    <div class="hidden lg:flex lg:w-1/2 relative bg-[#4A0404]">
        <img class="absolute inset-0 h-full w-full object-cover opacity-60 mix-blend-overlay" src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Premium Ruko Office">
        <div class="absolute inset-0 bg-gradient-to-t from-[#4A0404] via-transparent to-transparent"></div>
        <div class="relative z-10 flex flex-col justify-end p-16 text-white h-full w-full">
            <h2 class="text-4xl font-bold mb-4 tracking-tight">Ruang Bisnis Impian Anda<br>Dimulai dari Sini.</h2>
            <p class="text-lg text-gray-300 max-w-md">Bergabung dengan ribuan pengusaha sukses lainnya yang telah menemukan ruko strategis bersama Se-Ru.</p>
        </div>
    </div>

    <!-- Right: Form Section -->
    <div class="w-full lg:w-1/2 flex flex-col items-center justify-center bg-[#Fdfcf0] px-8 sm:px-16 lg:px-24 relative">
        <!-- Back Button -->
        <a href="/" class="absolute top-8 left-8 sm:left-12 flex items-center text-gray-500 hover:text-[#4A0404] transition font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Beranda
        </a>

        <div class="max-w-md w-full mt-12 lg:mt-0">
            <div class="mb-10">
                <h2 class="text-3xl font-extrabold text-[#4A0404] mb-2">Selamat Datang Kembali</h2>
                <p class="text-gray-600">Silakan masukkan kredensial Anda untuk melanjutkan ke dashboard.</p>
            </div>

            <form class="space-y-6" action="/login" method="POST">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email</label>
                    <input id="email" name="email" value="{{ old('email') }}" type="email" required autofocus class="appearance-none block w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0404] focus:border-transparent transition duration-200" placeholder="nama@email.com">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Kata Sandi</label>
                    <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4A0404] focus:border-transparent transition duration-200" placeholder="••••••••">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-[#4A0404] focus:ring-[#4A0404] border-gray-300 rounded cursor-pointer">
                        <label for="remember" class="ml-2 block text-sm text-gray-700 cursor-pointer">
                            Ingat saya
                        </label>
                    </div>
                    <div class="text-sm">
                        <a href="#" class="font-medium text-[#4A0404] hover:text-[#D2B48C] transition">Lupa sandi?</a>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-[#4A0404] hover:bg-opacity-90 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4A0404] transition duration-200">
                        Masuk Sekarang
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-sm text-gray-600">Belum punya akun? <a href="{{ route('register') }}" class="font-bold text-[#D2B48C] hover:text-[#4A0404] transition">Daftar secara gratis</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
