@extends('layouts.admin')

@section('page-title', 'Kelola Ruko')
@section('page-subtitle', 'Inventaris seluruh properti yang terdaftar di Se-Ru')

@section('content')

<!-- Header Actions -->
<div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6">
    <div class="flex gap-3 flex-wrap">
        <div class="bg-white rounded-xl border border-gray-200 px-4 py-2 text-sm flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
            <span class="font-semibold text-gray-700">{{ \App\Models\Ruko::where('status','available')->count() }}</span>
            <span class="text-gray-500">Tersedia</span>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 px-4 py-2 text-sm flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-red-500"></span>
            <span class="font-semibold text-gray-700">{{ \App\Models\Ruko::where('status','rented')->count() }}</span>
            <span class="text-gray-500">Disewa</span>
        </div>
    </div>
    <div class="sm:ml-auto">
        <button onclick="document.getElementById('addRukoModal').classList.remove('hidden')" class="flex items-center gap-2 bg-[#4A0404] text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:bg-opacity-90 transition shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Ruko
        </button>
    </div>
</div>

<!-- Ruko Table -->
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <table class="min-w-full text-sm">
        <thead>
            <tr class="bg-gray-50 border-b border-gray-200">
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Properti</th>
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Harga / Bulan</th>
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Status</th>
                <th class="px-6 py-3.5 text-left font-semibold text-gray-600">Terdaftar</th>
                <th class="px-6 py-3.5 text-right font-semibold text-gray-600">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($rukos as $ruko)
            <tr class="hover:bg-gray-50/50 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-14 h-12 rounded-lg overflow-hidden flex-shrink-0 bg-gray-100">
                            @if($ruko->photos && count($ruko->photos) > 0)
                                <img src="{{ Str::startsWith($ruko->photos[0], 'http') ? $ruko->photos[0] : Storage::url($ruko->photos[0]) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <p class="font-semibold text-gray-900 truncate max-w-xs">{{ $ruko->name }}</p>
                            <p class="text-xs text-gray-400 truncate max-w-xs">{{ $ruko->address }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4">
                    <p class="font-bold text-gray-900">Rp {{ number_format($ruko->price/1000000, 1, ',', '.') }}Jt</p>
                </td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center gap-1.5 text-xs font-bold px-2.5 py-1.5 rounded-full
                        {{ $ruko->status === 'available' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $ruko->status === 'rented' ? 'bg-red-100 text-red-700' : '' }}
                        {{ $ruko->status === 'booked' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                        <span class="w-1.5 h-1.5 rounded-full
                            {{ $ruko->status === 'available' ? 'bg-green-500' : '' }}
                            {{ $ruko->status === 'rented' ? 'bg-red-500' : '' }}
                            {{ $ruko->status === 'booked' ? 'bg-yellow-500' : '' }}">
                        </span>
                        {{ $ruko->status === 'available' ? 'Tersedia' : ($ruko->status === 'rented' ? 'Disewa' : 'Dipesan') }}
                    </span>
                </td>
                <td class="px-6 py-4 text-gray-500 text-sm">{{ $ruko->created_at->format('d M Y') }}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('ruko.show', $ruko->ruko_id) }}" target="_blank" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Publik">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                        <a href="{{ route('admin.ruko.edit', $ruko->ruko_id) }}" class="p-2 text-gray-400 hover:text-[#4A0404] hover:bg-[#4A0404]/10 rounded-lg transition" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </a>
                        <form action="{{ route('admin.ruko.destroy', $ruko->ruko_id) }}" method="POST" onsubmit="return confirm('Hapus ruko ini secara permanen?')">
                            @csrf
                            <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center text-gray-400">
                    <svg class="mx-auto w-12 h-12 mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Belum ada ruko terdaftar.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Add Ruko Modal -->
<div id="addRukoModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div class="bg-white rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden">
        <div class="bg-[#4A0404] px-6 py-4 flex items-center justify-between">
            <h2 class="text-lg font-bold text-white">Tambah Ruko Baru</h2>
            <button onclick="document.getElementById('addRukoModal').classList.add('hidden')" class="text-white/70 hover:text-white"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
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
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Properti</label>
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
