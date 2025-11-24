<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ config('app.name', 'DoItTogether') }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#0f172a] text-white flex items-center justify-center min-h-screen font-inter antialiased">
  <div class="max-w-5xl w-full mx-auto flex flex-col md:flex-row bg-white/5 border border-white/10 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl">

    {{-- Left Section (Logo + Image) --}}
    {{-- Left Section (Logo + Tagline) --}}
<div class="hidden md:flex flex-col justify-center items-center w-1/2 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950 relative overflow-hidden p-10">

  {{-- efek gradient lembut belakang logo --}}
  <div class="absolute inset-0 bg-gradient-to-tr from-cyan-500/20 to-blue-600/20 blur-[120px] opacity-70"></div>

  {{-- Logo utama --}}
  <div class="relative z-10 flex flex-col items-center text-center space-y-4">
    <img src="{{ asset('images/logo.svg') }}" alt="DoItTogether Logo" class="w-40 h-40 drop-shadow-[0_0_20px_rgba(56,189,248,0.4)]">

    {{-- Teks brand --}}
    <h1 class="text-3xl font-semibold tracking-tight">
      <span class="text-white">DoIt</span><span class="text-cyan-400">Together</span>
    </h1>

    {{-- Garis kecil pemisah --}}
    <div class="w-12 h-[2px] bg-gradient-to-r from-cyan-400 to-blue-500 rounded-full opacity-70"></div>

    {{-- Tagline --}}
    <p class="text-white/70 text-sm max-w-xs leading-relaxed">
      Kelola tugasmu bersama tim dengan mudah, efisien, dan terorganisir.
    </p>
  </div>
</div>


    <div class="w-full md:w-1/2 p-8 md:p-10">
      @yield('content')
    </div>

  </div>
</body>
</html>
