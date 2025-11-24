@extends('layouts.auth-layout')

@section('content')
<div>
  <h2 class="text-2xl font-semibold mb-1">Verifikasi Email Anda</h2>
  <p class="text-white/70 text-sm mb-6">
    Sebelum melanjutkan, silakan cek email kamu untuk tautan verifikasi.<br>
    Jika belum menerima emailnya, kamu bisa meminta ulang di bawah ini.
  </p>

  {{-- Notifikasi jika link verifikasi baru sudah dikirim --}}
  @if (session('status') == 'verification-link-sent')
    <div class="text-cyan-400 text-sm mb-4">
      Tautan verifikasi baru telah dikirim ke email Anda.
    </div>
  @endif

  {{-- Form kirim ulang email verifikasi --}}
  <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
    @csrf

    <button type="submit"
      class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 text-white font-medium hover:scale-[1.02] transition-transform">
      Kirim Ulang Email Verifikasi
    </button>
  </form>

  {{-- Tombol logout --}}
  <form method="POST" action="{{ route('logout') }}" class="mt-4 text-center">
    @csrf
    <button type="submit" class="text-white/70 hover:text-cyan-400 text-sm">
      Logout
    </button>
  </form>

  {{-- Kembali ke login --}}
  <p class="text-center text-white/70 text-sm mt-6">
    Sudah memverifikasi email? <a href="{{ route('login') }}" class="text-cyan-400 hover:underline">Masuk di sini</a>
  </p>
</div>
@endsection
