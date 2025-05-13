{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Dashboard Admin Desa Karangmangu')

@section('content')
    @php
        use App\Models\Resident;
        use App\Models\FamilyCard;
        use App\Models\Rt;
        use App\Models\Rw;
        use App\Models\Hamlet;
        use App\Models\GalleryItem;
        use App\Models\Contact;
        use App\Models\Article;
        use App\Models\VillageStall;
        use App\Models\PopulationDeath;
        use Illuminate\Support\Facades\DB;

        // Counts
        $totalResidents = Resident::whereDoesntHave('populationDeath')->count();
        $totalFamilies = FamilyCard::count();
        $totalRt = Rt::count();
        $totalRw = Rw::count();
        $totalDusun = Hamlet::count();
        $totalGallery = GalleryItem::count();
        $totalContacts = Contact::count();
        $totalArticles = Article::count();
        $totalVillageStalls = VillageStall::count();
        $totalPopulationDeaths = PopulationDeath::count();

        // Gender distribution (only alive)
        $maleCount = Resident::whereDoesntHave('populationDeath')->where('jenis_kelamin', 'Laki-laki')->count();

        $femaleCount = Resident::whereDoesntHave('populationDeath')->where('jenis_kelamin', 'Perempuan')->count();

        $genderSum = $maleCount + $femaleCount;

        // Religion distribution
        // Religion distribution (only alive)
        $religionStats = Resident::whereDoesntHave('populationDeath')
            ->select('agama', DB::raw('COUNT(*) as count'))
            ->groupBy('agama')
            ->get();

        $religionLabels = $religionStats->pluck('agama')->toArray();
        $religionData = $religionStats->pluck('count')->toArray();
        $religionSum = array_sum($religionData);

        // Generate colors for each religion
        $palette = ['#22C55E', '#3B82F6', '#F59E0B', '#EC4899', '#8B5CF6', '#F97316'];
        $religionColors = [];
        foreach ($religionData as $i => $val) {
            $religionColors[] = $palette[$i % count($palette)];
        }

        // Trending pekerjaan: top 5 most common
        $trendingJobs = Resident::whereDoesntHave('populationDeath')
            ->select([
                DB::raw("
            CASE
                WHEN pekerjaan IS NULL OR pekerjaan = '' THEN 'Tidak Bekerja'
                ELSE pekerjaan
            END AS pekerjaan
        "),
                DB::raw('COUNT(*) as count'),
            ])
            ->groupBy('pekerjaan')
            ->orderByDesc('count')
            ->limit(5)
            ->get();
    @endphp

    <div class="container mx-auto py-12 px-4" data-aos="fade-up">
        <h1
            class="text-4xl sm:text-5xl font-extrabold text-center text-white mb-10 bg-gradient-to-r from-purple-600 to-pink-500 p-4 rounded-2xl shadow-lg">
            📊 Dashboard Admin Desa Karangmangu
        </h1>

        {{-- Summary Tiles --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-10">

            {{-- Total Penduduk --}}
            <a href="{{ route('penduduk.index') }}"
                class="block bg-gradient-to-br from-blue-200 to-blue-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">👥</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">Total Penduduk</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ number_format($totalResidents) }}</p>
                    </div>
                </div>
            </a>

            {{-- Total KK --}}
            <a href="{{ route('kk.index') }}"
                class="block bg-gradient-to-br from-green-200 to-green-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">🏠</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">Total KK</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ number_format($totalFamilies) }}</p>
                    </div>
                </div>
            </a>

            {{-- Dusun --}}
            <a href="{{ route('dusun.index') }}"
                class="block bg-gradient-to-br from-yellow-200 to-yellow-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">🌳</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">Dusun</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalDusun }}</p>
                    </div>
                </div>
            </a>

            {{-- RW --}}
            <a href="{{ route('rw.index') }}"
                class="block bg-gradient-to-br from-purple-200 to-purple-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">🛡️</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">RW</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalRw }}</p>
                    </div>
                </div>
            </a>

            {{-- RT --}}
            <a href="{{ route('rt.index') }}"
                class="block bg-gradient-to-br from-red-200 to-red-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">🚩</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">RT</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalRt }}</p>
                    </div>
                </div>
            </a>

            {{-- Lapak Desa --}}
            <a href="{{ route('lapak_desa.index') }}"
                class="block bg-gradient-to-br from-teal-200 to-teal-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">🏪</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">Village Stalls</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalVillageStalls }}</p>
                    </div>
                </div>
            </a>

            {{-- Kematian --}}
            <a href="{{ route('kematian.index') }}"
                class="block bg-gradient-to-br from-indigo-200 to-indigo-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">⚰️</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">Population Deaths</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalPopulationDeaths }}</p>
                    </div>
                </div>
            </a>

            {{-- Galeri --}}
            <a href="{{ route('admin.gallery.index') }}"
                class="block bg-gradient-to-br from-indigo-200 to-indigo-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">🖼️</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">Gallery</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalGallery }}</p>
                    </div>
                </div>
            </a>

            {{-- Artikel --}}
            <a href="{{ route('admin.article.index') }}"
                class="block bg-gradient-to-br from-teal-200 to-teal-400 rounded-2xl shadow-lg p-6 hover:scale-105 transform transition duration-300">
                <div class="flex items-center">
                    <div class="text-4xl mr-3">📰</div>
                    <div>
                        <p class="text-sm text-gray-700 uppercase">Artikel</p>
                        <p class="text-2xl sm:text-3xl font-extrabold text-gray-900">{{ $totalArticles }}</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Charts & Trending --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Gender Chart --}}
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl sm:text-2xl font-semibold text-green-800 mb-4 text-center">Distribusi Jenis Kelamin</h3>
                <canvas id="genderChart" class="w-full h-48 sm:h-64"></canvas>
            </div>

            {{-- Religion Chart --}}
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl sm:text-2xl font-semibold text-green-800 mb-4 text-center">Distribusi Agama</h3>
                <canvas id="religionChart" class="w-full h-48 sm:h-64"></canvas>
            </div>

            {{-- Trending Pekerjaan --}}
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h3 class="text-xl sm:text-2xl font-semibold text-green-800 mb-4 text-center">Trending Pekerjaan</h3>
                <ul class="space-y-2">
                    @forelse($trendingJobs as $job)
                        <li class="flex justify-between items-center px-4 py-2 bg-green-50 rounded-lg">
                            <span class="font-medium text-gray-800">{{ $job->pekerjaan }}</span>
                            <span class="text-gray-600">{{ $job->count }}</span>
                        </li>
                    @empty
                        <li class="text-center text-gray-500">Belum ada data pekerjaan.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                once: true
            });
            Chart.register(ChartDataLabels);

            // Gender Chart
            new Chart(document.getElementById('genderChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $maleCount }}, {{ $femaleCount }}],
                        backgroundColor: ['#3B82F6', '#EC4899'],
                        borderColor: '#fff',
                        borderWidth: 2
                    }]
                },
                options: {
                    cutout: '60%',
                    responsive: true,
                    plugins: {
                        datalabels: {
                            formatter: v => ((v / {{ $genderSum }}) * 100).toFixed(1) + '%',
                            color: '#fff',
                            font: {
                                weight: '600',
                                size: 11
                            }
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Religion Chart
            new Chart(document.getElementById('religionChart'), {
                type: 'bar',
                data: {
                    labels: @json($religionLabels),
                    datasets: [{
                        label: 'Jumlah',
                        data: @json($religionData),
                        backgroundColor: @json($religionColors)
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        datalabels: {
                            anchor: 'end',
                            align: 'end',
                            formatter: v => ((v / {{ $religionSum }}) * 100).toFixed(1) + '%',
                            color: '#000',
                            font: {
                                weight: '600',
                                size: 10
                            }
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection