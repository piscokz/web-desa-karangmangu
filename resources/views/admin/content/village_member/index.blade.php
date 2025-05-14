{{-- resources/views/admin/content/penduduk/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Daftar Anggota Desa')

@section('content')
<div class="max-w-6xl mx-auto p-6 space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0">
        <h1 class="text-3xl font-extrabold text-amber-600">Data Anggota Desa</h1>
        <div class="flex items-center space-x-4">
            <form action="{{ route('anggota_desa.index') }}" method="GET" class="relative">
                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari nama atau jabatan..."
                    class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-amber-400"
                >
                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z" />
                    </svg>
                </span>
            </form>
            <a href="{{ route('anggota_desa.create') }}" class="inline-flex items-center bg-amber-500 hover:bg-amber-600 text-white px-5 py-2 rounded-lg shadow transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Anggota
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-2xl shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Organisasi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Umur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($members as $member)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->nama }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->jabatan }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->organisasi }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($member->tanggal_lahir)->age }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->jenis_kelamin }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->alamat }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium space-x-2">
                        <a href="{{ route('anggota_desa.show', $member) }}" class="inline-flex items-center p-2 bg-white rounded-full hover:bg-amber-50 transition" title="Lihat">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5s8.268 2.943 9.542 7c-1.274 4.057-5.065 7-9.542 7s-8.268-2.943-9.542-7z" />
                            </svg>
                        </a>
                        <a href="{{ route('anggota_desa.edit', $member) }}" class="inline-flex items-center p-2 bg-white rounded-full hover:bg-blue-50 transition" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-5" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
                            </svg>
                        </a>
                        <form action="{{ route('anggota_desa.destroy', $member) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="inline-flex items-center p-2 bg-white rounded-full hover:bg-red-50 transition" title="Hapus">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3" />
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada data anggota desa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination jika pakai paginate --}}
    <div class="mt-6">
        {{ $members->appends(request()->query())->links() }}
    </div>
</div>
@endsection