@extends('admin.layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.profile') }}</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('admin.profile_desc') }}</p>
        </div>
    </div>

    {{-- 成功提示 --}}
    @if(session('success'))
        <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-400">
            {{ session('success') }}
        </div>
    @endif

    {{-- 大文件拦截提示 --}}
    @if(session('error'))
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-400">
            {{ session('error') }}
        </div>
    @endif

    {{-- 表单验证错误提示 --}}
    @if($errors->any())
        <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-400">
            <ul class="list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data"
          class="max-w-3xl space-y-6">
        @csrf
        @method('PUT')

        {{-- 头像 --}}
        <div class="flex items-center gap-6">
            @if($profile->avatar_path)
                <img src="{{ Storage::url($profile->avatar_path) }}" alt="Avatar"
                     class="h-20 w-20 rounded-full object-cover ring-2 ring-zinc-200 dark:ring-zinc-700">
            @else
                <div class="flex h-20 w-20 items-center justify-center rounded-full bg-zinc-100 text-zinc-400 dark:bg-zinc-800">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                </div>
            @endif
            <div class="flex-1">
                <label class="block text-sm font-medium">{{ __('admin.avatar') }}</label>
                <input type="file" name="avatar" accept="image/*" id="avatar-input"
                    class="mt-1 block w-full text-sm text-zinc-500 file:mr-4 file:rounded-full file:border-0 file:bg-zinc-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:bg-zinc-800 dark:file:bg-white dark:file:text-zinc-900 dark:hover:file:bg-zinc-200">
                <p class="mt-2 text-xs text-zinc-500 dark:text-zinc-400">{{ __('admin.avatar_hint') }}</p>
                
                <!-- 前端文件大小错误提示框 -->
                <div id="avatar-error-box" class="mt-3 hidden rounded-lg border border-red-200 bg-red-50 p-3 text-sm font-medium text-red-700 dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-400">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        <span>{{ __('admin.avatar_too_large') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            {{-- 姓名 --}}
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.name_zh') }}</label>
                <input type="text" name="name_zh" value="{{ old('name_zh', $profile->name_zh) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.name_en') }}</label>
                <input type="text" name="name_en" value="{{ old('name_en', $profile->name_en) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>

            {{-- 城市 --}}
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.city_zh') }}</label>
                <input type="text" name="city_zh" value="{{ old('city_zh', $profile->city_zh) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.city_en') }}</label>
                <input type="text" name="city_en" value="{{ old('city_en', $profile->city_en) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>

            {{-- 生日 --}}
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.birthday') }}</label>
                <input type="date" name="birthday" value="{{ old('birthday', $profile->birthday->format('Y-m-d')) }}" required
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
                <p class="mt-1 text-xs text-zinc-500">{{ __('admin.current_age', ['age' => $profile->age]) }}</p>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.mbti') }}</label>
                <input type="text" name="mbti" value="{{ old('mbti', $profile->mbti) }}"
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        {{-- Slogan --}}
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.slogan_zh') }}</label>
                <input type="text" name="slogan_zh" value="{{ old('slogan_zh', $profile->slogan_zh) }}"
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.slogan_en') }}</label>
                <input type="text" name="slogan_en" value="{{ old('slogan_en', $profile->slogan_en) }}"
                       class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
        </div>

        {{-- About --}}
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.about_zh') }}</label>
                <textarea name="about_zh" rows="4"
                          class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('about_zh', $profile->about_zh) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">{{ __('admin.about_en') }}</label>
                <textarea name="about_en" rows="4"
                          class="w-full rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">{{ old('about_en', $profile->about_en) }}</textarea>
            </div>
        </div>

        {{-- 提交 --}}
        <div class="flex justify-end pt-4">
            <button type="submit"
                    class="rounded-full bg-zinc-900 px-6 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                {{ __('admin.save_changes') }}
            </button>
        </div>
    </form>

    {{-- JS: 前端拦截超大文件 --}}
    <script>
        document.getElementById('avatar-input').addEventListener('change', function () {
            const file = this.files[0];
            const errorBox = document.getElementById('avatar-error-box');
            if (file && file.size > 5 * 1024 * 1024) {
                errorBox.classList.remove('hidden');
                this.value = ''; // 清空选择
            } else {
                errorBox.classList.add('hidden');
            }
        });
    </script>
@endsection