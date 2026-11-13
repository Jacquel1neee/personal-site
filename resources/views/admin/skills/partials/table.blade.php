<div class="overflow-hidden rounded-2xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
    <table class="w-full text-left text-sm">
        <thead class="border-b border-zinc-200 bg-zinc-50 text-xs uppercase text-zinc-500 dark:border-zinc-800 dark:bg-zinc-900/50 dark:text-zinc-400">
            <tr>
                <th class="px-6 py-3 font-medium">{{ __('admin.name') }}</th>
                <th class="px-6 py-3 font-medium">{{ __('admin.category') }}</th>
                <th class="px-6 py-3 font-medium text-right">{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
            @forelse($skills as $skill)
                <tr class="transition hover:bg-zinc-50 dark:hover:bg-zinc-800/50">
                    <td class="px-6 py-4 font-medium">{{ $skill->name }}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-medium text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                            {{ $skill->category_translated }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.skills.edit', $skill) }}" class="text-blue-600 hover:underline dark:text-blue-400">{{ __('admin.edit') }}</a>
                        <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('{{ __('admin.delete_confirm') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline dark:text-red-400">{{ __('admin.delete') }}</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-zinc-500 dark:text-zinc-400">{{ __('admin.no_skills') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>