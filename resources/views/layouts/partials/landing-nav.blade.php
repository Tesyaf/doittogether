<div x-data="{ open: false }" class="px-6 md:px-12 pt-6 pb-4">
    <header class="flex items-center justify-between">
        <a href="{{ route('landing') }}" class="text-xl md:text-2xl font-semibold tracking-tight">
            DoIt<span class="text-cyan-400">Together</span>
        </a>

        <button @click="open = !open" class="md:hidden text-white/80" aria-label="Toggle navigation">
            <i class="fa-solid" :class="open ? 'fa-xmark' : 'fa-bars'"></i>
        </button>

        <nav class="hidden md:flex gap-8 text-sm text-white/70">
            <a href="{{ route('landing') }}#features" class="hover:text-white transition">Fitur</a>
            <a href="{{ route('manfaat') }}" class="hover:text-white transition">Manfaat</a>
            <a href="{{ route('about') }}" class="hover:text-white transition">Tentang</a>
        </nav>

        <div class="hidden md:flex gap-3">
            <a href="{{ route('login') }}"
                class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition text-sm">
                Masuk
            </a>
            <a href="{{ route('register') }}"
                class="px-4 py-2 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 transition text-sm font-semibold">
                Daftar
            </a>
        </div>
    </header>

    <div x-cloak x-show="open" x-transition
        class="md:hidden mt-4 px-4 py-3 rounded-2xl bg-white/5 border border-white/10 text-white/80 text-sm space-y-3">
        <nav class="flex flex-col gap-3">
            <a href="{{ route('landing') }}#features" class="hover:text-white transition" @click="open = false">Fitur</a>
            <a href="{{ route('manfaat') }}" class="hover:text-white transition" @click="open = false">Manfaat</a>
            <a href="{{ route('about') }}" class="hover:text-white transition" @click="open = false">Tentang</a>
        </nav>
        <div class="flex gap-3 pt-2">
            <a href="{{ route('login') }}"
                class="flex-1 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition text-center">
                Masuk
            </a>
            <a href="{{ route('register') }}"
                class="flex-1 px-4 py-2 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 transition text-center font-semibold">
                Daftar
            </a>
        </div>
    </div>
</div>
