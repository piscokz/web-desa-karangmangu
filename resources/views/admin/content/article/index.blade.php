{{-- resources/views/admin/article/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Kelola Berita Desa')

@section('content')
<div class="container mx-auto px-4 py-8">
  {{-- Header --}}
  <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8" data-aos="fade-up">
    <h1 class="text-4xl font-extrabold text-[#14532d] mb-4 md:mb-0">Kelola Berita Desa</h1>
    <a href="{{ route('admin.article.create') }}"
       class="inline-flex items-center gap-2 bg-[#14532d] hover:bg-[#22c55e] text-white font-semibold px-5 py-3 rounded-lg shadow-lg transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
      </svg>
      Buat Berita
    </a>
  </div>

{{-- Search & Filter --}}
<form method="GET" action="{{ route('admin.article.index') }}"
      class="flex flex-wrap items-center gap-4 mb-8" data-aos="fade-up" data-aos-delay="100">
  {{-- Input Search --}}
  <div class="relative w-full sm:w-64">
    <input
      type="text"
      name="search"
      value="{{ request('search') }}"
      placeholder="Cari judul berita..."
      class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#14532d] transition"
    />
    <div class="absolute left-3 top-1/2 transform -translate-y-1/2 flex items-center pointer-events-none">
      <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <circle cx="11" cy="11" r="8" />
        <line x1="21" y1="21" x2="16.65" y2="16.65" />
      </svg>
    </div>
  </div>

{{-- Filter Kategori --}}
<div class="relative w-full sm:w-48">
    <select name="category"
            class="appearance-none w-full pl-4 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#14532d] transition text-gray-700">
      <option value="">-- Semua Kategori --</option>
      @foreach($categories as $cat)
        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
      @endforeach
    </select>
  
    <div class="pointer-events-none absolute right-3 top-1/2 transform -translate-y-1/2 flex items-center">
      <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
           viewBox="0 0 24 24" stroke="currentColor">
        <path d="M19 9l-7 7-7-7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
      </svg>
    </div>
  </div>
  

  <button type="submit"
          class="bg-[#14532d] hover:bg-[#22c55e] text-white font-semibold px-5 py-2 rounded-lg transition">
    Filter
  </button>
</form>


  {{-- Success Message --}}
  @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded" data-aos="fade-up" data-aos-delay="150">
      {{ session('success') }}
    </div>
  @endif

  {{-- Articles Table --}}
  <div class="overflow-x-auto bg-white rounded-lg shadow" data-aos="fade-up" data-aos-delay="200">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-[#14532d]">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Judul</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Kategori</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">Tanggal</th>
          <th class="px-6 py-3 text-right text-xs font-medium text-white uppercase tracking-wider">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-gray-100">
        @forelse($articles as $article)
          <tr class="hover:bg-gray-50">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $article->title }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $article->category }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($article->date)->format('d M Y') }}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-right space-x-2">
              <a href="{{ route('admin.article.show', $article) }}"
                 class="text-[#14532d] hover:underline">Lihat</a>
              <a href="{{ route('admin.article.edit', $article) }}"
                 class="text-[#22c55e] hover:underline">Ubah</a>
              <form action="{{ route('admin.article.destroy', $article) }}" method="POST" class="inline"
                    onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-4 text-center text-gray-500">Belum ada berita.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination --}}
  <div class="mt-4 flex justify-center">
    {{ $articles->links('vendor.pagination.tailwind') }}
  </div>
</div>
@endsection