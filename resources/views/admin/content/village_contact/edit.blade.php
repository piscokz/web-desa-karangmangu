@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-green-600 px-6 py-4">
                    <h3 class="text-white text-xl font-semibold flex items-center">
                        <!-- Heroicon: Phone Incoming -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m4 12h6m-3-3v6m-6-3H3" />
                        </svg>
                        Edit Village Contact
                    </h3>
                </div>
                <!-- Body -->
                <div class="p-6">
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded">
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- Alert Success --}}
                    @if (session('success'))
                        <div class="mb-6 px-4 py-3 rounded-lg bg-green-100 border border-green-400 text-green-700">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('kontak.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Instagram -->
                        <div class="mb-5">
                            <label for="instagram" class="block text-gray-700 font-medium mb-1">Instagram</label>
                            <div
                                class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-500">
                                <span class="px-3 text-gray-500">
                                    <!-- Heroicon: Instagram -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-pink-500"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm0 1.5A4.25 4.25 0 003.5 7.75v8.5A4.25 4.25 0 007.75 20.5h8.5a4.25 4.25 0 004.25-4.25v-8.5A4.25 4.25 0 0016.25 3.5h-8.5z" />
                                        <path d="M12 7a5 5 0 100 10 5 5 0 000-10zm0 1.5a3.5 3.5 0 110 7 3.5 3.5 0 010-7z" />
                                        <circle cx="17.75" cy="6.25" r="0.75" />
                                    </svg>
                                </span>
                                <input id="instagram" name="instagram" type="text"
                                    value="{{ old('instagram', $kontak->instagram) }}"
                                    placeholder="https://instagram.com/username"
                                    class="flex-1 px-3 py-2 outline-none text-gray-800" />
                            </div>
                        </div>

                        <!-- YouTube -->
                        <div class="mb-5">
                            <label for="youtube" class="block text-gray-700 font-medium mb-1">YouTube</label>
                            <div
                                class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-500">
                                <span class="px-3 text-gray-500">
                                    <!-- Custom YouTube Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 24 24"
                                        fill="currentColor">
                                        <path
                                            d="M23.5 6.2c-.2-1.6-.8-2.3-2.1-2.4C17.4 3.2 12 3.2 12 3.2s-5.4 0-9.4.6C1.3 4 0.7 4.7 0.5 6.2 0.1 8 .1 12 .1 12s0 4 .4 5.8c.2 1.5.8 2.2 2.1 2.3 4 0 9.4.6 9.4.6s5.4 0 9.4-.6c1.3-.1 1.9-.8 2.1-2.3.4-1.8.4-5.8.4-5.8s0-4-.4-5.8z" />
                                        <path d="M9.7 14.6V7.7l6.3 3.4-6.3 3.5z" fill="#fff" />
                                    </svg>
                                </span>
                                <input id="youtube" name="youtube" type="text"
                                    value="{{ old('youtube', $kontak->youtube) }}"
                                    placeholder="https://youtube.com/channel/..."
                                    class="flex-1 px-3 py-2 outline-none text-gray-800" />
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="mb-5">
                            <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                            <div
                                class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-500">
                                <span class="px-3 text-gray-500">
                                    <!-- Heroicon: Mail -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M3 6h18a2 2 0 012 2v8a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                    </svg>
                                </span>
                                <input id="email" name="email" type="email"
                                    value="{{ old('email', $kontak->email) }}" placeholder="email@domain.com"
                                    class="flex-1 px-3 py-2 outline-none text-gray-800" />
                            </div>
                        </div>

                        <!-- No. Telepon -->
                        <div class="mb-5">
                            <label for="no_telepon" class="block text-gray-700 font-medium mb-1">No. Telepon</label>
                            <div
                                class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-500">
                                <span class="px-3 text-gray-500">
                                    <!-- Heroicon: Phone -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 5h2l3.6 7.59a1 1 0 01-.21 1.09l-2.73 2.73a11.05 11.05 0 005.25 5.25l2.73-2.73a1 1 0 011.09-.21L19 19v2a1 1 0 01-1 1A16 16 0 013 6a1 1 0 011-1z" />
                                    </svg>
                                </span>
                                <input id="no_telepon" name="no_telepon" type="text"
                                    value="{{ old('no_telepon', $kontak->no_telepon) }}" placeholder="08xx-xxxx-xxxx"
                                    class="flex-1 px-3 py-2 outline-none text-gray-800" />
                            </div>
                        </div>

                        <!-- Facebook -->
                        <div class="mb-5">
                            <label for="facebook" class="block text-gray-700 font-medium mb-1">Facebook</label>
                            <div
                                class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-green-500">
                                <span class="px-3 text-gray-500">
                                    <!-- Heroicon: Facebook -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600"
                                        viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M22 12a10 10 0 10-11.5 9.87v-6.99h-2.2V12h2.2V9.8c0-2.17 1.3-3.38 3.29-3.38.95 0 1.94.17 1.94.17v2.14h-1.1c-1.08 0-1.42.67-1.42 1.36V12h2.42l-.39 2.88h-2.03v6.99A10 10 0 0022 12z" />
                                    </svg>
                                </span>
                                <input id="facebook" name="facebook" type="text"
                                    value="{{ old('facebook', $kontak->facebook) }}"
                                    placeholder="https://facebook.com/username"
                                    class="flex-1 px-3 py-2 outline-none text-gray-800" />
                            </div>
                        </div>

                        <!-- Submit -->
                        <div>
                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-lg transition flex items-center justify-center gap-2">
                                <!-- Heroicon: Save -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                                Update Kontak
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /Card -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const phoneInput = document.getElementById('no_telepon');

            function formatPhone(value) {
                // Hapus semua non-digit
                let digits = value.replace(/\D/g, '');

                // Pastikan diawali '08'
                if (!digits.startsWith('08')) {
                    digits = '08' + digits.replace(/^0*/, '');
                }

                // Potong maksimal 14 digit (opsional)
                digits = digits.substring(0, 14);

                // Bagi menjadi grup 4 digit
                const parts = digits.match(/.{1,4}/g) || [];

                return parts.join('-');
            }

            phoneInput.addEventListener('input', function(e) {
                const formatted = formatPhone(e.target.value);
                e.target.value = formatted;
            });

            // Saat halaman load, lakukan format ulang jika ada nilai lama
            if (phoneInput.value) {
                phoneInput.value = formatPhone(phoneInput.value);
            }
        });
    </script>
@endpush
