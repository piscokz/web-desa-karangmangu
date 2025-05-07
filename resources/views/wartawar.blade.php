{{-- resources/views/wartawargi.blade.php --}}
@extends('layouts.app')

@section('title', 'Pengaduan Masyarakat & Kontak - Desa Karangmangu')

@section('content')
    {{-- Hero --}}
    <section
        class="relative bg-gradient-to-br from-green-700 via-emerald-500 to-lime-300 overflow-hidden rounded-3xl shadow-lg py-32 mb-24">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative max-w-3xl mx-auto px-6 text-center text-white space-y-6">
            <h1 class="text-5xl font-extrabold">💬 Pengaduan Masyarakat</h1>
            <p class="text-lg md:text-xl">Sampaikan aspirasi, keluhan, dan saran Anda. Kami siap mendengarkan dan
                menindaklanjuti!</p>
                {{-- <a href="#form-pengaduan"
                    class="inline-flex items-center gap-2 bg-white text-green-800 font-semibold px-8 py-3 rounded-full shadow hover:bg-gray-100 transition">
                    Isi Formulir Pengaduan
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a> --}}
        </div>
    </section>


    {{-- resources/views/umkm.blade.php (atau partial kontak) --}}
    @php
        $kontak = \App\Models\VillageContact::first();
        $youtube = $kontak->youtube ?? '#';
        $instagram = $kontak->instagram ?? '#';
        $facebook = $kontak->facebook ?? '#';
        $whatsapp = $kontak->no_telepon ? 'https://wa.me/' . preg_replace('/\D/', '', $kontak->no_telepon) : '#';
        $emailLink = $kontak->email ? 'mailto:' . $kontak->email : '#';
    @endphp

    {{-- Kontak Kami --}}
    <section class="max-w-3xl mx-auto px-4 py-16 bg-gradient-to-br from-gray-100 to-emerald-50 rounded-2xl shadow-inner">
        <h2 class="text-2xl font-bold text-center text-green-800 mb-8">Kontak Kami</h2>
        <div class="space-y-6 text-center">
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h4l2 7l-2 7H3m18-14h-4l-2 7l2 7h4" />
                </svg>
                <a href="tel:{{ $kontak->no_telepon }}" class="text-gray-700 font-medium hover:text-green-800">
                    {{ $kontak->no_telepon }}
                </a>
            </div>
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7-3l7 3m0 0v8l-7 3m7-11l-7 3M3 8v8l7 3" />
                </svg>
                <a href="{{ $emailLink }}" class="text-gray-700 font-medium hover:text-green-800">
                    {{ $kontak->email }}
                </a>
            </div>
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2l2 7h7l-5.5 4l2 7L12 16l-5.5 4l2-7L2 9h7z" />
                </svg>
                <a href="{{ $whatsapp }}" target="_blank" class="text-gray-700 font-medium hover:text-green-800">
                    Chat WhatsApp
                </a>
            </div>
            <div class="inline-flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                </svg>
                <span class="text-gray-700">Jl. Merdeka No.11, Karangmangu, Kuningan</span>
            </div>

            {{-- Sosial Media --}}
            <div class="inline-flex items-center gap-4 justify-center">
                <a href="{{ $youtube }}" aria-label="YouTube" target="_blank">
                    <img src="{{ asset('images/icons/youtube.svg') }}" alt="YouTube"
                        class="w-6 h-6 object-contain transition-colors duration-300 hover:text-green-400" />
                </a>
                <a href="{{ $instagram }}" aria-label="Instagram" target="_blank">
                    <img src="{{ asset('images/icons/instagram.svg') }}" alt="Instagram"
                        class="w-6 h-6 object-contain transition-colors duration-300 hover:text-green-400" />
                </a>
                <a href="{{ $facebook }}" aria-label="Facebook" target="_blank">
                    <img src="{{ asset('images/icons/facebook.svg') }}" alt="Facebook"
                        class="w-6 h-6 object-contain transition-colors duration-300 hover:text-green-400" />
                </a>
                <a href="{{ $whatsapp }}" aria-label="WhatsApp" target="_blank">
                    <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp"
                        class="w-6 h-6 object-contain transition-colors duration-300 hover:text-green-400" />
                </a>
                <a href="{{ $emailLink }}" aria-label="Email">
                    <img src="{{ asset('images/icons/email.svg') }}" alt="Email"
                        class="w-6 h-6 object-contain transition-colors duration-300 hover:text-green-400" />
                </a>
            </div>
        </div>
    </section>

@endsection