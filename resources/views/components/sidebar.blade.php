<aside :class="sidebarToggle ? 'translate-x-0 lg:w-[90px]' : '-translate-x-full'"
    class="sidebar fixed left-0 top-0 z-9999 flex h-screen w-[290px] flex-col overflow-y-hidden border-r border-gray-200 bg-white px-5 duration-300 ease-linear dark:border-gray-800 dark:bg-black lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    <!-- SIDEBAR HEADER -->
    <div :class="sidebarToggle ? 'justify-center' : 'justify-between'"
        class="sidebar-header flex items-center gap-2 pb-4 pt-5 mt-2 lg:mb-2 mx-2 border-b-2">
        <a href="{{ route('dashboard') }}">
            <span class="logo" :class="sidebarToggle ? 'hidden' : ''">
                <div class="flex">
                    <div class="me-4">
                        <img class="dark:hidden h-16 w-16" src="{{ asset('assets/images/logo/logo-transparent.png') }}"
                            alt="Logo" />
                        <img class="hidden dark:block h-16 w-16"
                            src="{{ asset('assets/images/logo/logo-transparent.png') }}" alt="Logo" />
                    </div>
                    <div class="text-black dark:text-white">
                        <h1 class="uppercase font-bold text-3xl">MAPALA</h1>
                        <p>UBSI</p>
                    </div>
                </div>
            </span>

            <img class="logo-icon h-8 w-8" :class="sidebarToggle ? 'lg:block' : 'hidden'"
                src="{{ asset('assets/images/logo/logo-transparent.png') }}" alt="Logo" />
        </a>
    </div>
    <!-- SIDEBAR HEADER -->

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <!-- Sidebar Menu -->
        <nav x-data="{ selected: $persist('Dashboard') }">
            <!-- Menu Group -->
            <div>
                <h3 class="mb-4 text-xs uppercase text-gray-400">

                    <svg :class="sidebarToggle ? 'lg:block hidden' : 'hidden'"
                        class="menu-group-icon mx-auto fill-current" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M5.99915 10.2451C6.96564 10.2451 7.74915 11.0286 7.74915 11.9951V12.0051C7.74915 12.9716 6.96564 13.7551 5.99915 13.7551C5.03265 13.7551 4.24915 12.9716 4.24915 12.0051V11.9951C4.24915 11.0286 5.03265 10.2451 5.99915 10.2451ZM17.9991 10.2451C18.9656 10.2451 19.7491 11.0286 19.7491 11.9951V12.0051C19.7491 12.9716 18.9656 13.7551 17.9991 13.7551C17.0326 13.7551 16.2491 12.9716 16.2491 12.0051V11.9951C16.2491 11.0286 17.0326 10.2451 17.9991 10.2451ZM13.7491 11.9951C13.7491 11.0286 12.9656 10.2451 11.9991 10.2451C11.0326 10.2451 10.2491 11.0286 10.2491 11.9951V12.0051C10.2491 12.9716 11.0326 13.7551 11.9991 13.7551C12.9656 13.7551 13.7491 12.9716 13.7491 12.0051V11.9951Z"
                            fill="" />
                    </svg>
                </h3>

                <ul class="mb-6 flex flex-col gap-4">

                    <!-- Menu Item Dashboard -->
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="menu-item font-normal group rounded-lg py-3.5 {{ request()->routeIs('dashboard') ? 'bg-[#3A1096]/50' : 'menu-item-inactive' }}">

                            <!-- Icon -->
                            @if (request()->routeIs('dashboard'))
                                {{-- Route aktif --}}
                                <img src="{{ asset('assets/images/icons/layout-dashboard-dark.svg') }}"
                                    alt="Dashboard Icon Active (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">

                                <img src="{{ asset('assets/images/icons/layout-dashboard-dark.svg') }}"
                                    alt="Dashboard Icon Active (Dark Mode)"
                                    class="menu-item-icon ms-1 hidden dark:inline" width="24" height="24">
                            @else
                                {{-- Route tidak aktif --}}
                                <img src="{{ asset('assets/images/icons/layout-dashboard.svg') }}"
                                    alt="Dashboard Icon (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">

                                <img src="{{ asset('assets/images/icons/layout-dashboard-dark.svg') }}"
                                    alt="Dashboard Icon (Dark Mode)" class="menu-item-icon ms-1 hidden dark:inline"
                                    width="24" height="24">
                            @endif


                            <!-- Text -->
                            <span
                                class="menu-item-text transition-colors duration-200 dark:text-gray-300 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-black' }}"
                                :class="sidebarToggle ? 'lg:hidden' : ''">
                                Dashboard
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Dashboard -->

                    <!-- Menu Item Anggota -->
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="menu-item font-normal group rounded-lg py-3.5 {{ request()->routeIs('users*') ? 'bg-[#3A1096]/50' : 'menu-item-inactive' }}">

                            <!-- Icon -->
                            @if (request()->routeIs('users*'))
                                {{-- Route aktif --}}
                                <img src="{{ asset('assets/images/icons/circle-user-round-dark.svg') }}"
                                    alt="Anggota Icon Active (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">

                                <img src="{{ asset('assets/images/icons/circle-user-round-dark.svg') }}"
                                    alt="Anggota Icon Active (Dark Mode)" class="menu-item-icon ms-1 hidden dark:inline"
                                    width="24" height="24">
                            @else
                                {{-- Route tidak aktif --}}
                                <img src="{{ asset('assets/images/icons/circle-user-round.svg') }}"
                                    alt="Anggota Icon (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">

                                <img src="{{ asset('assets/images/icons/circle-user-round-dark.svg') }}"
                                    alt="Anggota Icon (Dark Mode)" class="menu-item-icon ms-1 hidden dark:inline"
                                    width="24" height="24">
                            @endif

                            <!-- Text -->
                            <span
                                class="menu-item-text transition-colors duration-200 dark:text-gray-300 {{ request()->routeIs('users*') ? 'text-white' : 'text-black' }}"
                                :class="sidebarToggle ? 'lg:hidden' : ''">
                                Anggota
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Anggota -->

                    <!-- Menu Item Kegiatan -->
                    <li x-data="{
                        selected: '',
                        isActive: {{ in_array(Route::currentRouteName(), [
                            'activities.index',
                            'list.activity',
                            'manage.activity',
                            'activities.show',
                        ])
                            ? 'true'
                            : 'false' }}
                    }">
                        <a href="#" @click.prevent="selected = (selected === 'Kegiatan' ? '' : 'Kegiatan')"
                            class="menu-item font-normal group rounded-lg py-3.5 flex items-center relative"
                            :class="isActive
                                ?
                                'bg-[#3A1096]/50 text-white' :
                                'menu-item-inactive text-gray-700 dark:text-gray-300'">

                            <!-- Icon -->
                            @if (in_array(Route::currentRouteName(), ['activities.index', 'manage.activity', 'list.activity', 'activities.show']))
                                {{-- Aktif --}}
                                <svg class="menu-item-icon ms-1" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                        fill="white" />
                                </svg>
                            @else
                                {{-- Tidak aktif --}}
                                <svg class="menu-item-icon ms-1" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8 2C8.41421 2 8.75 2.33579 8.75 2.75V3.75H15.25V2.75C15.25 2.33579 15.5858 2 16 2C16.4142 2 16.75 2.33579 16.75 2.75V3.75H18.5C19.7426 3.75 20.75 4.75736 20.75 6V9V19C20.75 20.2426 19.7426 21.25 18.5 21.25H5.5C4.25736 21.25 3.25 20.2426 3.25 19V9V6C3.25 4.75736 4.25736 3.75 5.5 3.75H7.25V2.75C7.25 2.33579 7.58579 2 8 2ZM8 5.25H5.5C5.08579 5.25 4.75 5.58579 4.75 6V8.25H19.25V6C19.25 5.58579 18.9142 5.25 18.5 5.25H16H8ZM19.25 9.75H4.75V19C4.75 19.4142 5.08579 19.75 5.5 19.75H18.5C18.9142 19.75 19.25 19.4142 19.25 19V9.75Z"
                                        fill="currentColor" class="text-black dark:text-gray-300" />
                                </svg>
                            @endif

                            <!-- Label -->
                            <span class="menu-item-text transition-colors duration-200"
                                :class="[
                                    sidebarToggle ? 'lg:hidden' : '',
                                    isActive ? 'text-white' : 'text-black dark:text-gray-300'
                                ]">
                                Kegiatan
                            </span>

                            <!-- Panah -->
                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current transition-all duration-200"
                                :class="[
                                    isActive ?
                                    'rotate-180 text-white' :
                                    (selected === 'Kegiatan' ?
                                        'rotate-180 text-black dark:text-gray-300' :
                                        'text-black dark:text-gray-300'),
                                    sidebarToggle ? 'lg:hidden' : ''
                                ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- Dropdown -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Kegiatan' || isActive) ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="menu-dropdown mt-2 flex flex-col gap-1 pl-9">

                                <li>
                                    <a href="{{ route('activities.index') }}"
                                        class="menu-dropdown-item group font-normal py-3.5 {{ Route::currentRouteName() == 'activities.index' ? 'menu-dropdown-item-active text-white bg-[#3A1096]/40 dark:text-white' : 'menu-dropdown-item-inactive text-gray-700 dark:text-gray-300' }}">
                                        Kalender Kegiatan
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('list.activity') }}"
                                        class="menu-dropdown-item group font-normal py-3.5 {{ in_array(Route::currentRouteName(), ['list.activity', 'manage.activity', 'activities.show']) ? 'menu-dropdown-item-active text-white bg-[#3A1096]/40 dark:text-white' : 'menu-dropdown-item-inactive text-gray-700 dark:text-gray-300' }}">
                                        Daftar Kegiatan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Menu Item Kegiatan -->


                    <!-- Menu Item Inventoris -->
                    <li x-data="{
                        selected: '',
                        isActive: {{ request()->routeIs('items.*') || request()->routeIs('categories.*') ? 'true' : 'false' }}
                    }">
                        <a href="#" @click.prevent="selected = (selected === 'Inventoris' ? '' : 'Inventoris')"
                            class="menu-item font-normal group rounded-lg py-3.5 flex items-center relative"
                            :class="isActive
                                ?
                                'bg-[#3A1096]/50 text-white' :
                                'menu-item-inactive text-gray-700 dark:text-gray-300'">

                            <!-- ICON -->
                            @if (request()->routeIs('items.*') || request()->routeIs('categories.*'))
                                <!-- Aktif -->
                                <img src="{{ asset('assets/images/icons/box-dark.svg') }}"
                                    class="menu-item-icon ms-1 dark:hidden" width="24" height="24">
                                <img src="{{ asset('assets/images/icons/box-dark.svg') }}"
                                    class="menu-item-icon ms-1 hidden dark:inline" width="24" height="24">
                            @else
                                <!-- Tidak aktif -->
                                <img src="{{ asset('assets/images/icons/box.svg') }}"
                                    class="menu-item-icon ms-1 dark:hidden" width="24" height="24">
                                <img src="{{ asset('assets/images/icons/box-dark.svg') }}"
                                    class="menu-item-icon ms-1 hidden dark:inline" width="24" height="24">
                            @endif

                            <!-- LABEL -->
                            <span class="menu-item-text transition-colors duration-200"
                                :class="[sidebarToggle ? 'lg:hidden' : '', isActive ? 'text-white' :
                                    'text-black dark:text-gray-300'
                                ]">
                                Inventoris
                            </span>

                            <!-- ARROW -->
                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current transition-all duration-200"
                                :class="[
                                    (selected === 'Inventoris' || isActive) ? 'rotate-180 text-white' :
                                    'text-black dark:text-gray-300',
                                    sidebarToggle ? 'lg:hidden' : ''
                                ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">

                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </a>

                        <!-- DROPDOWN -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Inventoris' || isActive) ? 'block' : 'hidden'">

                            <ul class="menu-dropdown mt-2 flex flex-col gap-1 pl-9"
                                :class="sidebarToggle ? 'lg:hidden' : 'flex'">

                                <!-- LIST ITEM -->
                                <li>
                                    <a href="{{ route('items.index') }}"
                                        class="menu-dropdown-item group font-normal py-3.5
                        {{ request()->routeIs('items.*')
                            ? 'menu-dropdown-item-active text-white bg-[#3A1096]/40 dark:text-white'
                            : 'menu-dropdown-item-inactive text-gray-700 dark:text-gray-300' }}">
                                        Daftar Alat
                                    </a>
                                </li>

                                <!-- CATEGORY -->
                                <li>
                                    <a href="{{ route('categories.index') }}"
                                        class="menu-dropdown-item group font-normal py-3.5
                        {{ request()->routeIs('categories.*')
                            ? 'menu-dropdown-item-active text-white bg-[#3A1096]/40 dark:text-white'
                            : 'menu-dropdown-item-inactive text-gray-700 dark:text-gray-300' }}">
                                        Kategori
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <!-- Menu Item Inventoris -->


                    <!-- Menu Item Peminjaman -->
                    <li x-data="{
                        selected: '',
                        isActive: {{ in_array(Route::currentRouteName(), ['loans.index', 'opas.index', 'loan-details.index']) ? 'true' : 'false' }}
                    }">
                        <a href="#" @click.prevent="selected = (selected === 'Peminjaman' ? '' : 'Peminjaman')"
                            class="menu-item font-normal group rounded-lg py-3.5 flex items-center relative"
                            :class="isActive
                                ?
                                'bg-[#3A1096]/50 text-white' :
                                'menu-item-inactive text-gray-700 dark:text-gray-300'">

                            <!-- ICON -->
                            @if (in_array(Route::currentRouteName(), ['loans.index', 'opas.index', 'loan-details.index']))
                                {{-- Aktif --}}
                                <img src="{{ asset('assets/images/icons/notepad-text-dark.svg') }}"
                                    alt="Peminjaman Icon Active (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">
                                <img src="{{ asset('assets/images/icons/notepad-text-dark.svg') }}"
                                    alt="Peminjaman Icon Active (Dark Mode)"
                                    class="menu-item-icon ms-1 hidden dark:inline" width="24" height="24">
                            @else
                                {{-- Tidak aktif --}}
                                <img src="{{ asset('assets/images/icons/notepad-text.svg') }}"
                                    alt="Peminjaman Icon (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">
                                <img src="{{ asset('assets/images/icons/notepad-text-dark.svg') }}"
                                    alt="Peminjaman Icon (Dark Mode)" class="menu-item-icon ms-1 hidden dark:inline"
                                    width="24" height="24">
                            @endif

                            <!-- Label -->
                            <span class="menu-item-text transition-colors duration-200"
                                :class="[
                                    sidebarToggle ? 'lg:hidden' : '',
                                    isActive ? 'text-white' : 'text-black dark:text-gray-300'
                                ]">
                                Peminjaman
                            </span>

                            <!-- PANAH -->
                            <svg class="menu-item-arrow absolute right-2.5 top-1/2 -translate-y-1/2 stroke-current transition-all duration-200"
                                :class="[
                                    isActive ?
                                    'rotate-180 text-white' :
                                    (selected === 'Peminjaman' ?
                                        'rotate-180 text-black dark:text-gray-300' :
                                        'text-black dark:text-gray-300'),
                                    sidebarToggle ? 'lg:hidden' : ''
                                ]"
                                width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.79175 7.39584L10.0001 12.6042L15.2084 7.39585" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>

                        <!-- DROPDOWN -->
                        <div class="translate transform overflow-hidden"
                            :class="(selected === 'Peminjaman' || isActive) ? 'block' : 'hidden'">
                            <ul :class="sidebarToggle ? 'lg:hidden' : 'flex'"
                                class="menu-dropdown mt-2 flex flex-col gap-1 pl-9">

                                <li>
                                    <a href="{{ route('loans.index') }}"
                                        class="menu-dropdown-item group font-normal py-3.5
                        {{ Route::currentRouteName() == 'loans.index'
                            ? 'menu-dropdown-item-active text-white bg-[#3A1096]/40 dark:text-white'
                            : 'menu-dropdown-item-inactive text-gray-700 dark:text-gray-300' }}">
                                        Daftar Peminjaman
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('opas.index') }}"
                                        class="menu-dropdown-item group font-normal py-3.5
                        {{ Route::currentRouteName() == 'opas.index'
                            ? 'menu-dropdown-item-active text-white bg-[#3A1096]/40 dark:text-white'
                            : 'menu-dropdown-item-inactive text-gray-700 dark:text-gray-300' }}">
                                        Data Peminjam
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('loan-details.index') }}"
                                        class="menu-dropdown-item group font-normal py-3.5
                        {{ Route::currentRouteName() == 'loan-details.index'
                            ? 'menu-dropdown-item-active text-white bg-[#3A1096]/40 dark:text-white'
                            : 'menu-dropdown-item-inactive text-gray-700 dark:text-gray-300' }}">
                                        Detail Peminjaman
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Menu Item Peminjaman -->


                    <!-- Menu Item Article -->
                    <li>
                        <a
                            href="{{ route('articles.index') }}"class="menu-item font-normal group rounded-lg py-3.5 {{ request()->routeIs('articles*') ? 'bg-[#3A1096]/50' : 'menu-item-inactive' }}">

                            <!-- Icon -->
                            @if (request()->routeIs('articles*'))
                                {{-- Route aktif --}}
                                <img src="{{ asset('assets/images/icons/newspaper-dark.svg') }}"
                                    alt="Article Icon Active (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">

                                <img src="{{ asset('assets/images/icons/newspaper-dark.svg') }}"
                                    alt="Article Icon Active (Dark Mode)"
                                    class="menu-item-icon ms-1 hidden dark:inline" width="24" height="24">
                            @else
                                {{-- Route tidak aktif --}}
                                <img src="{{ asset('assets/images/icons/newspaper.svg') }}"
                                    alt="Article Icon (Light Mode)" class="menu-item-icon ms-1 dark:hidden"
                                    width="24" height="24">

                                <img src="{{ asset('assets/images/icons/newspaper-dark.svg') }}"
                                    alt="Article Icon (Dark Mode)" class="menu-item-icon ms-1 hidden dark:inline"
                                    width="24" height="24">
                            @endif

                            <!-- Text -->
                            <span
                                class="menu-item-text transition-colors duration-200 dark:text-gray-300 {{ request()->routeIs('articles*') ? 'text-white' : 'text-black' }}"
                                :class="sidebarToggle ? 'lg:hidden' : ''">
                                Artikel
                            </span>
                        </a>
                    </li>
                    <!-- Menu Item Article -->
                </ul>
            </div>

        </nav>
        <!-- Sidebar Menu -->
    </div>
</aside>
