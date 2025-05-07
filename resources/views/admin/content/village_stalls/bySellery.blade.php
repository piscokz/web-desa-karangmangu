{{-- resources/views/content/village_stalls/bySeller.blade.php --}}
@extends('layouts.app')

@section('title', "Produk milik {$resident->nama_lengkap}")

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
  {{-- Header --}}
  <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">
      🌾 Produk milik: <span class="text-emerald-700">{{ $resident->nama_lengkap }}</span>
    </h1>
    <a href="{{ route('umkm') }}" class="text-sm text-gray-600 hover:underline">
      ← Semua Produk
    </a>
  </div>

  {{-- Filter & Search --}}
  <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-6">
    {{-- Search --}}
    <input id="searchInput"
           type="text"
           placeholder="🔍 Cari nama produk..."
           class="flex-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200"
    />

    {{-- Category --}}
    <select id="categorySelect"
            class="w-full sm:w-64 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-200">
      <option value="">Semua Kategori</option>
      @foreach($categories as $cat)
        <option value="{{ $cat }}">{{ $cat }}</option>
      @endforeach
    </select>
  </div>

  {{-- Responsive Table --}}
  <div class="overflow-x-auto bg-white rounded-lg shadow">
    <table id="stallsTable" class="min-w-full divide-y divide-gray-200">
      <thead class="bg-emerald-100">
        <tr>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Gambar</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Produk</th>
          <th class="px-4 py-2 text-left text-xs font-medium text-gray-700 uppercase">Kategori</th>
          <th class="px-4 py-2 text-right text-xs font-medium text-gray-700 uppercase">Harga</th>
          <th class="px-4 py-2 text-center text-xs font-medium text-gray-700 uppercase">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($stalls as $item)
        <tr class="hover:bg-gray-50"
            data-name="{{ Str::lower($item->nama_produk) }}"
            data-cat="{{ $item->kategori }}">
          <td class="px-4 py-3 whitespace-nowrap">
            @if($item->gambar_produk)
              <img src="{{ asset('storage/'.$item->gambar_produk) }}"
                   alt="Gambar Produk"
                   class="h-16 w-16 rounded object-cover mx-auto" />
            @else
              <div class="h-16 w-16 bg-gray-200 rounded mx-auto"></div>
            @endif
          </td>
          <td class="px-4 py-3 whitespace-nowrap text-gray-800">{{ $item->nama_produk }}</td>
          <td class="px-4 py-3 whitespace-nowrap text-gray-600">{{ $item->kategori ?? '-' }}</td>
          <td class="px-4 py-3 whitespace-nowrap text-right font-semibold text-gray-800">Rp {{ $item->harga_produk }}</td>
          <td class="px-4 py-3 whitespace-nowrap text-center space-x-2">
            <a href="{{ route('lapak_desa.show', $item->id_produk) }}"
               class="text-sm text-blue-600 hover:underline">Detail</a>
            </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" class="px-4 py-6 text-center text-gray-500">
            😢 Belum ada produk.
          </td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const searchInput   = document.getElementById('searchInput');
    const categorySelect = document.getElementById('categorySelect');
    const rows = document.querySelectorAll('#stallsTable tbody tr');

    function filterTable() {
      const term = searchInput.value.trim().toLowerCase();
      const cat  = categorySelect.value;
      rows.forEach(row => {
        const name = row.dataset.name;
        const category = row.dataset.cat;
        const matchName = !term || name.includes(term);
        const matchCat  = !cat  || category === cat;
        row.style.display = (matchName && matchCat) ? '' : 'none';
      });
    }

    searchInput.addEventListener('input', filterTable);
    categorySelect.addEventListener('change', filterTable);
  });
</script>
@endsection