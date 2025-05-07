<!-- Footer Section -->
<footer id="footer" class="bg-black text-white py-10 mt-8 opacity-0 transition-opacity duration-1000">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">

        <!-- Kolom 1: Logo dan alamat -->
        <div>
            <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Desa Karangmangu" class="h-12 mb-3">
            <p class="text-gray-300 leading-relaxed">Jalan Ramajaksa No. 11, Desa Karangmangu, Kecamatan Cigugur,
                Kabupaten Kuningan</p>
        </div>

        <!-- Kolom 2: Kontak -->
        <div>
            <h4 class="font-semibold mb-3 text-white">Hubungi Kami</h4>
            <p class="text-gray-300 mb-1">088347520749</p>
            <a href="mailto:kelurahanwinduherang66@gmail.com" class="text-gray-300 hover:underline block">
                kelurahanwinduherang66@gmail.com
            </a>
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

        @php
            $kontak = \App\Models\VillageContact::first();
            $youtube = $kontak->youtube ?? '#';
            $instagram = $kontak->instagram ?? '#';
            $facebook = $kontak->facebook ?? '#';
            $whatsapp = $kontak->no_telepon ? 'https://wa.me/' . preg_replace('/\D/', '', $kontak->no_telepon) : '#';
            $emailLink = $kontak->email ? 'mailto:' . $kontak->email : '#';
        @endphp

        <!-- Kolom 4: Sosial Media -->
        <div>
            <h4 class="font-semibold mb-3 text-white">Connect with Us</h4>
            <div class="flex gap-4">
                <!-- YouTube -->
                <a href="{{ $youtube }}" class="hover:text-green-400" aria-label="YouTube" target="_blank">
                    <img src="{{ asset('images/icons/youtube.svg') }}" alt="YouTube"
                        class="w-6 h-6 object-contain text-white transition-colors duration-300" />
                </a>

                <!-- Instagram -->
                <a href="{{ $instagram }}" class="hover:text-green-400" aria-label="Instagram" target="_blank">
                    <img src="{{ asset('images/icons/instagram.svg') }}" alt="Instagram"
                        class="w-6 h-6 object-contain text-white transition-colors duration-300" />
                </a>

                <!-- Facebook -->
                <a href="{{ $facebook }}" class="hover:text-green-400" aria-label="Facebook" target="_blank">
                    <img src="{{ asset('images/icons/facebook.svg') }}" alt="Facebook"
                        class="w-6 h-6 object-contain text-white transition-colors duration-300" />
                </a>

                <!-- WhatsApp -->
                <a href="{{ $whatsapp }}" class="hover:text-green-400" aria-label="WhatsApp" target="_blank">
                    <img src="{{ asset('images/icons/whatsapp.svg') }}" alt="WhatsApp"
                        class="w-6 h-6 object-contain text-white transition-colors duration-300" />
                </a>

                <!-- Email -->
                <a href="{{ $emailLink }}" class="hover:text-green-400" aria-label="Email" target="_blank">
                    <img src="{{ asset('images/icons/email.svg') }}" alt="Email"
                        class="w-6 h-6 object-contain text-white transition-colors duration-300" />
                </a>
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

<!-- JavaScript: Animasi saat scroll -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const footer = document.getElementById("footer");

        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    footer.classList.remove("opacity-0");
                    footer.classList.add("animate__animated", "animate__fadeInUp");
                    observer.unobserve(footer); // animasi hanya sekali
                }
            });
        }, {
            threshold: 0.1
        });

        observer.observe(footer);
    });
</script>
