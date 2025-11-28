@extends('layouts.user-app')

@section('content')
@php($user = $user ?? auth()->user())
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl flex flex-col md:flex-row md:items-center md:justify-between gap-6">
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
                <p class="text-sm text-slate-300">Edit Profil</p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white">Kelola Data Akun</h1>
                <p class="text-sm text-slate-400 mt-1">Perbarui identitas, foto, dan keamanan akun.</p>
            </div>
        </div>
        <div class="flex items-center gap-3 text-sm text-slate-300">
            <i class="fa-solid fa-clock text-cyan-300"></i>
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400">Terakhir diperbarui</p>
                <p class="font-medium text-white">{{ optional($user?->updated_at)->diffForHumans() ?? 'baru saja' }}</p>
            </div>
        </div>
    </div>
    <a href="{{ route('profile.show') }}" class="inline-flex items-center gap-2 text-slate-200 hover:text-cyan-200 text-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Profil
    </a>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 bg-white/5 border border-white/10 rounded-2xl shadow-xl p-6 backdrop-blur-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-slate-300">Identitas</p>
                    <h2 class="text-xl font-semibold text-white">Data Pengguna</h2>
                </div>
                @if (session('status') === 'profile-updated')
                <span class="text-sm font-medium text-emerald-200 bg-emerald-500/20 px-3 py-1 rounded-lg">Perubahan tersimpan</span>
                @endif
            </div>

            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-200">Nama Lengkap</span>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user?->name) }}"
                            required
                            autocomplete="name"
                            class="w-full rounded-lg border border-slate-200/40 bg-slate-950/70 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                        @error('name')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-200">Email</span>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user?->email) }}"
                            required
                            autocomplete="username"
                            class="w-full rounded-lg border border-slate-200/40 bg-slate-950/70 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                        @error('email')
                        <p class="text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="space-y-3" x-data="{ preview: '{{ $user?->avatar_url ?? '' }}' }">
                    <span class="block text-sm font-medium text-slate-200">Avatar</span>
                    <div class="flex items-center gap-4">
                        <div class="relative h-16 w-16">
                            <div class="h-16 w-16 overflow-hidden rounded-full border border-slate-200/40 bg-slate-800 flex items-center justify-center">
                                <img x-show="preview" x-bind:src="preview" alt="Avatar preview" class="h-full w-full object-cover">
                                <span x-show="!preview" class="text-xs font-semibold text-slate-500">No Photo</span>
                            </div>
                        </div>
                        <div class="space-y-1.5">
                            <label class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-semibold shadow hover:from-cyan-600 hover:to-blue-700 cursor-pointer transition">
                                <input
                                    type="file"
                                    name="avatar"
                                    accept="image/*"
                                    class="sr-only"
                                    x-ref="avatar"
                                    @change="const [file] = $event.target.files; if (file) { preview = URL.createObjectURL(file); }">
                                <span>Upload foto</span>
                            </label>
                            <p class="text-xs text-slate-400">Format JPG/PNG maks 2MB.</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="text-sm text-slate-400">
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-lg bg-amber-500/20 text-amber-100 text-xs">Belum verifikasi</span>
                            <button form="send-verification" class="underline text-slate-100 hover:text-cyan-200">Kirim ulang verifikasi</button>
                        </div>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-lg bg-emerald-500/20 text-emerald-100 text-xs">Email terverifikasi</span>
                        @endif
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-slate-900 text-slate-50 rounded-2xl shadow-xl p-6 flex flex-col gap-4">
            <div>
                <p class="text-sm text-cyan-200/80">Keamanan</p>
                <h2 class="text-xl font-semibold">Ganti Password</h2>
                <p class="text-sm text-slate-300 mt-1">Pastikan password kuat dan tidak digunakan di tempat lain.</p>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-200" for="current_password">Password Saat Ini</label>
                    <input
                        id="current_password"
                        name="current_password"
                        type="password"
                        autocomplete="current-password"
                        class="w-full rounded-lg border border-slate-700 bg-slate-800 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-400 focus:border-blue-300 transition">
                    @if ($errors->updatePassword->has('current_password'))
                    <p class="text-sm text-red-400">{{ $errors->updatePassword->first('current_password') }}</p>
                    @endif
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-200" for="password">Password Baru</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-lg border border-slate-700 bg-slate-800 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-400 focus:border-blue-300 transition">
                    @if ($errors->updatePassword->has('password'))
                    <p class="text-sm text-red-400">{{ $errors->updatePassword->first('password') }}</p>
                    @endif
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-slate-200" for="password_confirmation">Konfirmasi Password</label>
                    <input
                        id="password_confirmation"
                        name="password_confirmation"
                        type="password"
                        autocomplete="new-password"
                        class="w-full rounded-lg border border-slate-700 bg-slate-800 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-400 focus:border-blue-300 transition">
                    @if ($errors->updatePassword->has('password_confirmation'))
                    <p class="text-sm text-red-400">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div class="flex flex-col gap-2">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                        Perbarui Password
                    </button>
                    @if (session('status') === 'password-updated')
                    <p class="text-sm text-cyan-200">Password berhasil diperbarui.</p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
