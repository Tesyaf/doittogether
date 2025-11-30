@extends('layouts.user-app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-6">
    <div class="bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <p class="text-sm text-slate-300">Panel Admin</p>
            <h1 class="text-2xl md:text-3xl font-semibold text-white">Kelola Pengguna</h1>
            <p class="text-sm text-slate-400 mt-1">Promosi/downgrade admin dan pantau akun.</p>
        </div>
        <form method="GET" class="w-full md:w-72">
            <div class="flex items-center gap-2 bg-white/10 border border-white/20 rounded-xl px-3 py-2">
                <i class="fa-solid fa-magnifying-glass text-slate-300"></i>
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama/email" class="flex-1 bg-transparent text-slate-100 placeholder:text-slate-400 focus:outline-none">
            </div>
        </form>
    </div>
    <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-slate-200 hover:text-cyan-200 text-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
    </a>

    <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-4 sm:p-6 backdrop-blur-sm">
        <div class="overflow-hidden rounded-xl border border-slate-100/20">
            <table class="min-w-full divide-y divide-slate-100/20">
                <thead class="bg-slate-900/50">
                    <tr class="text-left text-xs font-semibold text-slate-300 uppercase tracking-wide">
                        <th class="px-4 py-3">Pengguna</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Admin</th>
                        <th class="px-4 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100/10 bg-slate-900/30">
                    @forelse($users as $user)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold overflow-hidden">
                                    @if($user->avatar_url)
                                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 2)) }}
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-400">ID: {{ $user->id }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <p class="text-sm text-slate-200">{{ $user->email }}</p>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $user->is_admin ? 'bg-emerald-500/20 text-emerald-100' : 'bg-slate-700 text-slate-200' }}">
                                {{ $user->is_admin ? 'Admin' : 'User' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <form method="POST" action="{{ route('admin.users.toggle', $user) }}" class="inline">
                                @csrf
                                <button class="px-3 py-2 rounded-lg border border-slate-200/30 text-slate-100 hover:border-cyan-500 hover:text-cyan-100 text-sm transition">
                                    {{ $user->is_admin ? 'Cabut Admin' : 'Jadikan Admin' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-slate-400">Tidak ada data pengguna.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection
