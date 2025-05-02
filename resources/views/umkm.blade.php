{{-- resources/views/umkm.blade.php --}}
@extends('layouts.app')

@section('title', 'UMKM Desa Karangmangu')

@section('content')
<section class="bg-gray-50 py-16" x-data="umkm()">
  <div class="max-w-7xl mx-auto px-4 space-y-8">
    
    {{-- Hero --}}
    <div class="text-center space-y-2">
      <h1 class="text-4xl font-extrabold text-gray-800">Jelajahi UMKM Unggulan</h1>
      <p class="text-gray-600">Produk lokal berkualitas, langsung dari Desa Karangmangu.</p>
    </div>

    {{-- Controls --}}
    <div class="flex flex-col lg:flex-row items-center justify-between gap-4">
      {{-- Search --}}
      <div class="relative flex-1">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
          <!-- search icon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
        </span>
        <input
          type="text"
          x-model="query"
          placeholder="Cari produk..."
          class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none"
        >
      </div>

      {{-- Categories --}}
      <div class="flex flex-wrap gap-2 justify-center lg:justify-end">
        <button
          @click="filterCategory('Semua')"
          :class="selected==='Semua'?activeTab:inactiveTab"
          class="px-4 py-2 rounded-full flex items-center space-x-2 text-sm font-medium"
        >
          <span>Semua</span>
        </button>
        <template x-for="cat in categories" :key="cat">
          <button
            @click="filterCategory(cat)"
            :class="selected===cat?activeTab:inactiveTab"
            class="px-4 py-2 rounded-full flex items-center space-x-2 text-sm font-medium"
          >
            <!-- inline SVG icon per kategori -->
            <template x-if="cat==='Makanan'">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600"
                   fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 2a1 1 0 00-1 1v7H5a1 1 0 000 2h3v7a1 1 0 102 0v-7h3a1 1 0 100-2H10V3a1 1 0 00-1-1z"/>
              </svg>
            </template>
            <template x-if="cat==='Kerajinan'">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500"
                   fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 3a1 1 0 000 2h1v10H4a1 1 0 100 2h12a1 1 0 100-2h-1V5h1a1 1 0 100-2H4z"/>
              </svg>
            </template>
            <template x-if="cat==='Fashion'">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500"
                   fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 11V7a4 4 0 00-8 0v4M5 20h14a2 2 0 002-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2z"/>
              </svg>
            </template>
            <template x-if="cat==='Pertanian'">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600"
                   fill="currentColor" viewBox="0 0 20 20">
                <path d="M4 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zM10 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zM16 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1z"/>
              </svg>
            </template>
            <span x-text="cat"></span>
          </button>
        </template>
      </div>
    </div>

    {{-- Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <template x-for="item in filtered" :key="item.id">
        <div class="bg-white rounded-2xl shadow hover:shadow-2xl transition overflow-hidden flex flex-col">
          <div class="relative">
            <img :src="item.image" alt="" class="w-full h-40 object-cover">
            <button class="absolute top-2 right-2 bg-white/75 rounded-full p-1 hover:bg-red-100 transition"
                    @click.prevent>
              <!-- heart icon -->
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500"
                   fill="currentColor" viewBox="0 0 20 20">
                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 18.657l-6.828-6.829a4 4 0 010-5.656z"/>
              </svg>
            </button>
          </div>
          <div class="p-4 flex-1 flex flex-col">
            <h3 class="text-lg font-semibold text-gray-800" x-text="item.name"></h3>
            <p class="text-xs text-gray-500 mb-2" x-text="item.category"></p>
            <div class="flex items-center mb-2">
              <template x-for="i in 5" :key="i">
                <svg xmlns="http://www.w3.org/2000/svg"
                     :class="i <= Math.floor(item.rating) ? 'text-yellow-400' : 'text-gray-300'"
                     class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927C9.329 2.153 10.671 2.153 10.951 2.927l1.286 3.767a1 1 0 00.95.69h3.95c.82 0 1.159 1.014.56 1.54l-3.2 2.385a1 1 0 00-.364 1.118l1.287 3.767c.28.774-.687 1.42-1.395.933l-3.2-2.385a1 1 0 00-1.176 0l-3.2 2.385c-.708.487-1.675-.159-1.395-.933l1.287-3.767a1 1 0 00-.364-1.118L2.957 8.924c-.599-.526-.26-1.54.56-1.54h3.95a1 1 0 00.95-.69l1.286-3.767z"/>
                </svg>
              </template>
              <span class="text-xs text-gray-600 ml-2" x-text="item.rating.toFixed(1)"></span>
            </div>
            <div class="mt-auto flex items-center justify-between">
              <span class="text-xl font-bold text-green-600" x-text="`Rp ${item.price}`"></span>
              <button class="bg-green-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-green-500 transition">
                Beli
              </button>
            </div>
          </div>
        </div>
      </template>

      <div x-show="filtered.length===0" class="col-span-full text-center text-gray-500">
        Tidak ada produk ditemukan.
      </div>
    </div>
  </div>
</section>

<script>
function umkm() {
  return {
    query: '',
    selected: 'Semua',
    categories: ['Makanan','Kerajinan','Fashion','Pertanian'],
    activeTab: 'bg-green-600 text-white',
    inactiveTab: 'bg-white text-gray-700 hover:bg-green-100',
    data: [
      {id:1,name:'Keripik Mangga',   category:'Makanan',    price:'15.000',  rating:4.5, image:'https://picsum.photos/seed/mango/400/300'},
      {id:2,name:'Batik Tulis',       category:'Fashion',    price:'120.000', rating:4.7, image:'https://picsum.photos/seed/batik/400/300'},
      {id:3,name:'Kerajinan Kayu',    category:'Kerajinan',  price:'75.000',  rating:4.2, image:'https://picsum.photos/seed/wood/400/300'},
      {id:4,name:'Bubuk Jamur',       category:'Pertanian',  price:'50.000',  rating:4.0, image:'https://picsum.photos/seed/mushroom/400/300'},
      {id:5,name:'Roti Gula Aren',    category:'Makanan',    price:'20.000',  rating:4.8, image:'https://picsum.photos/seed/roti/400/300'},
      {id:6,name:'Tas Anyaman',       category:'Kerajinan',  price:'90.000',  rating:4.3, image:'https://picsum.photos/seed/bag/400/300'},
      {id:7,name:'Kaos Desa',         category:'Fashion',    price:'100.000', rating:4.6, image:'https://picsum.photos/seed/shirt/400/300'},
      {id:8,name:'Cabai Kering',      category:'Pertanian',  price:'30.000',  rating:4.1, image:'https://picsum.photos/seed/chili/400/300'}
    ],
    get filtered() {
      return this.data.filter(i => {
        const byCat = this.selected==='Semua' || i.category===this.selected;
        return byCat && i.name.toLowerCase().includes(this.query.toLowerCase());
      });
    },
    filterCategory(cat) {
      this.selected = cat;
    }
  }
}
</script>
@endsection