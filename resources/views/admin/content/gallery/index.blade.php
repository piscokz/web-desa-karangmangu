{{-- resources/views/admin/gallery/index.blade.php --}}
@extends('admin.layouts.app')

@section('title','Kelola Galeri')

@section('content')
<div class="container mx-auto p-4">
  <div class="flex justify-between items-center mb-6" data-aos="fade-up">
    <h1 class="text-3xl font-bold text-green-800">Galeri Kegiatan</h1>
    <a href="{{ route('admin.gallery.create') }}"
       class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded-lg shadow transition">
      + Tambah Item
    </a>
  </div>

  @if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg shadow" data-aos="fade-up" data-aos-delay="100">
      {{ session('success') }}
    </div>
  @endif

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" data-aos="fade-up" data-aos-delay="200">
    @forelse($items as $item)
      <div class="relative group overflow-hidden rounded-2xl shadow-xl bg-white transition duration-300 hover:shadow-2xl">
        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
             class="w-full h-48 object-cover transition-transform duration-500 group-hover:scale-105" />
        <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 bg-gradient-to-t from-black/80 via-transparent to-transparent">
          <h3 class="text-lg font-bold text-white drop-shadow">{{ $item->title }}</h3>
          <p class="text-sm text-gray-200">{{ $item->category }} &bull; {{ $item->date->format('d M Y') }}</p>
          <div class="mt-3 flex flex-wrap gap-2">
            <a href="{{ route('admin.gallery.show', $item) }}"
               class="bg-blue-600 hover:bg-blue-500 text-white px-3 py-1 rounded text-xs transition shadow">
              Lihat
            </a>
            <a href="{{ route('admin.gallery.edit', $item) }}"
               class="bg-yellow-500 hover:bg-yellow-400 text-white px-3 py-1 rounded text-xs transition shadow">
              Ubah
            </a>
            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="inline"
                  onsubmit="return confirm('Yakin ingin menghapus item ini?')">
              @csrf
              @method('DELETE')
              <button type="submit"
                      class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded text-xs transition shadow">
                Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <p class="col-span-full text-center text-gray-500 text-lg" data-aos="fade-up">Belum ada item galeri.</p>
    @endforelse
  </div>

  <div class="mt-10 flex justify-center" data-aos="fade-up" data-aos-delay="300">
    {{ $items->links('vendor.pagination.tailwind') }}
  </div>
</div>
@endsection