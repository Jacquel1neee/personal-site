@extends('admin.layouts.app')

@section('title', __('admin.messages'))

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.messages') }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('admin.messages_desc') }}</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($messages as $msg)
            <div class="rounded-2xl border {{ $msg->is_read ? 'border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900' : 'border-blue-200 bg-blue-50/30 dark:border-blue-900/50 dark:bg-blue-900/10' }} p-6 transition hover:shadow-sm">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="font-semibold">{{ $msg->name }}</h3>
                            @if(!$msg->is_read)
                                <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/40 dark:text-blue-400">
                                    {{ __('admin.unread') }}
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $msg->email }}</p>
                    </div>
                    <span class="text-xs text-zinc-400">{{ $msg->created_at->diffForHumans() }}</span>
                </div>

                <p class="mt-4 text-sm leading-relaxed text-zinc-700 dark:text-zinc-300 whitespace-pre-wrap">{{ $msg->content }}</p>

                <div class="mt-6 flex items-center justify-end gap-3 text-sm">
                    <form action="{{ route('admin.messages.toggle-read', $msg) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="text-blue-600 hover:underline dark:text-blue-400">
                            {{ $msg->is_read ? __('admin.mark_as_unread') : __('admin.mark_as_read') }}
                        </button>
                    </form>
                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('{{ __('admin.delete_confirm') }}');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline dark:text-red-400">{{ __('admin.delete') }}</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="rounded-2xl border border-dashed border-zinc-300 p-12 text-center dark:border-zinc-700">
                <p class="text-zinc-500 dark:text-zinc-400">{{ __('admin.no_messages') }}</p>
            </div>
        @endforelse
    </div>
@endsection