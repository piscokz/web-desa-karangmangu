<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="space-y-4">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
    @endif

    <div>
        <label class="block">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $member->nama ?? '') }}" class="w-full border px-3 py-2 rounded">
        @error('nama') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block">Jabatan</label>
        <input type="text" name="jabatan" value="{{ old('jabatan', $member->jabatan ?? '') }}" class="w-full border px-3 py-2 rounded">
        @error('jabatan') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
            <option value="">-- Pilih --</option>
            <option value="Laki-laki" {{ old('jenis_kelamin', $member->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin', $member->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>
        @error('jenis_kelamin') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', isset($member->tanggal_lahir) ? $member->tanggal_lahir->format('Y-m-d') : '') }}" class="w-full border px-3 py-2 rounded">
        @error('tanggal_lahir') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block">Alamat</label>
        <textarea name="alamat" class="w-full border px-3 py-2 rounded">{{ old('alamat', $member->alamat ?? '') }}</textarea>
        @error('alamat') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block">Foto</label>
        <input type="file" name="foto" class="w-full">
        @if(!empty($member->foto))
            <img src="{{ asset('storage/' . $member->foto) }}" alt="Foto" class="h-20 mt-2">
        @endif
        @error('foto') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
        {{ $submit }}
    </button>
</form>
