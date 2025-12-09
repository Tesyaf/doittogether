@extends('layouts.user-app')
@section('userSidebar', true)

@section('content')
@php($user = $user ?? auth()->user())
<div class="max-w-5xl mx-auto px-4 space-y-8">
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-slate-200 hover:text-cyan-200 text-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    {{-- HERO CARD --}}
    <div class="bg-gradient-to-br from-slate-900/80 via-slate-900 to-slate-900/80 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none" style="background: radial-gradient(circle at 20% 20%, rgba(14,165,233,0.12), transparent 35%), radial-gradient(circle at 80% 0%, rgba(59,130,246,0.12), transparent 30%);"></div>
        <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 p-[2px] shadow-lg overflow-hidden">
                    @if($user?->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="Avatar" class="h-full w-full rounded-2xl object-cover">
                    @else
                        <div class="h-full w-full rounded-2xl bg-slate-950 flex items-center justify-center text-2xl font-semibold text-white">
                            {{ strtoupper(substr($user?->name ?? 'U', 0, 2)) }}
                        </div>
                    @endif
                </div>
                <div>
                    <p class="text-sm text-slate-300">Profil</p>
                    <h1 class="text-2xl md:text-3xl font-semibold text-white">{{ $user?->name }}</h1>
                    <div class="flex flex-wrap items-center gap-2 mt-1 text-sm text-slate-300">
                        <i class="fa-solid fa-envelope text-cyan-400"></i>
                        <span>{{ $user?->email }}</span>
                        @if($user?->email_verified_at)
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-200 text-xs">
                                <i class="fa-solid fa-check-circle"></i> Verified
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-amber-500/20 text-amber-200 text-xs">
                                <i class="fa-solid fa-clock"></i> Belum verifikasi
                            </span>
                        @endif
                        @if($user?->google_calendar_refresh_token || $user?->google_calendar_access_token)
                            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/15 text-cyan-200 text-xs font-semibold">
                                <i class="fa-brands fa-google text-cyan-300"></i>
                                Google Calendar terhubung
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-semibold transition border border-white/10">
                    <i class="fa-solid fa-pen"></i> Edit Profil
                </a>
                <a href="{{ route('profile.edit') }}#password" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                    <i class="fa-solid fa-lock"></i> Ubah Password
                </a>
            </div>
        </div>
        <div class="relative mt-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Terdaftar</p>
                <p class="text-lg font-semibold text-white mt-1">{{ optional($user?->created_at)->format('d M Y') }}</p>
            </div>
            <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Terakhir diperbarui</p>
                <p class="text-lg font-semibold text-white mt-1">{{ optional($user?->updated_at)->diffForHumans() ?? 'baru saja' }}</p>
            </div>
            <div class="rounded-xl border border-white/10 bg-white/5 p-4">
                <p class="text-xs uppercase tracking-wide text-slate-400">Status verifikasi</p>
                <p class="text-lg font-semibold text-white mt-1">{{ $user?->email_verified_at ? 'Terverifikasi' : 'Menunggu verifikasi' }}</p>
            </div>
        </div>
    </div>

    {{-- DETAIL & SECURITY --}}
    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-2xl p-6 shadow-xl backdrop-blur-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-slate-300">Informasi Akun</p>
                    <h2 class="text-xl font-semibold text-white">Detail Utama</h2>
                </div>
            </div>
            <div class="divide-y divide-white/5">
                <div class="py-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wide">Nama Lengkap</p>
                        <p class="text-lg font-medium text-white">{{ $user?->name }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="text-sm text-cyan-300 hover:text-cyan-200">Ubah</a>
                </div>
                <div class="py-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wide">Email</p>
                        <p class="text-lg font-medium text-white">{{ $user?->email }}</p>
                    </div>
                    @if(!$user?->email_verified_at)
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-amber-500/20 text-amber-100 border border-amber-400/40 text-sm hover:bg-amber-500/30 transition">
                                <i class="fa-solid fa-paper-plane"></i> Kirim verifikasi
                            </button>
                        </form>
                    @else
                        <span class="text-xs text-emerald-200 bg-emerald-500/20 px-2 py-1 rounded-lg">Terverifikasi</span>
                    @endif
                </div>
                <div class="py-4 flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wide">Tanggal Dibuat</p>
                        <p class="text-lg font-medium text-white">{{ optional($user?->created_at)->format('d M Y') }}</p>
                    </div>
                    <span class="text-sm text-slate-400">ID: {{ $user?->id }}</span>
                </div>
            </div>
        </div>

        <div class="bg-slate-900 border border-white/10 rounded-2xl p-6 shadow-xl space-y-4">
            <div>
                <p class="text-sm text-cyan-200/80">Keamanan</p>
                <h2 class="text-xl font-semibold text-white">Langkah Aman</h2>
                <p class="text-sm text-slate-400 mt-1">Pastikan data dan akses akun tetap terlindungi.</p>
            </div>
            <ul class="space-y-3 text-sm text-slate-200">
                <li class="flex items-start gap-3">
                    <span class="h-2.5 w-2.5 rounded-full bg-cyan-400 mt-1"></span>
                    Gunakan password unik dan panjang.
                </li>
                <li class="flex items-start gap-3">
                    <span class="h-2.5 w-2.5 rounded-full bg-cyan-400 mt-1"></span>
                    Periksa status verifikasi email sebelum mengundang anggota.
                </li>
                <li class="flex items-start gap-3">
                    <span class="h-2.5 w-2.5 rounded-full bg-cyan-400 mt-1"></span>
                    Update profil secara berkala agar tim mudah mengenali Anda.
                </li>
            </ul>
            <div class="pt-2">
                <a href="{{ route('profile.edit') }}#password" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition w-full justify-center">
                    Kelola Password
                </a>
            </div>
        </div>

        <div class="bg-white/5 border border-white/10 rounded-2xl p-6 shadow-xl backdrop-blur-sm space-y-3">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-300">Integrasi</p>
                    <h2 class="text-xl font-semibold text-white">Google Calendar (API)</h2>
                </div>
                @if($user->google_calendar_refresh_token || $user->google_calendar_access_token)
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/20 text-emerald-100 text-xs font-semibold">
                        <i class="fa-solid fa-check-circle"></i> Terhubung
                    </span>
                @endif
            </div>
            @if($user->google_calendar_refresh_token || $user->google_calendar_access_token)
                <div class="rounded-lg border border-emerald-500/30 bg-emerald-500/10 text-emerald-100 text-sm px-3 py-2 flex items-start gap-2">
                    <i class="fa-solid fa-circle-check mt-0.5"></i>
                    <div>
                        <p class="font-semibold">Akun Google terhubung</p>
                        <p class="text-emerald-100/80">Sinkronkan tugas ke kalender Google Anda kapan saja.</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('calendar.sync') }}" class="flex flex-wrap gap-2">
                    @csrf
                    <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                        <i class="fa-solid fa-arrows-rotate"></i> Sinkronisasi sekarang
                    </button>
                </form>
                <form method="POST" action="{{ route('calendar.disconnect') }}" class="mt-2">
                    @csrf
                    <button class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-red-400/50 text-red-200 text-xs hover:bg-red-500/10 transition">
                        Putuskan koneksi
                    </button>
                </form>
            @else
                <p class="text-sm text-slate-400">Sambungkan akun Google untuk membuat/menyegarkan event deadline tugas di kalender Google Anda.</p>
                <a href="{{ route('calendar.connect') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                    <i class="fa-brands fa-google"></i> Sambungkan Google Calendar
                </a>
            @endif
        </div>
    </div>
</div>
@endsection
