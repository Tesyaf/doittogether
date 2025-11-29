@extends('layouts.error', ['title' => '404 - Tidak Ditemukan'])

@section('content')
<div class="bg-white/5 border border-white/10 rounded-3xl shadow-2xl p-8 md:p-12 space-y-6 text-center backdrop-blur">
    <div class="flex justify-center">
        <div class="h-16 w-16 rounded-full bg-yellow-400/20 flex items-center justify-center">
            <i class="fa-solid fa-compass text-yellow-300 text-2xl"></i>
        </div>
    </div>
    <div class="space-y-2">
        <p class="text-sm font-semibold text-yellow-300">404</p>
        <h1 class="text-3xl md:text-4xl font-semibold">Halaman tidak ditemukan</h1>
        <p class="text-white/70">Link mungkin salah atau sudah dipindahkan.</p>
    </div>
    <div class="flex flex-wrap justify-center gap-3">
        <a href="{{ url()->previous() }}" class="px-5 py-3 rounded-full bg-white/10 hover:bg-white/20 transition text-white">Kembali</a>
        <a href="{{ route('dashboard') }}" class="px-5 py-3 rounded-full bg-cyan-500 hover:bg-cyan-600 transition text-white shadow-lg shadow-cyan-500/30">Ke Dashboard</a>
    </div>
</div>
@endsection
