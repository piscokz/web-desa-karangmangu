{{-- resources/views/admin/content/lapak_desa/create.blade.php --}}
@extends('admin.layouts.app')

@section('content')
@php
  $kategoriOptions = [
    'Aksesoris Handphone','Aksesoris Komputer','Alat Rumah Tangga','Elektronik',
    'Fashion Anak','Fashion Muslim','Fashion Pria','Fashion Wanita',
    'Handphone','Kecantikan','Kesehatan','Komputer','Lainnya',
    'Laptop','Makanan','Minuman','Olahraga','Pertanian','Sembako'
  ];
@endphp

<section class="animate__animated animate__fadeInUp bg-gray-50 p-6 rounded-2xl shadow-md max-w-3xl mx-auto">
  <h1 class="text-2xl font-bold text-green-800 mb-4">Tambah Produk Baru</h1>

  @if ($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form id="createForm" action="{{ route('lapak_desa.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-6" onsubmit="stripPhoneMask()">
    @csrf

    {{-- Nama Produk --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Nama Produk</label>
      <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
             class="form-input" />
    </div>

    {{-- Harga Produk --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Harga Produk</label>
      <input type="text" name="harga_produk" id="hargaInput"
             value="{{ old('harga_produk') }}"
             placeholder="0"
             class="form-input"
             oninput="formatPrice(this)" />
    </div>

{{-- di <head> --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

{{-- sebelum </body> --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@stack('scripts')
{{-- Pemilik --}}
<div>
  <label class="block text-gray-700 font-medium mb-1">Pemilik (Penduduk)</label>
  <select name="id_penduduk" id="penduduk-select" class="form-input w-full">
    <option value="">-- Pilih Penduduk --</option>
    @foreach($penduduks as $p)
      <option value="{{ $p->id }}" {{ old('id_penduduk') == $p->id ? 'selected' : '' }}>
        {{ $p->nik }} — {{ $p->nama_lengkap }}
      </option>
    @endforeach
  </select>
</div>
{{-- @push('scripts') --}}
<script>
  $(document).ready(function() {
    $('#penduduk-select').select2({
      placeholder: "-- Pilih Penduduk --",
      allowClear: true,
      width: '100%'
    });
  });
</script>
{{-- @endpush --}}


    {{-- No Telepon --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">No Telepon</label>
      <input type="text" id="phoneInput" name="no_telepon" value="{{ old('no_telepon') }}"
             maxlength="14" placeholder="08**-****-****"
             class="form-input" oninput="formatPhone(this)" />
    </div>

    {{-- Kategori --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Kategori</label>
      <select name="kategori" class="form-input">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoriOptions as $cat)
          <option value="{{ $cat }}" {{ old('kategori')==$cat?'selected':'' }}>
            {{ $cat }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Deskripsi --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
      <textarea name="deskripsi" id="deskripsi-create"
                class="form-input">{{ old('deskripsi') }}</textarea>
    </div>

    {{-- Gambar Produk --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Gambar Produk</label>
      <input type="file" name="gambar_produk" class="w-full text-gray-700" />
    </div>

    {{-- Submit --}}
    <div class="text-right">
      <button type="submit"
              class="inline-flex items-center px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
        Simpan Produk
      </button>
    </div>
  </form>
</section>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('deskripsi-create',{height:200});

  // format nomor telepon dengan dash
  function formatPhone(input) {
    let digits = input.value.replace(/\D/g,'').slice(0,12);
    let parts = [];
    for(let i=0; i<digits.length; i+=4) parts.push(digits.substr(i,4));
    input.value = parts.join('-');
  }
  function stripPhoneMask() {
    let i = document.getElementById('phoneInput');
    i.value = i.value.replace(/\D/g,'');
  }

  // format harga dengan titik ribuan
  function formatPrice(input) {
    // simpan posisi kursor
    const start = input.selectionStart;
    const end = input.selectionEnd;

    // hapus semua non-digit
    let val = input.value.replace(/\D/g,'');
    // tambahkan titik per 3 digit dari kanan
    val = val.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    input.value = val;

    // restore posisi kursor
    const newPos = start + (input.value.length - val.length);
    input.setSelectionRange(newPos, newPos);
  }

  // pindah focus on Enter
  document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('createForm');
    const fields = Array.from(form.querySelectorAll('input, select, textarea'))
      .filter(el=>!['submit','file'].includes(el.type));
    fields.forEach((el, idx) => {
      el.addEventListener('keydown', e => {
        if (e.key === 'Enter') {
          e.preventDefault();
          const next = fields[idx+1];
          if (next) next.focus();
          else form.submit();
        }
      });
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
    box-shadow: 0 0 0 2px rgba(34,197,94,.5);
  }
</style>
@endsection