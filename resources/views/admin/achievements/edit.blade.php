@extends('admin.layouts.app')

@section('title', __('admin.edit_achievement'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.edit_achievement') }}</h1>
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

    <form action="{{ route('admin.achievements.update', $achievement) }}" method="POST" class="max-w-2xl space-y-6">
        @csrf
        @method('PUT')
        
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.ach_title_zh') }}</label>
                <input type="text" name="title_zh" value="{{ old('title_zh', $achievement->title_zh) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.ach_title_en') }}</label>
                <input type="text" name="title_en" value="{{ old('title_en', $achievement->title_en) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.ach_issuer_zh') }}</label>
                <input type="text" name="issuer_zh" value="{{ old('issuer_zh', $achievement->issuer_zh) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.ach_issuer_en') }}</label>
                <input type="text" name="issuer_en" value="{{ old('issuer_en', $achievement->issuer_en) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.ach_year') }}</label>
            <input type="text" name="year" value="{{ old('year', $achievement->year) }}" required
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
        </div>

        {{-- Type 分类下拉框 --}}
        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.ach_type') }}</label>
            <select name="type" id="type-select" required
                    class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
                <option value="">{{ __('admin.ach_type_select') }}</option>
                <option value="Academic" {{ old('type', $achievement->type) === 'Academic' ? 'selected' : '' }}>Academic / 学术</option>
                <option value="Sports" {{ old('type', $achievement->type) === 'Sports' ? 'selected' : '' }}>Sports / 运动</option>
                <option value="Work" {{ old('type', $achievement->type) === 'Work' ? 'selected' : '' }}>Work / 工作</option>
                
                {{-- 如果当前的 type 是自定义的，把它显示出来 --}}
                @if(!in_array($achievement->type, ['Academic', 'Sports', 'Work', 'Other']))
                    <option value="{{ $achievement->type }}" selected>{{ $achievement->type }}</option>
                @endif
                
                <option value="Other" {{ old('type', $achievement->type) === 'Other' ? 'selected' : '' }}>Other (Custom) / 其他</option>
            </select>
        </div>

        {{-- 自定义 Type 输入框 --}}
        <div id="custom-type-container" class="hidden">
            <label class="block text-sm font-medium mb-1">{{ __('admin.ach_custom_type') }}</label>
            <input type="text" name="custom_type" id="custom-type-input" value="{{ old('custom_type') }}"
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            <p class="mt-1 text-xs text-zinc-500">{{ __('admin.ach_type_hint') }}</p>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.update_achievement') }}
            </button>
            <a href="{{ route('admin.achievements.index') }}" class="text-sm text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">{{ __('admin.cancel') }}</a>
        </div>
    </form>

    <script>
        const typeSelect = document.getElementById('type-select');
        const customTypeContainer = document.getElementById('custom-type-container');
        const customTypeInput = document.getElementById('custom-type-input');

        function toggleCustomType() {
            if (typeSelect.value === 'Other') {
                customTypeContainer.classList.remove('hidden');
                customTypeInput.required = true;
            } else {
                customTypeContainer.classList.add('hidden');
                customTypeInput.required = false;
            }
        }

        typeSelect.addEventListener('change', toggleCustomType);
        toggleCustomType();
    </script>
@endsection