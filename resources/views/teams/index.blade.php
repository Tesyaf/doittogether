@extends('layouts.user-app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <p class="text-sm text-slate-300">Kelola Tim</p>
            <h1 class="text-2xl md:text-3xl font-semibold text-white">Tim Kamu</h1>
            <p class="text-sm text-slate-400 mt-1">Pilih tim untuk membuka dashboard, anggota, atau pengaturan.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <a href="{{ route('teams.join') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-lg bg-white/5 border border-white/15 text-white font-semibold hover:bg-white/10 transition">
                <i class="fa-solid fa-link mr-2"></i> Masukkan Kode Undangan
            </a>
            <a href="{{ route('teams.create') }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Buat Tim Baru
            </a>
        </div>
    </div>
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-slate-200 hover:text-cyan-200 text-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    @if($teams->isEmpty())
        <div class="bg-white/5 border border-white/10 rounded-2xl p-10 text-center">
            <i class="fa-solid fa-users-slash text-4xl text-white/40 mb-4"></i>
            <h2 class="text-2xl font-semibold mb-2 text-white">Belum Ada Tim</h2>
            <p class="text-white/60 mb-6">Mulai dengan membuat tim baru atau minta undangan dari rekan.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-3">
                <a href="{{ route('teams.join') }}" class="px-5 py-3 bg-white/10 hover:bg-white/15 rounded-xl font-semibold text-white border border-white/10">
                    <i class="fa-solid fa-link mr-2"></i> Masukkan Kode Undangan
                </a>
                <a href="{{ route('teams.create') }}" class="px-5 py-3 bg-cyan-500 hover:bg-cyan-600 rounded-xl font-semibold text-white shadow-lg">
                    <i class="fa-solid fa-plus mr-2"></i> Buat Tim Baru
                </a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($teams as $team)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-5 flex flex-col gap-4 shadow-lg">
                <div class="flex items-start gap-3">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 p-[2px] overflow-hidden">
                        @if($team->icon_url)
                            <img src="{{ $team->icon_url }}" alt="{{ $team->name }}" class="h-full w-full rounded-xl object-cover">
                        @else
                            <div class="h-full w-full rounded-xl bg-slate-950 flex items-center justify-center text-lg font-semibold text-white">
                                {{ strtoupper(substr($team->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-white">{{ $team->name }}</h3>
                        <p class="text-sm text-slate-400">{{ $team->members()->count() }} anggota</p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('teams.dashboard', $team) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-lg bg-white/10 text-white font-semibold hover:bg-white/15 transition text-sm">
                        Dashboard
                    </a>
                    <a href="{{ route('teams.members', $team) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-lg border border-slate-200/30 text-slate-100 hover:border-cyan-500 hover:text-cyan-100 transition text-sm">
                        Anggota
                    </a>
                    <a href="{{ route('teams.settings', $team) }}" class="flex-1 inline-flex items-center justify-center px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition text-sm">
                        Pengaturan
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
