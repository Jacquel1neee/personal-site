@extends('frontend.layouts.app')

@section('title', __('frontend.nav_projects') . ' — ' . config('app.name'))

@section('content')
    <section class="mx-auto max-w-6xl px-6 pt-24 pb-16 text-center">
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">{{ __('frontend.nav_projects') }}</h1>
        <p class="mt-4 text-lg text-zinc-500 dark:text-zinc-400">{{ __('frontend.featured_projects_desc') }}</p>
    </section>

    {{-- Alpine.js 控制整个过滤逻辑 --}}
    <section class="mx-auto max-w-6xl px-6 pb-32" x-data="{ activeCategory: 'All' }">
        
        {{-- 分类过滤按钮 --}}
        <div class="mb-12 flex flex-wrap items-center justify-center gap-2">
            <button @click="activeCategory = 'All'"
                    :class="activeCategory === 'All' ? 'bg-blue-600 text-white shadow-md' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700'"
                    class="rounded-full px-5 py-2 text-sm font-medium transition-all duration-300">
                All / 全部
            </button>
            
            @foreach($categories as $cat)
                @php
                    $translated = __('admin.cat_' . strtolower(str_replace(' ', '_', $cat)));
                    $display = $translated === 'admin.cat_' . strtolower(str_replace(' ', '_', $cat)) ? $cat : $translated;
                @endphp
                <button @click="activeCategory = '{{ $cat }}'"
                        :class="activeCategory === '{{ $cat }}' ? 'bg-blue-600 text-white shadow-md' : 'bg-zinc-100 text-zinc-600 hover:bg-zinc-200 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-700'"
                        class="rounded-full px-5 py-2 text-sm font-medium transition-all duration-300">
                    {{ $display }}
                </button>
            @endforeach
        </div>

        {{-- 项目网格 --}}
        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($projects as $project)
                {{-- x-show 负责过滤，配合 x-transition 做平滑淡入淡出 --}}
                <a href="{{ $project->github_url ?? '#' }}" target="{{ $project->github_url ? '_blank' : '_self' }}"
                   x-show="activeCategory === 'All' || activeCategory === '{{ $project->category }}'"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 scale-95"
                   x-transition:enter-end="opacity-100 scale-100"
                   x-transition:leave="transition ease-in duration-200 absolute"
                   x-transition:leave-start="opacity-100 scale-100"
                   x-transition:leave-end="opacity-0 scale-95"
                   class="group relative flex flex-col overflow-hidden rounded-2xl border border-zinc-200 bg-white transition duration-500 hover:-translate-y-2 hover:shadow-2xl dark:border-zinc-800 dark:bg-zinc-900">
                    
                    {{-- 封面图 --}}
                    <div class="aspect-[4/3] w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                        @if($project->image_path)
                            <img src="{{ Storage::url($project->image_path) }}" alt="{{ $project->title_en }}" 
                                 class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                        @else
                            <div class="flex h-full items-center justify-center text-sm text-zinc-400">No Image</div>
                        @endif
                    </div>

                    {{-- 内容 --}}
                    <div class="flex flex-1 flex-col p-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-xl font-semibold">{{ app()->getLocale() === 'zh' ? $project->title_zh : $project->title_en }}</h3>
                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                                {{ $project->category_translated }}
                            </span>
                        </div>
                        
                        <p class="mt-3 text-sm text-zinc-500 dark:text-zinc-400 line-clamp-3 flex-1">
                            {{ app()->getLocale() === 'zh' ? $project->description_zh : $project->description_en }}
                        </p>

                        {{-- 底部链接提示 --}}
                        <div class="mt-6 flex items-center justify-between text-sm font-medium">
                            @if($project->github_url)
                                <span class="text-zinc-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">View Project &rarr;</span>
                            @else
                                <span></span>
                            @endif
                            
                            @if($project->live_url)
                                <span class="text-blue-600 dark:text-blue-400">Live Demo ↗</span>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection