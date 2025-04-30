@extends('admin.layouts.app')

@section('title', 'Detail Kartu Keluarga')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center mb-6 space-x-4 border-b pb-4">
        <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="h-12">
        <h1 class="text-2xl font-bold text-gray-800">Detail Kartu Keluarga - {{ $kartuKeluarga->no_kk }}</h1>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6 space-y-4 text-sm text-gray-700">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <p><span class="font-semibold">Dusun:</span> {{ $kartuKeluarga->hamlet->nama_dusun }}</p>
            <p><span class="font-semibold">RW:</span> {{ $kartuKeluarga->rw->nomor_rw }}</p>
            <p><span class="font-semibold">RT:</span> {{ $kartuKeluarga->rt->nomor_rt }}</p>
        </div>
        <p><span class="font-semibold">Jumlah Anggota:</span> {{ $kartuKeluarga->residents->count() }}</p>

        @if ($kartuKeluarga->residents->count())
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white border rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-left text-sm text-gray-600 uppercase">
                            <th class="px-4 py-2 border">No</th>
                            <th class="px-4 py-2 border">NIK</th>
                            <th class="px-4 py-2 border">Nama</th>
                            <th class="px-4 py-2 border">Jenis Kelamin</th>
                            <th class="px-4 py-2 border">SHDK</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-800">
                        @foreach($kartuKeluarga->residents as $idx => $resident)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $idx + 1 }}</td>
                                <td class="px-4 py-2 border">{{ $resident->nik }}</td>
                                <td class="px-4 py-2 border">{{ $resident->nama_lengkap }}</td>
                                <td class="px-4 py-2 border">{{ $resident->jenis_kelamin }}</td>
                                <td class="px-4 py-2 border">{{ $resident->shdk }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">Tidak ada anggota keluarga yang terdaftar.</span>
            </div>
        @endif

        <div class="mt-6">
            <a href="{{ route('kk.index') }}" class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition">Kembali</a>
        </div>
    </div>
</div>
@endsection