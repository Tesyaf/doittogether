{{-- sidebar-level2.blade.php --}}
<aside
    x-data="{
        open_main: true,
        open_team: false,
        open_settings: false
    }"
    class="w-64 bg-[#0b1120] border-r border-white/10 py-5 px-4 hidden md:flex md:fixed md:left-20 md:top-0 md:bottom-0 md:flex-col md:z-40">

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

                <a href="{{ route('teams.dashboard', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl
                           {{ request()->routeIs('teams.dashboard') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                    <i class="fa-solid fa-home"></i> Overview
                </a>

                <a href="{{ route('tasks.index', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl
                           {{ request()->routeIs('tasks.*') ? 'bg-white/10 text-white' : 'text-white/70 hover:bg-white/5' }}">
                    <i class="fa-solid fa-list-check"></i> Tugas
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

                <a href="{{ route('teams.members', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    <i class="fa-solid fa-users"></i> Anggota
                </a>

                <a href="{{ route('teams.invite', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    <i class="fa-solid fa-envelope"></i> Undang Anggota
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

                <a href="{{ route('teams.settings', $currentTeam->id) }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    <i class="fa-solid fa-gear"></i> Pengaturan Tim
                </a>

                <a href="{{ route('profile.show') }}"
                    class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70">
                    <i class="fa-solid fa-user"></i> Profil Saya
                </a>

            </div>
        </div>

    </nav>
</aside>