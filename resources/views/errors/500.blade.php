@extends('layouts.error', ['title' => '500 - Terjadi Kesalahan'])

@section('content')
<div class="bg-white/5 border border-white/10 rounded-3xl shadow-2xl p-8 md:p-12 space-y-6 text-center backdrop-blur">
    <div class="flex justify-center">
        <div class="h-16 w-16 rounded-full bg-orange-500/20 flex items-center justify-center">
            <i class="fa-solid fa-triangle-exclamation text-orange-300 text-2xl"></i>
        </div>
    </div>
    <div class="space-y-2">
        <p class="text-sm font-semibold text-orange-300">500</p>
        <h1 class="text-3xl md:text-4xl font-semibold">Terjadi kesalahan</h1>
        <p class="text-white/70">Maaf, ada kendala pada server. Silakan coba lagi beberapa saat.</p>
    </div>
    <div class="flex flex-wrap justify-center gap-3">
        <a href="{{ url()->previous() }}" class="px-5 py-3 rounded-full bg-white/10 hover:bg-white/20 transition text-white">Coba lagi</a>
        <a href="{{ route('dashboard') }}" class="px-5 py-3 rounded-full bg-cyan-500 hover:bg-cyan-600 transition text-white shadow-lg shadow-cyan-500/30">Ke Dashboard</a>
    </div>
</div>
@endsection
