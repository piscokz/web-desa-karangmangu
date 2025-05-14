{{-- resources/views/pemerintahan.blade.php --}}
@extends('layouts.app')

@section('title', 'Pemerintahan Desa Karangmangu')

@section('content')
    <!-- Hero Slider -->
    <section x-data="{
    slides: [
        { src: '{{ asset('images/Banner/1.jpeg') }}', title: 'LPM (Lembaga Pemberdayaan Masyarakat)' },
        { src: '{{ asset('images/Banner/SAMPINGKANAN.jpeg') }}', title: 'Karang Taruna' },
        { src: '{{ asset('images/Banner/SAMPINGKIRI.jpeg') }}', title: 'PKK (Pemberdayaan Kesejahteraan Keluarga)' }
    ],
        current: 0,
        init() { setInterval(this.next, 5000) },
        prev() { this.current = (this.current - 1 + this.slides.length) % this.slides.length },
        next() { this.current = (this.current + 1) % this.slides.length },
        go(i) { this.current = i }
    }" x-init="init()" class="relative h-64 md:h-96 overflow-hidden">
        <template x-for="(slide, i) in slides" :key="i">
            <div x-show="current === i" class="absolute inset-0 bg-cover bg-center transition-opacity duration-700"
                :style="`background-image:url(${slide.src})`"></div>
        </template>
        <div class="absolute inset-0 bg-green-900 bg-opacity-50 flex flex-col justify-center items-center text-white px-4">
            <h1 class="text-2xl md:text-4xl font-extrabold mb-2" x-text="slides[current].title"></h1>
            <div class="flex space-x-4 mt-4">
                <button @click="prev" class="p-2 bg-white bg-opacity-20 rounded-full hover:bg-opacity-40 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="next" class="p-2 bg-white bg-opacity-20 rounded-full hover:bg-opacity-40 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
            <div class="flex space-x-2 mt-6">
                <template x-for="(_, i) in slides" :key="i">
                    <button class="w-3 h-3 rounded-full" :class="i === current ? 'bg-white' : 'bg-white bg-opacity-50'"
                        @click="go(i)"></button>
                </template>
            </div>
        </div>
    </section>
    {{-- Pejabat Utama Desa --}}
    <section class="py-16 bg-gray-50 space-y-10">
        <div class="max-w-6xl mx-auto px-4 space-y-8">

            <div class="text-center space-y-2">
                <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-300 inline-block">
                    Pejabat & Struktur Desa Winduherang
                </h2>
                <p class="text-gray-700">Berikut adalah lima jabatan utama di Kelurahan Winduherang.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $officers = [
                        ['Lurah karangmangu', 'H.Uja Azizi'],
                        ['Sekretaris Kelurahan', 'Nanda Sunanda'],
                        ['Ka. Seksi Pemerintahan', 'Iwan Gunawan'],
                        ['Ka. Seksi Pelayanan', 'M.Sahuri'],
                        ['Ka. Seksi Kesejahteraan', 'Ugi Sugiharto'],
                    ];
                @endphp

                @foreach ($officers as [$role, $name])
                    <div class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-xl transition">
                        <svg class="w-12 h-12 mx-auto mb-4 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A4 4 0 0112 16a4 4 0 016.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <p class="text-lg font-semibold text-green-700">{{ $role }}</p>
                        <p class="text-gray-600">{{ $name }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-16">
        <div class="max-w-4xl mx-auto px-4">
            <h3 class="text-2xl font-bold text-green-800 mb-4 text-center">Tabel Pejabat Utama</h3>
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-700">No</th>
                            <th class="px-4 py-2 text-left text-gray-700">Nama</th>
                            <th class="px-4 py-2 text-left text-gray-700">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($officers as $i => [$role, $name])
                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-green-50' }}">
                                <td class="px-4 py-2">{{ $i + 1 }}</td>
                                <td class="px-4 py-2">{{ $name }}</td>
                                <td class="px-4 py-2">{{ $role }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @php
        use App\Models\Resident;
        use App\Models\FamilyCard;
        use Illuminate\Support\Facades\DB;
        use Illuminate\Support\Str;
        use App\Models\PopulationDeath;
        use Illuminate\Http\Request;
        // use App\Models\Resident;
        use Carbon\Carbon;
        // 1) Tahun sekarang

        $bloodStats = Resident::select('gol_darah as type', DB::raw('COUNT(*) as count'))
            ->whereDoesntHave('populationDeath') // hanya yang masih hidup
            ->whereNotNull('gol_darah') // bukan NULL
            ->whereNotIn('gol_darah', ['', 'null']) // bukan '' atau 'null' (string)
            ->groupBy('gol_darah')
            ->get();

        // 2) Hitung yang hidup tapi **tidak** punya data golongan darah
        $unknownCount = Resident::whereDoesntHave('populationDeath')
            ->where(function ($q) {
                $q->whereNull('gol_darah')->orWhere('gol_darah', '')->orWhere('gol_darah', 'null');
            })
            ->count();

        // 3) Tambahkan kategori “Tidak Diketahui” jika ada
        if ($unknownCount > 0) {
            $bloodStats->push(
                (object) [
                    'type' => 'Tidak Diketahui',
                    'count' => $unknownCount,
                ],
            );
        }
        $total = Resident::count();
        // Total kematian
        $totalDeaths = PopulationDeath::count();

        // Kematian berdasarkan jenis kelamin
        $maleDeaths = PopulationDeath::whereHas('resident', function ($q) {
            $q->where('jenis_kelamin', 'Laki-laki');
        })->count();
        $femaleDeaths = PopulationDeath::whereHas('resident', function ($q) {
            $q->where('jenis_kelamin', 'Perempuan');
        })->count();

        // Persentase
        $percentMale = $totalDeaths > 0 ? round((100 * $maleDeaths) / $totalDeaths, 1) : 0;
        $percentFemale = $totalDeaths > 0 ? round((100 * $femaleDeaths) / $totalDeaths, 1) : 0;
        // Hitung umur saat meninggal dan grup ke kategori lebih detail
        $ageData = PopulationDeath::with('resident')
            ->get()
            ->map(function ($death) {
                $dob = $death->resident->tanggal_lahir;
                $dod = $death->tanggal_meninggal;
                $ageYears =
                    $dob && $dod
                        ? $dob->diffInDays($dod) / 365.25 // usia dalam tahun (desimal)
                        : null;

                if ($ageYears === null) {
                    $cat = 'Tidak diketahui';
                } elseif ($ageYears < 28 / 365.25) {
                    $cat = 'Neonatal (0–28 hari)';
                } elseif ($ageYears < 1) {
                    $cat = 'Bayi (29 hari–<1 thn)';
                } elseif ($ageYears < 13) {
                    $cat = 'Anak-anak (1–12 thn)';
                } elseif ($ageYears < 18) {
                    $cat = 'Remaja (13–17 thn)';
                } elseif ($ageYears < 36) {
                    $cat = 'Dewasa Muda (18–35 thn)';
                } elseif ($ageYears < 60) {
                    $cat = 'Dewasa (36–59 thn)';
                } elseif ($ageYears < 75) {
                    $cat = 'Lansia (60–74 thn)';
                } else {
                    $cat = 'Tua (≥75 thn)';
                }

                return $cat;
            })
            ->countBy();

        // Pastikan urutan label konsisten
        $ageLabels = [
            'Neonatal (0–28 hari)',
            'Bayi (29 hari–<1 thn)',
            'Anak-anak (1–12 thn)',
            'Remaja (13–17 thn)',
            'Dewasa Muda (18–35 thn)',
            'Dewasa (36–59 thn)',
            'Lansia (60–74 thn)',
            'Tua (≥75 thn)',
            'Tidak diketahui',
        ];

        // Ambil nilai sesuai urutan label
        $ageCounts = array_map(function ($label) use ($ageData) {
            return $ageData->get($label, 0);
        }, $ageLabels);

        // Siapkan labels & data untuk chart umur
        $ageLabels = $ageData->keys()->toArray();
        $ageCounts = $ageData->values()->toArray();

        // 1) Statistik untuk yang punya data pendidikan (hidup dan bukan 'null' string)
        $eduStats = Resident::select(
            'pendidikan',
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as male"),
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as female"),
        )
            ->whereDoesntHave('populationDeath') // hanya yang hidup
            ->whereNotNull('pendidikan') // bukan NULL
            ->whereNotIn('pendidikan', ['', 'null']) // bukan '' ataupun 'null'
            ->groupBy('pendidikan')
            ->orderByRaw(
                "
        FIELD(pendidikan, 
            'Tidak/Belum Sekolah', 
            'TK/PAUD', 
            'SD', 
            'SMP', 
            'SMA/SMK', 
            'Diploma', 
            'Sarjana', 
            'Magister', 
            'Doktor')
    ",
            )
            ->get();

        // 2) Statistik untuk yang **tidak** punya data pendidikan
        $missingStats = Resident::select(
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as male"),
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as female"),
        )
            ->whereDoesntHave('populationDeath') // hanya yang hidup
            ->where(function ($q) {
                $q->whereNull('pendidikan')->orWhere('pendidikan', '')->orWhere('pendidikan', 'null'); // include literal 'null'
            })
            ->first();

        // 3) Tambahkan kategori “Belum Ada Data” kalau perlu
        if ($missingStats->male + $missingStats->female > 0) {
            $eduStats->push(
                (object) [
                    'pendidikan' => 'Belum Ada Data',
                    'male' => (int) $missingStats->male,
                    'female' => (int) $missingStats->female,
                ],
            );
        }

        // 4) Siapkan array untuk Chart.js
        $eduLabels = $eduStats->pluck('pendidikan');
        $eduMaleData = $eduStats->pluck('male');
        $eduFemaleData = $eduStats->pluck('female');
        $total = Resident::count();
        $male = Resident::where('jenis_kelamin', 'Laki-laki')->count();
        $female = Resident::where('jenis_kelamin', 'Perempuan')->count();
        $heads = FamilyCard::count(); // Kepala keluarga

        //
        // 2) Data Agama
        //
        // $religionStats = Resident::select('agama', DB::raw('COUNT(*) as count'))->groupBy('agama')->get();
        $religionStats = Resident::whereDoesntHave('populationDeath')
            ->select('agama', DB::raw('COUNT(*) as count'))
            ->groupBy('agama')
            ->get();
        //
        // 3) Data Pekerjaan
        $jobStats = Resident::select('pekerjaan', DB::raw('COUNT(*) as count'))
            ->whereNotNull('pekerjaan')
            ->whereDoesntHave('populationDeath') // hanya yang belum meninggal
            ->groupBy('pekerjaan')
            ->get()
            ->map(function ($item) {
                $item->pekerjaan = $item->pekerjaan === '' ? 'Belum Bekerja' : $item->pekerjaan;
                return $item;
            });

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
                // Pertanian & Alam
                Str::contains($j, ['tani', 'kebun']) => '🌱',
                Str::contains($j, ['ternak']) => '🐄',
                Str::contains($j, ['ikan', 'laut', 'perikanan']) => '🐟',
                Str::contains($j, ['hutan', 'perkebunan']) => '🌳',
                // Industri & Konstruksi
                Str::contains($j, ['industri', 'pabrik']) => '🏭',
                Str::contains($j, ['konstruksi', 'bangunan', 'engineer']) => '👷‍♂️',
                Str::contains($j, ['teknisi', 'teknik']) => '🛠️',
                // Transportasi & Logistik
                Str::contains($j, ['sopir', 'supir', 'driver']) => '🚗',
                Str::contains($j, ['pilot']) => '✈️',
                Str::contains($j, ['kurir', 'logistik']) => '📦',
                // Perdagangan & Jasa
                Str::contains($j, ['dagang', 'jualan', 'retail']) => '🛒',
                Str::contains($j, ['jasa', 'service']) => '💼',
                Str::contains($j, ['wisata', 'hotel', 'tour']) => '🏨',
                // Kesehatan
                Str::contains($j, ['dokter']) => '👨‍⚕️',
                Str::contains($j, ['perawat']) => '👩‍⚕️',
                Str::contains($j, ['apoteker']) => '💊',
                Str::contains($j, ['psikolog', 'psikiater']) => '🧠',
                // Pendidikan & Riset
                Str::contains($j, ['guru', 'pengajar']) => '🎓',
                Str::contains($j, ['dosen', 'lecturer']) => '👩‍🎓',
                Str::contains($j, ['peneliti', 'riset']) => '🔬',
                Str::contains($j, ['pelajar', 'mahasiswa']) => '🧑‍🎓',
                // Pemerintahan & Keamanan
                Str::contains($j, ['pns', 'pegawai negeri']) => '🏛️',
                Str::contains($j, ['tni', 'polri', 'tentara']) => '👮‍♂️',
                Str::contains($j, ['satpam', 'security']) => '🛡️',
                // Korporasi & Kantor
                Str::contains($j, ['karyawan', 'pegawai', 'staff', 'office']) => '🏢',
                Str::contains($j, ['manajer', 'manager', 'supervisor']) => '📋',
                Str::contains($j, ['admin', 'administrasi']) => '🗄️',
                // Kreatif & Media
                Str::contains($j, ['programmer', 'developer', 'it', 'software']) => '💻',
                Str::contains($j, ['designer', 'ui/ux', 'grafis']) => '🎨',
                Str::contains($j, ['jurnalis', 'wartawan', 'penulis']) => '🗞️',
                Str::contains($j, ['fotografer', 'fotografi']) => '📷',
                Str::contains($j, ['musisi', 'musik', 'penyanyi']) => '🎵',
                // Wirausaha
                Str::contains($j, ['wirausaha', 'wiraswasta', 'entrepreneur']) => '🚀',
                // Rumah tangga & Lainnya
                Str::contains($j, ['ibu rumah tangga']) => '🏠',
                // Default
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
                            <p class="text-green-700 text-2xl font-bold">
                                {{ number_format($total - ($maleDeaths + $femaleDeaths), 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-4 bg-blue-50 rounded-lg text-center">
                            <p class="text-gray-700 font-medium">Laki-laki</p>
                            <p class="text-blue-700 text-2xl font-bold">
                                {{ number_format($male - $maleDeaths, 0, ',', '.') }}</p>
                        </div>
                        <div class="p-4 bg-pink-50 rounded-lg text-center">
                            <p class="text-gray-700 font-medium">Perempuan</p>
                            <p class="text-pink-700 text-2xl font-bold">
                                {{ number_format($female - $femaleDeaths, 0, ',', '.') }}
                            </p>
                        </div>
                        {{-- <div class="p-4 bg-amber-50 rounded-lg text-center">
                            <p class="text-gray-700 font-medium">KK</p>
                            <p class="text-amber-700 text-2xl font-bold">{{ number_format($heads, 0, ',', '.') }}
                            </p>
                        </div> --}}
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
                        labels: ['Laki-laki', 'Perempuan'],
                        datasets: [{
                            data: [{{ $male - $maleDeaths }}, {{ $female - $femaleDeaths }}],
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

    {{-- Chart Pendidikan --}}
    <section id="pendidikan" class="py-12 px-4 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-green-800 mb-6 text-center">Pendidikan</h2>
            <canvas id="pendidikanChart"></canvas>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Chart.register(ChartDataLabels);

            @if ($eduStats->isNotEmpty())
                // Tambahkan emoji khusus untuk setiap jenjang pendidikan
                const eduEmojis = {
                    'Tidak/Belum Sekolah': '🚫',
                    'SD': '🏫',
                    'SMP': '🎒',
                    'SMA/SMK': '🎓',
                    'Diploma': '🎖️',
                    'Sarjana': '🎓',
                    'Magister': '🎓',
                    'Doktor': '👨‍🔬'
                };

                // Ganti setiap label dengan label + emoji
                const labelsWithEmoji = @json($eduLabels).map(label =>
                    `${eduEmojis[label] || ''} ${label}`);

                new Chart(document.getElementById('pendidikanChart'), {
                    type: 'bar',
                    data: {
                        labels: labelsWithEmoji,
                        datasets: [{
                                label: '👦 Laki-laki',
                                data: @json($eduMaleData),
                                backgroundColor: '#3B82F6',
                                borderRadius: 6,
                                stack: 'gen'
                            },
                            {
                                label: '👧 Perempuan',
                                data: @json($eduFemaleData),
                                backgroundColor: '#EC4899',
                                borderRadius: 6,
                                stack: 'gen'
                            }
                        ]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        plugins: {
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                formatter: v => {
                                    // Variasi emoji per digit
                                    const emojis = ['🎓', '📚', '🧮', '🔢'];
                                    const emoji = emojis[v.toString().length % emojis.length];
                                    return `${emoji} ${v.toLocaleString('id')}`;
                                },
                                font: {
                                    weight: '600',
                                    size: 12
                                }
                            },
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    padding: 16,
                                    generateLabels: chart => {
                                        // Tambahkan flare emoji ke legend
                                        return Chart.defaults.plugins.legend.labels.generateLabels(
                                            chart).map(item => {
                                            item.text =
                                                `${item.text} ${item.text.includes('👦') ? '🧑‍🎓' : '👩‍🎓'}`;
                                            return item;
                                        });
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    title: ctx => {
                                        // Tampilkan emoji jenjang di tooltip title
                                        const rawLabel = @json($eduLabels)[ctx[0].dataIndex];
                                        return `${eduEmojis[rawLabel] || ''} ${rawLabel}`;
                                    },
                                    label: ctx => {
                                        const val = ctx.parsed.x;
                                        const genderEmoji = ctx.dataset.label.includes('Laki') ? '👦' :
                                            '👧';
                                        return `${genderEmoji} ${ctx.dataset.label.split(' ')[1]}: ${val.toLocaleString('id')} jiwa`;
                                    }
                                },
                                backgroundColor: 'rgba(0,0,0,0.7)',
                                titleFont: {
                                    size: 14,
                                    weight: '700'
                                },
                                bodyFont: {
                                    size: 12
                                }
                            }
                        },
                        scales: {
                            x: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Penduduk 🧮',
                                    font: {
                                        size: 14,
                                        weight: '600'
                                    }
                                },
                                ticks: {
                                    callback: v => `🔢 ${v.toLocaleString('id')}`
                                }
                            },
                            y: {
                                stacked: true,
                                title: {
                                    display: true,
                                    text: 'Pendidikan 📚',
                                    font: {
                                        size: 14,
                                        weight: '600'
                                    }
                                },
                                ticks: {
                                    font: {
                                        size: 13
                                    }
                                }
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

    <!-- Alpine.js for slider -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Chart.register(ChartDataLabels);

            @if ($total > 0)
                new Chart(document.getElementById('bloodTypeChart'), {
                    type: 'doughnut',
                    data: {
                        labels: @json($bloodStats->pluck('type')), // ['A','B','AB','O', ...]
                        datasets: [{
                            data: @json($bloodStats->pluck('count')), // [jumlah A, jumlah B, ...]
                            backgroundColor: @json(array_slice($colors, 0, $bloodStats->count())),
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

    {{-- =======================
 Section: Golongan Darah Penduduk
======================= --}}
    <!-- Improved Blood Types Section -->
    <section id="blood-types" class="py-16 px-6 bg-gradient-to-r from-green-50 to-green-100">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 lg:p-12 space-y-8">
            <h2 class="text-4xl font-extrabold text-green-800 text-center">Statistik Golongan Darah</h2>

            @if ($total > 0)
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <!-- Chart -->
                    <div class="w-full lg:w-1/2">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <canvas id="bloodTypeChart"></canvas>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="w-full lg:w-1/2 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($bloodStats as $stat)
                            <div
                                class="p-4 bg-red-50 rounded-lg shadow-sm border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                                <p class="text-sm text-red-900 uppercase tracking-wide"> {{ $stat->type }}</p>
                                <p class="mt-2 text-2xl font-bold text-green-800">
                                    {{ number_format($stat->count, 0, ',', '.') }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500 italic">Belum ada data golongan darah penduduk.</p>
            @endif
        </div>
    </section>

    <!-- Improved Death Stats Section -->
    <section id="death-stats" class="py-16 px-6 bg-gradient-to-r from-red-50 to-red-100">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-8 lg:p-12 space-y-8">
            <h2 class="text-4xl font-extrabold text-red-800 text-center">Statistik Kematian Penduduk</h2>

            @if ($totalDeaths > 0)
                <div class="flex flex-col lg:flex-row items-center gap-12">
                    <!-- Gender Pie Chart -->
                    <div class="w-full lg:w-1/2">
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <canvas id="deathGenderChart"></canvas>
                        </div>
                    </div>

                    <!-- Facts -->
                    <div class="w-full lg:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="p-6 bg-red-50 rounded-lg shadow-sm border-l-4 border-red-500">
                            <p class="text-sm text-red-700 uppercase tracking-wide">Total Kematian</p>
                            <p class="mt-2 text-3xl font-bold text-red-800">{{ number_format($totalDeaths, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="p-6 bg-blue-50 rounded-lg shadow-sm border-l-4 border-blue-500">
                            <p class="text-sm text-blue-700 uppercase tracking-wide">Laki-laki</p>
                            <p class="mt-2 text-3xl font-bold text-blue-800">{{ number_format($maleDeaths, 0, ',', '.') }}
                            </p>
                            <p class="mt-1 text-sm text-gray-600">{{ $percentMale }}%</p>
                        </div>
                        <div class="p-6 bg-pink-50 rounded-lg shadow-sm border-l-4 border-pink-500">
                            <p class="text-sm text-pink-700 uppercase tracking-wide">Perempuan</p>
                            <p class="mt-2 text-3xl font-bold text-pink-800">
                                {{ number_format($femaleDeaths, 0, ',', '.') }}</p>
                            <p class="mt-1 text-sm text-gray-600">{{ $percentFemale }}%</p>
                        </div>
                    </div>
                </div>

                <!-- Age Distribution Chart -->
                <div class="mt-12">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6 text-center">Distribusi Umur Saat Meninggal</h3>
                    <div class="w-full mx-auto max-w-lg bg-white p-6 rounded-lg shadow-md">
                        <canvas id="deathAgeChart"></canvas>
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500 italic">Belum ada data kematian yang tercatat.</p>
            @endif
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Chart.register(ChartDataLabels);

            @if ($totalDeaths > 0)
                // 1) Doughnut Chart: Persentase Gender
                new Chart(document.getElementById('deathGenderChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Laki-laki', 'Perempuan'],
                        datasets: [{
                            data: [{{ $maleDeaths }}, {{ $femaleDeaths }}],
                            backgroundColor: @json(['#3B82F6', '#EC4899']),
                            borderColor: '#fff',
                            borderWidth: 2,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        cutout: '70%',
                        responsive: true,
                        plugins: {
                            datalabels: {
                                formatter: (v, ctx) => v + '%',
                                color: '#fff',
                                font: {
                                    weight: '600',
                                    size: 12
                                }
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // 2) Bar Chart: Distribusi Umur Saat Meninggal
                new Chart(document.getElementById('deathAgeChart'), {
                    type: 'bar',
                    data: {
                        labels: @json($ageLabels),
                        datasets: [{
                            label: 'Jumlah Meninggal',
                            data: @json($ageCounts),
                            backgroundColor: 'rgba(239, 68, 68, 0.6)',
                            borderColor: 'rgba(239, 68, 68, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        indexAxis: 'y', // opsional: bar horizontal
                        responsive: true,
                        scales: {
                            x: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'right',
                                formatter: v => v
                            }
                        }
                    }
                });
            @endif
        });
    </script>


    {{-- resources/views/dashboard/age-range.blade.php --}}
    <section id="age-range-chart" class="py-12 px-4 bg-gray-50">
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Distribusi Usia Penduduk</h2>
            @php
                // use App\Models\Resident;

                // Definisikan rentang umur
                $ageRanges = [
                    'Anak (0–17)' => [0, 17],
                    'Dewasa (18–55)' => [18, 55],
                    'Lansia (56+)' => [56, 200],
                ];

                $labels = array_keys($ageRanges);
                $maleCounts = [];
                $femaleCounts = [];

                foreach ($ageRanges as $range) {
                    [$min, $max] = $range;

                    // Hanya yang masih hidup
                    $maleCounts[] = Resident::whereDoesntHave('populationDeath')
                        ->where('jenis_kelamin', 'Laki-laki')
                        ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$min, $max])
                        ->count();

                    $femaleCounts[] = Resident::whereDoesntHave('populationDeath')
                        ->where('jenis_kelamin', 'Perempuan')
                        ->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [$min, $max])
                        ->count();
                }
            @endphp

            <canvas id="ageRangeChart"></canvas>
        </div>
    </section>

    {{-- @push('scripts') --}}
    {{-- Pastikan layout utama memanggil @stack('scripts') sebelum closing </body> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('ageRangeChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels),
                    datasets: [{
                            label: 'Laki-laki',
                            // data: @json($maleCounts),
                            data: @json($maleCounts),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Perempuan',
                            data: @json($femaleCounts),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Jumlah Penduduk'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Rentang Usia'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            formatter: v => v,
                            font: {
                                weight: '600',
                                size: 12
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutBounce'
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>
    {{-- @endpush --}}
    {{-- resources/views/dashboard/age-category.blade.php --}}
    @php
        use Illuminate\Support\Facades\Cache;

        // 1) Definisikan rentang umur (tahun)
        $ageCategories = [
            'Balita & Batita (0–5)' => [0, 5],
            'Anak-Anak (6–12)' => [6, 12],
            'Remaja (13–18)' => [13, 18],
            'Dewasa (19–59)' => [19, 59],
            'Lansia (60+)' => [60, 200],
        ];

        // 2) Hitung jumlah & persentase
        $counts = [];
        foreach ($ageCategories as $label => [$min, $max]) {
            $counts[$label] = Resident::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN ? AND ?', [
                $min,
                $max,
            ])->count();
        }
        $total = array_sum($counts);
        $percentages = [];
        foreach ($counts as $label => $c) {
            $percentages[$label] = $total > 0 ? round(($c / $total) * 100, 1) : 0;
        }

        // Warnai chart dengan warna cerah
        $colors = ['#4CAF50', '#2196F3', '#FF9800', '#9C27B0', '#F44336'];
    @endphp
    <section id="age-category" class="py-12 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Kategori Umur</h2>

            <div class="flex flex-col lg:flex-row items-start gap-8">
                {{-- Doughnut Chart --}}
                <div class="w-full lg:w-1/3">
                    <canvas id="ageCategoryChart"></canvas>

                    {{-- Total & daftar ringkasan --}}
                    <div class="mt-6 text-gray-700">
                        <p class="font-medium mb-2">Total Data: {{ number_format($total) }} Jiwa</p>
                        @foreach ($counts as $label => $c)
                            <p class="text-sm">
                                {{ $label }}: {{ number_format($c) }} Jiwa ({{ $percentages[$label] }}%)
                            </p>
                        @endforeach
                    </div>
                </div>

                {{-- Kartu per kategori dengan emoji --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-1">
                    @foreach ($ageCategories as $label => $_)
                        @php
                            // Tentukan emoji per kategori
                            $emojiMap = [
                                'Balita & Batita (0–5)' => '👶',
                                'Anak-Anak (6–12)' => '🧒',
                                'Remaja (13–18)' => '🧑‍🎓',
                                'Dewasa (19–59)' => '🧑‍💼',
                                'Lansia (60+)' => '👵',
                            ];
                            $emoji = $emojiMap[$label] ?? '❓';
                            // Ambil kata pertama sebagai judul ringkas
                            $title = explode(' ', $label)[0];
                        @endphp

                        <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center">
                            <div class="text-5xl mb-2">{{ $emoji }}</div>
                            <h3 class="font-semibold text-gray-800 text-center">{{ $title }}</h3>
                            <p class="text-xl text-green-600 font-bold">{{ $percentages[$label] }}%</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- @push('scripts') --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('ageCategoryChart').getContext('2d');
            const labels = @json(array_keys($ageCategories));
            const data = @json(array_values($percentages));
            const colors = @json($colors);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels,
                    datasets: [{
                        data,
                        backgroundColor: colors,
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    cutout: '60%',
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: v => v + '%',
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
                        duration: 800,
                        easing: 'easeOutBounce'
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>
    {{-- @endpush --}}
    {{-- resources/views/dashboard/marital-status.blade.php --}}
    @php
        // use App\Models\Resident;

        // 1) Definisikan kategori status perkawinan
        $statusCategories = [
            'Belum Kawin' => 'Belum Kawin',
            'Kawin' => 'Kawin',
            'Cerai Mati' => 'Cerai Mati',
            'Cerai Hidup' => 'Cerai Hidup',
        ];

        // 2) Hitung jumlah & persentase tiap kategori (hanya yang hidup)
        $counts = [];
        foreach ($statusCategories as $label) {
            $counts[$label] = Resident::whereDoesntHave('populationDeath') // hanya hidup
                ->where('status_perkawinan', $label)
                ->count();
        }
        $total = array_sum($counts);

        $percentages = [];
        foreach ($counts as $label => $c) {
            $percentages[$label] = $total > 0 ? round(($c / $total) * 100) : 0;
        }

        // 3) Warna chart
        $colors = ['#4CAF50', '#2196F3', '#FF9800', '#F44336'];
    @endphp


    <section id="marital-status" class="py-12 px-4 bg-gray-50">
        <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-8">Perkawinan</h2>

            <div class="flex flex-col lg:flex-row items-start gap-8">
                {{-- Doughnut Chart + Ringkasan --}}
                <div class="w-full lg:w-1/3">
                    <canvas id="maritalChart"></canvas>

                    <div class="mt-6 text-gray-700">
                        <p class="font-medium mb-2">Total Data: {{ number_format($total) }} Jiwa</p>
                        @foreach ($counts as $label => $c)
                            <p class="text-sm">
                                {{ $label }}: {{ number_format($c) }} Jiwa ({{ $percentages[$label] }}%)
                            </p>
                        @endforeach
                    </div>
                </div>

                {{-- Kartu per kategori dengan emoji --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 flex-1">
                    @php
                        $emojiMap = [
                            'Belum Kawin' => '💌',
                            'Kawin' => '💑',
                            'Cerai Mati' => '⚰️',
                            'Cerai Hidup' => '💔',
                        ];
                    @endphp

                    @foreach ($statusCategories as $label)
                        <div class="bg-gray-50 rounded-lg p-6 flex flex-col items-center">
                            <div class="text-5xl mb-2">{{ $emojiMap[$label] }}</div>
                            <h3 class="font-semibold text-gray-800 text-center">{{ $label }}</h3>
                            <p class="text-xl text-green-600 font-bold">{{ $percentages[$label] }}%</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- @push('scripts') --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('maritalChart').getContext('2d');
            const labels = @json(array_keys($statusCategories));
            const data = @json(array_values($percentages));
            const bgColors = @json($colors);

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels,
                    datasets: [{
                        data,
                        backgroundColor: bgColors,
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    cutout: '60%',
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: v => v + '%',
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
                        duration: 800,
                        easing: 'easeOutBounce'
                    }
                },
                plugins: [ChartDataLabels]
            });
        });
    </script>
    {{-- @endpush --}}

@endsection