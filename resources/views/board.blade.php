@extends('layouts.app')

@section('title', 'Task Board – ' . $team->name)

@section('content')
<div class="w-full px-4 text-white">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold">Task Board – {{ $team->name }}</h1>

            <button
                class="px-4 py-2 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-sm font-medium text-slate-950">
                + New Task
            </button>
        </div>

        @php
            $columns = ['ongoing' => 'Ongoing', 'done' => 'Done', 'canceled' => 'Canceled', 'archived' => 'Archived'];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @foreach ($columns as $statusKey => $label)
                <section class="bg-slate-900 rounded-xl p-3 flex flex-col max-h-[75vh]">
                    <header class="flex items-center justify-between mb-2">
                        <h2 class="text-sm font-semibold">{{ $label }}</h2>
                        <span class="text-xs text-slate-400">
                            {{ isset($tasks[$statusKey]) ? $tasks[$statusKey]->count() : 0 }}
                        </span>
                    </header>

                    <div class="space-y-2 overflow-y-auto pr-1">
                        @forelse ($tasks[$statusKey] ?? [] as $task)
                            <a href="{{ route('teams.tasks.show', [$team, $task]) }}"
                               class="block rounded-lg bg-slate-800 hover:bg-slate-700 px-3 py-2 text-sm">
                                <div class="font-medium truncate">{{ $task->title }}</div>
                                <div class="text-xs text-slate-400">
                                    Due: {{ optional($task->due_at)->format('Y-m-d') ?? '-' }}
                                </div>
                            </a>
                        @empty
                            <p class="text-xs text-slate-500">Belum ada task.</p>
                        @endforelse
                    </div>
                </section>
            @endforeach
        </div>
    </div>
</div>
@endsection
