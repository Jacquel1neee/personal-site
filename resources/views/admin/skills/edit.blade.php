@extends('admin.layouts.app')

@section('title', __('admin.update_skill'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.update_skill') }}</h1>
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

    <form action="{{ route('admin.skills.update', $skill) }}" method="POST" class="max-w-xl space-y-6">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.skill_name') }}</label>
            <input type="text" name="name" value="{{ old('name', $skill->name) }}" required
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
        </div>
        
        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.category') }}</label>
            <select name="category" id="category-select" required
                    class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
                @foreach($categories as $cat)
                    @php
                        $translated = __('admin.cat_' . strtolower($cat));
                        $display = $translated === 'admin.cat_' . strtolower($cat) ? $cat : $translated;
                    @endphp
                    <option value="{{ $cat }}" {{ old('category', $skill->category) === $cat ? 'selected' : '' }}>{{ $display }}</option>
                @endforeach
                <option value="Other" {{ old('category') === 'Other' ? 'selected' : '' }}>{{ __('admin.other_custom') }}</option>
            </select>
        </div>

        <div id="remark-container" class="hidden">
            <label class="block text-sm font-medium mb-1">{{ __('admin.new_category_name') }}</label>
            <input type="text" name="remark" id="remark-input" value="{{ old('remark', $skill->remark) }}"
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            <p class="mt-1 text-xs text-zinc-500">{{ __('admin.new_category_hint') }}</p>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.update_skill') }}
            </button>
            <a href="{{ route('admin.skills.index') }}" class="text-sm text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">{{ __('admin.cancel') }}</a>
        </div>
    </form>

    <script>
        const categorySelect = document.getElementById('category-select');
        const remarkContainer = document.getElementById('remark-container');
        const remarkInput = document.getElementById('remark-input');

        function toggleRemark() {
            if (categorySelect.value === 'Other') {
                remarkContainer.classList.remove('hidden');
                remarkInput.required = true;
            } else {
                remarkContainer.classList.add('hidden');
                remarkInput.required = false;
            }
        }

        categorySelect.addEventListener('change', toggleRemark);
        toggleRemark();
    </script>
@endsection