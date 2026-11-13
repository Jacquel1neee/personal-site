@extends('frontend.layouts.app')

@section('title', __('frontend.nav_about') . ' — ' . config('app.name'))

@section('content')
    {{-- 头部介绍 --}}
    <section class="mx-auto max-w-4xl px-6 pt-24 pb-16 text-center">
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">{{ __('frontend.nav_about') }}</h1>
        
        <div class="mt-8 flex flex-col items-center justify-center gap-6 sm:flex-row">
            @if($profile->avatar_path)
                <img src="{{ Storage::url($profile->avatar_path) }}" alt="Avatar" class="h-32 w-32 rounded-full object-cover shadow-lg ring-4 ring-white dark:ring-zinc-800">
            @endif
            <div class="text-left">
                <h2 class="text-2xl font-semibold">{{ app()->getLocale() === 'zh' ? $profile->name_zh : $profile->name_en }}</h2>
                <p class="mt-1 text-blue-600 dark:text-blue-400 font-medium">
                    {{ $profile->mbti }} • {{ $profile->age }} {{ app()->getLocale() === 'zh' ? '岁' : 'years old' }}
                </p>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                    📍 {{ app()->getLocale() === 'zh' ? $profile->city_zh : $profile->city_en }}
                </p>
            </div>
        </div>

        <div class="mx-auto mt-10 max-w-2xl text-lg leading-relaxed text-zinc-600 dark:text-zinc-300">
            <p>"{{ app()->getLocale() === 'zh' ? $profile->about_zh : $profile->about_en }}"</p>
        </div>
    </section>

    {{-- 工作经历时间线 --}}
    <section class="bg-zinc-50 py-20 dark:bg-zinc-950">
        <div class="mx-auto max-w-4xl px-6">
            <h2 class="mb-12 text-center text-2xl font-bold tracking-tight">Experience / 工作经历</h2>
            
            <div class="relative border-l border-zinc-300 dark:border-zinc-700 ml-3 md:ml-0 md:pl-0">
                @foreach($experiences as $exp)
                    <div class="mb-10 ml-8 group">
                        {{-- 时间线圆点 --}}
                        <span class="absolute -left-[9px] mt-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-white ring-4 ring-white dark:bg-zinc-900 dark:ring-zinc-950 transition group-hover:scale-125">
                            <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                        </span>
                        
                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between">
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">
                                {{ app()->getLocale() === 'zh' ? $exp->role_zh : $exp->role_en }}
                            </h3>
                            <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                {{ $exp->start_date->format('Y-m') }} — {{ $exp->end_date ? $exp->end_date->format('Y-m') : __('admin.present') }}
                            </span>
                        </div>
                        
                        <p class="text-zinc-600 dark:text-zinc-400">
                            {{ app()->getLocale() === 'zh' ? $exp->company_zh : $exp->company_en }}
                        </p>
                        
                        @if(app()->getLocale() === 'zh' && $exp->description_zh)
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">{{ $exp->description_zh }}</p>
                        @elseif(app()->getLocale() === 'en' && $exp->description_en)
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400 leading-relaxed">{{ $exp->description_en }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 兴趣爱好 --}}
    <section class="py-20">
        <div class="mx-auto max-w-5xl px-6">
            <h2 class="mb-12 text-center text-2xl font-bold tracking-tight">Hobbies / 兴趣爱好</h2>
            
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($hobbies as $hobby)
                    <div class="group flex flex-col items-center rounded-2xl border border-zinc-200 bg-white p-8 text-center transition duration-300 hover:-translate-y-2 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="text-5xl transition duration-300 group-hover:scale-110">{{ $hobby->icon }}</div>
                        <h3 class="mt-4 text-lg font-semibold">{{ app()->getLocale() === 'zh' ? $hobby->name_zh : $hobby->name_en }}</h3>
                        
                        @if(app()->getLocale() === 'zh' && $hobby->description_zh)
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $hobby->description_zh }}</p>
                        @elseif(app()->getLocale() === 'en' && $hobby->description_en)
                            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ $hobby->description_en }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection