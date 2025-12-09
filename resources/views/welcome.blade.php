{{-- Auto-redirect jika sudah login --}}
@auth
<script>
    window.location.href = "{{ url('/dashboard') }}";
</script>
@endauth

@extends('layouts.guest')

@section('content')

{{-- AOS Animation Library --}}
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-cubic'
        });
    });
</script>

<div class="min-h-screen flex flex-col">
    @include('layouts.partials.landing-nav')

    <section
        x-data="{ offsetY: 0 }"
        @scroll.window="offsetY = window.scrollY"
        class="px-6 md:px-12 pt-10 md:pt-16 pb-32 text-center md:text-left grid md:grid-cols-2 gap-10">

        <div data-aos="fade-right">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                Kelola Tugas & Kolaborasi
                <span class="text-cyan-400 block">Dalam Satu Tempat</span>
            </h1>

            <p class="text-white/70 text-lg mb-8 max-w-md">
                Organisir pekerjaanmu bersama teman atau tim.
                Pantau progres - semuanya lebih mudah.
            </p>

            <div class="flex flex-col sm:flex-row gap-3 sm:items-center">
                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-4 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 
                  transition text-lg font-semibold text-center">
                    Mulai Sekarang
                </a>
                <a href="{{ route('about') }}"
                    class="inline-block px-6 py-3 rounded-xl border border-white/15 text-white/80 hover:text-white hover:border-white/30 transition text-sm text-center">
                    Tentang DoItTogether
                </a>
            </div>
        </div>

        <div class="flex justify-center">
            <img
                src="{{ asset('images/hero-illustration.png') }}"
                alt="Hero Illustration"
                class="w-72 md:w-96 drop-shadow-xl transition-transform"
                :style="`transform: translateY(${offsetY * 0.15}px)`"
                data-aos="fade-left">
        </div>

    </section>


    {{-- FEATURES --}}
    <section id="features" class="px-6 md:px-12 pb-32">

        <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">
            Fitur yang Membuat Kerja Jadi Lebih Mudah
        </h2>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <div class="p-6 rounded-2xl bg-white/5 border border-white/10" data-aos="fade-up" data-aos-delay="100">
                <h3 class="font-semibold text-xl mb-2">Manajemen Tugas</h3>
                <p class="text-white/70 text-sm">
                    Atur tugas harian, kategorikan, dan kelola progres dengan lebih terstruktur.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white/5 border border-white/10" data-aos="fade-up" data-aos-delay="200">
                <h3 class="font-semibold text-xl mb-2">Kolaborasi Tim</h3>
                <p class="text-white/70 text-sm">
                    Undang anggota tim, beri peran, dan kerjakan proyek secara bersama-sama.
                </p>
            </div>

            <div class="p-6 rounded-2xl bg-white/5 border border-white/10" data-aos="fade-up" data-aos-delay="300">
                <h3 class="font-semibold text-xl mb-2">Progress Tracking</h3>
                <p class="text-white/70 text-sm">
                    Pantau status tugas dan timeline proyek dengan tampilan yang rapi.
                </p>
            </div>

        </div>
    </section>

    {{-- BENEFIT SECTION --}}
    <section id="benefit" class="px-6 md:px-12 pb-32 grid md:grid-cols-2 gap-10 items-center">

        <div data-aos="fade-right">
            <img src="{{ asset('images/illustration.png') }}"
                class="w-72 md:w-96 mx-auto" alt="Kolaborasi ilustrasi">
        </div>

        <div data-aos="fade-left">
            <h2 class="text-3xl font-bold mb-6">Bekerja Lebih Produktif</h2>
            <p class="text-white/70 text-lg">
                Dengan DoItTogether, kamu bisa fokus pada hal yang penting:
                menyelesaikan pekerjaan. Semua alat untuk mengorganisir, berkomunikasi,
                dan bekerja sama ada di satu tempat.
            </p>
            <div class="flex gap-3 mt-6">
                <a href="{{ route('manfaat') }}"
                    class="px-5 py-3 rounded-xl bg-white/10 hover:bg-white/20 text-white transition text-sm font-semibold">
                    Lihat semua manfaat
                </a>
                <a href="{{ route('about') }}"
                    class="px-5 py-3 rounded-xl border border-white/15 text-white/80 hover:border-white/30 hover:text-white transition text-sm">
                    Kenali tim kami
                </a>
            </div>
        </div>

    </section>
    <section id="testimoni" class="px-6 md:px-12 pb-32">

        <h2 class="text-3xl font-bold text-center mb-12" data-aos="fade-up">
            Apa Kata Pengguna Kami?
        </h2>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            {{-- Card 1 --}}
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10"
                data-aos="fade-up" data-aos-delay="100">
                <p class="text-white/70 mb-4">
                    "Aplikasi ini bener-bener bantu ngerapiin tugas kuliah kelompok.
                    Semua progress jadi keliatan jelas."
                </p>
                <p class="font-semibold">- Luthfi, Mahasiswa</p>
            </div>

            {{-- Card 2 --}}
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10"
                data-aos="fade-up" data-aos-delay="200">
                <p class="text-white/70 mb-4">
                    "Fitur timnya gokil. Bisa assign tugas, checklist bareng, dan semuanya real-time."
                </p>
                <p class="font-semibold">- Adila, Project Member</p>
            </div>

            {{-- Card 3 --}}
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10"
                data-aos="fade-up" data-aos-delay="300">
                <p class="text-white/70 mb-4">
                    "Tampilan gelapnya nyaman banget. Serasa bukan aplikasi tugas biasa."
                </p>
                <p class="font-semibold">- Rehan, Frontend Dev</p>
            </div>

        </div>

    </section>

    <section id="about" class="px-6 md:px-12 pb-32">
        <div class="max-w-5xl mx-auto rounded-3xl bg-white/5 border border-white/10 p-8 md:p-10 grid md:grid-cols-2 gap-6 items-center">
            <div>
                <p class="text-sm uppercase tracking-wide text-cyan-200/80 mb-2">Tentang DoItTogether</p>
                <h3 class="text-2xl font-semibold text-white mb-3">Platform kolaborasi yang tumbuh bersama tim</h3>
                <p class="text-white/70 text-sm leading-relaxed">
                    Kami merancang pengalaman kerja jarak jauh yang terasa dekat.
                    Dari startup sampai komunitas, DoItTogether menjaga ritme eksekusi dengan alur tugas,
                    komunikasi, dan visibilitas yang menyatu.
                </p>
            </div>
            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <span class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-sparkles"></i>
                    </span>
                    <div>
                        <p class="text-white font-semibold text-sm">Integrasi modern</p>
                        <p class="text-white/60 text-xs">Sinkron dengan repositori, kalender, dan notifikasi tim.</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <span class="h-10 w-10 rounded-full bg-cyan-500/20 border border-cyan-400/30 flex items-center justify-center text-cyan-200">
                        <i class="fa-solid fa-people-group"></i>
                    </span>
                    <div>
                        <p class="text-white font-semibold text-sm">Kolaborasi tanpa friksi</p>
                        <p class="text-white/60 text-xs">Setiap peran mendapat konteks yang tepat untuk bergerak cepat.</p>
                    </div>
                </div>
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('about') }}"
                        class="flex-1 px-5 py-3 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 text-white font-semibold text-center transition">
                        Pelajari perjalanan kami
                    </a>
                    <a href="{{ route('manfaat') }}"
                        class="flex-1 px-5 py-3 rounded-xl border border-white/15 text-white/80 hover:border-white/30 hover:text-white text-center transition">
                        Jelajahi manfaat
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="preview" class="px-6 md:px-12 pb-32 text-center">

        <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">
            Lihat Sekilas Dashboard DoItTogether
        </h2>

        <p class="text-white/70 max-w-xl mx-auto mb-10" data-aos="fade-up">
            Dashboard dibuat dengan tampilan gelap yang elegan, fokus pada produktivitas dan keterbacaan.
        </p>

        <div class="flex justify-center" data-aos="zoom-in">
            <img src="{{ asset('images/dashboard.png') }}"
                class="rounded-2xl border border-white/10 shadow-2xl w-full max-w-4xl"
                alt="Dashboard Preview">
        </div>

    </section>

</div>
@endsection
