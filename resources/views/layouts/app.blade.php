<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title ?? 'DoItTogether' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#020617] text-white">

<div x-data="{ sidebarOpen: false }" class="flex min-h-screen">

    {{-- SIDEBAR LEVEL 1 --}}
    @include('layouts.sidebar-level1', ['teams' => $teams])

    {{-- SIDEBAR LEVEL 2 (desktop) --}}
    <div class="hidden md:block">
        @include('layouts.sidebar-level2', [
            'currentTeam' => $currentTeam,
            'categories'  => $categories
        ])
    </div>

    {{-- MOBILE SIDEBAR OVERLAY --}}
    <div x-show="sidebarOpen"
         @click="sidebarOpen = false"
         x-transition.opacity
         class="fixed inset-0 bg-black/50 z-40 md:hidden"></div>

    {{-- SIDEBAR LEVEL 2 (mobile slide) --}}
    <div x-show="sidebarOpen"
         x-transition
         class="fixed left-0 top-0 bottom-0 w-64 bg-[#0b1120] z-50 md:hidden">
        @include('layouts.sidebar-level2', [
            'currentTeam' => $currentTeam,
            'categories'  => $categories
        ])
    </div>

    {{-- MAIN CONTENT --}}
    <div class="flex-1 flex flex-col">

        @include('layouts.dashboard-topbar')

        <main class="flex-1 p-4 md:p-6">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>