@extends('layouts.auth-layout')

@section('content')
<div>
    <h2 class="text-2xl font-semibold mb-1">Lupa Kata Sandi?</h2>
    <p class="text-white/70 text-sm mb-6">
        Masukkan email akunmu dan kami akan mengirim tautan untuk mengatur ulang kata sandi.
    </p>

    {{-- Form Lupa Password --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        {{-- Email --}}
        <div>
            <label class="block text-sm text-white/70 mb-1">Email</label>
            <div class="relative">
                <input type="email" name="email" required placeholder="nama@example.com"
                    class="w-full rounded-xl py-3 pl-10 pr-4 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />
                <div class="absolute left-3 top-1/2 -translate-y-1/2 opacity-70">
                    <i class="fa-regular fa-envelope text-white/70"></i>
                </div>
            </div>
        </div>

        {{-- Tombol Kirim --}}
        <button type="submit"
            class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-medium hover:scale-[1.02] transition-transform">
            Kirim Tautan Reset
        </button>
    </form>
    @if (session('status'))
    <div class="text-center text-cyan-400 mt-4 text-sm">
        {{ session('status') }}
    </div>
    @endif

    {{-- Kembali ke login --}}
    <p class="text-center text-white/70 text-sm mt-6">
        Sudah ingat kata sandi? <a href="{{ route('login') }}" class="text-cyan-400 hover:underline">Masuk di sini</a>
    </p>
</div>
@endsection