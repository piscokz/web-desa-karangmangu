@extends('admin.layouts.app')

@section('title', 'Daftar Dusun')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">📍 Daftar Dusun</h1>

        {{-- Notifikasi --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Aksi: Tambah + Search --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <a href="{{ route('dusun.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium px-5 py-2.5 rounded-lg transition-all shadow">
                ➕ Tambah Dusun
            </a>

            <form action="{{ route('dusun.index') }}" method="GET" class="flex items-center gap-2">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       placeholder="Cari nama dusun..."
                       class="px-4 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-300 transition"
                >
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-4 py-2 rounded-lg shadow">
                    🔍 Cari
                </button>
                @if(request('search'))
                    <a href="{{ route('dusun.index') }}" class="text-sm text-gray-600 hover:text-gray-800 underline ml-1">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        {{-- Tabel --}}
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">No</th>
                        <th class="px-6 py-3 text-left font-semibold">Nama Dusun</th>
                        <th class="px-6 py-3 text-center font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($dusuns as $index => $dusun)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">{{ $dusuns->firstItem() + $index }}</td>
                            <td class="px-6 py-4">{{ $dusun->nama_dusun }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('dusun.edit', $dusun->id) }}"
                                       class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-md shadow text-xs font-semibold">
                                        ✏️ Edit
                                    </a>
                                    <form action="{{ route('dusun.destroy', $dusun->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus dusun ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md shadow text-xs font-semibold">
                                            🗑️ Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-500 italic">
                                Tidak ada data dusun{{ request('search') ? ' untuk "' . request('search') . '"' : '' }}.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $dusuns->links() }}
        </div>
    </div>
</div>
@endsection