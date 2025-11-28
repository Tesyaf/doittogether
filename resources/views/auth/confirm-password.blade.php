@extends('layouts.auth-layout')

@section('content')
<div>
  <h2 class="text-2xl font-semibold mb-1">Konfirmasi Password</h2>
  <p class="text-white/70 text-sm mb-6">Masukkan password untuk melanjutkan ke tindakan sensitif.</p>

  <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
    @csrf

    <div>
      <label class="block text-sm text-white/70 mb-1">Password</label>
      <input type="password" name="password" required placeholder="••••••••"
        class="w-full rounded-xl py-3 px-4 bg-white/5 border border-white/10 
               placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400 
               outline-none text-white" />
    </div>

    @error('password')
      <p class="text-red-400 text-sm">{{ $message }}</p>
    @enderror

    <button type="submit"
      class="w-full py-3 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 
             text-white font-semibold transition">
      Konfirmasi
    </button>

    <div class="text-center">
      <a href="{{ route('password.request') }}" class="text-sm text-cyan-400 hover:underline">
        Lupa password?
      </a>
    </div>
  </form>
</div>
@endsection
