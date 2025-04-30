<!-- Blade: resources/views/admin/content/familyCard/index.blade.php -->
@extends('admin.layouts.app')

@section('title', 'Daftar Kartu Keluarga')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="h-12">
            <h1 class="text-2xl font-bold">Daftar Kartu Keluarga</h1>
        </div>
        <a href="{{ route('kk.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">Tambah KK</a>
    </div>

    <form method="GET" action="{{ route('kk.index') }}" class="mb-4">
        <div class="flex space-x-2">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari No. KK, Dusun, RW, RT..." 
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Cari</button>
        </div>
    </form>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full leading-normal">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">No</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">No. KK</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Dusun</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">RW</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">RT</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Anggota</th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 text-center text-sm font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kartuKeluarga as $index => $familyCard)
                <tr class="hover:bg-gray-50">
                    <td class="px-5 py-3 border-b border-gray-200 text-sm">{{ $kartuKeluarga->firstItem() + $index }}</td>
                    <td class="px-5 py-3 border-b border-gray-200 text-sm">{{ $familyCard->no_kk }}</td>
                    <td class="px-5 py-3 border-b border-gray-200 text-sm">{{ $familyCard->hamlet->nama_dusun }}</td>
                    <td class="px-5 py-3 border-b border-gray-200 text-sm">{{ $familyCard->rw->nomor_rw }}</td>
                    <td class="px-5 py-3 border-b border-gray-200 text-sm">{{ $familyCard->rt->nomor_rt }}</td>
                    <td class="px-5 py-3 border-b border-gray-200 text-sm">{{ $familyCard->residents->count() }}</td>
                    <td class="px-5 py-3 border-b border-gray-200 text-sm text-center space-x-1">
                        <a href="{{ route('kk.show', $familyCard->id) }}" class="text-blue-500 hover:underline">Detail</a>
                        <a href="{{ route('kk.edit', $familyCard->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                        <form action="{{ route('kk.destroy', $familyCard->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')"
                                    class="text-red-500 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kartuKeluarga->links() }}
    </div>
</div>
@endsection