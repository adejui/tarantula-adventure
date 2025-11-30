@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <div x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
        generation: '{{ old('generation') }}',
        nrp: '{{ old('nrp', $autoNRP ?? 'Otomatis terisi') }}',
    
        updateNRP() {
            if (this.generation.trim()) {
                fetch(`/generate-nrp/${this.generation}`)
                    .then(res => res.json())
                    .then(data => this.nrp = data.nrp)
                    .catch(() => this.nrp = '')
            } else {
                this.nrp = ''
            }
        }
    }">

        <x-breadcrumb :items="[['label' => 'Anggota', 'url' => route('users.index')]]" />

        <div x-data="{ showFilter: false }">
            <div
                class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
                <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Daftar Anggota</h3>

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
                                <button type="button" data-value="active"
                                    class="status-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Aktif
                                </button>
                                <button type="button" data-value="inactive"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Tidak Aktif
                                </button>
                                <button type="button" data-value="alumni"
                                    class="status-option flex items-center w-full  gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Alumni
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="hs-dropdown [--auto-close:inside] relative">
                        <div class="flex flex-col">
                            <span class="font-medium text-sm mb-1 dark:text-white">Prodi</span>
                            <button id="majorDropdownBtn" type="button"
                                class="hs-dropdown-toggle py-3 w-52 px-4 inline-flex items-center justify-between gap-x-2 text-sm font-normal rounded-lg border border-gray-300 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                {{ ucfirst(request('major', 'Semua Prodi')) }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                        </div>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="majorDropdownBtn">
                            <div class="p-1 space-y-0.5">
                                <button type="button" data-value="all"
                                    class="major-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Semua Prodi
                                </button>

                                @foreach ($majors as $major)
                                    <button type="button" data-value="{{ ucfirst($major) }}"
                                        class="major-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                        {{ ucfirst($major) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="hs-dropdown [--auto-close:inside] relative">
                        <div class="flex flex-col">
                            <span class="font-medium text-sm mb-1 dark:text-white">Angkatan</span>
                            <button id="generationDropdownBtn" type="button"
                                class="hs-dropdown-toggle py-3 w-52 px-4 inline-flex items-center justify-between gap-x-2 text-sm font-normal rounded-lg border border-gray-300 bg-white text-gray-800 shadow-2xs focus:outline-hidden dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                {{ ucfirst(request('generation', 'Semua Angkatan')) }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                        </div>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700"
                            role="menu" aria-orientation="vertical" aria-labelledby="generationDropdownBtn">
                            <div class="p-1 space-y-0.5">
                                <button type="button" data-value="all"
                                    class="generation-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Semua Angkatan
                                </button>

                                @foreach ($generations as $generation)
                                    <button type="button" data-value="{{ $generation }}"
                                        class="generation-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                        {{ $generation }}
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
                <div id="user-table">
                    @include('dashboard.admin.users.partials.table')
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
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Form Anggota</h2>
                        <button @click="showForm = false"
                            class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                    </div>

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Nama Lengkap
                            </label>

                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                placeholder="Masukan nama lengkap"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('full_name') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('full_name')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('full_name')
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
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Kata Sandi
                            </label>
                            <div x-data="{ showPassword: false }" class="relative">
                                <input :type="showPassword ? 'text' : 'password'" id="password" name="password" readonly
                                    value="{{ $autoPassword }}" placeholder="Masukan kata sandi"
                                    class="dark:bg-dark-900 bg-gray-100 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-none px-4 py-3.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('password') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror" />

                                <!-- Tombol tampil/sembunyikan password -->
                                <span @click="showPassword = !showPassword"
                                    class="absolute top-1/2 right-4 z-30 -translate-y-1/2 cursor-pointer">
                                    <!-- Icon Mata Tertutup -->
                                    <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400" width="20"
                                        height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" />
                                    </svg>

                                    <!-- Icon Mata Terbuka -->
                                    <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400" width="20"
                                        height="20" viewBox="0 0 20 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" />
                                    </svg>
                                </span>
                            </div>

                            @error('password')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                            {{-- <input type="hidden" id="prefix" value="{{ $prefix }}"> --}}

                            <div class="mb-4">
                                <label for="nrp"
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">NRP</label>
                                <input type="text" name="nrp" id="nrp"
                                    value="{{ $autoNRP ?? 'Otomatis terisi' }}" readonly
                                    class="dark:bg-dark-900 dark:border-0 bg-gray-100 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-none px-4 py-3.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                            </div>

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Angkatan
                                </label>

                                <input type="text" id="generation" name="generation" value="{{ old('generation') }}"
                                    placeholder="Masukan angkatan"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('generation') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('generation')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('generation')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Tahun
                                </label>

                                <input type="text" id="batch" name="batch" value="{{ old('batch') }}"
                                    placeholder="Masukan tahun"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('batch') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('batch')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('batch')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const generation = document.getElementById("generation");
                                const batch = document.getElementById("batch");
                                const nrp = document.getElementById("nrp");
                                const password = document.getElementById("password");

                                async function updateAutoFields() {
                                    if (generation.value && batch.value) {
                                        const res = await fetch(
                                            `/generate-nrp-password?generation=${generation.value}&batch=${batch.value}`);
                                        const data = await res.json();

                                        nrp.value = data.nrp ?? "Otomatis terisi";
                                        password.value = data.password ?? "";
                                    } else {
                                        nrp.value = "Otomatis terisi";
                                        password.value = "";
                                    }
                                }

                                generation.addEventListener("input", updateAutoFields);
                                batch.addEventListener("input", updateAutoFields);
                            });
                        </script>

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-4">
                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Role
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="role"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('role') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            --pilih role--
                                        </option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Admin
                                        </option>
                                        <option value="logistics" {{ old('role') == 'logistics' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Logistik
                                        </option>
                                        <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Anggota
                                        </option>
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

                                @error('role')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Status
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="status"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('status') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            --pilih status--
                                        </option>
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Aktif
                                        </option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Tidak Aktif
                                        </option>
                                        <option value="alumni" {{ old('status') == 'alumni' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Alumni
                                        </option>
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

                                @error('status')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Jabatan
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="position"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('position') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            --pilih jabatan--
                                        </option>
                                        <option value="leader" {{ old('position') == 'leader' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Ketua
                                        </option>
                                        <option value="secretary" {{ old('position') == 'secretary' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Sekretaris
                                        </option>
                                        <option value="logistics" {{ old('position') == 'logistics' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Logistik
                                        </option>
                                        <option value="member" {{ old('position') == 'member' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Anggota
                                        </option>
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

                                @error('position')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
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
            const tableContainer = document.querySelector("#user-table");
            const perPageSelect = document.querySelector("#perPageSelect");
            const statusButtons = document.querySelectorAll(".status-option");
            const statusBtnLabel = document.querySelector("#statusDropdownBtn");
            const majorButtons = document.querySelectorAll(".major-option");
            const majorBtnLabel = document.querySelector("#majorDropdownBtn");
            const generationButtons = document.querySelectorAll(".generation-option");
            const generationBtnLabel = document.querySelector("#generationDropdownBtn");
            const resetBtn = document.querySelector("#resetFiltersBtn");

            let searchTimeout = null;
            let currentStatus = "{{ request('status', 'all') }}";
            let currentMajor = "{{ request('major', 'all') }}";
            let currentGeneration = "{{ request('generation', 'all') }}";

            async function fetchData(url = "{{ route('users.index') }}") {
                const params = new URLSearchParams({
                    search: searchInput.value,
                    perPage: perPageSelect.value,
                    status: currentStatus,
                    major: currentMajor,
                    generation: currentGeneration
                });

                if (url.includes("?")) {
                    const baseUrl = url.split("?")[0];
                    const existingParams = new URLSearchParams(url.split("?")[1]);
                    existingParams.set("search", searchInput.value);
                    existingParams.set("perPage", perPageSelect.value);
                    existingParams.set("status", currentStatus);
                    existingParams.set("major", currentMajor);
                    existingParams.set("generation", currentGeneration);
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

            // 🔍 Pencarian otomatis
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

            // Filter Prodi
            majorButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    currentMajor = this.dataset.value;
                    majorBtnLabel.innerHTML = this.textContent + `
            <svg class='hs-dropdown-open:rotate-180 size-4' xmlns='http://www.w3.org/2000/svg'
                width='24' height='24' viewBox='0 0 24 24' fill='none'
                stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                <path d='m6 9 6 6 6-6'/>
            </svg>`;
                    fetchData();
                });
            });

            // Filter Angkatan
            generationButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    currentGeneration = this.dataset.value;
                    generationBtnLabel.innerHTML = this.textContent + `
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
                currentMajor = "all";
                currentGeneration = "all";
                searchInput.value = "";
                fetchData();
            });
        });
    </script>
@endsection
