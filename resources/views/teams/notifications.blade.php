@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Kelola preferensi notifikasi tim</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Team Notifications</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-rotate-right mr-2"></i> Reset
            </button>
            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan
            </button>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Kanal notifikasi</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Preferensi Utama</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Realtime</span>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ([
                        ['label' => 'Email', 'desc' => 'Kirim ringkasan dan alert ke email'],
                        ['label' => 'In-app', 'desc' => 'Tampilkan notifikasi di dashboard'],
                        ['label' => 'Push', 'desc' => 'Push ke perangkat mobile'],
                        ['label' => 'Slack', 'desc' => 'Kirim ke channel Slack tim'],
                    ] as $channel)
                    <label class="flex items-start gap-3 p-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40 hover:border-cyan-500 transition">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $channel['label'] }}</p>
                            <p class="text-sm text-slate-500">{{ $channel['desc'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Jenis notifikasi</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Topik & Frekuensi</h2>
                    </div>
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Pilih semua</button>
                </div>
                <div class="space-y-3">
                    @foreach ([
                        ['title' => 'Aktivitas sprint', 'desc' => 'Update sprint, perubahan status task'],
                        ['title' => 'Undangan & keanggotaan', 'desc' => 'Undangan baru, persetujuan, role change'],
                        ['title' => 'Keamanan', 'desc' => 'Login mencurigakan, 2FA, kebijakan'],
                        ['title' => 'Laporan ringkasan', 'desc' => 'Ringkasan mingguan dan bulanan'],
                    ] as $topic)
                    <div class="p-4 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $topic['title'] }}</p>
                            <p class="text-sm text-slate-500">{{ $topic['desc'] }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="text-xs text-slate-600 dark:text-slate-300">Frekuensi</label>
                            <select class="rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-3 py-2 text-sm text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                                <option>Realtime</option>
                                <option>Harian</option>
                                <option>Mingguan</option>
                            </select>
                        </div>
                        <label class="flex items-center gap-2 text-sm text-slate-700 dark:text-slate-200">
                            <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                            Aktif
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Channel terhubung</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Integrasi</h2>
                    </div>
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Kelola</button>
                </div>
                <div class="space-y-3">
                    <div class="p-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Slack</p>
                            <p class="text-xs text-slate-500">#product-updates</p>
                        </div>
                        <button class="text-xs text-cyan-600 hover:text-cyan-700">Putuskan</button>
                    </div>
                    <div class="p-3 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Email CC</p>
                            <p class="text-xs text-slate-500">admin@doit.id</p>
                        </div>
                        <button class="text-xs text-cyan-600 hover:text-cyan-700">Ubah</button>
                    </div>
                </div>
                <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                    Tambah integrasi
                </button>
            </div>

            <div class="bg-slate-900 text-slate-50 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-cyan-200/80">Risiko</p>
                        <h2 class="text-xl font-semibold">Pengingat Keamanan</h2>
                    </div>
                    <i class="fa-solid fa-shield-halved text-cyan-200"></i>
                </div>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Batasi notifikasi sensitif hanya ke admin.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Pastikan channel eksternal (Slack/email) aman.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Audit log notifikasi kritis secara berkala.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
