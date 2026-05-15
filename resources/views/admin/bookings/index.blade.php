@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8 border-b pb-4">
        <h1 class="text-3xl font-bold text-[#4A0404]">Validasi Pengajuan Sewa</h1>
        <p class="text-gray-600 mt-2">Kelola dan verifikasi pemesanan yang masuk.</p>
    </div>

    @if($bookings->count() > 0)
        <div class="bg-white shadow overflow-hidden sm:rounded-md border border-gray-200">
            <ul class="divide-y divide-gray-200">
                @foreach($bookings as $booking)
                <li class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-lg font-bold text-[#4A0404]">{{ $booking->ruko->name ?? 'Ruko Tidak Ditemukan' }}</p>
                            <p class="text-sm text-gray-500">Pemesan: {{ $booking->user->name ?? 'Unknown' }} ({{ $booking->user->email ?? '' }})</p>
                        </div>
                        <div>
                            <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full 
                                {{ $booking->status === 'approved' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $booking->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ strtoupper($booking->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 bg-gray-50 p-4 rounded border">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Durasi Sewa</p>
                            <p class="mt-1">{{ $booking->duration_months }} Bulan</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-500">Rencana Penggunaan</p>
                            <p class="mt-1">{{ $booking->usage_plan }}</p>
                        </div>
                    </div>

                    <div class="flex space-x-4 mb-6">
                        <a href="{{ Storage::url($booking->ktp_proof) }}" target="_blank" class="text-[#4A0404] underline hover:text-[#D2B48C] text-sm">Lihat KTP Pemesan</a>
                        <a href="{{ Storage::url($booking->transfer_proof) }}" target="_blank" class="text-[#4A0404] underline hover:text-[#D2B48C] text-sm">Lihat Bukti Transfer</a>
                    </div>

                    @if($booking->status === 'pending')
                    <div class="flex space-x-3 border-t pt-4">
                        <form action="{{ route('admin.bookings.status', $booking->booking_id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition" onclick="return confirm('Setujui pengajuan ini?');">Setujui (Approve)</button>
                        </form>
                        <form action="{{ route('admin.bookings.status', $booking->booking_id) }}" method="POST" class="inline">
                            @csrf
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition" onclick="return confirm('Tolak pengajuan ini?');">Tolak (Reject)</button>
                        </form>
                    </div>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="bg-white p-8 text-center rounded-lg shadow">
            <p class="text-gray-500">Belum ada pengajuan sewa masuk.</p>
        </div>
    @endif
</div>
@endsection
