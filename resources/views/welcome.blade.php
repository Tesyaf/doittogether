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

    {{-- NAVBAR --}}
    <header class="flex items-center justify-between px-6 md:px-12 py-6">
        <div class="text-xl md:text-2xl font-semibold">
            DoIt<span class="text-cyan-400">Together</span>
        </div>

        <button
            x-data="{ open:false }"
            @click="open = !open"
            class="md:hidden text-white/80">
            ☰
        </button>

        <nav class="hidden md:flex gap-8 text-sm text-white/70">
            <a href="#features" class="hover:text-white">Fitur</a>
            <a href="#benefit" class="hover:text-white">Manfaat</a>
            <a href="#about" class="hover:text-white">Tentang</a>
        </nav>

        <div class="hidden md:flex gap-3">
            <a href="{{ route('login') }}"
                class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition text-sm">
                Masuk
            </a>
            <a href="{{ route('register') }}"
                class="px-4 py-2 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 transition text-sm font-semibold">
                Daftar
            </a>
        </div>
    </header>

    {{-- MOBILE NAV --}}
    <div x-data="{ open:false }" x-show="open"
        class="md:hidden px-6 space-y-3 pb-4 text-white/70 text-sm">
        <a href="#features">Fitur</a>
        <a href="#benefit">Manfaat</a>
        <a href="#about">Tentang</a>
    </div>

    <section
        x-data="{ offsetY: 0 }"
        @scroll.window="offsetY = window.scrollY"
        class="px-6 md:px-12 pt-20 pb-32 text-center md:text-left grid md:grid-cols-2 gap-10">

        <div data-aos="fade-right">
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                Kelola Tugas & Kolaborasi
                <span class="text-cyan-400 block">Dalam Satu Tempat</span>
            </h1>

            <p class="text-white/70 text-lg mb-8 max-w-md">
                Organisir pekerjaanmu bersama teman atau tim.
                Pantau progres — semuanya lebih mudah.
            </p>

            <a href="{{ route('register') }}"
                class="inline-block px-8 py-4 rounded-xl bg-cyan-500/90 hover:bg-cyan-500 
              transition text-lg font-semibold">
                Mulai Sekarang
            </a>
        </div>

        <div class="flex justify-center">
            <img
                src="{{asset('images/hero-illustration.png')}}"
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
                class="w-72 md:w-96 mx-auto">
        </div>

        <div data-aos="fade-left">
            <h2 class="text-3xl font-bold mb-6">Bekerja Lebih Produktif</h2>
            <p class="text-white/70 text-lg">
                Dengan DoItTogether, kamu bisa fokus pada hal yang penting:
                menyelesaikan pekerjaan. Semua alat untuk mengorganisir, berkomunikasi,
                dan bekerja sama ada di satu tempat.
            </p>
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
                    “Aplikasi ini bener-bener bantu ngerapiin tugas kuliah kelompok.
                    Semua progress jadi keliatan jelas.”
                </p>
                <p class="font-semibold">— Luthfi, Mahasiswa</p>
            </div>

            {{-- Card 2 --}}
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10"
                data-aos="fade-up" data-aos-delay="200">
                <p class="text-white/70 mb-4">
                    “Fitur timnya gokil. Bisa assign tugas, checklist bareng, dan semuanya real-time.”
                </p>
                <p class="font-semibold">— Adila, Project Member</p>
            </div>

            {{-- Card 3 --}}
            <div class="p-6 rounded-2xl bg-white/5 border border-white/10"
                data-aos="fade-up" data-aos-delay="300">
                <p class="text-white/70 mb-4">
                    “Tampilan gelapnya nyaman banget. Serasa bukan aplikasi tugas biasa.”
                </p>
                <p class="font-semibold">— Rehan, Frontend Dev</p>
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
            <img src="https://i.imgur.com/5ACcp0w.png"
                class="rounded-2xl border border-white/10 shadow-2xl w-full max-w-4xl"
                alt="Dashboard Preview">
        </div>

    </section>

</div>
@endsection