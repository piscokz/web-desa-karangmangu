@extends('admin.layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Detail Anggota</h1>

    <div class="space-y-2">
        <p><strong>Nama:</strong> {{ $member->nama }}</p>
        <p><strong>Jabatan:</strong> {{ $member->jabatan }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $member->jenis_kelamin }}</p>
        <p><strong>Umur:</strong> {{ \Carbon\Carbon::parse($member->tanggal_lahir)->age }}</p>
        <p><strong>Alamat:</strong> {{ $member->alamat }}</p>
        @if($member->foto)
            <p><strong>Foto:</strong></p>
            <img src="{{ asset('storage/' . $member->foto) }}" alt="Foto" class="h-40">
        @endif
    </div>

    <a href="{{ route('anggota_desa.index') }}" class="mt-4 inline-block text-blue-500 hover:underline">← Kembali ke daftar</a>
</div>
@endsection
