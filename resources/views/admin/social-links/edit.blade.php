@extends('admin.layouts.app')

@section('title', __('admin.edit_social_link'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.edit_social_link') }}</h1>
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

    <form action="{{ route('admin.social-links.update', $link) }}" method="POST" class="max-w-xl space-y-6">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.platform') }}</label>
            <input type="text" name="platform" value="{{ old('platform', $link->platform) }}" required
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.url') }}</label>
            <input type="text" name="url" value="{{ old('url', $link->url) }}" required
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.social_icon') }}</label>
            <input type="text" name="icon" value="{{ old('icon', $link->icon) }}"
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            <p class="mt-1 text-xs text-zinc-500">{{ __('admin.social_icon_hint') }}</p>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.update_social_link') }}
            </button>
            <a href="{{ route('admin.social-links.index') }}" class="text-sm text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">{{ __('admin.cancel') }}</a>
        </div>
    </form>
@endsection