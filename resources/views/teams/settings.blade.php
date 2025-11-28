@extends('layouts.team-app')

@section('content')
<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="bg-gradient-to-r from-slate-900 via-slate-900/90 to-slate-900 border border-white/10 rounded-3xl p-6 md:p-8 shadow-2xl flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div class="flex items-center gap-4">
            <div class="h-16 w-16 rounded-2xl bg-gradient-to-br from-cyan-500 to-blue-600 p-[2px] shadow-lg overflow-hidden">
                @if($team->icon_url)
                    <img src="{{ $team->icon_url }}" alt="Logo tim" class="h-full w-full rounded-2xl object-cover">
                @else
                    <div class="h-full w-full rounded-2xl bg-slate-950 flex items-center justify-center text-2xl font-semibold text-white">
                        {{ strtoupper(substr($team->name ?? 'T', 0, 2)) }}
                    </div>
                @endif
            </div>
            <div>
                <p class="text-sm text-slate-300">Pengaturan Tim</p>
                <h1 class="text-2xl md:text-3xl font-semibold text-white">{{ $team->name }}</h1>
                <p class="text-sm text-slate-400 mt-1">Atur identitas, branding, dan preferensi akses.</p>
            </div>
        </div>
        <div class="flex items-center gap-3 text-sm text-slate-300">
            <i class="fa-solid fa-clock text-cyan-300"></i>
            <div>
                <p class="text-xs uppercase tracking-wide text-slate-400">Terakhir diubah</p>
                <p class="font-medium text-white">{{ optional($team->updated_at)->diffForHumans() ?? 'baru saja' }}</p>
            </div>
        </div>
    </div>

    <a href="{{ route('teams.dashboard', $team) }}" class="inline-flex items-center gap-2 text-slate-200 hover:text-cyan-200 text-sm">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard Tim
    </a>
    @if ($errors->any())
    <div class="p-4 bg-red-500/15 border border-red-500/40 rounded-xl text-red-200 space-y-1">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
    @endif

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            <form method="POST" action="{{ route('teams.settings.update', $team) }}" enctype="multipart/form-data" class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 space-y-4 backdrop-blur-sm">
                @csrf
                @method('PUT')
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-300">Profil tim</p>
                        <h2 class="text-xl font-semibold text-white">Informasi Dasar</h2>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-200">Nama Tim</span>
                        <input type="text" name="name" value="{{ old('name', $team->name) }}" required class="w-full rounded-lg border border-slate-200/40 bg-slate-950/70 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                    <label class="space-y-2">
                        <span class="block text-sm font-medium text-slate-200">Team Code</span>
                        <input type="text" value="{{ $team->team_code }}" disabled class="w-full rounded-lg border border-slate-200/40 bg-slate-950/70 px-4 py-2.5 text-slate-400 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition">
                    </label>
                </div>
                <label class="space-y-2 block">
                    <span class="block text-sm font-medium text-slate-200">Deskripsi</span>
                    <textarea name="description" rows="3" class="w-full rounded-lg border border-slate-200/40 bg-slate-950/70 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition" placeholder="Ceritakan fokus tim">{{ old('description', $team->description) }}</textarea>
                </label>

                <div class="space-y-2" x-data="{ preview: '{{ $team->icon_url }}', pasteMode: false }">
                    <span class="block text-sm font-medium text-slate-200">Logo Tim</span>
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:gap-4">
                        <div class="h-16 w-16 rounded-2xl bg-slate-800 border border-dashed border-slate-600 flex items-center justify-center overflow-hidden">
                            <img x-show="preview" x-bind:src="preview" alt="Logo tim" class="h-full w-full object-cover">
                            <span x-show="!preview" class="text-slate-400 text-xs">Belum ada</span>
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="flex flex-wrap gap-2">
                                <label class="inline-flex items-center px-3 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white text-sm font-semibold shadow hover:from-cyan-600 hover:to-blue-700 cursor-pointer transition">
                                    <input type="file" name="icon" accept="image/*" class="sr-only" @change="const [file] = $event.target.files; if (file) { preview = URL.createObjectURL(file); pasteMode=false; }">
                                    <span>Upload logo</span>
                                </label>
                                <button type="button" @click="pasteMode = !pasteMode" class="inline-flex items-center px-3 py-2 rounded-lg border border-slate-200/40 text-slate-200 hover:border-cyan-500 hover:text-cyan-200 text-sm transition">
                                    Tempel URL
                                </button>
                            </div>
                            <div x-show="pasteMode" class="space-y-1.5">
                                <input type="text" name="icon_url" value="{{ old('icon_url', $team->icon_url) }}" placeholder="Tempel URL logo (PNG/JPG)" class="w-full rounded-lg border border-slate-200/40 bg-slate-950/70 px-4 py-2.5 text-slate-100 focus:ring-2 focus:ring-cyan-500 focus:border-blue-500 transition" @input="preview = $event.target.value">
                                <p class="text-xs text-slate-400">Upload atau tempel URL; upload akan menimpa URL.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="reset" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200/40 text-slate-200 hover:border-cyan-500 hover:text-cyan-200 transition">
                        <i class="fa-solid fa-rotate-right mr-2"></i> Reset
                    </button>
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                        <i class="fa-solid fa-floppy-disk mr-2"></i> Simpan Perubahan
                    </button>
                </div>
            </form>

            <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 space-y-4 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-300">Preferensi</p>
                        <h2 class="text-xl font-semibold text-white">Notifikasi & Keamanan</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-cyan-500/20 text-cyan-100 border border-cyan-400/30">Preview</span>
                </div>

                <div class="space-y-4">
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-500 text-cyan-600 focus:ring-cyan-500" checked>
                        <div>
                            <p class="text-sm font-semibold text-white">Email ringkasan mingguan</p>
                            <p class="text-sm text-slate-400">Kirim laporan progres ke anggota setiap Senin.</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-500 text-cyan-600 focus:ring-cyan-500" checked>
                        <div>
                            <p class="text-sm font-semibold text-white">Persetujuan anggota baru</p>
                            <p class="text-sm text-slate-400">Admin harus menyetujui undangan sebelum aktif.</p>
                        </div>
                    </label>
                    <label class="flex items-start gap-3">
                        <input type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-500 text-cyan-600 focus:ring-cyan-500">
                        <div>
                            <p class="text-sm font-semibold text-white">Aktifkan 2FA untuk admin</p>
                            <p class="text-sm text-slate-400">Wajibkan autentikasi dua faktor bagi role admin.</p>
                        </div>
                    </label>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-slate-900 text-slate-50 rounded-2xl shadow p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-cyan-200/80">Peran & akses</p>
                        <h2 class="text-xl font-semibold">Role Settings</h2>
                    </div>
                    <span class="text-xs px-2 py-1 rounded-full bg-white/10 text-white">Admin/Member</span>
                </div>
                <div class="space-y-3">
                    @foreach ([
                        ['role' => 'Owner', 'desc' => 'Full akses termasuk hapus tim'],
                        ['role' => 'Admin', 'desc' => 'Kelola anggota, undangan, dan data tim'],
                        ['role' => 'Member', 'desc' => 'Akses tugas dan kolaborasi']
                    ] as $item)
                    <div class="p-3 rounded-xl border border-slate-800 bg-slate-800/60">
                        <p class="text-sm font-semibold">{{ $item['role'] }}</p>
                        <p class="text-xs text-slate-300">{{ $item['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
                <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                    Tambah role baru
                </button>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-2xl shadow p-6 space-y-4 backdrop-blur-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-300">Risiko</p>
                        <h2 class="text-xl font-semibold text-white">Danger Zone</h2>
                    </div>
                    <i class="fa-solid fa-triangle-exclamation text-amber-400"></i>
                </div>
                <p class="text-sm text-slate-400">Tindakan ini permanen. Pastikan semua data sudah dicadangkan.</p>
                <button class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-red-400/50 text-red-200 font-semibold hover:bg-red-500/10 transition">
                    Hapus tim ini
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
