{{-- sidebar-level2.blade.php --}}
<aside
    x-data="{
        open_main: true,
        open_categories: true,
        open_team: false,
        open_settings: false
    }"
    class="w-64 bg-[#0b1120] border-r border-white/10 py-5 px-4 hidden md:flex flex-col">

    {{-- Header Team --}}
    <div>
        <p class="text-white/60 text-xs uppercase">Workspace</p>
        <p class="text-lg font-semibold">{{ $currentTeam->name }}</p>
    </div>

    <div class="h-px bg-white/10 my-4"></div>

    <nav class="flex-1 space-y-4 overflow-y-auto">

        {{-- MAIN --}}
        <div>
            <button @click="open_main = !open_main"
                class="w-full flex items-center justify-between text-white/70 text-xs uppercase">
                <span>Main</span><span x-text="open_main ? '−' : '+'"></span>
            </button>

            <div x-show="open_main" x-transition class="mt-2 space-y-1">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl
                           {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                    🏠 Overview
                </a>

                <a href="{{ route('tasks.index') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl
                           {{ request()->routeIs('tasks.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                    🗂 Semua Tugas
                </a>

                <a href="{{ route('tasks.my') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl
                           {{ request()->routeIs('tasks.my') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                    ✅ Tugas Saya
                </a>

            </div>
        </div>

        {{-- CATEGORIES --}}
        <div>
            <button @click="open_categories = !open_categories"
                class="w-full flex items-center justify-between text-white/70 text-xs uppercase">
                <span>Kategori</span><span x-text="open_categories ? '−' : '+'"></span>
            </button>

            <div x-show="open_categories" x-transition class="mt-2 space-y-1">

                @forelse($categories as $category)
                <a href="{{ route('tasks.category', $category->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl
                               {{ request()->routeIs('tasks.category') && request()->id == $category->id 
                                    ? 'bg-white/10 text-white' 
                                    : 'text-white/70 hover:bg-white/5' }}">
                    📁 {{ $category->name }}
                </a>
                @empty
                <p class="text-white/40 text-xs px-3">Belum ada kategori</p>
                @endforelse

                {{-- Tambah kategori --}}
                <a href="{{ route('categories.create') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/50 hover:bg-white/5">
                    ➕ Tambah Kategori
                </a>
            </div>
        </div>

        {{-- TEAM --}}
        <div>
            <button @click="open_team = !open_team"
                class="w-full flex items-center justify-between text-white/70 text-xs uppercase">
                <span>Team</span> <span x-text="open_team ? '−' : '+'"></span>
            </button>

            <div x-show="open_team" x-transition class="mt-2 space-y-1">

                <a href="{{ route('team.members', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    👥 Anggota
                </a>

                <a href="{{ route('team.invite', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    ✉️ Undang Anggota
                </a>

            </div>
        </div>

        {{-- SETTINGS --}}
        <div>
            <button @click="open_settings = !open_settings"
                class="w-full flex items-center justify-between text-white/70 text-xs uppercase">
                <span>Settings</span> <span x-text="open_settings ? '−' : '+'"></span>
            </button>

            <div x-show="open_settings" x-transition class="mt-2 space-y-1">

                <a href="{{ route('team.settings', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    ⚙️ Pengaturan Tim
                </a>

                <a href="{{ route('profile.show') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    👤 Profil Saya
                </a>

            </div>
        </div>

    </nav>
</aside>