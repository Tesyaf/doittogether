@extends('layouts.team-app')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <a href="{{ route('teams.dashboard', $team->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-bold text-white mt-2">Integrasi GitHub</h1>
            <p class="text-sm text-white/60">Sambungkan satu repo GitHub untuk tim ini. Hanya owner / admin aplikasi yang dapat mengatur.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('repositories.commits', $team->id) }}"
                class="inline-flex items-center px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-sm font-semibold border border-white/20 transition">
                <i class="fa-solid fa-clock-rotate-left mr-2"></i> Lihat commits
            </a>
            @if(!empty($githubInstallUrl))
            <a href="{{ $githubInstallUrl }}" target="_blank"
                class="inline-flex items-center px-4 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-600 text-white text-sm font-semibold shadow transition">
                <i class="fa-brands fa-github mr-2"></i> Install GitHub App
            </a>
            @endif
        </div>
    </div>

    <form method="POST" action="{{ route('repositories.upsert', $team->id) }}" class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 space-y-5 backdrop-blur-sm">
        @csrf
        <div class="flex items-center justify-between mb-2">
            <div>
                <p class="text-sm text-white/60">Koneksi repo</p>
                <h2 class="text-xl font-semibold text-white">Repo GitHub</h2>
            </div>
            @if($repository)
            <span class="text-xs px-3 py-1 rounded-full bg-green-500/20 text-green-200 border border-green-500/30">Tersambung</span>
            @else
            <span class="text-xs px-3 py-1 rounded-full bg-white/10 text-white border border-white/20">Belum tersambung</span>
            @endif
        </div>

        <div class="space-y-4">
            <label class="block space-y-2">
                <span class="block text-sm font-medium text-white">Repo (owner/nama-repo) *</span>
                <input type="text" name="repo_full_name" value="{{ old('repo_full_name', $repository->repo_full_name ?? '') }}" required
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/50 focus:border-cyan-500 focus:outline-none transition"
                    placeholder="contoh: orgku/nama-repo">
                @error('repo_full_name')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
            </label>

            <label class="block space-y-2">
                <span class="block text-sm font-medium text-white">Branch utama (opsional)</span>
                <input type="text" name="branch" value="{{ old('branch', $repository->branch ?? '') }}"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/50 focus:border-cyan-500 focus:outline-none transition"
                    placeholder="main / master / develop">
                @error('branch')
                <p class="text-red-400 text-sm">{{ $message }}</p>
                @enderror
                <p class="text-xs text-white/50">Hanya untuk penandaan; semua push event tetap dicatat.</p>
            </label>
        </div>

        <div class="flex flex-wrap gap-3 pt-2">
            <button type="submit" class="inline-flex items-center px-5 py-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold">
                <i class="fa-solid fa-link mr-2"></i> Simpan Koneksi
            </button>
        </div>
    </form>

    @if($repository)
    <form method="POST" action="{{ route('repositories.disconnect', $team->id) }}" onsubmit="return confirm('Putuskan integrasi repo ini? Semua data commit tersimpan akan ikut terhapus.');" class="inline-block">
        @csrf
        @method('DELETE')
        <button type="submit" class="inline-flex items-center px-5 py-3 rounded-lg bg-red-500/20 hover:bg-red-500/30 text-red-200 font-semibold border border-red-500/40 transition">
            <i class="fa-solid fa-unlink mr-2"></i> Putuskan
        </button>
    </form>
    @endif

    @if($repository && $webhookUrl)
    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 space-y-3 backdrop-blur-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-white/60">Langkah di GitHub</p>
                <h2 class="text-xl font-semibold text-white">Konfigurasi Webhook</h2>
            </div>
            <span class="text-xs px-3 py-1 rounded-full bg-white/10 text-white border border-white/20">Event: push</span>
        </div>
        <ol class="list-decimal list-inside space-y-2 text-white/80 text-sm">
            <li>Install GitHub App ke repo <code class="bg-white/10 px-2 py-1 rounded">{{ $repository->repo_full_name }}</code>@if(!empty($githubInstallUrl)) (gunakan tombol di atas)@endif.</li>
            <li>Pastikan GitHub App di-set untuk event <span class="font-semibold">push</span>.</li>
            <li>Webhook URL App: <code class="bg-white/10 px-2 py-1 rounded break-all">{{ route('webhooks.github.app') }}</code></li>
            <li>Webhook secret App: <code class="bg-white/10 px-2 py-1 rounded">{{ config('services.github_app.webhook_secret') ?: 'ENV GITHUB_APP_WEBHOOK_SECRET' }}</code></li>
        </ol>
        <p class="text-xs text-white/50">App akan otomatis mengirim push event; tidak perlu menambah webhook manual per repo.</p>
    </div>
    @endif
</div>
@endsection
