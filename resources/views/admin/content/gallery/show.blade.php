@extends('admin.layouts.app')

@section('title','Detail Galeri')

@section('content')
<div class="container mx-auto p-4">
  <a href="{{ route('admin.gallery.index') }}" class="inline-block text-green-600 hover:underline mb-4">&larr; Kembali</a>
  <div class="bg-white shadow-lg rounded-2xl overflow-hidden" data-aos="fade-up">
    <div class="w-full h-80 overflow-hidden">
      <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
           class="w-full h-full object-cover transition-transform duration-500 hover:scale-105" />
    </div>
    <div class="p-8">
      <h2 class="text-3xl font-bold text-green-800 mb-4">{{ $item->title }}</h2>
      <div class="flex flex-wrap gap-6 text-gray-600 mb-6">
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7v10a4 4 0 004 4h10a4 4 0 004-4V7M3 7a4 4 0 014-4h10a4 4 0 014 4M3 7h18"/>
          </svg>
          <span>{{ $item->category }}</span>
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-10 4h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z"/>
          </svg>
          <span>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</span>
        </div>
      </div>
      <div class="prose prose-green max-w-none text-gray-800">
        {!! $item->content !!}
      </div>
      <div class="mt-10 pt-8 border-t flex items-center space-x-4">
        {{-- <img src="{{ $item->author_photo ?: 'https://source.unsplash.com/40x40/?person' }}"
             alt="{{ $item->author_name }}"
             class="w-12 h-12 rounded-full object-cover shadow-md"> --}}
        <div class="text-gray-700">
          <p class="font-semibold">{{ $item->author_name }}</p>
          <p class="text-sm">Diterbitkan pada {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection