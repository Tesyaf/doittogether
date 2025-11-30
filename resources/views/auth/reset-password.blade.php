@extends('layouts.auth-layout')

@section('content')
<div>
  <h2 class="text-2xl font-semibold mb-1">Atur Ulang Kata Sandi</h2>
  <p class="text-white/70 text-sm mb-6">
    Masukkan kata sandi baru untuk akun Anda.
  </p>

  @if ($errors->any())
      <div class="text-red-400 text-sm mb-3">
          <ul class="list-disc pl-5">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
    @csrf

    {{-- Token diperlukan untuk reset password --}}
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    {{-- Email --}}
    <div>
      <label class="block text-sm text-white/70 mb-1">Email</label>
      <div class="relative">
        <input type="email" name="email" required value="{{ old('email', $request->email) }}"
          class="w-full rounded-xl py-3 pl-10 pr-4 bg-white/5 border border-white/10 text-white placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none" />
        <div class="absolute left-3 top-1/2 -translate-y-1/2 opacity-70">
          <i class="fa-regular fa-envelope text-white/70"></i>
        </div>
      </div>
    </div>

    {{-- Password Baru --}}
    <div x-data="{ show: false }">
      <label class="block text-sm text-white/70 mb-1">Kata Sandi Baru</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••"
          class="w-full rounded-xl py-3 pl-10 pr-12 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />

        <div class="absolute left-3 top-1/2 -translate-y-1/2 opacity-70">
          <i class="fa-solid fa-lock text-white/70"></i>
        </div>

        <button type="button" @click="show = !show"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-white/60 hover:text-white/90">
          <span x-text="show ? 'Hide' : 'Show'"></span>
        </button>
      </div>
    </div>

    {{-- Konfirmasi Password --}}
    <div x-data="{ show: false }">
      <label class="block text-sm text-white/70 mb-1">Konfirmasi Kata Sandi</label>
      <div class="relative">
        <input :type="show ? 'text' : 'password'" name="password_confirmation" required placeholder="••••••••"
          class="w-full rounded-xl py-3 pl-10 pr-12 bg-white/5 border border-white/10 placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 outline-none text-white" />

        <div class="absolute left-3 top-1/2 -translate-y-1/2 opacity-70">
          <i class="fa-solid fa-lock text-white/70"></i>
        </div>

        <button type="button" @click="show = !show"
          class="absolute right-3 top-1/2 -translate-y-1/2 text-sm text-white/60 hover:text-white/90">
          <span x-text="show ? 'Hide' : 'Show'"></span>
        </button>
      </div>
    </div>

    {{-- Tombol Submit --}}
    <button type="submit"
      class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-medium hover:scale-[1.02] transition-transform">
      Simpan Kata Sandi Baru
    </button>
  </form>

  <p class="text-center text-white/70 text-sm mt-6">
    Kembali ke halaman <a href="{{ route('login') }}" class="text-cyan-400 hover:underline">Login</a>
  </p>
</div>
@endsection
