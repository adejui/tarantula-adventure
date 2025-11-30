<table class="min-w-full">
    <!-- table header start -->
    <thead>
        <tr class="border-b border-gray-100 text-[#616161] dark:border-gray-800">
            <th class="py-3 text-left">
                <div class="flex items-center sm:ms-12">
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
                            <!-- FOTO -->
                            <span class="relative z-1 block h-10 w-10 rounded-full shrink-0">
                                @if ($loan->user_id)
                                    <img src="{{ $loan->user && $loan->user->photo
                                        ? asset('storage/' . $loan->user->photo)
                                        : asset('storage/imgUsers/default-image.png') }}"
                                        alt="Foto User" class="h-full w-full object-cover rounded-full">
                                @else
                                    <img src="{{ asset('storage/imgUsers/default-image.png') }}" alt="Foto OPA"
                                        class="h-full w-full object-cover rounded-full">
                                @endif

                                @if ($loan->status === 'requested')
                                    <span
                                        class="bg-success-500 absolute right-0 bottom-0 z-10 h-2.5 w-2.5 rounded-full border-[1.5px] border-white dark:border-gray-900">
                                    </span>
                                @endif
                            </span>

                            <!-- NAMA + NRP -->
                            <div class="flex flex-col">
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
                            @if ($loan->status === 'requested')
                                <x-loan-action type="acc" id="acc-loan-{{ $loan->id }}" :item="$loan->user_id ? $loan->user->full_name : $loan->opa->name"
                                    :action="route('loans.accept', $loan->id)" />
                                <x-loan-action type="reject" id="reject-loan-{{ $loan->id }}" :item="$loan->user_id ? $loan->user->full_name : $loan->opa->name"
                                    :action="route('loans.reject', $loan->id)" />
                                <x-action-button type="manage" :url="route('loans.manage', $loan->id)" title="loan" />
                            @elseif ($loan->status === 'approved')
                                <x-loan-action type="approve" id="approve-loan-{{ $loan->id }}" :item="$loan->user_id ? $loan->user->full_name : $loan->opa->name"
                                    :action="route('loans.approve', $loan->id)" />
                                <x-action-button type="detail" :url="route('loans.show', $loan->id)" title="Detail" />
                                <x-action-button type="manage" :url="route('loans.manage', $loan->id)" title="loan" />
                            @elseif ($loan->status === 'borrowed')
                                <x-loan-action type="borrowed" id="borrowed-loan-{{ $loan->id }}"
                                    :item="$loan->user_id ? $loan->user->full_name : $loan->opa->name" :action="route('loans.borrowed', $loan->id)" />
                                <x-action-button type="detail" :url="route('loans.show', $loan->id)" title="Detail" />
                                <x-action-button type="manage" :url="route('loans.manage', $loan->id)" title="loan" />
                            @else
                                <x-modal-confirm-delete :id="'delete-loan-' . $loan->id" :action="route('loans.destroy', $loan->id)" :item="$loan->full_name" />
                                <x-action-button type="detail" :url="route('loans.show', $loan->id)" title="Detail" />
                                <x-action-button type="manage" :url="route('loans.manage', $loan->id)" title="loan" />
                            @endif
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
