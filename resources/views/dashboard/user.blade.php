@extends('layouts.user-app')

@section('userSidebar')
@endsection

@section('content')
<div class="max-w-6xl mx-auto space-y-10">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold mb-2">
            Dashboard Pengguna
        </h1>
        <p class="text-white/60">Ringkasan aktivitas dan team yang kamu ikuti.</p>
    </div>

    {{-- Empty Team State --}}
    @if ($teams->isEmpty())
    <div class="bg-white/5 border border-white/10 rounded-2xl p-10 text-center">
        <i class="fa-solid fa-users-slash text-4xl text-white/40 mb-4"></i>

        <h2 class="text-2xl font-semibold mb-2">Belum Ada Team</h2>
        <p class="text-white/60 mb-6">
            Kamu belum bergabung dalam team mana pun. Mulai dengan membuat team baru.
        </p>

        <a href="{{ route('teams.create') }}"
            class="px-5 py-3 bg-cyan-500 hover:bg-cyan-600 rounded-xl font-semibold shadow-lg">
            <i class="fa-solid fa-plus mr-2"></i> Buat Team Baru
        </a>
    </div>
    @else

    {{-- Team List --}}
    <section>
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-layer-group text-cyan-400"></i>
            Team Kamu
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($teams as $team)
            <a href="{{ route('teams.dashboard', $team->id) }}"
                class="bg-white/5 border border-white/10 p-6 rounded-2xl hover:bg-white/10 transition shadow-lg flex flex-col justify-between">

                <div>
                    <h3 class="text-lg font-semibold mb-2">{{ $team->name }}</h3>
                    <p class="text-white/50 text-sm flex items-center gap-2">
                        <i class="fa-solid fa-user-group"></i>
                        {{ $team->members->count() }} anggota
                    </p>
                </div>

                <div class="mt-4 text-cyan-400 text-sm font-semibold flex items-center gap-1">
                    Masuk Team
                    <i class="fa-solid fa-arrow-right"></i>
                </div>
            </a>
            @endforeach
        </div>
    </section>

    {{-- Recent Activity --}}
    <section>
        <h2 class="text-xl font-semibold mb-4 flex items-center gap-2">
            <i class="fa-solid fa-clock-rotate-left text-cyan-400"></i>
            Aktivitas Terbaru
        </h2>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 space-y-4">
            <p class="text-white/50">Belum ada aktivitas terbaru.</p>
        </div>
    </section>

    @endif

</div>
@endsection