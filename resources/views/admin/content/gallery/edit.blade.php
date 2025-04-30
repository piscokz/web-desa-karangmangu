@extends('admin.layouts.app')

@section('title', 'Ubah Galeri')

@section('content')
    <div class="container mx-auto p-4">
        <a href="{{ route('admin.gallery.index') }}" class="inline-block text-green-600 hover:underline mb-4">&larr;
            Kembali</a>
        <div class="bg-white shadow-lg rounded-2xl p-8" data-aos="fade-up">
            <h2 class="text-2xl font-bold mb-6 text-green-800">✏️ Ubah Item Galeri</h2>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.gallery.update', $item) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf @method('PUT')
                <div>
                    <label class="block font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" value="{{ old('title', $item->title) }}"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-200 transition"
                        required>
                </div>
                @php
                    $categories = ['Budaya', 'Pendidikan', 'Kesehatan', 'Pembangunan', 'Pertanian', 'Keagamaan'];
                    $isCustomCategory = !in_array($item->category, $categories);
                @endphp

                <div>
                    <label class="block font-medium text-gray-700">Kategori</label>
                    <select id="editCategorySelect" name="category"
                        class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-200 transition"
                        onchange="handleCategoryChange('edit')">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}"
                                {{ old('category', $item->category) == $cat ? 'selected' : '' }}>{{ $cat }}
                            </option>
                        @endforeach
                        <option value="Lainnya" {{ $isCustomCategory ? 'selected' : '' }}>Lainnya</option>
                    </select>

                    <input id="editCategoryInput" type="text" name="category_custom" placeholder="Tulis kategori..."
                        value="{{ $isCustomCategory ? old('category', $item->category) : '' }}"
                        class="mt-3 w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-green-200 transition {{ $isCustomCategory ? '' : 'hidden' }}" />
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
                    <label class="block font-medium text-gray-700">Gambar Saat Ini</label>
                    <img src="{{ $item->image_url }}" class="h-32 w-full object-cover rounded-lg mb-4 shadow-md">
                    <label class="block font-medium text-gray-700">Ganti Gambar</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-gray-600 focus:outline-none">
                </div>
                <div class="text-right">
                    <button type="submit"
                        class="bg-green-600 hover:bg-green-500 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // isi tanggal dengan value lama atau hari ini jika belum ada
        window.addEventListener('DOMContentLoaded', () => {
            const inp = document.getElementById('dateInput');
            if (inp) {
                inp.value = inp.value || new Date().toISOString().slice(0, 10);
            }
        });
    </script>
@endsection