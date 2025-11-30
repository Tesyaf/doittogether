@extends('layouts.team-app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('teams.dashboard', $team->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm mb-3 inline-flex items-center gap-1">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <h1 class="text-3xl font-bold text-white">Buat Kategori Baru</h1>
    </div>

    <form method="POST" action="{{ route('categories.store', $team->id) }}" class="space-y-6 bg-white/5 border border-white/10 rounded-xl p-6 backdrop-blur-sm">
        @csrf

        <div>
            <label class="block text-sm font-semibold text-white mb-2">Nama Kategori *</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/50 focus:border-cyan-500 focus:outline-none transition"
                placeholder="Contoh: Development, Design, Testing...">
            @error('name')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="flex-1 px-6 py-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold">
                <i class="fa-solid fa-check mr-2"></i> Buat Kategori
            </button>
            <a href="{{ route('teams.dashboard', $team->id) }}" class="flex-1 px-6 py-3 rounded-lg bg-white/10 hover:bg-white/20 transition text-white font-semibold text-center">
                <i class="fa-solid fa-xmark mr-2"></i> Batal
            </a>
        </div>
    </form>
</div>
@endsection