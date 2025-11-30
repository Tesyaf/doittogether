@extends('layouts.team-app')

@section('content')
<div class="w-full max-w-5xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Kirim undangan anggota baru ke tim</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Invite Member</h1>
        </div>
        <div class="flex gap-3">
            <button type="reset" form="invite-form" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-rotate-right mr-2"></i> Reset
            </button>
            <button type="submit" form="invite-form" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Undangan
            </button>
        </div>
    </div>

    @if ($errors->any())
    <div class="rounded-xl border border-red-200 bg-red-50 text-red-800 px-4 py-3 text-sm space-y-1">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <a href="{{ route('teams.dashboard', $team) }}" class="inline-flex items-center gap-2 text-slate-700 dark:text-slate-200 hover:text-cyan-600 text-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard Tim
    </a>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <form id="invite-form" method="POST" action="{{ route('teams.invite.store', $team) }}" class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
                @csrf
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Form undangan</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Detail Member</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Auto-email</span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@doit.id" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Role undangan</span>
                        <select name="role" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                            <option value="member" @selected(old('role', 'member') === 'member')>Member (akses default)</option>
                            <option value="admin" @selected(old('role') === 'admin')>Admin (kelola anggota & data master)</option>
                        </select>
                    </label>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Tanggal kadaluarsa (opsional)</span>
                        <input type="date" name="expires_at" value="{{ old('expires_at') }}" class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pt-2">
                    <div class="flex items-center gap-2 text-sm text-slate-500">
                        <input type="checkbox" class="h-4 w-4 rounded border-slate-300 text-cyan-600 focus:ring-cyan-500" checked disabled>
                        <span>Kirim email undangan otomatis</span>
                    </div>
                    <div class="flex gap-2">
                        <button type="reset" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                            Reset
                        </button>
                        <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                            Kirim Undangan
                        </button>
                    </div>
                </div>
            </form>

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
                    <span class="text-xs px-2 py-1 rounded-full bg-amber-100 text-amber-700">{{ $pendingInvitations->count() }} pending</span>
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
                    <p class="text-sm text-slate-500">Belum ada undangan pending.</p>
                    @endforelse
                </div>
                <a href="{{ route('teams.invitations.pending', $team) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                    Lihat semua undangan
                </a>
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
