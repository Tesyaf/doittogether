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

    {{-- Optional user sidebar: active when the view defines a `userSidebar` section
         or when on the main user dashboard route --}}
    @if (request()->routeIs('dashboard') || View::hasSection('userSidebar'))
    @include('layouts.sidebar-user')
    <main class="flex-1 p-6 min-h-screen md:ml-80">
        @include('layouts.partials.flash')
        @yield('content')
    </main>
    @else
    <main class="p-6 min-h-screen md:ml-20">
        @include('layouts.partials.flash')
        @yield('content')
    </main>
    @endif

</body>

</html>
