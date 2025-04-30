{{-- resources/views/admin/article/create.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Buat Artikel Desa')

@section('content')
    <div class="container mx-auto px-4 py-8" data-aos="fade-up">
        {{-- Kembali --}}
        <a href="{{ route('admin.article.index') }}" class="text-green-700 hover:underline">&larr; Kembali ke Daftar
            Artikel</a>

        <div class="bg-white shadow rounded-lg p-6 mt-4" data-aos="fade-up" data-aos-delay="100">
            <h1 class="text-3xl font-bold mb-4 text-green-800">Buat Artikel Desa</h1>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf

                {{-- Judul Artikel --}}
                <div>
                    <label for="title" class="block text-lg font-medium text-gray-700">Judul Artikel</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                    @error('title')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Kategori Desa --}}
                <div x-data="{ other: '{{ old('category') }}' === 'Lainnya' }" class="space-y-2">
                    <label for="category" class="block text-lg font-medium text-gray-700">Kategori Berita</label>
                    <select name="category" id="category" @change="other = $event.target.value === 'Lainnya'" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600 transition">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Berita" {{ old('category') == 'Berita' ? 'selected' : '' }}>Berita
                        </option>
                        <option value="Pengumuman" {{ old('category') == 'Pengumuman' ? 'selected' : '' }}>Pengumuman
                        </option>
                        <option value="Agenda" {{ old('category') == 'Agenda' ? 'selected' : '' }}>Agenda
                        </option>
                        <option value="Kegiatan Warga" {{ old('category') == 'Kegiatan Warga' ? 'selected' : '' }}>
                            Kegiatan Warga</option>
                        <option value="Layanan Publik" {{ old('category') == 'Layanan Publik' ? 'selected' : '' }}>
                            Layanan Publik</option>
                        <option value="Informasi Penting" {{ old('category') == 'Informasi Penting' ? 'selected' : '' }}>
                            Informasi Penting</option>
                        <option value="Lainnya" {{ old('category') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                        </option>
                    </select>
                    @error('category')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    {{-- Input Manual Jika Pilih "Lainnya" --}}
                    <div x-show="other" x-cloak class="mt-4 space-y-1">
                        <label for="category_other" class="block text-lg font-medium text-gray-700">
                            Masukkan Kategori Baru
                        </label>
                        <input type="text" name="category_other" id="category_other" value="{{ old('category_other') }}"
                            placeholder="Tulis kategori di sini..."
                            class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600 transition" />
                        @error('category_other')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Alpine.js --}}
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


                {{-- Tanggal Artikel --}}
                <div>
                    <label for="date" class="block text-lg font-medium text-gray-700">Tanggal Artikel</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                    @error('date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Konten Artikel --}}
                <div>
                    <label for="content" class="block text-lg font-medium text-gray-700">Konten Artikel</label>
                    <textarea name="content" id="content" rows="6" required
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">{{ old('content') }}</textarea>
                    @error('content')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Gambar Utama --}}
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Gambar Utama</label>
                    <div id="feature-dropzone"
                        class="border-2 border-dashed border-gray-300 rounded-md p-6 flex flex-col items-center justify-center cursor-pointer transition hover:border-green-600">
                        <p class="text-gray-500">Klik atau seret gambar ke sini</p>
                        <img id="feature-preview" src="" alt="" class="mt-4 max-h-60 rounded"
                            style="display: none;">
                    </div>
                    <input type="file" name="image" id="image" class="hidden" accept="image/*">
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Nama Penulis --}}
                <div>
                    <label for="author_name" class="block text-lg font-medium text-gray-700">Nama Penulis</label>
                    <input type="text" name="author_name" id="author_name" value="{{ old('author_name') }}"
                        class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-green-600">
                    @error('author_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Foto Penulis --}}
                <div>
                    <label class="block text-lg font-medium text-gray-700 mb-2">Foto Penulis (Avatar)</label>
                    <div id="author-dropzone"
                        class="border-2 border-dashed border-gray-300 rounded-full w-32 h-32 mx-auto flex items-center justify-center cursor-pointer transition hover:border-green-600 overflow-hidden">
                        <span id="author-dropzone-text" class="text-gray-500">Klik atau seret foto</span>
                        <img id="author-preview" src="" alt="" class="w-full h-full object-cover"
                            style="display: none;">
                    </div>
                    <input type="file" name="author_photo" id="author_photo" class="hidden" accept="image/*">
                    @error('author_photo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="w-full py-3 bg-green-600 text-white rounded-md font-semibold hover:bg-green-500 transition duration-300">
                        Buat Artikel Desa
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('content', {
            removeButtons: 'PasteFromWord'
        });

        // Auto-set today
        document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('date');
            if (dateInput && !dateInput.value) {
                dateInput.value = new Date().toISOString().substr(0, 10);
            }
        });

        // Feature Image Dropzone
        const featureDropzone = document.getElementById('feature-dropzone');
        const featureInput = document.getElementById('image');
        const featurePreview = document.getElementById('feature-preview');

        featureDropzone.addEventListener('click', () => featureInput.click());
        ['dragover', 'dragenter'].forEach(evt =>
            featureDropzone.addEventListener(evt, e => {
                e.preventDefault();
                featureDropzone.classList.add('border-green-600');
            })
        );
        ['dragleave', 'drop'].forEach(evt =>
            featureDropzone.addEventListener(evt, e => {
                e.preventDefault();
                featureDropzone.classList.remove('border-green-600');
                if (evt === 'drop' && e.dataTransfer.files.length) {
                    featureInput.files = e.dataTransfer.files;
                    previewFeatureImage(featureInput.files[0]);
                }
            })
        );
        featureInput.addEventListener('change', () => {
            if (featureInput.files.length) previewFeatureImage(featureInput.files[0]);
        });

        function previewFeatureImage(file) {
            const reader = new FileReader();
            reader.onload = e => {
                featurePreview.src = e.target.result;
                featurePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        // Author Photo Dropzone
        const authorDropzone = document.getElementById('author-dropzone');
        const authorInput = document.getElementById('author_photo');
        const authorPreview = document.getElementById('author-preview');
        const authorText = document.getElementById('author-dropzone-text');

        authorDropzone.addEventListener('click', () => authorInput.click());
        ['dragover', 'dragenter'].forEach(evt =>
            authorDropzone.addEventListener(evt, e => {
                e.preventDefault();
                authorDropzone.classList.add('border-green-600');
            })
        );
        ['dragleave', 'drop'].forEach(evt =>
            authorDropzone.addEventListener(evt, e => {
                e.preventDefault();
                authorDropzone.classList.remove('border-green-600');
                if (evt === 'drop' && e.dataTransfer.files.length) {
                    authorInput.files = e.dataTransfer.files;
                    previewAuthorImage(authorInput.files[0]);
                }
            })
        );
        authorInput.addEventListener('change', () => {
            if (authorInput.files.length) previewAuthorImage(authorInput.files[0]);
        });

        function previewAuthorImage(file) {
            const reader = new FileReader();
            reader.onload = e => {
                authorPreview.src = e.target.result;
                authorPreview.style.display = 'block';
                authorText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    </script>
@endsection