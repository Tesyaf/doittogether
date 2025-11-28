<!DOCTYPE html>
<html lang="id">

<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#0f172a] text-white">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">

        {{-- SIDEBAR LEVEL-1 --}}
        @include('layouts.sidebar-global', [
        'teams' => $teams,
        ])

        {{-- SIDEBAR LEVEL-2 --}}
        @include('layouts.sidebar-team', [
        'currentTeam' => $currentTeam,
        'categories' => $categories,
        ])

        {{-- MAIN CONTENT --}}
        <main class="flex-1 p-6 min-h-screen md:ml-80">
            @yield('content')
        </main>

    </div>

</body>

</html>