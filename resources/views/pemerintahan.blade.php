{{-- resources/views/pemerintahan.blade.php --}}
@extends('layouts.app')

@section('title', 'Pemerintahan Desa Winduherang')

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

    <div class="max-w-7xl mx-auto px-4 py-16 space-y-24">
        {{-- LPM Section --}}
        <section class="container mx-auto px-4 md:px-8 py-10">
            {{-- Header --}}
            <div class="text-center mb-12">
                <div class="inline-flex items-center space-x-2 mb-4">
                    {{-- users icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-800" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 00-3.33-3.95M9 20H4v-2a4 4 0 013.33-3.95M16 7a4 4 0 11-8 0 4 4 0 018 0zm6 0a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-300 inline-block">
                        LPM (Lembaga Pemberdayaan Masyarakat)
                    </h2>
                </div>
                <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto">
                    LPM di Kelurahan Winduherang, Kecamatan Cigugur, Kabupaten Kuningan adalah lembaga yang dibentuk
                    untuk memberdayakan warga dan menjadi mitra pemerintah desa dalam merencanakan, melaksanakan,
                    serta mengevaluasi program pembangunan.
                </p>
            </div>

            {{-- Image & Content --}}
            <div class="flex flex-col md:flex-row items-start gap-8">
                {{-- Image --}}
                <div class="w-full md:w-1/2">
                    <div class="rounded-lg overflow-hidden shadow-lg group">
                        <img src="{{ asset('images/foto 1.jpg') }}" alt="Struktur LPM"
                            class="w-full h-80 object-cover transform transition duration-500 group-hover:scale-105">
                    </div>
                </div>

                {{-- Struktur Lembaga --}}
                <div class="w-full md:w-1/2 space-y-6">
                    <div class="inline-flex items-center space-x-2">
                        {{-- chart icon --}}
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-700" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 17v-6m4 6v-10m4 10v-5m4 5v-3" />
                        </svg>
                        <h3 class="text-2xl font-semibold text-gray-800">
                            Struktur Lembaga
                        </h3>
                    </div>

                    <div class="prose">
                        <p class="uppercase text-sm text-gray-600 mb-5">
                            Susunan Pengurus LPM Kelurahan Winduherang<br>
                            Kecamatan Cigugur, Kabupaten Kuningan<br>
                            Masa Bhakti 2022 – 2027
                        </p>

                        <ol class="list-decimal list-inside space-y-1">
                            <li>Ketua: Jojo Johari</li>
                            <li>Wakil Ketua: Udi Suhendi, S.Sos, M.Si</li>
                            <li>Sekretaris I: Titi Mulyati, S.Pd</li>
                            <li>Sekretaris II: Masduki, S.Pd.I</li>
                            <li>Bendahara: H. Jana, S.Pd, M.Pd</li>
                        </ol>

                        <p class="font-semibold mt-6">Seksi – Seksi:</p>
                        <ol class="list-decimal list-inside space-y-4 ml-4">
                            <li>
                                Keamanan, Ketertiban dan Ketenteraman (Perlindungan Masyarakat)
                                <ul class="list-disc list-inside ml-6">
                                    <li>Nana Hadiyana</li>
                                    <li>Asep Wiharya</li>
                                </ul>
                            </li>
                            <li>
                                Pendidikan (Olahraga dan Kesenian)
                                <ul class="list-disc list-inside ml-6">
                                    <li>Nana Iryana, S.Pd</li>
                                    <li>Dede Sudianto</li>
                                </ul>
                            </li>
                            <li>
                                Kesehatan
                                <ul class="list-disc list-inside ml-6">
                                    <li>Moch. Agni Purnama, ST</li>
                                    <li>Una Taruna, SE</li>
                                </ul>
                            </li>
                            <li>
                                Perekonomian (Pemberdayaan Perempuan, Anak, dan Remaja)
                                <ul class="list-disc list-inside ml-6">
                                    <li>Tati, S.Pd</li>
                                    <li>Yuyun Sumaiti, S.Sos</li>
                                </ul>
                            </li>
                            <li>
                                Pembangunan (Penataan Lingkungan)
                                <ul class="list-disc list-inside ml-6">
                                    <li>Doni Ramdhoni, SE</li>
                                    <li>Uci Adrusli, SE</li>
                                </ul>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        {{-- Karang Taruna Section --}}
        <section class="bg-gray-50 py-16" x-data="{ open: false }">
            <div class="max-w-6xl mx-auto px-4 space-y-12">

                {{-- Title and Description --}}
                <div class="text-center space-y-4">
                    <h2 class="text-4xl font-extrabold text-green-800 inline-flex items-center gap-3">
                        {{-- SVG Icon --}}
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 7l6 6-6 6M21 7l-6 6 6 6" />
                        </svg>
                        Karang Taruna
                    </h2>
                    <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto">
                        Karang Taruna Winduherang, atau Karang Taruna Sang Adipati, adalah organisasi pemuda di Kelurahan
                        Winduherang,
                        Kabupaten Kuningan, yang berfokus pada pemberdayaan masyarakat dan pengembangan potensi pemuda.
                        Mereka aktif dalam kegiatan sosial, lingkungan, dan ekonomi untuk meningkatkan kesejahteraan
                        masyarakat setempat.
                    </p>
                </div>

                {{-- Struktur Lembaga --}}
                <div class="space-y-8">
                    <h3 class="text-2xl font-semibold text-center text-gray-800">Struktur Lembaga</h3>
                    {{-- Kartu-kartu Struktur --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                        @php
                            $officers = [
                                ['Lurah Winduherang', 'H. Ikin Sodikin, S.Sn'],
                                ['Sekretaris Kelurahan', 'N. Dedeh Kurniasih, SE'],
                                ['Ka. Seksi Pemerintahan dan Trantibum', 'Belum terdata'],
                                ['Ka. Seksi Perekonomian, Pembangunan, dan Pemberdayaan Masyarakat', 'Anis Nopriyani'],
                                ['Ka. Seksi Kesejahteraan Rakyat', 'Dini Heridani, SE'],
                            ];
                        @endphp

                        @foreach ($officers as [$role, $name])
                            <div
                                class="bg-white rounded-xl shadow-md p-6 text-center hover:shadow-2xl hover:-translate-y-1 transition-all duration-300">
                                <div class="flex justify-center mb-4">
                                    {{-- SVG Avatar Icon --}}
                                    <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5.121 17.804A4 4 0 0112 16h0a4 4 0 016.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <p class="text-lg font-bold text-green-700">{{ $role }}</p>
                                <p class="text-gray-600">{{ $name }}</p>
                            </div>
                        @endforeach
                    </div>

                    {{-- Gambar Struktur --}}
                    <div class="flex justify-center pt-10">
                        <div class="rounded-2xl overflow-hidden shadow-lg group w-full max-w-3xl cursor-pointer"
                            @click="open = true">
                            <img src="{{ asset('images/Struktur lembaga Karang Taruna 1.png') }}"
                                alt="Struktur Karang Taruna"
                                class="w-full h-80 object-cover transform transition duration-500 group-hover:scale-105" />
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Pop-up --}}
            <div x-show="open" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                <div class="bg-white rounded-2xl overflow-hidden shadow-2xl max-w-4xl w-full p-4 relative"
                    @click.away="open = false">
                    {{-- Close Button --}}
                    <button class="absolute top-3 right-3 text-gray-500 hover:text-red-500" @click="open = false">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <img src="{{ asset('images/Struktur lembaga Karang Taruna 1.png') }}" alt="Struktur Karang Taruna"
                        class="w-full h-auto" />
                </div>
            </div>
        </section>

        <!-- Posyandu Section -->
        <section>
            <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-300 inline-block mb-4 text-center" >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800 mr-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Posyandu
            </h2>
            
            <p class="text-gray-700 leading-relaxed mb-6 text-justify">
                Posyandu (Pos Pelayanan Terpadu) Winduherang adalah sebuah fasilitas
                kesehatan yang berfungsi untuk memberikan pelayanan kesehatan dasar kepada masyarakat,
                khususnya ibu dan anak, di Kelurahan Winduherang, Kabupaten Kuningan.
                Posyandu merupakan salah satu program pemerintah yang bertujuan untuk meningkatkan kesehatan
                masyarakat melalui pendekatan yang berbasis pada komunitas.
            </p>

            <h3 class="text-xl font-semibold text-center text-gray-800 mb-6 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800 mr-3" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 19l6-6 6 6"></path>
                </svg>
                Struktur Lembaga
            </h3>
            
            <div class="space-y-10 text-center">
                <table class="table-auto w-full border-separate border-spacing-2 mb-6 mx-auto">
                    <thead>
                        <tr>
                            <th class="border-b-2 border-gray-300 p-2 text-center">Jabatan</th>
                            <th class="border-b-2 border-gray-300 text-center p-2">Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border-b p-2 font-bold">Penanggung Jawab</td>
                            <td class="border-b p-2">Lurah Winduherang</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Ketua</td>
                            <td class="border-b p-2">Ny. Hj. Cucu Ikin</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Sekretaris</td>
                            <td class="border-b p-2">Ny. N. Dedeh Kurniasih, SE</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Bendahara</td>
                            <td class="border-b p-2">Ny. Dini Herdiani, SE</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Ketua Posyandu Lingga Kamuning</td>
                            <td class="border-b p-2">Ny. Inah Suginah</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Sekretaris Posyandu Lingga Kamuning</td>
                            <td class="border-b p-2">Sri Ratnawati</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Bendahara Posyandu Lingga Kamuning</td>
                            <td class="border-b p-2">Ny. Yati Suryati</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Anggota Posyandu Lingga Kamuning</td>
                            <td class="border-b p-2">Ny. Atit</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Ketua Posyandu Kramat Jaya</td>
                            <td class="border-b p-2">Ny. Siti Rusmayati</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Sekretaris Posyandu Kramat Jaya</td>
                            <td class="border-b p-2">Ny. Nia Suniarsih</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Bendahara Posyandu Kramat Jaya</td>
                            <td class="border-b p-2">Ny. Titi S. Yunari</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Anggota Posyandu Kramat Jaya</td>
                            <td class="border-b p-2">Ny. Eti</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Ketua Posyandu Lingga Harapan I</td>
                            <td class="border-b p-2">Ny. Yuli Arwati</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Sekretaris Posyandu Lingga Harapan I</td>
                            <td class="border-b p-2">Ny. Odah Saodah</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Bendahara Posyandu Lingga Harapan I</td>
                            <td class="border-b p-2">Ny. Oom Komariah</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Anggota Posyandu Lingga Harapan I</td>
                            <td class="border-b p-2">Ny. Yeni, Ny. Uun Unaesih</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Ketua Posyandu Lingga Harapan II</td>
                            <td class="border-b p-2">Ny. Ade Natikah</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Sekretaris Posyandu Lingga Harapan II</td>
                            <td class="border-b p-2">Ny. Mimin Karmini</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Bendahara Posyandu Lingga Harapan II</td>
                            <td class="border-b p-2">Ny. Rita Susiana</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Anggota Posyandu Lingga Harapan II</td>
                            <td class="border-b p-2">Ny. Ini, Ny. Eti</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Ketua Posyandu Lingga Harapan III</td>
                            <td class="border-b p-2">Ny. Nani Sumarni</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Sekretaris Posyandu Lingga Harapan III</td>
                            <td class="border-b p-2">Ny. Inah Marnah</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Bendahara Posyandu Lingga Harapan III</td>
                            <td class="border-b p-2">Ny. Heni Rosliana</td>
                        </tr>
                        <tr>
                            <td class="border-b p-2 font-bold">Anggota Posyandu Lingga Harapan III</td>
                            <td class="border-b p-2">Ny. Ami, Ny. Mia</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
    </div>
    </section>

    {{-- PKK Section --}}
    <section class="py-16 space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-300 inline-block">
                PKK (Pemberdayaan Kesejahteraan Keluarga)
            </h2>
        </div>
        <p class="text-gray-700 leading-relaxed text-center max-w-3xl mx-auto">
            Sebuah organisasi yang bertujuan untuk meningkatkan kesejahteraan keluarga melalui berbagai program yang
            mendukung pemberdayaan perempuan,
            anak, dan keluarga pada umumnya. Di tingkat kelurahan, seperti di Kelurahan Winduherang, PKK berfungsi sebagai
            wadah untuk mengembangkan
            berbagai kegiatan yang berkaitan dengan kesejahteraan masyarakat.
        </p>

        <h3 class="text-xl font-semibold text-center text-gray-800">Struktur Lembaga</h3>

        <div class="flex justify-center pt-10">
            <div class="rounded-2xl overflow-hidden shadow-lg group w-full max-w-3xl cursor-pointer" @click="open = true">
                <img src="{{ asset('images/PKK.png') }}" alt="Struktur PKK"
                    class="w-full h-80 object-cover transform transition duration-500 group-hover:scale-105" />
            </div>
        </div>
    </section>

    {{-- RT/RW Section --}}
    <section id="rt-rw" class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center mb-10">
            <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-300 inline-block">
                6. RT / RW
            </h2>
            <p class="text-gray-700 mt-4 max-w-2xl mx-auto text-justify">
                struktur organisasi sosial yang berfungsi mempererat hubungan antarwarga dan mendukung program pemerintah.
                RT adalah unit terkecil yang terdiri dari beberapa rumah tangga, dipimpin oleh Ketua RT, dan mengelola
                kegiatan sosial serta masalah sehari-hari di lingkungan tersebut. RW adalah kumpulan beberapa RT yang lebih
                luas, dipimpin oleh Ketua RW, yang bertugas mengkoordinasi kegiatan antar RT. Keduanya memiliki peran
                penting dalam memastikan kelancaran komunikasi, keamanan, dan pelaksanaan kebijakan di tingkat lokal.
            </p>

            <h3 class="text-2xl font-semibold text-gray-800 mt-10">Struktur Lembaga</h3>
        </div>

        @php
            $dataRT = [
                ['RT 01', 'Abung Sumita'],
                ['RT 04', 'Uci Suhri'],
                ['RT 05', 'H. Uci Adrusi'],
                ['RT 06', 'Mistar'],
                ['RT 07', 'Didi Sunardi'],
                ['RT 08', 'Mataraman'],
                ['RT 09', 'Oday Suharja'],
                ['RT 10', 'Ehon'],
                ['RT 11', 'Saud Richo. As'],
                ['RT 12', 'Udin Komarudin'],
                ['RT 13', 'Asep Wiharja'],
                ['RT 14', 'Sudarja'],
                ['RT 15', 'Drs. Maman Udiman'],
                ['RT 16', 'Mustafa'],
            ];

            $dataRW = [
                ['RW 01', 'Udin Wahyudin'],
                ['RW 02', 'Uu Suhri'],
                ['RW 03', 'Nono Warno'],
                ['RW 04', 'Iman Suratmat'],
                ['RW 05', 'Uci Madrusi, S.Pd'],
            ];
        @endphp

        <div class="flex flex-col md:flex-row justify-center gap-8 mt-6 px-4">
            {{-- Tabel RT --}}
            <div class="w-full md:w-1/2">
                <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">RT</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nama Ketua</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($dataRT as $rt)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-green-50' }}">
                                <td class="px-4 py-3 text-gray-800">{{ $rt[0] }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $rt[1] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Tabel RW --}}
            <div class="w-full md:w-1/3">
                <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">RW</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nama Ketua</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($dataRW as $rw)
                            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-green-50' }}">
                                <td class="px-4 py-3 text-gray-800">{{ $rw[0] }}</td>
                                <td class="px-4 py-3 text-gray-800">{{ $rw[1] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Linmas Section --}}
    <section class="py-16 space-y-6">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-green-800 border-b-4 border-green-300 inline-block">
                Linmas
            </h2>
        </div>

        <p class="text-gray-700 leading-relaxed text-center max-w-3xl mx-auto">
            Linmas (Perlindungan Masyarakat) bertugas menjaga keamanan, ketertiban, dan membantu
            penanganan bencana di Desa Winduherang. Mereka siaga patroli malam, pengamanan acara,
            serta evakuasi saat darurat.
        </p>

        <h3 class="text-xl font-semibold text-center text-gray-800">Struktur Lembaga</h3>

        <div class="max-w-3xl mx-auto bg-white p-8 rounded-xl shadow-md space-y-4 text-center">
            <div>
                <p class="text-lg font-semibold text-green-700">Nama</p>
                <p class="text-gray-700">EDO</p>
            </div>
            <div>
                <p class="text-lg font-semibold text-green-700">Tempat / Tanggal Lahir</p>
                <p class="text-gray-700">Kuningan, 12 April 1980</p>
            </div>
            <div>
                <p class="text-lg font-semibold text-green-700">Pekerjaan</p>
                <p class="text-gray-700">Buruh Harian Lepas</p>
            </div>
            <div>
                <p class="text-lg font-semibold text-green-700">Alamat</p>
                <p class="text-gray-700">
                    RT. 14 RW. 005 Lingkungan Lingga Harapan<br>
                    Kelurahan Winduherang Kecamatan Cigugur
                </p>
            </div>
        </div>
    </section>


    {{-- Section 8: Kelompok Tani --}}
    <section id="kelompok-tani" class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 space-y-8">
            {{-- Judul --}}
            <div class="text-center space-y-2">
                <h2 class="text-3xl font-bold text-green-800">Kelompok Tani</h2>
                <h3 class="text-xl font-semibold text-gray-700">Susunan Pengurus Kelompok Tani Ewangga</h3>
                <p class="text-gray-600 italic">Kelurahan Winduherang, Kecamatan Cigugur, Kabupaten Kuningan</p>
            </div>

            {{-- Tabel Pengurus --}}
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg shadow divide-y divide-gray-200">
                    <thead class="bg-green-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">No</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nama</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Jabatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @php
                            $members = [
                                ['Sanusi', 'Ketua Kelompok'],
                                ['Nono Warno', 'Sekretaris Kelompok'],
                                ['Johadi Sutrisno', 'Bendahara Kelompok'],
                                ['Nono Sutrisno', 'Anggota Kelompok'],
                                ['Pepa Mandira', 'Anggota Kelompok'],
                                ['Adnan', 'Anggota Kelompok'],
                                ['Suprendi', 'Anggota Kelompok'],
                                ['Edi Suhamadi', 'Anggota Kelompok'],
                                ['Piala Satria', 'Anggota Kelompok'],
                                ['Aji Saju', 'Anggota Kelompok'],
                                ['Sukiran', 'Anggota Kelompok'],
                            ];
                        @endphp

                        @foreach ($members as $i => $m)
                            <tr class="{{ $i % 2 === 0 ? 'bg-white' : 'bg-green-50' }}">
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $i + 1 }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $m[0] }}</td>
                                <td class="px-4 py-3 text-sm text-gray-800">{{ $m[1] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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


    </div>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection