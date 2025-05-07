{{-- resources/views/content/lapak-desa/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white border border-gray-200 rounded-2xl shadow-md overflow-hidden">
  <!-- Gambar Produk -->
  <div class="w-full">
    <img src="{{ asset('storage/' . $village_stall->gambar_produk) }}" alt="Gambar Produk"
         class="w-full h-72 object-cover border-b border-gray-200">
  </div>

  <!-- Konten Produk -->
  <div class="p-6 space-y-4">
    <!-- Nama Produk -->
    <h1 class="text-2xl font-bold text-gray-800">{{ $village_stall->nama_produk }}</h1>

    <!-- Harga dan Kategori -->
    <div class="flex items-center justify-between flex-wrap gap-2">
      <div class="text-2xl text-green-600 font-semibold">Rp{{  $village_stall->harga_produk }},00</div>
      <span class="inline-block bg-green-100 text-green-700 text-xs font-medium px-3 py-1 rounded-full">
        {{ $village_stall->kategori ?? 'Tanpa Kategori' }}
      </span>
    </div>

    <!-- Info Pemilik -->
    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 space-y-1">
      <p class="text-sm text-gray-600">
        <strong>Pemilik:</strong>
        @if($village_stall->resident)
          <a href="{{ route('lapak_desa.bySeller', $village_stall->resident->id) }}" class="text-green-700 font-medium hover:underline">
            {{ $village_stall->resident->nama_lengkap }}
          </a>
        @else
          Tidak diketahui
        @endif
      </p>
      <p class="text-sm text-gray-600"><strong>No Telepon:</strong> {{ $village_stall->no_telepon }}</p>
    </div>

    <!-- Deskripsi -->
    <div>
      <h2 class="text-sm font-semibold text-gray-700 mb-1">Deskripsi Produk:</h2>
      <div class="text-sm text-gray-700 leading-relaxed prose max-w-none">
        {!! $village_stall->deskripsi !!}
      </div>
    </div>

    <!-- Tombol Aksi -->
    <div class="pt-4 flex flex-wrap gap-3">
      <a href="{{ route('umkm') }}"
         class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition text-sm shadow-sm">
        ← Kembali ke Daftar
      </a>
    </div>
  </div>
</div>
@endsection