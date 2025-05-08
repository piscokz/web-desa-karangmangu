@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-8" x-data>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900 flex items-center">
            Tambah Data Kematian
            <span class="text-gray-400 ml-2">🪦</span>
        </h1>
        <a href="{{ route('kematian.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded shadow transition flex items-center">
            ← Kembali
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('kematian.store') }}" method="POST"
          class="bg-white p-6 rounded-lg shadow grid grid-cols-2 gap-6">
        @csrf

        {{-- Penduduk --}}
        <div>
            <label for="penduduk_id" class="block text-gray-700 mb-1">Penduduk <span class="text-red-500">*</span></label>
            <select id="penduduk_id" name="penduduk_id"
                    class="w-full bg-white border border-gray-300 text-gray-700 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                    required>
                <option value="" disabled selected>-- Pilih Penduduk --</option>
                @foreach($residents as $r)
                    <option value="{{ $r->id }}" {{ old('penduduk_id') == $r->id ? 'selected' : '' }}>
                        {{ $r->nama_lengkap }} ({{ $r->nik }})
                    </option>
                @endforeach
            </select>
            @error('penduduk_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Tanggal Meninggal --}}
        <div>
            <label for="tanggal_meninggal" class="block text-gray-700 mb-1">Tanggal Meninggal <span class="text-red-500">*</span></label>
            <input id="tanggal_meninggal" type="date" name="tanggal_meninggal"
                   value="{{ old('tanggal_meninggal') }}"
                   class="w-full bg-white border border-gray-300 text-gray-700 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                   required>
            @error('tanggal_meninggal')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Penyebab --}}
        <div>
            <label for="penyebab" class="block text-gray-700 mb-1">Penyebab</label>
            <input id="penyebab" type="text" name="penyebab"
                   value="{{ old('penyebab') }}"
                   placeholder="Contoh: Sakit"
                   class="w-full bg-white border border-gray-300 text-gray-700 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500">
            @error('penyebab')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Keterangan --}}
        <div>
            <label for="keterangan" class="block text-gray-700 mb-1">Keterangan</label>
            <textarea id="keterangan" name="keterangan" rows="3"
                      class="w-full bg-white border border-gray-300 text-gray-700 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500"
                      placeholder="Tambahan keterangan...">{{ old('keterangan') }}</textarea>
            @error('keterangan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Buttons --}}
        <div class="col-span-2 flex justify-end space-x-3 pt-4">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded shadow transition">
                💾 Simpan
            </button>
            <a href="{{ route('kematian.index') }}"
               class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2 rounded shadow transition">
                ✖ Batal
            </a>
        </div>
    </form>
</div>
@endsection