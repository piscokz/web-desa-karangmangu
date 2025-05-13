@extends('admin.layouts.app')

@section('title', 'Tambah Dusun')

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="max-w-xl mx-auto bg-white shadow-xl rounded-2xl overflow-hidden">
        <div class="bg-green-600 px-6 py-4">
            <h1 class="text-xl md:text-2xl font-bold text-white">Tambah Dusun</h1>
        </div>

        <div class="p-6">
            {{-- Notifikasi sukses --}}
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Tampilkan error --}}
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dusun.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Input Nama Dusun --}}
                <div>
                    <label for="nama_dusun" class="block text-gray-700 font-semibold mb-1">Nama Dusun</label>
                    <input
                        type="text"
                        name="nama_dusun"
                        id="nama_dusun"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
                        placeholder="Masukkan nama dusun"
                        required
                    >
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                    <a
                        href="{{ route('dusun.index') }}"
                        class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition"
                    >
                        Kembali
                    </a>
                    <button
                        type="submit"
                        class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-500 transition"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection