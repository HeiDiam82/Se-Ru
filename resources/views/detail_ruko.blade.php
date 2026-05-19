@extends('layouts.app')

@section('content')

<!-- Include Alpine.js for Multi-step Form -->

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-xl shadow-xl overflow-hidden flex flex-col lg:flex-row">
        <!-- Gallery & Details -->
        <div class="w-full lg:w-1/2 p-8 bg-gray-50 border-r">
            <h1 class="text-3xl font-extrabold text-[#4A0404] mb-2">{{ $ruko->name }}</h1>
            <p class="text-gray-600 mb-6 flex items-start">
                <svg class="w-5 h-5 mr-2 text-[#D2B48C] mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                {{ $ruko->address }}
            </p>
            
            <div class="mb-8">
                @if($ruko->photos && count($ruko->photos) > 0)
                    <img src="{{ Str::startsWith($ruko->photos[0], 'http') ? $ruko->photos[0] : Storage::url($ruko->photos[0]) }}" alt="{{ $ruko->name }}" class="w-full h-80 object-cover rounded-lg shadow-md mb-4">
                    <div class="grid grid-cols-4 gap-2">
                        @foreach($ruko->photos as $index => $photo)
                            @if($index > 0)
                                <img src="{{ Str::startsWith($photo, 'http') ? $photo : Storage::url($photo) }}" alt="Gallery" class="w-full h-20 object-cover rounded cursor-pointer hover:opacity-75 transition">
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="w-full h-80 bg-gray-50 rounded-lg flex flex-col items-center justify-center text-gray-400 border-2 border-dashed border-gray-300 shadow-sm mb-4">
                        <svg class="w-16 h-16 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-lg font-medium">Tidak ada foto tersedia</span>
                    </div>
                @endif
            </div>

            <div class="bg-[#4A0404] text-white p-6 rounded-lg">
                <h3 class="text-lg font-semibold text-[#D2B48C] mb-1">Harga Sewa</h3>
                <p class="text-3xl font-bold">Rp {{ number_format($ruko->price, 0, ',', '.') }} <span class="text-sm font-normal text-gray-300">/ bulan</span></p>
                <div class="mt-4 pt-4 border-t border-gray-600">
                    <p class="text-sm">Status: <span class="font-bold uppercase {{ $ruko->status == 'available' ? 'text-green-400' : 'text-yellow-400' }}">{{ $ruko->status }}</span></p>
                </div>
            </div>
        </div>

        <!-- Booking Form (Alpine JS Multi-step) -->
        <div class="w-full lg:w-1/2 p-8"
             x-data="{
                step: {{ $errors->has('usage_plan') || $errors->has('duration_months') ? 1 : ($errors->has('ktp_proof') ? 2 : ($errors->any() ? 3 : 1)) }}
             }">
            <h2 class="text-2xl font-bold text-[#4A0404] mb-6">Formulir Penyewaan</h2>

            @if($ruko->status !== 'available')
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                    <p>Maaf, ruko ini sedang tidak tersedia untuk disewa saat ini.</p>
                </div>
            @else
                @auth
                    <!-- Progress Bar -->
                    <div class="mb-8 relative">
                        <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-gray-200">
                            <div :style="'width: ' + ((step/3)*100) + '%'" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-[#D2B48C] transition-all duration-300"></div>
                        </div>
                        <div class="flex justify-between text-xs font-semibold text-gray-500">
                            <span :class="{'text-[#4A0404]': step >= 1}">1. Data Sewa</span>
                            <span :class="{'text-[#4A0404]': step >= 2}">2. Identitas (KTP)</span>
                            <span :class="{'text-[#4A0404]': step >= 3}">3. Bukti Transfer</span>
                        </div>
                    </div>

                    <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data"
                          @submit.prevent="
                            if (step === 1) { step = 2; return; }
                            if (step === 2) { step = 3; return; }
                            $el.submit();
                          ">
                        @csrf
                        <input type="hidden" name="ruko_id" value="{{ $ruko->ruko_id }}">

                        <!-- Step 1 -->
                        <div x-show="step === 1" x-transition>
                            <h3 class="text-lg font-bold mb-4">Langkah 1: Detail Rencana Sewa</h3>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Durasi Sewa (Bulan)</label>
                                <input type="number" id="duration_months" name="duration_months" min="1"
                                       value="{{ old('duration_months', 1) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#4A0404] focus:ring focus:ring-[#4A0404] focus:ring-opacity-50">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Rencana Penggunaan (Jenis Usaha)</label>
                                <textarea id="usage_plan" name="usage_plan" rows="3"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#4A0404] focus:ring focus:ring-[#4A0404] focus:ring-opacity-50">{{ old('usage_plan') }}</textarea>
                            </div>
                            <button type="button"
                                    @click="
                                        const dur = document.getElementById('duration_months').value;
                                        const usg = document.getElementById('usage_plan').value;
                                        if (!dur || parseInt(dur) < 1) { alert('Mohon isi durasi sewa minimal 1 bulan.'); return; }
                                        if (!usg.trim()) { alert('Mohon isi rencana penggunaan.'); return; }
                                        step = 2;
                                    "
                                    class="w-full bg-[#4A0404] text-white px-4 py-3 rounded hover:bg-opacity-90 transition font-bold">
                                Lanjut ke Identitas &rarr;
                            </button>
                        </div>

                        <!-- Step 2 -->
                        <div x-show="step === 2" x-transition style="display: none;">
                            <h3 class="text-lg font-bold mb-4">Langkah 2: Verifikasi Identitas</h3>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Upload KTP (JPG/PNG/PDF)</label>
                                <input type="file" id="ktp_proof" name="ktp_proof" accept=".jpg,.jpeg,.png,.pdf"
                                       class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">
                                <p class="text-xs text-gray-500 mt-1">Data Anda aman dan dienkripsi. <span class="text-[#D2B48C]">*Wajib diunggah</span></p>
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" @click="step = 1" class="w-1/3 bg-gray-300 text-gray-700 px-4 py-3 rounded hover:bg-gray-400 transition font-bold">&larr; Kembali</button>
                                <button type="button"
                                        @click="
                                            const ktp = document.getElementById('ktp_proof').files.length;
                                            if (!ktp) { alert('Mohon upload foto KTP Anda terlebih dahulu.'); return; }
                                            step = 3;
                                        "
                                        class="w-2/3 bg-[#4A0404] text-white px-4 py-3 rounded hover:bg-opacity-90 transition font-bold">
                                    Lanjut ke Pembayaran &rarr;
                                </button>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div x-show="step === 3" x-transition style="display: none;">
                            <h3 class="text-lg font-bold mb-4">Langkah 3: Konfirmasi & Pembayaran</h3>
                            <div class="bg-gray-100 p-4 rounded-lg mb-4 border border-gray-200">
                                <p class="text-sm text-gray-600 mb-2">Silakan transfer sesuai total harga ke rekening berikut:</p>
                                <p class="font-bold text-lg text-[#4A0404]">BCA - 1234567890 a.n. PT Se-Ru Indonesia</p>
                            </div>
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700">Upload Bukti Transfer</label>
                                <input type="file" id="transfer_proof" name="transfer_proof" accept=".jpg,.jpeg,.png,.pdf"
                                       class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm bg-gray-50">
                                <p class="text-xs text-gray-500 mt-1"><span class="text-[#D2B48C]">*Wajib diunggah sebelum kirim</span></p>
                            </div>
                            <div class="flex space-x-4">
                                <button type="button" @click="step = 2" class="w-1/3 bg-gray-300 text-gray-700 px-4 py-3 rounded hover:bg-gray-400 transition font-bold">&larr; Kembali</button>
                                <button type="button"
                                        @click="
                                            const tf = document.getElementById('transfer_proof').files.length;
                                            if (!tf) { alert('Mohon upload bukti transfer terlebih dahulu.'); return; }
                                            $el.closest('form').submit();
                                        "
                                        class="w-2/3 bg-[#D2B48C] text-[#4A0404] px-4 py-3 rounded hover:bg-white border border-[#D2B48C] transition font-bold shadow-lg">
                                    Kirim Pengajuan Sewa
                                </button>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="bg-gray-50 p-8 rounded-lg text-center border">
                        <p class="text-gray-600 mb-4">Anda harus login terlebih dahulu untuk menyewa ruko ini.</p>
                        <a href="/login" class="inline-block bg-[#4A0404] text-white px-6 py-2 rounded font-bold hover:bg-opacity-90">Login Sekarang</a>
                    </div>
                @endauth
            @endif
        </div>
    </div>
</div>
@endsection
