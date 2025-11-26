<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tarantula Adventure</title>

    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        tarantulaPurple: '#7C3AED', // Warna ungu tarantula
                    }
                }
            }
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet" />
</head>
<body class="text-white m-0 p-0 overflow-x-hidden antialiased">

    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init AOS
        AOS.init({ once: true, duration: 800 });

        // Logic Navbar & Mobile Menu
        const navbar = document.getElementById("navbar");
        const btn = document.getElementById("mobile-menu-btn");
        const menu = document.getElementById("mobile-menu");

        // Toggle Mobile Menu
        if(btn && menu) {
            btn.addEventListener("click", () => {
                menu.classList.toggle("hidden");
            });
        }

        // Scroll Logic
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                navbar.classList.add("bg-[#1c1c1c]", "shadow-lg", "py-3");
                navbar.classList.remove("bg-transparent", "py-6", "border-white/10");
            } else {
                navbar.classList.add("bg-transparent", "py-6");
                navbar.classList.remove("bg-[#1c1c1c]", "shadow-lg", "py-3");
            }
        });
    </script>
</body>
</html>