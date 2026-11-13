<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>

    {{-- 防深色模式闪白 --}}
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-zinc-900 antialiased dark:bg-black dark:text-zinc-100 selection:bg-blue-200 selection:text-blue-900 dark:selection:bg-blue-900 dark:selection:text-blue-100">

    {{-- 顶部导航 --}}
    <header class="fixed top-0 z-50 w-full border-b border-zinc-200/50 bg-white/70 backdrop-blur-xl dark:border-zinc-800/50 dark:bg-black/70">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6">
            
            {{-- 左侧名字 --}}
            <a href="{{ route('home') }}" class="text-lg font-semibold tracking-tight hover:opacity-70 transition z-50">
                {{ app()->getLocale() === 'zh' ? (optional(\App\Models\Profile::first())->name_zh ?? 'Portfolio') : (optional(\App\Models\Profile::first())->name_en ?? 'Portfolio') }}
            </a>

            {{-- 电脑端导航 --}}
            <nav class="hidden items-center space-x-8 text-sm font-medium md:flex">
                <a href="{{ route('home') }}" class="transition hover:text-blue-600 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-zinc-600 dark:text-zinc-400' }}">{{ __('frontend.nav_home') }}</a>
                <a href="{{ route('about') }}" class="transition hover:text-blue-600 {{ request()->routeIs('about') ? 'text-blue-600' : 'text-zinc-600 dark:text-zinc-400' }}">{{ __('frontend.nav_about') }}</a>
                <a href="{{ route('projects') }}" class="transition hover:text-blue-600 {{ request()->routeIs('projects') ? 'text-blue-600' : 'text-zinc-600 dark:text-zinc-400' }}">{{ __('frontend.nav_projects') }}</a>
                <a href="{{ route('contact') }}" class="transition hover:text-blue-600 {{ request()->routeIs('contact') ? 'text-blue-600' : 'text-zinc-600 dark:text-zinc-400' }}">{{ __('frontend.nav_contact') }}</a>
            </nav>

            {{-- 右侧按钮组 --}}
            <div class="flex items-center space-x-2 sm:space-x-4 z-50">
                {{-- 语言切换 --}}
                <a href="{{ route('lang.switch', app()->getLocale() === 'zh' ? 'en' : 'zh') }}" class="rounded-full px-2 sm:px-3 py-1 text-sm font-medium text-zinc-600 transition hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800">
                    {{ app()->getLocale() === 'zh' ? 'EN' : '中文' }}
                </a>
                {{-- 明暗切换 --}}
                <button type="button" onclick="toggleTheme()" class="flex h-9 w-9 items-center justify-center rounded-full text-zinc-600 transition hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800">
                    <svg class="h-5 w-5 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2m0 14v2m9-9h-2M5 12H3m15.364 6.364-1.414-1.414M7.05 7.05 5.636 5.636m12.728 0-1.414 1.414M7.05 16.95l-1.414 1.414M16 12a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"/></svg>
                    <svg class="hidden h-5 w-5 dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79Z"/></svg>
                </button>

                {{-- 手机端汉堡菜单按钮 (Alpine 控制) --}}
                <div x-data="{ open: false }" class="md:hidden">
                    <button @click="open = !open" type="button" class="flex h-9 w-9 items-center justify-center rounded-full text-zinc-600 transition hover:bg-zinc-100 dark:text-zinc-400 dark:hover:bg-zinc-800">
                        <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        <svg x-show="open" x-cloak class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>

                    {{-- 手机端下拉菜单内容 --}}
                    <div x-show="open" x-cloak x-transition class="absolute top-16 left-0 w-full border-b border-zinc-200 bg-white p-4 shadow-xl dark:border-zinc-800 dark:bg-zinc-950 flex flex-col space-y-4 text-center">
                        <a href="{{ route('home') }}" class="text-lg font-medium {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">{{ __('frontend.nav_home') }}</a>
                        <a href="{{ route('about') }}" class="text-lg font-medium {{ request()->routeIs('about') ? 'text-blue-600' : '' }}">{{ __('frontend.nav_about') }}</a>
                        <a href="{{ route('projects') }}" class="text-lg font-medium {{ request()->routeIs('projects') ? 'text-blue-600' : '' }}">{{ __('frontend.nav_projects') }}</a>
                        <a href="{{ route('contact') }}" class="text-lg font-medium {{ request()->routeIs('contact') ? 'text-blue-600' : '' }}">{{ __('frontend.nav_contact') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="pt-16">
        @yield('content')
    </main>

    {{-- 页脚 --}}
    <footer class="border-t border-zinc-200 py-12 dark:border-zinc-800">
        <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-6 text-sm text-zinc-500 md:flex-row dark:text-zinc-400">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('frontend.footer_rights') }}</p>
            <p>{{ __('frontend.built_with') }}</p>
        </div>
    </footer>

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