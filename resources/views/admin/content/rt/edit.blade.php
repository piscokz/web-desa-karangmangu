@extends('admin.layouts.app')

{{-- Tambahkan CSS Select2 --}}
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')

<div class="max-w-xl mx-auto mt-12 bg-white shadow-lg rounded-lg overflow-hidden">
  <div class="bg-yellow-600 px-6 py-4">
    <h1 class="text-2xl font-bold text-white">Edit RT</h1>
  </div>

  <form action="{{ route('rt.update', $rt->id) }}" method="POST" class="p-6 space-y-6">
    @csrf
    @method('PUT')

    {{-- Input Nomor RT dengan prefix --}}
    <div>
      <label for="nomor_rt" class="block text-gray-700 font-medium mb-2">Nomor RT</label>
      <input
        type="text"
        name="nomor_rt"
        id="nomor_rt"
        required
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400"
        placeholder="Masukkan nomor RT"
        value="{{ old('nomor_rt', $rt->nomor_rt) }}"
      />
    </div>

    {{-- Pilih RW dengan Select2 --}}
    <div>
      <label for="id_rw" class="block text-gray-700 font-medium mb-2">Nomor RW</label>
      <select
        name="id_rw"
        id="id_rw"
        required
        class="select2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400 bg-white"
      >
        <option value="" disabled>-- Pilih RW --</option>
        @foreach ($rws as $rw)
          <option
            value="{{ $rw->id }}"
            {{ old('id_rw', $rt->id_rw) == $rw->id ? 'selected' : '' }}
          >
            {{ $rw->nomor_rw }}
          </option>
        @endforeach
      </select>
    </div>

    {{-- Buttons --}}
    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
      <a
        href="{{ route('rt.index') }}"
        class="px-5 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition"
      >
        Kembali
      </a>
      <button
        type="submit"
        class="px-6 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-500 transition"
      >
        Update
      </button>
    </div>
  </form>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Prefix RT
    const input = document.getElementById('nomor_rt');
    const prefix = 'RT ';
    if (!input.value.startsWith(prefix)) {
      input.value = prefix + input.value;
    }
    input.addEventListener('input', function () {
      if (!this.value.startsWith(prefix)) {
        const cursor = this.selectionStart;
        this.value = prefix + this.value.replace(prefix, '');
        this.setSelectionRange(
          cursor < prefix.length ? prefix.length : cursor,
          cursor < prefix.length ? prefix.length : cursor
        );
      }
    });
    input.addEventListener('keydown', function (e) {
      const cursor = this.selectionStart;
      if ((cursor <= prefix.length) && (e.key === "Backspace" || e.key === "ArrowLeft")) {
        e.preventDefault();
        this.setSelectionRange(prefix.length, prefix.length);
      }
    });
    input.addEventListener('focus', function () {
      if (this.selectionStart < prefix.length) {
        this.setSelectionRange(prefix.length, prefix.length);
      }
    });

    // Select2
    $('#id_rw').select2({
      placeholder: "-- Pilih RW --",
      allowClear: true,
      width: '100%'
    });
  });
</script>
@endsection