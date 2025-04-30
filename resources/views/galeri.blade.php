{{-- resources/views/galeri.blade.php --}}
@extends('layouts.app')

@section('title', 'Galeri Kegiatan - Kelurahan Winduherang')

@section('content')
@php
    $categories = $items->pluck('category')->unique();
@endphp

<section class="bg-green-50 py-16">
  <div class="max-w-6xl mx-auto px-4">
    <h1 class="text-4xl font-extrabold text-center mb-8 text-green-800">Galeri Kegiatan Desa</h1>

    {{-- Search & Category Pills --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 space-y-4 md:space-y-0">
      {{-- Search --}}
      <div class="relative w-full md:w-1/3">
        <input
          id="gallerySearch"
          type="text"
          placeholder="Cari judul..."
          class="w-full pl-12 pr-4 py-2 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 transition"
          oninput="filterGallery()"
        />
        <div class="absolute inset-y-0 left-3 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
      </div>

      {{-- Category Pills --}}
      <div class="flex flex-wrap gap-2 justify-center md:justify-start">
        <button
          class="category-btn px-4 py-1 rounded-full border text-sm font-medium transition-all duration-200
                bg-green-600 text-white border-green-600
                hover:bg-green-700 hover:border-green-700"
          data-cat="All"
          onclick="selectCategory(this)"
        >Semua</button>

        @foreach($categories as $cat)
          <button
            class="category-btn px-4 py-1 rounded-full border text-sm font-medium transition-all duration-200
                  bg-white text-green-700 border-green-300
                  hover:bg-green-100 hover:border-green-400 hover:text-green-800"
            data-cat="{{ $cat }}"
            onclick="selectCategory(this)"
          >{{ $cat }}</button>
        @endforeach
      </div>

    </div>

    {{-- Gallery Grid --}}
    <div id="galleryGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @forelse ($items as $item)
        <div
          class="gallery-item group relative overflow-hidden rounded-lg shadow-lg cursor-pointer transition-transform hover:scale-105"
          data-category="{{ $item->category }}"
          data-title="{{ Str::lower($item->title) }}"
          onclick="openModal('{{ $item->image_url }}','{{ addslashes($item->title) }}')"
        >
          <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
               class="w-full h-48 object-cover" />
          <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-center items-center px-4">
            <h3 class="text-white font-bold text-lg text-center">{{ $item->title }}</h3>
            <p class="text-gray-200 text-sm mt-1">{{ $item->date->format('d M Y') }}</p>
          </div>
        </div>
      @empty
        {{-- nothing to loop --}}
      @endforelse

      {{-- No‑data card --}}
      <div id="noData" class="hidden col-span-full bg-white rounded-lg shadow p-8 text-center text-gray-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 mb-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 13l3 3L22 4M7 21H2v-5M17 21h5v-5"/>
        </svg>
        <p class="text-lg font-medium">Data tidak ditemukan</p>
      </div>
    </div>
  </div>

  {{-- Lightbox Modal --}}
  <div id="galleryModal"
       class="fixed inset-0 bg-black bg-opacity-80 backdrop-blur-sm flex items-center justify-center hidden z-50 px-4 py-8 overflow-y-auto">
    <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden animate__animated animate__zoomIn">
      <button id="modalClose"
              class="absolute top-4 right-4 text-white bg-green-700 rounded-full p-2 hover:bg-green-600 shadow-lg focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12"/>
        </svg>
      </button>
      <img id="modalImage" src="" alt="" class="w-full max-h-[80vh] object-contain bg-gray-100">
      <div class="p-4 bg-green-50">
        <h3 id="modalCaption" class="text-2xl font-semibold text-green-800 text-center"></h3>
      </div>
    </div>
  </div>
</section>

<script>
  let selectedCat = 'All';

  function selectCategory(btn) {
    document.querySelectorAll('.category-btn').forEach(b => {
      b.classList.remove(
        'bg-green-600', 'text-white', 'border-green-600',
        'bg-white', 'text-green-700', 'border-green-300'
      );
      b.classList.add('bg-white', 'text-green-700', 'border-green-300');
    });

    btn.classList.remove('bg-white', 'text-green-700', 'border-green-300');
    btn.classList.add('bg-green-600', 'text-white', 'border-green-600');

    selectedCat = btn.dataset.cat;
    filterGallery();
  }

  function filterGallery() {
    const q = document.getElementById('gallerySearch').value.trim().toLowerCase();
    const cards = document.querySelectorAll('.gallery-item');
    let anyVisible = false;

    cards.forEach(card => {
      const title = card.dataset.title;
      const cat   = card.dataset.category;
      const matchesText = !q || title.includes(q);
      const matchesCat  = selectedCat === 'All' || cat === selectedCat;
      const show = matchesText && matchesCat;
      card.style.display = show ? '' : 'none';
      if (show) anyVisible = true;
    });

    document.getElementById('noData').style.display = anyVisible ? 'none' : 'block';
  }

  function openModal(src, caption) {
    document.getElementById('modalImage').src = src;
    document.getElementById('modalCaption').textContent = caption;
    document.getElementById('galleryModal').classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  }

  function closeModal() {
    document.getElementById('galleryModal').classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  }

  document.getElementById('modalClose').addEventListener('click', closeModal);
  document.getElementById('galleryModal').addEventListener('click', e => {
    if (e.target.id === 'galleryModal') closeModal();
  });

  // initialize
  selectCategory(document.querySelector('.category-btn[data-cat="All"]'));
</script>
@endsection