{{-- resources/views/profile.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-10">

  {{-- Page Header with Logo --}}
  <div class="flex items-center space-x-4">
    <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="h-12 w-12 rounded-full shadow-md" />
    <h1 class="text-3xl font-extrabold text-green-800">Edit Profil Pengguna</h1>
  </div>

  {{-- Update Profile Information --}}
  <section class="bg-white rounded-2xl shadow-lg p-6 border-l-8 border-green-600">
    <header class="flex items-center mb-6">
      {{-- Detailed User icon --}}
      <div class="p-2 bg-green-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M10 2a4 4 0 100 8 4 4 0 000-8zM2 18a8 8 0 1116 0H2z" clip-rule="evenodd"/>
        </svg>
      </div>
      <h2 class="ml-4 text-2xl font-bold text-gray-900">Update Informasi Profil</h2>
    </header>
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
      @csrf @method('PUT')
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label for="name" class="block text-gray-700 mb-1 font-medium">Nama Lengkap</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
              {{-- Refined User Icon --}}
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10 10a4 4 0 100-8 4 4 0 000 8z" />
                <path fill-rule="evenodd" d="M2 18a8 8 0 0116 0H2z" clip-rule="evenodd" />
              </svg>
            </span>
            <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none" />
          </div>
          @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label for="email" class="block text-gray-700 mb-1 font-medium">Email</label>
          <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
              {{-- Detailed Email Icon --}}
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path d="M2.94 6.34L10 11.586l7.06-5.246A2 2 0 0015.9 4H4.1a2 2 0 00-1.16 2.34z" />
                <path d="M18 8.11l-8 5.94-8-5.94V14a2 2 0 002 2h12a2 2 0 002-2V8.11z" />
              </svg>
            </span>
            <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required
                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300 focus:outline-none" />
          </div>
          @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
      </div>
      <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-500 transition">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </section>

  {{-- Update Password --}}
  <section class="bg-white rounded-2xl shadow-lg p-6 border-l-8 border-blue-600">
    <header class="flex items-center mb-6">
      {{-- Detailed Lock icon --}}
      <div class="p-2 bg-blue-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M5 8V6a5 5 0 0110 0v2a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2zm2-2a3 3 0 016 0v2H7V6z" clip-rule="evenodd"/>
        </svg>
      </div>
      <h2 class="ml-4 text-2xl font-bold text-gray-900">Ubah Kata Sandi</h2>
    </header>
    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
      @csrf @method('PUT')
      <div class="space-y-4">
        <div>
          <label for="current_password" class="block text-gray-700 mb-1 font-medium">Kata Sandi Lama</label>
          <input id="current_password" name="current_password" type="password" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none" />
          @error('current_password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label for="password" class="block text-gray-700 mb-1 font-medium">Kata Sandi Baru</label>
          <input id="password" name="password" type="password" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none" />
          @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label for="password_confirmation" class="block text-gray-700 mb-1 font-medium">Konfirmasi Kata Sandi</label>
          <input id="password_confirmation" name="password_confirmation" type="password" required
                 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-300 focus:outline-none" />
        </div>
      </div>
      <div class="flex justify-end">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition">
          Ubah Password
        </button>
      </div>
    </form>
  </section>

  {{-- Delete User --}}
  <section class="bg-white rounded-2xl shadow-lg p-6 border-l-8 border-red-600">
    <header class="flex items-center mb-6">
      {{-- Detailed Trash icon --}}
      <div class="p-2 bg-red-100 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" viewBox="0 0 20 20" fill="currentColor">
          <path d="M6 8a1 1 0 011-1h6a1 1 0 011 1v8a2 2 0 01-2 2H7a2 2 0 01-2-2V8z" />
          <path fill-rule="evenodd" d="M5 4a1 1 0 011-1h8a1 1 0 011 1v1H5V4z" clip-rule="evenodd"/>
        </svg>
      </div>
      <h2 class="ml-4 text-2xl font-bold text-gray-900">Hapus Akun</h2>
    </header>
    <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-6">
      @csrf @method('DELETE')

      <p class="text-gray-700">Setelah akun dihapus, semua data Anda akan hilang. Apakah Anda yakin?</p>

      <div class="flex justify-end space-x-4">
        <button type="button" onclick="location.reload()"
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
          Batal
        </button>
        <button type="submit"
                class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500 transition">
          Hapus Akun
        </button>
      </div>
    </form>
  </section>

</div>
@endsection