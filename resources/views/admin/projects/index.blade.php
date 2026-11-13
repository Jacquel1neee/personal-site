@extends('admin.layouts.app')

@section('title', __('admin.projects'))

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.projects') }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('admin.projects_desc') }}</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="rounded-full bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
            + {{ __('admin.add_project') }}
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
        <table class="w-full text-left text-sm">
            <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900/50 dark:text-zinc-400">
                <tr>
                    <th class="px-6 py-3 font-medium">{{ __('admin.cover_image') }}</th>
                    <th class="px-6 py-3 font-medium">{{ __('admin.title_zh') }}</th>
                    <th class="px-6 py-3 font-medium">{{ __('admin.project_category') }}</th>
                    <th class="px-6 py-3 font-medium text-right">{{ __('admin.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($projects as $proj)
                    <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        <td class="px-6 py-4">
                            @if($proj->image_path)
                                <img src="{{ Storage::url($proj->image_path) }}" alt="{{ $proj->title_zh }}" class="h-10 w-16 rounded object-cover">
                            @else
                                <div class="h-10 w-16 rounded bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-xs text-zinc-400">No img</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium">
                            {{ app()->getLocale() === 'zh' ? $proj->title_zh : $proj->title_en }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-full bg-purple-50 px-2.5 py-0.5 text-xs font-medium text-purple-700 dark:bg-purple-900/30 dark:text-purple-400">
                                {{ $proj->category_translated }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.projects.edit', $proj) }}" class="text-blue-600 hover:underline dark:text-blue-400">{{ __('admin.edit') }}</a>
                            <form action="{{ route('admin.projects.destroy', $proj) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('{{ __('admin.delete_confirm') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline dark:text-red-400">{{ __('admin.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-zinc-500 dark:text-zinc-400">{{ __('admin.no_projects') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection