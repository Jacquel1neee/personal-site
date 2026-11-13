@extends('admin.layouts.app')

@section('title', __('admin.dashboard'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.dashboard') }}</h1>
        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
            Welcome back, {{ auth()->user()->name }} 👋
        </p>
    </div>

    @if($stats['unread_messages'] > 0)
        <div class="mb-8 flex items-center justify-between rounded-2xl border border-blue-200 bg-blue-50 p-4 dark:border-blue-900/50 dark:bg-blue-900/20">
            <div class="flex items-center gap-3 text-blue-800 dark:text-blue-300">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="font-medium">You have {{ $stats['unread_messages'] }} unread message(s)!</span>
            </div>
            <a href="{{ route('admin.messages.index') }}" class="text-sm font-semibold text-blue-600 hover:underline dark:text-blue-400">View Messages</a>
        </div>
    @endif

    {{-- 统计卡片 --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @php
            $cards = [
                ['label' => __('admin.projects'), 'value' => $stats['projects'], 'route' => 'admin.projects.index', 'color' => 'purple'],
                ['label' => __('admin.skills'), 'value' => $stats['skills'], 'route' => 'admin.skills.index', 'color' => 'blue'],
                ['label' => __('admin.messages'), 'value' => $stats['messages'], 'route' => 'admin.messages.index', 'color' => 'green'],
                ['label' => __('admin.experiences'), 'value' => $stats['experiences'], 'route' => 'admin.experiences.index', 'color' => 'orange'],
            ];
        @endphp

        @foreach ($cards as $card)
            <a href="{{ route($card['route']) }}" class="group rounded-2xl border border-zinc-200 bg-white p-5 transition hover:border-zinc-300 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">
                <div class="text-xs uppercase tracking-wider text-zinc-500 dark:text-zinc-400">{{ $card['label'] }}</div>
                <div class="mt-2 text-4xl font-semibold tracking-tight text-{{ $card['color'] }}-600 dark:text-{{ $card['color'] }}-400">{{ $card['value'] }}</div>
                <div class="mt-2 text-xs text-zinc-400 transition group-hover:text-zinc-600 dark:group-hover:text-zinc-300">View all →</div>
            </a>
        @endforeach
    </div>

    {{-- 最近留言 --}}
    <div class="mt-8">
        <h2 class="text-lg font-medium mb-4">Recent Messages</h2>
        <div class="rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
            @forelse($recent_messages as $msg)
                <div class="flex items-start gap-4 border-b border-zinc-100 p-4 last:border-0 dark:border-zinc-800">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-zinc-100 font-semibold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                        {{ strtoupper(substr($msg->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="flex items-center gap-2">
                            <span class="font-medium">{{ $msg->name }}</span>
                            @if(!$msg->is_read)
                                <span class="rounded-full bg-blue-100 px-1.5 py-0.5 text-[10px] font-bold text-blue-600 dark:bg-blue-900/40 dark:text-blue-400">NEW</span>
                            @endif
                        </div>
                        <p class="mt-1 truncate text-sm text-zinc-500 dark:text-zinc-400">{{ $msg->content }}</p>
                    </div>
                    <a href="{{ route('admin.messages.index') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">View</a>
                </div>
            @empty
                <div class="p-8 text-center text-sm text-zinc-500 dark:text-zinc-400">No messages yet.</div>
            @endforelse
        </div>
    </div>
@endsection