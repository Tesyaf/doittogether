@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col">
    @include('layouts.partials.landing-nav')

    <section class="px-6 md:px-12 pt-10 pb-16">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-10 items-center">
            <div class="space-y-4">
                <p class="text-sm uppercase tracking-widest text-cyan-200/80">Kenapa DoItTogether</p>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-white">Satu tempat untuk menggerakkan tim lebih cepat.</h1>
                <p class="text-white/70 text-base leading-relaxed">
                    Mulai dari ide sampai rilis, DoItTogether menjaga alur kerja tetap jernih.
                    Kamu mendapatkan visibilitas penuh atas tugas, tanggung jawab yang jelas, dan komunikasi yang tidak tercecer.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-5 py-3 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 text-white font-semibold transition">
                        Coba gratis sekarang
                    </a>
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center px-5 py-3 rounded-xl border border-white/15 text-white/80 hover:text-white hover:border-white/30 transition">
                        Tentang tim kami
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-3 pt-3 text-sm text-white/80">
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-3">
                        <p class="font-semibold text-white">Lebih rapi</p>
                        <p class="text-xs text-white/60">Tugas, komentar, file di satu tempat.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-3">
                        <p class="font-semibold text-white">Lebih cepat</p>
                        <p class="text-xs text-white/60">Prioritas jelas, progres mudah dipantau.</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-3">
                        <p class="font-semibold text-white">Lebih aman</p>
                        <p class="text-xs text-white/60">Hak akses terkontrol, audit log siap.</p>
                    </div>
                </div>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-cyan-500/20 blur-3xl rounded-full"></div>
                <div class="relative rounded-3xl overflow-hidden border border-white/10 shadow-2xl bg-slate-900/60">
                    <img src="{{ asset('images/dashboard.png') }}" alt="Dashboard DoItTogether" class="w-full">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900/90 to-transparent p-5 space-y-2">
                        <p class="text-xs uppercase tracking-wide text-cyan-200">Status real-time</p>
                        <p class="text-white text-base font-semibold">Lihat progres tim tanpa harus bertanya satu per satu.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-16">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl md:text-3xl font-semibold text-white text-center mb-10">Manfaat utama untuk timmu</h2>
            <div class="grid gap-6 md:grid-cols-3">
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                    <div class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Visibilitas menyeluruh</h3>
                    <p class="text-sm text-white/70 leading-relaxed">Pantau status tugas lintas proyek, lihat siapa yang butuh bantuan, dan cegah bottleneck lebih dini.</p>
                    <ul class="text-xs text-white/60 space-y-1">
                        <li>• Board status real-time</li>
                        <li>• Ringkasan progres harian</li>
                        <li>• Notifikasi yang relevan saja</li>
                    </ul>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                    <div class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-person-running"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Eksekusi tanpa friksi</h3>
                    <p class="text-sm text-white/70 leading-relaxed">Checklist, lampiran, komentar, dan assignee berada tepat di dalam tugas yang sama.</p>
                    <ul class="text-xs text-white/60 space-y-1">
                        <li>• Assign role & due date</li>
                        <li>• Komentar ber-thread</li>
                        <li>• Lampiran aman terarsip</li>
                    </ul>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                    <div class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-plug-circle-bolt"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Integrasi yang menjaga ritme</h3>
                    <p class="text-sm text-white/70 leading-relaxed">Sinkronkan repo GitHub, kalender, dan notifikasi agar tim tidak lagi berpindah tab.</p>
                    <ul class="text-xs text-white/60 space-y-1">
                        <li>• Commit & PR langsung terlihat</li>
                        <li>• Sinkron kalender sprint</li>
                        <li>• Notifikasi terkurasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-16">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 rounded-3xl bg-white/5 border border-white/10 p-6 space-y-3">
                <p class="text-sm uppercase tracking-wide text-cyan-200/80">Untuk siapa</p>
                <h2 class="text-2xl font-semibold text-white">Disukai product, engineering, dan komunitas.</h2>
                <p class="text-sm text-white/70 leading-relaxed">Setiap peran mendapat konteks yang tepat sehingga keputusan lebih cepat dan koordinasi lebih ringan.</p>
            </div>
            <div class="lg:col-span-2 grid gap-4 md:grid-cols-2">
                <div class="p-5 rounded-2xl bg-slate-900/40 border border-white/10 space-y-2">
                    <div class="flex items-center gap-2 text-cyan-200 text-sm">
                        <i class="fa-solid fa-compass-drafting"></i>
                        <span>Product & Project</span>
                    </div>
                    <p class="text-white font-semibold text-base">Roadmap jelas, risiko terlihat cepat.</p>
                    <p class="text-white/70 text-sm">Prioritas dan scope tegas, mudah mengelola dependency lintas tim.</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-900/40 border border-white/10 space-y-2">
                    <div class="flex items-center gap-2 text-cyan-200 text-sm">
                        <i class="fa-solid fa-code"></i>
                        <span>Engineering</span>
                    </div>
                    <p class="text-white font-semibold text-base">Konteks teknis tidak hilang.</p>
                    <p class="text-white/70 text-sm">Integrasi repo dan komentar teknis tetap tersambung ke tugas yang sama.</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-900/40 border border-white/10 space-y-2">
                    <div class="flex items-center gap-2 text-cyan-200 text-sm">
                        <i class="fa-solid fa-people-group"></i>
                        <span>Tim Operasional</span>
                    </div>
                    <p class="text-white font-semibold text-base">Checklist rapi, SLA terpantau.</p>
                    <p class="text-white/70 text-sm">Notifikasi prioritas memastikan pekerjaan mendesak tidak terlewat.</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-900/40 border border-white/10 space-y-2">
                    <div class="flex items-center gap-2 text-cyan-200 text-sm">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <span>Komunitas & Kelas</span>
                    </div>
                    <p class="text-white font-semibold text-base">Kolaborasi belajar lebih terarah.</p>
                    <p class="text-white/70 text-sm">Tugas kelompok, feedback mentor, dan materi tersimpan dalam satu alur.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-16">
        <div class="max-w-6xl mx-auto rounded-3xl bg-white/5 border border-white/10 p-8 md:p-10 grid md:grid-cols-2 gap-8 items-center">
            <div class="space-y-3">
                <p class="text-sm uppercase tracking-wide text-cyan-200/80">Workflow unggulan</p>
                <h2 class="text-2xl font-semibold text-white">Dari request ke rilis tanpa kehilangan konteks.</h2>
                <p class="text-sm text-white/70 leading-relaxed">Permintaan baru masuk, dianalisis, dibagi ke tugas, dan langsung bisa dikerjakan dengan timeline yang jelas.</p>
                <ul class="text-sm text-white/80 space-y-2">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-cyan-300 mt-1"></i>
                        <span>Template tugas siap pakai untuk bug, fitur, atau eksperimen.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-cyan-300 mt-1"></i>
                        <span>Sinkronkan jadwal dengan kalender sprint agar semua tahu tenggat.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-check text-cyan-300 mt-1"></i>
                        <span>Notifikasi terarah ke pemilik tugas, bukan ke semua orang.</span>
                    </li>
                </ul>
            </div>
            <div class="space-y-4">
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-white/10">
                    <p class="text-xs text-cyan-200 uppercase tracking-wide mb-1">01 • Request masuk</p>
                    <p class="text-white text-sm">Form terstruktur memastikan detail penting tidak terlewat.</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-white/10">
                    <p class="text-xs text-cyan-200 uppercase tracking-wide mb-1">02 • Prioritasi</p>
                    <p class="text-white text-sm">Label prioritas dan SLA membantu tim fokus ke yang paling berdampak.</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-white/10">
                    <p class="text-xs text-cyan-200 uppercase tracking-wide mb-1">03 • Eksekusi</p>
                    <p class="text-white text-sm">Assignee, checklist, dan lampiran menyatu untuk setiap tugas.</p>
                </div>
                <div class="p-4 rounded-2xl bg-slate-900/50 border border-white/10">
                    <p class="text-xs text-cyan-200 uppercase tracking-wide mb-1">04 • Rilis & review</p>
                    <p class="text-white text-sm">Pantau hasil, catat belajarannya, dan iterasi lebih cepat di siklus berikutnya.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-20">
        <div class="max-w-6xl mx-auto bg-gradient-to-r from-cyan-500/90 to-blue-600/80 rounded-3xl shadow-xl p-8 md:p-10 text-white flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-semibold">Saatnya kerja bersama lebih rapi.</h2>
                <p class="text-sm text-white/85 mt-2 max-w-2xl">Aktifkan timmu di DoItTogether dan nikmati kolaborasi yang sinkron tanpa banyak rapat tambahan.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center px-5 py-3 rounded-xl bg-white text-cyan-700 font-semibold shadow hover:bg-slate-100 transition">
                    Buat akun
                </a>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-5 py-3 rounded-xl border border-white/60 text-white font-semibold hover:bg-white/10 transition">
                    Masuk tim
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
