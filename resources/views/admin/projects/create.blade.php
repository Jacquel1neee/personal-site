@extends('admin.layouts.app')

@section('title', __('admin.add_project'))

@section('content')
    <div class="mb-8">
        <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.add_project') }}</h1>
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

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl space-y-6">
        @csrf
        
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.title_zh') }}</label>
                <input type="text" name="title_zh" value="{{ old('title_zh') }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.title_en') }}</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">{{ __('admin.project_category') }}</label>
            <select name="category" id="category-select" required
                    class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
                <option value="">{{ __('admin.select_project_category') }}</option>
                <option value="Web App" {{ old('category') === 'Web App' ? 'selected' : '' }}>{{ __('admin.cat_web_app') }}</option>
                <option value="Game" {{ old('category') === 'Game' ? 'selected' : '' }}>{{ __('admin.cat_game') }}</option>
                <option value="Other" {{ old('category') === 'Other' ? 'selected' : '' }}>{{ __('admin.cat_other_proj') }}</option>
            </select>
        </div>
        
        {{-- 自定义分类框 --}}
        <div id="custom-category-container" class="hidden">
            <label class="block text-sm font-medium mb-1">{{ __('admin.new_category_name') }}</label>
            <input type="text" name="custom_category" id="custom-category-input" value="{{ old('custom_category') }}"
                   class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            <p class="mt-1 text-xs text-zinc-500">{{ __('admin.new_category_hint') }}</p>
        </div>

        {{-- 封面图 --}}
        <div class="flex items-start gap-6">
            <div id="image-preview" class="h-20 w-32 flex-shrink-0 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-xs text-zinc-400">
                No image
            </div>
            <div class="flex-1">
                <label class="block text-sm font-medium">{{ __('admin.cover_image') }}</label>
                <input type="file" name="image" id="project-image-input" accept="image/*"
                       class="mt-1 block w-full text-sm text-zinc-500 file:mr-4 file:rounded-full file:border-0 file:bg-zinc-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-zinc-800 dark:file:bg-white dark:file:text-zinc-900 dark:hover:file:bg-zinc-200">
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ __('admin.image_hint') }}</p>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.description_zh') }}</label>
                <textarea name="description_zh" rows="3" class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('description_zh') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.description_en') }}</label>
                <textarea name="description_en" rows="3" class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('description_en') }}</textarea>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.github_url') }}</label>
                <input type="url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/..."
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.live_url') }}</label>
                <input type="url" name="live_url" value="{{ old('live_url') }}" placeholder="https://..."
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.save_project') }}
            </button>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-zinc-500 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">{{ __('admin.cancel') }}</a>
        </div>
    </form>

    <script>
        document.getElementById('project-image-input').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image-preview');
            if (file) {
                if (file.size > 5 * 1024 * 1024) {
                    alert('File is too large. Max 5MB.');
                    this.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.innerHTML = `<img src="${e.target.result}" class="h-full w-full rounded-lg object-cover">`;
                };
                reader.readAsDataURL(file);
            }
        });
        const categorySelect = document.getElementById('category-select');
        const customCategoryContainer = document.getElementById('custom-category-container');
        const customCategoryInput = document.getElementById('custom-category-input');

        function toggleCustomCategory() {
            if (categorySelect.value === 'Other') {
                customCategoryContainer.classList.remove('hidden');
                customCategoryInput.required = true;
            } else {
                customCategoryContainer.classList.add('hidden');
                customCategoryInput.required = false;
            }
        }

        categorySelect.addEventListener('change', toggleCustomCategory);
        toggleCustomCategory();
    </script>
@endsection