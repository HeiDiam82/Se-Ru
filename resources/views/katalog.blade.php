@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="bg-[#4A0404] py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold text-white">Katalog Properti</h1>
        <p class="text-gray-300 mt-2">Jelajahi seluruh pilihan ruko dan properti komersial yang tersedia.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filter -->
        <aside class="w-full lg:w-1/4 flex-shrink-0">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 sticky top-4">
                <h2 class="text-lg font-bold text-[#4A0404] mb-5 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                    Filter Pencarian
                </h2>
                <form action="{{ route('katalog') }}" method="GET" class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Cari Lokasi / Nama</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="misal: Sudirman, Kemang..." class="mt-1 block w-full rounded-lg border border-gray-200 shadow-sm px-3 py-2 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Harga Min (Rp)</label>
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="0" class="mt-1 block w-full rounded-lg border border-gray-200 shadow-sm px-3 py-2 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] focus:outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-600 mb-1">Harga Max (Rp)</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Tidak terbatas" class="mt-1 block w-full rounded-lg border border-gray-200 shadow-sm px-3 py-2 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] focus:outline-none transition">
                    </div>
                    <button type="submit" class="w-full bg-[#4A0404] text-white px-4 py-2.5 rounded-lg hover:bg-opacity-90 transition font-semibold text-sm shadow-md">Terapkan Filter</button>
                    @if(request()->anyFilled(['search', 'min_price', 'max_price']))
                        <a href="{{ route('katalog') }}" class="block w-full text-center text-gray-500 hover:text-[#4A0404] text-sm transition">Reset Filter</a>
                    @endif
                </form>
            </div>
        </aside>

        <!-- Main Grid -->
        <div class="flex-1">
            <div class="flex items-center justify-between mb-6">
                <p class="text-gray-600 text-sm">Menampilkan <strong class="text-[#4A0404]">{{ $rukos->count() }}</strong> properti</p>
            </div>

            @if($rukos->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($rukos as $ruko)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden group transition hover:-translate-y-1 hover:shadow-xl duration-300">
                        <!-- Gambar + Status Badge -->
                        <div class="relative h-52 overflow-hidden">
                            @if($ruko->photos && count($ruko->photos) > 0)
                                <img src="{{ Str::startsWith($ruko->photos[0], 'http') ? $ruko->photos[0] : Storage::url($ruko->photos[0]) }}" alt="{{ $ruko->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            @else
                                <div class="w-full h-full bg-gray-200 flex flex-col items-center justify-center text-gray-400">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-sm mt-1">Tanpa Foto</span>
                                </div>
                            @endif
                            <!-- Status badge -->
                            <div class="absolute top-3 left-3">
                                @if($ruko->status === 'available')
                                    <span class="inline-flex items-center gap-1.5 bg-green-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span>
                                        Tersedia
                                    </span>
                                @elseif($ruko->status === 'rented')
                                    <span class="inline-flex items-center gap-1.5 bg-red-600 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">
                                        <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                                        Sedang Disewa
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 bg-yellow-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow">
                                        Dipesan
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5">
                            <h3 class="text-lg font-bold text-[#4A0404] mb-1 line-clamp-1">{{ $ruko->name }}</h3>
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2 flex items-start gap-1">
                                <svg class="w-4 h-4 flex-shrink-0 mt-0.5 text-[#D2B48C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $ruko->address }}
                            </p>
                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <p class="text-xs text-gray-400">Harga sewa</p>
                                    <p class="text-xl font-extrabold text-[#4A0404]">Rp {{ number_format($ruko->price / 1000000, 0, ',', '.') }} Jt <span class="text-sm font-medium text-gray-400">/ bln</span></p>
                                </div>
                                <a href="{{ route('ruko.show', $ruko->ruko_id) }}" class="bg-[#4A0404] text-white px-4 py-2 rounded-lg hover:bg-[#D2B48C] hover:text-[#4A0404] transition font-bold text-sm shadow-sm">Detail →</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-16 rounded-2xl shadow text-center border border-gray-100">
                    <svg class="mx-auto h-16 w-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Tidak Ada Hasil</h3>
                    <p class="text-gray-500">Maaf, tidak ada ruko yang sesuai dengan filter pencarian Anda. Coba ubah filter atau kata kunci pencarian.</p>
                    <a href="{{ route('katalog') }}" class="mt-6 inline-block bg-[#4A0404] text-white px-6 py-2 rounded-lg font-semibold hover:bg-opacity-90 transition">Reset Filter</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
