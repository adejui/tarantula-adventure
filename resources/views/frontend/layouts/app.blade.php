<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="{{ asset('frontend/images/logo.jpeg') }}" type="image/x-icon">
    <title>Tarantula Adventure</title>

    @vite(['resources/css/frontend.css', 'resources/js/app.js'])


    <link href="{{ asset('frontend/css/aos.css') }}" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
</head>

<body x-data="{ loginOpen: {{ $errors->any() ? 'true' : 'false' }} }" @open-login-modal.window="loginOpen = true" class="text-white m-0 p-0 overflow-x-hidden antialiased">
    <div id="preloader"
        class="fixed inset-0 z-[9999] bg-gray-900 flex items-center justify-center transition-opacity duration-500">
        <div class="flex flex-col items-center gap-4">

            <div class="relative flex justify-center items-center w-24 h-24">

                <div
                    class="absolute inset-0 w-full h-full border-[5px] border-gray-800 border-t-[#7C3AED] rounded-full animate-spin">
                </div>

                <div
                    class="w-16 h-16 rounded-full bg-white flex items-center justify-center overflow-hidden p-0.5 animate-pulse">
                    <img src="{{ asset('frontend/images/logo.jpeg') }}" alt="Loading..."
                        class="w-full h-full rounded-full object-cover">
                </div>
            </div>

            <span class="text-gray-400 text-sm font-medium tracking-wider animate-pulse">Loading Adventure...</span>
        </div>
    </div>

    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    @include('frontend.partials.login')

    <script src="{{ asset('frontend/js/aos.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        /* --- INIT AOS & PRELOADER --- */
        AOS.init({
            once: true,
            duration: 800
        });

        const preloader = document.getElementById('preloader');
        if (preloader) {
            window.addEventListener('load', () => {
                preloader.classList.add('opacity-0');
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            });
        }

        /* =========================================
           LOGIC NAVBAR & MOBILE MENU
        ========================================= */
        const navbar = document.getElementById("navbar");
        const btn = document.getElementById("mobile-menu-btn");
        const menu = document.getElementById("mobile-menu");
        const icon = btn ? btn.querySelector("i") : null;

        // 1. INI VARIABEL BARU (Wajib ada biar JS tau ini halaman apa)
        const isHomePage = {{ Request::routeIs('frontend.home') ? 'true' : 'false' }}; 

        function updateNavbar() {

            // 2. INI LOGIKA PENGAMAN BARU (Kalau bukan Home, Paksa Hitam & Stop)
            if (!isHomePage) {
                navbar.classList.add("bg-[#1c1c1c]", "shadow-lg", "py-3");
                navbar.classList.remove("bg-transparent", "py-4", "border-white/10");
                if (btn) btn.classList.add("text-white");
                return; 
            }
            // ---------------------------------------------------------

            
            const isScrolled = window.scrollY > 50;
            const isMenuOpen = menu && !menu.classList.contains("hidden");

            if (isScrolled || isMenuOpen) {
                navbar.classList.add("bg-[#1c1c1c]", "shadow-lg", "py-3");
                navbar.classList.remove("bg-transparent", "py-4", "border-white/10");
            } else {
                navbar.classList.add("bg-transparent", "py-4", "border-white/10");
                navbar.classList.remove("bg-[#1c1c1c]", "shadow-lg", "py-3");
            }

            if (btn) btn.classList.add("text-white");
        }

        // --- EKSEKUSI ---

        updateNavbar();
        window.addEventListener("scroll", updateNavbar);
        window.addEventListener("load", updateNavbar);

        if (btn && menu && icon) {
            btn.addEventListener("click", () => {
                menu.classList.toggle("hidden");

                if (menu.classList.contains("hidden")) {
                    icon.classList.remove("fa-xmark");
                    icon.classList.add("fa-bars");
                } else {
                    icon.classList.remove("fa-bars");
                    icon.classList.add("fa-xmark");
                }

                updateNavbar();
            });
        }
    </script>
</body>

</html>
