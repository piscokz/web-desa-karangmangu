@extends('admin.layouts.app')

{{-- Tambahkan CSS Select2 --}}
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="max-w-xl mx-auto mt-12 bg-white shadow-lg rounded-lg overflow-hidden">
  <div class="bg-green-600 px-6 py-4">
    <h1 class="text-2xl font-bold text-white">Tambah RT</h1>
  </div>
  <form action="{{ route('rt.store') }}" method="POST" class="p-6 space-y-6">
    @csrf

    <input
  type="text"
  name="nomor_rt"
  id="nomor_rt"
  required
  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400"
  placeholder="Masukkan nomor RT"
  value="RT "
/>

{{-- @push('scripts') --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('nomor_rt');
    const prefix = 'RT ';

    // Pastikan awalnya adalah RT 
    if (!input.value.startsWith(prefix)) {
      input.value = prefix;
    }

    // Jaga supaya prefix RT tidak bisa dihapus
    input.addEventListener('input', function () {
      if (!this.value.startsWith(prefix)) {
        const cursorPos = this.selectionStart;
        this.value = prefix + this.value.replace(prefix, '');
        this.setSelectionRange(cursorPos < prefix.length ? prefix.length : cursorPos, cursorPos < prefix.length ? prefix.length : cursorPos);
      }
    });

    // Cegah user menghapus prefix dengan backspace
    input.addEventListener('keydown', function (e) {
      const cursorPos = this.selectionStart;
      if ((cursorPos <= prefix.length) && (e.key === "Backspace" || e.key === "ArrowLeft")) {
        e.preventDefault();
        this.setSelectionRange(prefix.length, prefix.length);
      }
    });

    // Otomatis fokus setelah prefix
    input.addEventListener('focus', function () {
      if (this.selectionStart < prefix.length) {
        this.setSelectionRange(prefix.length, prefix.length);
      }
    });
  });
</script>
{{-- @endpush --}}


    {{-- Pilih RW dengan Select2 --}}
    <div>
      <label for="id_rw" class="block text-gray-700 font-medium mb-2">Nomor RW</label>
      <select
        name="id_rw"
        id="id_rw"
        required
        class="select2 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400 bg-white"
      >
        <option value="" disabled selected>-- Pilih RW --</option>
        @foreach ($rws as $rw)
          <option value="{{ $rw->id }}">{{ $rw->nomor_rw }}</option>
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
        class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-500 transition"
      >
        Simpan
      </button>
    </div>
  </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('#id_rw').select2({
      placeholder: "-- Pilih RW --",
      allowClear: true,
      width: '100%'
    });
  });
</script>
@endsection

{{-- Tambahkan JS Select2 dan inisialisasi --}}
{{-- @push('scripts') --}}
{{-- @endpush --}}