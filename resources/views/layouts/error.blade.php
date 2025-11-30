<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'Terjadi Kesalahan' }} | {{ config('app.name', 'DoItTogether') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-b from-[#0f172a] via-[#1e293b] to-[#0f172a] text-white font-sans flex items-center justify-center">
    @include('layouts.partials.loading-overlay', ['variant' => 'app'])

    <main class="w-full max-w-4xl px-6">
        @yield('content')
    </main>
</body>

</html>
