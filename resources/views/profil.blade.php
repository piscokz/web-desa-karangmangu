{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Desa Karangmangu')

@section('content')

    <!-- Hero Slider -->
    <section x-data="{
        slides: [
            'https://picsum.photos/1200/500?random=21',
            'https://picsum.photos/1200/500?random=22',
            'https://picsum.photos/1200/500?random=23'
        ],
        current: 0,
        init() { setInterval(() => this.current = (this.current + 1) % this.slides.length, 5000) },
        prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length },
        next() { this.current = (this.current + 1) % this.slides.length }
    }" x-init="init()" class="relative h-64 md:h-96 overflow-hidden">
        <template x-for="(src,i) in slides" :key="i">
            <div x-show="current===i" class="absolute inset-0 bg-cover bg-center transition-opacity duration-700"
                :style="background - image::url($ { src });"></div>
        </template>
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white px-4">
            <h1 class="text-3xl md:text-5xl font-bold">Profil Desa Karangmangu</h1>
            <p class="mt-2 text-sm md:text-lg">Temukan informasi lengkap tentang desa kita</p>
            <div class="flex space-x-4 mt-4">
                <button @click="prev()" class="p-2 bg-green-700 rounded-full hover:bg-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next()" class="p-2 bg-green-700 rounded-full hover:bg-green-600 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            <div class="flex space-x-2 mt-4">
                <template x-for="(_,i) in slides" :key="i">
                    <button class="w-2 h-2 rounded-full" :class="i === current ? 'bg-white' : 'bg-white bg-opacity-50'"
                        @click="current=i"></button>
                </template>
            </div>
        </div>
    </section>

    <section class="bg-green-50 py-16 space-y-16">
        <div class="max-w-4xl mx-auto px-4 space-y-16">

            <!-- Sejarah -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Sejarah Desa Karangmangu</h2>
                <div class="text-gray-700 leading-relaxed text-justify space-y-4">
                    <p>
                        Desa Karangmangu merupakan salah satu desa di wilayah Kecamatan Kramatmulya dari 14 desa yang ada.
                        Sejak zaman dahulu hingga sekarang, Desa Karangmangu terkenal dengan industri rumahannya, yaitu
                        pengrajin bata merah dan produksi kupat/ketupat terbesar di Kabupaten Kuningan.
                    </p>
                    <p>
                        Bicara tentang asal mula Desa Karangmangu, hingga saat ini belum ada catatan resmi kapan dan
                        bagaimana desa ini lahir. Cerita yang beredar hanya “katanya-katanya” dari para sesepuh. Berikut
                        ringkasan sejarah berdasarkan sumber lisan tersebut.
                    </p>
                    <p>
                        Dahulu Karangmangu merupakan bagian dari wilayah Desa Cikaso, sebuah pemerintahan besar yang
                        dipimpin oleh Tumenggung Argawijaya dengan patih Nagareja. Salah satu bukti adalah keberadaan makam
                        kedua tokoh tersebut yang kini dikeramatkan di Desa Karangmangu, tepatnya di area yang kini disebut
                        “Blok Tumenggung”.
                    </p>
                    <p>
                        Nama “Karangmangu” konon berasal dari gabungan kata “karang” (halaman luas yang bersih dan rindang)
                        dan “manggu” (bahasa Sunda untuk pohon mangga). Di tengah-tengah desa terdapat pohon mangga besar
                        tempat anak-anak bermain dan para pedagang beristirahat. Dari situ lahirlah nama “Karangmanggu”,
                        yang kemudian disederhanakan menjadi Karangmangu.
                    </p>
                    <p>
                        Desa Karangmangu dipimpin oleh seorang kuwu. Berikut periode kepemimpinan yang dapat dihimpun:
                    </p>
                    <ul class="list-disc list-inside space-y-1">
                        <li>Kuwu Tuba (–1925) <em>(tahun tidak tercatat)</em></li>
                        <li>Kuwu Sumarja (1925–1961)</li>
                        <li>Kuwu H. Ahmad Djusa (1961–1973)</li>
                        <li>Kuwu Soekarno (1973–1981)</li>
                        <li>Kuwu E. Kusmayadi (1981–1999)</li>
                        <li>Kuwu Aksan Dana Sasmita (1999–2007)</li>
                        <li>Kuwu H. Endang Ahid (2007–2013)</li>
                        <li>Penjabat Sementara Nanda Sunanda (2013–2014)</li>
                        <li>Penjabat Sementara Dodo Juanda (2015)</li>
                        <li>Penjabat Sementara Mulyadi (2015)</li>
                        <li>Kuwu Supandi (2016–2021)</li>
                    </ul>
                    <p>
                        Meskipun sumber tertulis masih terbatas, warisan budaya dan kisah lisan tentang Desa Karangmangu
                        terus dijaga dan diceritakan dari generasi ke generasi.
                    </p>
                </div>
            </div>



<<<<<<< HEAD
<!-- Visi & Misi Desa Karangmangu -->
<div class="bg-white rounded-lg shadow-lg p-8">
    <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Visi &amp; Misi Desa Karangmangu</h2>
    
    <div class="text-gray-700 leading-relaxed text-justify space-y-4 mb-8">
      <p>
        Demokratisasi memiliki makna bahwa penyelenggaraan pemerintahan dan pelaksanaan pembangunan di desa harus mengakomodasi aspirasi masyarakat melalui Badan Permusyawaratan Desa dan lembaga kemasyarakatan yang ada sebagai mitra Pemerintah Desa. Hal ini diharapkan mendorong peran aktif masyarakat sehingga setiap warga bertanggung jawab atas perkembangan kehidupan bersama, meningkatkan taraf hidup dan kesejahteraan melalui kebijakan, program, dan kegiatan yang sesuai esensi masalah serta prioritas kebutuhan masyarakat.
      </p>
      <p>
        Berdasarkan pertimbangan tersebut, untuk jangka waktu 6 (enam) tahun ke depan, proses pembangunan desa, penyelenggaraan pemerintahan, pemberdayaan dan partisipasi masyarakat, serta tunjangan Operasional Pemerintah Desa, BPD, dan insentif RT/RW akan berlandaskan prinsip keterbukaan dan partisipasi. Dengan demikian, Desa Karangmangu diharapkan mengalami kemajuan dan kesejahteraan yang merata.
      </p>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <!-- Visi -->
      <div>
        <h3 class="text-xl font-semibold text-green-700 mb-2">Visi</h3>
        <p class="italic text-gray-700">
          “TERCIPTANYA TATA KELOLA PEMERINTAHAN DESA YANG BAIK, BERSIH, DAN TRANSPARAN GUNA MEWUJUDKAN DESA KARANGMANGU YANG ADIL, MAKMUR, SEJAHTERA, DAN BERMARTABAT”
        </p>
      </div>
      <!-- Misi -->
      <div>
        <h3 class="text-xl font-semibold text-green-700 mb-2">Misi</h3>
        <ul class="list-disc list-inside space-y-2 text-gray-700">
          <li>Meningkatkan pelayanan prima untuk seluruh masyarakat.</li>
          <li>Menciptakan Pemerintah Desa yang tanggap terhadap aspirasi masyarakat.</li>
          <li>Meningkatkan sarana dan prasarana umum guna mendukung kelancaran perekonomian masyarakat.</li>
          <li>Pemerataan pembangunan fisik dan non-fisik agar tidak terjadi kesenjangan sosial.</li>
          <li>Koordinasi dan kerja sama dengan semua unsur kelembagaan desa guna memberikan pelayanan terbaik kepada masyarakat.</li>
        </ul>
      </div>
    </div>
  </div>
  
=======
            <!-- Visi & Misi Desa Karangmangu -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Visi &amp; Misi Desa Karangmangu</h2>

                <div class="text-gray-700 leading-relaxed text-justify space-y-4 mb-8">
                    <p>
                        Demokratisasi memiliki makna bahwa penyelenggaraan pemerintahan dan pelaksanaan pembangunan di desa
                        harus mengakomodasi aspirasi masyarakat melalui Badan Permusyawaratan Desa dan lembaga
                        kemasyarakatan yang ada sebagai mitra Pemerintah Desa. Hal ini diharapkan mendorong peran aktif
                        masyarakat sehingga setiap warga bertanggung jawab atas perkembangan kehidupan bersama, meningkatkan
                        taraf hidup dan kesejahteraan melalui kebijakan, program, dan kegiatan yang sesuai esensi masalah
                        serta prioritas kebutuhan masyarakat.
                    </p>
                    <p>
                        Berdasarkan pertimbangan tersebut, untuk jangka waktu 6 (enam) tahun ke depan, proses pembangunan
                        desa, penyelenggaraan pemerintahan, pemberdayaan dan partisipasi masyarakat, serta tunjangan
                        Operasional Pemerintah Desa, BPD, dan insentif RT/RW akan berlandaskan prinsip keterbukaan dan
                        partisipasi. Dengan demikian, Desa Karangmangu diharapkan mengalami kemajuan dan kesejahteraan yang
                        merata.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Visi -->
                    <div>
                        <h3 class="text-xl font-semibold text-green-700 mb-2">Visi</h3>
                        <p class="italic text-gray-700">
                            “TERCIPTANYA TATA KELOLA PEMERINTAHAN DESA YANG BAIK, BERSIH, DAN TRANSPARAN GUNA MEWUJUDKAN
                            DESA KARANGMANGU YANG ADIL, MAKMUR, SEJAHTERA, DAN BERMARTABAT”
                        </p>
                    </div>
                    <!-- Misi -->
                    <div>
                        <h3 class="text-xl font-semibold text-green-700 mb-2">Misi</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li>Meningkatkan pelayanan prima untuk seluruh masyarakat.</li>
                            <li>Menciptakan Pemerintah Desa yang tanggap terhadap aspirasi masyarakat.</li>
                            <li>Meningkatkan sarana dan prasarana umum guna mendukung kelancaran perekonomian masyarakat.
                            </li>
                            <li>Pemerataan pembangunan fisik dan non-fisik agar tidak terjadi kesenjangan sosial.</li>
                            <li>Koordinasi dan kerja sama dengan semua unsur kelembagaan desa guna memberikan pelayanan
                                terbaik kepada masyarakat.</li>
                        </ul>
                    </div>
                </div>
            </div>
>>>>>>> bcc0c3d (feat: mempercantik halaman Lapak Desa dengan desain ala web olshop modern dan responsif)


            <!-- Struktur Organisasi -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Struktur Organisasi</h2>
                <div class="flex justify-center">
                    <div
                        class="overflow-hidden rounded-xl shadow-xl hover:scale-105 transition-transform duration-300 ring-1 ring-green-200">
                        <img src="{{ asset('images/strukorg.jpg') }}" alt="Struktur Organisasi"
                            class="object-contain w-full md:w-[700px]" />
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Leaflet CSS (di <head> atau sebelum penggunaan map) -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <!-- Leaflet JS (di bawah, sebelum </body>) -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    @php
        $locations = [
            // Kantor & umum
            ['name' => 'Kantor Desa Karangmangu', 'coords' => [-7.044712, 108.594932], 'cat' => 'office'],
            ['name' => 'Balai Dusun Karangmangu', 'coords' => [-7.0445, 108.5955], 'cat' => 'public'],
            // Pendidikan
            ['name' => 'PAUD Mekar Sari', 'coords' => [-7.0449, 108.5948], 'cat' => 'edu'],
            ['name' => 'TK Karangmangu Ceria', 'coords' => [-7.0452, 108.5953], 'cat' => 'edu'],
            ['name' => 'SD Negeri 1 Karangmangu', 'coords' => [-7.0446, 108.595], 'cat' => 'edu'],
            ['name' => 'SD Negeri 2 Karangmangu', 'coords' => [-7.045, 108.596], 'cat' => 'edu'],
            ['name' => 'SMP Negeri Terdekat', 'coords' => [-7.0435, 108.5965], 'cat' => 'edu'],
            // Ibadah
            ['name' => 'Masjid Jami Karangmangu', 'coords' => [-7.0448, 108.595], 'cat' => 'worship'],
            ['name' => 'Musholla Al-Hidayah', 'coords' => [-7.0451, 108.5947], 'cat' => 'worship'],
            // Pariwisata
            ['name' => 'Curug Putri Karangmangu', 'coords' => [-7.0425, 108.598], 'cat' => 'tourism'],
            ['name' => 'Kolam Pemandian Alam', 'coords' => [-7.043, 108.5975], 'cat' => 'tourism'],
            ['name' => 'Taman Desa Karangmangu', 'coords' => [-7.044, 108.5962], 'cat' => 'tourism'],
        ];
    @endphp

    <div class="max-w-7xl mx-auto px-4 py-10 border-t border-green-200">
        <div class="text-center mb-6">
            <h1 class="text-4xl font-bold text-green-700">Peta Petualangan Karangmangu</h1>
            <p class="text-gray-600 mt-2">Eksplorasi titik penting di Desa Karangmangu</p>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            <aside id="sidebar" class="w-full md:w-64 bg-green-50 rounded-xl p-4 shadow border border-green-100">
                <input id="locSearch" type="text" placeholder="Cari lokasi..."
                    class="w-full px-3 py-2 mb-4 border border-green-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400" />
                <ul id="locList" class="space-y-2 max-h-48 overflow-y-auto text-sm pr-2">
                    @foreach ($locations as $idx => $loc)
                        <li>
                            <button data-idx="{{ $idx }}"
                                class="location-btn w-full text-left px-3 py-2 rounded-lg hover:bg-green-100 transition">{{ $loc['name'] }}</button>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-6 text-xs text-gray-500">
                    Klik titik di peta atau nama lokasi untuk navigasi.
                </div>
            </aside>

            <!-- Map -->
            <div class="flex-1 h-[70vh] rounded-xl overflow-hidden shadow border border-gray-200">
                <div id="map" class="w-full h-full"></div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Ambil data dari PHP
            const locations = @json($locations);

            // Inisialisasi peta
            const map = L.map('map').setView(locations[0].coords, 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Icon berwarna per kategori (opsional)
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
                worship: L.icon({
                    iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-red.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41]
                }),
                tourism: L.icon({
                    iconUrl: 'https://cdn.jsdelivr.net/gh/pointhi/leaflet-color-markers@master/img/marker-icon-violet.png',
                    iconSize: [25, 41],
                    iconAnchor: [12, 41]
                }),
            };

            // Layer per kategori untuk kontrol
            const layers = {
                office: L.layerGroup().addTo(map),
                public: L.layerGroup().addTo(map),
                edu: L.layerGroup().addTo(map),
                worship: L.layerGroup().addTo(map),
                tourism: L.layerGroup().addTo(map),
            };

            // Buat marker dan simpan referensi
            const markers = locations.map((loc, i) => {
                const m = L.marker(loc.coords, {
                        icon: icons[loc.cat] || icons.public
                    })
                    .bindPopup(`<strong>${loc.name}</strong>`)
                    .addTo(layers[loc.cat]);
                return m;
            });

            // Kontrol layer
            L.control.layers(null, {
                'Kantor Desa': layers.office,
                'Fasilitas Umum': layers.public,
                'Pendidikan': layers.edu,
                'Ibadah': layers.worship,
                'Pariwisata': layers.tourism
            }, {
                collapsed: false,
                position: 'topright'
            }).addTo(map);

            // Fungsi filter list sidebar
            const searchInput = document.getElementById('locSearch');
            searchInput.addEventListener('input', () => {
                const q = searchInput.value.toLowerCase();
                document.querySelectorAll('#locList li').forEach(li => {
                    li.style.display = li.textContent.toLowerCase().includes(q) ? 'block' : 'none';
                });
            });

            // Klik tombol navigasi
            document.querySelectorAll('.location-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const idx = +btn.dataset.idx;
                    const loc = locations[idx];
                    map.flyTo(loc.coords, 17, {
                        duration: 0.7
                    });
                    markers[idx].openPopup();
                    // highlight aktif
                    document.querySelectorAll('.location-btn').forEach(b => b.classList.remove(
                        'bg-green-100'));
                    btn.classList.add('bg-green-100');
                });
            });
        });
    </script>


    <!-- Alpine.js for slider -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection
