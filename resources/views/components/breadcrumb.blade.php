<div class="mb-2 mt-5 flex flex-wrap items-center justify-end gap-3 pr-2">
    <nav>
        <ol class="flex items-center gap-1.5">

            {{-- Dashboard --}}
            <li>
                <a class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400"
                    href="{{ route('dashboard') }}">
                    Dashboard

                    <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="currentColor" stroke-width="1.2"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </li>

            {{-- Dynamic breadcrumb --}}
            @foreach ($items as $item)
                <li class="flex items-center gap-1.5 mt-0.5">

                    @if ($loop->last)
                        <span class="text-xs font-medium text-gray-800 dark:text-white">
                            {{ $item['label'] }}
                        </span>
                    @else
                        <a href="{{ $item['url'] }}"
                            class="inline-flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400">
                            {{ $item['label'] }}

                            <svg class="stroke-current" width="17" height="16" viewBox="0 0 17 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M6.0765 12.667L10.2432 8.50033L6.0765 4.33366" stroke="currentColor"
                                    stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    @endif

                </li>
            @endforeach

        </ol>
    </nav>
</div>
