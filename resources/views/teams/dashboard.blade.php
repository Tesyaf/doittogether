@extends('layouts.team-app')

@section('content')
<style>
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .calendar-nav button {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        padding: 0.5rem 0.75rem;
        border-radius: 0.5rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .calendar-nav button:hover {
        background: rgba(255, 255, 255, 0.1);
    }

    .calendar {
        width: 100%;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 0.5rem;
        justify-items: center;
    }

    .calendar-day-header,
    .calendar-day {
        width: 100%;
        text-align: center;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 0.5rem;
        cursor: pointer;
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.7);
        transition: all 0.2s;
    }

    .calendar-day:hover {
        background: rgba(6, 182, 212, 0.1);
        border-color: rgba(6, 182, 212, 0.5);
    }

    .calendar-day.other-month {
        color: rgba(255, 255, 255, 0.3);
    }

    .calendar-day.today {
        background: rgba(6, 182, 212, 0.3);
        border-color: #06b6d4;
        color: white;
        font-weight: 600;
    }

    .calendar-day.has-tasks {
        background: rgba(34, 197, 94, 0.2);
        border-color: rgba(34, 197, 94, 0.5);
    }

    .calendar-day.selected {
        background: #06b6d4 !important;
        border-color: #06b6d4 !important;
        color: white;
    }
</style>

<div class="w-full max-w-6xl mx-auto px-4 space-y-8">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-slate-500">Ringkasan aktivitas tim</p>
            <h1 class="text-3xl font-semibold text-slate-900 dark:text-white">Team Dashboard</h1>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('tasks.create', $team->id) }}" class="inline-flex items-center px-4 py-2 rounded-lg bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-semibold shadow hover:from-cyan-600 hover:to-blue-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Buat Task
            </a>
            <a href="{{ route('teams.invite', $team->id) }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                <i class="fa-solid fa-user-plus mr-2"></i> Undang Anggota
            </a>
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-4">
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Total Task</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $taskStats['total'] }}</span>
            </div>
        </div>
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Task Selesai</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $taskStats['done'] }}</span>
                <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-700">{{ $taskStats['total'] > 0 ? round(($taskStats['done'] / $taskStats['total']) * 100) : 0 }}%</span>
            </div>
        </div>
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Anggota</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $totalMembers }}</span>
            </div>
        </div>
        <div class="col-span-2 md:col-span-1 bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl p-4 shadow">
            <p class="text-sm text-slate-500">Dalam Progress</p>
            <div class="flex items-end justify-between mt-2">
                <span class="text-3xl font-semibold text-slate-900 dark:text-white">{{ $taskStats['in_progress'] }}</span>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 space-y-6">
            {{-- Selected Date Tasks --}}
            <div id="selected-date-section" class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 hidden">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-slate-500">Task pada tanggal</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white" id="selected-date-title">-</h2>
                    </div>
                </div>
                <div id="selected-date-tasks" class="space-y-3">
                    <!-- Tasks akan ditampilkan di sini -->
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-slate-500">Daftar task</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Task Terbaru</h2>
                    </div>
                    <a href="{{ route('tasks.index', $team->id) }}" class="text-sm text-cyan-600 hover:text-cyan-700">Lihat semua</a>
                </div>
                <div class="space-y-3">
                    @forelse($recentTasks as $task)
                    <a href="{{ route('tasks.show', ['team' => $team->id, 'task' => $task->id]) }}" class="block p-3 rounded-lg bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800 hover:border-cyan-500 transition">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $task->title }}</p>
                                @if($task->category)
                                <p class="text-xs text-slate-500 mt-1">{{ $task->category->name }}</p>
                                @endif
                            </div>
                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($task->status === 'done') bg-green-100 text-green-700
                                @elseif($task->status === 'in_progress') bg-yellow-100 text-yellow-700
                                @else bg-slate-100 text-slate-700 @endif">
                                {{ $task->status === 'done' ? 'Done' : ($task->status === 'in_progress' ? 'In Progress' : 'To Do') }}
                            </span>
                        </div>
                    </a>
                    @empty
                    <p class="text-center text-slate-500 py-6">Belum ada task</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <p class="text-sm text-slate-500">Aktivitas terbaru</p>
                        <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Activity Feed</h2>
                    </div>
                    <a href="{{ route('teams.activity', $team->id) }}" class="text-sm text-cyan-600 hover:text-cyan-700">Lihat semua</a>
                </div>
                <div class="divide-y divide-slate-100 dark:divide-slate-800">
                    @forelse($activityLogs as $log)
                    <div class="flex items-start gap-3 py-3">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold">
                            {{ strtoupper(substr($log->actor->user->name ?? 'A', 0, 2)) }}
                        </div>
                        <div>
                            <p class="text-sm text-slate-900 dark:text-white"><span class="font-semibold">{{ $log->actor->user->name ?? 'Unknown' }}</span> {{ ucfirst($log->action) }}d {{ $log->entity_type }}</p>
                            <p class="text-xs text-slate-500">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-center text-slate-500 py-6">Belum ada aktivitas</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900/70 border border-slate-200 dark:border-slate-800 rounded-2xl shadow p-6 flex flex-col gap-4">
            {{-- Calendar Widget --}}
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-slate-500">Kalender</p>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Timeline</h2>
                </div>

                <div class="calendar bg-slate-50 dark:bg-slate-900/40 p-4 rounded-xl border border-slate-100 dark:border-slate-800">
                    <div class="calendar-header">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white" id="calendar-title">November 2025</h3>
                        <div class="calendar-nav flex gap-1">
                            <button onclick="previousMonth()" class="px-2 py-1 text-sm">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <button onclick="nextMonth()" class="px-2 py-1 text-sm">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>

                    <div class="calendar-grid" id="calendar-grid">
                        <!-- Calendar akan diisi dengan JavaScript -->
                    </div>
                </div>
            </div>

            <div class="h-px bg-slate-200 dark:bg-slate-700"></div>

            {{-- Members List --}}
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-slate-500">Anggota tim</p>
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Members</h2>
                </div>
            </div>
            <div class="space-y-3">
                @forelse($members as $member)
                <div class="flex items-center justify-between p-3 rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50/60 dark:bg-slate-900/40">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 text-white flex items-center justify-center font-semibold overflow-hidden">
                            @if($member->user && $member->user->avatar_url)
                                <img src="{{ $member->user->avatar_url }}" alt="{{ $member->user->name }}" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($member->user->name ?? 'A', 0, 2)) }}
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">{{ $member->user->name }}</p>
                            <p class="text-xs text-slate-500">{{ ucfirst($member->role) }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center text-slate-500 py-4">Belum ada anggota</p>
                @endforelse
            </div>
            <a href="{{ route('teams.members', $team->id) }}" class="w-full inline-flex items-center justify-center px-4 py-2.5 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-200 hover:border-cyan-500 hover:text-cyan-600 transition">
                Kelola anggota
            </a>
        </div>
    </div>
</div>

<script>
    let currentDate = new Date();
    let selectedDate = null;

    // Get all tasks data
    const allTasks = [
        @foreach($recentTasks as $task) {
            id: "{{ $task->id }}",
            title: "{{ $task->title }}",
            due_at: @if($task -> due_at)
            "{{ $task->due_at->format('Y-m-d') }}"
            @else null @endif,
            status: "{{ $task->status }}",
            category: @if($task -> category)
            "{{ $task->category->name }}"
            @else null @endif,
        },
        @endforeach
    ];

    // Get tasks with deadlines
    const taskDeadlines = allTasks.filter(t => t.due_at).map(t => t.due_at);

    function getTasksForDate(dateStr) {
        return allTasks.filter(task => task.due_at === dateStr);
    }

    function displaySelectedDateTasks(dateStr) {
        const tasks = getTasksForDate(dateStr);
        const section = document.getElementById('selected-date-section');
        const tasksContainer = document.getElementById('selected-date-tasks');
        const dateTitle = document.getElementById('selected-date-title');

        const date = new Date(dateStr);
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        dateTitle.textContent = date.toLocaleDateString('id-ID', options);

        if (tasks.length === 0) {
            tasksContainer.innerHTML = '<p class="text-center text-slate-500 py-6">Tidak ada task pada hari ini</p>';
        } else {
            tasksContainer.innerHTML = tasks.map(task => `
                <a href="{{ route('tasks.index', $team->id) }}" class="block p-3 rounded-lg bg-slate-50 dark:bg-slate-900/40 border border-slate-100 dark:border-slate-800 hover:border-cyan-500 transition">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">${task.title}</p>
                            ${task.category ? `<p class="text-xs text-slate-500 mt-1">${task.category}</p>` : ''}
                        </div>
                        <span class="px-2 py-1 rounded text-xs font-semibold
                            ${task.status === 'done' ? 'bg-green-100 text-green-700' : task.status === 'in_progress' ? 'bg-yellow-100 text-yellow-700' : 'bg-slate-100 text-slate-700'}">
                            ${task.status === 'done' ? 'Done' : task.status === 'in_progress' ? 'In Progress' : 'To Do'}
                        </span>
                    </div>
                </a>
            `).join('');
        }

        section.classList.remove('hidden');
    }

    function renderCalendar() {
        const year = currentDate.getFullYear();
        const month = currentDate.getMonth();

        // Update title
        const monthNames = ['January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        document.getElementById('calendar-title').textContent = `${monthNames[month]} ${year}`;

        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const daysInPrevMonth = new Date(year, month, 0).getDate();

        const calendarGrid = document.getElementById('calendar-grid');
        calendarGrid.innerHTML = '';

        // Day headers
        const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayHeaders.forEach(day => {
            const header = document.createElement('div');
            header.className = 'calendar-day-header';
            header.textContent = day;
            calendarGrid.appendChild(header);
        });

        // Previous month days
        for (let i = firstDay - 1; i >= 0; i--) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.textContent = daysInPrevMonth - i;
            calendarGrid.appendChild(day);
        }

        // Current month days
        for (let i = 1; i <= daysInMonth; i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day';
            day.textContent = i;

            const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
            const today = new Date();
            const isToday = today.getFullYear() === year && today.getMonth() === month && today.getDate() === i;
            const hasTasks = taskDeadlines.includes(dateStr);
            const isSelected = selectedDate === dateStr;

            if (isSelected) {
                day.classList.add('selected');
            } else if (isToday) {
                day.classList.add('today');
            } else if (hasTasks) {
                day.classList.add('has-tasks');
            }

            day.style.cursor = 'pointer';
            day.addEventListener('click', () => {
                selectedDate = dateStr;
                renderCalendar();
                displaySelectedDateTasks(dateStr);
            });

            calendarGrid.appendChild(day);
        }

        // Next month days
        const totalCells = calendarGrid.children.length - 7; // Subtract day headers
        const remainingCells = 42 - totalCells;
        for (let i = 1; i <= remainingCells; i++) {
            const day = document.createElement('div');
            day.className = 'calendar-day other-month';
            day.textContent = i;
            calendarGrid.appendChild(day);
        }
    }

    function previousMonth() {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar();
    }

    function nextMonth() {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar();
    }

    // Initial render
    renderCalendar();
</script>
@endsection
