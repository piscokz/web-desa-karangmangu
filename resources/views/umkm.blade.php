{{-- resources/views/umkm.blade.php --}}
@extends('layouts.app')

@section('title', 'Lapak Desa – Desa Karangmangu')

@section('content')
    <section class="bg-green-50 py-16">
        <div class="max-w-6xl mx-auto px-4">
            <h1 class="text-5xl font-extrabold text-center text-green-800 mb-12">
                Lapak Desa Desa Karangmangu
            </h1>

            {{-- Search & Filter --}}
            <div class="flex flex-col md:flex-row items-center justify-between mb-12 gap-4">
                <div class="relative w-full md:w-1/2">
                    <input id="searchInput" type="text" placeholder="🔍 Cari produk..."
                        class="w-full py-3 pl-12 pr-4 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-200 transition" />
                    <div class="absolute inset-y-0 left-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative w-full md:w-1/4">
                    <select id="categoryFilter"
                        class="appearance-none w-full py-3 pl-4 pr-10 rounded-lg border border-green-300 focus:outline-none focus:ring-2 focus:ring-green-200 transition text-gray-700">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ Str::slug($cat) }}">{{ $cat }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Products Grid --}}
            <div id="stallsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($stalls as $stall)
                    @php
                        $slugCat = Str::slug($stall->kategori ?? 'umum');
                        $shortHtml = Str::limit(strip_tags($stall->deskripsi), 100, '...');
                        $phone = preg_replace('/\D/', '', $stall->no_telepon);
                        if (Str::startsWith($phone, '0')) {
                            $phone = '62' . substr($phone, 1);
                        }
                        $waLink = $phone
                            ? "https://wa.me/{$phone}?text=" .
                                urlencode("Halo, saya tertarik dengan produk {$stall->nama_produk}")
                            : '#';
                    @endphp

                    <div class="stall-card group bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-1"
                        data-name="{{ Str::lower($stall->nama_produk) }}" data-category="{{ $slugCat }}">

                        <div class="relative overflow-hidden">
                            @if ($stall->gambar_produk)
                                <img src="{{ asset('storage/' . $stall->gambar_produk) }}" alt="{{ $stall->nama_produk }}"
                                    class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-500" />
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400">
                                    No Image
                                </div>
                            @endif
                            <span
                                class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded-full text-xs uppercase">
                                {{ $stall->kategori ?? 'Umum' }}
                            </span>
                        </div>

                        <div class="p-6 flex flex-col h-64 justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 line-clamp-2">
                                    {{ Str::limit($stall->nama_produk, 30) }}
                                </h2>
                                <p class="text-gray-600 text-sm mt-2 line-clamp-3">{!! $shortHtml !!}</p>
                            </div>

                            <div class="mt-4 space-y-2">
                                <div>
                                    <span class="font-medium">Penjual:</span>
                                    @if ($stall->resident)
                                        <a href="{{ route('lapak_desa.bySellery', $stall->resident->id) }}"
                                            class="text-green-600 hover:underline">
                                            {{ $stall->resident->nama_lengkap }}
                                        </a>
                                    @else
                                        <span>Tidak diketahui</span>
                                    @endif
                                </div>

                                <div class="text-sm text-gray-700">
                                    <span class="font-medium">Telepon:</span>
                                    {{ $stall->no_telepon }}
                                </div>

                            </div>
                            <div
                                class="mt-4 flex justify-between items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 space-x-2">
                                <a href="{{ $waLink }}" target="_blank"
                                    class="flex-1 text-center bg-green-600 text-white py-2 rounded-full text-sm font-semibold hover:bg-green-700 transition">
                                    WhatsApp
                                </a>
                                <a href="{{ route('lapak_desa.showed', $stall->id_produk) }}"
                                    class="flex-1 text-center bg-white border border-green-600 text-green-600 py-2 rounded-full text-sm font-semibold hover:bg-green-600 hover:text-white transition">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>

                @empty
                    <div id="noResults" class="col-span-full text-center text-gray-500 text-lg font-medium">
                        😢 Belum ada produk yang sesuai.
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex justify-center">
                {{ $stalls->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            const categoryFilter = document.getElementById('categoryFilter');
            const cards = document.querySelectorAll('.stall-card');
            const noRes = document.getElementById('noResults');

            function filterStalls() {
                const q = searchInput.value.trim().toLowerCase();
                const cat = categoryFilter.value;
                let visible = 0;

                cards.forEach(card => {
                    const name = card.dataset.name;
                    const c = card.dataset.category;
                    const okName = !q || name.includes(q);
                    const okCat = !cat || c === cat;

                    if (okName && okCat) {
                        card.style.display = '';
                        visible++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                if (noRes) {
                    noRes.style.display = visible > 0 ? 'none' : '';
                }
            }

            // Bind events
            searchInput.addEventListener('input', filterStalls);
            categoryFilter.addEventListener('change', filterStalls);

            // Inisialisasi filter pada load
            filterStalls();
        });
    </script>
@endsection