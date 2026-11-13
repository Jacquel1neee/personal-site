@extends('admin.layouts.app')

@section('title', __('admin.edit_experience'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.edit_experience') }}</h1>
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

    <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.company_zh') }}</label>
                <input type="text" name="company_zh" value="{{ old('company_zh', $experience->company_zh) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.company_en') }}</label>
                <input type="text" name="company_en" value="{{ old('company_en', $experience->company_en) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.role_zh') }}</label>
                <input type="text" name="role_zh" value="{{ old('role_zh', $experience->role_zh) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.role_en') }}</label>
                <input type="text" name="role_en" value="{{ old('role_en', $experience->role_en) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.start_date') }}</label>
                <input type="month" name="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m')) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.end_date') }}</label>
                <input type="month" name="end_date" id="end_date" value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m') : '') }}"
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
                <label class="mt-2 flex items-center gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                    <input type="checkbox" name="is_current" value="1" id="is_current" class="rounded border-zinc-300 text-blue-600 focus:ring-blue-500" {{ old('is_current', !$experience->end_date) ? 'checked' : '' }}>
                    {{ __('admin.is_current') }}
                </label>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.description_zh') }}</label>
                <textarea name="description_zh" rows="3" class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('description_zh', $experience->description_zh) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.description_en') }}</label>
                <textarea name="description_en" rows="3" class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('description_en', $experience->description_en) }}</textarea>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.update_experience') }}
            </button>
            <a href="{{ route('admin.experiences.index') }}" class="text-sm text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">{{ __('admin.cancel') }}</a>
        </div>
    </form>

    <script>
        const isCurrent = document.getElementById('is_current');
        const endDate = document.getElementById('end_date');

        function toggleEndDate() {
            if (isCurrent.checked) {
                endDate.value = '';
                endDate.disabled = true;
                endDate.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                endDate.disabled = false;
                endDate.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        isCurrent.addEventListener('change', toggleEndDate);
        toggleEndDate();
    </script>
@endsection