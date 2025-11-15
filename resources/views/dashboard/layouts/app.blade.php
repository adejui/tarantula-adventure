<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        MAPALA UBSI
    </title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* === Z-INDEX untuk overlay dan panel detail === */
        .hs-overlay,
        [x-show="showDetail"] {
            z-index: 999999 !important;
        }

        body.hs-overlay-open {
            overflow: hidden;
        }

        /* Overlay gelap biar nutupi semua elemen lain */
        .fixed.inset-0.bg-black\/50 {
            z-index: 999998 !important;
        }

        /* Sembunyikan scrollbar tapi tetap bisa scroll */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            /* untuk Internet Explorer dan Edge lama */
            scrollbar-width: none;
            /* untuk Firefox */
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }" x-init="darkMode = JSON.parse(localStorage.getItem('darkMode'));
$watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))" :class="{ 'dark bg-gray-900': darkMode === true }">

    @include('components.preloader')

    <div class="flex h-screen overflow-hidden">

        @include('components.sidebar')

        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 dark:bg-gray-900">

            @include('components.overlay')

            @include('components.header')

            <main>
                <div class="p-2 max-w-(--breakpoint-2xl) md:p-2 lg:m-2">

                    @yield('content')

                </div>
            </main>
        </div>
    </div>

</body>

</html>
