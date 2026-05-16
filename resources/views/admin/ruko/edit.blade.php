@extends('layouts.admin')

@section('page-title', 'Edit Ruko')
@section('page-subtitle', 'Perbarui informasi properti: ' . $ruko->name)

@section('content')
<div class="max-w-2xl">
    <div class="mb-6">
        <a href="{{ route('admin.ruko.index') }}" class="flex items-center gap-2 text-sm text-gray-500 hover:text-[#4A0404] transition font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Ruko
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-[#4A0404] px-6 py-4">
            <h2 class="text-lg font-bold text-white">Form Edit Ruko</h2>
        </div>
        <form action="{{ route('admin.ruko.update', $ruko->ruko_id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Ruko *</label>
                <input type="text" name="name" value="{{ old('name', $ruko->name) }}" required class="block w-full rounded-lg border border-gray-200 px-4 py-3 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat Lengkap *</label>
                <textarea name="address" rows="3" required class="block w-full rounded-lg border border-gray-200 px-4 py-3 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] outline-none resize-none">{{ old('address', $ruko->address) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Harga / Bulan (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', $ruko->price) }}" required min="0" class="block w-full rounded-lg border border-gray-200 px-4 py-3 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] outline-none">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status *</label>
                    <select name="status" class="block w-full rounded-lg border border-gray-200 px-4 py-3 text-sm focus:border-[#4A0404] focus:ring-1 focus:ring-[#4A0404] outline-none bg-white">
                        <option value="available" {{ $ruko->status === 'available' ? 'selected' : '' }}>Tersedia</option>
                        <option value="rented" {{ $ruko->status === 'rented' ? 'selected' : '' }}>Disewa</option>
                        <option value="booked" {{ $ruko->status === 'booked' ? 'selected' : '' }}>Dipesan</option>
                    </select>
                </div>
            </div>

            <!-- Current Photos -->
            @if($ruko->photos && count($ruko->photos) > 0)
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Saat Ini</label>
                <div class="grid grid-cols-4 gap-2">
                    @foreach($ruko->photos as $photo)
                    <div class="aspect-square rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ Str::startsWith($photo, 'http') ? $photo : Storage::url($photo) }}" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Tambah Foto Baru</label>
                <input type="file" name="photos[]" multiple accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[#4A0404]/10 file:text-[#4A0404] hover:file:bg-[#4A0404]/20">
                <p class="text-xs text-gray-400 mt-1">Foto baru akan ditambahkan ke koleksi yang sudah ada.</p>
            </div>

            <div class="flex justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.ruko.index') }}" class="px-5 py-2.5 rounded-lg border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-50 transition">Batal</a>
                <button type="submit" class="px-5 py-2.5 rounded-lg bg-[#4A0404] text-white text-sm font-semibold hover:bg-opacity-90 transition shadow-md">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
