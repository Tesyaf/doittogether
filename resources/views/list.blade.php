@extends('layouts.app')

@section('title', 'Task List – ' . $team->name)

@section('content')
<div class="w-full px-4 text-white">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Task List – {{ $team->name }}</h1>

        <div class="overflow-x-auto border border-slate-800 rounded-xl">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-900">
                    <tr>
                        <th class="px-3 py-2 text-left">Title</th>
                        <th class="px-3 py-2 text-left">Status</th>
                        <th class="px-3 py-2 text-left">Due</th>
                        <th class="px-3 py-2 text-right"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800">
                    @forelse ($tasks as $task)
                        <tr class="hover:bg-slate-900">
                            <td class="px-3 py-2">
                                <a href="{{ route('teams.tasks.show', [$team, $task]) }}"
                                   class="text-cyan-400 hover:underline">
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td class="px-3 py-2">{{ $task->status }}</td>
                            <td class="px-3 py-2">
                                {{ optional($task->due_at)->format('Y-m-d') ?? '-' }}
                            </td>
                            <td class="px-3 py-2 text-right text-xs text-slate-500">
                                {{ $task->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-3 py-4 text-center text-slate-500">
                                Belum ada task.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
