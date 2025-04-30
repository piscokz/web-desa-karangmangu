<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Kelurahan Winduherang')</title>
    {{-- Favicon (logo kecil di tab) --}}
    <link rel="icon" href="{{ asset('images/Logo_Kabupaten_kuningan.png') }}" type="image/png">
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <!-- CDN Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <style>
        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .gradient-animate {
            background: linear-gradient(135deg, #065f46, #34d399, #10b981);
            background-size: 400% 400%;
            animation: gradientFlow 15s ease infinite;
        }
        html, body { margin: 0; padding: 0; overflow-x: hidden; }
        body::-webkit-scrollbar { display: none; }
        body { -ms-overflow-style: none; scrollbar-width: none;
            background: linear-gradient(to right, #f0f9ff, #cbebff);
        }
        .hero-height { height: 500px; }
        .slider-fade { transition: opacity 0.5s ease-in-out; }
        .sticky-nav { position: fixed; top: 0; left: 0; width: 100%; z-index: 50; transition: opacity 0.3s ease-in-out; }
    </style>
</head>
<body class="font-sans text-gray-700">

    @include('layouts.nav')

    {{-- Content Section --}}
    @yield('content')

    {{-- Footer Partial --}}
    @include('partials.footer')

</body>
</html>