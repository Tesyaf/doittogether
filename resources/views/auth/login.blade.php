@extends('layouts.auth-layout')

@section('content')
<div>
  <h2 class="text-2xl font-semibold mb-1">Selamat datang kembali</h2>
  <p class="text-white/70 text-sm mb-6">Masuk ke akun Anda untuk melanjutkan</p>

  <form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

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

    <div x-data="{ show: false }">
      <label class="block text-sm text-white/70 mb-1">Kata Sandi</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••"
          class="w-full rounded-xl py-3 pl-10 pr-12 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />
        <div class="absolute left-3 top-1/2 -translate-y-1/2 opacity-70">
          <i class="fa-solid fa-lock text-white/70"></i>
        </div>
        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-white/60 hover:text-white/90">
          <span x-text="show ? 'Hide' : 'Show'"></span>
        </button>
      </div>
    </div>

    <div class="flex justify-between text-sm mt-2">
      <a href="{{ route('password.request') }}" class="text-white/70 hover:text-cyan-400">Lupa kata sandi?</a>
    </div>

    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-medium mt-2 hover:scale-[1.02] transition-transform">
      Masuk dengan Email
    </button>
  </form>

  <div class="my-4 flex items-center gap-3">
    <hr class="flex-1 border-white/10" />
    <span class="text-xs text-white/50">atau</span>
    <hr class="flex-1 border-white/10" />
  </div>

  <a href="{{ route('google.login') }}" class="w-full flex items-center justify-center gap-3 py-3 rounded-xl bg-white/10 border border-white/20 text-white font-medium hover:bg-white/20 transition">
    <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-5 h-5" alt="Google">
    <span>Lanjutkan dengan Google</span>
  </a>

  <p class="text-center text-white/70 text-sm mt-6">
    Belum punya akun? <a href="{{ route('register') }}" class="text-cyan-400 hover:underline">Daftar sekarang</a>
  </p>
</div>
@endsection
