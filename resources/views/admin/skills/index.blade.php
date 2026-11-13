@extends('admin.layouts.app')

@section('title', __('admin.skills'))

@section('content')
    <div x-data="skillsTable()" x-init="fetchSkills()">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight">{{ __('admin.skills') }}</h1>
                <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">{{ __('admin.skills_desc') }}</p>
            </div>
            <a href="{{ route('admin.skills.create') }}" class="rounded-full bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-200">
                + {{ __('admin.add_skill') }}
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-400">
                {{ session('success') }}
            </div>
        @endif

        {{-- 搜索和过滤控件 --}}
        <div class="mb-6 flex flex-wrap items-center gap-3">
            <div class="relative w-full max-w-xs">
                <input type="text" x-model="search" x-on:input.debounce.300ms="fetchSkills()" placeholder="{{ __('admin.search_skill') }}"
                       class="w-full rounded-lg border-zinc-300 bg-white pl-10 pr-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
            </div>
            
            <select x-model="category" x-on:change="fetchSkills()"
                    class="rounded-lg border-zinc-300 bg-white px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-900">
                <option value="">{{ __('admin.all_categories') }}</option>
                @foreach($categories as $cat)
                    @php
                        $translated = __('admin.cat_' . strtolower($cat));
                        $display = $translated === 'admin.cat_' . strtolower($cat) ? $cat : $translated;
                    @endphp
                    <option value="{{ $cat }}">{{ $display }}</option>
                @endforeach
            </select>

            <span x-show="isLoading" class="text-sm text-zinc-500">{{ __('admin.searching') }}</span>
        </div>

        <div x-html="tableHtml"></div>

    </div>

    <script>
        function skillsTable() {
            return {
                search: '',
                category: '',
                tableHtml: '',
                isLoading: false,
                fetchSkills() {
                    this.isLoading = true;
                    const params = new URLSearchParams({ search: this.search, category: this.category });

                    fetch(`{{ route('admin.skills.index') }}?${params.toString()}`, {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(response => response.text())
                    .then(html => {
                        this.tableHtml = html;
                        this.isLoading = false;
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        this.isLoading = false;
                    });
                }
            }
        }
    </script>
@endsection