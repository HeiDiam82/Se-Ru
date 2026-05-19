@extends('layouts.admin')

@section('page-title', 'Overview Dashboard')
@section('page-subtitle', 'Ringkasan kondisi platform Se-Ru hari ini')

@section('content')

<!-- Stats Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-gray-900">{{ $stats['total_ruko'] }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Total Ruko</p>
            <p class="text-xs text-green-600 font-semibold mt-1">{{ $stats['available_ruko'] }} tersedia</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-gray-900">{{ $stats['pending_bookings'] }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Menunggu Validasi</p>
            <p class="text-xs text-yellow-600 font-semibold mt-1">Perlu ditindaklanjuti</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-gray-900">{{ $stats['approved_bookings'] }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Booking Disetujui</p>
            <p class="text-xs text-gray-400 font-semibold mt-1">{{ $stats['rejected_bookings'] }} ditolak</p>
        </div>
    </div>
    <div class="bg-white rounded-2xl p-5 shadow-sm border border-gray-100 flex items-start gap-4">
        <div class="w-12 h-12 bg-purple-50 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
        </div>
        <div>
            <p class="text-2xl font-extrabold text-gray-900">{{ $stats['total_users'] }}</p>
            <p class="text-sm text-gray-500 mt-0.5">Total Penyewa</p>
            <p class="text-xs text-gray-400 font-semibold mt-1">Pengguna terdaftar</p>
        </div>
    </div>
</div>

<!-- Revenue & Status Breakdown -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Revenue Card -->
    <div class="lg:col-span-1 bg-[#4A0404] rounded-2xl p-6 text-white shadow-md">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-semibold text-gray-300 uppercase tracking-wide">Total Nilai Kontrak</p>
            <svg class="w-6 h-6 text-[#D2B48C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
        <p class="text-3xl font-extrabold text-white">Rp {{ number_format($stats['monthly_revenue'] / 1000000, 1, ',', '.') }}Jt</p>
        <p class="text-sm text-gray-400 mt-2">Dari {{ $stats['approved_bookings'] }} booking disetujui</p>
        <div class="mt-4 pt-4 border-t border-white/10 grid grid-cols-3 gap-3 text-center">
            <div>
                <p class="text-xl font-bold text-white">{{ $stats['available_ruko'] }}</p>
                <p class="text-xs text-gray-400">Tersedia</p>
            </div>
            <div>
                <p class="text-xl font-bold text-white">{{ $stats['rented_ruko'] }}</p>
                <p class="text-xs text-gray-400">Disewa</p>
            </div>
            <div>
                <p class="text-xl font-bold text-white">{{ $stats['total_ruko'] - $stats['available_ruko'] - $stats['rented_ruko'] }}</p>
                <p class="text-xs text-gray-400">Lainnya</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
        <h3 class="text-base font-bold text-gray-900 mb-4">Tindakan Cepat</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <button onclick="document.getElementById('addRukoModal').classList.remove('hidden')" class="flex items-center gap-3 p-4 rounded-xl border-2 border-dashed border-[#D2B48C] hover:bg-[#4A0404] hover:text-white hover:border-[#4A0404] transition group cursor-pointer">
                <div class="w-10 h-10 bg-[#4A0404]/10 group-hover:bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-[#4A0404] group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <div class="text-left">
                    <p class="font-semibold text-sm">Tambah Ruko Baru</p>
                    <p class="text-xs text-gray-400 group-hover:text-white/70">Daftarkan properti baru</p>
                </div>
            </button>
            <a href="{{ route('admin.bookings.index') }}" class="flex items-center gap-3 p-4 rounded-xl border-2 border-dashed border-gray-200 hover:bg-[#4A0404] hover:text-white hover:border-[#4A0404] transition group cursor-pointer">
                <div class="w-10 h-10 bg-yellow-50 group-hover:bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-yellow-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                </div>
                <div class="text-left">
                    <p class="font-semibold text-sm">Validasi Booking</p>
                    <p class="text-xs text-gray-400 group-hover:text-white/70">{{ $stats['pending_bookings'] }} menunggu tinjau</p>
                </div>
            </a>
            <a href="{{ route('admin.ruko.index') }}" class="flex items-center gap-3 p-4 rounded-xl border-2 border-dashed border-gray-200 hover:bg-[#4A0404] hover:text-white hover:border-[#4A0404] transition group cursor-pointer">
                <div class="w-10 h-10 bg-blue-50 group-hover:bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                </div>
                <div class="text-left">
                    <p class="font-semibold text-sm">Kelola Inventaris</p>
                    <p class="text-xs text-gray-400 group-hover:text-white/70">{{ $stats['total_ruko'] }} properti terdaftar</p>
                </div>
            </a>
            <a href="{{ url('/') }}" class="flex items-center gap-3 p-4 rounded-xl border-2 border-dashed border-gray-200 hover:bg-[#4A0404] hover:text-white hover:border-[#4A0404] transition group cursor-pointer">
                <div class="w-10 h-10 bg-green-50 group-hover:bg-white/20 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-green-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                </div>
                <div class="text-left">
                    <p class="font-semibold text-sm">Pratinjau Website</p>
                    <p class="text-xs text-gray-400 group-hover:text-white/70">Tampilan publik</p>
                </div>
            </a>
        </div>
    </div>
</div>

<!-- Recent Activity Tables -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Bookings -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-base font-bold text-gray-900">Pengajuan Terbaru</h3>
            <a href="{{ route('admin.bookings.index') }}" class="text-sm text-[#4A0404] font-semibold hover:underline">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentBookings as $booking)
            <a href="{{ route('admin.bookings.show', $booking->booking_id) }}" class="flex items-center gap-4 px-6 py-3 hover:bg-gray-50 transition">
                <div class="w-9 h-9 bg-[#4A0404]/10 rounded-full flex items-center justify-center text-[#4A0404] font-bold text-sm flex-shrink-0">
                    {{ strtoupper(substr($booking->user->name ?? '?', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $booking->ruko->name ?? 'N/A' }}</p>
                    <p class="text-xs text-gray-500 truncate">oleh {{ $booking->user->name ?? 'N/A' }}</p>
                </div>
                <span class="text-xs font-bold px-2 py-1 rounded-full flex-shrink-0
                    {{ $booking->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                    {{ $booking->status === 'approved' ? 'bg-green-100 text-green-700' : '' }}
                    {{ in_array($booking->status, ['rejected', 'terminated']) ? 'bg-red-100 text-red-700' : '' }}">
                    {{ strtoupper($booking->status === 'pending' ? 'Menunggu' : ($booking->status === 'approved' ? 'Disetujui' : ($booking->status === 'terminated' ? 'Dihentikan' : 'Ditolak'))) }}
                </span>
            </a>
            @empty
            <div class="px-6 py-8 text-center text-gray-400 text-sm">Belum ada pengajuan masuk.</div>
            @endforelse
        </div>
    </div>

    <!-- Recent Rukos -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-base font-bold text-gray-900">Ruko Terbaru</h3>
            <a href="{{ route('admin.ruko.index') }}" class="text-sm text-[#4A0404] font-semibold hover:underline">Kelola →</a>
        </div>
        <div class="divide-y divide-gray-50">
            @forelse($recentRukos as $ruko)
            <div class="flex items-center gap-4 px-6 py-3">
                <div class="w-12 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                    @if($ruko->photos && count($ruko->photos) > 0)
                        <img src="{{ Str::startsWith($ruko->photos[0], 'http') ? $ruko->photos[0] : Storage::url($ruko->photos[0]) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01"></path></svg></div>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-gray-900 truncate">{{ $ruko->name }}</p>
                    <p class="text-xs text-gray-500">Rp {{ number_format($ruko->price/1000000, 1, ',', '.') }}Jt/bln</p>
                </div>
                <span class="text-xs font-bold px-2 py-1 rounded-full flex-shrink-0
                    {{ $ruko->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $ruko->status === 'available' ? 'TERSEDIA' : 'DISEWA' }}
                </span>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-gray-400 text-sm">Belum ada ruko terdaftar.</div>
            @endforelse
        </div>
    </div>
</div>

<!-- Add Ruko Modal -->
<div id="addRukoModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden">
        <div class="bg-[#4A0404] px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-bold text-white">Tambah Ruko Baru</h2>
            <button onclick="document.getElementById('addRukoModal').classList.add('hidden')" class="text-white/70 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="{{ route('admin.ruko.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Ruko *</label>
                    <input type="text" name="name" required class="block w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap *</label>
                    <textarea name="address" rows="2" required class="block w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] outline-none resize-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Harga Sewa/Bulan (Rp) *</label>
                    <input type="number" name="price" required min="0" class="block w-full rounded-lg border border-gray-200 px-3 py-2.5 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Properti (Bisa multi)</label>
                    <input type="file" name="photos[]" multiple accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#4A0404]/10 file:text-[#4A0404] hover:file:bg-[#4A0404]/20">
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('addRukoModal').classList.add('hidden')" class="px-5 py-2.5 rounded-lg border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#4A0404] text-white text-sm font-semibold hover:bg-opacity-90 transition shadow-md">Simpan Ruko</button>
            </div>
        </form>
    </div>
</div>

@endsection
