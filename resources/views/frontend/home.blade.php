@extends('frontend.layouts.app')

@section('title', config('app.name') . ' — Portfolio')

@section('content')
    {{-- Hero 区 --}}
    <section class="mx-auto max-w-6xl px-6 pt-16 pb-24 sm:pt-24 sm:pb-32">
        <div class="flex flex-col-reverse items-center gap-10 md:flex-row md:justify-between md:gap-12">
            <div class="flex-1 text-center md:text-left">
                <p class="text-base sm:text-lg font-medium text-blue-600 dark:text-blue-400">{{ __('frontend.hero_greeting') }}</p>
                <h1 class="mt-2 text-4xl font-bold tracking-tight sm:text-6xl lg:text-7xl">
                    {{ app()->getLocale() === 'zh' ? $profile->name_zh : $profile->name_en }}
                </h1>
                <p class="mt-4 text-lg sm:text-xl text-zinc-600 dark:text-zinc-400">{{ __('frontend.hero_role') }}</p>
                <p class="mt-2 text-base sm:text-lg text-zinc-500 dark:text-zinc-500 italic">"{{ app()->getLocale() === 'zh' ? $profile->slogan_zh : $profile->slogan_en }}"</p>
                
                <div class="mt-8 flex flex-col sm:flex-row items-center gap-3 sm:gap-4 justify-center md:justify-start">
                    <a href="{{ route('projects') }}" class="w-full sm:w-auto rounded-full bg-blue-600 px-8 py-3 text-sm font-medium text-white transition hover:bg-blue-700 text-center">
                        {{ __('frontend.hero_view_work') }}
                    </a>
                    <a href="{{ route('contact') }}" class="w-full sm:w-auto rounded-full border border-zinc-300 px-8 py-3 text-sm font-medium transition hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-900 text-center">
                        {{ __('frontend.hero_cta') }}
                    </a>
                </div>
            </div>
            <div class="w-48 h-48 sm:w-64 sm:h-64 lg:w-80 lg:h-80 flex-shrink-0">
                @if($profile->avatar_path)
                    <img src="{{ Storage::url($profile->avatar_path) }}" alt="Avatar" class="h-full w-full object-cover rounded-[2rem] sm:rounded-[2.5rem] shadow-2xl ring-1 ring-zinc-200 dark:ring-zinc-800">
                @else
                    <div class="flex h-full w-full items-center justify-center rounded-[2rem] sm:rounded-[2.5rem] bg-zinc-100 dark:bg-zinc-900">
                        <span class="text-zinc-400">No Avatar</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- 精选技能 --}}
    <section class="bg-zinc-50 py-24 dark:bg-zinc-950">
        <div class="mx-auto max-w-6xl px-6">
            <h2 class="text-3xl font-bold tracking-tight text-center">{{ __('frontend.featured_skills') }}</h2>
            <p class="mt-2 text-center text-zinc-500 dark:text-zinc-400">{{ __('frontend.featured_skills_desc') }}</p>
            
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach($skills as $skill)
                    <div class="group rounded-2xl border border-zinc-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-lg dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold transition group-hover:text-blue-600 dark:group-hover:text-blue-400">{{ $skill->name }}</h3>
                            <span class="rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ $skill->category_translated }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 精选项目 --}}
    <section class="py-24">
        <div class="mx-auto max-w-6xl px-6">
            <h2 class="text-3xl font-bold tracking-tight text-center">{{ __('frontend.featured_projects') }}</h2>
            <p class="mt-2 text-center text-zinc-500 dark:text-zinc-400">{{ __('frontend.featured_projects_desc') }}</p>

            <div class="mt-12 grid gap-8 md:grid-cols-3">
                @foreach($projects as $project)
                    <a href="{{ route('projects') }}" class="group block overflow-hidden rounded-2xl border border-zinc-200 bg-white transition hover:-translate-y-1 hover:shadow-xl dark:border-zinc-800 dark:bg-zinc-900">
                        <div class="aspect-[4/3] w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                            @if($project->image_path)
                                <img src="{{ Storage::url($project->image_path) }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center text-sm text-zinc-400">No Image</div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="font-semibold text-lg">{{ app()->getLocale() === 'zh' ? $project->title_zh : $project->title_en }}</h3>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ $project->category_translated }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <a href="{{ route('projects') }}" class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:underline dark:text-blue-400">
                    {{ __('frontend.view_all_projects') }} &rarr;
                </a>
            </div>
        </div>
    </section>
@endsection