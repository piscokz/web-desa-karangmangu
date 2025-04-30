@extends('admin.layouts.app')

@section('title', 'Detail Artikel')

@section('content')
<div class="container mx-auto px-4 py-10 max-w-4xl" data-aos="fade-up">
  {{-- Tombol Kembali --}}
  <div class="mb-8">
    <a href="{{ route('admin.article.index') }}" class="inline-flex items-center text-green-700 font-medium hover:underline">
      &larr; Kembali ke Daftar Artikel
    </a>
  </div>

  {{-- Gambar Utama --}}
  @if($article->image)
    <div class="rounded-xl overflow-hidden shadow-lg mb-8 group relative">
      <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" 
           class="w-full h-[420px] object-cover group-hover:brightness-110 transition-all duration-300 cursor-pointer"
           onclick="openImageModal('{{ asset('storage/' . $article->image) }}')">
    </div>
  @endif

  {{-- Judul dan Metadata --}}
  <div class="mb-6 text-center">
    <h1 class="text-5xl font-extrabold text-gray-900 leading-tight mb-3">{{ $article->title }}</h1>
    <div class="text-sm text-gray-500 space-x-4">
      <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider">
        {{ $article->category }}
      </span>
      <span class="inline-block">{{ \Carbon\Carbon::parse($article->date)->translatedFormat('d F Y') }}</span>
    </div>
  </div>

  {{-- Konten Artikel --}}
  <article class="prose prose-lg prose-green max-w-none text-justify leading-relaxed">
    {!! $article->content !!}
  </article>

  {{-- Penulis --}}
  @if($article->author_name)
    <div class="flex items-center gap-4 mt-12 p-5 bg-gray-100 rounded-lg shadow-sm">
      @if($article->author_photo)
        <img src="{{ asset('storage/' . $article->author_photo) }}" alt="{{ $article->author_name }}"
             class="w-16 h-16 rounded-full object-cover border border-gray-300 shadow">
      @endif
      <div>
        <p class="text-gray-600 text-sm">Ditulis oleh</p>
        <p class="font-semibold text-gray-800 text-lg">{{ $article->author_name }}</p>
      </div>
    </div>
  @endif
</div>

{{-- Modal Gambar --}}
<div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80 backdrop-blur-sm">
  <div class="relative max-w-5xl mx-auto p-4">
    <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-3xl font-bold focus:outline-none">&times;</button>
    <img id="modalImage" src="" alt="Detail Gambar" class="w-full max-h-[90vh] object-contain rounded-lg shadow-2xl border border-white">
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