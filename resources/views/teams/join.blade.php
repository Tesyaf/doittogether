@extends('layouts.user-app')

@section('content')
<div class="w-full max-w-4xl mx-auto px-4 space-y-6">
    <div class="bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
            <div>
                <p class="text-sm text-slate-300">Gabung Tim</p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white">Masukkan Kode Undangan</h1>
                <p class="text-sm text-slate-400 mt-1">Tempel kode undangan yang kamu terima untuk bergabung ke tim.</p>
            </div>
            <a href="{{ route('teams.index') }}" class="inline-flex items-center gap-2 text-slate-200 hover:text-cyan-200 text-sm">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke daftar tim
            </a>
        </div>

        <form method="POST" action="{{ route('teams.join.submit') }}" class="space-y-5">
            @csrf
            <div>
                <label for="code" class="block text-sm text-slate-200 mb-2">Kode undangan</label>
                <div class="flex flex-col gap-3 md:flex-row">
                    <input
                        type="text"
                        id="code"
                        name="code"
                        value="{{ old('code', $prefillCode) }}"
                        placeholder="Contoh: 1ea8049b-c058-46b5-95f5-59b6f24f9ac7"
                        class="flex-1 rounded-xl py-3 px-4 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white"
                        required
                    />
                    <button type="submit" class="px-5 py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow-lg hover:from-cyan-600 hover:to-blue-700 transition">
                        Gabung
                    </button>
                </div>
                @error('code')
                    <p class="text-red-300 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-slate-300">
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <div class="flex items-center gap-2 font-semibold text-white mb-1">
                        <i class="fa-solid fa-envelope-open-text text-cyan-300"></i>
                        Gunakan kode terbaru
                    </div>
                    Pastikan kode belum kedaluwarsa atau dibatalkan.
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <div class="flex items-center gap-2 font-semibold text-white mb-1">
                        <i class="fa-solid fa-user-check text-emerald-300"></i>
                        Email harus sama
                    </div>
                    Kode hanya bisa dipakai oleh email tujuan undangan.
                </div>
                <div class="p-4 rounded-2xl bg-white/5 border border-white/10">
                    <div class="flex items-center gap-2 font-semibold text-white mb-1">
                        <i class="fa-solid fa-shield-halved text-blue-300"></i>
                        Sudah diverifikasi
                    </div>
                    Pastikan akun kamu sudah login dan terverifikasi.
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
