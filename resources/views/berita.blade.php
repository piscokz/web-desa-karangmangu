@extends('layouts.app')

@section('title', 'Berita Desa – Kelurahan Winduherang')

@section('content')
<section class="bg-green-50 py-16">
  <div class="max-w-6xl mx-auto px-4">
    <h1 class="text-5xl font-extrabold text-center text-green-800 mb-12">Berita Desa</h1>

    {{-- Search & Filter --}}
    <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-4">
      <div class="relative w-full md:w-1/2">
        <input 
          id="searchInput"
          type="text"
          placeholder="Cari berita..."
          class="w-full py-3 pl-12 pr-4 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-200 transition"
        />
        <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </div>
      </div>
      <div class="relative w-full md:w-1/4">
        <select id="categoryFilter"
                class="appearance-none w-full py-3 pl-4 pr-10 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-200 transition text-gray-700">
          <option value="">Semua Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat }}"{{ request('category') == $cat ? ' selected' : '' }}>
              {{ $cat }}
            </option>
          @endforeach
        </select>
        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7"/>
          </svg>
        </div>
      </div>
    </div>

    {{-- News Grid --}}
    <div id="articlesGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @forelse($articles as $idx => $item)
        <a href="{{ route('article.show', $item->id) }}"
           class="article-card group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1"
           data-title="{{ Str::lower($item->title) }}"
           data-category="{{ $item->category }}">
          <div class="relative overflow-hidden">
            <img src="{{ $item->image ? asset('storage/'.$item->image) : 'https://via.placeholder.com/600x400' }}"
                 alt="{{ $item->title }}"
                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />
            <span class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded-full text-xs uppercase">
              {{ $item->category }}
            </span>
            <span class="absolute top-4 right-4 bg-white bg-opacity-80 text-gray-800 px-3 py-1 rounded-full text-xs">
              {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
            </span>
          </div>
          <div class="p-6 flex flex-col h-48 justify-between">
            <h2 class="text-lg font-semibold text-gray-800 line-clamp-2">{{ Str::limit($item->title, 30) }}</h2>
            <p class="text-gray-600 text-sm mt-2 line-clamp-3">
              {{ Str::limit(strip_tags($item->content), 100) }}
            </p>
            <div class="mt-4 flex justify-between items-center">
              <span class="text-green-700 font-semibold hover:underline">Baca Detail &rarr;</span>
              <div class="flex items-center gap-2">
                <img src="{{ $item->author_photo ? asset('storage/'.$item->author_photo) : 'https://via.placeholder.com/40' }}" 
                     alt="{{ $item->author_name }}" 
                     class="w-8 h-8 rounded-full object-cover">
                <span class="text-sm text-gray-600">{{ $item->author_name }}</span>
              </div>
            </div>
          </div>
        </a>
      @empty
        <div id="noResults" class="col-span-full text-center text-gray-500 text-lg font-medium">
          😢 Tidak ada berita yang sesuai.
        </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12 flex justify-center">
      {{ $articles->links() }}
    </div>
  </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const searchInput    = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const cards          = document.querySelectorAll('.article-card');
    const noRes          = document.getElementById('noResults');

    function filterArticles() {
      const q   = searchInput.value.trim().toLowerCase();
      const cat = categoryFilter.value;
      let visible = 0;

      cards.forEach(card => {
        const title    = card.dataset.title;
        const category = card.dataset.category;
        const okText   = !q || title.includes(q);
        const okCat    = !cat || category === cat;

        if (okText && okCat) {
          card.style.display = '';
          visible++;
        } else {
          card.style.display = 'none';
        }
      });

      if (noRes) {
        noRes.style.display = (visible > 0 ? 'none' : '');
      }
    }

    searchInput.addEventListener('input',   filterArticles);
    categoryFilter.addEventListener('change', filterArticles);
  });
</script>
@endsection