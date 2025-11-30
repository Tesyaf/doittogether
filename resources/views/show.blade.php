@extends('layouts.app')

@section('title', $task->title . ' – ' . $team->name)

@section('content')
<div class="w-full px-4 text-white">
    <div class="max-w-5xl mx-auto space-y-6">
        <div class="flex items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold mb-1">{{ $task->title }}</h1>
                <p class="text-sm text-slate-400">
                    Status: <span class="font-medium">{{ $task->status }}</span>
                    · Due: {{ optional($task->due_at)->format('Y-m-d') ?? '-' }}
                </p>
            </div>

            <div class="space-x-2">
                <button class="px-3 py-2 text-xs rounded-lg bg-slate-800">Edit</button>
                <button class="px-3 py-2 text-xs rounded-lg bg-emerald-600">Mark as Done</button>
            </div>
        </div>

        <section class="bg-slate-900 rounded-xl p-4">
            <h2 class="text-sm font-semibold mb-2">Description</h2>
            <p class="text-sm text-slate-200">
                {{ $task->description ?? 'Belum ada deskripsi.' }}
            </p>
        </section>

        <div class="grid md:grid-cols-3 gap-4">
            <section class="bg-slate-900 rounded-xl p-4 md:col-span-1">
                <h2 class="text-sm font-semibold mb-2">Assignees</h2>
                <ul class="text-sm space-y-1">
                    <li>Contoh member (responsible)</li>
                </ul>
            </section>

            <section class="bg-slate-900 rounded-xl p-4 md:col-span-2">
                <h2 class="text-sm font-semibold mb-2">Comments</h2>

                <form class="mb-3">
                    <textarea
                        rows="2"
                        class="w-full rounded-lg bg-slate-950 border border-slate-700 text-sm px-3 py-2"
                        placeholder="Tulis komentar..."></textarea>
                    <div class="mt-2 text-right">
                        <button type="submit"
                                class="px-3 py-1 text-xs rounded-lg bg-cyan-500 hover:bg-cyan-600">
                            Kirim
                        </button>
                    </div>
                </form>

                <div class="space-y-3 text-sm">
                    <div class="border-t border-slate-800 pt-2">
                        <div class="font-medium text-slate-200">Contoh Member</div>
                        <div class="text-xs text-slate-500 mb-1">2 menit lalu</div>
                        <p>Ini contoh komentar.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
