@extends('layouts.user-app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-6">
    <div class="bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-300">Panel Admin</p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white">Master Prioritas Tugas</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.master.priorities.store') }}" class="grid gap-3 md:grid-cols-5 bg-white/5 border border-white/10 rounded-2xl p-4">
            @csrf
            <input type="text" name="code" placeholder="Kode (unik)" class="md:col-span-1 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2 text-slate-100 text-sm focus:ring-2 focus:ring-cyan-500" required>
            <input type="text" name="label" placeholder="Label" class="md:col-span-1 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2 text-slate-100 text-sm focus:ring-2 focus:ring-cyan-500" required>
            <input type="color" name="color" value="#f97316" class="md:col-span-1 h-10 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2">
            <input type="number" name="weight" value="1" min="0" max="255" class="md:col-span-1 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2 text-slate-100 text-sm focus:ring-2 focus:ring-cyan-500" placeholder="Weight">
            <label class="md:col-span-1 inline-flex items-center gap-2 text-sm text-slate-100">
                <input type="checkbox" name="is_default" class="rounded border-slate-500 text-cyan-500 focus:ring-cyan-500"> Default
            </label>
            <div class="md:col-span-5 flex justify-end">
                <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">Tambah Prioritas</button>
            </div>
        </form>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-4 sm:p-6 backdrop-blur-sm space-y-4">
        <div class="overflow-hidden rounded-xl border border-slate-100/20 hidden md:block">
            <table class="min-w-full divide-y divide-slate-100/20">
                <thead class="bg-slate-900/50">
                    <tr class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wide">
                        <th class="px-4 py-3">Label</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Warna</th>
                        <th class="px-4 py-3">Weight</th>
                        <th class="px-4 py-3">Default</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/10 bg-slate-900/30">
                    @forelse($priorities as $priority)
                    <tr>
                        <td class="px-4 py-3 text-slate-100">{{ $priority->label }}</td>
                        <td class="px-4 py-3 text-slate-300">{{ $priority->code }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center gap-2 text-sm text-slate-100">
                                <span class="h-4 w-4 rounded-full" style="background: {{ $priority->color }}"></span>
                                {{ $priority->color }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-100">{{ $priority->weight }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $priority->is_default ? 'bg-emerald-500/20 text-emerald-100' : 'bg-slate-700 text-slate-200' }}">
                                {{ $priority->is_default ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <form method="POST" action="{{ route('admin.master.priorities.update', $priority) }}" class="inline-flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="label" value="{{ $priority->label }}" class="rounded-lg border border-slate-200/40 bg-slate-950/70 px-2 py-1 text-xs text-slate-100 focus:ring-2 focus:ring-cyan-500">
                                <input type="color" name="color" value="{{ $priority->color }}" class="h-8 w-12 rounded border border-slate-200/40">
                                <input type="number" name="weight" value="{{ $priority->weight }}" min="0" max="255" class="w-16 rounded-lg border border-slate-200/40 bg-slate-950/70 px-2 py-1 text-xs text-slate-100 focus:ring-2 focus:ring-cyan-500">
                                <label class="inline-flex items-center gap-1 text-xs text-slate-200">
                                    <input type="checkbox" name="is_default" {{ $priority->is_default ? 'checked' : '' }} class="rounded border-slate-500 text-cyan-500 focus:ring-cyan-500"> Default
                                </label>
                                <button class="px-3 py-1 rounded-lg bg-slate-800 text-slate-100 text-xs hover:border-cyan-500 border border-slate-600 transition">Update</button>
                            </form>
                            <form method="POST" action="{{ route('admin.master.priorities.destroy', $priority) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-1 rounded-lg text-xs text-red-200 hover:text-red-100 hover:bg-red-500/10">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-400">Belum ada data.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="grid gap-3 md:hidden">
            @forelse($priorities as $priority)
                <div class="p-4 rounded-xl bg-slate-900/50 border border-white/10 space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-white">{{ $priority->label }}</p>
                            <p class="text-xs text-slate-400">Kode: {{ $priority->code }}</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold {{ $priority->is_default ? 'bg-emerald-500/20 text-emerald-100' : 'bg-slate-700 text-slate-200' }}">
                            {{ $priority->is_default ? 'Default' : 'Non-default' }}
                        </span>
                    </div>
                    <div class="flex items-center gap-2 text-xs text-slate-200">
                        <span class="h-4 w-4 rounded-full" style="background: {{ $priority->color }}"></span>
                        <span>{{ $priority->color }}</span>
                        <span class="ml-auto">Weight: {{ $priority->weight }}</span>
                    </div>
                    <form method="POST" action="{{ route('admin.master.priorities.update', $priority) }}" class="space-y-2">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-2">
                            <input type="text" name="label" value="{{ $priority->label }}" class="rounded-lg border border-slate-200/40 bg-slate-950/70 px-2 py-2 text-xs text-slate-100 focus:ring-2 focus:ring-cyan-500" placeholder="Label">
                            <input type="color" name="color" value="{{ $priority->color }}" class="h-10 w-full rounded border border-slate-200/40">
                            <input type="number" name="weight" value="{{ $priority->weight }}" min="0" max="255" class="w-full rounded-lg border border-slate-200/40 bg-slate-950/70 px-2 py-2 text-xs text-slate-100 focus:ring-2 focus:ring-cyan-500" placeholder="Weight">
                            <label class="inline-flex items-center gap-2 text-xs text-slate-200">
                                <input type="checkbox" name="is_default" {{ $priority->is_default ? 'checked' : '' }} class="rounded border-slate-500 text-cyan-500 focus:ring-cyan-500"> Default
                            </label>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="flex-1 px-3 py-2 rounded-lg bg-slate-800 text-slate-100 text-xs hover:border-cyan-500 border border-slate-600 transition">Update</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('admin.master.priorities.destroy', $priority) }}">
                        @csrf
                        @method('DELETE')
                        <button class="w-full px-3 py-2 rounded-lg text-xs text-red-200 hover:text-red-100 hover:bg-red-500/10 border border-red-500/30">Hapus</button>
                    </form>
                </div>
            @empty
                <div class="p-4 rounded-xl bg-slate-900/50 border border-white/10 text-center text-sm text-slate-400">
                    Belum ada data.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
