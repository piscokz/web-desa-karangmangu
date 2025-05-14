@extends('admin.layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 space-y-8">

  {{-- Header dengan Logo --}}
  <div class="flex items-center space-x-4 bg-amber-50 rounded-xl p-4 shadow-md">
    <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="w-12 h-12 object-contain">
    <h1 class="text-3xl font-extrabold text-amber-700">Tambah Anggota Desa</h1>
  </div>

  {{-- Form Card --}}
  <div class="bg-white rounded-2xl shadow-lg p-8">
    @include('admin.content.village_member._form', [
      'route'  => route('anggota_desa.store'),
      'method' => 'POST',
      'submit' => 'Simpan'
    ])
  </div>

</div>
@endsection
