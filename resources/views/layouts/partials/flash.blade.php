@php
    $hasFlash = session('success') || session('error') || session('warning');
@endphp
@if($hasFlash)
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" x-transition.opacity class="max-w-6xl mx-auto mb-4 px-4 sm:px-6">
        @if (session('success'))
            <div class="mb-2 rounded-xl border border-emerald-500/40 bg-emerald-500/15 text-emerald-100 px-4 py-3 text-sm">
                {{ session('success') }}
            </div>
        @endif
        @if (session('warning'))
            <div class="mb-2 rounded-xl border border-amber-500/40 bg-amber-500/15 text-amber-100 px-4 py-3 text-sm">
                {{ session('warning') }}
            </div>
        @endif
        @if (session('error'))
            <div class="mb-2 rounded-xl border border-red-500/40 bg-red-500/15 text-red-100 px-4 py-3 text-sm">
                {{ session('error') }}
            </div>
        @endif
    </div>
@endif
