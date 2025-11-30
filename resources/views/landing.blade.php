{{-- resources/views/landing.blade.php --}}
@extends('layouts.app')

@section('title', 'DoItTogether – Work on tasks together')

@section('content')
<div class="w-full px-4">
    <div
        class="max-w-5xl mx-auto grid gap-10 lg:grid-cols-[3fr,2fr] items-center
               bg-slate-900/80 border border-slate-800 rounded-3xl shadow-xl
               px-6 py-8 sm:px-10 sm:py-10">

        {{-- Hero Text --}}
        <section class="space-y-6 text-white">
            <p class="inline-flex items-center gap-2 text-xs font-medium px-3 py-1 rounded-full
                       bg-slate-800 border border-slate-700 text-cyan-300">
                <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                Kolaborasi tugas bareng tim
            </p>

            <div class="space-y-3">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight">
                    Kelola tugas tim dengan<br>
                    <span class="text-cyan-400">alur simpel</span> dan tampilan modern.
                </h1>
                <p class="text-sm sm:text-base text-slate-300 max-w-xl">
                    DoItTogether membantu kamu dan tim mengatur task, deadline, dan tanggung jawab
                    dalam satu workspace. Mirip Discord, tapi untuk kerjaan.
                </p>
            </div>

            <div class="flex flex-wrap gap-3 pt-2">
                <a href="{{ route('register') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl
                          bg-cyan-500 hover:bg-cyan-600 text-sm font-semibold text-slate-950
                          shadow-lg shadow-cyan-500/30 transition">
                    Mulai Gratis
                    <i class="fa-solid fa-arrow-right-long text-xs"></i>
                </a>

                <a href="{{ route('login') }}"
                   class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl
                          border border-slate-600 bg-slate-900/60 hover:bg-slate-800
                          text-sm font-medium text-slate-100 transition">
                    Saya sudah punya akun
                </a>
            </div>

            <div class="flex flex-wrap gap-4 text-xs text-slate-400 pt-3">
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Real-time kolaborasi tugas
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Board kanban per tim
                </div>
                <div class="flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-cyan-400"></span>
                    Komentar & lampiran tugas
                </div>
            </div>
        </section>

        {{-- Hero "Preview" / Card --}}
        <section
            class="bg-slate-950/70 border border-slate-800 rounded-2xl p-5 sm:p-6 text-slate-100
                   flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-slate-400">Contoh tim</p>
                    <p class="text-sm font-semibold">Ilkom Project Team</p>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-semibold
                             bg-emerald-500/20 text-emerald-300 border border-emerald-400/40">
                    4 tugas aktif
                </span>
            </div>

            <div class="space-y-2 text-xs">
                <p class="text-slate-400 mb-1">Task Board (preview)</p>
                <div class="grid grid-cols-3 gap-2">
                    <div class="bg-slate-900 rounded-xl p-2 space-y-1">
                        <p class="text-[10px] font-semibold text-slate-200 mb-1">Ongoing</p>
                        <div class="bg-slate-800 rounded-lg px-2 py-1">
                            <p class="text-[11px] font-medium">Setup database</p>
                            <p class="text-[10px] text-slate-400">Due: besok</p>
                        </div>
                        <div class="bg-slate-800 rounded-lg px-2 py-1">
                            <p class="text-[11px] font-medium">API auth</p>
                            <p class="text-[10px] text-slate-400">Due: 3 hari lagi</p>
                        </div>
                    </div>
                    <div class="bg-slate-900 rounded-xl p-2 space-y-1">
                        <p class="text-[10px] font-semibold text-slate-200 mb-1">Done</p>
                        <div class="bg-slate-800 rounded-lg px-2 py-1 opacity-80">
                            <p class="text-[11px] font-medium line-through">Rancang ERD</p>
                        </div>
                    </div>
                    <div class="bg-slate-900 rounded-xl p-2 space-y-1">
                        <p class="text-[10px] font-semibold text-slate-200 mb-1">Next</p>
                        <div class="bg-slate-800 rounded-lg px-2 py-1">
                            <p class="text-[11px] font-medium">UI task detail</p>
                            <p class="text-[10px] text-slate-400">Belum dijadwalkan</p>
                        </div>
                    </div>
                </div>
            </div>

            <p class="mt-2 text-[11px] text-slate-400">
                Tugas, anggota tim, dan aktivitas terpusat dalam satu tampilan.
            </p>
        </section>
    </div>
</div>
@endsection
