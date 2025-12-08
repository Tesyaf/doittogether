@extends('layouts.team-app')

@section('content')
<div class="max-w-5xl mx-auto space-y-6 px-4 sm:px-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <a href="{{ route('teams.dashboard', $team->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-bold text-white mt-2">Kelola Kategori</h1>
            <p class="text-sm text-white/60">Hanya owner (atau admin aplikasi) yang dapat membuat, mengubah, dan menghapus kategori.</p>
        </div>
        <a href="{{ route('categories.create', $team->id) }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold shadow w-full md:w-auto">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Kategori
        </a>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 backdrop-blur-sm">
        <div class="flex items-center justify-between mb-4">
            <div>
                <p class="text-sm text-white/60">Daftar kategori tim</p>
                <h2 class="text-xl font-semibold text-white">Kategori Aktif</h2>
            </div>
            <span class="text-xs px-3 py-1 rounded-full bg-white/10 text-white border border-white/10">
                {{ $categoryList->count() }} kategori
            </span>
        </div>

        @if ($categoryList->isEmpty())
        <div class="text-center py-10 border border-dashed border-white/10 rounded-xl bg-white/5">
            <i class="fa-solid fa-folder-open text-4xl text-white/30 mb-3 block"></i>
            <p class="text-white/70 mb-2">Belum ada kategori.</p>
            <p class="text-sm text-white/60">Mulai tambahkan kategori agar task lebih terorganisir.</p>
        </div>
        @else
        <div class="space-y-3">
            @foreach ($categoryList as $category)
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-4 py-3 rounded-xl bg-white/5 border border-white/10">
                <div>
                    <p class="text-white font-semibold">{{ $category->name }}</p>
                    <p class="text-xs text-white/60">{{ $category->tasks_count }} task terkait</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('categories.edit', [$team->id, $category->id]) }}"
                        class="px-3 py-2 rounded-lg bg-white/10 hover:bg-white/20 text-sm text-white transition">
                        <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                    </a>
                    <form method="POST" action="{{ route('categories.destroy', [$team->id, $category->id]) }}"
                        onsubmit="return confirm('Hapus kategori {{ $category->name }}? Task yang terkait akan kehilangan kategori.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-3 py-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-sm text-red-200 border border-red-500/40 transition">
                            <i class="fa-solid fa-trash mr-1"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endsection
