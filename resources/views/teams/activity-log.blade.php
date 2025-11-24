@extends('layouts.app')

@section('content')
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
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">38</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">+12 vs kemarin</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Aksi Kritis</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">5</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-700">Perlu cek</span>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Filter Aktif</p>
                <p class="text-3xl font-semibold text-slate-900 dark:text-white">2</p>
            </div>
            <span class="text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-700">User, Rentang</span>
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
                        <th class="px-4 py-3 text-right">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800 bg-white dark:bg-slate-900/40">
                    @foreach ([
                        ['name' => 'Aulia Rahma', 'action' => 'Mengubah role Dimas menjadi Editor', 'category' => 'Role', 'time' => '5 menit lalu', 'status' => 'Berhasil'],
                        ['name' => 'Rafi Pratama', 'action' => 'Menghapus task "Integrasi Midtrans"', 'category' => 'Task', 'time' => '20 menit lalu', 'status' => 'Berhasil'],
                        ['name' => 'Nadya Putri', 'action' => 'Meng-update logo tim', 'category' => 'Branding', 'time' => '1 jam lalu', 'status' => 'Berhasil'],
                        ['name' => 'Dimas Saputra', 'action' => 'Percobaan login gagal 3x', 'category' => 'Keamanan', 'time' => '3 jam lalu', 'status' => 'Dipantau'],
                        ['name' => 'System', 'action' => 'Undangan ke lisa@doit.id kadaluwarsa', 'category' => 'Undangan', 'time' => 'Kemarin', 'status' => 'Kadaluarsa'],
                    ] as $item)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                                    {{ strtoupper(substr($item['name'], 0, 2)) }}
                                </div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $item['name'] }}</p>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-800 dark:text-slate-100">{{ $item['action'] }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @switch($item['category'])
                                    @case('Role') bg-blue-100 text-blue-700 @break
                                    @case('Task') bg-cyan-100 text-cyan-700 @break
                                    @case('Branding') bg-indigo-100 text-indigo-700 @break
                                    @case('Keamanan') bg-orange-100 text-orange-700 @break
                                    @default bg-slate-100 text-slate-700
                                @endswitch">
                                {{ $item['category'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-slate-500">{{ $item['time'] }}</td>
                        <td class="px-4 py-3 text-right">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                @if($item['status'] === 'Berhasil') bg-emerald-100 text-emerald-700
                                @elseif($item['status'] === 'Dipantau') bg-amber-100 text-amber-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $item['status'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
