@extends('layouts.app')

@section('title', 'My Tasks – ' . $team->name)

@section('content')
<div class="w-full px-4 text-white">
    <div class="max-w-5xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Tugas Saya – {{ $team->name }}</h1>

        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($tasks as $task)
                <a href="{{ route('teams.tasks.show', [$team, $task]) }}"
                   class="bg-slate-900 rounded-xl p-4 hover:bg-slate-800 transition">
                    <h2 class="text-sm font-semibold mb-1">{{ $task->title }}</h2>
                    <p class="text-xs text-slate-400 mb-1">
                        Due: {{ optional($task->due_at)->format('Y-m-d') ?? '-' }}
                    </p>
                    <p class="text-xs text-slate-300">
                        Status: {{ $task->status }}
                    </p>
                </a>
            @empty
                <p class="text-slate-500 text-sm">Belum ada tugas yang terkait denganmu.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
