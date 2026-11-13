@extends('admin.layouts.app')

@section('title', __('admin.experiences'))

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.experiences') }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('admin.experiences_desc') }}</p>
        </div>
        <a href="{{ route('admin.experiences.create') }}" class="rounded-full bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
            + {{ __('admin.add_experience') }}
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
                    <th class="px-6 py-3 font-medium">{{ app()->getLocale() === 'zh' ? '职位' : 'Role' }}</th>
                    <th class="px-6 py-3 font-medium">{{ app()->getLocale() === 'zh' ? '公司' : 'Company' }}</th>
                    <th class="px-6 py-3 font-medium">{{ __('admin.start_date') }}</th>
                    <th class="px-6 py-3 font-medium">{{ __('admin.end_date') }}</th>
                    <th class="px-6 py-3 font-medium text-right">{{ __('admin.actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($experiences as $exp)
                    <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                        {{-- 职位：自动根据语言切换 --}}
                        <td class="px-6 py-4 font-medium">
                            {{ app()->getLocale() === 'zh' ? $exp->role_zh : $exp->role_en }}
                        </td>
                        
                        {{-- 公司：自动根据语言切换 --}}
                        <td class="px-6 py-4">
                            {{ app()->getLocale() === 'zh' ? $exp->company_zh : $exp->company_en }}
                        </td>
                        
                        <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400">{{ $exp->start_date->format('Y-m') }}</td>
                        <td class="px-6 py-4 text-zinc-500 dark:text-zinc-400">
                            {{ $exp->end_date ? $exp->end_date->format('Y-m') : __('admin.present') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.experiences.edit', $exp) }}" class="text-blue-600 hover:underline dark:text-blue-400">{{ __('admin.edit') }}</a>
                            <form action="{{ route('admin.experiences.destroy', $exp) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('{{ __('admin.delete_confirm') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline dark:text-red-400">{{ __('admin.delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-zinc-500 dark:text-zinc-400">{{ __('admin.no_experiences') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection