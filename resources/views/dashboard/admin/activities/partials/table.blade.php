<table class="min-w-full">
    <!-- table header start -->
    <thead>
        <tr class="border-b border-gray-100 text-[#616161] dark:border-gray-800">
            <th class="py-3 text-left">
                <div class="flex items-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Nama Kegiatan
                    </p>
                </div>
            </th>

            <th class="py-3 hidden lg:table-cell text-left">
                <div class="flex items-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Tanggal Mulai
                    </p>
                </div>
            </th>

            <th class="py-3 hidden md:table-cell text-left">
                <div class="flex items-center justify-center">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Tanggal Selesai
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
        @forelse ($activities as $activity)
            <tr>
                <td class="py-3">
                    <div class="flex items-center">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="font-medium text-[#2E2E2E] text-theme-sm dark:text-white/90">
                                    {{ $activity->title }}
                                </p>
                                <span class="text-[#2E2E2E] text-theme-xs dark:text-gray-400">
                                    @if ($activity->activity_type == 'meeting')
                                        Rapat
                                    @elseif($activity->activity_type == 'basic training')
                                        Diksar
                                    @elseif($activity->activity_type == 'exploration')
                                        Pengembaraan
                                    @elseif($activity->activity_type == 'anniversary')
                                        Hari Jadi
                                    @elseif($activity->activity_type == 'others')
                                        Lain-lain
                                    @else
                                        Tidak diketahui
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="py-3 hidden lg:table-cell">
                    <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                        {{ \Carbon\Carbon::parse($activity->start_date)->translatedFormat('d F Y') }}
                    </p>
                </td>
                <td class="py-3 hidden md:table-cell">
                    <div class="flex items-center justify-center">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($activity->end_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center justify-center">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                        <div class="flex justify-center items-center gap-2">
                            <x-action-button type="detail" :url="route('activities.show', $activity->id)" title="Detail" />
                            <x-action-button type="manage" :url="route('manage.activity', $activity->id)" title="Manage" />
                            <x-modal-confirm-delete :id="'delete-activity-' . $activity->id" :action="route('activities.destroy', $activity->id)" :item="$activity->title" />
                        </div>
                        </p>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">
                    @if (request('search'))
                        Data kegiatan tidak ditemukan.
                    @else
                        Belum ada data kegiatan.
                    @endif
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $activities->appends(request()->query())->links() }}
</div>
