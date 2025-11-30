<nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 {{ Request::routeIs('frontend.home') ? 'bg-transparent py-4' : 'bg-[#1c1c1c] shadow-lg py-3' }}">
    <div class="flex items-center justify-between px-6 md:px-8 w-full">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-white">
                <img src="{{ asset('frontend/images/logo.jpeg') }}" alt="Logo" class="w-full h-full object-cover" />
            </div>
            <div class="flex flex-col leading-tight">
                <span class="font-bold text-lg tracking-wide text-white">Tarantula</span>
                <span class="text-xs text-gray-300 uppercase tracking-wider">Adventure</span>
            </div>
        </div>

        <button id="mobile-menu-btn" class="block md:hidden text-white text-3xl focus:outline-none z-50 relative p-1">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-200">
            <a href="{{ route('frontend.home') }}" class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                <i class="fa-solid fa-house"></i> Home
            </a>
            <a href="{{ route('frontend.inventory') }}" class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                <i class="fa-solid fa-cube"></i> Inventaris
            </a>

            <div class="relative group h-full flex items-center cursor-pointer">
                <div class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                    <i class="fa-solid fa-circle-info"></i> Information
                    <i class="fa-solid fa-chevron-down text-xs group-hover:rotate-180 transition-transform"></i>
                </div>
                <div
                    class="absolute top-full left-1/2 -translate-x-1/2 mt-4 w-40 bg-white text-gray-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 overflow-hidden">
                    <a href="#" class="block px-4 py-3 hover:bg-purple-100 text-purple-700"><i
                            class="fa-regular fa-newspaper mr-2"></i> Berita</a>
                    <a href="{{ route('frontend.kegiatan') }}" class="block px-4 py-3 hover:bg-purple-100 text-purple-700"><i
                            class="fa-solid fa-person-hiking mr-2"></i> Kegiatan</a>
                </div>
                <div class="absolute top-full left-0 w-full h-4 bg-transparent"></div>
            </div>

            <a href="#" class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                <i class="fa-solid fa-phone"></i> Contact Us
            </a>
        </div>

        <div class="hidden md:flex items-center gap-4">
            <div class="relative group">
                <input type="text" placeholder="Cari alat, artikel..."
                    class="bg-white/10 text-white text-sm rounded-full pl-10 pr-4 py-2 border border-white/20 focus:outline-none focus:border-[#7C3AED] focus:bg-white/20 focus:w-64 placeholder-gray-400 w-48 transition-all duration-300">
                <i
                    class="fa-solid fa-magnifying-glass absolute left-3.5 top-2.5 text-gray-400 group-hover:text-white transition-colors text-xs"></i>
            </div>

            {{-- @guest --}}
                <a href="javascript:void(0)" @click="loginOpen = true"
                    class="px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-300 bg-[#7C3AED] text-white border-2 border-[#7C3AED] hover:bg-[#6D28D9] hover:border-[#6D28D9] shadow-lg hover:scale-105">
                    Sign In
                </a>
            {{-- @endguest --}}

            {{-- @auth
                <div x-data="{ userDropdown: false }" class="relative">

                    <button @click="userDropdown = !userDropdown"
                        class="flex items-center gap-3 focus:outline-none group text-left">

                        <div
                            class="w-10 h-10 rounded-full overflow-hidden border-2 border-gray-500 group-hover:border-[#7C3AED] transition-colors">
                            <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random&color=fff' }}"
                                alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                        </div>

                        <div class="hidden lg:flex flex-col leading-tight">
                            <span class="font-bold text-sm text-white group-hover:text-[#7C3AED] transition-colors">
                                {{ Auth::user()->name }}
                            </span>
                            <span class="text-[10px] text-gray-400 uppercase tracking-widest font-medium">
                                {{ Auth::user()->role ?? 'ANGGOTA' }}
                            </span>
                        </div>

                        <i class="fa-solid fa-caret-down text-gray-400 text-xs transition-transform duration-300 group-hover:text-white"
                            :class="{ 'rotate-180': userDropdown }"></i>
                    </button>

                    <div x-show="userDropdown" @click.away="userDropdown = false"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0" x-cloak
                        class="absolute right-0 mt-4 w-48 bg-white rounded-xl shadow-2xl py-2 text-gray-800 z-50 overflow-hidden border border-gray-100 origin-top-right">

                        <div class="px-4 py-3 border-b border-gray-100 lg:hidden bg-gray-50">
                            <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 uppercase">{{ Auth::user()->role }}</p>
                        </div>

                        <a href="#"
                            class="block px-4 py-2 text-sm hover:bg-purple-50 hover:text-[#7C3AED] transition-colors">
                            <i class="fa-solid fa-user mr-2 w-4 text-center"></i> Profile Saya
                        </a>

                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="block px-4 py-2 text-sm hover:bg-purple-50 hover:text-[#7C3AED] transition-colors">
                                <i class="fa-solid fa-gauge-high mr-2 w-4 text-center"></i> Dashboard
                            </a>
                        @endif

                        <div class="border-t border-gray-100 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium">
                                <i class="fa-solid fa-right-from-bracket mr-2 w-4 text-center"></i> Logout
                            </button>
                        </form>
                    </div>

                </div>
            @endauth --}}
        </div>
    </div>

    <div id="mobile-menu"
        class="hidden md:hidden fixed inset-0 top-[72px] z-40 bg-[#1c1c1c] border-t border-white/10 overflow-y-auto transition-all duration-300">

        <div class="flex flex-col px-6 py-8 space-y-6 text-gray-200 font-medium">

            <a href="#" class="flex items-center gap-4 text-lg hover:text-[#7C3AED] transition-colors">
                <i class="fa-solid fa-house w-6 text-center"></i> Home
            </a>
            <a href="{{ route('frontend.inventory') }}" class="flex items-center gap-4 text-lg hover:text-[#7C3AED] transition-colors">
                <i class="fa-solid fa-cube w-6 text-center"></i> Inventaris
            </a>

            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-4 text-gray-400 text-lg">
                    <i class="fa-solid fa-circle-info w-6 text-center"></i> Information
                </div>
                <div class="pl-12 flex flex-col gap-4 text-base text-gray-300 border-l-2 border-gray-700 ml-3">
                    <a href="#" class="hover:text-[#7C3AED] flex items-center gap-2 transition-colors">
                        <i class="fa-regular fa-newspaper"></i> Berita
                    </a>
                    <a href="" class="hover:text-[#7C3AED] flex items-center gap-2 transition-colors">
                        <i class="fa-solid fa-person-hiking"></i> Kegiatan
                    </a>
                </div>
            </div>

            <a href="#" class="flex items-center gap-4 text-lg hover:text-[#7C3AED] transition-colors">
                <i class="fa-solid fa-phone w-6 text-center"></i> Contact Us
            </a>

            <div class="border-t border-white/10 pt-6 flex flex-col gap-4 mt-4">
                <a href="javascript:void(0)"
                    @click="loginOpen = true; document.getElementById('mobile-menu').classList.add('hidden')"
                    class="block w-full text-center py-3 rounded-xl bg-[#7C3AED] text-white font-semibold hover:bg-[#6D28D9] transition-colors shadow-lg">
                    Sign In
                </a>
            </div>

            <div class="mt-8 pt-6 border-t border-white/10">

                <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-4">Hubungi Kami</p>

                <div class="space-y-4 text-sm text-gray-400 mb-8">
                    <a href="mailto:tarantula@ubsi.ac.id"
                        class="flex items-center gap-3 hover:text-white transition-colors">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-[#7C3AED]">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <span>tarantula@ubsi.ac.id</span>
                    </a>
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-[#7C3AED]">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <span>+62 274 123456</span>
                    </div>
                    <div class="flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-[#7C3AED] flex-shrink-0">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span>UBSI Yogyakarta Campus<br>Jl. Ringroad Barat, Gamping</span>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4">
                    <a href="#"
                        class="flex-1 h-10 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:bg-[#7C3AED] hover:text-white transition-all">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="#"
                        class="flex-1 h-10 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:bg-[#7C3AED] hover:text-white transition-all">
                        <i class="fa-brands fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#"
                        class="flex-1 h-10 rounded-lg bg-white/5 flex items-center justify-center text-gray-400 hover:bg-[#7C3AED] hover:text-white transition-all">
                        <i class="fa-brands fa-twitter text-lg"></i>
                    </a>
                </div>

                <div class="mt-8 text-center text-xs text-gray-600">
                    &copy; 2025 Tarantula Adventure
                </div>
            </div>

        </div>
</nav>
