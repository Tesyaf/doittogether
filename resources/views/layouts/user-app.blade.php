<!DOCTYPE html>
<html lang="id">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#0f172a] text-white">

    {{-- Navbar global --}}
    @include('layouts.sidebar-global', [
    'teams' => $teams,
    ])

    <main class="p-6 min-h-screen md:ml-20">
        {{-- Konten halaman --}}
        @yield('content')
    </main>

</body>

</html>