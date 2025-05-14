{{-- resources/views/admin/content/penduduk/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Daftar Anggota Desa')

@section('content')
<div class="max-w-5xl mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Data Anggota Desa</h1>
        <a href="{{ route('anggota_desa.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">+ Tambah Anggota</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">{{ session('success') }}</div>
    @endif

    <table class="w-full border shadow-sm">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">Nama</th>
                <th class="p-2 text-left">Jabatan</th>
                <th class="p-2 text-left">Organisasi</th>
                <th class="p-2 text-left">Umur</th>
                <th class="p-2 text-left">Jenis Kelamin</th>
                <th class="p-2 text-left">Alamat</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr class="border-t">
                <td class="p-2">{{ $member->nama }}</td>
                <td class="p-2">{{ $member->jabatan }}</td>
                <td class="p-2">{{ $member->organisasi }}</td>
                <td class="p-2">{{ \Carbon\Carbon::parse($member->tanggal_lahir)->age }}</td>
                <td class="p-2">{{ $member->jenis_kelamin }}</td>
                <td class="p-2">{{ $member->alamat }}</td>
                <td class="p-2 text-center space-x-2">
                    <a href="{{ route('anggota_desa.show', $member) }}" class="text-blue-500">Lihat</a>
                    <a href="{{ route('anggota_desa.edit', $member) }}" class="text-yellow-500">Edit</a>
                    <form action="{{ route('anggota_desa.destroy', $member) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-red-500 hover:underline">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
