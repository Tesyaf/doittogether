@extends('layouts.user-app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-6">
    <div class="bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl flex flex-col gap-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-300">Panel Admin</p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white">Master Status Tugas</h1>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.master.statuses.store') }}" class="grid gap-3 md:grid-cols-5 bg-white/5 border border-white/10 rounded-2xl p-4">
            @csrf
            <input type="text" name="code" placeholder="Kode (unik)" class="md:col-span-1 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2 text-slate-100 text-sm focus:ring-2 focus:ring-cyan-500" required>
            <input type="text" name="label" placeholder="Label" class="md:col-span-1 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2 text-slate-100 text-sm focus:ring-2 focus:ring-cyan-500" required>
            <input type="color" name="color" value="#0ea5e9" class="md:col-span-1 h-10 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2">
            <input type="number" name="weight" value="0" min="0" max="255" class="md:col-span-1 rounded-lg border border-slate-200/40 bg-slate-950/70 px-3 py-2 text-slate-100 text-sm focus:ring-2 focus:ring-cyan-500" placeholder="Weight">
            <label class="md:col-span-1 inline-flex items-center gap-2 text-sm text-slate-100">
                <input type="checkbox" name="is_default" class="rounded border-slate-500 text-cyan-500 focus:ring-cyan-500"> Default
            </label>
            <div class="md:col-span-5 flex justify-end">
                <button class="px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">Tambah Status</button>
            </div>
        </form>
    </div>
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-slate-200 hover:text-cyan-200 text-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Admin
    </a>

    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-4 sm:p-6 backdrop-blur-sm space-y-4">
        <div class="overflow-hidden rounded-xl border border-slate-100/20">
            <table class="min-w-full divide-y divide-slate-100/20">
                <thead class="bg-slate-900/50">
                    <tr class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wide">
                        <th class="px-4 py-3">Label</th>
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Warna</th>
                        <th class="px-4 py-3">Default</th>
                        <th class="px-4 py-3">Weight</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/10 bg-slate-900/30">
                    @forelse($statuses as $status)
                    <tr>
                        <td class="px-4 py-3 text-slate-100">{{ $status->label }}</td>
                        <td class="px-4 py-3 text-slate-300">{{ $status->code }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center gap-2 text-sm text-slate-100">
                                <span class="h-4 w-4 rounded-full" style="background: {{ $status->color }}"></span>
                                {{ $status->color }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $status->is_default ? 'bg-emerald-500/20 text-emerald-100' : 'bg-slate-700 text-slate-200' }}">
                                {{ $status->is_default ? 'Ya' : 'Tidak' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-100">{{ $status->weight }}</td>
                        <td class="px-4 py-3 text-right">
                            <form method="POST" action="{{ route('admin.master.statuses.update', $status) }}" class="inline-flex items-center gap-2">
                                @csrf
                                @method('PUT')
                                <input type="text" name="label" value="{{ $status->label }}" class="rounded-lg border border-slate-200/40 bg-slate-950/70 px-2 py-1 text-xs text-slate-100 focus:ring-2 focus:ring-cyan-500">
                                <input type="color" name="color" value="{{ $status->color }}" class="h-8 w-12 rounded border border-slate-200/40">
                                <input type="number" name="weight" value="{{ $status->weight }}" min="0" max="255" class="w-16 rounded-lg border border-slate-200/40 bg-slate-950/70 px-2 py-1 text-xs text-slate-100 focus:ring-2 focus:ring-cyan-500">
                                <label class="inline-flex items-center gap-1 text-xs text-slate-200">
                                    <input type="checkbox" name="is_default" {{ $status->is_default ? 'checked' : '' }} class="rounded border-slate-500 text-cyan-500 focus:ring-cyan-500"> Default
                                </label>
                                <button class="px-3 py-1 rounded-lg bg-slate-800 text-slate-100 text-xs hover:border-cyan-500 border border-slate-600 transition">Update</button>
                            </form>
                            <form method="POST" action="{{ route('admin.master.statuses.destroy', $status) }}" class="inline">
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
    </div>
</div>
@endsection
