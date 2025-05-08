@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Data Kematian Penduduk</h1>
    <a href="{{ route('kematian.create') }}" class="btn btn-primary mb-3">+ Tambah Data</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Penduduk</th>
                <th>Tanggal Meninggal</th>
                <th>Penyebab</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deaths as $death)
            <tr>
                <td>{{ $death->resident->nama_lengkap ?? '-' }}</td>
                <td>{{ $death->tanggal_meninggal }}</td>
                <td>{{ $death->penyebab }}</td>
                <td>{{ $death->keterangan }}</td>
                <td>
                    <a href="{{ route('kematian.edit', $death) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <form action="{{ route('kematian.destroy', $death->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
