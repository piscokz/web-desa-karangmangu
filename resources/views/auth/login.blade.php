{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Desa Winduherang</title>
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
    };
  </script>
</head>

<body class="min-h-screen bg-gradient-to-br from-desa-green via-desa-light to-lime-300 flex items-center justify-center p-4">

  <div class="max-w-md w-full bg-white rounded-2xl shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="bg-desa-green p-6 flex flex-col items-center">
      <img src="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" alt="Logo Kuningan" class="h-16 w-16 mb-4">
      <h1 class="text-2xl font-extrabold text-white">Desa Winduherang</h1>
      <p class="text-desa-bg mt-1">Masuk ke Dashboard Desa</p>
    </div>

    <!-- Login Form -->
    <div class="p-8 space-y-6">
      @if (session('status'))
        <div class="bg-green-100 text-green-800 p-3 rounded">
          {{ session('status') }}
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-gray-700 font-medium">Email</label>
          <input
            id="email"
            name="email"
            type="email"
            value="{{ old('email') }}"
            required autofocus
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-desa-light focus:border-desa-light"
          >
          @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
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
          @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
          <input
            id="remember"
            name="remember"
            type="checkbox"
            class="h-4 w-4 text-desa-light focus:ring-desa-light border-gray-300 rounded"
          >
          <label for="remember" class="ml-2 block text-sm text-gray-600">
            Remember me
          </label>
        </div>

        <!-- Forgot Password & Submit -->
        <div class="flex items-center justify-between">
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}"
               class="text-sm text-desa-light hover:underline">
              Forgot your password?
            </a>
          @endif

          <button type="submit"
                  class="bg-desa-light hover:bg-desa-green text-white font-semibold px-6 py-2 rounded-lg transition">
            Log in
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