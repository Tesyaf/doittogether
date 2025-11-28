@extends('layouts.user-app')

@section('content')

<div class="max-w-3xl mx-auto space-y-10">

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
    <div class="p-4 bg-green-500/20 border border-green-500/30 rounded-xl text-green-300">
        {{ session('success') }}
    </div>
    @endif

    {{-- CARD SHOW PROFILE --}}
    <div class="bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">

        <h2 class="text-xl font-semibold mb-1">Profil Saya</h2>
        <p class="text-white/60 text-sm mb-6">Informasi dasar akun kamu.</p>

        <div class="space-y-4">

            <div>
                <p class="text-white/50 text-xs">Nama Lengkap</p>
                <p class="text-lg font-medium">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-white/50 text-xs">Email</p>
                <p class="text-lg font-medium">{{ $user->email }}</p>
            </div>

            <div>
                <p class="text-white/50 text-xs">Tanggal Dibuat</p>
                <p class="text-lg font-medium">{{ $user->created_at->format('d M Y') }}</p>
            </div>

        </div>

        <div class="mt-6 flex gap-3">
            <a href="{{ route('profile.edit') }}"
                class="px-5 py-2 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 transition font-semibold">
                Edit Profil
            </a>

            <a href="{{ route('profile.edit') }}#password"
                class="px-5 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition">
                Ubah Password
            </a>
        </div>

    </div>

</div>

@endsection