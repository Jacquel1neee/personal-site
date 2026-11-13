<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — {{ config('app.name') }}</title>

    {{-- 防止深色模式闪白 --}}
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased dark:bg-zinc-950 dark:text-zinc-100">

    {{-- 顶部栏 --}}
    <header class="sticky top-0 z-40 border-b border-zinc-200 bg-white/80 backdrop-blur-lg dark:border-zinc-800 dark:bg-zinc-900/80">
        <div class="mx-auto flex h-14 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <div class="flex items-center gap-6">
                <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold tracking-tight">
                    {{ config('app.name') }} <span class="text-zinc-400">/ Admin</span>
                </a>
                <nav class="hidden gap-1 md:flex">
                    <a href="{{ route('admin.dashboard') }}"
                       class="rounded-md px-3 py-1.5 text-sm text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white
                              {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-white' : '' }}">
                        Dashboard
                    </a>
                </nav>
            </div>

            <div class="flex items-center gap-2">
                {{-- 明暗切换按钮 --}}
                <button type="button" onclick="toggleTheme()"
                        aria-label="Toggle theme"
                        class="flex h-9 w-9 items-center justify-center rounded-full text-zinc-600 transition hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800">
                    {{-- 太阳（light 时显示） --}}
                    <svg class="h-5 w-5 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364 6.364-1.414-1.414M7.05 7.05 5.636 5.636m12.728 0-1.414 1.414M7.05 16.95l-1.414 1.414M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/>
                    </svg>
                    {{-- 月亮（dark 时显示） --}}
                    <svg class="hidden h-5 w-5 dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/>
                    </svg>
                </button>

                {{-- 用户菜单 --}}
                <a href="{{ url('/') }}" target="_blank"
                   class="hidden rounded-md px-3 py-1.5 text-sm text-zinc-600 transition hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800 md:inline-block">
                    View site ↗
                </a>

                {{-- 语言切换 --}}
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" type="button" class="flex h-9 items-center justify-center gap-1 rounded-full px-3 text-sm font-medium text-zinc-600 transition hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800">
                        {{ app()->getLocale() === 'zh' ? '中文' : 'EN' }}
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-32 origin-top-right rounded-xl border border-zinc-200 bg-white p-1 shadow-lg dark:border-zinc-800 dark:bg-zinc-900" style="display: none;">
                        <a href="{{ route('lang.switch', 'en') }}" class="block rounded-lg px-3 py-2 text-sm {{ app()->getLocale() === 'en' ? 'bg-zinc-100 font-medium dark:bg-zinc-800' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-800/50' }}">English</a>
                        <a href="{{ route('lang.switch', 'zh') }}" class="block rounded-lg px-3 py-2 text-sm {{ app()->getLocale() === 'zh' ? 'bg-zinc-100 font-medium dark:bg-zinc-800' : 'text-zinc-600 hover:bg-zinc-50 dark:text-zinc-400 dark:hover:bg-zinc-800/50' }}">中文</a>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="rounded-md px-3 py-1.5 text-sm text-zinc-600 transition hover:bg-zinc-100 hover:text-red-600 dark:text-zinc-400 dark:hover:bg-zinc-800">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </header>

    {{-- 主体 --}}
    <div class="mx-auto flex max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:px-8">

        {{-- 侧边栏 --}}
        <aside class="hidden w-56 shrink-0 md:block">
            <nav class="sticky top-20 space-y-1">
                @php
                    $items = [
                        ['route' => 'admin.dashboard',  'label' => __('admin.dashboard'),    'icon' => 'home'],
                        ['route' => 'admin.profile.edit', 'label' => __('admin.profile'), 'icon' => 'user'],                   
                        ['route' => 'admin.skills.index',  'label' => __('admin.skills'),       'icon' => 'bolt'],
                        ['route' => 'admin.experiences.index',  'label' => __('admin.experiences'),  'icon' => 'briefcase'],
                        ['route' => 'admin.projects.index',  'label' => __('admin.projects'),  'icon' => 'code'],
                        ['route' => 'admin.hobbies.index',  'label' => __('admin.hobbies'),  'icon' => 'heart'],
                        ['route' => 'admin.social-links.index',  'label' => __('admin.social_links'),  'icon' => 'link'],
                        ['route' => 'admin.messages.index',  'label' => __('admin.messages'),  'icon' => 'mail'],
                    ];
                @endphp

                @foreach ($items as $item)
                    <a href="{{ route($item['route']) }}"
                       class="group flex items-center justify-between rounded-lg px-3 py-2 text-sm transition
                              {{ request()->routeIs($item['route']) && ! ($item['soon'] ?? false) ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900' : 'text-zinc-600 hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800' }}">
                        <span>{{ $item['label'] }}</span>
                        @if (! empty($item['soon']))
                            <span class="rounded-full bg-amber-100 px-1.5 py-0.5 text-[10px] font-medium text-amber-700 dark:bg-amber-900/40 dark:text-amber-400">soon</span>
                        @endif
                    </a>
                @endforeach
            </nav>
        </aside>

        {{-- 内容区 --}}
        <main class="min-w-0 flex-1">
            @yield('content')
        </main>
    </div>

    <script>
        function toggleTheme() {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.theme = 'light';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.theme = 'dark';
            }
        }
    </script>
    @stack('scripts')
</body>
</html>