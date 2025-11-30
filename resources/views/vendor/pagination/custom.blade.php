@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row justify-between items-center border-t border-gray-100 pt-8 gap-4 w-full">
        
        <p class="text-sm text-gray-500">
            Menampilkan halaman <span class="font-bold text-gray-900">{{ $paginator->currentPage() }}</span>
            dari <span class="font-bold text-gray-900">{{ $paginator->lastPage() }}</span>
        </p>

        <div class="flex items-center gap-2 flex-wrap justify-center">
            
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <button disabled class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-100 text-gray-300 cursor-not-allowed shrink-0">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:border-[#7C3AED] hover:text-[#7C3AED] transition shrink-0">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </a>
            @endif

            {{-- Loop Nomor Halaman --}}
            @foreach ($elements as $element)
                
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="w-10 h-10 flex items-center justify-center text-gray-400 shrink-0">...</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            {{-- Halaman Aktif (Ungu) --}}
                            <span class="w-10 h-10 flex items-center justify-center rounded-lg bg-[#7753AF] text-white font-semibold shadow-md shadow-purple-200 cursor-default shrink-0">
                                {{ $page }}
                            </span>
                        @else
                            {{-- Halaman Lain (Putih) --}}
                            <a href="{{ $url }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:border-[#7C3AED] hover:text-[#7C3AED] transition shrink-0">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:border-[#7C3AED] hover:text-[#7C3AED] transition shrink-0">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </a>
            @else
                <button disabled class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-100 text-gray-300 cursor-not-allowed shrink-0">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            @endif

        </div>
    </div>
@endif