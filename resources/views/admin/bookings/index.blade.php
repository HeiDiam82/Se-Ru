@extends('layouts.admin')

@section('page-title', 'Pengajuan Sewa')
@section('page-subtitle', 'Tinjau dan validasi semua pengajuan penyewaan ruko')

@section('content')

<!-- Filter Tabs -->
<div class="flex gap-2 mb-6 flex-wrap">
    @php
        $statuses = ['all' => 'Semua', 'pending' => 'Menunggu', 'approved' => 'Disetujui', 'rejected' => 'Ditolak', 'terminated' => 'Dihentikan'];
        $current = request('status', 'all');
        $counts = [
            'all' => \App\Models\Booking::count(),
            'pending' => \App\Models\Booking::where('status','pending')->count(),
            'approved' => \App\Models\Booking::where('status','approved')->count(),
            'rejected' => \App\Models\Booking::where('status','rejected')->count(),
            'terminated' => \App\Models\Booking::where('status','terminated')->count(),
        ];
    @endphp
    @foreach($statuses as $key => $label)
    <a href="?status={{ $key }}" class="px-4 py-2 rounded-xl text-sm font-semibold transition flex items-center gap-2 
        {{ $current === $key ? 'bg-[#4A0404] text-white shadow-md' : 'bg-white text-gray-600 border border-gray-200 hover:border-[#4A0404] hover:text-[#4A0404]' }}">
        {{ $label }}
        <span class="text-xs px-1.5 py-0.5 rounded-full {{ $current === $key ? 'bg-white/20 text-white' : 'bg-gray-100 text-gray-500' }}">{{ $counts[$key] }}</span>
    </a>
    @endforeach
</div>

<!-- Bookings Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Pemesan</th>
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Ruko</th>
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Durasi</th>
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Diajukan</th>
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3.5 text-right font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($bookings as $booking)
            <tr class="hover:bg-gray-50/50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 bg-[#4A0404]/10 rounded-full flex items-center justify-center text-[#4A0404] font-bold text-sm flex-shrink-0">
                            {{ strtoupper(substr($booking->user->name ?? '?', 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $booking->user->name ?? 'N/A' }}</p>
                            <p class="text-xs text-gray-500">{{ $booking->user->email ?? '' }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="font-medium text-gray-900 max-w-xs truncate">{{ $booking->ruko->name ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-500">Rp {{ number_format(($booking->ruko->price ?? 0)/1000000, 1, ',', '.') }}Jt/bln</p>
                </td>
                <td class="px-6 py-4 text-gray-700 font-medium">{{ $booking->duration_months }} Bulan</td>
                <td class="px-6 py-4 text-gray-500">{{ $booking->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1.5 rounded-full
                        {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $booking->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                        {{ in_array($booking->status, ['rejected', 'terminated']) ? 'bg-red-100 text-red-700' : '' }}">
                        {{ $booking->status === 'pending' ? 'Menunggu' : ($booking->status === 'approved' ? 'Disetujui' : ($booking->status === 'terminated' ? 'Dihentikan' : 'Ditolak')) }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.bookings.show', $booking->booking_id) }}" class="px-3 py-1.5 bg-[#4A0404]/10 text-[#4A0404] rounded-lg text-xs font-semibold hover:bg-[#4A0404] hover:text-white transition">
                            Tinjau Detail
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-16 text-center text-gray-400">
                    <svg class="mx-auto w-12 h-12 mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Tidak ada pengajuan ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
