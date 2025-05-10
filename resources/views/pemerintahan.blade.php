{{-- resources/views/pemerintahan.blade.php --}}
@extends('layouts.app')

@section('title', 'Pemerintahan Desa Karangmangu')

@section('content')
    <!-- Hero Slider -->
    <section x-data="{
        slides: [
            { src: 'https://picsum.photos/1200/400?random=1', title: 'LPM (Lembaga Pemberdayaan Masyarakat)' },
            { src: 'https://picsum.photos/1200/400?random=2', title: 'Karang Taruna' },
            { src: 'https://picsum.photos/1200/400?random=3', title: 'PKK (Pemberdayaan Kesejahteraan Keluarga)' }
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
                        ['Lurah Winduherang', 'H. Ikin Sodikin, S.Sn'],
                        ['Sekretaris Kelurahan', 'N. Dedeh Kurniaish, SE'],
                        ['Ka. Seksi Pemerintahan & Trantibum', 'Toto Herianto, S.I.P'],
                        ['Ka. Seksi Perekonomian, Pembangunan & Pemberdayaan Masyarakat', 'Anis Nopriyani'],
                        ['Ka. Seksi Kesejahteraan Rakyat', 'Dini Heridiani, SE'],
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
        // use App\Models\Resident;
        use Carbon\Carbon;
        // 1) Tahun sekarang
        $year = Carbon::now()->year;

        // 2) Ambil semua record kematian tahun ini, plus relasi resident
        $deaths = PopulationDeath::with('resident')->whereYear('tanggal_meninggal', $year)->get();

        // 3) Total kematian, laki-laki & perempuan
        $totalDeaths = $deaths->count();
        $maleDeaths = $deaths->filter(fn($d) => $d->resident && $d->resident->jenis_kelamin === 'Laki-laki')->count();
        $femaleDeaths = $deaths->filter(fn($d) => $d->resident && $d->resident->jenis_kelamin === 'Perempuan')->count();

        // 4) Rata-rata umur (dalam tahun, 1 desimal)
        $ages = $deaths
            ->filter(fn($d) => $d->resident && $d->resident->tanggal_lahir)
            ->map(fn($d) => $d->tanggal_meninggal->diffInYears($d->resident->tanggal_lahir))
            ->toArray();

        $avgAge = count($ages) ? round(array_sum($ages) / count($ages), 1) : 0;
        $eduStats = Resident::select(
            'pendidikan',
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'Laki-laki' THEN 1 ELSE 0 END) as male"),
            DB::raw("SUM(CASE WHEN jenis_kelamin = 'Perempuan' THEN 1 ELSE 0 END) as female"),
        )
            ->whereNotNull('pendidikan')
            ->groupBy('pendidikan')
            ->orderByRaw(
                "FIELD(pendidikan, 'TK/PAUD','SD','SMP','SMA','DIPLOMA','SARJANA (S1)','MAJISTER (S2)','DOKTOR (S3)')",
            )
            ->get();

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

    {{-- Chart Pendidikan --}}
    <section id="pendidikan" class="py-12 px-4 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-green-800 mb-6 text-center">Pendidikan & Gender</h2>
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

    <div id="deathApp" class="max-w-4xl mx-auto px-4 py-8">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-6 text-gray-800 text-center">
                Distribusi Kematian Tahun {{ $year }}
            </h2>

            <!-- Chart -->
            <div class="flex justify-center mb-6">
                <div class="w-[260px] sm:w-[300px]">
                    <canvas id="deathPieChart"></canvas>
                </div>
            </div>

            <!-- Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 text-center text-gray-700">
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Total Kematian</p>
                    <p class="text-xl font-semibold">{{ number_format($totalDeaths, 0, ',', '.') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Laki-laki</p>
                    <p class="text-xl font-semibold">{{ number_format($maleDeaths, 0, ',', '.') }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                    <p class="text-sm text-gray-500">Perempuan</p>
                    <p class="text-xl font-semibold">{{ number_format($femaleDeaths, 0, ',', '.') }}</p>
                </div>
            </div>

            <!-- Rata-rata umur -->
            <p class="mt-6 text-center text-gray-600 text-sm">
                Rata-rata umur saat meninggal:
                <span class="font-semibold">{{ number_format($avgAge, 1) }} tahun</span>
            </p>
        </div>
    </div>

    {{-- @push('scripts') --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Chart.register(ChartDataLabels);

            const total = @json($totalDeaths);
            const male = @json($maleDeaths);
            const female = @json($femaleDeaths);
            const avgAge = @json($avgAge);

            const ctx = document.getElementById('deathPieChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['👦 Laki-laki', '👧 Perempuan'],
                    datasets: [{
                        data: [male, female],
                        backgroundColor: ['#3B82F6', '#EC4899'],
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 8
                    }]
                },
                options: {
                    cutout: '65%',
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                pointStyle: 'circle',
                                font: {
                                    size: 13
                                }
                            }
                        },
                        datalabels: {
                            color: '#fff',
                            formatter: v => {
                                const pct = (v / total * 100).toFixed(0);
                                return `${pct}%\n(${v})`;
                            },
                            font: {
                                weight: '600',
                                size: 12
                            },
                            anchor: 'center',
                            align: 'center'
                        },
                        beforeDraw: chart => {
                            const {
                                width,
                                height,
                                ctx
                            } = chart;
                            ctx.save();
                            ctx.font = '600 14px sans-serif';
                            ctx.fillStyle = '#333';
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.fillText('Avg Umur', width / 2, height / 2 - 10);
                            ctx.font = '700 16px sans-serif';
                            ctx.fillText(`${avgAge} th`, width / 2, height / 2 + 14);
                            ctx.restore();
                        }
                    }
                }
            });
        });
    </script>
    {{-- @endpush --}}
    

    <!-- Alpine.js for slider -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    
@endsection