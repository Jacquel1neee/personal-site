@extends('frontend.layouts.app')

@section('title', __('frontend.nav_contact') . ' — ' . config('app.name'))

@section('content')
    <section class="mx-auto max-w-5xl px-6 pt-24 pb-32">
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">{{ __('frontend.contact_title') }}</h1>
            <p class="mt-4 text-lg text-zinc-500 dark:text-zinc-400">{{ __('frontend.contact_desc') }}</p>
        </div>

        <div class="grid gap-12 md:grid-cols-5 items-start">
            
            {{-- 左侧：社交链接 --}}
            <div class="md:col-span-2 space-y-8">
                <div>
                    <h2 class="text-xl font-semibold mb-6">{{ __('frontend.contact_connect') }}</h2>
                    <div class="space-y-4">
                        @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank" class="group flex items-center gap-4 rounded-2xl border border-zinc-200 bg-white p-4 transition hover:border-zinc-300 hover:shadow-md dark:border-zinc-800 dark:bg-zinc-900 dark:hover:border-zinc-700">
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-zinc-100 text-2xl transition group-hover:scale-110 dark:bg-zinc-800">
                                    {{ $link->icon }}
                                </div>
                                <div>
                                    <p class="font-medium">{{ $link->platform }}</p>
                                    <p class="text-sm text-zinc-500 dark:text-zinc-400 truncate max-w-[180px]">{{ $link->url }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- 右侧：留言表单 --}}
            <div class="md:col-span-3">
                @if(session('success'))
                    <div class="mb-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-900/50 dark:bg-green-900/20 dark:text-green-400">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 dark:border-red-900/50 dark:bg-red-900/20 dark:text-red-400">
                        <ul class="list-inside list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6 rounded-2xl border border-zinc-200 bg-white p-8 shadow-sm dark:border-zinc-800 dark:bg-zinc-900">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium mb-2">{{ __('frontend.contact_name') }}</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               class="w-full rounded-xl border-zinc-300 bg-zinc-50 px-4 py-3 text-sm focus:border-blue-500 focus:bg-white focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-950 dark:focus:bg-zinc-900">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">{{ __('frontend.contact_email') }}</label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                               class="w-full rounded-xl border-zinc-300 bg-zinc-50 px-4 py-3 text-sm focus:border-blue-500 focus:bg-white focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-950 dark:focus:bg-zinc-900">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">{{ __('frontend.contact_message') }}</label>
                        <textarea name="content" rows="5" required
                                  class="w-full rounded-xl border-zinc-300 bg-zinc-50 px-4 py-3 text-sm focus:border-blue-500 focus:bg-white focus:ring-blue-500 dark:border-zinc-700 dark:bg-zinc-950 dark:focus:bg-zinc-900">{{ old('content') }}</textarea>
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full rounded-xl bg-blue-600 px-8 py-4 text-sm font-semibold text-white shadow-lg shadow-blue-500/30 transition hover:bg-blue-700 hover:shadow-blue-500/50">
                            {{ __('frontend.contact_send') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection