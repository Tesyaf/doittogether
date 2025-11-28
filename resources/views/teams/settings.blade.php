@extends('layouts.team-app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Atur identitas dan preferensi tim</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Team Settings</h1>
        </div>
        <div class="flex gap-3">
            <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-rotate-right mr-2"></i> Reset
            </button>
            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
            </button>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div>
                    <p class="text-sm text-slate-500">Profil tim</p>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Informasi Dasar</h2>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Nama Tim</span>
                        <input type="text" name="team_name" value="Product Squad" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Slug</span>
                        <input type="text" name="team_slug" value="product-squad" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                </div>
                <label class="space-y-2 block">
                    <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Deskripsi</span>
                    <textarea name="team_description" rows="3" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">Tim yang fokus pada produk inti dan eksperimen fitur baru.</textarea>
                </label>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Branding</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Logo & Warna</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Preview live</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-3">
                    <div class="sm:col-span-1 space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Logo</span>
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-14 rounded-full border border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/40 flex items-center justify-center text-slate-400">
                                <i class="fa-solid fa-image"></i>
                            </div>
                            <button class="px-3 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-sm font-semibold text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                                Upload Logo
                            </button>
                        </div>
                        <p class="text-xs text-slate-500">PNG/JPG, maks 2MB.</p>
                    </div>
                    <div class="sm:col-span-2 grid gap-4 sm:grid-cols-2">
                        <label class="space-y-2">
                            <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Warna Primer</span>
                            <input type="color" value="#06b6d4" class="w-full h-11 rounded-lg bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-700 cursor-pointer">
                        </label>
                        <label class="space-y-2">
                            <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Warna Sekunder</span>
                            <input type="color" value="#2563eb" class="w-full h-11 rounded-lg bg-white dark:bg-slate-950 border border-slate-200 dark:border-slate-700 cursor-pointer">
                        </label>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Preferensi</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Notifikasi & Keamanan</h2>
                    </div>
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Kelola template</button>
                </div>

                <div class="space-y-4">
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Email ringkasan mingguan</p>
                            <p class="text-sm text-slate-500">Kirim laporan progres ke semua anggota setiap Senin.</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Persetujuan anggota baru</p>
                            <p class="text-sm text-slate-500">Admin harus menyetujui anggota baru sebelum bergabung.</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Aktifkan 2FA untuk admin</p>
                            <p class="text-sm text-slate-500">Wajibkan autentikasi dua faktor bagi role admin.</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-slate-900 text-slate-50 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-cyan-200/80">Peran & akses</p>
                        <h2 class="text-xl font-semibold">Role Settings</h2>
                    </div>
                    <button class="text-sm text-cyan-200 hover:text-white">Kelola</button>
                </div>
                <div class="space-y-3">
                    @foreach ([
                    ['role' => 'Admin', 'desc' => 'Full akses, kelola anggota & billing'],
                    ['role' => 'Editor', 'desc' => 'Kelola task dan sprint'],
                    ['role' => 'Viewer', 'desc' => 'Hanya baca laporan'],
                    ] as $item)
                    <div class="p-3 rounded-xl border border-slate-800 bg-slate-800/60">
                        <p class="text-sm font-semibold">{{ $item['role'] }}</p>
                        <p class="text-xs text-slate-300">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
                <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                    Tambah role baru
                </button>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Risiko</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Danger Zone</h2>
                    </div>
                    <i class="fa-solid fa-triangle-exclamation text-amber-400"></i>
                </div>
                <p class="text-sm text-slate-500">Tindakan ini bersifat permanen. Pastikan kamu sudah yakin.</p>
                <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-red-200 text-red-600 font-semibold hover:bg-red-50 transition">
                    Hapus tim ini
                </button>
            </div>
        </div>
    </div>
</div>
@endsection