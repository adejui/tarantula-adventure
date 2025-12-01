@extends('frontend.layouts.app')

@section('content')
    <div class="min-h-screen bg-white flex items-stretch">

        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden bg-gray-100">

            <img src="{{ asset('frontend/images/artikel-1.jpeg') }}"
                alt="Adventure Success"
                class="absolute inset-0 w-full h-full object-cover object-center scale-105 hover:scale-100 transition-transform duration-[2000ms]">

            <div class="absolute inset-0 bg-gradient-to-t from-[#7C3AED]/40 to-black/20 mix-blend-multiply"></div>

            <div class="absolute bottom-0 left-0 p-16 text-white z-20">
                <h2 class="text-4xl font-bold leading-tight mb-2">Salam Lestari!</h2>
                <p class="text-lg opacity-90">Persiapkan perlengkapan Anda, gunung menanti.</p>
            </div>
        </div>
        <div class="w-full lg:w-1/2 flex items-center justify-center px-6 py-20 lg:py-0 z-10 bg-white">
            <div class="max-w-md w-full text-center">

                <div
                    class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-8 animate-bounce-slow">
                    <i class="fa-solid fa-check text-4xl text-green-600"></i>
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Pengajuan Berhasil!
                </h1>

                <p class="text-gray-500 mb-10 leading-relaxed text-base md:text-lg">
                    Siap untuk berpetualang? Data peminjaman Anda telah kami terima. Tim logistik akan segera memverifikasi
                    pengajuan Anda.
                    <br>
                    <span class="text-sm text-[#7C3AED] font-medium mt-3 block">Cek Email Anda secara
                        berkala.</span>
                </p>

                <div class="space-y-4">
                    <a href="{{ route('frontend.inventory') }}"
                        class="group block w-full py-4 px-6 rounded-xl bg-[#7C3AED] text-white font-bold text-lg shadow-lg shadow-purple-200 hover:bg-[#6D28D9] hover:shadow-xl transition-all transform hover:-translate-y-1">
                        <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                        Pinjam Barang Lain
                    </a>

                    <a href="{{ route('frontend.home') }}"
                        class="block w-full py-4 px-6 rounded-xl border-2 border-gray-200 text-gray-700 font-bold text-lg hover:bg-gray-50 hover:border-[#7C3AED] hover:text-[#7C3AED] transition-all">
                        Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(-5%);
            }

            50% {
                transform: translateY(5%);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 2s infinite;
        }
    </style>
@endsection
