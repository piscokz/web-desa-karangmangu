{{-- resources/views/admin/content/lapak-desa/show.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
  <!-- Gambar Produk -->
  <div class="w-full">
    <img src="{{ asset('storage/' . $village_stall->gambar_produk) }}" alt="Gambar Produk"
         class="w-full h-64 object-cover border-b border-gray-200">
  </div>

  <!-- Konten Produk -->
  <div class="p-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-3">{{ $village_stall->nama_produk }}</h1>

    <h2 class="text-base font-semibold text-gray-800 mb-1">
      Rp {{ $village_stall->harga_produk }},00
    </h2>

    <div class="text-sm text-gray-600 space-y-1 mb-4">
      <p>
        <strong>Pemilik:</strong>
        @if($village_stall->resident)
          <a href="{{ route('lapak_desa.bySeller', $village_stall->resident->id) }}"
             class="text-green-600 hover:underline">
            {{ $village_stall->resident->nama_lengkap }}
          </a>
        @else
          Tidak diketahui
        @endif
      </p>
      <p><strong>No Telepon:</strong> {{ $village_stall->no_telepon }}</p>
      <p><strong>Kategori:</strong> {{ $village_stall->kategori ?? '-' }}</p>
    </div>

    <div>
      <p class="font-semibold text-gray-700 mb-1">Deskripsi:</p>
      <div class="text-sm text-gray-600 leading-relaxed">
        {!! $village_stall->deskripsi !!}
      </div>
    </div>

    <div class="mt-6 flex flex-wrap gap-3">
      <a href="{{ route('lapak_desa.edit', $village_stall->id_produk) }}"
         class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition text-sm">
        Edit Produk
      </a>
      <a href="{{ route('lapak_desa.index') }}"
         class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition text-sm">
        Kembali
      </a>
    </div>
  </div>
</div>
@endsection