@extends('admin.layouts.app')

@section('title', 'Daftar Dusun')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Daftar Dusun</h1>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between mb-4">
        <a href="{{ route('dusun.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">Tambah Dusun</a>
    </div>

    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">No</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Nama Dusun</th>
                <th class="px-6 py-3 text-center text-sm font-semibold text-gray-700 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 bg-white">
            @foreach ($dusuns as $index => $dusun)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 text-sm text-gray-800">{{ $index + 1 }}</td>
                <td class="px-6 py-4 text-sm text-gray-800">{{ $dusun->nama_dusun }}</td>
                <td class="px-6 py-4 text-sm text-center space-x-2">
                    <a href="{{ route('dusun.edit', $dusun->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">Edit</a>
                    <form action="{{ route('dusun.destroy', $dusun->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus dusun ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $dusuns->links() }} <!-- Pagination links -->
    </div>
</div>
@endsection