@extends('layouts.team-app')

@section('content')
<style>
    select option {
        background-color: #0b1120;
        color: white;
        padding: 10px;
    }

    select option:hover {
        background-color: #1a2540;
    }

    select option:checked {
        background-color: #06b6d4;
        color: white;
    }
</style>

<div class="max-w-7xl mx-auto space-y-6 px-4 sm:px-6">
    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-white/60">{{ $team->name }}</p>
            <h1 class="text-3xl font-bold text-white">Tasks</h1>
        </div>
        <a href="{{ route('tasks.create', $team->id) }}"
            class="inline-flex items-center justify-center px-5 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold w-full sm:w-auto">
            <i class="fa-solid fa-plus mr-2"></i> Buat Task
        </a>
    </div>

    {{-- Filter & Search --}}
    <div class="grid gap-3 md:grid-cols-2 xl:grid-cols-4 bg-white/5 border border-white/10 rounded-xl p-4 backdrop-blur-sm">
        <input type="search" placeholder="Cari task..." class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white placeholder-white/50">

        <select class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white" onchange="filterTasks('assigned_to_me', this.value)">
            <option value="">Semua Tugas</option>
            <option value="1" {{ request('assigned_to_me') == 1 ? 'selected' : '' }}>Tugas Saya</option>
        </select>

        <select class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white" onchange="filterTasks('member_id', this.value)">
            <option value="">Semua Anggota</option>
            @foreach($team_members as $member)
            <option value="{{ $member->id_member }}" {{ request('member_id') == $member->id_member ? 'selected' : '' }}>
                {{ $member->user->name }}
            </option>
            @endforeach
        </select>

        <select class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white" onchange="filterTasks('category_id', this.value)">
            <option value="">Semua Kategori</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>

        <select class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white" onchange="filterTasks('status', this.value)">
            <option value="">Semua Status</option>
            <option value="todo" {{ request('status') == 'todo' ? 'selected' : '' }}>To Do</option>
            <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
        </select>
    </div>

    {{-- Tasks List --}}
    <div class="space-y-4">
        @forelse($tasks as $task)
        <a href="{{ route('tasks.show', ['team' => $team->id, 'task' => $task->id]) }}"
            class="block bg-white/5 border border-white/10 rounded-xl p-6 hover:bg-white/10 transition">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-white">{{ $task->title }}</h3>
                    @if($task->description)
                    <p class="text-sm text-white/60 mt-1">{{ Str::limit($task->description, 100) }}</p>
                    @endif
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    @if($task->status === 'done') bg-green-500/20 text-green-400
                    @elseif($task->status === 'in_progress') bg-yellow-500/20 text-yellow-400
                    @else bg-slate-500/20 text-slate-400 @endif">
                    {{ $task->status === 'done' ? 'Done' : ($task->status === 'in_progress' ? 'In Progress' : 'To Do') }}
                </span>
            </div>

            <div class="flex flex-wrap items-center gap-4 text-xs text-white/60">
                @if($task->category)
                <span class="inline-flex items-center gap-1">
                    <i class="fa-solid fa-folder"></i> {{ $task->category->name }}
                </span>
                @endif

                @if($task->due_at)
                <span class="inline-flex items-center gap-1">
                    <i class="fa-solid fa-calendar"></i> {{ $task->due_at->format('d M Y') }}
                </span>
                @endif

                @if($task->responsible)
                <span class="inline-flex items-center gap-1">
                    <i class="fa-solid fa-user"></i> {{ $task->responsible->user->name }}
                </span>
                @endif

                <span class="inline-flex items-center gap-1 ml-auto">
                    <i class="fa-solid fa-comment"></i> {{ $task->comments()->count() }}
                </span>

                <span class="inline-flex items-center gap-1">
                    <i class="fa-solid fa-paperclip"></i> {{ $task->attachments()->count() }}
                </span>
            </div>
        </a>
        @empty
        <div class="text-center py-12 bg-white/5 border border-white/10 rounded-xl">
            <i class="fa-solid fa-inbox text-4xl text-white/30 mb-3 block"></i>
            <p class="text-white/60">Belum ada task. <a href="{{ route('tasks.create', $team->id) }}" class="text-cyan-400 hover:text-cyan-300">Buat sekarang</a></p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($tasks->hasPages())
    <div class="mt-6">
        {{ $tasks->links() }}
    </div>
    @endif
</div>

<script>
    function filterTasks(filterType, value) {
        const url = new URL(window.location);

        if (value === '') {
            url.searchParams.delete(filterType);
        } else {
            url.searchParams.set(filterType, value);
        }

        window.location = url.toString();
    }
</script>
@endsection
