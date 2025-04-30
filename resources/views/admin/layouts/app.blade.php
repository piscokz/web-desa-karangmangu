<!doctype html>
<html lang="en" x-data="{ sidebarOpen: false }" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Desa Winduherang Admin Dashboard</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                fontFamily: {
                    sans: ['Inter', 'sans-serif'],
                },
                extend: {
                    colors: {
                        'desa-hijau': '#14532d',
                        'desa-coklat': '#78350f',
                        'desa-krem': '#fefce8',
                        'desa-emas': '#d97706',
                    },
                },
            },
        };
    </script>
    {{-- Favicon (logo kecil di tab) --}}
    <link rel="icon" href="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" type="image/png">

    <!-- Google Font (Inter) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
</head>

<body class="bg-desa-krem text-gray-800 font-sans">

    <!-- Mobile Sidebar Overlay -->
    <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden"
        @click="sidebarOpen = false">
    </div>

    @php $cnt = \App\Models\Contact::count(); @endphp

    <!-- Sidebar Mobile -->
    <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full"
        class="fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-[#14532d] to-[#22c55e] text-white z-50 transform md:hidden shadow-2xl rounded-r-xl overflow-y-auto">
        <div class="flex items-center justify-between px-6 py-4 border-b border-white/10">
            <h1 class="text-xl font-bold">Desa Winduherang</h1>
            <button @click="sidebarOpen = false" class="text-2xl hover:text-yellow-400">&times;</button>
        </div>

        <nav class="p-6 space-y-2">
            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 9.75L12 3l9 6.75v10.5a.75.75 0 01-.75.75h-4.5a.75.75 0 01-.75-.75V15h-6v5.25a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75V9.75z" />
                </svg>
                Dashboard
            </a>

            {{-- Profile --}}
            @auth
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('profile.edit') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 2a5 5 0 100 8 5 5 0 000-8z" />
                        <path fill-rule="evenodd" d="M4 16a6 6 0 0112 0v1H4v-1z" clip-rule="evenodd" />
                    </svg>
                    Profile
                </a>
            @endauth

            {{-- Artikel --}}
            <a href="{{ route('admin.article.index') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('admin.article.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="16" rx="2" ry="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8M8 12h8M8 16h8" />
                </svg>
                Artikel
            </a>

            {{-- Galeri --}}
            <a href="{{ route('admin.gallery.index') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('admin.gallery.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21" />
                </svg>
                Galeri
            </a>

            {{-- Pengaduan --}}
            <a href="{{ route('admin.pengaduan.index') }}"
                class="relative flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('admin.pengaduan.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pengaduan
                @if ($cnt)
                    <span
                        class="absolute top-2 right-3 bg-red-500 text-xs text-white rounded-full px-1">{{ $cnt }}</span>
                @endif
            </a>

            {{-- Penduduk --}}
            <a href="{{ route('penduduk.index') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('penduduk.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-6 0v4m6 0H11" />
                </svg>
                Penduduk
            </a>

            {{-- Kartu Keluarga --}}
            <a href="{{ route('kk.index') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('kk.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="5" width="18" height="14" rx="2" ry="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M8 15h8M8 12h8" />
                </svg>
                Kartu Keluarga
            </a>

            {{-- Dusun --}}
            <a href="{{ route('dusun.index') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('dusun.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2C8.686 2 6 4.686 6 8c0 4.5 6 12 6 12s6-7.5 6-12c0-3.314-2.686-6-6-6z" />
                    <circle cx="12" cy="8" r="2.5" fill="currentColor" />
                </svg>
                Dusun
            </a>

            {{-- RW --}}
            <a href="{{ route('rw.index') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('rw.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="6" height="6" rx="1" ry="1" />
                    <rect x="15" y="3" width="6" height="6" rx="1" ry="1" />
                    <rect x="3" y="15" width="6" height="6" rx="1" ry="1" />
                    <rect x="15" y="15" width="6" height="6" rx="1" ry="1" />
                </svg>
                RW
            </a>

            {{-- RT --}}
            <a href="{{ route('rt.index') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('rt.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 10l9-7 9 7v10a1 1 0 01-1 1h-5v-7H9v7H4a1 1 0 01-1-1V10z" />
                </svg>
                RT
            </a>

            {{-- Guest Page --}}
            <a href="{{ route('home') }}"
                class="flex items-center py-2 px-4 rounded transition duration-200 {{ request()->routeIs('home') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2 12h20M12 2v20M4.93 4.93l14.14 14.14M4.93 19.07l14.14-14.14" />
                </svg>
                Guest Page
            </a>

            {{-- Log Out --}}
            <form method="POST" action="{{ route('logout') }}" id="logoutFormMobile">
                @csrf
                <button type="submit" onclick="return confirmLogout(event)"
                    class="w-full mt-4 py-2 px-4 text-left bg-red-500 hover:bg-red-600 rounded flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8v8" />
                    </svg>
                    <span>Log Out</span>
                </button>
            </form>
        </nav>
    </aside>


    <!-- Sidebar Desktop -->
    <aside
        class="hidden md:fixed md:inset-y-0 md:w-64 md:flex md:flex-col bg-gradient-to-b from-[#14532d] to-[#22c55e] text-white shadow-2xl rounded-r-xl overflow-y-auto">
        <div class="px-6 py-6 border-b border-white/10">
            <h1 class="text-2xl font-bold">Desa Winduherang</h1>
            <p class="text-sm text-gray-300">Admin Dashboard</p>
        </div>

        <nav class="flex-1 p-6 space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 9.75L12 3l9 6.75v10.5a.75.75 0 01-.75.75h-4.5a.75.75 0 01-.75-.75V15h-6v5.25a.75.75 0 01-.75.75H3.75a.75.75 0 01-.75-.75V9.75z" />
                </svg>
                Dashboard
            </a>

            <!-- Profile -->
            @auth
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('profile.edit') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path d="M10 2a5 5 0 00-5 5v1a5 5 0 0010 0V7a5 5 0 00-5-5z" />
                        <path fill-rule="evenodd" d="M4 16a6 6 0 0112 0v1H4v-1z" clip-rule="evenodd" />
                    </svg>
                    Profil
                </a>
            @endauth

            <!-- Artikel -->
            <a href="{{ route('admin.article.index') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('admin.article.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 16h8M8 12h8M8 8h8M4 6h.01M4 10h.01M4 14h.01M4 18h.01" />
                    <rect x="3" y="4" width="18" height="16" rx="2" ry="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Artikel
            </a>

            <!-- Galeri -->
            <a href="{{ route('admin.gallery.index') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('admin.gallery.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <circle cx="8.5" cy="8.5" r="1.5" fill="currentColor" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21" />
                </svg>
                Galeri
            </a>

            <!-- Pengaduan -->
            <a href="{{ route('admin.pengaduan.index') }}"
                class="relative flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('admin.pengaduan.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Pengaduan
                @if ($cnt)
                    <span
                        class="absolute top-2 right-3 bg-red-500 text-xs text-white rounded-full px-1">{{ $cnt }}</span>
                @endif
            </a>

            <!-- Penduduk -->
            <a href="{{ route('penduduk.index') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('penduduk.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5V4H2v16h5m10 0v-4a3 3 0 00-6 0v4m6 0H11" />
                </svg>
                Penduduk
            </a>

            <!-- Kartu Keluarga -->
            <a href="{{ route('kk.index') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('kk.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="5" width="18" height="14" rx="2" ry="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M8 15h8M8 12h8" />
                </svg>
                Kartu Keluarga
            </a>

            <!-- Dusun -->
            <a href="{{ route('dusun.index') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('dusun.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2C8.686 2 6 4.686 6 8c0 4.5 6 12 6 12s6-7.5 6-12c0-3.314-2.686-6-6-6z" />
                    <circle cx="12" cy="8" r="2.5" fill="currentColor" />
                </svg>
                Dusun
            </a>

            <!-- RW -->
            <a href="{{ route('rw.index') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('rw.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="6" height="6" rx="1" ry="1" />
                    <rect x="15" y="3" width="6" height="6" rx="1" ry="1" />
                    <rect x="3" y="15" width="6" height="6" rx="1" ry="1" />
                    <rect x="15" y="15" width="6" height="6" rx="1" ry="1" />
                </svg>
                RW
            </a>

            <!-- RT -->
            <a href="{{ route('rt.index') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('rt.*') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 10l9-7 9 7v10a1 1 0 01-1 1h-5v-7H9v7H4a1 1 0 01-1-1V10z" />
                </svg>
                RT
            </a>

            <!-- Guest Page -->
            <a href="{{ route('home') }}"
                class="flex items-center py-2 px-4 rounded transition-all duration-200 {{ request()->routeIs('home') ? 'bg-[#facc15] text-black font-semibold' : 'hover:bg-[#facc15] hover:text-black' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2a10 10 0 100 20 10 10 0 000-20zm1 17.93V16m0-8v-1.07M4.93 4.93l.78.78M17.29 17.29l.78.78M2 12h1.07M20.93 12H19.86M4.93 19.07l.78-.78M17.29 6.71l.78-.78" />
                </svg>
                Guest Page
            </a>

            <!-- Log Out -->
            <form method="POST" action="{{ route('logout') }}" id="logoutFormDesktop">
                @csrf
                <button type="submit" onclick="return confirmLogout(event)"
                    class="w-full mt-6 py-2 px-4 text-left bg-red-500 hover:bg-red-600 rounded flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8v8" />
                    </svg>
                    <span>Log Out</span>
                </button>
            </form>
        </nav>
    </aside>


    <script>
        function confirmLogout(e) {
            e.preventDefault();
            if (confirm('Apakah kamu yakin ingin logout?')) {
                e.target.closest('form').submit();
            }
        }
    </script>


    <!-- JavaScript Alert Confirmation -->
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm('Apakah kamu yakin ingin logout?')) {
                event.target.closest('form').submit();
            }
        }
    </script>

    <!-- Main Content -->
    <div class="md:pl-64 min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow p-4 flex justify-between items-center sticky top-0 z-10">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = true" class="md:hidden text-desa-coklat">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h2 class="text-xl font-bold">Selamat datang {{ Auth::user()->name }}!</h2>
            </div>
        </header>

        <!-- Main Content -->
        <main class="p-6 overflow-auto flex-grow">
            @yield('content')
        </main>

        <!-- Sticky Footer -->
        <footer class="bg-white shadow p-4 text-center text-sm text-gray-500 mt-auto" data-aos="fade-up">
            &copy; 2025 Desa Winduherang. Semua hak dilindungi.
        </footer>
    </div>

    <!-- Alpine.js & AOS -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true
        });
    </script>
</body>

</html>