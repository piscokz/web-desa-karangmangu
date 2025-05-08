@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Data Kematian</h1>

    <form action="{{ route('kematian.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="penduduk_id" class="form-label">Penduduk</label>
            <select name="penduduk_id" class="form-control" required>
                @foreach($residents as $resident)
                    <option value="{{ $resident->id }}">{{ $resident->nama_lengkap }} ({{ $resident->nik }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal</label>
            <input type="date" name="tanggal_meninggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="penyebab" class="form-label">Penyebab</label>
            <input type="text" name="penyebab" class="form-control">
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kematian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
