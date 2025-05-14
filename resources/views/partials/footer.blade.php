@php
    use Illuminate\Support\Str;
    use App\Models\VillageContact;

    $kontak = VillageContact::first();
    $raw = $kontak->no_telepon ? preg_replace('/\D/', '', $kontak->no_telepon) : '';

    // Jika mulai dengan 0, buang dan ganti country code 62 otomatis
    if (Str::startsWith($raw, '0')) {
        $raw = substr($raw, 1);
    }

    if ($raw) {
        // Grup pertama 3 digit
        $first = substr($raw, 0, 3);
        // Sisanya
        $rest = substr($raw, 3);
        // Split sisanya tiap 4 digit
        $parts = $rest ? str_split($rest, 4) : [];
        // Gabungkan: +62 3digit-4digit-4digit...
        $formattedPhone = '+62 ' . $first . (count($parts) ? '-' . implode('-', $parts) : '');
        $whatsappLink = 'https://wa.me/62' . $raw;
    } else {
        $formattedPhone = '';
        $whatsappLink = '#';
    }

    $emailLink = $kontak->email ? 'mailto:' . $kontak->email : '#';
    $youtube = $kontak->youtube ?? '#';
    $instagram = $kontak->instagram ?? '#';
    $facebook = $kontak->facebook ?? '#';
@endphp


<footer id="footer" class="bg-black text-white py-10 mt-8 opacity-0 transition-opacity duration-1000">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">

        <!-- Kolom 1: Logo & Alamat -->
        <div>
            <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Desa Karangmangu" class="h-12 mb-3">
            <p class="text-gray-300 leading-relaxed">
                Jalan Ramajaksa No. 11, Desa Karangmangu, Kecamatan Cigugur,<br>
                Kabupaten Kuningan
            </p>
        </div>

        <!-- Kolom 2: Kontak -->
        <div>
            <h4 class="font-semibold mb-3 text-white">Hubungi Kami</h4>
            @if ($formattedPhone)
                <p class="text-gray-300 mb-1">
                    <a href="tel:{{ str_replace([' ', '-'], '', $formattedPhone) }}" class="hover:underline">
                        {{ $formattedPhone }}
                    </a>
                </p>
            @endif
            @if ($kontak->email)
                <a href="{{ $emailLink }}" class="text-gray-300 hover:underline block">
                    {{ $kontak->email }}
                </a>
            @endif
        </div>

        <!-- Kolom 3: Jelajah -->
        <div>
            <h4 class="font-semibold mb-3 text-white">Jelajah</h4>
            <a href="{{ route('galeri') }}" class="text-gray-300 hover:underline block">Galeri Foto Desa</a>
            @guest
                <a href="{{ route('login') }}" class="text-gray-300 hover:underline block mt-2">Login</a>
            @endguest
            @auth
                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:underline block mt-2">Admin Page</a>
            @endauth
        </div>

        <!-- Kolom 4: Sosial Media -->
        <div>
            <h4 class="font-semibold mb-3 text-white">Connect with Us</h4>
            <div class="flex gap-4">
                <a href="{{ $youtube }}" target="_blank" class="hover:text-green-400" aria-label="YouTube">
                    <img src="{{ asset('images/icons/youtube.svg') }}" alt="YouTube" class="w-6 h-6" />
                </a>
                <a href="{{ $instagram }}" target="_blank" class="hover:text-green-400" aria-label="Instagram">
                    <img src="{{ asset('images/icons/instagram.svg') }}" alt="Instagram" class="w-6 h-6" />
                </a>
                <a href="{{ $facebook }}" target="_blank" class="hover:text-green-400" aria-label="Facebook">
                    <img src="{{ asset('images/icons/facebook.svg') }}" alt="Facebook" class="w-6 h-6" />
                </a>
                @if ($raw)
                    <a href="{{ $whatsappLink }}" target="_blank" class="hover:text-green-400" aria-label="WhatsApp">
                        <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp" class="w-6 h-6" />
                    </a>
                @endif
                @if ($kontak->email)
                    <a href="{{ $emailLink }}" target="_blank" class="hover:text-green-400" aria-label="Email">
                        <img src="{{ asset('images/icons/email.svg') }}" alt="Email" class="w-6 h-6" />
                    </a>
                @endif
            </div>
        </div>

    </div>

    <div class="border-t border-green-500 mt-10 pt-4 text-center text-xs text-gray-400">
        Redesigned By &copy;
        <script>
            document.write(new Date().getFullYear());
        </script> Desa Karangmangu. All rights reserved.
        <br>
        Dibuat oleh <span class="text-green-500 font-semibold">Inovindo Digital Media</span>.
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const footer = document.getElementById("footer");
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footer.classList.remove("opacity-0");
                    footer.classList.add("animate__animated", "animate__fadeInUp");
                    observer.unobserve(footer);
                }
            });
        }, {
            threshold: 0.1
        });
        observer.observe(footer);
    });
</script>