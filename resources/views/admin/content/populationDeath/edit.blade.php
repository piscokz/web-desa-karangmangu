@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Kematian</h1>

    <form action="{{ route('kematian.update', $populationDeath->id) }}" method="POST">
        {{-- CSRF token for security --}}
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="penduduk_id" class="form-label">Penduduk</label>
            <select name="penduduk_id" class="form-control" required>
                @foreach($residents as $resident)
                    <option value="{{ $resident->id }}" {{ $resident->id == $populationDeath->penduduk_id ? 'selected' : '' }}>
                        {{ $resident->nama_lengkap }} ({{ $resident->nik }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_meninggal" class="form-label">Tanggal Meninggal</label>
            <input type="date" name="tanggal_meninggal" class="form-control" value="{{ $populationDeath->tanggal_meninggal }}" required>
        </div>

        <div class="mb-3">
            <label for="penyebab" class="form-label">Penyebab</label>
            <input type="text" name="penyebab" class="form-control" value="{{ $populationDeath->penyebab }}">
        </div>

        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $populationDeath->keterangan }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('kematian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
