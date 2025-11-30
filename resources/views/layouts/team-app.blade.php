<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'DoItTogether') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-[#0f172a] text-white">
    @include('layouts.partials.loading-overlay', ['variant' => 'app'])

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
            @include('layouts.partials.flash')
            @yield('content')
        </main>

    </div>

</body>

</html>
