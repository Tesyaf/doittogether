@extends('layouts.app')

@section('title', 'Join Team')

@section('content')
<div class="w-full max-w-md mx-auto">
    <div
        class="bg-slate-900/90 border border-slate-700 shadow-xl rounded-2xl px-6 py-6 sm:px-8 sm:py-7 text-white">
        <h1 class="text-xl font-semibold text-center mb-2">
            Join Team dengan Kode
        </h1>
        <p class="text-xs text-slate-300 text-center mb-5">
            Masukkan <span class="font-semibold text-cyan-400">team code</span> yang diberikan owner.
        </p>

        <form method="POST" action="{{ route('teams.join.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-100 mb-1">
                    Team Code
                </label>
                <input type="text"
                       name="code"
                       value="{{ old('code') }}"
                       class="w-full rounded-lg bg-slate-950 border border-slate-700 px-3 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-cyan-400 placeholder:text-slate-500"
                       placeholder="contoh: 123e4567-e89b-12d3-a456-426614174000">
                @error('code')
                    <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <button class="w-full bg-cyan-500 hover:bg-cyan-600 px-4 py-2 rounded-lg text-sm font-medium">
                Join Team
            </button>
        </form>
    </div>
</div>
@endsection
