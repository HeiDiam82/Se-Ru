<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Se-Ru') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#Fdfcf0] font-sans antialiased text-gray-900" style="font-family: 'Inter', sans-serif;">
    @if(!request()->routeIs('login') && !request()->routeIs('register'))
    <nav class="bg-[#4A0404] text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold tracking-wider">SE-RU</a>
                    <div class="hidden md:flex space-x-8 ml-10">
                        <a href="{{ route('katalog') }}" class="hover:text-[#D2B48C] transition">Katalog Ruko</a>
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 bg-[#D2B48C] text-[#4A0404] px-3 py-1.5 rounded-lg text-sm font-bold hover:bg-white transition shadow-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    Admin Panel
                                </a>
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
    @endif

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

    @if(!request()->routeIs('login') && !request()->routeIs('register'))
    <footer class="bg-[#4A0404] text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Se-Ru (Sewa Ruko). Hak Cipta Dilindungi.</p>
        </div>
    </footer>
    @endif
</body>
</html>
