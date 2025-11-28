@extends('frontend.layouts.app')

@section('content')
    <div id="hero-section" class="relative h-[590px] w-full overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('frontend/images/hero-section.jpeg') }}" alt="Background"
                class="w-full h-full object-cover grayscale brightness-50" />
        </div>
        <div class="absolute inset-0 z-0 bg-black/40"></div>
        <main class="absolute inset-0 z-10 flex flex-col justify-center items-center text-center px-4">
            <h3 data-aos="fade-up" class="text-xl md:text-2xl font-semibold mb-2 text-gray-200 drop-shadow-md">Welcome to</h3>
            <h1 data-aos="fade-up" data-aos-delay="200" class="text-5xl md:text-7xl font-bold mb-4 drop-shadow-lg">
                Tarantula <span class="text-tarantulaPurple">Adventure</span>
            </h1>
            <p data-aos="fade-up" data-aos-delay="400" class="text-base md:text-lg text-gray-300 max-w-2xl drop-shadow-md">
                Mahasiswa Pencinta Alam Universitas Bina Sarana Informatika
            </p>
        </main>
    </div>

    <!-- sejarah -->
    <section class="bg-gray-100 py-16 px-6 md:px-20">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-2 items-start">
                <div class="font-bold text-3xl md:text-4xl leading-tight">
                    <h2 class="text-gray-900">Sejarah</h2>
                    <h2 class="text-[#7C3AED] mt-1">Tarantula Adventure</h2>
                </div>

                <div>
                    <p class="text-gray-500 text-base md:text-lg leading-relaxed mb-8 text-justify">
                        Tarantula Adventure berdiri sebagai organisasi Mahasiswa Pecinta
                        Alam di UBSI Yogyakarta yang berawal dari sekelompok mahasiswa
                        yang memiliki minat kuat terhadap kegiatan alam bebas dan
                        pelestarian lingkungan.
                    </p>

                    <a href="#"
                        class="inline-block bg-[#7c56b5] text-white font-medium px-6 py-3 rounded-lg hover:bg-purple-800 transition shadow-md">
                        Tentang kami
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- sejarah end -->

    <!-- jadwal -->
    <section class="py-16 px-6 md:px-20">
        <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="w-full md:w-3/4">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    Jadwal Kegiatan Yang Akan Datang
                </h1>
                <p class="text-gray-500 text-sm md:text-base">
                    Tetap terhubung dengan kegiatan petualangan dan pengembangan anggota
                    Tarantula Adventure.
                </p>
            </div>

            <div class="flex-shrink-0">
                <a href="#jadwal"
                    class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white font-medium px-6 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                    Lihat Semua
                </a>
            </div>
        </div>

        <div class="w-full lg:full space-y-6 py-2">
            <div data-aos="fade-left" data-aos-delay="200"
                class="border border-gray-300 rounded-2xl p-3 hover:shadow-lg transition duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-3">
                        <div
                            class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 shadow-sm">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">07 Nov 2025</span>
                            </div>

                            <div class="w-px h-5 bg-gray-200 mx-4"></div>

                            <div class="flex items-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">09 Nov 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-stone-600 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-rose-900 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white"></div>
                        <div
                            class="w-8 h-8 rounded-full bg-purple-600 text-white text-[10px] flex items-center justify-center border-2 border-white font-bold">
                            3+
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Pelatihan Navigasi Darat (Navrat) Dasar
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Mengajarkan kemampuan membaca peta, menggunakan kompas, memahami
                    azimut, serta teknik orientasi di lapangan.
                </p>
                <a href="#" class="text-[#7753AF] font-semibold text-sm hover:underline">View Event Details</a>
            </div>
        </div>

        <div class="w-full lg:full space-y-6 py-2">
            <div data-aos="fade-right" data-aos-delay="400"
                class="border border-gray-300 rounded-2xl p-3 hover:shadow-lg transition duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-3">
                        <div
                            class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 shadow-sm">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">07 Nov 2025</span>
                            </div>

                            <div class="w-px h-5 bg-gray-200 mx-4"></div>

                            <div class="flex items-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">09 Nov 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-stone-600 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-rose-900 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white"></div>
                        <div
                            class="w-8 h-8 rounded-full bg-purple-600 text-white text-[10px] flex items-center justify-center border-2 border-white font-bold">
                            3+
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Pelatihan Navigasi Darat (Navrat) Dasar
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Mengajarkan kemampuan membaca peta, menggunakan kompas, memahami
                    azimut, serta teknik orientasi di lapangan.
                </p>
                <a href="#" class="text-[#7753AF] font-semibold text-sm hover:underline">View Event Details</a>
            </div>
        </div>

        <div class="w-full lg:full space-y-6 py-2">
            <div data-aos="fade-left" data-aos-delay="600"
                class="border border-gray-300 rounded-2xl p-3 hover:shadow-lg transition duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="flex gap-3">
                        <div
                            class="inline-flex items-center bg-white border border-gray-200 rounded-full px-4 py-2 shadow-sm">
                            <div class="flex items-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">07 Nov 2025</span>
                            </div>

                            <div class="w-px h-5 bg-gray-200 mx-4"></div>

                            <div class="flex items-center gap-2 cursor-pointer">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-sm font-medium text-gray-700">09 Nov 2025</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex -space-x-2">
                        <div class="w-8 h-8 rounded-full bg-stone-600 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-rose-900 border-2 border-white"></div>
                        <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white"></div>
                        <div
                            class="w-8 h-8 rounded-full bg-purple-600 text-white text-[10px] flex items-center justify-center border-2 border-white font-bold">
                            3+
                        </div>
                    </div>
                </div>

                <h3 class="text-lg font-bold text-gray-900 mb-2">
                    Pelatihan Navigasi Darat (Navrat) Dasar
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    Mengajarkan kemampuan membaca peta, menggunakan kompas, memahami
                    azimut, serta teknik orientasi di lapangan.
                </p>
                <a href="#" class="text-[#7753AF] font-semibold text-sm hover:underline">View Event Details</a>
            </div>
        </div>
    </section>
    <!-- jadwal end -->

    <!-- inventarsi -->
    <section class="px-6 md:px-20">
        <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="w-full md:w-3/4">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    Inventaris Peralatan
                </h1>
                <p class="text-gray-500 text-sm md:text-base">
                    Pastikan setiap item siap untuk ekspidisi berikutnya
                </p>
            </div>

            <div class="flex-shrink-0">
                <a href="{{ route('frontend.inventory') }}"
                    class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white font-medium px-6 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                    Lihat Semua
                </a>
            </div>
        </div>

        {{-- card --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-3 md:gap-6">

            @for ($i = 0; $i < 5; $i++)
                <div data-aos="fade-up"
                    class="w-full bg-white border-2 border-gray-200 rounded-3xl flex flex-col hover:shadow-lg transition-shadow duration-300 overflow-hidden group">
                    <div
                        class="relative w-full h-56 bg-gray-100 rounded-2xl flex items-center justify-center overflow-hidden">
                        <span
                            class="absolute top-4 left-4 bg-black/20 backdrop-blur-sm text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide z-10">
                            Kategori
                        </span>
                        <img src="{{ asset('frontend/images/tas2.jpg') }}" alt="Tas Gunung"
                            class="w-full h-full object-contain p-6 mix-blend-multiply">
                    </div>

                    <div class=" p-5 flex justify-between items-end">
                        <div>
                            <h3 class="text-gray-900 font-semibold text-base leading-tight">Mountain <br> Backpack 60L</h3>
                            <p class="text-gray-500 text-sm mt-1">2 Unit</p>
                        </div>
                        <button
                            class="w-12 h-12 bg-[#7753AF] rounded-xl flex items-center justify-center text-white hover:bg-[#5e3d8e] transition shadow-md group">
                            <i
                                class="fa-solid fa-arrow-right -rotate-45 group-hover:-rotate-0 transition-transform duration-300"></i>
                        </button>
                    </div>
                </div>
            @endfor

        </div>
    </section>
    <!-- inventarsi end-->

    <!-- artikel -->
    <section class="py-20 px-6 md:px-20">
        <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div class="w-full md:w-3/4">
                <h1 data-aos="zoom-in-right" class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    Artikel Terbaru
                </h1>
                <p data-aos="zoom-in-left" class="text-gray-500 text-sm md:text-base">
                    Temukan cerita terbaru, tips, dan pengalaman petualangan.
                </p>
            </div>

            <div class="flex-shrink-0">
                <a href="#jadwal"
                    class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white font-medium px-6 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                    Lihat Semua
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- 1 -->
            <div
                class="relative h-[300px] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all duration-300">
                <div
                    class="absolute top-4 left-4 z-20 bg-white text-gray-800 text-xs font-medium px-3 py-1.5 rounded-full flex items-center gap-2 shadow-sm">
                    <i class="fa-regular fa-calendar"></i> <span>07 Nov 2025</span>
                </div>
                <img src="{{ asset('frontend/images/artikel-1.jpeg') }}"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div
                    class="absolute bottom-0 left-0 w-full h-[40%] z-10 flex flex-col justify-end p-6 bg-gradient-to-t from-black/90 via-black/60 to-transparent backdrop-blur-md">
                    <h3 class="text-white text-xl font-bold leading-tight mb-3 drop-shadow-md">
                        Ekspedisi Pendakian <br> Gunung Merapi 2025
                    </h3>
                    <a href="#"
                        class="inline-flex items-center text-white text-sm font-semibold hover:text-purple-300 transition-colors group/btn">
                        Read More
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs transform transition-transform group-hover/btn:translate-x-1"></i>
                    </a>
                </div>
            </div>

            <!-- 2 -->
            <div
                class="relative h-[300px] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all duration-300">
                <div
                    class="absolute top-4 left-4 z-20 bg-white text-gray-800 text-xs font-medium px-3 py-1.5 rounded-full flex items-center gap-2 shadow-sm">
                    <i class="fa-regular fa-calendar"></i> <span>12 Des 2025</span>
                </div>
                <img src="{{ asset('frontend/images/artikel-2.jpeg') }}" alt="Artikel 2"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div
                    class="absolute bottom-0 left-0 w-full h-[40%] z-10 flex flex-col justify-end p-6 bg-gradient-to-t from-black/90 via-black/60 to-transparent backdrop-blur-md">
                    <h3 class="text-white text-xl font-bold leading-tight mb-3 drop-shadow-md">
                        Pelatihan Navigasi Darat & Survival Hutan
                    </h3>
                    <a href="#"
                        class="inline-flex items-center text-white text-sm font-semibold hover:text-purple-300 transition-colors group/btn">
                        Read More
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs transform transition-transform group-hover/btn:translate-x-1"></i>
                    </a>
                </div>
            </div>

            <!-- 3 -->
            <div
                class="relative h-[300px] rounded-2xl overflow-hidden group cursor-pointer shadow-md hover:shadow-xl transition-all duration-300">
                <div
                    class="absolute top-4 left-4 z-20 bg-white text-gray-800 text-xs font-medium px-3 py-1.5 rounded-full flex items-center gap-2 shadow-sm">
                    <i class="fa-regular fa-calendar"></i> <span>01 Jan 2026</span>
                </div>
                <img src="{{ asset('frontend/images/artikel-3.jpeg') }}" alt="Artikel 3"
                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div
                    class="absolute bottom-0 left-0 w-full h-[40%] z-10 flex flex-col justify-end p-6 bg-gradient-to-t from-black/90 via-black/60 to-transparent backdrop-blur-md">
                    <h3 class="text-white text-xl font-bold leading-tight mb-3 drop-shadow-md">
                        Tips Memilih Peralatan Camping Pemula
                    </h3>
                    <a href="#"
                        class="inline-flex items-center text-white text-sm font-semibold hover:text-purple-300 transition-colors group/btn">
                        Read More
                        <i
                            class="fa-solid fa-arrow-right ml-2 text-xs transform transition-transform group-hover/btn:translate-x-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- artikel end-->
@endsection
