@extends('layouts.app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-10">
    <div class="grid gap-8 lg:grid-cols-2 items-center">
        <div class="space-y-4">
            <p class="text-sm text-cyan-600 font-semibold">Tentang Kami</p>
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white leading-tight">Kolaborasi lebih mudah, tim lebih produktif.</h1>
            <p class="text-base text-slate-600 dark:text-slate-300">
                DoItTogether membantu tim merencanakan, mengeksekusi, dan merilis lebih cepat dengan alur kerja terpadu. Kami fokus pada pengalaman kolaborasi yang sederhana, transparan, dan aman.
            </p>
            <div class="flex flex-wrap gap-3">
                <button class="inline-flex items-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                    Mulai sekarang
                </button>
                <button class="inline-flex items-center px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                    Lihat demo
                </button>
            </div>
            <div class="grid grid-cols-3 gap-4 pt-2">
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">120+</p>
                    <p class="text-sm text-slate-500">Tim aktif</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">98%</p>
                    <p class="text-sm text-slate-500">Kepuasan pengguna</p>
                </div>
                <div>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white">24/7</p>
                    <p class="text-sm text-slate-500">Dukungan</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-3xl p-6 shadow-xl space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Misi Kami</p>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Menyederhanakan kolaborasi</h2>
                </div>
                <span class="text-xs px-2 py-1 rounded-full bg-cyan-100 text-cyan-700">Fokus</span>
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-300">
                Menghubungkan orang, proses, dan data dalam satu platform agar setiap anggota tim dapat bekerja dengan jelas, cepat, dan aman.
            </p>
            <div class="grid gap-3 sm:grid-cols-2">
                <div class="p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Transparansi</p>
                    <p class="text-xs text-slate-500">Progress dan keputusan mudah dilacak.</p>
                </div>
                <div class="p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Keamanan</p>
                    <p class="text-xs text-slate-500">Privasi dan data tim tetap terlindungi.</p>
                </div>
                <div class="p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Skalabilitas</p>
                    <p class="text-xs text-slate-500">Bertumbuh bersama tim kecil hingga enterprise.</p>
                </div>
                <div class="p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">Empati</p>
                    <p class="text-xs text-slate-500">Dibangun dari pengalaman bekerja lintas peran.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Cerita</p>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Bagaimana kami mulai</h2>
                </div>
                <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">Sejak 2021</span>
            </div>
            <p class="text-sm text-slate-600 dark:text-slate-300">
                DoItTogether lahir dari kebutuhan tim lintas zona waktu untuk berkoordinasi tanpa friksi. Kami memadukan manajemen tugas, komunikasi, dan visibilitas progres dalam satu alur yang ringan tapi lengkap.
            </p>
            <p class="text-sm text-slate-600 dark:text-slate-300">
                Hari ini, platform kami digunakan oleh startup, komunitas, dan organisasi pendidikan untuk menjaga ritme eksekusi. Kami terus belajar dari pengguna untuk merancang fitur yang relevan.
            </p>
        </div>
        <div class="bg-slate-900 text-slate-50 rounded-2xl shadow p-6 space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-cyan-200/80">Nilai inti</p>
                    <h2 class="text-xl font-semibold">Prinsip Kami</h2>
                </div>
                <i class="fa-solid fa-star text-cyan-200"></i>
            </div>
            <ul class="space-y-3 text-sm">
                <li class="flex items-start gap-2">
                    <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                    Bangun dengan pengguna, bukan hanya untuk mereka.
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                    Sederhana dulu, baru tambah kompleksitas jika perlu.
                </li>
                <li class="flex items-start gap-2">
                    <span class="mt-1 h-2 w-2 rounded-full bg-cyan-400"></span>
                    Data-driven, tetapi tetap menghargai intuisi tim.
                </li>
            </ul>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 space-y-4">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-slate-500">Orang di balik produk</p>
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Tim DoItTogether</h2>
            </div>
            <button class="text-sm text-cyan-600 hover:text-cyan-700">Lihat semua</button>
        </div>
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ([
                ['name' => 'Aulia Rahma', 'role' => 'Product Manager'],
                ['name' => 'Rafi Pratama', 'role' => 'Backend Engineer'],
                ['name' => 'Nadya Putri', 'role' => 'UI/UX Designer'],
            ] as $member)
            <div class="p-4 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40 flex items-center gap-3">
                <div class="h-12 w-12 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                    {{ strtoupper(substr($member['name'], 0, 2)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $member['name'] }}</p>
                    <p class="text-xs text-slate-500">{{ $member['role'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-3xl shadow-xl p-8 text-white flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-semibold">Siap berkolaborasi lebih baik?</h2>
            <p class="text-sm text-white/80 mt-1">Coba DoItTogether dan rasakan alur kerja yang lebih rapi.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <button class="inline-flex items-center px-4 py-2.5 rounded-lg bg-white text-cyan-700 font-semibold shadow hover:bg-slate-100 transition">
                Coba gratis
            </button>
            <button class="inline-flex items-center px-4 py-2.5 rounded-lg border border-white/60 text-white font-semibold hover:bg-white/10 transition">
                Hubungi kami
            </button>
        </div>
    </div>
</div>
@endsection
