@extends('layouts.auth-layout')

@section('content')
<div>
  <h2 class="text-2xl font-semibold mb-1">Daftar untuk Mengelola Tugasmu</h2>
  <p class="text-white/70 text-sm mb-6">Isi data di bawah untuk membuat akun baru.</p>

  <form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <div>
      <label class="block text-sm text-white/70 mb-1">Nama Lengkap</label>
      <input type="text" name="name" required placeholder="Nama kamu"
        class="w-full rounded-xl py-3 px-4 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />
    </div>

    <div>
      <label class="block text-sm text-white/70 mb-1">Email</label>
      <input type="email" name="email" required placeholder="nama@example.com"
        class="w-full rounded-xl py-3 px-4 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />
    </div>

    <div x-data="{ show: false }">
      <label class="block text-sm text-white/70 mb-1">Kata Sandi</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••"
          class="w-full rounded-xl py-3 px-4 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />
        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-white/60 hover:text-white/90">
          <span x-text="show ? 'Hide' : 'Show'"></span>
        </button>
      </div>
    </div>

    <div x-data="{ show: false }">
      <label class="block text-sm text-white/70 mb-1">Konfirmasi Kata Sandi</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" name="password_confirmation" required placeholder="••••••••"
          class="w-full rounded-xl py-3 px-4 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />
        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-white/60 hover:text-white/90">
          <span x-text="show ? 'Hide' : 'Show'"></span>
        </button>
      </div>
    </div>

    <button type="submit" class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-medium hover:scale-[1.02] transition-transform">
      Daftar Sekarang
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
    Sudah punya akun? <a href="{{ route('login') }}" class="text-cyan-400 hover:underline">Masuk di sini</a>
  </p>
</div>
@endsection
