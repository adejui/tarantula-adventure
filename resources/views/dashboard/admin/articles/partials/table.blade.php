<table class="min-w-full">
    <!-- table header start -->
    <thead>
        <tr class="border-b border-gray-100 text-[#616161] dark:border-gray-800">
            <th class="py-3 text-left sm:min-w-96">
                <div class="flex items-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Judul
                    </p>
                </div>
            </th>

            <th class="py-3 hidden lg:table-cell">
                <div class="flex items-center justify-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Status
                    </p>
                </div>
            </th>

            <th class="py-3 text-center">
                <div class="flex items-center justify-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Aksi
                    </p>
                </div>
            </th>
        </tr>
    </thead>

    <!-- table header end -->

    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
        @forelse ($articles as $article)
            <tr>
                <td class="py-3">
                    <div class="flex items-center">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="font-medium text-[#2E2E2E] text-theme-sm dark:text-white/90">
                                    {{ $article->title }}
                                </p>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="py-3 hidden md:table-cell">
                    <div class="flex items-center justify-center">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                            <x-status-badge :status="$article->status" />

                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center justify-center">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                        <div class="flex justify-center items-center gap-2">
                            <x-action-button type="detail" :url="route('articles.show', $article->id)" title="Detail" />
                            <x-action-button type="edit" :url="route('articles.edit', $article->id)" title="Edit" />
                            <x-modal-confirm-delete :id="'delete-article-' . $article->id" :action="route('articles.destroy', $article->id)" :item="$article->full_name" />
                        </div>
                        </p>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">
                    @if (request('search'))
                        Data artikel tidak ditemukan.
                    @else
                        Belum ada data artikel.
                    @endif
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $articles->appends(request()->query())->links() }}
</div>
