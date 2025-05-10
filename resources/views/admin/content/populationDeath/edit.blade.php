{{-- resources/views/admin/content/populationDeath/edit.blade.php --}}

@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8">
  {{-- Header --}}
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-extrabold text-gray-900 flex items-center">
      Edit Data Kematian <span class="text-gray-400 ml-2">🪦</span>
    </h1>
    <a href="{{ route('kematian.index') }}"
       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded shadow transition">
      ← Kembali
    </a>
  </div>

  {{-- Flash Success --}}
  @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg shadow-inner">
      {{ session('success') }}
    </div>
  @endif

  {{-- Form Edit --}}
  <form action="{{ route('kematian.update', $death->id) }}" method="POST"
        class="bg-white p-6 rounded-2xl shadow-lg grid grid-cols-1 gap-6">
    @csrf @method('PUT')

    {{-- Penduduk --}}
    <div>
      <label for="penduduk_id" class="block text-gray-700 font-medium mb-2">
        Penduduk <span class="text-red-500">*</span>
      </label>
      <select id="pendudukSelectEdit" name="penduduk_id" required
              class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="" disabled>-- Pilih Penduduk --</option>
        @foreach($residents as $r)
          <option value="{{ $r->id }}"
            {{ old('penduduk_id', $death->penduduk_id) == $r->id ? 'selected' : '' }}
            {{ ($r->death && $r->id !== $death->penduduk_id) ? 'disabled' : '' }}>
            {{ $r->nik }} — {{ $r->nama_lengkap }}
            @if($r->death)
              @if($r->id === $death->penduduk_id)
                (Sedang dipilih)
              @else
                (Sudah tercatat meninggal)
              @endif
            @endif
          </option>
        @endforeach
      </select>
      @error('penduduk_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Tanggal & Penyebab --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div>
        <label for="tanggal_meninggal" class="block text-gray-700 font-medium mb-2">
          Tanggal Meninggal <span class="text-red-500">*</span>
        </label>
        <input id="tanggal_meninggal" type="date" name="tanggal_meninggal"
               value="{{ old('tanggal_meninggal', $death->tanggal_meninggal->format('Y-m-d')) }}"
               class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
               required>
        @error('tanggal_meninggal')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label for="penyebab" class="block text-gray-700 font-medium mb-2">Penyebab</label>
        <input id="penyebab" type="text" name="penyebab"
               value="{{ old('penyebab', $death->penyebab) }}"
               placeholder="Contoh: Sakit"
               class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('penyebab')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>
    </div>

    {{-- Keterangan --}}
    <div>
      <label for="keterangan" class="block text-gray-700 font-medium mb-2">Keterangan</label>
      <textarea id="keterangan" name="keterangan" rows="4"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Tambahan keterangan...">{{ old('keterangan', $death->keterangan) }}</textarea>
      @error('keterangan')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Buttons --}}
    <div class="flex justify-end space-x-3 pt-4">
      <button type="submit"
              class="inline-flex items-center px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-gray-900 rounded-lg shadow transition">
        💾 Update
      </button>
      <a href="{{ route('kematian.index') }}"
         class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg shadow transition">
        ✖ Batal
      </a>
    </div>
  </form>
</div>

{{-- Select2 --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(function() {
    $('#pendudukSelectEdit').select2({
      placeholder: 'Cari NIK atau Nama…',
      width: '100%'
    });
  });
</script>
@endsection