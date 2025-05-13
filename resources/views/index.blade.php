{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelurahan Karangmangu')

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
                :style="background - image::url($ { src });"></div>
        </template>

        <!-- Overlay -->
        <div
            class="absolute inset-0 bg-black bg-opacity-60 flex flex-col items-center justify-center text-center text-white px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">
                Wilujeng Sumping di <span class="text-green-400">Kelurahan Karangmangu</span>
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

    {{-- In your layouts/app.blade.php, be sure Alpine.js is included: --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endpush

    {{-- Section Visi & Misi with Modal trigger --}}
    <section id="visi-misi" class="py-20 bg-gradient-to-br from-white to-green-50" data-aos="fade-up"
        x-data="{ showModal: false }">

        <div class="max-w-screen-xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-green-800 mb-4">Visi & Misi</h2>
                <span class="block w-20 h-1 bg-green-300 mx-auto rounded-full mb-4"></span>
                <p class="text-gray-600 text-lg md:text-xl leading-relaxed">
                    Menjadi desa yang <span class="font-semibold text-green-700">maju, mandiri, dan berbasis
                        teknologi</span>,<br>
                    dengan masyarakat yang <span class="font-semibold text-green-700">inovatif dan berdaya saing
                        tinggi</span>,<br>
                    demi kesejahteraan dan kualitas hidup yang lebih baik.
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                {{-- Galeri Foto --}}
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <img src="{{ asset('images/visimisi1.jpg') }}" alt="Kegiatan 1"
                            class="rounded-xl shadow-lg object-cover h-40 w-full hover:scale-105 transition">
                        <img src="{{ asset('images/visimisi2.jpg') }}" alt="Kegiatan 2"
                            class="rounded-xl shadow-lg object-cover h-40 w-full hover:scale-105 transition">
                    </div>
                    <img src="{{ asset('images/visimisi3.jpg') }}" alt="Kegiatan 3"
                        class="rounded-xl shadow-lg object-cover h-40 w-full hover:scale-105 transition">
                </div>

                {{-- Daftar Singkat --}}
                <div class="space-y-6">
                    @foreach (['Mewujudkan tata kelola pemerintahan yang baik', 'Menjadi desa yang maju, mandiri, dan berbasis teknologi', 'Mengembangkan kegiatan keagamaan', 'Meningkatkan kualitas pendidikan dan sumber daya manusia'] as $item)
                        <div class="flex items-start space-x-4" data-aos="fade-left"
                            data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="bg-green-100 text-green-600 rounded-full p-2 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 5.707 8.293a1
                                                     1 0 00-1.414 1.414l4 4a1 1 0 001.414
                                                     0l7-7a1 1 0 000-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <p class="text-gray-700 text-lg font-medium">{{ $item }}</p>
                        </div>
                    @endforeach

                    <div class="mt-8 text-center" data-aos="zoom-in" data-aos-delay="500">
                        <button @click="showModal = true"
                            class="bg-green-600 text-white text-lg font-semibold px-8 py-3 rounded-full shadow hover:bg-green-700 transition">
                            Pelajari Lebih Lanjut
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Overlay --}}
        <div x-show="showModal" x-transition.opacity
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @click.self="showModal = false">

            {{-- Modal Content --}}
            <div x-show="showModal" x-transition.scale.origin.center
                class="bg-white w-11/12 max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl shadow-xl p-6 relative">
                {{-- Close Button --}}
                <button @click="showModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                {{-- Modal Header --}}
                <h3 class="text-2xl font-bold text-green-800 mb-4">Visi dan Misi Desa Karangmangu</h3>

                {{-- Modal Body --}}
                <div class="space-y-4 text-gray-700 text-base leading-relaxed">
                    <p>Demokratisasi memiliki makna bahwa penyelenggaraan pemerintahan dan pelaksanaan pembangunan di desa
                        harus mengakomodasi aspirasi dari masyarakat melalui Badan Permusyawaratan Desa dan Lembaga
                        Kemasyarakatan yang ada sebagai mitra Pemerintah Desa yang mampu mewujudkan peran aktif masyarakat
                        agar masyarakat senantiasa memiliki dan turut serta bertanggung jawab terhadap perkembangan
                        kehidupan bersama sebagai sesama warga desa sehingga diharapkan adanya peningkatan taraf hidup dan
                        kesejahteraan masyarakat melalui penetapan kebijakan program dan kegiatan yang sesuai dengan esensi
                        masalah dan prioritas kebutuhan masyarakat.</p>

                    <p>Atas dasar pertimbangan tersebut di atas, maka untuk jangka 6 (enam) tahun ke depan diharapkan proses
                        pembangunan di Desa, penyelenggaraan pemerintahan di desa, pemberdayaan masyarakat di desa,
                        partisipasi masyarakat di desa, siltap kepala desa dan perangkat, operasional pemerintahan desa,
                        tunjangan operasional BPD dan insentif RT/RW dapat benar-benar mendasarkan pada prinsip keterbukaan
                        dan partisipasi masyarakat sehingga secara bertahap Desa Karangmangu dapat mengalami kemajuan.</p>

                    <h4 class="mt-4 font-semibold text-green-700">VISI</h4>
                    <blockquote class="pl-4 border-l-4 border-green-600 italic">
                        “TERCIPTANYA TATA KELOLA PEMERINTAHAN DESA YANG BAIK, BERSIH DAN TRANSPARAN GUNA MEWUJUDKAN DESA
                        KARANGMANGU YANG ADIL MAKMUR SEJAHTERA DAN BERMARTABAT”
                    </blockquote>

                    <p>Rumusan visi tersebut merupakan ungkapan niat luhur untuk memperbaiki penyelenggaraan pemerintahan
                        dan pembangunan di Desa Karangmangu sehingga dalam 6 (enam) tahun ke depan terjadi perubahan yang
                        lebih baik dan peningkatan kesejahteraan masyarakat, dilandasi semangat kebersamaan.</p>

                    <h4 class="mt-4 font-semibold text-green-700">MISI</h4>
                    <ul class="list-disc list-inside space-y-2">
                        <li>Meningkatkan pelayanan prima untuk seluruh masyarakat</li>
                        <li>Menciptakan Pemerintah Desa yang tanggap terhadap aspirasi masyarakat</li>
                        <li>Meningkatkan sarana dan prasarana umum guna mendukung kelancaran perekonomian masyarakat</li>
                        <li>Pemerataan pembangunan fisik dan non-fisik agar tidak terjadi kesenjangan sosial</li>
                        <li>Koordinasi dan bekerja sama dengan semua unsur kelembagaan desa guna memberikan pelayanan
                            terbaik</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Section Sejarah Desa Karangmangu --}}
    <section id="sejarah" class="relative py-20 bg-white overflow-hidden" data-aos="fade-up">
        <!-- Ornamen Latar -->
        <svg class="absolute top-0 right-0 opacity-10 w-96 h-96 text-green-100 -z-10" fill="none" viewBox="0 0 500 500">
            <path fill="currentColor"
                d="M437.5,123.1c33.3,48.1,45.4,118.8,6.1,173.1s-130.4,87.1-210.4,79.1s-153.6-53.8-187.5-108.2S2.7,123.5,68.8,67.5S404.2,75,437.5,123.1z" />
        </svg>

        <div class="max-w-screen-lg mx-auto px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-green-800 inline-block border-b-4 border-green-600 pb-2">
                    Sejarah Desa Karangmangu
                </h2>
                <p class="mt-4 text-gray-600">Ringkasan asal-usul dan perkembangan desa dari masa ke masa</p>
            </div>

            <!-- Narasi Sejarah (Expandable) -->
            <div x-data="{ open: false }" class="space-y-6 text-gray-700 text-base md:text-lg leading-relaxed">
                {{-- Always visible --}}
                <p>Desa Karangmangu merupakan salah satu desa di wilayah Kecamatan Kramatmulya dari 14 desa yang ada. Dari
                    jaman dahulu hingga sekarang, Desa Karangmangu terkenal dengan home industri yaitu pengrajin bata merah
                    dan kupat/ketupat terbesar di Kabupaten Kuningan.</p>

                {{-- Hidden content --}}
                <div x-show="open" x-collapse class="space-y-4">
                    <p>Bicara tentang asal mula Desa Karangmangu, sampai saat ini tidak ada informasi yang jelas tentang
                        kapan dan bagaimana desa ini lahir. Para penggagas berdirinya atau orang yang dianggap tahu
                        bagaimana Desa Karangmangu ini ada tidak ada sumber informasi yang jelas, yang ada hanya cerita
                        orang tua “katanya-katanya” saja, penulis akan mencoba menulis ringkasan sejarah Desa Karangmangu
                        berdasarkan sumber dari “katanya-katanya” itu.</p>
                    <p>Desa Karangmangu asalnya adalah wilayah Desa Cikaso. Dalam sejarah singkat yang sempat penulis baca,
                        Desa Cikaso itu bukan desa melainkan sebuah pemerintahan besar yang dipimpin oleh seorang
                        Tumenggung/Bupati bergelar Tumenggung “ARGAWIJAYA” dengan pendampingnya Patih “NAGAREJA”. Salah satu
                        bukti Karangmangu merupakan bagian dari Desa Cikaso adalah makam Tumenggung Argawijaya dan Patih
                        Nagareja yang berada di Desa Karangmangu—sekarang dikeramatkan dan banyak dijiarahi orang, terutama
                        yang berhasrat menjadi Kuwu/Kepala Desa. Bahkan untuk mengabadikan nama tokoh besar tersebut, tempat
                        makam itu kini disebut “Blok Tumenggung” dan tercatat dalam DHKP (Daftar Himpunan Ketetapan Pajak)
                        desa dan kabupaten.</p>
                    <p>Pada saat Desa Karangmangu lahir mungkin karena cakupan Desa Cikaso yang luas atau sebab lain
                        sehingga desa ini muncul—tidak penting untuk diperdebatkan. Yang jelas, katanya Karangmangu berasal
                        dari “Karangmanggu”: di tengah desa ada sebuah pohon mangga besar, dan di sekitar pohon mangga itu
                        terdapat sebuah halaman atau karang yang bersih, luas, rindang, dan nyaman. Karena sejuknya dan
                        rindangnya pohon mangga tersebut, tempat itu dipakai anak-anak bermain dan para pedagang yang lewat
                        sering numpang istirahat sambil membuka timbel/nasi bekal. Terinspirasi nama itulah “Karangmanggu”
                        diambil—dari karang (halaman) dan manggu (mangga)—lalu disederhanakan menjadi KARANGMANGU.</p>
                </div>

                {{-- Read More Button --}}
                <button @click="open = !open" class="text-green-700 font-semibold inline-flex items-center space-x-2">
                    <span x-text="open ? 'Tutup Sejarah' : 'Baca Selengkapnya'"></span>
                    <svg :class="open ? 'rotate-180' : ''" class="w-4 h-4 transform transition-transform" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                    </svg>
                </button>
            </div>

            <!-- Daftar Kuwu -->
            <div class="mt-12">
                <h3 class="text-2xl font-semibold text-green-800 mb-6">Daftar Kuwu</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white rounded-lg shadow-md">
                        <thead class="bg-green-600 text-white">
                            <tr>
                                <th class="px-4 py-2 text-left">Nama Kuwu</th>
                                <th class="px-4 py-2 text-left">Periode</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ([['Kuwu Tuba', '– 1925'], ['Kuwu Sumarja', '1925 – 1961'], ['H. Ahmad Djusa', '1961 – 1973'], ['Soekarno', '1973 – 1981'], ['E. Kusmayadi', '1981 – 1999'], ['Aksan Dana Sasmita', '1999 – 2007'], ['H. Endang Ahid', '2007 – 2013'], ['Nanda Sunanda (Plt.)', '2013 – 2014'], ['Dodo Juanda (Plt.)', '2015'], ['Mulyadi (Plt.)', '2015'], ['Supandi', '2016 – 2021'], ['H. Uja Azizi', '2021 – Sekarang']] as $row)
                                <tr>
                                    <td class="px-4 py-3 text-gray-800">{{ $row[0] }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $row[1] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @endpush

@php
    // ambil 8 item galeri terbaru
    $galleryItems = \App\Models\GalleryItem::orderByDesc('date')
        ->take(8)
        ->get();
@endphp

<section id="gallery" class="py-20 bg-gray-50">
  <div class="max-w-7xl mx-auto px-4">
    <h3 class="text-4xl font-bold text-center text-green-800 mb-12 relative inline-block">
      Galeri Desa
      <span class="block w-24 h-1 bg-green-300 mt-2 mx-auto rounded-full"></span>
    </h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($galleryItems as $item)
        <div class="relative group overflow-hidden rounded-xl shadow-lg bg-white">
          <a href="{{ $item->image_url }}" target="_blank" class="block">
            <img src="{{ $item->image_url }}" 
                 alt="{{ $item->title }}" 
                 class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-110">
            <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 
                        group-hover:opacity-100 transition-opacity duration-300"></div>
          </a>
          <div class="p-4">
            <h4 class="text-lg font-semibold text-gray-800 truncate">{{ $item->title }}</h4>
            <p class="text-xs text-gray-500 mt-1">{{ $item->category }}</p>
            <p class="text-xs text-gray-500">{{ $item->date->format('d M Y') }}</p>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-12 text-center">
      <a href="{{ route('galeri') }}" 
         class="inline-block px-8 py-3 bg-green-600 text-white font-medium rounded-full shadow hover:bg-green-700 transition">
        Lihat Semua Galeri
      </a>
    </div>
  </div>
</section>


    {{-- resources/views/partials/berita_section.blade.php --}}
    @php
        use App\Models\Article;
        use App\Models\GalleryItem;
        $latestArticles = Article::orderByDesc('date')->take(3)->get();
        $galleryItems = GalleryItem::orderByDesc('date')->take(6)->get();
    @endphp

    @php
        use App\Models\Resident;
        use App\Models\FamilyCard;

        // Hitung penduduk hidup saja
        $totalResidents = Resident::whereDoesntHave('populationDeath')->count();

        // Total KK tetap dihitung semua (jika KK tidak terpengaruh kematian)
        $totalFamilies = FamilyCard::count();

        // Hitung jenis kelamin hanya untuk penduduk yang masih hidup
        $maleCount = Resident::whereDoesntHave('populationDeath')->where('jenis_kelamin', 'Laki-Laki')->count();

        $femaleCount = Resident::whereDoesntHave('populationDeath')->where('jenis_kelamin', 'Perempuan')->count();

        // Persentase keluarga terhadap penduduk hidup
        $familyPct = $totalResidents ? round(($totalFamilies / $totalResidents) * 100) : 0;
    @endphp


    {{-- Section Statistik Penduduk --}}
    <section id="statistik" class="py-20 bg-gradient-to-br from-white to-green-50 border-t border-b border-green-200"
        data-aos="fade-up">
        <div class="max-w-screen-xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-gray-800 mb-4">
                Statistik Penduduk
            </h2>
            <p class="text-gray-600 text-base md:text-lg mb-12">
                Informasi lengkap karakteristik demografi penduduk—jumlah, keluarga, jenis kelamin, dan lebih.
            </p>

            {{-- Cards Statistik Desa --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                {{-- Penduduk --}}
                <div
                    class="bg-gradient-to-br from-teal-100 to-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-transform transform hover:-translate-y-1">
                    <div class="flex items-center justify-center mb-4 text-5xl">👥</div>
                    @if ($totalResidents)
                        <h3 class="text-3xl font-extrabold text-teal-700 mb-2">
                            {{ $totalResidents }} Jiwa <br> Terdata</h3>
                    @else
                        <p class="text-red-500 font-semibold">Data belum tersedia</p>
                    @endif
                    <p class="text-gray-600 uppercase tracking-wider">Penduduk</p>
                </div>

                {{-- Kepala Keluarga --}}
                <div
                    class="bg-gradient-to-br from-teal-100 to-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-transform transform hover:-translate-y-1">
                    <div class="flex items-center justify-center mb-4 text-5xl">🏠</div>
                    @if ($totalFamilies && $totalResidents)
                        <h3 class="text-3xl font-extrabold text-teal-700 mb-2">
                            {{ round(($totalFamilies / ($totalResidents ?: 1)) * 100) }}%
                        </h3>
                    @else
                        <p class="text-red-500 font-semibold">Data belum tersedia</p>
                    @endif
                    <p class="text-gray-600 uppercase tracking-wider">Kepala Keluarga</p>
                </div>

                {{-- Laki-Laki --}}
                <div
                    class="bg-gradient-to-br from-blue-100 to-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-transform transform hover:-translate-y-1">
                    <div class="flex items-center justify-center mb-4 text-5xl text-blue-600">👨</div>
                    @if ($maleCount && $totalResidents)
                        <h3 class="text-3xl font-extrabold text-blue-700 mb-2">
                            {{ round(($maleCount / ($totalResidents ?: 1)) * 100) }}%
                        </h3>
                    @else
                        <p class="text-red-500 font-semibold">Data belum tersedia</p>
                    @endif
                    <p class="text-gray-600 uppercase tracking-wider">Laki-Laki</p>
                </div>

                {{-- Perempuan --}}
                <div
                    class="bg-gradient-to-br from-pink-100 to-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-transform transform hover:-translate-y-1">
                    <div class="flex items-center justify-center mb-4 text-5xl text-pink-600">👩</div>
                    @if ($femaleCount && $totalResidents)
                        <h3 class="text-3xl font-extrabold text-pink-700 mb-2">
                            {{ round(($femaleCount / ($totalResidents ?: 1)) * 100) }}%
                        </h3>
                    @else
                        <p class="text-red-500 font-semibold">Data belum tersedia</p>
                    @endif
                    <p class="text-gray-600 uppercase tracking-wider">Perempuan</p>
                </div>
            </div>


            {{-- Chart --}}
            <div class="bg-white p-6 rounded-2xl shadow-md">
                @if ($totalResidents)
                    <canvas id="statChart" class="w-full h-64"></canvas>
                @else
                    <p class="text-center text-red-500 font-semibold">Statistik belum tersedia.</p>
                @endif
            </div>
        </div>
    </section>

    {{-- @push('scripts') --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if ($totalResidents)
                const ctx = document.getElementById('statChart').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Penduduk', 'KK', 'Laki-L', 'Perempuan'],
                        datasets: [{
                            data: [{{ $totalResidents }}, {{ $totalFamilies }},
                                {{ $maleCount }}, {{ $femaleCount }}
                            ],
                            backgroundColor: ['#2DD4BF', '#14B8A6', '#0D9488', '#047857'],
                            borderRadius: 8,
                            barThickness: 24
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        scales: {
                            x: {
                                beginAtZero: true
                            },
                            y: {
                                ticks: {
                                    font: {
                                        size: 14
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        maintainAspectRatio: false,
                        responsive: true
                    }
                });
            @endif
        });
    </script>
    {{-- @endpush --}}


    {{-- @push('scripts') --}}
    {{-- Chart.js CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Sertakan plugin DataLabels di <head> atau sebelum script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <canvas id="statChart" style="height: 300px;"></canvas>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('statChart').getContext('2d');

            // Buat gradien untuk tiap bar
            const createGradient = (ctx, colorStart, colorEnd) => {
                const grad = ctx.createLinearGradient(0, 0, ctx.canvas.width, 0);
                grad.addColorStop(0, colorStart);
                grad.addColorStop(1, colorEnd);
                return grad;
            };

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Penduduk', 'Kepala Keluarga', 'Laki-Laki', 'Perempuan'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [
                            {{ $totalResidents }},
                            {{ $totalFamilies }},
                            {{ $maleCount }},
                            {{ $femaleCount }}
                        ],
                        backgroundColor: [
                            createGradient(ctx, 'rgba(56,190,182,0.8)', 'rgba(56,190,182,0.4)'),
                            createGradient(ctx, 'rgba(20,184,166,0.8)', 'rgba(20,184,166,0.4)'),
                            createGradient(ctx, 'rgba(13,148,136,0.8)', 'rgba(13,148,136,0.4)'),
                            createGradient(ctx, 'rgba(4,120,87,0.8)', 'rgba(4,120,87,0.4)')
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    indexAxis: 'y',
                    animation: {
                        duration: 800,
                        easing: 'easeOutQuad'
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Statistik Penduduk Desa Karangmangu',
                            font: {
                                size: 18,
                                weight: 'bold'
                            },
                            padding: {
                                top: 10,
                                bottom: 20
                            }
                        },
                        subtitle: {
                            display: true,
                            text: `Data per ${new Date().toLocaleDateString('id-ID', {
            day: 'numeric', month: 'long', year: 'numeric'
          })}`,
                            font: {
                                size: 12,
                                style: 'italic'
                            },
                            padding: {
                                bottom: 10
                            }
                        },
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: ctx => ctx.parsed.x.toLocaleString('id-ID')
                            }
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'right',
                            formatter: value => value.toLocaleString('id-ID'),
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah (orang)',
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Kategori',
                                font: {
                                    size: 14
                                }
                            },
                            ticks: {
                                font: {
                                    size: 14
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    responsive: true,
                    maintainAspectRatio: false
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>



    {{-- @endpush --}}
    <section class="bg-gray-50 border-t border-green-200 py-20">
        <div class="max-w-7xl mx-auto px-4">
            <h3 class="text-4xl font-bold text-center text-green-800 mb-16 relative inline-block">
                Berita Desa
                <span class="block w-20 h-1 bg-green-300 mt-2 mx-auto rounded-full"></span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach ($latestArticles as $idx => $article)
                    <a href="{{ route('article.show', $article) }}" data-aos="fade-up"
                        data-aos-delay="{{ $idx * 100 }}"
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
            <div class="flex-1 h-[70vh] rounded-xl shadow border border-gray-200">
                <div id="map" class="w-full h-full" style="min-height: 320px;"></div>
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

    </section>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <section class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-md mx-auto space-y-4">

                <!-- Judul Section -->
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">💬 Informasi Kontak Desa</h2>

                <!-- Accordion Item Template -->
                <template id="accordion-item">
                    <div class="bg-white rounded-xl shadow">
                        <button
                            class="w-full flex justify-between items-center font-semibold text-lg text-left px-6 py-4 focus:outline-none"
                            onclick="toggleAccordion(this)">
                            <span class="accordion-title"></span>
                            <span class="accordion-icon">＋</span>
                        </button>
                        <div
                            class="accordion-content px-6 overflow-hidden max-h-0 transition-all duration-300 ease-in-out">
                            <p class="py-4 text-gray-700"></p>
                        </div>
                    </div>
                </template>

                <!-- Data Items -->
                <script>
                    const items = [{
                            title: 'Komentar',
                            text: 'Warga desa sangat ramah dan selalu menyapa dengan senyuman. Mereka juga sangat membantu jika kita membutuhkan informasi tentang sekitar desa.'
                        },
                        {
                            title: 'Email',
                            text: 'karangmangu2035@gmail.com'
                        },
                        {
                            title: 'Pesan',
                            text: 'Ini adalah contoh pesan dari warga yang ditujukan untuk perangkat desa.'
                        }
                    ];

                    window.addEventListener('DOMContentLoaded', () => {
                        const container = document.querySelector('.max-w-md');
                        const tpl = document.getElementById('accordion-item');

                        items.forEach((item, idx) => {
                            const clone = tpl.content.cloneNode(true);
                            clone.querySelector('.accordion-title').innerText = item.title;
                            clone.querySelector('p').innerText = item.text;
                            if (idx === 0) {
                                // Buka default pertama
                                setTimeout(() => openAccordion(clone.querySelector('button')), 0);
                            }
                            container.appendChild(clone);
                        });
                    });

                    function toggleAccordion(button) {
                        const content = button.nextElementSibling;
                        const icon = button.querySelector('.accordion-icon');

                        const isOpen = content.style.maxHeight && content.style.maxHeight !== '0px';
                        // Tutup semua
                        document.querySelectorAll('.accordion-content').forEach(c => c.style.maxHeight = '0px');
                        document.querySelectorAll('.accordion-icon').forEach(i => i.textContent = '＋');

                        if (!isOpen) {
                            content.style.maxHeight = content.scrollHeight + 'px';
                            icon.textContent = '−';
                        }
                    }

                    function openAccordion(button) {
                        button.click();
                    }
                </script>
    </section>

@endsection