@extends('admin.layouts.app')   

@section('content')
<h1>Detail Produk: {{ $village_stall->nama_produk }}</h1>

<img src="{{ asset('storage/' . $village_stall->gambar_produk) }}" width="200"><br>
<p><strong>Pemilik:</strong> {{ $village_stall->resident->nama_lengkap ?? 'Tidak diketahui' }}</p>
<p><strong>No Telepon:</strong> {{ $village_stall->no_telepon }}</p>
<p><strong>Kategori:</strong> {{ $village_stall->kategori ?? '-' }}</p>
<p><strong>Deskripsi:</strong><br> {{ $village_stall->deskripsi }}</p>

<a href="{{ route('lapak_desa.edit', $village_stall->id_produk) }}">Edit Produk</a> |
<a href="{{ route('lapak_desa.index') }}">Kembali ke Daftar</a>
@endsection
