<aside class="hidden md:flex md:fixed md:top-0 md:left-0 w-20 bg-[#020617] border-r border-white/10 min-h-screen flex
              flex-col items-center py-4 gap-4 z-50">

    {{-- Logo --}}
    <a href="{{ route('dashboard') }}"
        class="w-12 h-12 rounded-2xl bg-cyan-500 flex items-center justify-center
              font-bold text-xl shadow-lg hover:opacity-90 transition">
        D
    </a>

    <div class="w-10 h-px bg-white/10 my-2"></div>

    {{-- Daftar Tim --}}
    @foreach($teams as $team)
    <div class="relative group">
        <a href="{{ route('teams.switch', $team->id) }}"
            class="w-11 h-11 rounded-2xl flex items-center justify-center 
                  text-sm font-semibold border border-white/10
                  {{ $team->id === session('team_id') 
                       ? 'bg-cyan-500/80 text-white ring-2 ring-cyan-400' 
                       : 'bg-white/5 text-white/70 hover:bg-white/10' }}">
            {{ strtoupper(Str::limit($team->name, 2, '')) }}
        </a>

        {{-- Tooltip nama tim --}}
        <div class="absolute left-14 top-1/2 -translate-y-1/2 
                    bg-black/70 px-3 py-1 rounded-lg text-xs text-white/80
                    opacity-0 group-hover:opacity-100 group-hover:translate-x-1
                    pointer-events-none transition">
            {{ $team->name }}
        </div>
    </div>
    @endforeach

    {{-- Tambah Tim --}}
    <button onclick="location.href='{{ route('teams.create') }}'"
        class="w-11 h-11 rounded-2xl bg-white/5 hover:bg-white/10 text-white/70
               flex items-center justify-center border-dashed border border-white/20
               text-xl transition">
        +
    </button>

    <div class="mt-auto pt-4 border-t border-white/40">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button
                type="submit"
                class="w-full flex justify-center items-center p-3 mt-4
               rounded-2xl bg-white/5 text-white/70 border border-white/10
               hover:bg-red-500/20 hover:text-red-400 hover:border-red-500/30
               transition-all">
                <i class="fa-solid fa-right-from-bracket text-lg"></i>
            </button>
        </form>
    </div>
</aside>