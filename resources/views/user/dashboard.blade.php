@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-[#4A0404] mb-8 border-b pb-4">Dashboard Saya - Riwayat Penyewaan</h1>

    @if($bookings->count() > 0)
        <div class="bg-white shadow overflow-hidden sm:rounded-md border border-gray-200">
            <ul class="divide-y divide-gray-200">
                @foreach($bookings as $booking)
                <li>
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <p class="text-lg font-bold text-[#4A0404] truncate">
                                {{ $booking->ruko->name }}
                            </p>
                            <div class="ml-2 flex-shrink-0 flex">
                                <p class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $booking->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ in_array($booking->status, ['rejected', 'terminated']) ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ strtoupper($booking->status === 'pending' ? 'Menunggu' : ($booking->status === 'approved' ? 'Disetujui' : ($booking->status === 'terminated' ? 'Dihentikan' : 'Ditolak'))) }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-2 sm:flex sm:justify-between">
                            <div class="sm:flex">
                                <p class="flex items-center text-sm text-gray-500">
                                    Durasi: {{ $booking->duration_months }} Bulan
                                </p>
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                <p>
                                    Diajukan pada <time datetime="{{ $booking->created_at }}">{{ $booking->created_at->format('d M Y') }}</time>
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg shadow border border-gray-200">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada pengajuan sewa</h3>
            <p class="mt-1 text-sm text-gray-500">Mulai cari ruko impian Anda sekarang.</p>
            <div class="mt-6">
                <a href="{{ route('katalog') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#4A0404] hover:bg-opacity-90">
                    Lihat Katalog Ruko
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
