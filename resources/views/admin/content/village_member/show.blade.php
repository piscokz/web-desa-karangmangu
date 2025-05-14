{{-- resources/views/admin/content/village_member/show.blade.php --}}
@extends('admin.layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl p-8 mt-10">
    {{-- Header --}}
    <div class="flex items-center mb-6 space-x-4">
        <img src="{{ $member->foto ? asset('images/' . $member->foto) : asset('images/default-avatar.png') }}" alt="Foto {{ $member->nama }}" class="w-24 h-24 rounded-full object-cover shadow-md">
        <div>
            <h1 class="text-3xl font-bold text-amber-600">{{ $member->nama }}</h1>
            <p class="text-sm text-gray-500">{{ $member->jabatan }} - {{ $member->organisasi }}</p>
        </div>
    </div>

    {{-- Detail Info --}}
    <div class="grid grid-cols-1 gap-4">
        <div class="flex justify-between bg-gray-50 p-4 rounded-lg">
            <span class="font-medium text-gray-700">Jenis Kelamin</span>
            <span class="text-gray-900">{{ $member->jenis_kelamin }}</span>
        </div>
        <div class="flex justify-between bg-gray-50 p-4 rounded-lg">
            <span class="font-medium text-gray-700">Umur</span>
            <span class="text-gray-900">{{ \Carbon\Carbon::parse($member->tanggal_lahir)->age }} tahun</span>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <span class="font-medium text-gray-700">Alamat</span>
            <p class="mt-1 text-gray-900">{{ $member->alamat }}</p>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-8 flex justify-between">
        <a href="{{ route('anggota_desa.index') }}" class="inline-flex items-center text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
        </a>
        <div class="space-x-4">
            <a href="{{ route('anggota_desa.edit', $member) }}" class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow transition">
                Edit
            </a>
            <form action="{{ route('anggota_desa.destroy', $member) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow transition">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
@endsectioN