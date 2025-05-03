@extends('admin.layouts.app')

@section('content')
<h1>Tambah Produk Baru</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('lapak_desa.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nama Produk:</label>
    <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"><br>

    <label>Pemilik (Penduduk):</label>
    {{-- @dd($penduduks) --}}
    <select name="id_penduduk">
        @foreach($penduduks as $penduduk)
            <option value="{{ $penduduk->id }}" {{ old('id_penduduk') == $penduduk->id ? 'selected' : '' }}>
                {{ $penduduk->nik }} ({{ $penduduk->nama_lengkap }})
            </option>
        @endforeach
    </select><br>

    <label>No Telepon:</label>
    <input type="text" name="no_telepon" value="{{ old('no_telepon') }}"><br>

    <label>Kategori:</label>
    <input type="text" name="kategori" value="{{ old('kategori') }}"><br>

    <label>Deskripsi:</label>
    <textarea name="deskripsi">{{ old('deskripsi') }}</textarea><br>

    <label>Gambar Produk:</label>
    <input type="file" name="gambar_produk"><br>

    <button type="submit">Simpan Produk</button>
</form>

<a href="{{ route('lapak_desa.index') }}">Kembali ke Daftar</a>
@endsection

