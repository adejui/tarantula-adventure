@extends('frontend.layouts.app')

@section('content')
    <div class="fixed inset-0 z-[-1] bg-gray-50 opacity-60"
        style="background-image: radial-gradient(#7C3AED 0.5px, transparent 0.5px), radial-gradient(#7C3AED 0.5px, #f9fafb 0.5px); background-size: 20px 20px; background-position: 0 0, 10px 10px;">
    </div>

    <div class="min-h-screen pt-32 pb-20 px-6 md:px-16 relative overflow-hidden">

        <div
            class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-purple-200 rounded-full filter blur-3xl opacity-30 animate-pulse-slow">
        </div>
        <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-96 h-96 bg-blue-100 rounded-full filter blur-3xl opacity-30 animate-pulse-slow"
            style="animation-delay: 2s;"></div>

        <div class="max-w-7xl mx-auto relative z-10">

            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
                    Hubungi Kami
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                    Punya pertanyaan, saran, atau ingin berkolaborasi? Jangan ragu untuk menghubungi kami. Tim kami siap
                    membantu Anda.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 mb-20 items-start">

                <div
                    class="lg:col-span-1 bg-white/80 backdrop-blur-lg rounded-[2.5rem] p-8 shadow-xl shadow-purple-100/50 border border-white hover:shadow-2xl hover:-translate-y-1 transition-all duration-500">
                    <h3 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                        <i class="fa-solid fa-circle-info text-[#7C3AED]"></i> Informasi Kontak
                    </h3>

                    <div class="space-y-8">

                        <div class="flex items-start gap-5 group">
                            <div
                                class="w-14 h-14 shrink-0 flex items-center justify-center bg-purple-50 text-[#7C3AED] rounded-2xl shadow-sm group-hover:bg-[#7C3AED] group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-location-dot text-2xl fa-fw"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Alamat Kampus</h4>
                                <p class="text-gray-600 leading-relaxed text-sm md:text-base">
                                    Universitas Bina Sarana Informatika (UBSI) Kampus Yogyakarta.
                                    <br>Jl. Ringroad Barat, Gamping, Sleman.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-5 group">
                            <div
                                class="w-14 h-14 shrink-0 flex items-center justify-center bg-blue-50 text-blue-600 rounded-2xl shadow-sm group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-phone text-xl fa-fw"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Telepon & WhatsApp</h4>
                                <p class="text-gray-600 font-medium text-sm md:text-base">
                                    +62 812-3456-7890 (WA)
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-5 group">
                            <div
                                class="w-14 h-14 shrink-0 flex items-center justify-center bg-green-50 text-green-600 rounded-2xl shadow-sm group-hover:bg-green-600 group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-envelope text-xl fa-fw"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-1">Email Resmi</h4>
                                <p class="text-gray-600 font-medium text-sm md:text-base break-all">
                                    info@mapala-tarantula.com <br>
                                    kerjasama@mapala-tarantula.com
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-5 group border-t border-gray-100 pt-8 mt-2">
                            <div
                                class="w-14 h-14 shrink-0 flex items-center justify-center bg-orange-50 text-orange-600 rounded-2xl shadow-sm group-hover:bg-orange-600 group-hover:text-white transition-all duration-300">
                                <i class="fa-solid fa-clock text-xl fa-fw"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900 mb-1 flex items-center gap-2">
                                    Jam Operasional

                                    <span
                                        class="inline-flex items-center gap-1.5 bg-green-100 text-green-700 px-2.5 py-0.5 rounded-full text-xs font-extrabold border border-green-200">
                                        <span class="relative flex h-2 w-2">
                                            <span
                                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                                        </span>
                                        OPEN 25/7
                                    </span>
                                </h4>

                                <p class="text-gray-600 text-sm leading-relaxed">
                                    <span class="block mb-1 font-medium">Senin - Minggu (Setiap Hari)</span>
                                    <span class="text-gray-500 text-xs">
                                        Sekretariat selalu terbuka untuk anggota. <br>
                                        <span class="italic text-[#7C3AED]">"Pantang pulang sebelum terang."</span>
                                    </span>
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div
                    class="lg:col-span-2 bg-white/90 backdrop-blur-xl rounded-[2.5rem] p-8 md:p-12 shadow-2xl shadow-purple-100/50 border border-white relative overflow-hidden">

                    <div
                        class="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-purple-100 rounded-full filter blur-2xl opacity-50">
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 mb-8 relative z-10 flex items-center gap-3">
                        <i class="fa-regular fa-paper-plane text-[#7C3AED]"></i> Kirim Pesan Kepada Kami
                    </h3>

                    <form action="#" method="POST" class="space-y-6 relative z-10">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="name" class="text-sm font-bold text-gray-700 tracking-wide">Nama Lengkap
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i
                                            class="fa-regular fa-user"></i></span>
                                    <input type="text" id="name" name="name" placeholder="Masukkan nama Anda"
                                        required
                                        class="w-full py-3.5 pl-11 pr-4 bg-gray-50/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-gray-800 placeholder-gray-400 shadow-sm font-medium">
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="text-sm font-bold text-gray-700 tracking-wide">Alamat Email
                                    <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i
                                            class="fa-regular fa-envelope"></i></span>
                                    <input type="email" id="email" name="email" placeholder="contoh@email.com"
                                        required
                                        class="w-full py-3.5 pl-11 pr-4 bg-gray-50/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-gray-800 placeholder-gray-400 shadow-sm font-medium">
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="subject" class="text-sm font-bold text-gray-700 tracking-wide">Subjek Pesan <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400"><i
                                        class="fa-regular fa-comment-dots"></i></span>
                                <input type="text" id="subject" name="subject" placeholder="Apa tujuan pesan Anda?"
                                    required
                                    class="w-full py-3.5 pl-11 pr-4 bg-gray-50/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-gray-800 placeholder-gray-400 shadow-sm font-medium">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label for="message" class="text-sm font-bold text-gray-700 tracking-wide">Isi Pesan <span
                                    class="text-red-500">*</span></label>
                            <div class="relative">
                                <textarea id="message" name="message" rows="6" placeholder="Tuliskan pesan lengkap Anda di sini..." required
                                    class="w-full py-3.5 px-4 bg-gray-50/50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-gray-800 placeholder-gray-400 shadow-sm resize-none font-medium leading-relaxed"></textarea>
                            </div>
                        </div>

                        <button type="submit"
                            class="group w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#7C3AED] text-white font-bold rounded-xl shadow-lg shadow-purple-200 hover:bg-[#6D28D9] hover:shadow-xl hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                            <span class="relative z-10">Kirim Pesan Sekarang</span>
                            <i
                                class="fa-solid fa-paper-plane relative z-10 group-hover:translate-x-1 transition-transform"></i>
                            <div
                                class="absolute inset-0 h-full w-full scale-0 rounded-xl transition-all duration-300 group-hover:scale-100 group-hover:bg-white/10">
                            </div>
                        </button>
                    </form>
                </div>

            </div>

            <div class="relative rounded-[2.5rem] overflow-hidden shadow-2xl shadow-gray-200/50 border border-white group">
                <div
                    class="absolute top-0 left-0 right-0 bg-gradient-to-b from-white/90 to-transparent p-8 z-10 pointer-events-none">
                    <h3 class="text-2xl font-bold text-gray-900 text-center flex items-center justify-center gap-3">
                        <i class="fa-solid fa-map-location-dot text-[#7C3AED]"></i> Temukan Lokasi Kami
                    </h3>
                </div>

                <iframe src="https://maps.google.com/maps?q=-7.801948,110.326779&z=15&output=embed" width="100%"
                    height="500" style="border:0; filter: grayscale(20%) contrast(1.1);" allowfullscreen=""
                    loading="lazy"
                    class="group-hover:filter-none transition-all duration-700 scale-105 group-hover:scale-100">
                </iframe>

                <div
                    class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-white to-transparent pointer-events-none">
                </div>
            </div>

        </div>
    </div>

    <style>
        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 0.4;
                transform: scale(1.1);
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 6s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
@endsection
