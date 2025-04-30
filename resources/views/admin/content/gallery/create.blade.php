@extends('admin.layouts.app')

@section('title', 'Tambah Galeri')

@section('content')
    <div class="container mx-auto p-4">
        <a href="{{ route('admin.gallery.index') }}" class="inline-block text-green-600 hover:underline mb-4">&larr;
            Kembali</a>
        <div class="bg-white shadow-lg rounded-2xl p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-6 text-green-800">➕ Tambah Item Galeri</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Festival Panen"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-200 transition"
                        required>
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Kategori</label>
                    <select id="createCategorySelect" name="category"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-200 transition"
                        required onchange="handleCategoryChange('create')">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Budaya" {{ old('category') == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                        <option value="Pendidikan" {{ old('category') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan
                        </option>
                        <option value="Kesehatan" {{ old('category') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="Pembangunan" {{ old('category') == 'Pembangunan' ? 'selected' : '' }}>Pembangunan
                        </option>
                        <option value="Pertanian" {{ old('category') == 'Pertanian' ? 'selected' : '' }}>Pertanian</option>
                        <option value="Keagamaan" {{ old('category') == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>

                    <input id="createCategoryInput" type="text" name="category_custom" placeholder="Tulis kategori..."
                        class="mt-3 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-200 transition hidden" />
                </div>
                <script>
                    function handleCategoryChange(formType) {
                        const selectElement = document.getElementById(`${formType}CategorySelect`);
                        const inputElement = document.getElementById(`${formType}CategoryInput`);
                        if (selectElement.value === 'Lainnya') {
                            inputElement.classList.remove('hidden');
                            inputElement.setAttribute('name', 'category');
                            selectElement.removeAttribute('name');
                        } else {
                            inputElement.classList.add('hidden');
                            inputElement.removeAttribute('name');
                            selectElement.setAttribute('name', 'category');
                        }
                    }

                    // jalankan saat halaman load untuk edit
                    window.addEventListener('DOMContentLoaded', () => {
                        handleCategoryChange('create');
                        handleCategoryChange('edit');
                    });
                </script>

                <div>
                    <label class="block font-medium text-gray-700">Tanggal</label>
                    <input type="date" name="date" id="dateInput"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-200 transition"
                        required>
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Gambar</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-gray-600 focus:outline-none"
                        required>
                </div>
                <div class="text-right">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-500 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // set default tanggal hari ini
        window.addEventListener('DOMContentLoaded', () => {
            const inp = document.getElementById('dateInput');
            if (inp && !inp.value) {
                inp.value = new Date().toISOString().slice(0, 10);
            }
        });
    </script>
@endsection
