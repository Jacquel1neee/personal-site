@extends('admin.layouts.app')

@section('title', __('admin.edit_hobby'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.edit_hobby') }}</h1>
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

    <form action="{{ route('admin.hobbies.update', $hobby) }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.hobby_name_zh') }}</label>
                <input type="text" name="name_zh" value="{{ old('name_zh', $hobby->name_zh) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.hobby_name_en') }}</label>
                <input type="text" name="name_en" value="{{ old('name_en', $hobby->name_en) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.icon') }}</label>
            <input type="text" name="icon" value="{{ old('icon', $hobby->icon) }}" placeholder="🥋"
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            <p class="mt-1 text-xs text-zinc-500">{{ __('admin.icon_hint') }}</p>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.hobby_desc_zh') }}</label>
                <textarea name="description_zh" rows="3" class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('description_zh', $hobby->description_zh) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.hobby_desc_en') }}</label>
                <textarea name="description_en" rows="3" class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('description_en', $hobby->description_en) }}</textarea>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.update_hobby') }}
            </button>
            <a href="{{ route('admin.hobbies.index') }}" class="text-sm text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">{{ __('admin.cancel') }}</a>
        </div>
    </form>
@endsection