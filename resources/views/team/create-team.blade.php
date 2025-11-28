@extends('layouts.app')

@section('content')
<div class="w-full max-w-lg bg-white dark:bg-slate-800 shadow-md rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-slate-800 dark:text-white mb-6 text-center">
        Create Team
    </h2>

    <form>
        <div class="mb-5">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Team Name
            </label>
            <input type="text"
                   class="w-full px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none">
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                Description (Optional)
            </label>
            <textarea
                class="w-full px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none"></textarea>
        </div>

        <button class="w-full bg-cyan-600 hover:bg-cyan-700 text-white py-2 rounded-xl font-medium transition">
            Create Team
        </button>
    </form>
</div>
@endsection