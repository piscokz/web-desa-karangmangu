{{-- resources/views/admin/article/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Artikel Desa')

@section('content')
<div class="container mx-auto px-4 py-8" data-aos="fade-up">
  {{-- Kembali --}}
  <a href="{{ route('admin.article.index') }}" class="text-green-700 hover:underline">&larr; Kembali ke Daftar Artikel</a>

  <div class="bg-white shadow rounded-lg p-6 mt-4" data-aos="fade-up" data-aos-delay="100">
    <h1 class="text-3xl font-bold mb-4 text-green-800">Edit Artikel Desa</h1>

    @if ($errors->any())
      <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.article.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf
      @method('PUT')

      {{-- Judul Artikel --}}
      <div>
        <label for="title" class="block text-lg font-medium text-gray-700">Judul Artikel</label>
        <input
          type="text"
          name="title"
          id="title"
          value="{{ old('title', $article->title) }}"
          required
          class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600"
        >
        @error('title')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

{{-- Kategori Desa --}}
@php
  $selectedCategory = old('category', $article->category);
  $isOther = $selectedCategory === 'Lainnya';
@endphp

<div x-data="{ other: {{ $isOther ? 'true' : 'false' }} }">
  <label for="category" class="block text-lg font-medium text-gray-700">Kategori Desa</label>
  <select
    name="category"
    id="category"
    @change="other = ($event.target.value === 'Lainnya')"
    required
    class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600 transition"
  >
    <option value="">-- Pilih Kategori --</option>
    @foreach(['Berita','Pengumuman','Agenda','Kegiatan Warga','Layanan Publik','Informasi Penting','Lainnya'] as $cat)
      <option value="{{ $cat }}" {{ $selectedCategory == $cat ? 'selected' : '' }}>
        {{ $cat }}
      </option>
    @endforeach
  </select>
  @error('category')
    <span class="text-red-500 text-sm">{{ $message }}</span>
  @enderror

  {{-- Input Manual Jika Pilih "Lainnya" --}}
  <div x-show="other" x-cloak class="mt-4">
    <label for="category_other" class="block text-lg font-medium text-gray-700">Masukkan Kategori Baru</label>
    <input
      type="text"
      name="category_other"
      id="category_other"
      value="{{ old('category_other', $article->category_other) }}"
      placeholder="Tulis kategori di sini..."
      class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600 transition"
    />
    @error('category_other')
      <span class="text-red-500 text-sm">{{ $message }}</span>
    @enderror
  </div>
</div>


      {{-- Tanggal Artikel --}}
      <div>
        <label for="date" class="block text-lg font-medium text-gray-700">Tanggal Artikel</label>
        <input
          type="date"
          name="date"
          id="date"
          value="{{ old('date', \Carbon\Carbon::parse($article->date)->format('Y-m-d')) }}"
          required
          class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600"
        >
        @error('date')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      {{-- Konten Artikel --}}
      <div>
        <label for="content" class="block text-lg font-medium text-gray-700">Konten Artikel</label>
        <textarea
          name="content"
          id="content"
          rows="6"
          required
          class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600"
        >{{ old('content', $article->content) }}</textarea>
        @error('content')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      {{-- Gambar Utama --}}
      <div>
        <label class="block text-lg font-medium text-gray-700 mb-2">Gambar Utama</label>
        <div
          id="feature-dropzone"
          class="border-2 border-dashed border-gray-300 rounded-md p-6 flex items-center justify-center cursor-pointer transition hover:border-green-600 relative h-40"
        >
          @if($article->image)
            <img
              id="feature-preview"
              src="{{ asset('storage/'.$article->image) }}"
              alt="Preview"
              class="absolute inset-0 w-full h-full object-cover rounded-md"
            >
          @else
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
            </svg>
          @endif
        </div>
        <input type="file" name="image" id="image" class="hidden" accept="image/*">
        @error('image')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      {{-- Nama Penulis --}}
      <div>
        <label for="author_name" class="block text-lg font-medium text-gray-700">Nama Penulis</label>
        <input
          type="text"
          name="author_name"
          id="author_name"
          value="{{ old('author_name', $article->author_name) }}"
          class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600"
        >
        @error('author_name')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      {{-- Foto Penulis --}}
      <div>
        <label class="block text-lg font-medium text-gray-700 mb-2">Foto Penulis (Avatar)</label>
        <div
          id="author-dropzone"
          class="border-2 border-dashed border-gray-300 rounded-full w-32 h-32 mx-auto flex items-center justify-center cursor-pointer transition hover:border-green-600 overflow-hidden relative"
        >
          @if($article->author_photo)
            <img
              id="author-preview"
              src="{{ asset('storage/'.$article->author_photo) }}"
              alt="Avatar"
              class="w-full h-full object-cover rounded-full"
            >
          @else
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-width="2" d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z"/>
            </svg>
          @endif
        </div>
        <input type="file" name="author_photo" id="author_photo" class="hidden" accept="image/*">
        @error('author_photo')
          <span class="text-red-500 text-sm">{{ $message }}</span>
        @enderror
      </div>

      {{-- Submit --}}
      <div>
        <button
          type="submit"
          class="w-full py-3 bg-green-600 text-white rounded-md font-semibold hover:bg-green-500 transition duration-300"
        >
          Update Artikel
        </button>
      </div>
    </form>
  </div>
</div>

{{-- Alpine.js --}}
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

{{-- CKEditor --}}
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('content', { removeButtons: 'PasteFromWord' });

  // Feature Image Dropzone
  const featureDropzone = document.getElementById('feature-dropzone');
  const featureInput   = document.getElementById('image');

  featureDropzone.addEventListener('click', () => featureInput.click());
  ['dragover','dragenter'].forEach(evt => featureDropzone.addEventListener(evt, e => {
    e.preventDefault();
    featureDropzone.classList.add('border-green-600');
  }));
  ['dragleave','drop'].forEach(evt => featureDropzone.addEventListener(evt, e => {
    e.preventDefault();
    featureDropzone.classList.remove('border-green-600');
    if(evt==='drop' && e.dataTransfer.files.length) {
      featureInput.files = e.dataTransfer.files;
      previewFeatureImage(featureInput.files[0]);
    }
  }));
  featureInput.addEventListener('change', () => {
    if(featureInput.files.length) previewFeatureImage(featureInput.files[0]);
  });
  function previewFeatureImage(file) {
    const reader = new FileReader();
    reader.onload = e => {
      let img = document.getElementById('feature-preview');
      if(!img) {
        img = document.createElement('img');
        img.id = 'feature-preview';
        img.className = 'absolute inset-0 w-full h-full object-cover rounded-md';
        featureDropzone.appendChild(img);
      }
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  // Author Photo Dropzone
  const authorDropzone = document.getElementById('author-dropzone');
  const authorInput    = document.getElementById('author_photo');
  authorDropzone.addEventListener('click', () => authorInput.click());
  ['dragover','dragenter'].forEach(evt => authorDropzone.addEventListener(evt, e => {
    e.preventDefault();
    authorDropzone.classList.add('border-green-600');
  }));
  ['dragleave','drop'].forEach(evt => authorDropzone.addEventListener(evt, e => {
    e.preventDefault();
    authorDropzone.classList.remove('border-green-600');
    if(evt==='drop' && e.dataTransfer.files.length) {
      authorInput.files = e.dataTransfer.files;
      previewAuthorImage(authorInput.files[0]);
    }
  }));
  authorInput.addEventListener('change', () => {
    if(authorInput.files.length) previewAuthorImage(authorInput.files[0]);
  });
  function previewAuthorImage(file) {
    const reader = new FileReader();
    reader.onload = e => {
      let img = document.getElementById('author-preview');
      if(!img) {
        img = document.createElement('img');
        img.id = 'author-preview';
        img.className = 'w-full h-full object-cover rounded-full';
        authorDropzone.appendChild(img);
      }
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
</script>
@endsection