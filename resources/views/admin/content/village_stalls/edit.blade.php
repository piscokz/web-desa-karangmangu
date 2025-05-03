@extends('admin.layouts.app')

@section('content')
    <h1>Edit Produk: {{ $village_stall->nama_produk }}</h1>

    <form action="{{ route('lapak_desa.update', $village_stall->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Nama Produk:</label>
        <input type="text" name="nama_produk" value="{{ old('nama_produk', $village_stall->nama_produk) }}"><br>

        <label>Pemilik (Penduduk):</label>
        <select name="id_penduduk">
            @foreach ($penduduks as $resident)
                <option value="{{ $resident->id }}" {{ $village_stall->id_penduduk == $resident->id ? 'selected' : '' }}>
                    {{ $resident->nik }} ({{ $resident->nama_lengkap }})
                </option>
            @endforeach
        </select><br>

        <label>No Telepon:</label>
        <input type="text" name="no_telepon" value="{{ old('no_telepon', $village_stall->no_telepon) }}"><br>

        <label>Kategori:</label>
        <input type="text" name="kategori" value="{{ old('kategori', $village_stall->kategori) }}"><br>

        <label>Deskripsi:</label>
        <textarea name="deskripsi">{{ old('deskripsi', $village_stall->deskripsi) }}</textarea><br>

        <label>Gambar Produk:</label>
        <input type="file" name="gambar_produk"><br>
        <img src="{{ asset('storage/' . $village_stall->gambar_produk) }}" width="100"><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
    <a href="{{ route('lapak_desa.index') }}">Kembali ke Daftar</a>
@endsection
