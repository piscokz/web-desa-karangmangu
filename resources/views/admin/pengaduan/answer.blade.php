@extends('admin.layouts.app')

@section('title', 'Balas Pengaduan')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-2xl">

    <h1 class="text-3xl font-bold text-[#14532d] mb-8">✉️ Balas Pengaduan Warga</h1>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mb-8">
        <div class="mb-4">
            <h2 class="text-lg font-semibold text-gray-800">👤 {{ $pengaduan->nama }} 
                <span class="text-sm text-gray-500">({{ $pengaduan->email }})</span>
            </h2>
            <p class="text-sm text-gray-600">RW {{ $pengaduan->rw }} / RT {{ $pengaduan->rt }}</p>
            <p class="text-xs text-gray-400 mt-1">{{ $pengaduan->waktu->format('d M Y H:i') }} ({{ $pengaduan->waktu->diffForHumans() }})</p>
        </div>

        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-md p-4 text-sm text-gray-700">
            <strong>Isi Pengaduan:</strong>
            <p class="mt-1 whitespace-pre-line">{{ $pengaduan->deskripsi }}</p>
        </div>
    </div>

    <form action="{{ route('admin.pengaduan.sendReply', $pengaduan) }}" method="POST" class="space-y-6 bg-white p-6 rounded-xl shadow-md border border-gray-100">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">📌 Subjek Balasan</label>
            <input type="text" name="subject" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none"
                   placeholder="Masukkan judul balasan..." />
            @error('subject')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">📝 Pesan Balasan</label>
            <textarea name="message" rows="6" required
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none"
                      placeholder="Tulis jawaban Anda di sini..."></textarea>
            @error('message')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('admin.pengaduan.index') }}"
               class="inline-block px-4 py-2 bg-gray-100 text-gray-700 rounded hover:bg-gray-200 transition">
                ← Kembali
            </a>
            <button type="submit"
                    class="inline-block px-6 py-2 bg-green-600 text-white font-semibold rounded hover:bg-green-500 transition">
                Kirim & Hapus Pengaduan
            </button>
        </div>
    </form>
</div>
@endsection