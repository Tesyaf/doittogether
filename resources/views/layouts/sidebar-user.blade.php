{{-- sidebar-user.blade.php --}}
<aside
    class="w-64 bg-[#0b1120] border-r border-white/10 py-5 px-4 fixed left-20 top-0 bottom-0 flex flex-col z-40
           transform transition-transform duration-200 ease-out
           md:translate-x-0"
    x-show="sidebarOpen || window.innerWidth >= 768"
    :class="{ '-translate-x-full': !sidebarOpen && window.innerWidth < 768, 'translate-x-0': sidebarOpen || window.innerWidth >= 768 }">

    <div>
        <p class="text-white/60 text-xs uppercase">Akun</p>
        <p class="text-lg font-semibold">Akun Saya</p>
    </div>

    <div class="h-px bg-white/10 my-4"></div>

    <nav class="flex-1 space-y-4 overflow-y-auto">
        <div>
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70 hover:bg-white/5">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>

            <a href="{{ route('profile.show') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70 hover:bg-white/5">
                <i class="fa-solid fa-user"></i> Profil Saya
            </a>

            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70 hover:bg-white/5">
                <i class="fa-solid fa-gear"></i> Pengaturan Akun
            </a>

            <a href="{{ route('teams.index') }}"
                class="flex items-center gap-2 px-3 py-2 rounded-xl text-white/70 hover:bg-white/5">
                <i class="fa-solid fa-users"></i> Kelola Tim
            </a>

        </div>

        {{-- Logout is provided in the global sidebar, so removed from user sidebar to avoid duplication --}}
    </nav>

</aside>
