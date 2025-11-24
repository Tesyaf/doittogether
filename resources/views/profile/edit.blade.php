@extends('layouts.app')

@section('content')
@php($user = $user ?? auth()->user())
<div class="w-full max-w-6xl mx-auto px-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <p class="text-sm text-slate-500">Kelola profil dan keamanan akunmu</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">User Profile</h1>
        </div>
        <div class="flex items-center gap-3">
            <div class="h-14 w-14 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 p-[2px] shadow-lg">
                <div class="h-full w-full rounded-full bg-white dark:bg-slate-900 flex items-center justify-center text-lg font-semibold text-slate-700 dark:text-white">
                    {{ strtoupper(substr($user?->name ?? 'U', 0, 2)) }}
                </div>
            </div>
            <div class="text-right">
                <p class="text-xs text-slate-500">Terakhir diperbarui</p>
                <p class="text-sm font-medium text-slate-800 dark:text-slate-100">{{ optional($user?->updated_at)->diffForHumans() ?? 'baru saja' }}</p>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <p class="text-sm text-slate-500">Identitas</p>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Data Pengguna</h2>
                </div>
                @if (session('status') === 'profile-updated')
                <span class="text-sm font-medium text-cyan-600">Perubahan tersimpan</span>
                @endif
            </div>

            <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Nama Lengkap</span>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user?->name) }}"
                            required
                            autocomplete="name"
                            class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition"
                        >
                        @error('name')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>

                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Email</span>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user?->email) }}"
                            required
                            autocomplete="username"
                            class="w-full rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-950 px-4 py-2.5 text-slate-800 dark:text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition"
                        >
                        @error('email')
                        <p class="text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </label>
                </div>

                <div class="space-y-3" x-data="{ preview: '{{ $user?->avatar_url ?? '' }}' }">
                    <span class="block text-sm font-medium text-slate-700 dark:text-slate-200">Avatar</span>
                    <div class="flex items-center gap-4">
                        <div class="relative h-16 w-16">
                            <div class="h-16 w-16 overflow-hidden rounded-full border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800 flex items-center justify-center">
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
                                    @change="const [file] = $event.target.files; if (file) { preview = URL.createObjectURL(file); }"
                                >
                                <span>Upload foto</span>
                            </label>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Format JPG/PNG maks 2MB.</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="text-sm text-slate-500">
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div>
                            Email belum terverifikasi.
                            <button form="send-verification" class="underline text-slate-700 dark:text-slate-200 hover:text-blue-600">Kirim ulang verifikasi</button>
                        </div>
                        @endif
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-5 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition"
                    >
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
                        class="w-full rounded-lg border border-slate-700 bg-slate-800 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-400 focus:border-blue-300 transition"
                    >
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
                        class="w-full rounded-lg border border-slate-700 bg-slate-800 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-400 focus:border-blue-300 transition"
                    >
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
                        class="w-full rounded-lg border border-slate-700 bg-slate-800 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-400 focus:border-blue-300 transition"
                    >
                    @if ($errors->updatePassword->has('password_confirmation'))
                    <p class="text-sm text-red-400">{{ $errors->updatePassword->first('password_confirmation') }}</p>
                    @endif
                </div>

                <div class="flex flex-col gap-2">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition"
                    >
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
