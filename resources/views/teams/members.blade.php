@extends('layouts.team-app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Kelola anggota, role, dan undangan</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Team Members</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('teams.invite', $team) }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-user-plus mr-2"></i> Undang Anggota
            </a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Total Anggota</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $members->count() }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Aktif</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Owner</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ ($roleStats['owner'] ?? 0) }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">Kelola</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Pending Invite</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $pendingInvitations->count() }}</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700">Butuh aksi</span>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-4 sm:p-6">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between mb-4">
                    <div>
                        <p class="text-sm text-slate-500">Daftar anggota</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Members</h2>
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border border-slate-100 dark:border-slate-800 hidden md:block">
                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                        <thead class="bg-slate-50 dark:bg-slate-900/50">
                            <tr class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                <th class="px-4 py-3">Anggota</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900/40">
                            @forelse ($members as $member)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold overflow-hidden">
                                            @if($member->user && $member->user->avatar_url)
                                                <img src="{{ $member->user->avatar_url }}" alt="{{ $member->user->name }}" class="w-full h-full object-cover">
                                            @else
                                                {{ strtoupper(substr($member->user?->name ?? 'U', 0, 2)) }}
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $member->user?->name ?? '-' }}</p>
                                            <p class="text-xs text-slate-500">{{ $member->user?->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $role = $member->role;
                                        $roleLabel = ucfirst($role);
                                        $roleClass = 'bg-slate-100 text-slate-700';
                                        if ($role === 'owner') $roleClass = 'bg-purple-100 text-purple-700';
                                        if ($role === 'admin') $roleClass = 'bg-blue-100 text-blue-700';
                                        if ($role === 'member') $roleClass = 'bg-cyan-100 text-cyan-700';
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $roleClass }}">
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-4 py-6 text-center text-sm text-slate-500">
                                    Belum ada anggota.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="grid gap-3 md:hidden">
                    @forelse ($members as $member)
                        @php
                            $role = $member->role;
                            $roleLabel = ucfirst($role);
                            $roleClass = 'bg-slate-100 text-slate-700';
                            if ($role === 'owner') $roleClass = 'bg-purple-100 text-purple-700';
                            if ($role === 'admin') $roleClass = 'bg-blue-100 text-blue-700';
                            if ($role === 'member') $roleClass = 'bg-cyan-100 text-cyan-700';
                        @endphp
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold overflow-hidden">
                                    @if($member->user && $member->user->avatar_url)
                                        <img src="{{ $member->user->avatar_url }}" alt="{{ $member->user->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($member->user?->name ?? 'U', 0, 2)) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $member->user?->name ?? '-' }}</p>
                                    <p class="text-xs text-white/60">{{ $member->user?->email ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $roleClass }}">
                                    {{ $roleLabel }}
                                </span>
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    Aktif
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 rounded-xl bg-white/5 border border-white/10 text-sm text-white/70 text-center">
                            Belum ada anggota.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Undangan</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Pending Invites</h2>
                    </div>
                    <a href="{{ route('teams.invitations.pending', $team) }}" class="text-sm text-cyan-600 hover:text-cyan-700">Kelola</a>
                </div>
                <div class="space-y-3">
                    @forelse ($pendingInvitations as $invite)
                    <div class="p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $invite->email }}</p>
                            <p class="text-xs text-slate-500">Role: {{ $invite->role }} - {{ optional($invite->created_at)->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('teams.invitations.resend', [$team, $invite]) }}">
                                @csrf
                                <button class="text-xs text-cyan-600 hover:text-cyan-700">Resend</button>
                            </form>
                            <form method="POST" action="{{ route('teams.invitations.cancel', [$team, $invite]) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs text-red-500 hover:text-red-600">Batalkan</button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-slate-500">Tidak ada undangan pending.</p>
                    @endforelse
                </div>
                <a href="{{ route('teams.invitations.pending', $team) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                    Lihat semua undangan
                </a>
            </div>

            <div class="bg-slate-900 text-slate-50 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-cyan-200/80">Tindakan</p>
                        <h2 class="text-xl font-semibold">Keluar dari tim</h2>
                    </div>
                </div>
                <form method="POST" action="{{ route('teams.leave', $team) }}" onsubmit="return confirm('Yakin keluar dari tim ini?');" class="space-y-3">
                    @csrf
                    <p class="text-sm text-slate-300">Anda akan kehilangan akses ke tim ini.</p>
                    <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-red-500 text-white font-semibold shadow hover:bg-red-600 transition">
                        Keluar dari tim
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
