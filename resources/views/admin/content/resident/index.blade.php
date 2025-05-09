{{-- resources/views/admin/content/penduduk/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Daftar Penduduk')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="h-12">
                <h1 class="text-3xl font-bold text-gray-800">Daftar Penduduk</h1>
            </div>
            <form method="GET" action="{{ route('penduduk.index') }}" class="mb-4 flex gap-2">
                <input type="text" name="search" placeholder="Cari NIK / Nama / No KK" value="{{ request('search') }}"
                    class="px-3 py-2 border rounded-md">

                <select name="organisasi" class="px-3 py-2 border rounded-md">
                    <option value="">Semua</option>
                    <option value="penduduk" {{ request('organisasi') == 'penduduk'  ? 'selected' : '' }}>
                      Penduduk</option>
                    @foreach (['Pemerintah desa', 'Bpd', 'Lpm', 'Pkk', 'Mui', 'Linmas', 'Bumdes', 'Karang Taruna', 'Kepala Dusun', 'Ketua Rt/rw', 'Lainnya'] as $item)
                        <option value="{{ $item }}" {{ request('organisasi') == $item ? 'selected' : '' }}>
                            {{ $item }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Filter</button>
            </form>
            <a href="{{ route('penduduk.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                + Tambah Penduduk
            </a>

        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('penduduk.index') }}" class="mb-6">
            <div class="flex space-x-2">
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari NIK, Nama, No. KK..."
                    class="flex-1 border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Cari
                </button>
            </div>
        </form>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">NIK</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">TTL</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">JK</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">No. KK</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach ($penduduk as $i => $res)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $penduduk->firstItem() + $i }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $res->nik }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $res->nama_lengkap }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ $res->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($res->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $res->jenis_kelamin }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $res->familyCard->no_kk ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-center space-x-2">
                                <a href="{{ route('penduduk.show', $res->id) }}"
                                    class="text-blue-600 hover:underline">Detail</a>
                                <a href="{{ route('penduduk.edit', $res->id) }}"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('penduduk.destroy', $res->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $penduduk->links() }}
        </div>
    </div>
@endsection
