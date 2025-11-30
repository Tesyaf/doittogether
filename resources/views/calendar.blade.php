@extends('layouts.app')

@section('title', 'Task Calendar – ' . $team->name)

@section('content')
<div class="w-full px-4 text-white">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Task Calendar – {{ $team->name }}</h1>

        @php
            $grouped = $tasks->groupBy(fn($task) => $task->due_at->format('Y-m-d'));
        @endphp

        <div class="space-y-4">
            @forelse ($grouped as $date => $tasksInDate)
                <section class="bg-slate-900 rounded-xl p-4">
                    <h2 class="text-sm font-semibold mb-2">{{ $date }}</h2>
                    <ul class="space-y-1 text-sm">
                        @foreach ($tasksInDate as $task)
                            <li>
                                <a href="{{ route('teams.tasks.show', [$team, $task]) }}"
                                   class="text-cyan-400 hover:underline">
                                    {{ $task->title }}
                                </a>
                                <span class="text-xs text-slate-500">({{ $task->status }})</span>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @empty
                <p class="text-slate-500 text-sm">Belum ada task yang punya due date.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
