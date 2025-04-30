{{-- resources/views/partials/navbar.blade.php --}}
<nav id="mainNav" class="bg-green-700 animate__animated animate__fadeInDown z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        {{-- Logo dan Nama Desa --}}
        <div class="flex items-center">
            <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kabupaten Kuningan"
                class="w-10 h-10 object-cover rounded-full mr-3" />
            <span class="text-white text-xl font-bold">Kelurahan Winduherang</span>
        </div>

        {{-- Menu Desktop --}}
        <div class="hidden md:flex space-x-6">
            @php
                $items = [
                    ['route' => 'home', 'label' => 'Beranda'],
                    ['route' => 'profil', 'label' => 'Profil Desa'],
                    ['route' => 'news', 'label' => 'Berita'],
                    ['route' => 'galeri', 'label' => 'Galeri'],
                    ['route' => 'pemerintahan', 'label' => 'Pemerintahan'],
                    ['route' => 'wartaWargi', 'label' => 'Kontak Kami'],
                ];
            @endphp
            @foreach ($items as $item)
                <a href="{{ route($item['route']) }}#{{ $item['route'] }}"
                    class="font-medium {{ request()->routeIs($item['route']) ? 'text-green-300 underline' : 'text-white hover:text-green-100' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
            @auth
                <a href="{{ route('admin.dashboard') }}" class="font-medium {{ request()->routeIs('admin.dashboard') ? 'text-green-300 underline' : 'text-white hover:text-green-100' }}">Dashboard</a>
            @endauth
        </div>

        {{-- Hamburger Button --}}
        <button class="md:hidden text-white focus:outline-none" onclick="toggleMenu()">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="md:hidden hidden bg-green-800 px-4 py-2 space-y-1">
        @foreach ($items as $item)
            <a href="{{ route($item['route']) }}#{{ $item['route'] }}"
                class="block py-2 px-3 rounded-md font-medium {{ request()->routeIs($item['route']) ? 'bg-green-700 text-white' : 'text-white hover:bg-green-700 hover:text-green-100' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
        @auth
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded-md font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-green-700 text-white' : 'text-white hover:bg-green-700 hover:text-green-100' }}">Dashboard</a>
        @endauth
    </div>
</nav>

<nav id="stickyNav" class="bg-green-700 hidden animate__animated animate__fadeInDown z-50 fixed w-full top-0">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center">
            <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kabupaten Kuningan"
                class="w-10 h-10 object-cover rounded-full mr-3" />
            <span class="text-white text-xl font-bold">Kelurahan Winduherang</span>
        </div>
        <div class="hidden md:flex space-x-6">
            @foreach ($items as $item)
                <a href="{{ route($item['route']) }}#{{ $item['route'] }}"
                    class="font-medium {{ request()->routeIs($item['route']) ? 'text-green-300 underline' : 'text-white hover:text-green-100' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
            @auth
                <a href="{{ route('admin.dashboard') }}" class="font-medium {{ request()->routeIs('admin.dashboard') ? 'text-green-300 underline' : 'text-white hover:text-green-100' }}">Dashboard</a>
            @endauth
        </div>

        {{-- Hamburger Button for StickyNav --}}
        <button class="md:hidden text-white focus:outline-none" onclick="toggleStickyMenu()">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    {{-- Mobile Menu for StickyNav --}}
    <div id="stickyMobileMenu" class="md:hidden hidden bg-green-800 px-4 py-2 space-y-1">
        @foreach ($items as $item)
            <a href="{{ route($item['route']) }}#{{ $item['route'] }}"
                class="block py-2 px-3 rounded-md font-medium {{ request()->routeIs($item['route']) ? 'bg-green-700 text-white' : 'text-white hover:bg-green-700 hover:text-green-100' }}">
                {{ $item['label'] }}
            </a>
        @endforeach
        @auth
            <a href="{{ route('admin.dashboard') }}" class="block py-2 px-3 rounded-md font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-green-700 text-white' : 'text-white hover:bg-green-700 hover:text-green-100' }}">Dashboard</a>
        @endauth
    </div>
</nav>

<script>
    function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }

    function toggleStickyMenu() {
        document.getElementById('stickyMobileMenu').classList.toggle('hidden');
    }

    window.addEventListener('scroll', () => {
        const mainNav = document.getElementById('mainNav');
        const stickyNav = document.getElementById('stickyNav');
        if (window.scrollY > 150) {
            mainNav.classList.add('hidden');
            stickyNav.classList.remove('hidden');
        } else {
            mainNav.classList.remove('hidden');
            stickyNav.classList.add('hidden');
        }
    });
</script>