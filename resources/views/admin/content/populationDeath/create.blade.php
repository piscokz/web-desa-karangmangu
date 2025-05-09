@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-8">
  <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-extrabold text-gray-900 flex items-center">
      Tambah Data Kematian
      <span class="text-gray-400 ml-2">🪦</span>
    </h1>
    <a href="{{ route('kematian.index') }}"
       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded shadow transition">
      ← Kembali
    </a>
  </div>

  {{-- Success --}}
  @if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-4 shadow">
      {{ session('success') }}
    </div>
  @endif

  <form id="createDeathForm" action="{{ route('kematian.store') }}" method="POST"
        class="bg-white p-6 rounded-2xl shadow-lg grid grid-cols-1 md:grid-cols-2 gap-6">
    @csrf

    {{-- Penduduk --}}
    <div class="md:col-span-2">
      <label for="penduduk_id" class="block text-gray-700 font-medium mb-2">Penduduk <span class="text-red-500">*</span></label>
      <select id="pendudukSelectCreate" name="penduduk_id" class="form-input" required>
        <option value="" disabled selected>-- Pilih Penduduk --</option>
        @foreach($residents as $r)
          <option value="{{ $r->id }}"
            {{ old('penduduk_id') == $r->id ? 'selected' : '' }}
            {{ $r->death ? 'disabled' : '' }}>
            {{ $r->nik }} — {{ $r->nama_lengkap }}
            @if($r->death)
              — (Sudah tercatat meninggal)
            @endif
          </option>
        @endforeach
      </select>
      @error('penduduk_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Tanggal Meninggal --}}
    <div>
      <label for="tanggal_meninggal" class="block text-gray-700 font-medium mb-2">Tanggal Meninggal <span class="text-red-500">*</span></label>
      <input id="tanggal_meninggal" type="date" name="tanggal_meninggal"
             value="{{ old('tanggal_meninggal', \Carbon\Carbon::now()->format('Y-m-d')) }}"
             class="form-input" required>
      @error('tanggal_meninggal')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Penyebab --}}
    <div>
      <label for="penyebab" class="block text-gray-700 font-medium mb-2">Penyebab</label>
      <input id="penyebab" type="text" name="penyebab"
             value="{{ old('penyebab') }}"
             placeholder="Contoh: Sakit"
             class="form-input">
      @error('penyebab')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Keterangan --}}
    <div class="md:col-span-2">
      <label for="keterangan" class="block text-gray-700 font-medium mb-2">Keterangan</label>
      <textarea id="keterangan" name="keterangan" rows="4"
                class="form-input"
                placeholder="Tambahan keterangan...">{{ old('keterangan') }}</textarea>
      @error('keterangan')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Button --}}
    <div class="md:col-span-2 text-right">
      <button type="submit"
              class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow transition">
        💾 Simpan
      </button>
    </div>
  </form>
</div>

{{-- Select2 CSS & JS --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
  $(function() {
    $('#pendudukSelectCreate').select2({
      placeholder: 'Cari NIK atau Nama...',
      width: '100%'
    });
  });
</script>

<style>
  .form-input {
    width: 100%;
    padding: .5rem 1rem;
    border: 1px solid #D1D5DB;
    border-radius: .5rem;
    outline: none;
  }
  .form-input:focus {
    box-shadow: 0 0 0 2px rgba(59,130,246,.5);
  }
</style>
@endsection