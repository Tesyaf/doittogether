@extends('layouts.app')

@section('content')
<div class="w-full max-w-2xl bg-white dark:bg-slate-800 shadow-md rounded-2xl p-8">
    <h2 class="text-2xl font-semibold text-slate-800 dark:text-white mb-6 text-center">
        Category Management
    </h2>

    <div class="mb-6">
        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
            Add New Category
        </label>
        <div class="flex gap-3">
            <input type="text"
                   placeholder="Category name..."
                   class="flex-1 px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-cyan-500 outline-none">
            <button class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-xl transition">
                Add
            </button>
        </div>
    </div>

    <hr class="my-6 border-slate-300 dark:border-slate-600">

    <h3 class="text-lg font-semibold text-slate-700 dark:text-slate-300 mb-4">Existing Categories</h3>

    <ul class="space-y-3">
        <li class="flex items-center justify-between bg-slate-100 dark:bg-slate-700 px-4 py-3 rounded-xl">
            <span class="text-slate-800 dark:text-white">UI/UX</span>
            <button class="text-red-500 hover:text-red-600">Delete</button>
        </li>
        <li class="flex items-center justify-between bg-slate-100 dark:bg-slate-700 px-4 py-3 rounded-xl">
            <span class="text-slate-800 dark:text-white">Backend</span>
            <button class="text-red-500 hover:text-red-600">Delete</button>
        </li>
    </ul>
</div>
@endsection