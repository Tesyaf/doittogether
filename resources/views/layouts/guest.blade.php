<!DOCTYPE html>
<html lang="id" x-data="{ showPassword: false }">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'DoItTogether')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    @keyframes blob1 {
      0% { transform: translateY(0px) scale(1); }
      50% { transform: translateY(28px) scale(1.06); }
      100% { transform: translateY(0px) scale(1); }
    }
    @keyframes blob2 {
      0% { transform: translateX(0px) scale(1); }
      50% { transform: translateX(-20px) scale(1.04); }
      100% { transform: translateX(0px) scale(1); }
    }
    .animate-blob1 { animation: blob1 8s ease-in-out infinite; }
    .animate-blob2 { animation: blob2 10s ease-in-out infinite; }
  </style>
</head>

<body class="min-h-screen flex flex-col bg-[#0f172a] relative overflow-hidden">
  @include('partials.navbar-guest')

  {{-- Konten utama --}}
  <main class="flex-1 flex justify-center items-center relative">
    @yield('content')
  </main>

  {{-- Footer --}}
  @include('partials.footer')
</body>
</html>
