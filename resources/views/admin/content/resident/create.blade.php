@extends('admin.layouts.app')

@section('title', 'Tambah Penduduk')

@section('content')
<div class="container mx-auto px-4 py-8" 
     x-data="{
       jenis: '{{ old('jenis_kelamin') }}',
       agama: '{{ old('agama') }}',
       status: '{{ old('status_perkawinan') }}',
       gol: '{{ old('gol_darah') }}',
       shdk: '{{ old('shdk') }}'
     }">
  <h1 class="text-2xl font-bold text-green-800 mb-6">Tambah Penduduk</h1>

  @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg">
      {{ session('success') }}
    </div>
  @endif
  @if($errors->any())
    <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded-lg">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="bg-white shadow rounded-2xl p-6">
    <form action="{{ route('penduduk.store') }}" method="POST" class="space-y-6">
      @csrf
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- NIK --}}
        <div>
          <label for="nik" class="block text-gray-700 font-medium mb-1">NIK</label>
          <input type="text" name="nik" id="nik" value="{{ old('nik') }}" maxlength="16" minlength="16" required
                 placeholder="Masukkan NIK" 
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Nama Lengkap --}}
        <div>
          <label for="nama_lengkap" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                 placeholder="Masukkan Nama Lengkap"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Tempat Lahir --}}
        <div>
          <label for="tempat_lahir" class="block text-gray-700 font-medium mb-1">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                 placeholder="Masukkan Tempat Lahir"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Tanggal Lahir --}}
        <div>
          <label for="tanggal_lahir" class="block text-gray-700 font-medium mb-1">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Jenis Kelamin --}}
        <div>
          <label for="jenis_kelamin" class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" id="jenis_kelamin" x-model="jenis" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="jenis === 'Lainnya'">
            <input type="text" name="jenis_kelamin_other" placeholder="Masukkan manual..." value="{{ old('jenis_kelamin_other') }}"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Agama --}}
        <div>
          <label for="agama" class="block text-gray-700 font-medium mb-1">Agama</label>
          <select name="agama" id="agama" x-model="agama" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Agama</option>
            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)
              <option value="{{ $a }}">{{ $a }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="agama === 'Lainnya'">
            <input type="text" name="agama_other" placeholder="Masukkan manual..." value="{{ old('agama_other') }}"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Status Perkawinan --}}
        <div>
          <label for="status_perkawinan" class="block text-gray-700 font-medium mb-1">Status Perkawinan</label>
          <select name="status_perkawinan" id="status_perkawinan" x-model="status" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Status</option>
            @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $s)
              <option value="{{ $s }}">{{ $s }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="status === 'Lainnya'">
            <input type="text" name="status_perkawinan_other" placeholder="Masukkan manual..." value="{{ old('status_perkawinan_other') }}"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Pekerjaan --}}
        <div>
          <label for="pekerjaan" class="block text-gray-700 font-medium mb-1">Pekerjaan</label>
          <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}"
                 placeholder="Masukkan Pekerjaan"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Pendidikan --}}
        <div>
          <label for="pendidikan" class="block text-gray-700 font-medium mb-1">Pendidikan</label>
          <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}"
                 placeholder="Masukkan Pendidikan"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Golongan Darah --}}
        <div>
          <label for="gol_darah" class="block text-gray-700 font-medium mb-1">Golongan Darah</label>
          <select name="gol_darah" id="gol_darah" x-model="gol"
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Golongan Darah</option>
            @foreach(['A','B','AB','O'] as $g)
              <option value="{{ $g }}">{{ $g }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="gol === 'Lainnya'">
            <input type="text" name="gol_darah_other" placeholder="Masukkan manual..." value="{{ old('gol_darah_other') }}"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- SHDK --}}
        <div>
          <label for="shdk" class="block text-gray-700 font-medium mb-1">Status Hubungan dalam Keluarga</label>
          <select name="shdk" id="shdk" x-model="shdk"
                  class ="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih SHDK</option>
            @foreach(['Kepala Keluarga','Istri','Anak','Orang Tua'] as $sh)
              <option value="{{ $sh }}">{{ $sh }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="shdk === 'Lainnya'">
            <input type="text" name="shdk_other" placeholder="Masukkan manual..." value="{{ old('shdk_other') }}"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Kartu Keluarga --}}
        <div>
          <label for="id_kk" class="block text-gray-700 font-medium mb-1">No Kartu Keluarga</label>
          <select name="id_kk" id="id_kk" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Kartu Keluarga</option>
            @foreach($kks as $kk)
              <option value="{{ $kk->id }}" {{ old('id_kk') == $kk->id ? 'selected' : '' }}>{{ $kk->no_kk }}</option>
            @endforeach
          </select>
        </div>

        {{-- No Telepon --}}
        <div>
          <label for="no_telp" class="block text-gray-700 font-medium mb-1">No Telepon</label>
          <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}"
                 placeholder="Masukkan No Telepon"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>
      </div>

      <div class="pt-4 border-t border-gray-200 text-right">
        <a href="{{ route('penduduk.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-xl hover:bg-green-500 transition">Simpan</button>
      </div>
    </form>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection