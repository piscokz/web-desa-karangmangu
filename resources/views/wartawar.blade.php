{{-- resources/views/wartawargi.blade.php --}}
@extends('layouts.app')

@section('title', 'Pengaduan Masyarakat & Kontak - Kelurahan Winduherang')

@section('content')
    {{-- Hero --}}
    <section
        class="relative bg-gradient-to-br from-green-700 via-emerald-500 to-lime-300 overflow-hidden rounded-3xl shadow-lg py-32 mb-24">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center text-white space-y-6">
            <h1 class="text-5xl font-extrabold">💬 Pengaduan Masyarakat</h1>
            <p class="text-lg md:text-xl">Sampaikan aspirasi, keluhan, dan saran Anda. Kami siap mendengarkan dan
                menindaklanjuti!</p>
            <a href="#form-pengaduan"
                class="inline-flex items-center gap-2 bg-white text-green-800 font-semibold px-8 py-3 rounded-full shadow hover:bg-gray-100 transition">
                Isi Formulir Pengaduan
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>
    </section>

    {{-- Form Pengaduan --}}
    <section id="form-pengaduan" class="max-w-3xl mx-auto px-4 py-16 bg-white rounded-2xl shadow-lg mb-24">
        <h2 class="text-2xl font-bold text-green-800 mb-6 text-center">Form Pengaduan Masyarakat</h2>
        {{-- Success & Error Messages --}}
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
                class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg shadow">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
        
            {{-- Baris 1: Nama dan Email --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nama Pelapor</label>
                    <input type="text" name="nama" placeholder="Nama lengkap"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Email Pelapor</label>
                    <input type="text" name="email" placeholder="Email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
                </div>
            </div>
        
            {{-- Baris 2: RW dan RT --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">RW</label>
                    <input type="text" maxlength="3" name="rw" placeholder="RW"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">RT</label>
                    <input type="text" maxlength="3" name="rt" placeholder="RT"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
                </div>
            </div>
        
            {{-- Baris 3: Tanggal & Lokasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Tanggal & Waktu</label>
                    <input type="datetime-local" name="waktu"
                        value="{{ now()->format('Y-m-d\TH:i') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
                </div>                
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Lokasi Masalah</label>
                    <input type="text" name="lokasi" placeholder="Contoh: Jalan Desa RT 03"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
                </div>
            </div>
        
            {{-- Baris 4: Deskripsi --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Deskripsi Masalah</label>
                <textarea name="deskripsi" rows="4" placeholder="Jelaskan secara singkat masalah atau keluhan Anda..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200"></textarea>
            </div>
        
            {{-- Baris 5: Upload --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Dokumentasi (gambar)</label>
                <input type="file" name="bukti[]" accept="image/*" multiple class="w-full text-gray-600" />
                <p class="text-sm text-gray-500 mt-1">Unggah foto untuk memperkuat bukti.</p>
            </div>
        
            {{-- Tombol --}}
            <div class="text-center">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-500 text-white font-semibold px-8 py-3 rounded-lg shadow-md transition">
                    Kirim Pengaduan
                </button>
            </div>
        </form>
        
    </section>


    {{-- Kontak Kami --}}
    <section class="max-w-3xl mx-auto px-4 py-16 bg-gradient-to-br from-gray-100 to-emerald-50 rounded-2xl shadow-inner">
        <h2 class="text-2xl font-bold text-center text-green-800 mb-8">Kontak Kami</h2>
        <div class="space-y-6 text-center">
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h4l2 7l-2 7H3m18-14h-4l-2 7l2 7h4" />
                </svg>
                <a href="tel:+628123456789" class="text-gray-700 font-medium hover:text-green-800">+62 812‑3456‑789</a>
            </div>
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 8l7-3l7 3m0 0v8l-7 3m7-11l-7 3M3 8v8l7 3" />
                </svg>
                <a href="mailto:info@Winduherang.com"
                    class="text-gray-700 font-medium hover:text-green-800">info@Winduherang.com</a>
            </div>
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2l2 7h7l-5.5 4l2 7L12 16l-5.5 4l2-7L2 9h7z" />
                </svg>
                <a href="https://wa.me/628123456789" target="_blank"
                    class="text-gray-700 font-medium hover:text-green-800">Chat WhatsApp</a>
            </div>
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none"
                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                <span class="text-gray-700">Jl. Merdeka No.11, Winduherang, Kuningan</span>
            </div>
        </div>
    </section>
@endsection