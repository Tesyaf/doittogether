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

    input[type="date"] {
        color-scheme: dark;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1) brightness(1.2);
        cursor: pointer;
    }
</style>

<div class="max-w-3xl mx-auto px-4 sm:px-6">
    <div class="mb-6">
        <a href="{{ route('tasks.show', ['team' => $team->id, 'task' => $task->id]) }}" class="text-cyan-400 hover:text-cyan-300 text-sm mb-3 inline-flex items-center gap-1">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Task
        </a>
        <h1 class="text-3xl font-bold text-white">Edit Task</h1>
    </div>

    <form method="POST" action="{{ route('tasks.update', ['team' => $team->id, 'task' => $task->id]) }}" class="space-y-6 bg-white/5 border border-white/10 rounded-xl p-6 backdrop-blur-sm">
        @csrf
        @method('PUT')

        {{-- Title --}}
        <div>
            <label class="block text-sm font-semibold text-white mb-2">Judul Task *</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/50 focus:border-cyan-500 focus:outline-none transition"
                placeholder="Masukkan judul task...">
            @error('title')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div>
            <label class="block text-sm font-semibold text-white mb-2">Deskripsi</label>
            <textarea name="description" rows="5"
                class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/50 focus:border-cyan-500 focus:outline-none transition resize-none"
                placeholder="Masukkan deskripsi task...">{{ old('description', $task->description) }}</textarea>
            @error('description')
            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Category --}}
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Kategori</label>
                <select name="category_id"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:border-cyan-500 focus:outline-none transition">
                    <option value="">Pilih kategori...</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $task->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Status *</label>
                <select name="status" required
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:border-cyan-500 focus:outline-none transition">
                    <option value="todo" @selected(old('status', $task->status) == 'todo')>To Do</option>
                    <option value="in_progress" @selected(old('status', $task->status) == 'in_progress')>In Progress</option>
                    <option value="done" @selected(old('status', $task->status) == 'done')>Done</option>
                </select>
                @error('status')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Due Date --}}
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Tanggal Deadline</label>
                <input type="date" name="due_at" id="due_at" value="{{ old('due_at', $task->due_at?->format('Y-m-d')) }}"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:border-cyan-500 focus:outline-none transition"
                    onchange="validateDeadline()">
                <p id="deadline-error" class="text-red-400 text-sm mt-1 hidden">Deadline tidak boleh di masa lalu!</p>
                @error('due_at')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Responsible Member --}}
            <div>
                <label class="block text-sm font-semibold text-white mb-2">Penanggung Jawab</label>
                <select name="responsible_member_id"
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white focus:border-cyan-500 focus:outline-none transition">
                    <option value="">Pilih anggota...</option>
                    @foreach($members as $member)
                    <option value="{{ $member->id_member }}" @selected(old('responsible_member_id', $task->responsible_member_id) == $member->id_member)>
                        {{ $member->user->name }}
                    </option>
                    @endforeach
                </select>
                @error('responsible_member_id')
                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex gap-3 pt-4">
            <button type="submit" id="submit-btn" class="flex-1 px-6 py-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 transition text-white font-semibold">
                <i class="fa-solid fa-check mr-2"></i> Simpan Perubahan
            </button>
            <a href="{{ route('tasks.show', ['team' => $team->id, 'task' => $task->id]) }}" class="flex-1 px-6 py-3 rounded-lg bg-white/10 hover:bg-white/20 transition text-white font-semibold text-center">
                <i class="fa-solid fa-xmark mr-2"></i> Batal
            </a>
        </div>
    </form>
</div>

<script>
    function validateDeadline() {
        const dueDateInput = document.getElementById('due_at');
        const deadlineError = document.getElementById('deadline-error');
        const submitBtn = document.getElementById('submit-btn');

        if (!dueDateInput.value) {
            deadlineError.classList.add('hidden');
            submitBtn.disabled = false;
            return true;
        }

        const selectedDate = new Date(dueDateInput.value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        if (selectedDate < today) {
            deadlineError.classList.remove('hidden');
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            return false;
        } else {
            deadlineError.classList.add('hidden');
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            return true;
        }
    }

    // Validate on page load if there's a previous value
    document.addEventListener('DOMContentLoaded', validateDeadline);
</script>
@endsection
