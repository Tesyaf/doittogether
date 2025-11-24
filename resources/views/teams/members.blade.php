@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Kelola anggota, role, dan status undangan</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Team Members</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-user-plus mr-2"></i> Undang Anggota
            </button>
            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Role
            </button>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Total Anggota</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">14</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">+2 minggu ini</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Admin</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">3</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">Aktif</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Pending Invite</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">3</p>
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
                    <div class="flex gap-2">
                        <input type="text" placeholder="Cari nama..." class="w-full sm:w-52 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                        <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                            <option>Semua role</option>
                            <option>Admin</option>
                            <option>Editor</option>
                            <option>Viewer</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-hidden rounded-xl border border-slate-100 dark:border-slate-800">
                    <table class="min-w-full divide-y divide-slate-100 dark:divide-slate-800">
                        <thead class="bg-slate-50 dark:bg-slate-900/50">
                            <tr class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                <th class="px-4 py-3">Anggota</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900/40">
                            @foreach ([
                                ['name' => 'Aulia Rahma', 'email' => 'aulia@doit.id', 'role' => 'Admin', 'status' => 'Aktif'],
                                ['name' => 'Rafi Pratama', 'email' => 'rafi@doit.id', 'role' => 'Editor', 'status' => 'Aktif'],
                                ['name' => 'Nadya Putri', 'email' => 'nadya@doit.id', 'role' => 'Viewer', 'status' => 'Aktif'],
                                ['name' => 'Dimas Saputra', 'email' => 'dimas@doit.id', 'role' => 'Editor', 'status' => 'Pending'],
                            ] as $member)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                                            {{ strtoupper(substr($member['name'], 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $member['name'] }}</p>
                                            <p class="text-xs text-slate-500">{{ $member['email'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if($member['role'] === 'Admin') bg-blue-100 text-blue-700
                                        @elseif($member['role'] === 'Editor') bg-cyan-100 text-cyan-700
                                        @else bg-slate-100 text-slate-700 @endif">
                                        {{ $member['role'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if($member['status'] === 'Aktif') bg-green-100 text-green-700
                                        @else bg-amber-100 text-amber-700 @endif">
                                        {{ $member['status'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Ubah</button>
                                    <button class="text-sm text-red-500 hover:text-red-600">Remove</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Kirim ulang</button>
                </div>
                <div class="space-y-3">
                    @foreach ([
                        ['email' => 'alex@doit.id', 'role' => 'Editor', 'sent' => '2 hari lalu'],
                        ['email' => 'sinta@doit.id', 'role' => 'Viewer', 'sent' => 'Kemarin'],
                        ['email' => 'bima@doit.id', 'role' => 'Viewer', 'sent' => 'Hari ini'],
                    ] as $invite)
                    <div class="p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $invite['email'] }}</p>
                            <p class="text-xs text-slate-500">Role: {{ $invite['role'] }} · {{ $invite['sent'] }}</p>
                        </div>
                        <div class="flex gap-2">
                            <button class="text-xs text-cyan-600 hover:text-cyan-700">Resend</button>
                            <button class="text-xs text-red-500 hover:text-red-600">Batalkan</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                    Lihat semua undangan
                </button>
            </div>

            <div class="bg-slate-900 text-slate-50 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-cyan-200/80">Role & akses</p>
                        <h2 class="text-xl font-semibold">Ringkasan Role</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-white/10 text-white">3 role</span>
                </div>
                <div class="space-y-3">
                    @foreach ([
                        ['role' => 'Admin', 'count' => 3],
                        ['role' => 'Editor', 'count' => 6],
                        ['role' => 'Viewer', 'count' => 5],
                    ] as $role)
                    <div class="flex items-center justify-between p-3 rounded-xl border border-slate-800 bg-slate-800/60">
                        <div>
                            <p class="text-sm font-semibold">{{ $role['role'] }}</p>
                            <p class="text-xs text-slate-300">{{ $role['count'] }} anggota</p>
                        </div>
                        <button class="text-xs text-cyan-200 hover:text-white">Kelola</button>
                    </div>
                    @endforeach
                </div>
                <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                    Tambah role baru
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
