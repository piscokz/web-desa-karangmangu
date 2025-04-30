{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Desa Winduherang')

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
                :style="`background-image:url(${src});`"></div>
        </template>
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white px-4">
            <h1 class="text-3xl md:text-5xl font-bold">Profil Desa Winduherang</h1>
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
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Sejarah</h2>
                <div class="text-gray-700 leading-relaxed text-justify space-y-4">
                    <p class="text-center">Assalamualaikum Wr. Wb</p>
                    <p class="text-center">Bismillahirrahmanirrahim</p>
                    <p>
                        Nama Winduherang berasal dari dua suku kata yaitu kata ‘Windu’ dan kata ‘Herang’. ‘Windu’ mempunyai
                        arti delapan tahun,
                        namun di sini tidak memiliki arti hitungan melainkan memiliki makna “masa” atau waktu dan bisa pula
                        diartikan “periode”
                        dalam arti “tanda” yaitu untuk menandai perbedaan antara waktu sebelumnya dengan waktu yang akan
                        datang, atau masa berikutnya.
                    </p>
                    <p>
                        “Herang” berasal dari kata bahasa Sunda yang artinya “bersih” yang mempunyai makna “bersih lahir dan
                        batin”.
                        Dan ‘Herang’ mempunyai arti lain yaitu bening, caang, bengras, terlihat dengan jelas tidak
                        samar-samar dan tidak meragukan.
                    </p>
                    <p>
                        Jadi pengertian pokok dari kata ‘WINDUHERANG’ yaitu masa atau waktu yang membedakan antara yang hak
                        dengan yang batil,
                        antara yang benar dengan yang salah atau Winduherang bisa juga bermakna tuntunan hidup dari Allah
                        yang merupakan misi
                        perjuangan Sinuhun Syech Syarif Hidayatullah untuk meng-Islamkan Gedeng Kamuning beserta rakyatnya,
                        dan seluruh keturunannya
                        memeluk agama Islam sampai hari kiamat nanti.
                    </p>
                    <p>
                        Melakukan hijrah keyakinan dan ketauhidan dari ajaran yang menggelapkan kepada ajaran yang benar dan
                        terang benderang
                        dalam keimanan kepada Allah SWT: <strong>“Yuhrijukum minadzulumati ilannuur”</strong>.
                    </p>
                    <p>
                        Maka sejak tanggal 14 Muharram 1481 M, Pedukuhan Gedeng Kamuning diganti dengan Winduherang dan
                        orang yang pertama masuk Islam
                        adalah Gedeng Kamuning. Sebagai bukti peninggalan sejarah adalah Makam Gedeng Kamuning yang terletak
                        di Hulu Dayeuh dekat Mata
                        Air Winduherang yang letaknya membujur ke Barat atau ke arah Kiblat.
                    </p>
                </div>
            </div>


            <!-- Visi & Misi -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Visi &amp; Misi</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-green-700 mb-2">Visi</h3>
                        <p class="italic text-gray-700"> “ Terwujudnya Kelurahan Winduherang sebagai Destinasi Wisata Religi
                            “</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-green-700 mb-2">Misi</h3>
                        <ul class="list-disc list-inside space-y-2 text-gray-700">
                            <li>Menata Lembaga/Organisasi Kemasyarakat.</li>
                            <li>Meningkatkan Infra Struktur Menuju Lokasi Wisata.</li>
                            <li>Mengembangkan UKM (Dengan Mengedepankan Produk Lokal).</li>
                            <li>Meningkatkan SDM Di Bidang Religi.</li>
                        </ul>
                    </div>
                </div>
                <div class="text-center">
                    <h3 class="text-xl font-semibold text-green-700 mt-6">Moto</h3>
                    <p class="italic text-gray-700"> “ Winduherang Bersatu, Bangkit Dan Sejahtera“</p>
                </div>
            </div>

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

            <!-- Program & Kegiatan -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Program &amp; Kegiatan</h2>
                <div class="space-y-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div>
                            <h3 class="text-2xl font-semibold text-green-700 mb-2">Kegiatan Jumat Bersih</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Kegiatan yang dilaksanakan setiap hari Jumat dengan tujuan untuk membersihkan lingkungan
                                sekitar.
                                Program ini biasanya melibatkan berbagai elemen masyarakat, termasuk RT, RW, dan berbagai
                                pihak terkait,
                                untuk secara bersama-sama menjaga kebersihan lingkungan. Kegiatan ini sangat efektif untuk
                                mempererat hubungan
                                antarwarga serta meningkatkan rasa peduli terhadap lingkungan sekitar.
                            </p>
                        </div>
                        <img src="{{ asset('storage/kegiatan1.jpg') }}" alt="Kegiatan Jumat Bersih"
                            class="rounded-lg shadow-md w-full h-48 object-cover" />
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <img src="{{ asset('storage/kegiatan2.jpg') }}" alt="Kegiatan Posyandu"
                            class="rounded-lg shadow-md w-full h-48 object-cover" />
                        <div>
                            <h3 class="text-2xl font-semibold text-green-700 mb-2">Kegiatan Posyandu</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Kegiatan Posyandu Pusat Pelayanan Terpadu diadakan di Balai Kader Kelurahan Winduherang.
                                Fokus utamanya adalah pelayanan kesehatan ibu dan anak, meliputi penimbangan balita,
                                pemberian imunisasi, serta konsultasi kesehatan bagi lansia. Kegiatan ini mendukung tumbuh
                                kembang balita
                                dan kesehatan masyarakat setempat.
                            </p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center">
                        <div>
                            <h3 class="text-2xl font-semibold text-green-700 mb-2">Program Pendukung Usaha bagi UMKM</h3>
                            <p class="text-gray-700 leading-relaxed">
                                Program ini bertujuan untuk mendukung pertumbuhan produk dan pemasaran hasil usaha kecil,
                                seperti olahan makanan dan produk rumahan. Melalui program ini, diharapkan UMKM lokal dapat
                                meningkatkan
                                daya saingnya di pasar yang lebih luas dengan produk-produk khas dan inovatif.
                            </p>
                        </div>
                        <img src="{{ asset('storage/kegiatan3.jpg') }}" alt="Program UMKM"
                            class="rounded-lg shadow-md w-full h-48 object-cover" />
                    </div>
                </div>
            </div>


            <!-- Kondisi Geografis -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Kondisi Geografis 🌏</h2>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Luas wilayah Kelurahan Winduhareng Kecamatan Cigugur adalah kurang lebih 90,674 Ha 📏.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    Kelurahan Winduhareng berbatasan dengan:
                    <br>- Sebelah Utara : Kelurahan Cirendang 🧭
                    <br>- Sebelah Selatan : Kelurahan Kuningan 🏡
                    <br>- Sebelah Timur : Kelurahan Purwawinangun 🌳
                    <br>- Sebelah Barat : Kelurahan Cipari 🏞️
                    <br><br>
                    Kelurahan Winduhareng berada di ketinggian sekitar 600 m dpl, suhu udara 23°C-32°C 🌡️, curah hujan
                    2000-2500 mm/tahun ☔.
                    <br>Jarak tempuh:
                    <br>- Ke ibu kota kecamatan ±2 Km 🚶‍♂️
                    <br>- Ke ibu kota kabupaten ±1 Km 🛵
                    <br>- Ke ibu kota provinsi ±200 Km 🚗
                    <br>- Ke ibu kota negara ±270 Km ✈️
                    <br><br>
                    Kelurahan Winduhareng Kecamatan Cigugur beriklim sedang ☀️🌧️.
                </p>
            </div>


            @php
                use App\Models\Resident;
                use App\Models\FamilyCard;
                use Illuminate\Support\Facades\DB;
                use Illuminate\Support\Str;

                //
                // 1) Data Demografi
                //
                $total = Resident::count();
                $male = Resident::where('jenis_kelamin', 'Laki-laki')->count();
                $female = Resident::where('jenis_kelamin', 'Perempuan')->count();
                $heads = FamilyCard::count(); // Kepala keluarga

                //
                // 2) Data Agama
                //
                $religionStats = Resident::select('agama', DB::raw('COUNT(*) as count'))->groupBy('agama')->get();

                //
                // 3) Data Pekerjaan
                //
                $jobStats = Resident::select('pekerjaan', DB::raw('COUNT(*) as count'))
                    ->whereNotNull('pekerjaan')
                    ->groupBy('pekerjaan')
                    ->get();

                //
                // Helpers: pilih emoji berdasarkan teks
                //
                function getReligionEmoji($r)
                {
                    return match (Str::lower($r)) {
                        'islam' => '🕌',
                        'kristen', 'katolik' => '⛪',
                        'hindu' => '🕉️',
                        'buddha' => '☸️',
                        'konghucu' => '☯️',
                        default => '❓',
                    };
                }
                function getJobEmoji($j)
                {
                    $j = Str::lower($j);
                    return match (true) {
                        Str::contains($j, ['tani', 'kebun']) => '🌱',
                        Str::contains($j, ['ternak']) => '🐄',
                        Str::contains($j, ['ikan', 'laut', 'perikanan']) => '🐟',
                        Str::contains($j, ['hutan']) => '🌳',
                        Str::contains($j, ['industri']) => '🏭',
                        Str::contains($j, ['konstruksi', 'bangunan']) => '👷‍♂️',
                        Str::contains($j, ['teknisi', 'teknik']) => '🛠️',
                        Str::contains($j, ['sopir', 'supir']) => '🚗',
                        Str::contains($j, ['dagang', 'jualan']) => '🛒',
                        Str::contains($j, ['jasa']) => '💼',
                        Str::contains($j, ['wisata']) => '🏨',
                        Str::contains($j, ['dokter']) => '👨‍⚕️',
                        Str::contains($j, ['perawat']) => '👩‍⚕️',
                        Str::contains($j, ['apoteker']) => '💊',
                        Str::contains($j, ['guru']) => '🎓',
                        Str::contains($j, ['dosen']) => '👩‍🎓',
                        Str::contains($j, ['peneliti', 'riset']) => '🔬',
                        Str::contains($j, ['pns', 'pegawai negeri']) => '🏛️',
                        Str::contains($j, ['tni', 'polri']) => '👮‍♂️',
                        Str::contains($j, ['buruh']) => '🔨',
                        Str::contains($j, ['karyawan', 'pegawai', 'pt']) => '🏢',
                        Str::contains($j, ['wirausaha', 'wiraswasta']) => '🚀',
                        Str::contains($j, ['pelajar', 'mahasiswa', 'sekolah']) => '🧑‍🎓',
                        Str::contains($j, ['ibu rumah tangga']) => '🏠',
                        default => '❓',
                    };
                }

                // Palet warna untuk charts
                $colors = ['#22C55E', '#3B82F6', '#F59E0B', '#EC4899', '#8B5CF6', '#F97316', '#EAB308', '#6B7280'];
            @endphp

            {{-- =======================
     Section: Total Penduduk
======================= --}}
            <section id="total-penduduk" class="py-12 px-4 bg-gray-50">
                <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-6">
                    <h2 class="text-3xl font-bold text-green-800 text-center">Total Penduduk</h2>

                    @if ($total > 0)
                        <div class="flex flex-col lg:flex-row items-center gap-8">
                            {{-- Chart --}}
                            <div class="w-full max-w-sm mx-auto">
                                <canvas id="demografiChart"></canvas>
                            </div>

                            {{-- Kartu ringkasan --}}
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 flex-1">
                                <div class="p-4 bg-green-50 rounded-lg text-center">
                                    <p class="text-gray-700 font-medium">Total</p>
                                    <p class="text-green-700 text-2xl font-bold">{{ number_format($total, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="p-4 bg-blue-50 rounded-lg text-center">
                                    <p class="text-gray-700 font-medium">Laki-laki</p>
                                    <p class="text-blue-700 text-2xl font-bold">{{ number_format($male, 0, ',', '.') }}</p>
                                </div>
                                <div class="p-4 bg-pink-50 rounded-lg text-center">
                                    <p class="text-gray-700 font-medium">Perempuan</p>
                                    <p class="text-pink-700 text-2xl font-bold">{{ number_format($female, 0, ',', '.') }}
                                    </p>
                                </div>
                                <div class="p-4 bg-amber-50 rounded-lg text-center">
                                    <p class="text-gray-700 font-medium">KK</p>
                                    <p class="text-amber-700 text-2xl font-bold">{{ number_format($heads, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-gray-500">Belum ada data penduduk yang masuk.</p>
                    @endif
                </div>
            </section>

            {{-- =======================
     Section: Agama
======================= --}}
            <section id="agama" class="py-12 px-4 bg-gray-100">
                <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-6">
                    <h2 class="text-3xl font-bold text-green-800 text-center">Agama</h2>

                    @php
                        $allReligions = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
                    @endphp
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">
                        @foreach ($allReligions as $agama)
                            @php
                                $stat = $religionStats->firstWhere('agama', $agama);
                                $count = $stat ? $stat->count : 0;
                                $pct = $total > 0 ? round(($count / $total) * 100, 1) : 0;
                                $icon = getReligionEmoji($agama);
                            @endphp
                            <div class="text-center p-4 bg-gray-50 rounded-lg">
                                <span class="text-4xl block mb-1">{{ $icon }}</span>
                                <p class="font-semibold text-gray-800">{{ $agama }}</p>
                                <p class="text-green-700 font-bold">{{ $count }} ({{ $pct }}%)</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- =======================
     Section: Pekerjaan
======================= --}}
            <section id="pekerjaan" class="py-12 px-4 bg-gray-50">
                <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-lg p-8 space-y-6">
                    <h2 class="text-3xl font-bold text-green-800 text-center">Pekerjaan</h2>

                    @if ($jobStats->isNotEmpty())
                        <div class="flex flex-col-reverse lg:flex-row items-start gap-8">
                            {{-- Grid kartu --}}
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 flex-1">
                                @foreach ($jobStats as $row)
                                    @php
                                        $icon = getJobEmoji($row->pekerjaan);
                                    @endphp
                                    <div class="text-center p-4 bg-green-50 rounded-lg shadow-sm">
                                        <span class="text-4xl block mb-2">{{ $icon }}</span>
                                        <p class="font-semibold text-gray-800">{{ $row->pekerjaan }}</p>
                                        <p class="text-green-700 font-bold">{{ number_format($row->count, 0, ',', '.') }}
                                            Orang</p>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Chart --}}
                            <div class="w-full max-w-sm mx-auto">
                                <canvas id="pekerjaanChart"></canvas>
                            </div>
                        </div>
                    @else
                        <p class="text-center text-gray-500">Belum ada data pekerjaan yang masuk.</p>
                    @endif
                </div>
            </section>

            {{-- =======================
     Scripts: Chart.js + DataLabels
======================= --}}
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    Chart.register(ChartDataLabels);

                    // 1) Demografi Chart
                    @if ($total > 0)
                        new Chart(document.getElementById('demografiChart'), {
                            type: 'doughnut',
                            data: {
                                labels: ['Laki-laki', 'Perempuan', 'KK'],
                                datasets: [{
                                    data: [{{ $male }}, {{ $female }},
                                        {{ $heads }}
                                    ],
                                    backgroundColor: @json(array_slice($colors, 0, 3)),
                                    borderColor: '#fff',
                                    borderWidth: 2,
                                    hoverOffset: 10
                                }]
                            },
                            options: {
                                cutout: '60%',
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: (v, ctx) => ((v / ctx.chart.data.datasets[0].data.reduce((a,
                                            b) => a + b, 0)) * 100).toFixed(1) + '%',
                                        color: '#fff',
                                        font: {
                                            weight: '600',
                                            size: 12
                                        }
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                },
                                animation: {
                                    duration: 1000,
                                    easing: 'easeOutBounce'
                                }
                            }
                        });
                    @endif

                    // 2) Pekerjaan Chart
                    @if ($jobStats->isNotEmpty())
                        new Chart(document.getElementById('pekerjaanChart'), {
                            type: 'doughnut',
                            data: {
                                labels: @json($jobStats->pluck('pekerjaan')),
                                datasets: [{
                                    data: @json($jobStats->pluck('count')),
                                    backgroundColor: @json(array_slice($colors, 0, $jobStats->count())),
                                    borderColor: '#fff',
                                    borderWidth: 2,
                                    hoverOffset: 10
                                }]
                            },
                            options: {
                                cutout: '60%',
                                responsive: true,
                                plugins: {
                                    datalabels: {
                                        formatter: (v, ctx) => ((v / ctx.chart.data.datasets[0].data.reduce((a,
                                            b) => a + b, 0)) * 100).toFixed(1) + '%',
                                        color: '#fff',
                                        font: {
                                            weight: '600',
                                            size: 12
                                        }
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                },
                                animation: {
                                    duration: 1000,
                                    easing: 'easeOutBounce'
                                }
                            }
                        });
                    @endif
                });
            </script>



        </div>
    </section>

    <!-- Alpine.js for slider -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@endsection