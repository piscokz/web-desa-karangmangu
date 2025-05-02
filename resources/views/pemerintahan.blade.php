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
                'hindu' => '🕉',
                'buddha' => '☸',
                'konghucu' => '☯',
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
                Str::contains($j, ['konstruksi', 'bangunan']) => '👷‍♂',
                Str::contains($j, ['teknisi', 'teknik']) => '🛠',
                Str::contains($j, ['sopir', 'supir']) => '🚗',
                Str::contains($j, ['dagang', 'jualan']) => '🛒',
                Str::contains($j, ['jasa']) => '💼',
                Str::contains($j, ['wisata']) => '🏨',
                Str::contains($j, ['dokter']) => '👨‍⚕',
                Str::contains($j, ['perawat']) => '👩‍⚕',
                Str::contains($j, ['apoteker']) => '💊',
                Str::contains($j, ['guru']) => '🎓',
                Str::contains($j, ['dosen']) => '👩‍🎓',
                Str::contains($j, ['peneliti', 'riset']) => '🔬',
                Str::contains($j, ['pns', 'pegawai negeri']) => '🏛',
                Str::contains($j, ['tni', 'polri']) => '👮‍♂',
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
    @include('sections.age-range')
    @include('sections.category_age-range')
    @include('sections.married-status')

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
