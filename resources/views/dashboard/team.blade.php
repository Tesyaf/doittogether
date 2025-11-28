@extends('layouts.team-app')

@section('content')
<h1 class="text-2xl font-bold mb-4">{{ $currentTeam->name }} — Dashboard Tim</h1>   
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Ringkasan aktivitas tim</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Team Dashboard</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('tasks.create', $currentTeam->id) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Buat Task
            </a>
            <a href="{{ route('teams.invite', $currentTeam->id) }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-user-plus mr-2"></i> Undang Anggota
            </a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Total Project</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">8</span>
                <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">+2 minggu ini</span>
            </div>
        </div>
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Task Selesai</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">126</span>
                <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">92%</span>
            </div>
        </div>
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Anggota</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">14</span>
                <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">3 pending</span>
            </div>
        </div>
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Sprint Aktif</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">3</span>
                <span class="text-xs px-2 py-1 rounded-full bg-orange-100 text-orange-700">Berjalan</span>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-slate-500">Status progres</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Overview Sprint</h2>
                    </div>
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Lihat detail</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-300">
                        <span>Design System</span>
                        <span>78%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-600" style="width: 78%;"></div>
                    </div>

                    <div class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-300">
                        <span>API Integration</span>
                        <span>54%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-600" style="width: 54%;"></div>
                    </div>

                    <div class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-300">
                        <span>QA & Testing</span>
                        <span>32%</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-slate-100 dark:bg-slate-800 overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-cyan-500 to-blue-600" style="width: 32%;"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-slate-500">Aktivitas terbaru</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Activity Feed</h2>
                    </div>
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Lihat semua</button>
                </div>
                <div class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ([
                    ['name' => 'Aulia', 'action' => 'menyelesaikan task "Update landing page"', 'time' => '5 menit lalu'],
                    ['name' => 'Rafi', 'action' => 'membuat task baru "Integrasi Midtrans"', 'time' => '15 menit lalu'],
                    ['name' => 'Nadya', 'action' => 'mengubah status sprint ke "In Progress"', 'time' => '1 jam lalu'],
                    ] as $activity)
                    <div class="flex items-start gap-3 py-3">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                            {{ strtoupper(substr($activity['name'], 0, 2)) }}
                        </div>
                        <div>
                            <p class="text-sm text-slate-900 dark:text-white"><span class="font-semibold">{{ $activity['name'] }}</span> {{ $activity['action'] }}</p>
                            <p class="text-xs text-slate-500">{{ $activity['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Anggota tim</p>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Members</h2>
                </div>
                <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Online 6</span>
            </div>
            <div class="space-y-3">
                @foreach ([
                ['name' => 'Aulia Rahma', 'role' => 'Product Manager'],
                ['name' => 'Rafi Pratama', 'role' => 'Backend Engineer'],
                ['name' => 'Nadya Putri', 'role' => 'UI/UX Designer'],
                ['name' => 'Dimas Saputra', 'role' => 'QA Engineer'],
                ] as $member)
                <div class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                            {{ strtoupper(substr($member['name'], 0, 2)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $member['name'] }}</p>
                            <p class="text-xs text-slate-500">{{ $member['role'] }}</p>
                        </div>
                    </div>
                    <button class="text-xs font-semibold text-cyan-600 hover:text-cyan-700">Detail</button>
                </div>
                @endforeach
            </div>
            <a href="{{ route('teams.members', $currentTeam->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                Kelola anggota
            </a>
        </div>
    </div>
</div>
@endsection
