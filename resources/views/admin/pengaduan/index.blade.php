@extends('admin.layouts.app')

@section('title', 'Kelola Pengaduan')

@section('content')
<div class="container mx-auto px-4 py-8">

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow">
        {{ session('success') }}
    </div>
    @endif

    <h1 class="text-3xl font-bold text-[#14532d] mb-8">📬 Kotak Masuk Pengaduan</h1>

    @forelse($list as $p)
    <div class="bg-white shadow-md rounded-xl mb-6 p-6 border border-gray-100 hover:shadow-lg transition duration-300">
        <div class="flex justify-between items-start">
            <div>
                <h2 class="text-lg font-semibold text-[#14532d]">{{ $p->nama }}</h2>
                <p class="text-sm text-gray-500 mb-1">{{ $p->email }}</p>
                <p class="text-sm text-gray-600">RW {{ $p->rw }} / RT {{ $p->rt }}</p>
            </div>
            <div class="text-sm text-gray-500">
                <span class="inline-block bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-1 rounded-full">
                    {{ $p->waktu->diffForHumans() }}
                </span>
                <p class="text-xs mt-1">{{ $p->waktu->format('d M Y H:i') }}</p>
            </div>
        </div>

        <div class="mt-4 flex justify-end space-x-3">
            <a href="{{ route('admin.pengaduan.reply', $p) }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-500 transition">
                ✉️ Jawab
            </a>
            <form action="{{ route('admin.pengaduan.destroy', $p) }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-500 transition">
                    🗑 Hapus
                </button>
            </form>
        </div>
    </div>
    @empty
    <div class="bg-white border border-dashed border-gray-300 p-8 rounded-xl text-center text-gray-500">
        <p class="text-lg">Belum ada pengaduan masuk.</p>
    </div>
    @endforelse

</div>
@endsection