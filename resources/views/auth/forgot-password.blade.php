@extends('layouts.auth-layout')

@section('content')
<div>

  {{-- Title --}}
  <h2 class="text-2xl font-semibold mb-1">Lupa Password?</h2>
  <p class="text-white/70 text-sm mb-6">
    Masukkan email kamu dan kami akan kirim tautan untuk mengatur ulang password.
  </p>

  {{-- Status (jika berhasil kirim link reset) --}}
  @if (session('status'))
      <div class="mb-4 text-sm text-cyan-400">
          {{ session('status') }}
      </div>
  @endif

  {{-- Form --}}
  <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
      @csrf

      {{-- Email --}}
      <div>
        <label class="block text-sm text-white/70 mb-1">Email</label>
        <input type="email" name="email" required autofocus 
            placeholder="contoh@email.com"
            class="w-full rounded-xl py-3 px-4 bg-white/5 border border-white/10
                   placeholder:text-white/40 focus:ring-2 focus:ring-cyan-400
                   outline-none text-white" />

        @error('email')
            <p class="text-sm text-red-400 mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Submit --}}
      <button type="submit"
          class="w-full py-3 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 
                 text-white font-semibold transition">
          Kirim Link Reset Password
      </button>
  </form>

  {{-- Back to login --}}
  <div class="text-center mt-4">
    <a href="{{ route('login') }}" 
       class="text-sm text-cyan-400 hover:underline">
      Kembali ke halaman login
    </a>
  </div>

</div>
@endsection