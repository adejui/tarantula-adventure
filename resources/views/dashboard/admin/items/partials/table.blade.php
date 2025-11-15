<table class="min-w-full">
    <!-- table header start -->
    <thead>
        <tr class="border-b border-gray-100 text-[#616161] dark:border-gray-800">
            <th class="py-3 text-left">
                <div class="flex items-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Nama
                    </p>
                </div>
            </th>

            <th class="py-3 hidden lg:table-cell text-left">
                <div class="flex items-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Kategori
                    </p>
                </div>
            </th>

            <th class="py-3 hidden md:table-cell text-left">
                <div class="flex items-center justify-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Jumlah
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
        @forelse ($items as $item)
            <tr>
                <td class="py-3">
                    <div class="flex items-center">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="font-medium text-[#2E2E2E] text-theme-sm dark:text-white/90">
                                    {{ $item->name }}
                                </p>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="py-3 hidden lg:table-cell">
                    <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                        {{ $item->category->name }}
                    </p>
                </td>
                <td class="py-3 hidden md:table-cell">
                    <div class="flex items-center justify-center">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                            {{ $item->quantity }}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center justify-center">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                        <div class="flex justify-center items-center gap-2">
                            <x-action-button type="detail" :url="route('items.show', $item->id)" title="Detail" />
                            <x-action-button type="edit" :url="route('items.edit', $item->id)" title="Edit" />
                            <x-modal-confirm-delete :id="'delete-item-' . $item->id" :action="route('items.destroy', $item->id)" :item="$item->name" />
                        </div>
                        </p>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">
                    @if (request('search'))
                        Data alat tidak ditemukan.
                    @else
                        Belum ada data alat.
                    @endif
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $items->appends(request()->query())->links() }}
</div>
