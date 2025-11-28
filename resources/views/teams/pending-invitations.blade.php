@extends('layouts.team-app')

@section('content')
@php
    $pending = $invitations;
    $expiringSoon = $pending->filter(fn ($invite) => $invite->expires_at && $invite->expires_at->lte(now()->addDays(3)));
    $sentToday = $pending->filter(fn ($invite) => optional($invite->created_at)->isToday());
@endphp
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Pantau dan kelola undangan yang belum diterima</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Pending Invitations</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('teams.invite', $team) }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-user-plus mr-2"></i> Undang Baru
            </a>
        </div>
    </div>

    @if (session('success'))
    <div class="rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 text-red-800 px-4 py-3 text-sm space-y-1">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <div class="grid gap-4 md:grid-cols-3">
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Total Pending</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $pending->count() }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700">Perlu aksi</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Kadaluwarsa &lt;= 3 hari</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $expiringSoon->count() }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-700">Prioritas</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Terkirim hari ini</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $sentToday->count() }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Baru</span>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-4 sm:p-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <p class="text-sm text-slate-500">Daftar undangan</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Invitations</h2>
                    </div>
                    <div class="flex gap-2">
                        <input type="text" placeholder="Cari email..." class="w-full sm:w-52 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition" disabled>
                        <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition" disabled>
                            <option>Role: member</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border border-slate-100 dark:border-slate-800">
                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                        <thead class="bg-slate-50 dark:bg-slate-900/50">
                            <tr class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Dikirim</th>
                                <th class="px-4 py-3">Kedaluwarsa</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900/40">
                            @forelse ($pending as $invite)
                            @php
                                $expiryBadge = 'bg-slate-100 text-slate-700';
                                $expiryLabel = 'Tidak diatur';
                                if ($invite->expires_at) {
                                    $expiryLabel = $invite->expires_at->isPast() ? 'Habis' : $invite->expires_at->diffForHumans();
                                    if ($invite->expires_at->isPast()) {
                                        $expiryBadge = 'bg-red-100 text-red-700';
                                    } elseif ($invite->expires_at->lte(now()->addDays(3))) {
                                        $expiryBadge = 'bg-orange-100 text-orange-700';
                                    } else {
                                        $expiryBadge = 'bg-emerald-100 text-emerald-700';
                                    }
                                }
                            @endphp
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $invite->email }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-cyan-100 text-cyan-700">
                                        {{ $invite->role }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-500">{{ optional($invite->created_at)->diffForHumans() }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $expiryBadge }}">
                                        {{ $expiryLabel }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <form method="POST" action="{{ route('teams.invitations.resend', [$team, $invite]) }}" class="inline">
                                        @csrf
                                        <button class="text-sm text-cyan-600 hover:text-cyan-700">Resend</button>
                                    </form>
                                    <form method="POST" action="{{ route('teams.invitations.cancel', [$team, $invite]) }}" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-sm text-red-500 hover:text-red-600">Batalkan</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">
                                    Belum ada undangan pending.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Template</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Pengingat & Email</h2>
                    </div>
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Kelola</button>
                </div>
                <div class="space-y-3">
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Remind otomatis</p>
                            <p class="text-sm text-slate-500">Kirim pengingat setelah 3 hari jika belum diterima.</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Kirim salinan ke admin</p>
                            <p class="text-sm text-slate-500">CC admin pada setiap pengingat undangan.</p>
                        </div>
                    </label>
                </div>
            </div>

            <div class="bg-slate-900 text-slate-50 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-cyan-200/80">Ringkasan</p>
                        <h2 class="text-xl font-semibold">Checklist Keamanan</h2>
                    </div>
                    <i class="fa-solid fa-shield-halved text-cyan-200"></i>
                </div>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Setel kedaluwarsa maksimal 7 hari.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Batalkan undangan yang sudah kedaluwarsa.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Gunakan role terendah yang diperlukan.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
