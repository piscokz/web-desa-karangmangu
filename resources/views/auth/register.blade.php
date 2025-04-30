{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Desa Winduherang</title>
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'desa-green': '#047857',
            'desa-light': '#10B981',
            'desa-bg': '#ECFDF5'
          }
        }
      }
    }
  </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-desa-green via-desa-light to-lime-300 flex items-center justify-center p-4">

  <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="bg-desa-green p-6 flex flex-col items-center">
      <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="h-16 w-16 mb-4">
      <h1 class="text-2xl font-extrabold text-white">Desa Winduherang</h1>
      <p class="text-desa-bg mt-1">Daftar Akun Baru</p>
    </div>

    <!-- Form Content -->
    <div class="p-8 space-y-6">
      @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded">
          <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
          <label for="name" class="block text-gray-700 font-medium">Nama Lengkap</label>
          <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name') }}"
            required
            autofocus
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-desa-light focus:border-desa-light"
          >
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-gray-700 font-medium">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email') }}"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-desa-light focus:border-desa-light"
          >
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-gray-700 font-medium">Password</label>
          <input
            id="password"
            name="password"
            type="password"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-desa-light focus:border-desa-light"
          >
        </div>

        <!-- Confirm Password -->
        <div>
          <label for="password_confirmation" class="block text-gray-700 font-medium">Konfirmasi Password</label>
          <input
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-desa-light focus:border-desa-light"
          >
        </div>

        <!-- Submit -->
        <div class="flex items-center justify-between">
          <a href="{{ route('login') }}" class="text-sm text-desa-green hover:underline">
            Sudah punya akun?
          </a>
          <button type="submit"
                  class="bg-desa-light hover:bg-desa-green text-white font-semibold px-6 py-2 rounded-lg transition">
            Daftar
          </button>
        </div>
      </form>
    </div>

    <!-- Footer Motto -->
    <div class="bg-desa-bg text-center py-3">
      <p class="text-xs text-desa-green">Rapih • Winangun • Kerta Raharja</p>
    </div>
  </div>

</body>
</html>
