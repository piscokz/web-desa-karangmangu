@extends('admin.layouts.app')

@section('title', 'Detail Penduduk')
@section('content')
<div class="container mx-auto px-4 py-6">
  <div class="flex items-center space-x-4 mb-6 border-b pb-4">
    <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="h-12">
    <h1 class="text-2xl font-bold text-gray-800">Detail Penduduk</h1>
  </div>

  @if ($penduduk)
    <div class="bg-white shadow-lg rounded-xl p-6 md:p-8">
      <div class="flex flex-col md:flex-row gap-6">
        <!-- Foto Profil -->
        <div class="flex-shrink-0 mx-auto md:mx-0">
          <img src="{{ $penduduk->foto ? asset('storage/' . $penduduk->foto) : asset('images/default-user.png') }}" 
               alt="Foto Penduduk" 
               class="w-40 h-40 object-cover rounded-lg border shadow">
        </div>

        <!-- Data Penduduk -->
        <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-4 text-sm text-gray-700">
          <div>
            <p><span class="font-semibold">NIK:</span> {{ $penduduk->nik }}</p>
            <p><span class="font-semibold">Nama Lengkap:</span> {{ $penduduk->nama_lengkap }}</p>
            <p><span class="font-semibold">Tempat, Tanggal Lahir:</span> {{ $penduduk->tempat_lahir }}, {{ $penduduk->tanggal_lahir }}</p>
            <p><span class="font-semibold">Jenis Kelamin:</span> {{ $penduduk->jenis_kelamin }}</p>
            <p><span class="font-semibold">Agama:</span> {{ $penduduk->agama }}</p>
          </div>
          <div>
            <p><span class="font-semibold">Status Perkawinan:</span> {{ $penduduk->status_perkawinan }}</p>
            <p><span class="font-semibold">Pekerjaan:</span> {{ $penduduk->pekerjaan }}</p>
            <p><span class="font-semibold">Pendidikan:</span> {{ $penduduk->pendidikan }}</p>
            <p><span class="font-semibold">Golongan Darah:</span> {{ $penduduk->gol_darah }}</p>
            <p><span class="font-semibold">SHDK:</span> {{ $penduduk->shdk }}</p>
            <p><span class="font-semibold">No. KK:</span> {{ $penduduk->familyCard->no_kk ?? '-' }}</p>
            <p><span class="font-semibold">No. Telepon:</span> {{ $penduduk->no_telp }}</p>
          </div>
        </div>
      </div>

      <div class="mt-6 text-right">
        <a href="{{ route('penduduk.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Kembali</a>
      </div>
    </div>
  @else
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
      <strong class="font-bold">Oops!</strong>
      <span class="block sm:inline">Data penduduk tidak ditemukan.</span>
    </div>

    <div class="mt-4">
      <a href="{{ route('penduduk.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">Kembali</a>
    </div>
  @endif
</div>
@endsection