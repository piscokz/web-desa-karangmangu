{{-- resources/views/admin/content/penduduk/edit.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Penduduk')

@section('content')
<div class="container mx-auto px-4 py-8" 
     x-data="{
       jenis: '{{ in_array(old('jenis_kelamin', $penduduk->jenis_kelamin), ['Laki-laki','Perempuan']) 
                ? old('jenis_kelamin', $penduduk->jenis_kelamin) : 'Lainnya' }}',
       jenisOther: '{{ old('jenis_kelamin_other', in_array(old('jenis_kelamin', $penduduk->jenis_kelamin), ['Laki-laki','Perempuan']) 
                     ? '' : old('jenis_kelamin', $penduduk->jenis_kelamin)) }}',

       agama: '{{ in_array(old('agama', $penduduk->agama), ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu']) 
                ? old('agama', $penduduk->agama) : 'Lainnya' }}',
       agamaOther: '{{ old('agama_other', in_array(old('agama', $penduduk->agama), ['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu']) 
                     ? '' : old('agama', $penduduk->agama)) }}',

       status: '{{ in_array(old('status_perkawinan', $penduduk->status_perkawinan), ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati']) 
                 ? old('status_perkawinan', $penduduk->status_perkawinan) : 'Lainnya' }}',
       statusOther: '{{ old('status_perkawinan_other', in_array(old('status_perkawinan', $penduduk->status_perkawinan), ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati']) 
                       ? '' : old('status_perkawinan', $penduduk->status_perkawinan)) }}',

       gol: '{{ in_array(old('gol_darah', $penduduk->gol_darah), ['A','B','AB','O']) 
              ? old('gol_darah', $penduduk->gol_darah) : 'Lainnya' }}',
       golOther: '{{ old('gol_darah_other', in_array(old('gol_darah', $penduduk->gol_darah), ['A','B','AB','O']) 
                     ? '' : old('gol_darah', $penduduk->gol_darah)) }}',

       shdk: '{{ in_array(old('shdk', $penduduk->shdk), ['Kepala Keluarga','Istri','Anak','Orang Tua']) 
                ? old('shdk', $penduduk->shdk) : 'Lainnya' }}',
       shdkOther: '{{ old('shdk_other', in_array(old('shdk', $penduduk->shdk), ['Kepala Keluarga','Istri','Anak','Orang Tua']) 
                     ? '' : old('shdk', $penduduk->shdk)) }}'
     }"
>
  <h1 class="text-2xl font-bold text-green-800 mb-6">Edit Penduduk</h1>

  @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg">
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded-lg">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="bg-white shadow rounded-2xl p-6">
    <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST" class="space-y-6">
      @csrf @method('PUT')

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        {{-- NIK --}}
        <div>
          <label for="nik" class="block text-gray-700 font-medium mb-1">NIK</label>
          <input type="text" name="nik" id="nik"
                 value="{{ old('nik', $penduduk->nik) }}"
                 maxlength="16" minlength="16" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Nama Lengkap --}}
        <div>
          <label for="nama_lengkap" class="block text-gray-700 font-medium mb-1">Nama Lengkap</label>
          <input type="text" name="nama_lengkap" id="nama_lengkap"
                 value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Tempat Lahir --}}
        <div>
          <label for="tempat_lahir" class="block text-gray-700 font-medium mb-1">Tempat Lahir</label>
          <input type="text" name="tempat_lahir" id="tempat_lahir"
                 value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Tanggal Lahir --}}
        <div>
          <label for="tanggal_lahir" class="block text-gray-700 font-medium mb-1">Tanggal Lahir</label>
          <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                 value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir->format('Y-m-d')) }}" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Jenis Kelamin --}}
        <div>
          <label class="block text-gray-700 font-medium mb-1">Jenis Kelamin</label>
          <select name="jenis_kelamin" x-model="jenis" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Jenis Kelamin</option>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="jenis==='Lainnya'">
            <input type="text" name="jenis_kelamin_other" placeholder="Masukkan manual..."
                   x-model="jenisOther"
                   :value="jenisOther"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Agama --}}
        <div>
          <label class="block text-gray-700 font-medium mb-1">Agama</label>
          <select name="agama" x-model="agama" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Agama</option>
            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $a)
              <option value="{{ $a }}">{{ $a }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="agama==='Lainnya'">
            <input type="text" name="agama_other" placeholder="Masukkan manual..."
                   x-model="agamaOther"
                   :value="agamaOther"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Status Perkawinan --}}
        <div>
          <label class="block text-gray-700 font-medium mb-1">Status Perkawinan</label>
          <select name="status_perkawinan" x-model="status" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Status</option>
            @foreach(['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'] as $s)
              <option value="{{ $s }}">{{ $s }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="status==='Lainnya'">
            <input type="text" name="status_perkawinan_other" placeholder="Masukkan manual..."
                   x-model="statusOther"
                   :value="statusOther"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Pekerjaan --}}
        <div>
          <label for="pekerjaan" class="block text-gray-700 font-medium mb-1">Pekerjaan</label>
          <input type="text" name="pekerjaan" id="pekerjaan"
                 value="{{ old('pekerjaan', $penduduk->pekerjaan) }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Pendidikan --}}
        <div>
          <label for="pendidikan" class="block text-gray-700 font-medium mb-1">Pendidikan</label>
          <input type="text" name="pendidikan" id="pendidikan"
                 value="{{ old('pendidikan', $penduduk->pendidikan) }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Golongan Darah --}}
        <div>
          <label class="block text-gray-700 font-medium mb-1">Golongan Darah</label>
          <select name="gol_darah" x-model="gol" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Golongan</option>
            @foreach(['A','B','AB','O'] as $g)
              <option value="{{ $g }}">{{ $g }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="gol==='Lainnya'">
            <input type="text" name="gol_darah_other" placeholder="Masukkan manual..."
                   x-model="golOther"
                   :value="golOther"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- SHDK --}}
        <div>
          <label class="block text-gray-700 font-medium mb-1">SHDK</label>
          <select name="shdk" x-model="shdk" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih SHDK</option>
            @foreach(['Kepala Keluarga','Istri','Anak','Orang Tua'] as $sh)
              <option value="{{ $sh }}">{{ $sh }}</option>
            @endforeach
            <option value="Lainnya">Lainnya</option>
          </select>
          <template x-if="shdk==='Lainnya'">
            <input type="text" name="shdk_other" placeholder="Masukkan manual..."
                   x-model="shdkOther"
                   :value="shdkOther"
                   class="mt-2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
          </template>
        </div>

        {{-- Kartu Keluarga --}}
        <div>
          <label for="id_kk" class="block text-gray-700 font-medium mb-1">No Kartu Keluarga</label>
          <select name="id_kk" required
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>Pilih Kartu Keluarga</option>
            @foreach($kks as $kk)
              <option value="{{ $kk->id }}"
                {{ old('id_kk', $penduduk->id_kk)==$kk->id?'selected':'' }}>
                {{ $kk->no_kk }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- No. Telepon --}}
        <div>
          <label for="no_telp" class="block text-gray-700 font-medium mb-1">No Telepon</label>
          <input type="text" name="no_telp" id="no_telp"
                 value="{{ old('no_telp', $penduduk->no_telp) }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Nama Ayah --}}
        <div>
          <label for="nama_ayah" class="block text-gray-700 font-medium mb-1">Nama Ayah</label>
          <input type="text" name="nama_ayah" id="nama_ayah"
                 value="{{ old('nama_ayah', $penduduk->nama_ayah) }}"
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Nama Ibu --}}
        <div>
          <label for="nama_ibu" class="block text-gray-700 font-medium mb-1">Nama Ibu</label>
          <input type="text" name="nama_ibu" id="nama_ibu"
                 value="{{ old('nama_ibu', $penduduk->nama_ibu) }}"
                 class="w-full px-4 py-2	border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200" />
        </div>

        {{-- Disabilitas --}}
        <div>
          <label for="disabilitas" class="block text-gray-700 font-medium mb-1">Disabilitas</label>
          <select name="disabilitas"
                  class="w-full px-4 py-2	border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>-- Pilih Disabilitas --</option>
            @foreach([
              'Tidak Cacat','Tuna Daksa/Cacat Tubuh','Tuna Netra/Buta','Tuna Rungu',
              'Tuna Wicara','Tuna Rungu & Wicara','Tuna Netra & Cacat Tubuh',
              'Tuna Netra, Rungu & Wicara','Tuna Rungu, Wicara & Cacat Tubuh',
              'Tuna Rungu, Wicara, Netra & Cacat Tubuh','Cacat Mental/Retardasi',
              'Mantan Penderita Gangguan Jiwa','Cacat Fisik & Mental','Tuna Grahita'
            ] as $d)
              <option value="{{ $d }}"
                {{ old('disabilitas', $penduduk->disabilitas)==$d?'selected':'' }}>
                {{ $d }}
              </option>
            @endforeach
          </select>
        </div>

        {{-- Organisasi --}}
        {{-- <div>
          <label for="organisasi" class="block text-gray-700 font-medium mb-1">Organisasi</label>
          <select name="organisasi"
                  class="w-full px-4 py-2	border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-200">
            <option value="" disabled>-- Pilih Organisasi --</option>
            @foreach([ '-', 'Pemerintah desa', 'Karang Taruna','PKK','Posyandu','Linmas','BPD','LPM','RT','RW'] as $o)
              <option value="{{ $o }}"
                {{ old('organisasi', $penduduk->organisasi)==$o?'selected':'' }}>
                {{ $o }}
              </option>
            @endforeach
          </select>
        </div> --}}
      </div>

      <div class="pt-4 border-t border-gray-200 text-right">
        <a href="{{ route('penduduk.index') }}" class="mr-4 text-gray-600 hover:underline">Batal</a>
        <button type="submit"
                class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-500 transition">
          Perbarui
        </button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
