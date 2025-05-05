{{-- resources/views/admin/content/lapak_desa/index.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">

  {{-- Flash Message --}}
  @if (session('success'))
    <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 text-green-800 shadow">
      {{ session('success') }}
    </div>
  @endif

  {{-- Header --}}
  <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-8 space-y-4 md:space-y-0">
    <h1 class="text-3xl font-bold text-gray-800">Lapak Desa</h1>
    <a href="{{ route('lapak_desa.create') }}"
       class="inline-flex items-center px-5 py-3 bg-green-600 text-white rounded-full shadow-lg hover:bg-green-500 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4v16m8-8H4"/>
      </svg>
      Tambah Produk
    </a>
  </div>

  {{-- Grid Produk --}}
  <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
    @forelse($lapak as $item)
      <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition flex flex-col">
        {{-- Gambar Produk --}}
        <div class="relative w-full h-48 bg-gray-100 overflow-hidden">
          @if($item->gambar_produk)
            <img src="{{ asset('storage/' . $item->gambar_produk) }}"
                 alt="{{ $item->nama_produk }}"
                 class="w-full h-full object-cover">
          @else
            <div class="flex items-center justify-center h-full text-gray-400">
              <span>Tidak ada gambar</span>
            </div>
          @endif
        </div>

        {{-- Konten --}}
        <div class="p-4 flex-1 flex flex-col">
          <h2 class="text-base font-semibold text-gray-800 line-clamp-2 mb-1">{{ $item->nama_produk }}</h2>
          <p class="text-sm text-gray-600 line-clamp-3 flex-1">{!! Str::limit(strip_tags($item->deskripsi), 100) !!}</p>
          
          {{-- Harga dengan format ribuan pakai titik --}}
          <h2 class="text-base font-semibold text-gray-800 mb-1">
            Rp {{ $item->harga_produk }}
          </h2>

          {{-- Aksi --}}
          <div class="mt-4 flex items-center justify-between">
            <a href="{{ route('lapak_desa.show', $item) }}"
               class="text-green-600 hover:underline text-sm font-medium">Detail</a>
            <div class="flex space-x-2">
              <a href="{{ route('lapak_desa.edit', $item) }}"
                 class="inline-flex items-center px-3 py-1 bg-blue-500 text-white rounded-full text-sm hover:bg-blue-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5"/>
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit
              </a>
              <button
                @click="if(confirm('Hapus produk ini?')) $refs['form-{{ $item->id }}'].submit()"
                class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded-full text-sm hover:bg-red-400 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3"/>
                </svg>
                Hapus
              </button>
              <form x-ref="form-{{ $item->id }}" action="{{ route('lapak_desa.destroy', $item) }}"
                    method="POST" class="hidden">
                @csrf @method('DELETE')
              </form>
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full py-12 text-center text-gray-500">
        Belum ada produk di lapak desa.
      </div>
    @endforelse
  </div>
</div>
@endsection