@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filter -->
        <aside class="w-full md:w-1/4 bg-white p-6 rounded-lg shadow-md border border-[#D2B48C]">
            <h2 class="text-xl font-bold text-[#4A0404] mb-4 border-b pb-2">Filter Pencarian</h2>
            <form action="{{ route('katalog') }}" method="GET">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Cari Lokasi/Nama</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#4A0404] focus:ring focus:ring-[#4A0404] focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Harga Minimum</label>
                    <input type="number" name="min_price" value="{{ request('min_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#4A0404] focus:ring focus:ring-[#4A0404] focus:ring-opacity-50">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Harga Maksimum</label>
                    <input type="number" name="max_price" value="{{ request('max_price') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#4A0404] focus:ring focus:ring-[#4A0404] focus:ring-opacity-50">
                </div>
                <button type="submit" class="w-full bg-[#4A0404] text-white px-4 py-2 rounded-md hover:bg-opacity-90 transition font-medium">Terapkan Filter</button>
            </form>
        </aside>

        <!-- Ruko Grid -->
        <div class="w-full md:w-3/4">
            <h2 class="text-3xl font-bold text-[#4A0404] mb-6">Katalog Ruko</h2>
            
            @if($rukos->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($rukos as $ruko)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-100 transition transform hover:-translate-y-1 hover:shadow-xl">
                        @if($ruko->photos && count($ruko->photos) > 0)
                            <img src="{{ Str::startsWith($ruko->photos[0], 'http') ? $ruko->photos[0] : Storage::url($ruko->photos[0]) }}" alt="{{ $ruko->name }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">Tanpa Foto</div>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-[#4A0404] mb-2">{{ $ruko->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $ruko->address }}</p>
                            <p class="text-lg font-bold text-[#D2B48C] mb-4">Rp {{ number_format($ruko->price, 0, ',', '.') }} / bulan</p>
                            <a href="{{ route('ruko.show', $ruko->ruko_id) }}" class="block w-full text-center bg-[#4A0404] text-white px-4 py-2 rounded hover:bg-opacity-90 transition">Lihat Detail</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white p-8 rounded-lg shadow text-center">
                    <p class="text-gray-500 text-lg">Maaf, tidak ada ruko yang sesuai dengan pencarian Anda.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
