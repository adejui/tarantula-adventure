@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <div x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
    }">

        <div x-data="{ showFilter: false }">
            <div
                class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
                <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Daftar Data Peminjam</h3>

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
                            <span class="font-medium text-sm mb-1 dark:text-white">Kampus</span>
                            <button id="campusDropdownBtn" type="button"
                                class="hs-dropdown-toggle py-3 w-72 px-4 inline-flex items-center justify-between gap-x-2 text-sm font-normal rounded-lg border border-gray-300 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                {{ ucfirst(request('campus', 'Semua Kampus')) }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                        </div>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="campusDropdownBtn">
                            <div class="p-1 space-y-0.5">
                                <button type="button" data-value="all"
                                    class="campus-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Semua Kampus
                                </button>

                                @foreach ($campuses as $campus)
                                    <button type="button" data-value="{{ ucfirst($campus) }}"
                                        class="campus-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                        {{ ucwords($campus) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>



                    <div class="hs-dropdown [--auto-close:inside] relative">
                        <div class="flex flex-col">
                            <span class="font-medium text-sm mb-1 dark:text-white">Organisasi</span>
                            <button id="organizationDropdownBtn" type="button"
                                class="hs-dropdown-toggle py-3 w-72 px-4 inline-flex items-center justify-between gap-x-2 text-sm font-normal rounded-lg border border-gray-300 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                {{ ucfirst(request('organization', 'Semua Organisasi')) }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                        </div>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="organizationDropdownBtn">
                            <div class="p-1 space-y-0.5">
                                <button type="button" data-value="all"
                                    class="organization-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Semua Organisasi
                                </button>

                                @foreach ($organizations as $organization)
                                    <button type="button" data-value="{{ ucfirst($organization) }}"
                                        class="organization-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                        {{ ucwords($organization) }}
                                    </button>
                                @endforeach
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
                <div id="opa-table">
                    @include('dashboard.admin.opas.partials.table')
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <template x-teleport="body">
            <div x-cloak x-show="showForm" class="fixed inset-0 z-[99999] flex items-center justify-end">
                <div class="absolute inset-0 bg-black/50" @click="showForm = false"></div>

                <div x-show="showForm" x-transition:enter="transform transition ease-in-out duration-500"
                    x-transition:enter-start="translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    class="relative mr-8 z-[100000] bg-white dark:bg-gray-800 w-full sm:w-[500px] h-fit shadow-2xl border-l border-gray-200 dark:border-neutral-700 p-6 overflow-y-auto rounded-2xl">
                    <div class="flex justify-between items-center pb-3 mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Form Data Peminjam</h2>
                        <button @click="showForm = false"
                            class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                    </div>

                    <form action="{{ route('opas.store') }}" method="POST">
                        @csrf

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Masukan nama lengkap"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('name') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('name')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('name')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Email
                            </label>

                            <input type="email" name="email" value="{{ old('email') }}"
                                placeholder="Masukan email"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('email') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('email')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('email')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                No Telp
                            </label>

                            <input type="text" name="phone_number" value="{{ old('phone_number') }}"
                                placeholder="Masukan no telp"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('phone_number') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('phone_number')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('phone_number')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Kampus
                            </label>

                            <input type="text" name="campus_name" value="{{ old('campus_name') }}"
                                placeholder="Masukan nama kampus"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('campus_name') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('campus_name')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('campus_name')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Organisasi
                            </label>

                            <input type="text" name="organization_name" value="{{ old('organization_name') }}"
                                placeholder="Masukan nama organisasi"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('organization_name') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('organization_name')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('organization_name')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end items-center w-full mt-8">
                            <div class="flex gap-5 w-full justify-end items-center">
                                <a href="{{ route('users.index') }}" title="Hapus"
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
            const tableContainer = document.querySelector("#opa-table");
            const perPageSelect = document.querySelector("#perPageSelect");
            const campusButtons = document.querySelectorAll(".campus-option");
            const campusBtnLabel = document.querySelector("#campusDropdownBtn");
            const organizationButtons = document.querySelectorAll(".organization-option");
            const organizationBtnLabel = document.querySelector("#organizationDropdownBtn");
            const resetBtn = document.querySelector("#resetFiltersBtn");

            let searchTimeout = null;

            let currentCampus = "{{ request('campus', 'all') }}";
            let currentOrganization = "{{ request('organization', 'all') }}";

            // SVG untuk dropdown
            const dropdownIcon = `
        <svg class='hs-dropdown-open:rotate-180 size-4' xmlns='http://www.w3.org/2000/svg'
            viewBox='0 0 24 24' fill='none' stroke='currentColor'
            stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
            <path d='m6 9 6 6 6-6'/>
        </svg>
    `;

            // FETCH DATA
            async function fetchData(url = "{{ route('opas.index') }}") {
                const params = new URLSearchParams({
                    search: searchInput.value,
                    perPage: perPageSelect.value,
                    campus: currentCampus,
                    organization: currentOrganization
                });

                if (url.includes("?")) {
                    const baseUrl = url.split("?")[0];
                    const existingParams = new URLSearchParams(url.split("?")[1]);

                    existingParams.set("search", searchInput.value);
                    existingParams.set("perPage", perPageSelect.value);
                    existingParams.set("campus", currentCampus);
                    existingParams.set("organization", currentOrganization);

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

                // Re-init components after AJAX update
                if (window.HSStaticMethods) {
                    window.HSStaticMethods.autoInit();
                }

                initDeleteForms();
            }

            // DELETE FORM CONFIRMATION
            function initDeleteForms() {
                document.querySelectorAll("form.btn-delete").forEach(form => {
                    form.addEventListener("submit", function(e) {
                        if (!confirm("Yakin ingin menghapus data ini?")) {
                            e.preventDefault();
                        }
                    });
                });
            }

            initDeleteForms();

            // SEARCH
            searchInput.addEventListener("input", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => fetchData(), 300);
            });

            // PER PAGE
            perPageSelect.addEventListener("change", function() {
                fetchData();
            });

            // FILTER CAMPUS
            campusButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    currentCampus = this.dataset.value;
                    campusBtnLabel.innerHTML = `${this.textContent} ${dropdownIcon}`;
                    fetchData();
                });
            });

            // FILTER ORGANIZATION
            organizationButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    currentOrganization = this.dataset.value;
                    organizationBtnLabel.innerHTML = `${this.textContent} ${dropdownIcon}`;
                    fetchData();
                });
            });

            // PAGINATION AJAX
            document.addEventListener("click", function(e) {
                const link = e.target.closest(".pagination a");
                if (link) {
                    e.preventDefault();
                    fetchData(link.getAttribute("href"));
                }
            });

            // RESET FILTERS
            resetBtn.addEventListener("click", function() {

                currentCampus = "all";
                currentOrganization = "all";
                searchInput.value = "";

                // Reset label tombol
                campusBtnLabel.innerHTML = `Semua Kampus ${dropdownIcon}`;
                organizationBtnLabel.innerHTML = `Semua Organisasi ${dropdownIcon}`;

                fetchData();
            });

        });
    </script>
@endsection
