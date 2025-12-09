@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex flex-col">
    @include('layouts.partials.landing-nav')

    <section class="px-6 md:px-12 pt-10 pb-16">
        <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-10 items-center">
            <div class="space-y-5">
                <p class="text-sm uppercase tracking-widest text-cyan-200/80">Tentang DoItTogether</p>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-white">Kolaborasi terasa dekat meski bekerja jarak jauh.</h1>
                <p class="text-white/70 text-base leading-relaxed">
                    Kami membangun platform kolaborasi yang membuat tim fokus pada hal penting: mengeksekusi.
                    Dengan alur tugas, komunikasi, dan visibilitas progres yang terhubung, setiap orang tahu apa yang harus dilakukan dan kapan harus selesai.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('register') }}"
                        class="inline-flex items-center px-5 py-3 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 text-white font-semibold transition">
                        Mulai sekarang
                    </a>
                    <a href="{{ route('manfaat') }}"
                        class="inline-flex items-center px-5 py-3 rounded-xl border border-white/15 text-white/80 hover:text-white hover:border-white/30 transition">
                        Lihat manfaat produk
                    </a>
                </div>
                <div class="grid grid-cols-3 gap-4 pt-4">
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                        <p class="text-3xl font-bold text-white">120+</p>
                        <p class="text-xs text-white/60">Tim aktif</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                        <p class="text-3xl font-bold text-white">98%</p>
                        <p class="text-xs text-white/60">Kepuasan pengguna</p>
                    </div>
                    <div class="rounded-2xl bg-white/5 border border-white/10 p-4">
                        <p class="text-3xl font-bold text-white">24/7</p>
                        <p class="text-xs text-white/60">Dukungan</p>
                    </div>
                </div>
            </div>
            <div class="rounded-3xl bg-white/5 border border-white/10 shadow-2xl p-7 space-y-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-cyan-200/80">Misi</p>
                        <h2 class="text-xl font-semibold text-white">Menyederhanakan koordinasi kerja</h2>
                    </div>
                    <span class="text-xs px-3 py-1 rounded-full bg-cyan-500/20 text-cyan-200 border border-cyan-400/30">Fokus</span>
                </div>
                <p class="text-sm text-white/70 leading-relaxed">
                    Kami menghubungkan orang, proses, dan data dalam satu arus kerja yang jernih.
                    Semua keputusan bisa ditelusuri, setiap progres terlihat, dan setiap tim merasa memiliki konteks yang sama.
                </p>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                        <p class="text-sm font-semibold text-white">Transparan sejak awal</p>
                        <p class="text-xs text-white/60">Setiap perubahan, diskusi, dan keputusan tersimpan rapi.</p>
                    </div>
                    <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                        <p class="text-sm font-semibold text-white">Terukur dan aman</p>
                        <p class="text-xs text-white/60">Hak akses jelas, data terenkripsi, dan audit log selalu aktif.</p>
                    </div>
                    <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                        <p class="text-sm font-semibold text-white">Skalabel</p>
                        <p class="text-xs text-white/60">Mulai dari tim 5 orang sampai organisasi besar.</p>
                    </div>
                    <div class="p-4 rounded-2xl border border-white/10 bg-white/5">
                        <p class="text-sm font-semibold text-white">Empatik</p>
                        <p class="text-xs text-white/60">Dibentuk dari pengalaman lintas peran: product, engineering, dan ops.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-16">
        <div class="max-w-6xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm uppercase tracking-wide text-cyan-200/80">Apa yang kami wujudkan</p>
                    <h2 class="text-2xl font-semibold text-white">Pilar produk DoItTogether</h2>
                </div>
                <a href="{{ route('manfaat') }}" class="text-sm text-cyan-200 hover:text-cyan-100 transition">Jelajahi manfaat</a>
            </div>
            <div class="grid gap-6 lg:grid-cols-3">
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                    <div class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Alur kerja terhubung</h3>
                    <p class="text-sm text-white/70 leading-relaxed">
                        Tugas, komentar, lampiran, dan notifikasi menyatu sehingga konteks tidak tercecer.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                    <div class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Kecepatan dengan kejelasan</h3>
                    <p class="text-sm text-white/70 leading-relaxed">
                        Prioritas, status, dan pemilik tugas selalu jelas sehingga keputusan lebih cepat diambil.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-white/5 border border-white/10 space-y-3">
                    <div class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-white">Keamanan sebagai standar</h3>
                    <p class="text-sm text-white/70 leading-relaxed">
                        Hak akses berbasis peran, audit log, dan integrasi aman menjaga data tetap terlindungi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-16">
        <div class="max-w-6xl mx-auto rounded-3xl bg-white/5 border border-white/10 p-8 md:p-10">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <div>
                    <p class="text-sm uppercase tracking-wide text-cyan-200/80">Cara kami bekerja</p>
                    <h2 class="text-2xl font-semibold text-white">Ritme produk yang konsisten</h2>
                </div>
                <a href="{{ route('landing') }}#preview" class="text-sm text-cyan-200 hover:text-cyan-100 transition">Lihat dashboard demo</a>
            </div>
            <div class="grid gap-6 md:grid-cols-3">
                <div class="p-5 rounded-2xl bg-slate-900/40 border border-white/10">
                    <p class="text-xs text-cyan-200 uppercase tracking-wide mb-2">01 • Discovery</p>
                    <h3 class="text-lg font-semibold text-white mb-2">Belajar dari pengguna</h3>
                    <p class="text-sm text-white/70 leading-relaxed">Setiap rilis dimulai dari masalah nyata tim, bukan fitur yang kebetulan tren.</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-900/40 border border-white/10">
                    <p class="text-xs text-cyan-200 uppercase tracking-wide mb-2">02 • Delivery</p>
                    <h3 class="text-lg font-semibold text-white mb-2">Rilis bertahap</h3>
                    <p class="text-sm text-white/70 leading-relaxed">Eksperimen kecil, validasi cepat, baru digelar lebih luas setelah metrik jelas.</p>
                </div>
                <div class="p-5 rounded-2xl bg-slate-900/40 border border-white/10">
                    <p class="text-xs text-cyan-200 uppercase tracking-wide mb-2">03 • Iterasi</p>
                    <h3 class="text-lg font-semibold text-white mb-2">Perbaiki berulang</h3>
                    <p class="text-sm text-white/70 leading-relaxed">Feedback masuk langsung ke backlog, menjaga produk selalu relevan.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-16">
        <div class="max-w-6xl mx-auto space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm uppercase tracking-wide text-cyan-200/80">Orang di balik produk</p>
                    <h2 class="text-2xl font-semibold text-white">Tim inti DoItTogether</h2>
                </div>
                <a href="{{ route('register') }}" class="text-sm text-cyan-200 hover:text-cyan-100 transition">Bergabung dengan komunitas</a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ([
                    ['name' => 'Aulia Rahma', 'role' => 'Product Manager'],
                    ['name' => 'Rafi Pratama', 'role' => 'Backend Engineer'],
                    ['name' => 'Nadya Putri', 'role' => 'UI/UX Designer'],
                ] as $member)
                <div class="p-4 rounded-2xl border border-white/10 bg-white/5 flex items-center gap-3">
                    <div class="h-12 w-12 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                        {{ strtoupper(substr($member['name'], 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $member['name'] }}</p>
                        <p class="text-xs text-white/60">{{ $member['role'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-6 md:px-12 pb-20">
        <div class="max-w-6xl mx-auto bg-gradient-to-r from-cyan-500/90 to-blue-600/80 rounded-3xl shadow-xl p-8 md:p-10 text-white flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            <div>
                <h2 class="text-2xl font-semibold">Siap berkolaborasi lebih baik?</h2>
                <p class="text-sm text-white/85 mt-2 max-w-2xl">Coba DoItTogether dan rasakan alur kerja yang selaras. Kami bantu timmu bergerak cepat tanpa kehilangan kendali.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('register') }}"
                    class="inline-flex items-center px-5 py-3 rounded-xl bg-white text-cyan-700 font-semibold shadow hover:bg-slate-100 transition">
                    Coba gratis
                </a>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-5 py-3 rounded-xl border border-white/60 text-white font-semibold hover:bg-white/10 transition">
                    Masuk
                </a>
            </div>
        </div>
    </section>
</div>
@endsection
