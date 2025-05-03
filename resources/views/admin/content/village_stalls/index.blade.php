@extends('admin.layouts.app')

@section('content')
<h1>Lapak Desa</h1>
<a href="{{ route('lapak_desa.create') }}">Tambah Produk</a>
@foreach ($lapak as $item)
    <div>
        <h3>{{ $item->nama_produk }}</h3>
        <img src="{{ asset('storage/' . $item->gambar_produk) }}" width="100">
        <p>{{ $item->deskripsi }}</p>
        <a href="{{ route('lapak_desa.edit', $item) }}">Edit</a>
        <a href="{{ route('lapak_desa.show', $item) }}">Detail</a>
        <form action="{{ route('lapak_desa.destroy', $item) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Hapus</button>
        </form>
    </div>
@endforeach
@endsection
