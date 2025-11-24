@extends('layouts.app')

@section('content')
<div class="w-full max-w-5xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Kirim undangan anggota baru ke tim</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Invite Member</h1>
        </div>
        <div class="flex gap-3">
            <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-rotate-right mr-2"></i> Reset
            </button>
            <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Undangan
            </button>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Form undangan</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Detail Member</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Auto-email</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Nama</span>
                        <input type="text" name="name" placeholder="Nama lengkap" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Email</span>
                        <input type="email" name="email" placeholder="email@doit.id" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Role</span>
                        <select class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                            <option>Editor</option>
                            <option>Admin</option>
                            <option>Viewer</option>
                        </select>
                    </label>
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Tanggal kadaluarsa</span>
                        <input type="date" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                </div>

                <label class="space-y-2 block">
                    <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Pesan tambahan</span>
                    <textarea rows="3" placeholder="Sertakan pesan untuk penerima undangan..." class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition"></textarea>
                </label>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                        <span>Kirim email undangan otomatis</span>
                    </div>
                    <div class="flex gap-2">
                        <button class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                            Simpan draft
                        </button>
                        <button class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                            Kirim Undangan
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Template</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Pengaturan Email</h2>
                    </div>
                    <button class="text-sm text-cyan-600 hover:text-cyan-700">Kelola template</button>
                </div>
                <div class="space-y-3">
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Kirim salinan ke admin</p>
                            <p class="text-sm text-slate-500">Admin akan mendapat CC setiap undangan dikirim.</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500">
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Remind otomatis</p>
                            <p class="text-sm text-slate-500">Kirim pengingat jika undangan belum diterima setelah 3 hari.</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Status undangan</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Pending Invitations</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700">3 pending</span>
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
                        <p class="text-sm text-cyan-200/80">Tips</p>
                        <h2 class="text-xl font-semibold">Checklist Keamanan</h2>
                    </div>
                    <i class="fa-solid fa-shield-halved text-cyan-200"></i>
                </div>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Gunakan role minimal sesuai kebutuhan.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Atur kedaluwarsa undangan maksimal 7 hari.
                    </li>
                    <li class="flex items-start gap-2">
                        <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                        Aktifkan 2FA untuk admin.
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
