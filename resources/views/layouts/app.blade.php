<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DoItTogether') }}</title>

    {{-- Inter font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- Favicon (opsional) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Tailwind & App Scripts (Vite) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50 dark:bg-[#0f172a] min-h-screen flex flex-col">

    {{-- Global Navbar (opsional, bisa dihilangkan di halaman auth) --}}
    @include('partials.navbar')

    {{-- Flash messages --}}
    @if (session('status'))
    <div class="fixed top-4 left-1/2 -translate-x-1/2 bg-white/20 backdrop-blur-md text-white px-6 py-3 rounded-xl shadow-md z-50">
        {{ session('status') }}
    </div>
    @endif

    {{-- Main content --}}
    <main class="flex-1 flex items-center justify-center py-8 sm:py-12">
        @yield('content')
    </main>

    {{-- Optional Footer --}}
    <footer class="text-center text-xs text-gray-500 py-4">
        <p>© {{ date('Y') }} DoItTogether. Dibuat dengan ❤️ oleh Lif.</p>
    </footer>

    {{-- Alpine Transitions (Opsional) --}}
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</body>

</html>
