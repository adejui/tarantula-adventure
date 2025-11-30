@props([
    'type' => 'acc', // acc | reject
    'id' => 'loan-modal',
    'action' => '#',
    'item' => 'data ini',
])

@php
    $settings = [
        'acc' => [
            'title' => 'Setujui Permintaan?',
            'color' => '#10B981',
            'btn' => 'Setuju',
            'icon' => 'check',
            'hover' => 'hover:bg-green-100 dark:hover:bg-neutral-800',
            'modal_icon' => asset('assets/images/icons/circle-check.svg'), // FILE
        ],

        'reject' => [
            'title' => 'Tolak Permintaan?',
            'color' => '#E6353D',
            'btn' => 'Tolak',
            'icon' => 'x',
            'hover' => 'hover:bg-red-100 dark:hover:bg-neutral-800',

            'modal_icon' => '
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                viewBox="0 0 24 24" fill="none"
                stroke="#E6353D" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <path d="m15 9-6 6"></path>
                <path d="m9 9 6 6"></path>
            </svg>
        ',
        ],
        'approve' => [
            'title' => 'Barang Keluar?',
            'color' => '#CA8A04',
            'btn' => 'Dipinjam',
            'icon' => 'external-link',
            'hover' => 'hover:bg-yellow-100 dark:hover:bg-neutral-800',

            'modal_icon' => '
          <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#CA8A04" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-external-link-icon lucide-external-link"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
        ',
        ],
        'borrowed' => [
            'title' => 'Barang Dikembalikan?',
            'color' => '#ea580c',
            'btn' => 'Dikembalikan',
            'icon' => 'package-check',
            'hover' => 'hover:bg-orange-100 dark:hover:bg-neutral-800',

            'modal_icon' => '
         <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-package-check-icon lucide-package-check"><path d="m16 16 2 2 4-4"/><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14"/><path d="m7.5 4.27 9 5.15"/><polyline points="3.29 7 12 12 20.71 7"/><line x1="12" x2="12" y1="22" y2="12"/></svg>
        ',
        ],
    ];

    $data = $settings[$type];
@endphp

<!-- BUTTON -->
<button type="button"
    class="p-2.5 border-2 border-gray-300 dark:border-gray-700 rounded-xl {{ $data['hover'] }} focus:outline-none"
    data-hs-overlay="#{{ $id }}">
    <img src="{{ asset('assets/images/icons/' . $data['icon'] . '.svg') }}" class="h-4 w-4 block dark:hidden">
    <img src="{{ asset('assets/images/icons/' . $data['icon'] . '-dark.svg') }}" class="h-4 w-4 hidden dark:block">
</button>

<!-- MODAL -->
<div id="{{ $id }}"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-50 overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1">

    <div
        class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center justify-center">

        <div
            class="w-[390px] flex flex-col px-4 py-6 bg-white border border-gray-200 shadow-lg rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700">

            <div class="flex flex-col items-center">

                {{-- ICON DI MODAL --}}
                @if ($type === 'acc')
                    <img src="{{ $data['modal_icon'] }}" class="w-12 h-12">
                @else
                    {!! $data['modal_icon'] !!}
                @endif

                <h3 class="text-xl mt-2 mb-1 font-semibold" style="color: {{ $data['color'] }}">
                    {{ $data['title'] }}
                </h3>
            </div>

            <p class="mt-1 mb-7 text-gray-800 text-center dark:text-neutral-400">
                Apakah Anda yakin ingin <span class="font-semibold text-gray-800 dark:text-white">
                    {{ strtolower($data['btn']) }}
                </span>
                <span class="font-semibold text-gray-800 dark:text-white">{{ $item }}</span>?
            </p>

            <form action="{{ $action }}" method="POST">
                @csrf

                <div class="flex justify-center gap-x-2">
                    <button type="button"
                        class="py-2 px-3 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 hover:bg-gray-50 dark:bg-neutral-800 dark:text-white"
                        data-hs-overlay="#{{ $id }}">
                        Batal
                    </button>

                    <button type="submit" class="py-2 px-3 text-sm font-medium rounded-lg text-white"
                        style="background-color: {{ $data['color'] }}">
                        {{ $data['btn'] }}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
