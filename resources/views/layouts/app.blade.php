<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Se-Ru') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#Fdfcf0] font-sans antialiased text-gray-900">
    <nav class="bg-[#4A0404] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold tracking-wider">SE-RU</a>
                    <div class="hidden md:flex space-x-8 ml-10">
                        <a href="{{ route('katalog') }}" class="hover:text-[#D2B48C] transition">Katalog Ruko</a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="hover:text-[#D2B48C] transition">Admin Dashboard</a>
                                <a href="{{ route('admin.ruko.index') }}" class="hover:text-[#D2B48C] transition">Kelola Ruko</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="hover:text-[#D2B48C] transition">Dashboard Saya</a>
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="/login" class="hover:text-[#D2B48C] transition">Masuk</a>
                        <a href="/register" class="bg-[#D2B48C] text-[#4A0404] px-4 py-2 rounded-md font-semibold hover:bg-white transition">Daftar</a>
                    @else
                        <span>Halo, {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-[#D2B48C] transition">Keluar</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-4 mt-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 mx-4 mt-4" role="alert">
                <ul class="list-disc ml-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="bg-[#4A0404] text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Se-Ru (Sewa Ruko). Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
