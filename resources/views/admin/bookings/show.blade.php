@extends('layouts.admin')

@section('page-title', 'Detail Pengajuan')
@section('page-subtitle', 'Tinjau dokumen dan validasi pengajuan penyewaan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-2 text-sm text-gray-500 hover:text-[#4A0404] transition font-medium w-fit">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Kembali ke Daftar Pengajuan
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left: Detail Info -->
    <div class="lg:col-span-2 space-y-5">

        <!-- Status Banner -->
        <div class="rounded-2xl p-5 flex items-center gap-4 
            {{ $booking->status === 'pending' ? 'bg-yellow-50 border border-yellow-200' : '' }}
            {{ $booking->status === 'approved' ? 'bg-green-50 border border-green-200' : '' }}
            {{ $booking->status === 'rejected' ? 'bg-red-50 border border-red-200' : '' }}">
            <div class="w-12 h-12 rounded-full flex items-center justify-center
                {{ $booking->status === 'pending' ? 'bg-yellow-100' : '' }}
                {{ $booking->status === 'approved' ? 'bg-green-100' : '' }}
                {{ $booking->status === 'rejected' ? 'bg-red-100' : '' }}">
                @if($booking->status === 'pending')
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @elseif($booking->status === 'approved')
                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                @else
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                @endif
            </div>
            <div>
                <p class="font-bold text-gray-900">Status: 
                    <span class="{{ $booking->status === 'pending' ? 'text-yellow-700' : ($booking->status === 'approved' ? 'text-green-700' : 'text-red-700') }}">
                        {{ $booking->status === 'pending' ? 'Menunggu Validasi Admin' : ($booking->status === 'approved' ? 'Pengajuan Disetujui' : 'Pengajuan Ditolak') }}
                    </span>
                </p>
                <p class="text-sm text-gray-500">Diajukan pada {{ $booking->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
        </div>

        <!-- Booking Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Rincian Pengajuan</h3>
            </div>
            <div class="p-6 grid grid-cols-2 gap-x-8 gap-y-4">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Ruko yang Dipesan</p>
                    <p class="font-semibold text-gray-900">{{ $booking->ruko->name ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500 mt-0.5">{{ $booking->ruko->address ?? '' }}</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Harga Sewa</p>
                    <p class="font-semibold text-gray-900">Rp {{ number_format($booking->ruko->price ?? 0, 0, ',', '.') }} / bulan</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Durasi Sewa</p>
                    <p class="font-semibold text-gray-900">{{ $booking->duration_months }} Bulan</p>
                </div>
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Total Nilai Kontrak</p>
                    <p class="font-bold text-[#4A0404] text-lg">Rp {{ number_format(($booking->ruko->price ?? 0) * $booking->duration_months, 0, ',', '.') }}</p>
                </div>
                <div class="col-span-2">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Rencana Penggunaan</p>
                    <p class="text-gray-700 bg-gray-50 rounded-lg p-3 text-sm">{{ $booking->usage_plan }}</p>
                </div>
            </div>
        </div>

        <!-- Documents -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-900">Dokumen Verifikasi</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- KTP -->
                <div class="border border-gray-200 rounded-xl overflow-hidden group">
                    <div class="bg-gray-50 px-4 py-2 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                            <span class="text-sm font-semibold text-gray-700">KTP Pemesan</span>
                        </div>
                        <a href="{{ Str::startsWith($booking->ktp_proof, 'http') ? $booking->ktp_proof : Storage::url($booking->ktp_proof) }}" target="_blank" class="text-xs text-blue-600 hover:underline font-semibold">Buka ↗</a>
                    </div>
                    <div class="p-3 bg-white">
                        @php $ktpUrl = Str::startsWith($booking->ktp_proof, 'http') ? $booking->ktp_proof : Storage::url($booking->ktp_proof); @endphp
                        @if(Str::endsWith(strtolower($booking->ktp_proof), ['.jpg', '.jpeg', '.png', '.webp']))
                            <img src="{{ $ktpUrl }}" class="w-full h-40 object-contain rounded-lg bg-gray-100" alt="KTP">
                        @else
                            <div class="w-full h-40 bg-blue-50 rounded-lg flex flex-col items-center justify-center text-blue-400">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-semibold">File PDF</span>
                                <a href="{{ $ktpUrl }}" target="_blank" class="text-xs text-blue-600 hover:underline mt-1">Klik untuk membuka</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Transfer Proof -->
                <div class="border border-gray-200 rounded-xl overflow-hidden group">
                    <div class="bg-gray-50 px-4 py-2 border-b border-gray-200 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                            <span class="text-sm font-semibold text-gray-700">Bukti Transfer</span>
                        </div>
                        <a href="{{ Str::startsWith($booking->transfer_proof, 'http') ? $booking->transfer_proof : Storage::url($booking->transfer_proof) }}" target="_blank" class="text-xs text-green-600 hover:underline font-semibold">Buka ↗</a>
                    </div>
                    <div class="p-3 bg-white">
                        @php $transferUrl = Str::startsWith($booking->transfer_proof, 'http') ? $booking->transfer_proof : Storage::url($booking->transfer_proof); @endphp
                        @if(Str::endsWith(strtolower($booking->transfer_proof), ['.jpg', '.jpeg', '.png', '.webp']))
                            <img src="{{ $transferUrl }}" class="w-full h-40 object-contain rounded-lg bg-gray-100" alt="Bukti Transfer">
                        @else
                            <div class="w-full h-40 bg-green-50 rounded-lg flex flex-col items-center justify-center text-green-400">
                                <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span class="text-sm font-semibold">File PDF</span>
                                <a href="{{ $transferUrl }}" target="_blank" class="text-xs text-green-600 hover:underline mt-1">Klik untuk membuka</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Pemesan & Actions -->
    <div class="space-y-5">
        <!-- Pemesan Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-4">Info Pemesan</h3>
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-[#4A0404]/10 rounded-full flex items-center justify-center text-[#4A0404] font-bold text-lg flex-shrink-0">
                    {{ strtoupper(substr($booking->user->name ?? '?', 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-gray-900">{{ $booking->user->name ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500">{{ $booking->user->email ?? '' }}</p>
                </div>
            </div>
            <div class="space-y-2 text-sm text-gray-600">
                <div class="flex items-center justify-between py-2 border-t border-gray-50">
                    <span class="text-gray-400">Bergabung</span>
                    <span class="font-medium">{{ $booking->user->created_at->format('d M Y') ?? '-' }}</span>
                </div>
            </div>
        </div>

        <!-- Action Card -->
        @if($booking->status === 'pending')
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-900 mb-2">Validasi Pengajuan</h3>
            <p class="text-sm text-gray-500 mb-5">Tinjau seluruh dokumen sebelum memberikan keputusan.</p>
            
            <form action="{{ route('admin.bookings.status', $booking->booking_id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="approved">
                <button type="submit" class="w-full mb-3 py-3 px-4 bg-green-600 text-white rounded-xl font-bold text-sm hover:bg-green-700 transition shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Setujui & Aktifkan Sewa
                </button>
            </form>
            
            <form action="{{ route('admin.bookings.status', $booking->booking_id) }}" method="POST">
                @csrf
                <input type="hidden" name="status" value="rejected">
                <button type="submit" class="w-full py-3 px-4 bg-white border-2 border-red-200 text-red-600 rounded-xl font-bold text-sm hover:bg-red-50 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Tolak Pengajuan
                </button>
            </form>
        </div>
        @else
        <div class="bg-gray-50 rounded-2xl border border-gray-200 p-6 text-center">
            <p class="text-sm text-gray-500">Pengajuan ini sudah diproses.</p>
        </div>
        @endif
    </div>
</div>
@endsection
