<!-- Footer Section -->
<footer id="footer"
    class="bg-black text-white py-10 mt-8 opacity-0 transition-opacity duration-1000">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-8 text-sm">

        <!-- Kolom 1: Logo dan alamat -->
        <div>
            <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kelurahan Winduherang"
                class="h-12 mb-3">
            <p class="text-gray-300 leading-relaxed">Jalan Ramajaksa No. 11, Kelurahan Winduherang, Kecamatan Cigugur,
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
            <a href="{{ route('galeri')}}" class="text-gray-300 hover:underline block">Galeri Foto Desa</a>
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
                <!-- YouTube -->
                <a href="#" class="hover:text-green-400" aria-label="YouTube">
                    <svg class="w-6 h-6 fill-current text-white transition-colors duration-300" viewBox="0 0 24 24">
                        <path
                            d="M23.5 6.2c-.2-1.6-.8-2.3-2.1-2.4C17.4 3.2 12 3.2 12 3.2s-5.4 0-9.4.6C1.3 4 0.7 4.7 0.5 6.2 0.1 8 .1 12 .1 12s0 4 .4 5.8c.2 1.5.8 2.2 2.1 2.3 4 0 9.4.6 9.4.6s5.4 0 9.4-.6c1.3-.1 1.9-.8 2.1-2.3.4-1.8.4-5.8.4-5.8s0-4-.4-5.8zM9.7 14.6V7.7l6.3 3.4-6.3 3.5z" />
                    </svg>
                </a>

                <!-- Instagram -->
                <a href="https://www.instagram.com/pps_winduherang?igsh=MTV0Yjd4dDdzN2libg==" class="hover:text-green-400" aria-label="Instagram">
                    <svg class="w-6 h-6 fill-current text-white transition-colors duration-300" viewBox="0 0 24 24">
                        <path
                            d="M12 2.2c3.2 0 3.6 0 4.9.1 1.2.1 1.8.3 2.2.5.6.2 1 .5 1.5 1s.8.9 1 1.5c.2.4.4 1 .5 2.2.1 1.3.1 1.7.1 4.9s0 3.6-.1 4.9c-.1 1.2-.3 1.8-.5 2.2-.2.6-.5 1-.9 1.5s-.9.8-1.5 1c-.4.2-1 .4-2.2.5-1.3.1-1.7.1-4.9.1s-3.6 0-4.9-.1c-1.2-.1-1.8-.3-2.2-.5-.6-.2-1-.5-1.5-1s-.8-.9-1-1.5c-.2-.4-.4-1-.5-2.2C2.2 15.6 2.2 15.2 2.2 12s0-3.6.1-4.9c.1-1.2.3-1.8.5-2.2.2-.6.5-1 .9-1.5s.9-.8 1.5-1c.4-.2 1-.4 2.2-.5C8.4 2.2 8.8 2.2 12 2.2zm0 4.4a5.4 5.4 0 100 10.8 5.4 5.4 0 000-10.8zm0 9a3.6 3.6 0 110-7.2 3.6 3.6 0 010 7.2zm5.6-9.5a1.3 1.3 0 100 2.6 1.3 1.3 0 000-2.6z" />
                    </svg>
                </a>

                <!-- Twitter -->
                <a href="#" class="hover:text-green-400" aria-label="X">
                    <svg class="w-6 h-6 fill-current text-white transition-colors duration-300" viewBox="0 0 24 24">
                        <path
                            d="M22.5 3.1h-2.1L13.5 10l8.4 10.9h-6.6L9.6 13.2 3 21h2.1L10.5 14 2.1 3.1H9l6 7.9 7.5-7.9z" />
                    </svg>
                </a>

                <!-- Facebook -->
                <a href="#" class="hover:text-green-400" aria-label="Facebook">
                    <svg class="w-6 h-6 fill-current text-white transition-colors duration-300" viewBox="0 0 24 24">
                        <path
                            d="M22 12a10 10 0 10-11.5 9.9v-7h-2v-2.9h2v-2.3c0-2 1.2-3.1 3-3.1.9 0 1.8.1 1.8.1v2h-1c-1 0-1.3.6-1.3 1.2v1.9h2.5l-.4 2.9h-2.1v7A10 10 0 0022 12z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="border-t border-green-500 mt-10 pt-4 text-center text-xs text-gray-400">
        Redesigned By &copy;
        <script>
            document.write(new Date().getFullYear());
        </script> Kelurahan Winduherang. All rights reserved.
        <br>
        Dibuat oleh <span class="text-green-500 font-semibold">Inovindo Digital Media</span>.
    </div>
</footer>

<!-- JavaScript: Animasi saat scroll -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
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
