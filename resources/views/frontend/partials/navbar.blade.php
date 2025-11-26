
<nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-transparent py-4">
    <div class="flex items-center justify-between px-6 md:px-8 w-full">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center overflow-hidden border-2 border-white">
                <img src="{{ asset('frontend/images/logo.jpeg') }}" alt="Logo" class="w-full h-full object-cover" />
            </div>
            <div class="flex flex-col leading-tight">
                <span class="font-bold text-lg tracking-wide text-white">Tarantula</span>
                <span class="text-xs text-gray-300 uppercase tracking-wider">Adventure</span>
            </div>
        </div>

        <button id="mobile-menu-btn" class="block md:hidden text-white text-2xl focus:outline-none">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-200">
            <a href="#" class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                <i class="fa-solid fa-house"></i> Home
            </a>
            <a href="#" class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                <i class="fa-solid fa-cube"></i> Inventaris
            </a>

            <div class="relative group h-full flex items-center cursor-pointer">
                <div class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                    <i class="fa-solid fa-circle-info"></i> Information
                    <i class="fa-solid fa-chevron-down text-xs group-hover:rotate-180 transition-transform"></i>
                </div>
                <div class="absolute top-full left-1/2 -translate-x-1/2 mt-4 w-40 bg-white text-gray-800 rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 overflow-hidden">
                    <a href="#" class="block px-4 py-3 hover:bg-purple-100 text-purple-700"><i class="fa-regular fa-newspaper mr-2"></i> Berita</a>
                    <a href="#" class="block px-4 py-3 hover:bg-purple-100 text-purple-700"><i class="fa-solid fa-person-hiking mr-2"></i> Kegiatan</a>
                </div>
                <div class="absolute top-full left-0 w-full h-4 bg-transparent"></div>
            </div>

            <a href="#" class="flex items-center gap-2 hover:text-white hover:scale-110 transition-all">
                <i class="fa-solid fa-phone"></i> Contact Us
            </a>
        </div>

        <div class="hidden md:flex items-center gap-4">
            <div class="relative group">
                <input type="text" placeholder="Cari alat, artikel..." class="bg-white/10 text-white text-sm rounded-full pl-10 pr-4 py-2 border border-white/20 focus:outline-none focus:border-[#7C3AED] focus:bg-white/20 focus:w-64 placeholder-gray-400 w-48 transition-all duration-300">
                <i class="fa-solid fa-magnifying-glass absolute left-3.5 top-2.5 text-gray-400 group-hover:text-white transition-colors text-xs"></i>
            </div>
            <a href="login.html" class="px-5 py-2 rounded-lg font-semibold text-sm transition-all duration-300 bg-[#7C3AED] text-white border-2 border-[#7C3AED] hover:bg-[#6D28D9] hover:border-[#6D28D9] shadow-lg hover:scale-105">
                Sign In
            </a>
        </div>
    </div>

    <div id="mobile-menu" class="hidden md:hidden bg-[#1c1c1c] border-t border-white/10 absolute w-full left-0 top-full shadow-lg">
        <div class="flex flex-col px-6 py-4 space-y-4 text-gray-200 font-medium">
            <a href="#" class="flex items-center gap-3 hover:text-purple-400 transition-colors"><i class="fa-solid fa-house w-6 text-center"></i> Home</a>
            <a href="#" class="flex items-center gap-3 hover:text-purple-400 transition-colors"><i class="fa-solid fa-cube w-6 text-center"></i> Inventaris</a>
            
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-3 text-gray-400"><i class="fa-solid fa-circle-info w-6 text-center"></i> Information</div>
                <div class="pl-11 flex flex-col gap-3 text-sm text-gray-300 border-l border-gray-700 ml-3">
                    <a href="#" class="hover:text-purple-400 flex items-center gap-2 transition-colors"><i class="fa-regular fa-newspaper"></i> Berita</a>
                    <a href="#" class="hover:text-purple-400 flex items-center gap-2 transition-colors"><i class="fa-solid fa-person-hiking"></i> Kegiatan</a>
                </div>
            </div>

            <a href="#" class="flex items-center gap-3 hover:text-purple-400 transition-colors"><i class="fa-solid fa-phone w-6 text-center"></i> Contact Us</a>

            <div class="border-t border-white/10 pt-4 flex flex-col gap-3">
                <a href="login.html" class="block w-full text-center py-2 rounded bg-[#7C3AED] text-white font-semibold hover:bg-[#6D28D9] transition-colors">Sign In</a>
                <a href="register.html" class="block w-full text-center py-2 rounded border border-[#7C3AED] text-[#7C3AED] font-semibold bg-white hover:bg-gray-100 transition-colors">Sign Up</a>
            </div>
        </div>
    </div>
</nav>