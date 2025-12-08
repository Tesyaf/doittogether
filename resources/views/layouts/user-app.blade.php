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
        {{-- Mobile top bar --}}
        <header class="md:hidden fixed top-0 inset-x-0 z-50 bg-[#0b1120] border-b border-white/10 flex items-center justify-between px-4 py-3">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen"
                        class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-white/10 transition">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div>
                    <p class="text-xs text-white/60">Akun</p>
                    <p class="text-sm font-semibold">{{ auth()->user()->name ?? config('app.name') }}</p>
                </div>
            </div>
            <a href="{{ route('dashboard') }}" class="text-sm text-cyan-300 hover:text-cyan-200">Dashboard</a>
        </header>

        {{-- Backdrop mobile --}}
        <div x-show="sidebarOpen" x-transition class="fixed inset-0 bg-black/60 z-40 md:hidden" @click="sidebarOpen = false"></div>

        {{-- Navbar global --}}
        @include('layouts.sidebar-global', [
        'teams' => $teams,
        ])

        {{-- Optional user sidebar: active when the view defines a `userSidebar` section
             or when on the main user dashboard route --}}
        @if (request()->routeIs('dashboard') || View::hasSection('userSidebar'))
            @include('layouts.sidebar-user')
            <main class="flex-1 p-4 sm:p-6 min-h-screen md:ml-80 mt-16 md:mt-0">
                @include('layouts.partials.flash')
                @yield('content')
            </main>
        @else
            <main class="p-4 sm:p-6 min-h-screen md:ml-20 mt-16 md:mt-0">
                @include('layouts.partials.flash')
                @yield('content')
            </main>
        @endif
    </div>

</body>

</html>
