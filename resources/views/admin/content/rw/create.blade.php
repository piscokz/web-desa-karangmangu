@extends('admin.layouts.app')

@section('title', 'Tambah RW')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-green-800 mb-6">Tambah RW</h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded-lg">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-2xl p-6">
        <form action="{{ route('rw.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="form-group">
                <label for="nomor_rw" class="block text-gray-700 font-medium mb-1">Nomor RW</label>
                <input type="text" name="nomor_rw" id="nomor_rw" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" required placeholder="Masukkan Nomor RW">
            </div>
            <div class="form-group">
                <label for="id_dusun" class="block text-gray-700 font-medium mb-1">Nama Dusun</label>
                <select name="id_dusun" id="id_dusun" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" required>
                    <option value="">Pilih Dusun</option>
                    @foreach ($dusuns as $dusun)
                        <option value="{{ $dusun->id }}">{{ $dusun->nama_dusun }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-500 transition">Simpan</button>
                <a href="{{ route('rw.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-500 transition">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection