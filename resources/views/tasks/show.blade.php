@extends('layouts.team-app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6">
    {{-- Header & Actions --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between mb-6">
        <div class="flex-1 min-w-0">
            <a href="{{ route('tasks.index', $team->id) }}" class="text-cyan-400 hover:text-cyan-300 text-sm mb-3 inline-flex items-center gap-1">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Tasks
            </a>
            <h1 class="text-3xl font-bold text-white break-words">{{ $task->title }}</h1>
            @if($task->description)
            <p class="text-white/60 mt-2 break-words">{{ $task->description }}</p>
            @endif
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('tasks.edit', ['team' => $team->id, 'task' => $task->id]) }}"
                class="inline-flex items-center px-4 py-2 rounded-lg bg-white/10 hover:bg-white/20 transition text-white">
                <i class="fa-solid fa-edit mr-2"></i> Edit
            </a>
            <form method="POST" action="{{ route('tasks.destroy', ['team' => $team->id, 'task' => $task->id]) }}" class="inline" onsubmit="return confirm('Yakin hapus task ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-red-500/20 hover:bg-red-500/30 transition text-red-400">
                    <i class="fa-solid fa-trash mr-2"></i> Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content (Tabs) --}}
        <div class="lg:col-span-2 space-y-4">
            {{-- Tabs Navigation --}}
            <div class="flex gap-2 overflow-x-auto bg-white/5 border-b border-white/10 rounded-t-xl px-2 sm:px-0">
                <button onclick="switchTab('comments')" class="tab-btn active flex-shrink-0 px-4 sm:px-6 py-3 border-b-2 border-cyan-500 text-white font-semibold transition" data-tab="comments">
                    <i class="fa-solid fa-comments mr-2"></i> Comments
                </button>
                <button onclick="switchTab('attachments')" class="tab-btn flex-shrink-0 px-4 sm:px-6 py-3 border-b-2 border-transparent text-white/60 hover:text-white transition" data-tab="attachments">
                    <i class="fa-solid fa-paperclip mr-2"></i> Attachments
                </button>
                <button onclick="switchTab('assignees')" class="tab-btn flex-shrink-0 px-4 sm:px-6 py-3 border-b-2 border-transparent text-white/60 hover:text-white transition" data-tab="assignees">
                    <i class="fa-solid fa-users mr-2"></i> Assignees
                </button>
                <button onclick="switchTab('activity')" class="tab-btn flex-shrink-0 px-4 sm:px-6 py-3 border-b-2 border-transparent text-white/60 hover:text-white transition" data-tab="activity">
                    <i class="fa-solid fa-history mr-2"></i> Activity
                </button>
            </div>

            {{-- Comments Tab --}}
            <div id="comments" class="tab-content block space-y-4 bg-white/5 border border-white/10 rounded-b-xl p-6">
                {{-- Add Comment Form --}}
                <form method="POST" action="{{ route('tasks.comments.store', ['team' => $team->id, 'task' => $task->id]) }}" class="mb-6">
                    @csrf
                    <textarea name="body" placeholder="Tambah komentar..." required
                        class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/50 resize-none" rows="3"></textarea>
                    <button type="submit" class="mt-2 px-4 py-2 rounded-lg bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold">
                        <i class="fa-solid fa-paper-plane mr-2"></i> Kirim
                    </button>
                </form>

                {{-- Comments List --}}
                <div class="space-y-4">
                    @forelse($task->comments as $comment)
                    <div class="bg-white/5 border border-white/10 rounded-lg p-4">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-xs font-semibold text-white">
                                    {{ strtoupper(substr($comment->member->user->name ?? 'A', 0, 1)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-white">{{ $comment->member->user->name ?? 'Unknown' }}</p>
                                    <p class="text-xs text-white/50">{{ $comment->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="text-white/80">{{ $comment->body }}</p>
                    </div>
                    @empty
                    <p class="text-center text-white/60 py-4">Belum ada komentar. Mulai percakapan!</p>
                    @endforelse
                </div>
            </div>

            {{-- Attachments Tab --}}
            <div id="attachments" class="tab-content hidden space-y-4 bg-white/5 border border-white/10 rounded-b-xl p-6">
                {{-- Upload Form --}}
                <form method="POST" action="{{ route('tasks.attachments.store', ['team' => $team->id, 'task' => $task->id]) }}" enctype="multipart/form-data" class="mb-6">
                    @csrf
                    <div class="border-2 border-dashed border-white/20 rounded-lg p-6 text-center hover:border-white/40 transition">
                        <input type="file" name="file" id="file-input" class="hidden" onchange="document.querySelector('label[for=file-input]').textContent = this.files[0].name">
                        <label for="file-input" class="cursor-pointer block">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl text-white/60 mb-2 block"></i>
                            <p class="text-white/60">Klik atau drag file di sini</p>
                        </label>
                    </div>
                    <button type="submit" class="mt-2 px-4 py-2 rounded-lg bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold w-full">
                        Upload
                    </button>
                </form>

                {{-- Attachments List --}}
                <div class="space-y-3">
                    @forelse($task->attachments as $attachment)
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 bg-white/5 border border-white/10 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <i class="fa-solid fa-file text-cyan-400"></i>
                            <div>
                                <p class="text-sm font-semibold text-white break-words">{{ $attachment->file_name }}</p>
                                <p class="text-xs text-white/50">{{ $attachment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <a href="{{ $attachment->file_url }}" target="_blank" class="text-cyan-400 hover:text-cyan-300">
                                <i class="fa-solid fa-download"></i>
                            </a>
                            <form method="POST" action="{{ route('tasks.attachments.destroy', ['team' => $team->id, 'task' => $task->id, 'attachment' => $attachment->id]) }}" class="inline" onsubmit="return confirm('Hapus attachment ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-white/60 py-4">Belum ada attachment</p>
                    @endforelse
                </div>
            </div>

            {{-- Assignees Tab --}}
            <div id="assignees" class="tab-content hidden space-y-4 bg-white/5 border border-white/10 rounded-b-xl p-6">
                {{-- Add Assignee Form --}}
                <form method="POST" action="{{ route('tasks.assignees.store', ['team' => $team->id, 'task' => $task->id]) }}" class="mb-6">
                    @csrf
                    <div class="flex gap-2">
                        <select name="member_id" class="flex-1 bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white" required>
                            <option value="">Pilih anggota tim...</option>
                            @foreach($members as $member)
                            @unless($task->assignees->contains($member->id_member))
                            <option value="{{ $member->id_member }}">{{ $member->user->name }}</option>
                            @endunless
                            @endforeach
                        </select>
                        <button type="submit" class="px-4 py-2 rounded-lg bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </form>

                {{-- Assignees List --}}
                <div class="space-y-2">
                    @forelse($task->assignees as $assignee)
                    <div class="flex items-center justify-between bg-white/5 border border-white/10 rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-xs font-semibold text-white">
                                {{ strtoupper(substr($assignee->user->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-white">{{ $assignee->user->name }}</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('tasks.assignees.destroy', ['team' => $team->id, 'task' => $task->id, 'assignee' => $assignee->id_member]) }}" class="inline" onsubmit="return confirm('Hapus assignee ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @empty
                    <p class="text-center text-white/60 py-4">Belum ada assignee</p>
                    @endforelse
                </div>
            </div>

            {{-- Activity Tab --}}
            <div id="activity" class="tab-content hidden space-y-4 bg-white/5 border border-white/10 rounded-b-xl p-6">
                @forelse($activityLogs as $log)
                <div class="flex gap-4">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex-shrink-0 flex items-center justify-center text-xs font-semibold text-white">
                        {{ strtoupper(substr($log->actor->user->name ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-white"><span class="font-semibold">{{ $log->actor->user->name ?? 'Unknown' }}</span>
                            {{ ucfirst($log->action) }}d
                            <span class="text-cyan-400">{{ $log->entity_type }}</span>
                        </p>
                        <p class="text-xs text-white/50 mt-1">{{ $log->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @empty
                <p class="text-center text-white/60 py-4">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>

        {{-- Sidebar (Meta Info) --}}
        <div class="space-y-4">
            {{-- Status --}}
            <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                <p class="text-xs text-white/60 mb-2">Status</p>
                <form method="POST" action="{{ route('tasks.update', ['team' => $team->id, 'task' => $task->id]) }}" class="inline">
                    @csrf @method('PUT')
                    <select name="status" onchange="this.form.submit()" class="w-full bg-white/10 border border-white/20 rounded-lg px-3 py-2 text-white text-sm">
                        <option value="todo" @selected($task->status === 'todo')>To Do</option>
                        <option value="in_progress" @selected($task->status === 'in_progress')>In Progress</option>
                        <option value="done" @selected($task->status === 'done')>Done</option>
                    </select>
                    <input type="hidden" name="title" value="{{ $task->title }}">
                </form>
            </div>

            <div class="grid gap-3 sm:gap-4">
                {{-- Due Date --}}
                @if($task->due_at)
                <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <p class="text-xs text-white/60 mb-2">Tanggal Deadline</p>
                    <p class="text-white font-semibold">{{ $task->due_at->format('d M Y') }}</p>
                </div>
                @endif

                {{-- Category --}}
                @if($task->category)
                <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <p class="text-xs text-white/60 mb-2">Kategori</p>
                    <p class="text-white font-semibold">{{ $task->category->name }}</p>
                </div>
                @endif

                {{-- Responsible --}}
                @if($task->responsible)
                <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <p class="text-xs text-white/60 mb-2">Penanggung Jawab</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-xs font-semibold text-white">
                            {{ strtoupper(substr($task->responsible->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <p class="text-white">{{ $task->responsible->user->name }}</p>
                    </div>
                </div>
                @endif

                {{-- Created By --}}
                <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <p class="text-xs text-white/60 mb-2">Dibuat oleh</p>
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-xs font-semibold text-white">
                            {{ strtoupper(substr($task->creator->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <p class="text-white">{{ $task->creator->user->name ?? 'Unknown' }}</p>
                    </div>
                </div>

                {{-- Timestamps --}}
                <div class="bg-white/5 border border-white/10 rounded-xl p-4">
                    <p class="text-xs text-white/60 mb-3">Informasi</p>
                    <div class="space-y-2 text-xs text-white/60">
                        <p><span class="text-white/40">Dibuat:</span> {{ $task->created_at->format('d M Y, H:i') }}</p>
                        <p><span class="text-white/40">Diperbarui:</span> {{ $task->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.tab-btn').forEach(el => {
            el.classList.remove('active', 'border-cyan-500', 'text-white');
            el.classList.add('border-transparent', 'text-white/60');
        });

        // Show selected tab
        document.getElementById(tabName).classList.remove('hidden');
        document.querySelector(`[data-tab="${tabName}"]`).classList.add('active', 'border-cyan-500', 'text-white');
        document.querySelector(`[data-tab="${tabName}"]`).classList.remove('border-transparent', 'text-white/60');
    }
</script>
@endsection
