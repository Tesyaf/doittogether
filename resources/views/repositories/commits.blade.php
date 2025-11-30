@extends('layouts.team-app')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <a href="{{ route('teams.dashboard', $team->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <h1 class="text-3xl font-bold text-white mt-2">Commits GitHub</h1>
            <p class="text-sm text-white/60">Riwayat commit dari repo yang terhubung ke tim ini.</p>
        </div>
        @if($isTeamOwnerOrAppAdmin)
        <a href="{{ route('repositories.edit', $team->id) }}"
            class="inline-flex items-center px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-sm font-semibold border border-white/20 transition">
            <i class="fa-solid fa-gear mr-2"></i> Kelola Integrasi
        </a>
        @endif
    </div>

    @if(!$repository)
    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 backdrop-blur-sm text-center">
        <i class="fa-brands fa-github text-5xl text-white/30 mb-3 block"></i>
        <p class="text-white/80 text-lg font-semibold mb-2">Belum ada repo yang tersambung</p>
        <p class="text-white/60 text-sm mb-4">Owner dapat menyambungkan satu repo GitHub agar setiap push tercatat di sini.</p>
        @if($isTeamOwnerOrAppAdmin)
        <a href="{{ route('repositories.edit', $team->id) }}" class="inline-flex items-center px-5 py-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold">
            <i class="fa-solid fa-link mr-2"></i> Sambungkan Repo
        </a>
        @endif
    </div>
    @else
    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 backdrop-blur-sm space-y-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
            <div>
                <p class="text-sm text-white/60">Repo terhubung</p>
                <h2 class="text-xl font-semibold text-white flex items-center gap-2">
                    <i class="fa-brands fa-github"></i> {{ $repository->repo_full_name }}
                </h2>
                <p class="text-xs text-white/50">Branch utama: {{ $repository->branch ?? 'tidak ditentukan' }}</p>
            </div>
            @if($webhookUrl)
            <div class="text-xs text-white/70 bg-white/5 border border-white/10 rounded-xl p-3">
                <div class="font-semibold text-white mb-1">Webhook</div>
                <div class="space-y-1">
                    <div>URL: <code class="bg-white/10 px-2 py-1 rounded break-all">{{ $webhookUrl }}</code></div>
                    @if($isTeamOwnerOrAppAdmin)
                    <div>Secret: <code class="bg-white/10 px-2 py-1 rounded break-all">{{ $repository->webhook_secret }}</code></div>
                    @endif
                    <div>Event: push</div>
                </div>
            </div>
            @endif
        </div>

        @if(!$commits || $commits->isEmpty())
        <div class="text-center py-10 border border-dashed border-white/10 rounded-xl bg-white/5">
            <i class="fa-solid fa-code-commit text-4xl text-white/30 mb-3 block"></i>
            <p class="text-white/70 mb-2">Belum ada commit yang tercatat.</p>
            <p class="text-sm text-white/60">Pastikan webhook GitHub sudah diatur dan lakukan push untuk melihat data di sini.</p>
        </div>
        @else
        <div class="overflow-hidden rounded-xl border border-white/10">
            <table class="min-w-full bg-white/5">
                <thead class="bg-white/10 text-white/70 text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-4 py-3 text-left">Message</th>
                        <th class="px-4 py-3 text-left">Commit</th>
                        <th class="px-4 py-3 text-left">Author</th>
                        <th class="px-4 py-3 text-left">Branch</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-sm">
                    @foreach($commits as $commit)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-4 py-3 text-white">
                            <p class="font-semibold">{{ \Illuminate\Support\Str::limit($commit->message, 120) }}</p>
                        </td>
                        <td class="px-4 py-3 text-white/80">
                            @if($commit->html_url)
                            <a href="{{ $commit->html_url }}" target="_blank" class="text-cyan-400 hover:text-cyan-300">
                                {{ substr($commit->sha, 0, 7) }}
                            </a>
                            @else
                            <span class="font-mono">{{ substr($commit->sha, 0, 7) }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-white/80">
                            <div>{{ $commit->author_name ?? 'Unknown' }}</div>
                            @if($commit->author_email)
                            <div class="text-xs text-white/50">{{ $commit->author_email }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-white/70">{{ $commit->branch ?? '-' }}</td>
                        <td class="px-4 py-3 text-white/70">{{ optional($commit->committed_at)->format('d M Y H:i') ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($commits->hasPages())
        <div class="mt-4">
            {{ $commits->links() }}
        </div>
        @endif
        @endif
    </div>
    @endif
</div>
@endsection
