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
    ]" />

    <div x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
    }">

        <div x-data="{ showFilter: false }">
            <div
                class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
                <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Daftar Peminjaman</h3>

                <div class="flex justify-between items-center my-2">
                    {{-- Search --}}
                    <div class="hidden lg:max-w-[430px] md:block">
                        <div class="relative">
                            <span class="absolute top-1/2 left-4 -translate-y-1/2">
                                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z" />
                                </svg>
                            </span>
                            <input type="text" placeholder="Search" id="search-input"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-[#7653afaa] focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-sm rounded-lg border-2 border-gray-300 bg-transparent py-2.5 pr-14 pl-12 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>
                    </div>

                    {{-- Filter & Tambah --}}
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 text-xs">
                            <span class="dark:text-white">Showing</span>

                            <div class="relative">
                                <select id="perPageSelect" name="perPage"
                                    class="appearance-none border border-gray-300 rounded-lg ps-3 pe-8 py-2.5 focus:outline-hidden dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800 text-sm">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                </select>
                                <img src="{{ asset('assets/images/icons/chevron-down.svg') }}" alt="arrow light"
                                    class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 w-4 h-4 opacity-70 block dark:hidden">
                                <img src="{{ asset('assets/images/icons/chevron-down-dark.svg') }}" alt="arrow dark"
                                    class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 w-4 h-4 opacity-80 hidden dark:block">
                            </div>
                        </div>

                        <!-- Tombol Filter -->
                        <button @click="showFilter = !showFilter" type="button"
                            :class="showFilter
                                ?
                                'bg-[#7653afaa] text-white border-0 dark:bg-[#7653afaa] dark:border-[#7653afaa] dark:text-white' :
                                'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 hover:text-gray-800 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-white/3 dark:hover:text-gray-200'"
                            class="hidden md:inline-flex items-center gap-2 border rounded-lg px-4 py-2.5 text-sm font-medium shadow-theme-xs transition">

                            <!-- Icon saat tidak aktif -->
                            <img x-show="!showFilter" src="{{ asset('assets/images/icons/funnell.svg') }}"
                                alt="Filter Icon Light" class="w-4 h-4 opacity-70 block dark:hidden">
                            <img x-show="!showFilter" src="{{ asset('assets/images/icons/funnel-darkk.svg') }}"
                                alt="Filter Icon Dark" class="w-4 h-4 opacity-80 hidden dark:block">

                            <!-- Icon saat aktif -->
                            <img x-show="showFilter" src="{{ asset('assets/images/icons/funnell-dark.svg') }}"
                                alt="Filter Icon Active Light" class="w-4 h-4 opacity-90 block">

                            <span class="text-sm font-medium">Filter</span>
                        </button>

                        <button @click="showForm = true"
                            class="inline-flex items-center gap-2 px-4 h-10 text-sm font-medium text-white bg-[#7653afaa] transition rounded-lg shadow-theme-xs hover:bg-[#68489C]">
                            <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="Tambah" class="h-4 w-4">
                            Tambah
                        </button>
                    </div>
                </div>

            </div>

            <!-- Filter Section -->
            <div x-show="showFilter" x-transition
                class="bg-white border border-[#E0E0E0] rounded-xl h-auto mt-2 p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
                <div class="flex justify-start items-center my-2 gap-x-5">

                    <div class="hs-dropdown [--auto-close:inside] relative">
                        <div class="flex flex-col">
                            <span class="font-medium text-sm mb-1 dark:text-white">Status</span>
                            <button id="statusDropdownBtn" type="button"
                                class="hs-dropdown-toggle py-3 w-52 px-4 inline-flex items-center justify-between gap-x-2 text-sm font-normal rounded-lg border border-gray-300 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                {{ ucfirst(request('status', 'Semua Status')) }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                        </div>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="statusDropdownBtn">
                            <div class="p-1 space-y-0.5">
                                <button type="button" data-value="all"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Semua Status
                                </button>
                                <button type="button" data-value="requested"
                                    class="status-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Diajukan
                                </button>
                                <button type="button" data-value="approved"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Disetujui
                                </button>
                                <button type="button" data-value="borrowed"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Dipinjam
                                </button>
                                <button type="button" data-value="returned"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Dikembalikan
                                </button>
                                <button type="button" data-value="rejected"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Ditolak
                                </button>
                                <button type="button" data-value="late"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Terlambat
                                </button>
                            </div>
                        </div>
                    </div>

                    <button id="resetFiltersBtn"
                        class="px-3 mt-6 py-3 border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex items-center gap-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 transition-colors">
                        <img src="{{ asset('assets/images/icons/rotate-cw.svg') }}" alt="reset light"
                            class="w-4 h-4 opacity-70 block dark:hidden">
                        <img src="{{ asset('assets/images/icons/rotate-cw-dark.svg') }}" alt="reset dark"
                            class="w-4 h-4 opacity-80 hidden dark:block">
                        <span class="text-gray-700 dark:text-gray-400">Reset</span>
                    </button>

                </div>
            </div>
        </div>


        <div
            class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 mt-3.5 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
            <div class="w-full overflow-x-auto">
                <div id="loan-table">
                    @include('dashboard.loans.partials.table')
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <template x-teleport="body">
            <div x-cloak x-show="showForm" class="fixed inset-0 z-index flex items-center justify-end">
                <div class="absolute inset-0 bg-black/50" @click="showForm = false"></div>

                <div x-show="showForm" x-transition:enter="transform transition ease-in-out duration-500"
                    x-transition:enter-start="translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    class="relative mr-8 z-index bg-white dark:bg-gray-800 w-full sm:w-[500px] h-fit shadow-2xl border-l border-gray-200 dark:border-neutral-700 p-6 overflow-y-auto rounded-2xl">
                    <div class="flex justify-between items-center pb-3 mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Form Data Peminjaman</h2>
                        <button @click="showForm = false"
                            class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                    </div>

                    <form action="{{ route('loans.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid sm:grid-cols-2 gap-2 mb-4">
                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Nama Opa
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="opa_id"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('opa_id') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            --pilih opa--
                                        </option>
                                        @forelse ($opas as $opa)
                                            <option value="{{ $opa->id }}"
                                                {{ old('opa_id') == $opa->id ? 'selected' : '' }}
                                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                {{ $opa->name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>

                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                @error('opa_id')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Nama Anggota
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="user_id"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('user_id') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            --pilih anggota--
                                        </option>
                                        @forelse ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id') == $user->id ? 'selected' : '' }}
                                                class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                                {{ $user->full_name }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>

                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                @error('user_id')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Pinjam
                            </label>

                            <div class="relative">
                                <input type="date" x-model="dateStr" name="borrow_date"
                                    value="{{ old('borrow_date') }}" placeholder="Pilih tanggal"
                                    onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('borrow_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('borrow_date')
                                    <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>
                            @error('borrow_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Kembali
                            </label>

                            <div class="relative">
                                <input type="date" name="return_date" value="{{ old('return_date') }}"
                                    placeholder="Pilih tanggal" onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('return_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('return_date')
                                    <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>
                            @error('return_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Catatan
                            </label>
                            <textarea name="notes" rows="4" placeholder="Masukan deskripsi"
                                class="text-[#212121] font-normal text-xs w-full rounded-lg border bg-transparent px-4 py-2.5 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('notes') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"></textarea>
                            @error('notes')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-7">
                            <label for="loan_document"
                                class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                File Dokumen
                            </label>

                            <div class="relative">
                                <input type="file" name="loan_document"
                                    class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 w-full overflow-hidden rounded-lg border bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3.5 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/3 dark:file:text-gray-400 dark:placeholder:text-gray-400 @error('loan_document') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 dark:border-gray-700 @enderror" />

                                @error('loan_document')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>

                            @error('loan_document')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end items-center w-full mt-8">
                            <div class="flex gap-5 w-full justify-end items-center">
                                <a href="{{ route('loans.index') }}" title="Hapus"
                                    class="p-2 border-2 text-sm dark:text-white border-[#7753AF] bg-transparent w-full rounded-lg text-[#7753AF] text-center dark:hover:bg-gray-800 hover:bg-[#F3E8FF] transition">
                                    Batal
                                </a>

                                <button type="submit"
                                    class="p-2 border-2 text-sm border-[#7753AF] bg-[#7753AF] w-full rounded-lg text-white text-center hover:bg-[#67419B] transition">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </template>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector("#search-input");
            const tableContainer = document.querySelector("#loan-table");
            const perPageSelect = document.querySelector("#perPageSelect");
            const statusButtons = document.querySelectorAll(".status-option");
            const statusBtnLabel = document.querySelector("#statusDropdownBtn");
            const resetBtn = document.querySelector("#resetFiltersBtn");

            let searchTimeout = null;
            let currentStatus = "{{ request('status', 'all') }}";

            async function fetchData(url = "{{ route('loans.index') }}") {
                const params = new URLSearchParams({
                    search: searchInput.value,
                    perPage: perPageSelect.value,
                    status: currentStatus,
                });

                if (url.includes("?")) {
                    const baseUrl = url.split("?")[0];
                    const existingParams = new URLSearchParams(url.split("?")[1]);
                    existingParams.set("search", searchInput.value);
                    existingParams.set("perPage", perPageSelect.value);
                    existingParams.set("status", currentStatus);
                    url = `${baseUrl}?${existingParams.toString()}`;
                } else {
                    url = `${url}?${params.toString()}`;
                }

                const response = await fetch(url, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                const html = await response.text();
                tableContainer.innerHTML = html;

                // 🧠 Tambahkan ini supaya modal & komponen aktif lagi
                if (window.HSStaticMethods) {
                    window.HSStaticMethods.autoInit();
                }

                // 🧩 Tambahkan ulang event listener untuk form delete (karena DOM diganti)
                initDeleteForms();
            }

            // Fungsi untuk inisialisasi ulang tombol/form delete
            function initDeleteForms() {
                const deleteForms = document.querySelectorAll('form.btn-delete');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const confirmed = confirm('Yakin ingin menghapus data ini?');
                        if (!confirmed) e.preventDefault();
                    });
                });
            }

            // Jalankan sekali di awal
            initDeleteForms();

            // Pencarian otomatis
            searchInput.addEventListener("input", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => fetchData(), 300);
            });

            // Ganti jumlah per halaman
            perPageSelect.addEventListener("change", function() {
                fetchData();
            });

            // Filter Status
            statusButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    currentStatus = this.dataset.value;
                    statusBtnLabel.innerHTML = this.textContent + `
            <svg class='hs-dropdown-open:rotate-180 size-4' xmlns='http://www.w3.org/2000/svg'
                width='24' height='24' viewBox='0 0 24 24' fill='none'
                stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                <path d='m6 9 6 6 6-6'/>
            </svg>`;
                    fetchData();
                });
            });

            // Pagination AJAX
            document.addEventListener("click", function(e) {
                const link = e.target.closest(".pagination a");
                if (link) {
                    e.preventDefault();
                    fetchData(link.getAttribute("href"));
                }
            });

            // Reset Filter
            resetBtn.addEventListener("click", function() {
                currentStatus = "all";
                searchInput.value = "";
                fetchData();
            });
        });
    </script>
@endsection
