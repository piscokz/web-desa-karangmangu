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

  <form action="{{ route('lapak_desa.store') }}" method="POST" enctype="multipart/form-data"
        class="space-y-6" onsubmit="stripPhoneMask()">
    @csrf

    {{-- Nama Produk --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Nama Produk</label>
      <input type="text" name="nama_produk" value="{{ old('nama_produk') }}"
             class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" />
    </div>

    {{-- Harga Produk --}}
    <div>
        <label class="block text-gray-700 font-medium mb-1">Harga Produk</label>
        <input type="number" name="harga_produk" value="{{ old('harga_produk') }}"
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400" />
      </div>

    {{-- Pemilik --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Pemilik (Penduduk)</label>
      <select name="id_penduduk"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
        <option value="">-- Pilih Penduduk --</option>
        @foreach($penduduks as $p)
          <option value="{{ $p->id }}" {{ old('id_penduduk')==$p->id?'selected':'' }}>
            {{ $p->nik }} — {{ $p->nama_lengkap }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- No Telepon --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">No Telepon</label>
      <input type="text" id="phoneInput" name="no_telepon" value="{{ old('no_telepon') }}"
             maxlength="14" placeholder="08**-****-****"
             class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400"
             oninput="formatPhone(this)" />
    </div>

    {{-- Kategori --}}
    <div>
      <label class="block text-gray-700 font-medium mb-1">Kategori</label>
      <select name="kategori"
              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400">
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
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400"
      >{{ old('deskripsi') }}</textarea>
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

  function formatPhone(input) {
    let digits = input.value.replace(/\D/g,'').slice(0,12);
    let parts = [];
    for(let i=0;i<digits.length;i+=4) parts.push(digits.substr(i,4));
    input.value = parts.join('-');
  }
  function stripPhoneMask() {
    let i = document.getElementById('phoneInput');
    i.value = i.value.replace(/\D/g,'');
  }
</script>
@endsection