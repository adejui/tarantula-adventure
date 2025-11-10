@if ($paginator->hasPages())
    <!-- Pagination Wrapper -->
    <div class="grid justify-center sm:flex sm:justify-between sm:items-center gap-1 mt-4">

        {{-- Total Data --}}
        <div class="text-sm text-gray-700 dark:text-gray-300">
            Menampilkan
            <span class="font-semibold">{{ $paginator->firstItem() }}</span>
            sampai
            <span class="font-semibold">{{ $paginator->lastItem() }}</span>
            dari
            <span class="font-semibold">{{ $paginator->total() }}</span>
            data.
        </div>

        <!-- Pagination -->
        <nav class="flex items-center gap-x-1.5" aria-label="Pagination">

            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <button type="button" disabled
                    class="min-h-9.5 min-w-9.5 py-2 border border-gray-300 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-400 bg-gray-100 cursor-not-allowed dark:text-gray-600 dark:bg-white/10"
                    aria-label="Previous">
                    <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 block dark:hidden">
                    <img src="{{ asset('assets/images/icons/arrow-left-dark.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 hidden dark:block">
                    <span class="sr-only">Previous</span>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="min-h-9.5 min-w-9.5 py-2 border border-gray-300 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-lg text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                    aria-label="Previous">
                    <img src="{{ asset('assets/images/icons/arrow-left.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 block dark:hidden">
                    <img src="{{ asset('assets/images/icons/arrow-left-dark.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 hidden dark:block">
                    </svg>
                    <span class="sr-only">Previous</span>
                </a>
            @endif

            {{-- Pagination Elements --}}
            <div class="flex items-center gap-x-1">
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <div class="hs-tooltip inline-block">
                            <button type="button"
                                class="hs-tooltip-toggle group min-h-9.5 min-w-9.5 flex justify-center items-center text-gray-400 hover:text-blue-600 p-2 text-sm rounded-lg focus:outline-hidden focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:bg-white/10">
                                <span class="group-hover:hidden text-xs">•••</span>
                                <svg class="group-hover:block hidden shrink-0 size-5" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path d="m6 17 5-5-5-5" />
                                    <path d="m13 17 5-5-5-5" />
                                </svg>
                                <span
                                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-10 py-1 px-2 bg-gray-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700"
                                    role="tooltip">
                                    More pages
                                </span>
                            </button>
                        </div>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span
                                    class="min-h-9.5 min-w-9.5 flex justify-center items-center bg-[#997EC3] text-white py-3 px-4 text-sm rounded-md dark:bg-[#997EC3] dark:text-white"
                                    aria-current="page">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}"
                                    class="min-h-9.5 min-w-9.5 flex justify-center border border-gray-300 items-center text-gray-800 hover:bg-gray-100 py-2 px-3 text-sm rounded-md focus:outline-hidden focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                                    aria-label="Go to page {{ $page }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="min-h-9.5 min-w-9.5 py-2 border border-gray-300 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded-md text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10"
                    aria-label="Next">
                    <span class="sr-only">Next</span>
                    <img src="{{ asset('assets/images/icons/arrow-right.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 block dark:hidden">
                    <img src="{{ asset('assets/images/icons/arrow-right-dark.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 hidden dark:block">
                    </svg>
                </a>
            @else
                <button type="button" disabled
                    class="min-h-9.5 min-w-9.5 py-2 border border-gray-300 px-2.5 inline-flex justify-center items-center gap-x-2 text-sm rounded text-gray-400 bg-gray-100 cursor-not-allowed dark:text-gray-600 dark:bg-white/10"
                    aria-label="Next">
                    <span class="sr-only">Next</span>
                    <img src="{{ asset('assets/images/icons/arrow-right.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 block dark:hidden">
                    <img src="{{ asset('assets/images/icons/arrow-right-dark.svg') }}" alt="Hapus"
                        class="h-3.5 w-3.5 hidden dark:block">
                    </svg>
                </button>
            @endif
        </nav>
    </div>
@endif
