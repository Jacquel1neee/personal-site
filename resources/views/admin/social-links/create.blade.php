@extends('admin.layouts.app')

@section('title', __('admin.add_social_link'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.add_social_link') }}</h1>
    </div>

    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-400">
            <ul class="list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.social-links.store') }}" method="POST" class="max-w-xl space-y-6">
        @csrf
        
        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.platform') }}</label>
            <input type="text" name="platform" value="{{ old('platform') }}" required placeholder="GitHub"
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            <p class="mt-1 text-xs text-zinc-500">{{ __('admin.platform_hint') }}</p>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.url') }}</label>
            <input type="text" name="url" value="{{ old('url') }}" required placeholder="https://..."
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.social_icon') }}</label>
            <input type="text" name="icon" value="{{ old('icon') }}" placeholder="🐙"
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            <p class="mt-1 text-xs text-zinc-500">{{ __('admin.social_icon_hint') }}</p>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.save_social_link') }}
            </button>
            <a href="{{ route('admin.social-links.index') }}" class="text-sm text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">{{ __('admin.cancel') }}</a>
        </div>
    </form>
@endsection