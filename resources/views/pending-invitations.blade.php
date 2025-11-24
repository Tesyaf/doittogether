@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Pantau dan kelola undangan yang belum diterima</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Pending Invitations</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-user-plus mr-2"></i> Undang Baru
            </button>
            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-paper-plane mr-2"></i> Resend Semua
            </button>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Total Pending</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">7</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700">Perlu aksi</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Kadaluwarsa < 3 hari</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">3</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-700">Prioritas</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Terkirim hari ini</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">2</p>
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
                        <input type="text" placeholder="Cari email..." class="w-full sm:w-52 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
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
                                <th class="px-4 py-3">Email</th>
                                <th class="px-4 py-3">Role</th>
                                <th class="px-4 py-3">Dikirim</th>
                                <th class="px-4 py-3">Kedaluwarsa</th>
                                <th class="px-4 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900/40">
                            @foreach ([
                                ['email' => 'alex@doit.id', 'role' => 'Editor', 'sent' => '2 hari lalu', 'expire' => '2 hari lagi'],
                                ['email' => 'sinta@doit.id', 'role' => 'Viewer', 'sent' => 'Kemarin', 'expire' => '6 hari lagi'],
                                ['email' => 'bima@doit.id', 'role' => 'Viewer', 'sent' => 'Hari ini', 'expire' => '7 hari lagi'],
                                ['email' => 'lisa@doit.id', 'role' => 'Admin', 'sent' => '3 hari lalu', 'expire' => '1 hari lagi'],
                                ['email' => 'amir@doit.id', 'role' => 'Editor', 'sent' => '1 minggu lalu', 'expire' => 'Habis'],
                            ] as $invite)
                            <tr>
                                <td class="px-4 py-3">
                                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $invite['email'] }}</p>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if($invite['role'] === 'Admin') bg-blue-100 text-blue-700
                                        @elseif($invite['role'] === 'Editor') bg-cyan-100 text-cyan-700
                                        @else bg-slate-100 text-slate-700 @endif">
                                        {{ $invite['role'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-500">{{ $invite['sent'] }}</td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                        @if($invite['expire'] === 'Habis') bg-red-100 text-red-700
                                        @elseif(str_contains($invite['expire'], '1 hari')) bg-orange-100 text-orange-700
                                        @else bg-emerald-100 text-emerald-700 @endif">
                                        {{ $invite['expire'] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right space-x-2">
                                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Resend</button>
                                    <button class="text-sm text-red-500 hover:text-red-600">Batalkan</button>
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
