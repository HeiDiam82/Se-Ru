@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="relative bg-[#Fdfcf0] overflow-hidden pt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16">
            <div class="md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left lg:flex lg:items-center py-16">
                <div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold text-[#D2B48C] bg-[#4A0404] mb-6">
                        Platform Penyewaan Ruko No.1
                    </span>
                    <h1 class="text-5xl tracking-tight font-extrabold text-[#4A0404] sm:text-6xl lg:text-7xl">
                        Ruang <span class="text-[#D2B48C]">Sempurna</span><br>Untuk Bisnis Anda.
                    </h1>
                    <p class="mt-5 text-lg text-gray-600">
                        Kami menyediakan ribuan pilihan properti komersial yang tersebar di lokasi paling strategis. Proses sewa cepat, aman, dan 100% transparan.
                    </p>
                    <div class="mt-8 sm:flex gap-4">
                        <a href="{{ route('katalog') }}" class="w-full flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-white bg-[#4A0404] hover:bg-opacity-90 md:w-auto shadow-xl transition transform hover:-translate-y-1">
                            Cari Ruko Sekarang
                        </a>
                        <a href="{{ route('register') }}" class="mt-3 w-full flex items-center justify-center px-8 py-4 border-2 border-[#4A0404] text-lg font-bold rounded-xl text-[#4A0404] bg-transparent hover:bg-gray-50 md:w-auto md:mt-0 shadow-sm transition">
                            Jadi Member Baru
                        </a>
                    </div>
                </div>
            </div>
            <div class="relative lg:col-span-6 flex items-center justify-center mt-12 lg:mt-0 pb-16">
                <div class="relative rounded-2xl shadow-2xl overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#4A0404]/80 to-transparent z-10 opacity-70 group-hover:opacity-50 transition duration-500"></div>
                    <img class="w-full h-auto object-cover transform group-hover:scale-105 transition duration-700" src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" alt="Modern Ruko Interior">
                    <div class="absolute bottom-6 left-6 z-20">
                        <p class="text-white font-bold text-xl drop-shadow-md">Ruko Sudirman CBD</p>
                        <p class="text-[#D2B48C] font-semibold drop-shadow-md">Tersedia untuk disewa</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Keunggulan Section -->
<div class="bg-[#4A0404] py-20 relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-[#D2B48C] rounded-full opacity-10 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-[#D2B48C] rounded-full opacity-10 blur-3xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-base font-semibold text-[#D2B48C] tracking-wide uppercase">Mengapa Se-Ru?</h2>
            <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-white sm:text-4xl">Keunggulan Ekosistem Kami</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl border border-white/20 hover:bg-white/20 transition duration-300">
                <div class="w-12 h-12 bg-[#D2B48C] rounded-lg flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-6 h-6 text-[#4A0404]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Transaksi Aman 100%</h3>
                <p class="text-gray-300">Semua transaksi diverifikasi dengan sistem keamanan ganda, memastikan perlindungan bagi penyewa dan pemilik.</p>
            </div>
            <div class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl border border-white/20 hover:bg-white/20 transition duration-300">
                <div class="w-12 h-12 bg-[#D2B48C] rounded-lg flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-6 h-6 text-[#4A0404]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Lokasi Emas</h3>
                <p class="text-gray-300">Kurasi khusus ruko di titik-titik pusat bisnis yang dilewati ribuan kendaraan dan pejalan kaki setiap harinya.</p>
            </div>
            <div class="bg-white/10 backdrop-blur-lg p-8 rounded-2xl border border-white/20 hover:bg-white/20 transition duration-300">
                <div class="w-12 h-12 bg-[#D2B48C] rounded-lg flex items-center justify-center mb-6 shadow-lg">
                    <svg class="w-6 h-6 text-[#4A0404]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-white mb-3">Proses Kilat</h3>
                <p class="text-gray-300">Sistem otomasi dokumen kami memungkinkan Anda menyelesaikan perjanjian sewa dan pembayaran dalam hitungan jam.</p>
            </div>
        </div>
    </div>
</div>

<!-- Featured Ruko Section -->
<div class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-[#4A0404]">Properti Premium Pilihan</h2>
                <p class="mt-2 text-lg text-gray-500">Rekomendasi ruko terbaik yang saat ini tersedia.</p>
            </div>
            <a href="{{ route('katalog') }}" class="hidden sm:inline-flex items-center text-[#D2B48C] font-bold hover:text-[#4A0404] transition">
                Lihat Semua <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(isset($featuredRukos) && $featuredRukos->count() > 0)
                @foreach($featuredRukos as $ruko)
                <div class="bg-[#Fdfcf0] rounded-2xl shadow-lg border border-gray-100 overflow-hidden transform hover:-translate-y-2 hover:shadow-xl transition duration-300">
                    <div class="relative h-64">
                        @if($ruko->photos && count($ruko->photos) > 0)
                            <img src="{{ Str::startsWith($ruko->photos[0], 'http') ? $ruko->photos[0] : Storage::url($ruko->photos[0]) }}" alt="{{ $ruko->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-500"><svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></div>
                        @endif
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur text-[#4A0404] text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Premium</div>
                        <div class="absolute bottom-4 right-4 bg-[#4A0404] text-white text-sm font-bold px-4 py-2 rounded-lg shadow-md">
                            Rp {{ number_format($ruko->price / 1000000, 0, ',', '.') }} Juta <span class="text-xs font-normal">/ bln</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-[#4A0404] mb-2 truncate">{{ $ruko->name }}</h3>
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $ruko->address }}</p>
                        <a href="{{ route('ruko.show', $ruko->ruko_id) }}" class="block w-full text-center bg-[#D2B48C] text-[#4A0404] font-bold px-4 py-3 rounded-lg hover:bg-[#4A0404] hover:text-white transition duration-300">Lihat Detail Lengkap</a>
                    </div>
                </div>
                @endforeach
            @else
                <!-- Dummy Placeholders if DB empty -->
                @for($i=0; $i<3; $i++)
                <div class="bg-[#Fdfcf0] rounded-2xl shadow border border-gray-100 overflow-hidden">
                    <div class="w-full h-64 bg-gray-200 animate-pulse"></div>
                    <div class="p-6 space-y-4">
                        <div class="h-6 bg-gray-200 rounded w-3/4 animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded w-full animate-pulse"></div>
                        <div class="h-4 bg-gray-200 rounded w-5/6 animate-pulse"></div>
                        <div class="h-10 bg-gray-300 rounded w-full animate-pulse mt-4"></div>
                    </div>
                </div>
                @endfor
            @endif
        </div>
        
        <div class="mt-8 sm:hidden">
            <a href="{{ route('katalog') }}" class="block w-full text-center bg-gray-100 text-[#4A0404] font-bold px-4 py-3 rounded-lg">Lihat Semua Ruko</a>
        </div>
    </div>
</div>

<!-- How it Works Section -->
<div class="py-20 bg-[#Fdfcf0] border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl leading-8 font-extrabold tracking-tight text-[#4A0404] sm:text-4xl">Sewa Ruko Dalam 3 Langkah Mudah</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-12 text-center relative">
            <div class="hidden md:block absolute top-12 left-1/6 right-1/6 h-0.5 bg-gray-300 z-0"></div>
            
            <div class="relative z-10">
                <div class="w-24 h-24 mx-auto bg-white border-4 border-[#4A0404] text-[#4A0404] rounded-full flex items-center justify-center text-4xl font-extrabold mb-6 shadow-lg">1</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Pilih Ruko</h3>
                <p class="text-gray-600 leading-relaxed">Jelajahi katalog eksklusif kami dan temukan properti di lokasi paling potensial untuk *traffic* bisnis Anda.</p>
            </div>
            <div class="relative z-10">
                <div class="w-24 h-24 mx-auto bg-[#4A0404] text-[#D2B48C] rounded-full flex items-center justify-center text-4xl font-extrabold mb-6 shadow-lg ring-8 ring-[#4A0404]/20">2</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Isi Formulir</h3>
                <p class="text-gray-600 leading-relaxed">Lengkapi durasi, jenis usaha, serta unggah dokumen legalitas (KTP) dan bukti transfer langsung di platform kami.</p>
            </div>
            <div class="relative z-10">
                <div class="w-24 h-24 mx-auto bg-white border-4 border-[#D2B48C] text-[#D2B48C] rounded-full flex items-center justify-center text-4xl font-extrabold mb-6 shadow-lg">3</div>
                <h3 class="text-2xl font-bold text-gray-900 mb-3">Mulai Berbisnis</h3>
                <p class="text-gray-600 leading-relaxed">Admin akan memvalidasi pengajuan Anda dalam < 24 jam. Kunci ruko diserahkan, dan Anda siap berbisnis!</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-[#4A0404] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 lg:flex lg:items-center lg:justify-between">
        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
            <span class="block">Siap untuk berekspansi?</span>
            <span class="block text-[#D2B48C]">Bergabunglah bersama kami hari ini.</span>
        </h2>
        <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
            <div class="inline-flex rounded-md shadow">
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-lg text-[#4A0404] bg-[#D2B48C] hover:bg-white transition duration-300">
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
