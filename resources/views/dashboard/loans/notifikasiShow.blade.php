@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <x-breadcrumb :items="[
        ['label' => 'Peminjaman', 'url' => route('loans.index')],
        ['label' => 'Daftar Peminjaman', 'url' => route('loans.index')],
        ['label' => 'Detail Peminjaman'],
    ]" />

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Detail Peminjaman</h3>

        <div class="grid sm:grid-cols-2 gap-4">
            <div
                class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6 items-start h-fit">

                <div class="mb-9 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Informasi Peminjaman
                    </h3>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Nama Peminjam</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        {{ $loan->user_id ? $loan->user->full_name : $loan->opa->name }}
                    </p>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Status</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        <x-status-badge :status="$loan->status" />
                    </p>
                </div>

                <div class="flex flex-row gap-20 mb-5">
                    <div class="flex flex-col gap-y-1 w-fit justify-center">
                        <p class="text-theme-xs text-gray-500 dark:text-gray-400">Tanggal Pinjam</p>
                        <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($loan->borrow_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>

                    <div class="flex flex-col gap-y-1 w-fit justify-center">
                        <p class="text-theme-xs text-gray-500 dark:text-gray-400">Tanggal Kembali</p>
                        <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($loan->return_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Total Alat Dipinjam</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        {{ $loan->details->sum('quantity') }}
                    </p>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Catatan</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        {{ $loan->notes ?? '-' }}
                    </p>
                </div>

                <div class="flex justify-end gap-3">
                    <x-loan-action type="acc" id="acc-loan-{{ $loan->id }}" :item="$loan->user_id ? $loan->user->full_name : $loan->opa->name" :action="route('loans.accept', $loan->id)" />

                    <x-loan-action type="reject" id="reject-loan-{{ $loan->id }}" :item="$loan->user_id ? $loan->user->full_name : $loan->opa->name"
                        :action="route('loans.reject', $loan->id)" />
                </div>
            </div>

            <div class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                <div class="mb-9 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Alat Dipinjam
                    </h3>
                </div>

                <div class="flex h-[450px] flex-col">
                    <div class="custom-scrollbar flex h-auto flex-col overflow-y-auto pr-3">

                        @forelse ($loan->details as $detail)
                            <div
                                class="flex items-center justify-between border-b border-gray-200 pb-4 pt-4 first:pt-0 last:border-b-0 last:pb-0 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10">
                                        @php
                                            $photo = $detail->item->photos->first();
                                            $image = $photo
                                                ? Storage::url($photo->photo_path)
                                                : asset('assets/images/default.png');
                                        @endphp
                                        <img src="{{ $image }}" alt="item photo"
                                            class="h-full w-full object-cover rounded">
                                    </div>

                                    <div>
                                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                                            {{ $detail->item->name }}
                                        </h3>
                                        <span class="block text-theme-xs text-gray-500 dark:text-gray-400">
                                            {{ $detail->item->category->name }} | {{ $detail->item->code }}
                                        </span>
                                    </div>
                                </div>

                                <div>
                                    <div>
                                        <h4
                                            class="mb-1 text-right text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                            {{ $detail->quantity }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-gray-500 text-sm p-3">
                                Tidak ada alat dipinjam.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
