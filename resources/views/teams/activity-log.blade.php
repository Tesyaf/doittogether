@extends('layouts.team-app')

@section('content')
@php
    use Illuminate\Support\Str;

    $activities = $logs
        ->flatMap(function ($member) {
            return $member->activityLogs->map(function ($log) use ($member) {
                $log->actor_name = $member->user->name ?? 'Unknown';
                $log->actor_initials = strtoupper(Str::limit($log->actor_name, 2, ''));
                return $log;
            });
        })
        ->sortByDesc('created_at')
        ->values();

    $todayCount    = $activities->filter(fn ($log) => $log->created_at?->isToday())->count();
    $taskCount     = $activities->where('entity_type', 'task')->count();
    $uniqueActors  = $activities->pluck('actor_name')->filter()->unique()->count();
@endphp

<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Lihat riwayat perubahan dan aktivitas tim</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Team Activity Log</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-rotate-right mr-2"></i> Refresh
            </button>
            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-download mr-2"></i> Export Log
            </button>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Aktivitas Hari Ini</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $todayCount }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Real-time</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Aksi Task</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $taskCount }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Task</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Anggota Aktif</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $uniqueActors }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-700">Pengguna</span>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-4 sm:p-6 space-y-4">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap gap-2">
                <input type="text" placeholder="Cari aktivitas..." class="w-full sm:w-60 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    <option>Semua user</option>
                    <option>Aulia</option>
                    <option>Rafi</option>
                    <option>Nadya</option>
                </select>
                <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    <option>7 hari terakhir</option>
                    <option>24 jam</option>
                    <option>30 hari</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                    Clear Filter
                </button>
                <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                    Terapkan
                </button>
            </div>
        </div>

        <div class="overflow-hidden rounded-xl border border-slate-100 dark:border-slate-800">
            <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                <thead class="bg-slate-50 dark:bg-slate-900/50">
                    <tr class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Aktivitas</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Waktu</th>
                        <th class="px-4 py-3 text-right">Info</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900/40">
                    @forelse ($activities as $log)
                        @php
                            $meta = $log->meta ? json_decode($log->meta, true) : null;
                            $metaText = is_array($meta) ? implode(', ', array_map(fn($k, $v) => $k . ': ' . $v, array_keys($meta), $meta)) : ($log->meta ?? '—');
                        @endphp
                        <tr>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                                        {{ $log->actor_initials ?? 'NA' }}
                                    </div>
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $log->actor_name ?? 'Unknown' }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-800 dark:text-slate-100">
                                {{ ucfirst($log->action) }} {{ $log->entity_type }}
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-200">
                                    {{ $log->entity_type }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-slate-500">
                                {{ $log->created_at?->diffForHumans() ?? '-' }}
                            </td>
                            <td class="px-4 py-3 text-right text-xs text-slate-500">
                                {{ Str::limit($metaText, 50) }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">
                                Belum ada aktivitas untuk tim ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
