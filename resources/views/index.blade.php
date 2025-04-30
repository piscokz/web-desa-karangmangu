{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelurahan Winduherang')

@section('content')
    <!-- Hero Slider Section -->
    <section x-data="{
        slides: [
            'https://picsum.photos/1200/600?random=1',
            'https://picsum.photos/1200/600?random=2',
            'https://picsum.photos/1200/600?random=3'
        ],
        current: 0,
        init() { this.auto = setInterval(this.next, 5000) },
        next() { this.current = (this.current + 1) % this.slides.length },
        prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length },
        go(i) { this.current = i }
    }" x-init="init()" class="relative h-screen overflow-hidden font-sans">
        <!-- Slides -->
        <template x-for="(src, i) in slides" :key="i">
            <div x-show="current === i" class="absolute inset-0 bg-cover bg-center transition-opacity duration-700"
                :style="`background-image:url(${src});`"></div>
        </template>

        <!-- Overlay -->
        <div
            class="absolute inset-0 bg-black bg-opacity-60 flex flex-col items-center justify-center text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">
                Wilujeng Sumping di <span class="text-green-400">Kelurahan Winduherang</span>
            </h1>
            <p class="text-lg md:text-2xl mb-6 italic">Ngawilujengkeun kadatangan anjeun ka lembur nu rahayu</p>

            <!-- Navigation Buttons -->
            <div class="flex items-center space-x-4">
                <button @click="prev()"
                    class="p-3 bg-green-600 rounded-full hover:bg-green-500 transform hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next()"
                    class="p-3 bg-green-600 rounded-full hover:bg-green-500 transform hover:scale-110 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Pagination Dots -->
            <div class="flex space-x-2 mt-8">
                <template x-for="(_, i) in slides" :key="i">
                    <button class="w-3 h-3 rounded-full transition"
                        :class="i === current ? 'bg-white scale-110' : 'bg-white bg-opacity-50 hover:scale-110'"
                        @click="go(i)"></button>
                </template>
            </div>
        </div>
    </section>


    <!-- Biografi / Sambutan Lurah -->
    <section class="py-16 bg-green-50 relative overflow-hidden">

        <!-- Ornamen SVG Latar -->
        <svg class="absolute top-0 left-0 opacity-10 w-96 h-96 text-green-100 -z-10" fill="none" viewBox="0 0 500 500">
            <path fill="currentColor"
                d="M437.5,123.1c33.3,48.1,45.4,118.8,6.1,173.1s-130.4,87.1-210.4,79.1s-153.6-53.8-187.5-108.2S2.7,123.5,68.8,67.5S404.2,75,437.5,123.1z" />
        </svg>

        <!-- Garis-garis dekoratif -->
        <div class="absolute top-0 left-0 w-1 h-full bg-green-100"></div>
        <div class="absolute top-0 right-0 w-1 h-full bg-green-100"></div>
        <div class="absolute top-10 left-10 w-24 h-1 bg-gradient-to-r from-green-600 to-green-300 rounded-full"></div>
        <div class="absolute top-20 left-10 w-16 h-1 bg-green-600 rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-24 h-1 bg-gradient-to-l from-green-600 to-green-300 rounded-full"></div>
        <div class="absolute bottom-20 right-10 w-16 h-1 bg-green-600 rounded-full"></div>

        <div class="max-w-6xl mx-auto px-4 flex flex-col lg:flex-row items-start gap-10 relative z-10">

            <!-- Foto Lurah -->
            <div class="lg:w-1/3 w-full flex justify-center">
                <img src="{{ asset('images/FotoLurah.jpg') }}" alt="Foto Lurah"
                    class="rounded-xl shadow-xl object-cover w-full max-w-xs border-4 border-green-200 animate-fade-in">
            </div>

            <!-- Sambutan Teks -->
            <div class="lg:w-2/3 w-full space-y-6 animate-fade-in">
                <div class="flex items-center gap-2">
                    <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-600 pb-2 inline-block relative">
                        Sambutan Lurah Winduherang
                        <span class="absolute -bottom-1 left-0 w-12 h-1 bg-green-300"></span>
                    </h2>
                    <span
                        class="ml-2 inline-block bg-green-100 text-green-700 text-xs font-semibold px-2 py-1 rounded-full shadow-sm">#PelayananPrima</span>
                </div>

                <div class="space-y-4 text-gray-800 leading-relaxed">
                    <p><strong>Assalamu’alaikum warahmatullahi wabarakatuh</strong></p>
                    <p>Selamat Datang di “Website Kelurahan Winduherang“. Salam sejahtera bagi kita semua.</p>
                    <p>
                        Kepada masyarakat Kelurahan Winduherang sekalian yang saya banggakan. Pada kesempatan yang
                        berbahagia
                        ini, kiranya tiada kata-kata yang patut untuk kita ucapkan terlebih dahulu melainkan puji syukur
                        yang sedalam-dalamnya, atas rahmat dan karunia Allah SWT sehingga pembuatan website Kelurahan
                        Winduherang dapat terlaksana dengan baik.
                    </p>

                    <!-- Konten tersembunyi -->
                    <div id="sambutanHidden" class="hidden space-y-4">
                        <p>
                            Website ini kami hadirkan secara mandiri untuk mengikuti perkembangan dunia Teknologi Informasi
                            (IT) yang kian pesat. Lahir dari sebuah ide kreatif dan inovatif, serta merupakan sebuah
                            terobosan atas hasil kolaborasi kami dengan Inovindo Digital Media untuk lebih mendekatkan diri
                            kepada masyarakat luas.
                        </p>
                        <p>
                            Melalui website ini kami berupaya agar informasi tentang Kelurahan Winduherang menjadi lebih
                            terbuka dan interaktif. Profil, kegiatan dan program kelurahan serta jenis dan prosedur
                            pelayanan dapat diakses oleh masyarakat secara langsung dan cepat.
                        </p>
                        <p>
                            Sebagai Lurah Kelurahan Winduherang, kami mengajak kepada masyarakat Kelurahan Winduherang untuk
                            ikut pula berpartisipasi menyumbangkan ide, kreasi dan informasinya agar website ini menarik
                            minat pembaca dan menunjang kami untuk memperkenalkan potensi-potensi yang ada di Kelurahan
                            Winduherang kepada daerah lain.
                        </p>
                        <p>
                            Kami sampaikan terima kasih kepada semua pihak yang telah banyak memberikan bantuan, dukungan
                            dan kontribusi, baik berupa tenaga, pemikiran dan dorongan semangat, hingga Website ini dapat
                            terealisasi.
                        </p>
                        <p>
                            Semoga dengan adanya Website Kelurahan Winduherang ini dapat bermanfaat dan menjadi salah satu
                            upaya peningkatan pelayanan desa. Namun disadari bahwa upaya kami ini masih jauh dari
                            kesempurnaan. Untuk itu kritik, saran, dan masukan yang konstruktif, kreatif dan inovatif sangat
                            kami nantikan demi penyempurnaan website ini.
                        </p>
                        <p><strong>Wassalamu’alaikum warahmatullahi wabarakatuh</strong></p>
                        <p class="font-semibold text-green-800">Lurah Kelurahan Winduherang<br>H. Ikin Sodikin, S.Sn</p>
                    </div>

                    <!-- Tombol -->
                    <button onclick="toggleSambutan()" id="toggleButton"
                        class="text-green-700 font-semibold mt-2 inline-flex items-center hover:text-green-900 transition duration-200">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M10 3a1 1 0 01.894.553l5 10a1 1 0 01-.894 1.447H5a1 1 0 01-.894-1.447l5-10A1 1 0 0110 3z" />
                        </svg>
                        <span>Baca Selengkapnya</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Script Toggle -->
        <script>
            function toggleSambutan() {
                const hidden = document.getElementById("sambutanHidden");
                const button = document.getElementById("toggleButton");

                hidden.classList.toggle("hidden");
                button.querySelector("span").innerText = hidden.classList.contains("hidden") ? "Baca Selengkapnya" : "Tutup";
            }
        </script>
    </section>


    {{-- resources/views/partials/berita_section.blade.php --}}
    @php
        use App\Models\Article;
        // ambil 3 berita terbaru berdasarkan kolom `date`
        $latestArticles = Article::orderByDesc('date')->take(3)->get();
    @endphp

    <section class="bg-gray-50 border-t border-green-200 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-bold text-center text-green-800 mb-16 relative inline-block">
                Berita Desa
                <span class="block w-20 h-1 bg-green-300 mt-2 mx-auto rounded-full"></span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach ($latestArticles as $idx => $article)
                    <a href="{{ route('article.show', $article) }}" data-aos="fade-up" data-aos-delay="{{ $idx * 100 }}"
                        class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group block">

                        {{-- Thumbnail --}}
                        <div class="relative">
                            <img src="{{ $article->image ? asset('storage/' . $article->image) : 'https://via.placeholder.com/600x400' }}"
                                alt="{{ $article->title }}"
                                class="w-full h-52 object-cover transition-transform duration-300 group-hover:scale-105">
                            <div
                                class="absolute bottom-2 left-2 bg-green-700 text-white text-xs px-3 py-1 rounded-full shadow">
                                {{ \Carbon\Carbon::parse($article->date)->format('d M Y') }}
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 space-y-3">
                            <span
                                class="inline-block text-xs font-medium uppercase tracking-wide text-green-700 bg-green-100 px-2 py-1 rounded-full">
                                {{ $article->category }}
                            </span>
                            <h4 class="text-lg font-semibold text-gray-800 group-hover:text-green-700 transition-colors">
                                {{ \Illuminate\Support\Str::limit($article->title, 50) }}
                            </h4>

                            <div class="text-gray-600 text-sm leading-relaxed prose max-w-none">
                                {!! \Illuminate\Support\Str::limit($article->content, 200) !!}
                            </div>

                            <div class="mt-4">
                                <span
                                    class="text-green-700 font-medium inline-flex items-center hover:underline transition">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- resources/views/partials/galeri_alam.blade.php --}}
    @php
        use App\Models\GalleryItem;
        $latestItems = GalleryItem::orderByDesc('date')->take(4)->get();
    @endphp

    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <h3 class="text-3xl md:text-4xl font-semibold text-center text-green-700 mb-14 tracking-tight"
                data-aos="fade-up">
                Galeri Kegiatan Alam Desa
                <span class="block w-24 h-1 bg-green-300 mt-4 mx-auto rounded-full"></span>
            </h3>

            {{-- 4‑column grid, always one row --}}
            <div class="grid grid-cols-4 gap-6">
                @foreach ($latestItems as $loopIndex => $item)
                    <div class="group relative overflow-hidden rounded-2xl border border-green-200 bg-white shadow transition transform hover:scale-105 hover:shadow-lg hover:border-green-400 cursor-pointer"
                        data-aos="zoom-in" data-aos-delay="{{ ($loopIndex + 1) * 100 }}"
                        onclick="openModal('{{ $item->image_url }}', '{{ addslashes($item->title) }}', '{{ $item->date->format('d M Y') }}')">
                        {{-- Thumbnail --}}
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                            class="w-full h-44 object-cover transition-transform duration-300 group-hover:scale-110">

                        {{-- Caption overlay --}}
                        <div
                            class="absolute bottom-0 w-full bg-green-50 bg-opacity-90 px-3 py-2 text-center text-green-800 text-sm font-semibold backdrop-blur-md">
                            🌿 {{ $item->title }} — {{ $item->date->format('d M Y') }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Modal --}}
        <div id="galleryModal"
            class="fixed inset-0 bg-black bg-opacity-70 backdrop-blur-sm flex items-center justify-center hidden z-50 px-4 py-8 overflow-y-auto">
            <div
                class="relative bg-white rounded-2xl shadow-2xl w-full max-w-3xl overflow-hidden animate__animated animate__zoomIn">
                <!-- Close Button -->
                <button onclick="closeModal()"
                    class="absolute top-4 right-4 text-gray-400 hover:text-red-600 text-3xl leading-none font-bold focus:outline-none">
                    &times;
                </button>
                <!-- Modal Image -->
                <img id="modalImage" src="" alt="Detail"
                    class="w-full h-[40vh] sm:h-[50vh] md:h-[60vh] object-cover bg-gray-100">
                <!-- Caption -->
                <div class="p-6 bg-green-50">
                    <h3 id="modalTitle" class="text-2xl font-semibold text-green-800 text-center mb-2"></h3>
                    <p id="modalDate" class="text-center text-gray-600"></p>
                </div>
            </div>
        </div>
    </section>

    <script>
        function openModal(src, title, date) {
            document.getElementById('modalImage').src = src;
            document.getElementById('modalTitle').textContent = title;
            document.getElementById('modalDate').textContent = date;
            document.getElementById('galleryModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function closeModal() {
            document.getElementById('galleryModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        // click outside to close
        document.getElementById('galleryModal').addEventListener('click', e => {
            if (e.target.id === 'galleryModal') closeModal();
        });
    </script>



    @php
        $locations = [
            // Kantor & umum
            ['name' => 'Kantor Desa Winduherang', 'coords' => [-6.989075, 108.456295], 'cat' => 'office'],
            ['name' => 'Lapangan Bola Winduherang', 'coords' => [-6.98685, 108.45789], 'cat' => 'public'],

            // Pendidikan
            ['name' => 'PAUD Permata Hati', 'coords' => [-6.9898, 108.4565], 'cat' => 'edu'],
            ['name' => 'TK Al-Ikhlas Winduherang', 'coords' => [-6.99, 108.456], 'cat' => 'edu'],
            ['name' => 'SD Negeri Winduherang I', 'coords' => [-6.9905, 108.4572], 'cat' => 'edu'],
            ['name' => 'SD Negeri Winduherang II', 'coords' => [-6.98922, 108.45741], 'cat' => 'edu'],
            ['name' => 'SD Negeri Winduherang III', 'coords' => [-6.9899, 108.4576], 'cat' => 'edu'],
            ['name' => 'SMP Negeri 1 Winduherang', 'coords' => [-6.991, 108.4575], 'cat' => 'edu'],
            ['name' => 'SMA Negeri 1 Winduherang', 'coords' => [-6.992, 108.4578], 'cat' => 'edu'],

            // Ibadah
            ['name' => 'Masjid At-Taufik (Islamic Centre)', 'coords' => [-6.988468, 108.456034], 'cat' => 'worship'],
            ['name' => 'Mesjid Nurul Iman', 'coords' => [-6.9895, 108.4568], 'cat' => 'worship'],
            ['name' => 'Musholla Al-Muttaqin', 'coords' => [-6.9892, 108.4565], 'cat' => 'worship'],
            ['name' => 'Gereja Kristen Winduherang', 'coords' => [-6.9897, 108.457], 'cat' => 'worship'],

            // Pariwisata
            ['name' => 'Kolam Renang Desa', 'coords' => [-6.9875, 108.458], 'cat' => 'tourism'],
            ['name' => 'Taman Wisata Desa', 'coords' => [-6.9872, 108.4583], 'cat' => 'tourism'],
            ['name' => 'Pusat Kuliner Tradisional', 'coords' => [-6.988, 108.4573], 'cat' => 'tourism'],
        ];
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('locSearch');
            const locList = document.getElementById('locList');
            const locationButtons = locList.querySelectorAll('.location-btn');

            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();

                locationButtons.forEach(button => {
                    const name = button.textContent.toLowerCase();
                    if (name.includes(searchTerm)) {
                        button.parentElement.style.display = 'block';
                    } else {
                        button.parentElement.style.display = 'none';
                    }
                });
            });
        });
    </script>


    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-green-700">Peta Petualangan Winduherang</h1>
            <p class="text-gray-600 mt-2">Eksplorasi titik penting di Desa Winduherang</p>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            {{-- Sidebar --}}
            <aside id="sidebar" class="w-full md:w-64 bg-green-50 rounded-xl p-4 shadow border border-green-100">
                <input id="locSearch" type="text" placeholder="Cari lokasi..."
                    class="w-full px-3 py-2 mb-4 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" />

                <ul id="locList" class="space-y-2 max-h-48 overflow-y-auto text-sm pr-2">
                    @foreach ($locations as $idx => $loc)
                        <li>
                            <button data-idx="{{ $idx }}"
                                class="location-btn w-full text-left px-3 py-2 rounded-lg hover:bg-green-100">
                                {{ $loc['name'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>


                <div class="mt-6 text-xs text-gray-500">
                    Klik titik di peta atau nama lokasi untuk navigasi.
                </div>
            </aside>

            {{-- Map --}}
            <div class="flex-1 h-[70vh] rounded-xl overflow-hidden shadow border border-gray-200">
                <div id="map" class="w-full h-full"></div>
            </div>
        </div>
    </div>

    {{-- Leaflet & CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <script>
        const locations = @json($locations);

        const map = L.map('map', {
            zoomControl: false
        }).setView(locations[0].coords, 17);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        L.control.zoom({
            position: 'bottomright'
        }).addTo(map);

        const icons = {
            office: L.icon({
                iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-green.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41]
            }),
            public: L.icon({
                iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-yellow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41]
            }),
            edu: L.icon({
                iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-blue.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41]
            }),
        };

        const layers = {
            office: L.layerGroup().addTo(map),
            public: L.layerGroup().addTo(map),
            edu: L.layerGroup().addTo(map),
        };

        locations.forEach(loc => {
            L.marker(loc.coords, {
                    icon: icons[loc.cat]
                })
                .bindPopup(`<strong>${loc.name}</strong>`)
                .addTo(layers[loc.cat]);
        });

        L.control.layers(null, {
            'Kantor Desa': layers.office,
            'Fasilitas Umum': layers.public,
            'Pendidikan': layers.edu
        }, {
            collapsed: false,
            position: 'topright'
        }).addTo(map);

        document.querySelectorAll('.location-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const idx = btn.dataset.idx;
                const loc = locations[idx];
                map.flyTo(loc.coords, 18, {
                    duration: 1
                });
                L.popup().setLatLng(loc.coords).setContent(`<strong>${loc.name}</strong>`).openOn(map);
                document.querySelectorAll('.location-btn').forEach(b => b.classList.remove('bg-green-100'));
                btn.classList.add('bg-green-100');
            });
        });

        document.getElementById('locSearch').addEventListener('input', e => {
            const q = e.target.value.toLowerCase();
            document.querySelectorAll('#locList li').forEach(li => {
                li.style.display = li.textContent.toLowerCase().includes(q) ? 'block' : 'none';
            });
        });
    </script>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        // nothing else needed  here; Alpine init is automatic
    </script>

@endsection
