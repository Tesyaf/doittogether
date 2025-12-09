@extends('layouts.user-app')
@section('userSidebar', true)

@section('content')

<div class="max-w-xl mx-auto bg-white/5 border border-white/10 rounded-2xl p-6 backdrop-blur-sm">

    <h2 class="text-xl font-semibold mb-4">Buat Tim Baru</h2>

    <form method="POST" action="{{ route('teams.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="text-white/70 text-sm">Nama Tim</label>
            <input type="text" name="name" required
                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white">
        </div>

        <div>
            <label class="text-white/70 text-sm">Deskripsi (opsional)</label>
            <textarea name="description" rows="3"
                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white"></textarea>
        </div>

        <button class="bg-cyan-500 hover:bg-cyan-600 transition text-white px-6 py-3 rounded-xl">
            Buat Tim
        </button>
    </form>

</div>

@endsection
