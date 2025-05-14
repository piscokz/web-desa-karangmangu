<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @if($method === 'PUT')
        @method('PUT')
        <input type="hidden" name="old_foto" value="{{ $member->foto }}">
    @endif

    {{-- Preview Foto Lama --}}
    @if($method === 'PUT' && !empty($member->foto))
        <div class="flex justify-center">
        <img src="{{ $member->foto ? asset('images/' . $member->foto) : asset('images/default-avatar.png') }}" alt="Foto {{ $member->nama }}" class="w-24 h-24 rounded-full object-cover shadow-md">

        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Nama --}}
        <div class="flex flex-col bg-gradient-to-r from-yellow-50 to-yellow-100 p-4 rounded-lg shadow-inner">
            <label class="text-amber-800 font-semibold mb-1">Nama</label>
            <input type="text"
                   name="nama"
                   value="{{ old('nama', $member->nama ?? '') }}"
                   placeholder="Masukkan nama lengkap"
                   class="w-full bg-white border-l-4 border-amber-400 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 transition" />
            @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Jabatan --}}
        <div class="flex flex-col bg-gradient-to-r from-blue-50 to-blue-100 p-4 rounded-lg shadow-inner">
            <label class="text-blue-800 font-semibold mb-1">Jabatan</label>
            <input type="text"
                   name="jabatan"
                   value="{{ old('jabatan', $member->jabatan ?? '') }}"
                   placeholder="Masukkan jabatan"
                   class="w-full bg-white border-l-4 border-blue-400 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition" />
            @error('jabatan') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Organisasi --}}
        <div class="flex flex-col bg-gradient-to-r from-green-50 to-green-100 p-4 rounded-lg shadow-inner">
            <label class="text-green-800 font-semibold mb-1">Organisasi</label>
            <select name="organisasi"
                    class="w-full bg-white border-l-4 border-green-400 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition">
                <option value="">-- Pilih Organisasi --</option>
                @foreach(['Pemerintahan Desa','BPD','LPM','PKK','Lainnya'] as $org)
                    <option value="{{ $org }}" {{ old('organisasi', $member->organisasi ?? '') === $org ? 'selected' : '' }}>{{ $org }}</option>
                @endforeach
            </select>
            @error('organisasi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Jenis Kelamin --}}
        <div class="flex flex-col bg-gradient-to-r from-pink-50 to-pink-100 p-4 rounded-lg shadow-inner">
            <label class="text-pink-800 font-semibold mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin"
                    class="w-full bg-white border-l-4 border-pink-400 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 transition">
                <option value="">-- Pilih Jenis Kelamin --</option>
                @foreach(['Laki-laki','Perempuan'] as $jk)
                    <option value="{{ $jk }}" {{ old('jenis_kelamin', $member->jenis_kelamin ?? '') === $jk ? 'selected' : '' }}>{{ $jk }}</option>
                @endforeach
            </select>
            @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Tanggal Lahir --}}
        <div class="flex flex-col bg-gradient-to-r from-purple-50 to-purple-100 p-4 rounded-lg shadow-inner">
            <label class="text-purple-800 font-semibold mb-1">Tanggal Lahir</label>
            <input type="date"
                   name="tanggal_lahir"
                   value="{{ old('tanggal_lahir', isset($member->tanggal_lahir) ? \Carbon\Carbon::parse($member->tanggal_lahir)->format('Y-m-d') : '') }}"
                   class="w-full bg-white border-l-4 border-purple-400 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 transition" />
            @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Alamat --}}
        <div class="md:col-span-2 flex flex-col bg-gradient-to-r from-gray-100 to-gray-200 p-4 rounded-lg shadow-inner">
            <label class="text-gray-800 font-semibold mb-1">Alamat</label>
            <textarea name="alamat"
                      rows="3"
                      placeholder="Masukkan alamat lengkap"
                      class="w-full bg-white border-l-4 border-gray-400 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-500 transition">{{ old('alamat', $member->alamat ?? '') }}</textarea>
            @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        {{-- Foto Baru --}}
        <div class="md:col-span-2 flex flex-col bg-gradient-to-r from-yellow-50 to-yellow-100 p-4 rounded-lg shadow-inner">
            <label class="text-amber-800 font-semibold mb-1">Foto Baru (opsional)</label>
            <input type="file"
                   name="foto"
                   accept="image/*"
                   class="w-full bg-white border-l-4 border-amber-400 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 transition" />
            @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>
    </div>

    {{-- Submit Button --}}
    <div class="flex justify-end">
        <button type="submit"
                class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
            {{ $submit }}
        </button>
    </div>
</form>