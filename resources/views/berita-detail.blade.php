@extends('layouts.app')

@section('title', 'Detail Artikel')

@section('content')

    <div class="container mx-auto px-4 py-12 max-w-4xl" data-aos="fade-up">

        {{-- Branding --}}
        <div class="flex justify-center mb-8">
            <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan"
                class="w-24 h-24 object-contain filter drop-shadow-md">
        </div>

        {{-- Back Button --}}
        <div class="mb-10 text-center">
            <a href="{{ route('news') }}"
                class="inline-flex items-center gap-2 text-emerald-800 hover:text-emerald-900 font-medium transition hover:underline">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Daftar Artikel
            </a>
        </div>

        {{-- Header/Image Hero --}}
        @if ($article->image)
            <div class="relative mb-8 rounded-2xl overflow-hidden shadow-lg border-2 border-emerald-200 group">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                    class="w-full h-80 object-cover group-hover:scale-105 transition-transform duration-500 cursor-pointer"
                    onclick="openImageModal('{{ asset('storage/' . $article->image) }}')">
                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent opacity-50"></div>
                <h1 class="absolute bottom-4 left-4 text-white text-3xl sm:text-4xl font-serif font-bold drop-shadow-lg">
                    {{ $article->title }}
                </h1>
            </div>
        @else
            <div class="mb-6 text-center">
                <h1 class="text-4xl font-serif font-bold text-emerald-900 mb-3 tracking-wide">
                    {{ $article->title }}
                </h1>
            </div>
        @endif

        {{-- Metadata --}}
        <div class="flex flex-col sm:flex-row justify-center items-center gap-4 text-sm text-gray-600 mb-8">
            <span class="px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full font-semibold uppercase tracking-wide">
                {{ $article->category }}
            </span>
            <span class="italic">{{ \Carbon\Carbon::parse($article->date)->translatedFormat('d F Y') }}</span>
        </div>

        {{-- Article Content --}}
        <article
            class="prose prose-emerald mx-auto bg-white p-8 rounded-2xl border border-gray-200 shadow-sm leading-relaxed font-serif">
            {!! $article->content !!}
            {{-- Share Buttons --}}
            <div class="mt-12 flex justify-end items-center gap-4">
                <span class="text-gray-600 font-medium">Bagikan:</span>
    
                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank"
                    class="text-gray-500 hover:text-blue-600 transition-transform transform hover:scale-110">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22.675 0h-21.35C.6 0 0 .6 0 1.35v21.3C0 23.4.6 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.894-4.788 4.659-4.788 1.325 0 2.466.1 2.797.143v3.24l-1.919.001c-1.504 0-1.796.715-1.796 1.763v2.31h3.588l-.467 3.622h-3.121V24h6.116c.725 0 1.325-.6 1.325-1.35v-21.3C24 .6 23.4 0 22.675 0z" />
                    </svg>
                </a>
    
                {{-- Instagram --}}
                <a href="https://www.instagram.com/yourusername" target="_blank"
                    class="text-gray-500 hover:text-pink-500 transition-transform transform hover:scale-110">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75 20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25 3.5h-8.5zM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zm5.25-.75a.75.75 0 1 1 0 1.5.75.75 0 0 1 0-1.5z" />
                    </svg>
                </a>
    
                {{-- Copy to Clipboard --}}
                <button onclick="copyToClipboard()"
                    class="text-gray-500 hover:text-yellow-500 transition-transform transform hover:scale-110">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M16 1H4a2 2 0 0 0-2 2v14h2V3h12V1zm3 4H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2zm0 16H8V7h11v14z" />
                    </svg>
                </button>
    
                <script>
                    function copyToClipboard() {
                        const url = "{{ request()->fullUrl() }}";
                        navigator.clipboard.writeText(url).then(() => {
                            alert('URL berhasil disalin ke clipboard!');
                        }).catch(err => {
                            alert('Gagal menyalin URL');
                            console.error('Clipboard error:', err);
                        });
                    }
                </script>
    
    
                {{-- Twitter/X --}}
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}"
                    target="_blank" class="text-gray-500 hover:text-blue-400 transition-transform transform hover:scale-110">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M22.46 6c-.77.35-1.6.59-2.46.7a4.3 4.3 0 0 0 1.88-2.38 8.59 8.59 0 0 1-2.73 1.04 4.28 4.28 0 0 0-7.3 3.9A12.14 12.14 0 0 1 3.14 4.8a4.28 4.28 0 0 0 1.33 5.7 4.22 4.22 0 0 1-1.94-.54v.05a4.29 4.29 0 0 0 3.44 4.2 4.29 4.29 0 0 1-1.93.07 4.29 4.29 0 0 0 4 2.97 8.6 8.6 0 0 1-5.33 1.84A8.79 8.79 0 0 1 2 19.54a12.13 12.13 0 0 0 6.56 1.92c7.88 0 12.2-6.53 12.2-12.2v-.56A8.72 8.72 0 0 0 24 5.15a8.58 8.58 0 0 1-2.54.7z" />
                    </svg>
                </a>
    
                {{-- WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->fullUrl()) }}" target="_blank"
                    class="text-gray-500 hover:text-green-500 transition-transform transform hover:scale-110">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 32 32">
                        <path
                            d="M16.002 3.2c-7.084 0-12.802 5.718-12.802 12.802 0 2.25.59 4.45 1.708 6.385L3.2 28.8l6.603-1.724c1.848 1.01 3.93 1.547 6.198 1.547h.001c7.084 0 12.802-5.718 12.802-12.802 0-3.418-1.332-6.634-3.75-9.05s-5.634-3.75-9.052-3.75zm0 23.2c-1.896 0-3.753-.507-5.378-1.463l-.385-.224-3.917 1.023 1.05-3.85-.25-.396a10.393 10.393 0 01-1.652-5.65c0-5.722 4.66-10.382 10.382-10.382 2.778 0 5.387 1.08 7.345 3.038s3.04 4.567 3.04 7.345c0 5.722-4.66 10.382-10.385 10.382z" />
                        <path
                            d="M21.747 18.515c-.337-.168-2.002-.987-2.312-1.098-.31-.112-.537-.168-.765.168-.225.336-.878 1.098-1.075 1.322-.196.224-.393.252-.73.084-.336-.168-1.417-.522-2.7-1.667-1-.894-1.676-2.001-1.874-2.337-.196-.336-.021-.518.147-.686.15-.149.337-.393.504-.589.168-.196.224-.336.337-.56.112-.225.056-.42-.028-.588-.084-.168-.765-1.854-1.05-2.53-.276-.658-.56-.568-.765-.578l-.65-.01c-.224 0-.588.084-.896.42s-1.177 1.15-1.177 2.805 1.205 3.249 1.374 3.474c.168.224 2.37 3.627 5.746 5.083.803.345 1.428.552 1.915.707.805.256 1.538.22 2.117.134.645-.096 1.978-.808 2.258-1.587.28-.78.28-1.45.196-1.586-.084-.14-.31-.224-.646-.392z" />
                    </svg>
                </a>
            </div>
          </article>
          

        {{-- Penulis --}}
        @if ($article->author_name)
            <div class="flex items-center gap-4 mt-12 p-5 bg-green-50 border border-green-200 rounded-lg shadow-inner">
                @if ($article->author_photo)
                    <img src="{{ asset('storage/' . $article->author_photo) }}" alt="{{ $article->author_name }}"
                        class="w-16 h-16 rounded-full object-cover border-2 border-green-600 shadow">
                @endif
                <div>
                    <p class="text-green-600 text-sm">Ditulis oleh</p>
                    <p class="font-semibold text-gray-900 text-lg">{{ $article->author_name }}</p>
                </div>
            </div>
        @endif
    </div>
    </div>

    {{-- Modal Image --}}
    <div id="imageModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80 backdrop-blur-sm">
        <div class="relative max-w-3xl mx-auto p-4">
            <button onclick="closeImageModal()" class="absolute top-3 right-3 text-white text-3xl font-bold">
                &times;
            </button>
            <img id="modalImage" src="" alt="Detail Gambar"
                class="max-w-full max-h-[75vh] object-contain rounded-lg shadow-2xl border-4 border-white">
        </div>
    </div>

    {{-- Modal Script --}}
    <script>
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modalImg.src = src;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }

        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) closeImageModal();
        });
    </script>

@endsection
