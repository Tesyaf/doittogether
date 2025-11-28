<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title>{{ $title ?? 'DoItTogether' }}</title>

  {{-- Favicon (opsional) --}}
  <link rel="icon" href="/favicon.ico" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  {{-- Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-b from-[#0f172a] via-[#1e293b] to-[#0f172a] text-white font-sans">

  {{-- Container Konten --}}
  <div class="min-h-screen flex flex-col">

    {{-- Slot konten utama --}}
    <main class="flex-1">
      @yield('content')
    </main>

  </div>
  <a href="{{ route('register') }}"
    class="fixed bottom-6 right-6 md:hidden bg-cyan-500 text-white font-semibold
          px-6 py-3 rounded-full shadow-lg shadow-cyan-500/30
          animate-bounce hover:bg-cyan-600 transition">
    Mulai
  </a>
</body>

</html>