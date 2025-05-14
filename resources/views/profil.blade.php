{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Desa Karangmangu')

@section('content')

    <!-- Hero Slider -->
    <section x-data="{
        slides: [
            { src: '{{ asset('images/Banner/TAMPAKDEPAN.jpeg') }}', title: 'LPM (Lembaga Pemberdayaan Masyarakat)' },
            { src: '{{ asset('images/Banner/SAMPINGKANAN.jpeg') }}', title: 'Karang Taruna' },
            { src: '{{ asset('images/Banner/SAMPINGKIRI.jpeg') }}', title: 'PKK (Pemberdayaan Kesejahteraan Keluarga)' }
        ],
        current: 0,
        init() {
            setInterval(() => {
                this.current = (this.current + 1) % this.slides.length
            }, 5000)
        },
        prev() {
            this.current = (this.current - 1 + this.slides.length) % this.slides.length
        },
        next() {
            this.current = (this.current + 1) % this.slides.length
        }
    }" x-init="init()" class="relative h-64 md:h-96 overflow-hidden">
        <!-- Slides -->
        <template x-for="(slide, i) in slides" :key="i">
            <div x-show="current === i" class="absolute inset-0 bg-cover bg-center transition-opacity duration-700"
                x-bind:style="`background-image: url('${slide.src}');`"></div>
        </template>

        <!-- Overlay Content -->
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white px-4">
            <h1 class="text-3xl md:text-5xl font-bold">Profil Desa Karangmangu</h1>
            <p class="mt-2 text-sm md:text-lg">Temukan informasi lengkap tentang desa kita</p>

            <!-- Navigation Buttons -->
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

            <!-- Indicators -->
            <div class="flex space-x-2 mt-4">
                <template x-for="(_, i) in slides" :key="i">
                    <button class="w-2 h-2 rounded-full" :class="i === current ? 'bg-white' : 'bg-white bg-opacity-50'"
                        @click="current = i"></button>
                </template>
            </div>
        </div>
    </section>


    <section class="bg-green-50 py-16 space-y-16">
        <div class="max-w-4xl mx-auto px-4 space-y-16">
            <!-- Profil Desa -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Profil Desa Karangmangu</h2>
                <div class="text-gray-700 leading-relaxed text-justify space-y-6">
                    <p>
                        Desa Karangmangu adalah salah satu desa di Kecamatan Kramatmulya, Kabupaten Kuningan, dengan luas
                        wilayah 223,165 Ha.
                        Kantor Desa terletak di Dusun Manis RT 007 RW 003. Desa terdiri dari 4 Dusun, 8 RW, dan 20 RT.
                    </p>
                    <p>
                        Jumlah penduduk total mencapai 4.636 jiwa, terdiri dari 2.226 laki-laki dan 2.140 perempuan,
                        dengan 1.318 Kepala Keluarga. Dari jumlah KK tersebut, 383 KK (30 %) tergolong keluarga miskin
                        (Gakin).
                    </p>
                    <p>
                        Berdasarkan topografi dan kontur tanah, Desa Karangmangu secara umum berupa area sawah dan daratan
                        pada ketinggian 500–550 m dpl, dengan suhu rata-rata 29 °C–35 °C. Jarak ke ibu kota kecamatan 2 km
                        (10 menit)
                        dan ke ibu kota kabupaten 6 km (30 menit).
                    </p>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead class="bg-green-50">
                                <tr>
                                    <th class="px-4 py-2 border">Keterangan</th>
                                    <th class="px-4 py-2 border text-right">Jumlah</th>
                                    <th class="px-4 py-2 border">Satuan</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                <!-- Luas Wilayah -->
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border font-semibold">Luas Wilayah Desa Karangmangu</td>
                                    <td class="px-4 py-2 border text-right">223,165</td>
                                    <td class="px-4 py-2 border">Ha</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">a. Tanah Sawah</td>
                                    <td class="px-4 py-2 border text-right">65,844</td>
                                    <td class="px-4 py-2 border">Ha</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border">b. Pemukiman</td>
                                    <td class="px-4 py-2 border text-right">36,4</td>
                                    <td class="px-4 py-2 border">Ha</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">c. Perkantoran/Fasilitas Umum</td>
                                    <td class="px-4 py-2 border text-right">2,48</td>
                                    <td class="px-4 py-2 border">Ha</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border">d. Lainnya</td>
                                    <td class="px-4 py-2 border text-right">–</td>
                                    <td class="px-4 py-2 border">Ha</td>
                                </tr>

                                <!-- Spacer row -->
                                <tr>
                                    <td colspan="3" class="py-2"></td>
                                </tr>

                                <!-- Penduduk -->
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border font-semibold">Penduduk</td>
                                    <td class="px-4 py-2 border text-right">4.636</td>
                                    <td class="px-4 py-2 border">Jiwa</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">a. Laki-laki</td>
                                    <td class="px-4 py-2 border text-right">2.226</td>
                                    <td class="px-4 py-2 border">Jiwa</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border">b. Perempuan</td>
                                    <td class="px-4 py-2 border text-right">2.140</td>
                                    <td class="px-4 py-2 border">Jiwa</td>
                                </tr>

                                <!-- Kepala Keluarga -->
                                <tr>
                                    <td class="px-4 py-2 border font-semibold">Kepala Keluarga</td>
                                    <td class="px-4 py-2 border text-right">1.318</td>
                                    <td class="px-4 py-2 border">KK</td>
                                </tr>

                                <!-- Spacer row -->
                                <tr>
                                    <td colspan="3" class="py-2"></td>
                                </tr>

                                <!-- Sarana Pendidikan -->
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border font-semibold">Sarana Pendidikan</td>
                                    <td colspan="2" class="px-4 py-2 border">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">a. Kelompok PAUD</td>
                                    <td class="px-4 py-2 border text-right">3</td>
                                    <td class="px-4 py-2 border">Kelompok</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border">b. TPA</td>
                                    <td class="px-4 py-2 border text-right">4</td>
                                    <td class="px-4 py-2 border">Kelompok</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">c. SD</td>
                                    <td class="px-4 py-2 border text-right">3</td>
                                    <td class="px-4 py-2 border">Buah</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border">d. Madrasah Diniyah</td>
                                    <td class="px-4 py-2 border text-right">4</td>
                                    <td class="px-4 py-2 border">Buah</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">e. Pondok Pesantren</td>
                                    <td class="px-4 py-2 border text-right">4</td>
                                    <td class="px-4 py-2 border">Buah</td>
                                </tr>

                                <!-- Spacer row -->
                                <tr>
                                    <td colspan="3" class="py-2"></td>
                                </tr>

                                <!-- Sarana Kesehatan Masyarakat -->
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border font-semibold">Sarana Kesehatan Masyarakat</td>
                                    <td colspan="2" class="px-4 py-2 border">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">a. Jamban Keluarga</td>
                                    <td class="px-4 py-2 border text-right">1.218</td>
                                    <td class="px-4 py-2 border">KK</td>
                                </tr>
                                <tr class="bg-gray-100">
                                    <td class="px-4 py-2 border">b. KK Mempunyai Jamban</td>
                                    <td class="px-4 py-2 border text-right">1.218</td>
                                    <td class="px-4 py-2 border">KK</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2 border">c. KK Tidak Mempunyai Jamban</td>
                                    <td class="px-4 py-2 border text-right">10</td>
                                    <td class="px-4 py-2 border">KK</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>



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


                        <!-- Sejarah -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Sejarah Desa Karangmangu</h2>
                <div class="text-gray-700 leading-relaxed text-justify space-y-4">
                    <p>Desa Karangmangu merupakan salah satu desa diwilayah Kecamatan Kramatmulya
                        dari 14 desa yang ada. Dari jaman dahulu hingga sekarang, Desa Karangmangu terkenal
                        dengan home indurstrinya yaitu pengrajin bata merah dan kupat/ketupat terbesar
                        dikabupaten Kuningan. Bicara tentang asal mula Desa Karangmangu, sampai saat ini tidak
                        ada informasi yang jelas tentang kapan dan bagaimana desa ini lahir. Para penggagas
                        berdirinya atau orang yang dianggap tahu bagaimana Desa Karangmangu ini ada tidak
                        sumber informasi yang jelas, yang ada hanya cerita orang tua ”katanya-katanya” saja, penulis
                        akan mencoba menulis Ringkasan sejarah Desa Karangmangu yang berdasarakan sumber
                        dari “katan-katanya” itu.</p>
                    <p>Desa Karangmangu asalnya adalah wilayah desa Cikaso, dalam sejarah singkat yang
                        sempat penulis baca Desa Cikaso itu asalnya bukan desa melainkan sebuah pemerintahan
                        besar yang dipimpin oleh seorang tumenggung/bupati yang bergelar Tumenggung
                        “ARGAWIJAYA” dengan pendampingnya patih “NAGAREJA”. Salah satu bukti Karangmangu
                        merupakan bagian dari Desa Cikaso yaitu kedua tokoh besar itu yakni Tumenggung
                        ARGAWIJAYA dan Patih NAGAREJA makam/kuburannya berada di Desa Karangmangu
                        yang sekarang dikeramatkan dan banyak dijiarahi orang terutama orang yang berhasrat ingin
                        menjadi Kuwu/Kepala Desa. Bahkan untuk mengabadikan nama tokoh besar tersebut tempat
                        dimana makam itu berada kini diabadikan dengan dengan istilah BLOK TUMENGGUNG,
                        tempat itu tercatat pada catatan DHKP (Daftar Himpunan Ketetapan Pajak) desa dan
                        kabupaten.</p>
                    <p>Pada saat desa karangmangu lahir mungkin karena cakupan desa Cikaso yang luas
                        atau mungkin ada sebab lain sehingga Desa Karangmangu ini lahir tidak penting untuk
                        diperdebatklan, yang jelas katanya Karangmangu berasal dari Karangmanggu, konon katanya
                        ditengah-tengah desa ada sebuah pohon manggu yang besar dan di disekitar pohon manggu
                        tersebut ada sebuah halaman atau karang yang bersih, luas, rindang dan nyaman. karena
                        rasa sejuk dan rindangnya pohon manggu terebut tempat ini dipakai sarana tempat bermain
                        anak-anak bahkan juga tak jarang para pedagang yang kebetulan lewat ke tempat itu sengaja
                        numpang istirahat melepas lelah dibawah rindanya pohon manggu sambil membuka
                        timbel/nasi bekel yang ia bawa. Terifirasi dari nama itulah asal mula Karangmanggu diambil,
                        dari pohon Manggu dan Karang/halaman yang bahasanya diesederhanakan lagi menjadi
                        KARANGMANGU.</p>
                    <p>Desa Karangmangu dipimpin oleh seorang kuwu, entah tahun berapa desa ini lahir</p>

                    entah siapa orang yang pertama memimpin tidak ada ada informasi yang jelas, Periode-
                    periode kuwu yang bisa dihimpun sebagai berikut:
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

            <!-- Demografi -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-green-800 text-center mb-6">Demografi Desa Karangmangu</h2>
                <div class="text-gray-700 leading-relaxed text-justify space-y-4">

                    <!-- 2.1 Letak Geografis -->
                    <h3 class="text-xl font-semibold text-green-700">2.1. Letak Geografis</h3>
                    <p>Desa Karangmangu terletak di Kecamatan Kramatmulya, Kabupaten Kuningan, dengan luas wilayah 223,165
                        hektar. Terdiri dari 4 dusun/blok, 8 Rukun Warga (RW), dan 20 Rukun Tetangga (RT). Batas wilayah
                        Desa Karangmangu adalah sebagai berikut:</p>
                        <div class="flex justify-center">
                    <div
                        class="overflow-hidden rounded-xl shadow-xl hover:scale-105 transition-transform duration-300 ring-1 ring-green-200">
                        <img src="{{ asset('images/geografi.png') }}" alt="Keadaan Geografis"
                            class="object-contain w-full md:w-[700px]" />
                    </div>
                </div>
                    <ul class="list-disc list-inside">
                        <li>Sebelah Utara: Desa Ciniru, Kecamatan Jalaksana</li>
                        <li>Sebelah Selatan: Desa Cikaso, Kecamatan Kramatmulya</li>
                        <li>Sebelah Timur: Desa Sindangbarang, Kecamatan Jalaksana</li>
                        <li>Sebelah Barat: Desa Nanggerang, Kecamatan Jalaksana</li>
                    </ul>
                    <p>Secara visualisasi, wilayah administratif dapat dilihat dalam peta wilayah Desa Karangmangu.</p>

                    <!-- 2.2 Topografi -->
                    <h3 class="text-xl font-semibold text-green-700">2.2. Topografi</h3>
                    <p>Desa Karangmangu berada di dataran tinggi dengan ketinggian 500–550 meter di atas permukaan laut
                        (DPL), memiliki kontur tanah yang datar dan sebagian berbukit. Suhu rata-rata harian berkisar antara
                        29°C hingga 35°C, dengan curah hujan rata-rata 2.800 mm per tahun.</p>
                    <p>Jarak orbitasi desa ini yaitu 2 km ke ibu kota kecamatan, 6 km ke ibu kota kabupaten, 235 km ke ibu
                        kota provinsi, dan 540 km ke ibu kota negara. Sebagian besar wilayahnya adalah lahan pertanian
                        seperti sawah dan tegalan.</p>

                    <!-- 2.3 Hidrologi dan Klimatologi -->
                    <h3 class="text-xl font-semibold text-green-700">2.3. Hidrologi dan Klimatologi</h3>
                    <p>Wilayah Desa Karangmangu memiliki sistem hidrologi yang penting dalam pengaturan tata air, dengan
                        aliran sungai dan selokan berdebit besar, sedang, dan kecil, di antaranya Sungai Cilengkrang. Namun,
                        belakangan ini terjadi perubahan cuaca yang memengaruhi ketidakstabilan debit air karena sebagian
                        besar wilayah adalah daerah irigasi setengah teknis.</p>

                    <!-- 2.4 Luas dan Sebaran Penggunaan Lahan -->
                    <h3 class="text-xl font-semibold text-green-700">2.4. Luas dan Sebaran Penggunaan Lahan</h3>
                    <p>Lahan di Desa Karangmangu umumnya dimanfaatkan secara produktif, terutama untuk pertanian karena
                        tanahnya yang subur. Hanya sebagian kecil lahan yang tidak dimanfaatkan. Hal ini menunjukkan bahwa
                        desa memiliki sumber daya alam yang memadai.</p>

                    <div class="overflow-x-auto">
                        <table class="min-w-full mt-4 table-auto border border-gray-300 text-sm text-left">
                            <thead class="bg-green-100 text-green-900">
                                <tr>
                                    <th class="px-4 py-2 border">Jenis Lahan</th>
                                    <th class="px-4 py-2 border">Luas (Ha)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white">
                                    <td class="px-4 py-2 border">Sawah Teknis</td>
                                    <td class="px-4 py-2 border">2</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-2 border">Sawah Setengah Teknis</td>
                                    <td class="px-4 py-2 border">58</td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-2 border">Sawah Pasang Surut</td>
                                    <td class="px-4 py-2 border">-</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-2 border">Lahan Pemukiman</td>
                                    <td class="px-4 py-2 border">65</td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-2 border">Lahan Perkantoran</td>
                                    <td class="px-4 py-2 border">-</td>
                                </tr>
                                <tr class="bg-gray-50">
                                    <td class="px-4 py-2 border">Perkebunan</td>
                                    <td class="px-4 py-2 border">50</td>
                                </tr>
                                <tr class="bg-white">
                                    <td class="px-4 py-2 border">Lahan Lainnya</td>
                                    <td class="px-4 py-2 border">48</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

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