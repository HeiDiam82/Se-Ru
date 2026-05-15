@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-8 border-b pb-4">
        <h1 class="text-3xl font-bold text-[#4A0404]">Kelola Inventaris Ruko</h1>
        <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-[#D2B48C] text-[#4A0404] px-4 py-2 rounded font-bold hover:bg-white border border-[#D2B48C] transition">
            + Tambah Ruko
        </button>
    </div>

    <!-- Ruko Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-[#4A0404]">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Nama Ruko</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Harga</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($rukos as $ruko)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $ruko->name }}</div>
                        <div class="text-sm text-gray-500 truncate w-48">{{ $ruko->address }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">Rp {{ number_format($ruko->price, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            {{ $ruko->status === 'available' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ strtoupper($ruko->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <form action="{{ route('admin.ruko.destroy', $ruko->ruko_id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus ruko ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Add Ruko Modal -->
    <div id="addModal" class="hidden fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full p-6">
            <h2 class="text-2xl font-bold mb-4">Tambah Ruko Baru</h2>
            <form action="{{ route('admin.ruko.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Ruko</label>
                        <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                        <textarea name="address" required rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga (Rp/bulan)</label>
                        <input type="number" name="price" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Foto Ruko (Bisa lebih dari 1)</label>
                        <input type="file" name="photos[]" multiple accept="image/*" class="mt-1 block w-full">
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="bg-gray-200 text-gray-700 px-4 py-2 rounded">Batal</button>
                    <button type="submit" class="bg-[#4A0404] text-white px-4 py-2 rounded">Simpan Ruko</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
