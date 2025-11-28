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
                <div class="flex items-center justify-end">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Tanggal Mulai
                    </p>
                </div>
            </th>

            <th class="py-3 hidden md:table-cell text-left">
                <div class="flex items-center justify-end">
                    <p class="font-medium text-theme-md dark:text-gray-400">
                        Tanggal Selesai
                    </p>
                </div>
            </th>

            <th class="py-3 hidden lg:table-cell text-center">
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
        @forelse ($loans as $loan)
            <tr>
                <td class="py-3">
                    <div class="flex items-center">
                        <div class="flex items-center gap-3">
                            <div>
                                <p class="font-medium text-[#2E2E2E] text-theme-sm dark:text-white/90">
                                    @if (!empty($loan->user_id))
                                        {{ $loan->user->full_name }}
                                    @else
                                        {{ $loan->opa->name }}
                                    @endif
                                </p>
                                <span class="text-[#2E2E2E] text-theme-xs dark:text-gray-400">
                                    {{ $loan->nrp }}
                                </span>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="py-3 hidden lg:table-cell">
                    <div class="flex items-center justify-end">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($loan->borrow_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </td>
                <td class="py-3 hidden md:table-cell">
                    <div class="flex items-center justify-end">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($loan->return_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </td>
                <td class="py-3 hidden lg:table-cell">
                    <div class="flex items-center justify-center">
                        <x-status-badge :status="$loan->status" />
                    </div>
                </td>
                <td class="py-3">
                    <div class="flex items-center justify-center">
                        <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                        <div class="flex justify-center items-center gap-2">


                            <x-action-button type="acc" :url="route('loans.index', $loan->id)" title="acc" />
                            <x-action-button type="reject" :url="route('loans.index', $loan->id)" title="reject" />

                            <x-action-button type="manage" :url="route('loans.index', $loan->id)" title="loan" />
                        </div>
                        </p>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">
                    @if (request('search'))
                        Data peminjam tidak ditemukan.
                    @else
                        Belum ada data peminjam.
                    @endif
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-4">
    {{ $loans->appends(request()->query())->links() }}
</div>
