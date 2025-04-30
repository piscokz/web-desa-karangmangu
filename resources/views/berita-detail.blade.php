@extends('layouts.app')

@section('title', 'Detail Artikel')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-4xl" data-aos="fade-up">

  {{-- Logo Branding --}}
  <div class="flex justify-center mb-8">
    <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan"
         class="w-24 h-24 object-contain drop-shadow-md">
  </div>

  {{-- Tombol Kembali --}}
  <div class="mb-10 text-center">
    <a href="{{ route('news') }}"
       class="inline-flex items-center gap-2 text-green-800 hover:text-green-900 font-medium transition hover:underline">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
           viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
      Kembali ke Daftar Artikel
    </a>
  </div>

  {{-- Gambar Utama --}}
  @if($article->image)
    <div class="rounded-xl overflow-hidden border-4 border-green-700 mb-8 shadow-lg group relative">
      <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
           class="w-full h-64 sm:h-72 object-cover group-hover:brightness-105 transition duration-300 cursor-pointer"
           onclick="openImageModal('{{ asset('storage/' . $article->image) }}')">
    </div>
  @endif

  {{-- Judul dan Metadata --}}
  <div class="mb-6 text-center">
    <h1 class="text-3xl sm:text-4xl font-extrabold text-green-900 leading-snug mb-3 tracking-wide">
      {{ $article->title }}
    </h1>
    <div class="text-sm text-gray-500 space-x-2 flex flex-col sm:flex-row justify-center items-center gap-2">
      <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-widest border border-green-300 shadow-sm">
        {{ $article->category }}
      </span>
      <span class="inline-block italic">{{ \Carbon\Carbon::parse($article->date)->translatedFormat('d F Y') }}</span>
    </div>
  </div>

  {{-- Konten Artikel --}}
  <article class="prose prose-green max-w-none text-justify bg-white p-6 rounded-2xl border border-gray-200 shadow-sm leading-relaxed">
    {!! $article->content !!}
  </article>

  {{-- Penulis --}}
  @if($article->author_name)
    <div class="flex items-center gap-4 mt-12 p-5 bg-green-50 border border-green-200 rounded-lg shadow-inner">
      @if($article->author_photo)
        <img src="{{ asset('storage/' . $article->author_photo) }}" alt="{{ $article->author_name }}"
             class="w-16 h-16 rounded-full object-cover border-2 border-green-600 shadow">
      @endif
      <div>
        <p class="text-green-600 text-sm">Ditulis oleh</p>
        <p class="font-semibold text-gray-900 text-lg">{{ $article->author_name }}</p>
      </div>
    </div>
  @endif
</div>

{{-- Modal Gambar --}}
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80 backdrop-blur-sm">
  <div class="relative max-w-3xl mx-auto p-4">
    <button onclick="closeImageModal()"
    class="absolute top-3 right-3 w-10 h-10 flex items-center justify-center text-white text-2xl font-bold rounded-full bg-green-700 hover:bg-green-800 transition duration-300 shadow-lg focus:outline-none">
      &times;
    </button>
    <img id="modalImage" src="" alt="Detail Gambar"
         class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl border-4 border-white">
  </div>
</div>

{{-- Script Modal --}}
<script>
  function openImageModal(src) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modalImg.src = src;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
  }

  function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.remove('flex');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
  }

  document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) closeImageModal();
  });
</script>
@endsection