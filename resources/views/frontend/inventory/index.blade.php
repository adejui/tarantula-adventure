@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-screen-2xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Inventaris Peralatan</h1>
                    <p class="text-gray-500 mt-1">Mahasiswa Pencinta Alam Universitas Bina Sarana Informatika</p>
                </div>
                <nav class="flex text-sm font-medium text-gray-500">
                    <a href="{{ route('frontend.home') }}" class="hover:text-[#7C3AED] transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#7C3AED]">Inventaris</span>
                </nav>
            </div>

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-10">

                <div class="relative w-full lg:w-1/3">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" placeholder="Cari barang..."
                        class="w-full py-3 pl-11 pr-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm placeholder-gray-400 shadow-sm">
                </div>

                <div class="grid grid-cols-2 gap-3 w-full lg:w-auto lg:flex lg:items-center">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-3">
                        <span class="text-xs sm:text-sm font-semibold text-gray-700">Kategori</span>
                        <select
                            class="w-full sm:w-auto py-2.5 px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-[#7C3AED] cursor-pointer shadow-sm">
                            <option>Semua</option>
                            <option>Tenda</option>
                            <option>Tas</option>
                            <option>Alat Masak</option>
                        </select>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-3">
                        <span class="text-xs sm:text-sm font-semibold text-gray-700">Urutkan</span>
                        <select
                            class="w-full sm:w-auto py-2.5 px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-[#7C3AED] cursor-pointer shadow-sm">
                            <option>Terbaru</option>
                            <option>Terlama</option>
                            <option>A-Z</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-12">

                @for ($i = 0; $i < 10; $i++)
                    <div class="w-full bg-white border-2 border-gray-200 rounded-3xl flex flex-col hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group h-full">

                        <div
                            class="relative w-full h-56 bg-gray-100 rounded-2xl flex items-center justify-center overflow-hidden">
                            <span
                                class="absolute top-4 left-4 bg-black/20 backdrop-blur-sm text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide z-10">
                                Kategori
                            </span>

                            <img src="{{ asset('frontend/images/tas2.jpg') }}" alt="Tas Gunung"
                                class="w-full h-full object-contain p-6 mix-blend-multiply transition-transform duration-500 group-hover:scale-110">
                        </div>

                        <div class="p-5 flex justify-between items-end flex-grow">
                            <div>
                                <h3 class="text-gray-900 font-semibold text-base leading-tight">Mountain <br> Backpack 60L
                                </h3>
                                <p class="text-gray-500 text-sm mt-1">2 Unit</p>
                            </div>

                            <button
                                class="w-12 h-12 bg-[#7753AF] rounded-xl flex items-center justify-center text-white hover:bg-[#5e3d8e] hover:scale-110 transition-all duration-300 shadow-md group">
                                <i
                                    class="fa-solid fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform duration-300"></i>
                            </button>
                        </div>
                    </div>
                @endfor

            </div>

            <div class="flex flex-col md:flex-row justify-between items-center border-t border-gray-100 pt-8 gap-4">

                <p class="text-sm text-gray-500">
                    Menampilkan halaman <span class="font-bold text-gray-900">1</span>
                </p>

                <div class="flex items-center gap-2">
                    <button
                        class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:border-[#7C3AED] hover:text-[#7C3AED] transition disabled:opacity-50">
                        <i class="fa-solid fa-chevron-left text-xs"></i>
                    </button>

                    <button
                        class="w-9 h-9 flex items-center justify-center rounded-lg bg-[#7C3AED] text-white font-semibold shadow-md shadow-purple-200">
                        1
                    </button>

                    <button
                        class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:border-[#7C3AED] hover:text-[#7C3AED] transition">
                        2
                    </button>
                    <button
                        class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-600 hover:border-[#7C3AED] hover:text-[#7C3AED] transition">
                        3
                    </button>

                    <button
                        class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:border-[#7C3AED] hover:text-[#7C3AED] transition">
                        <i class="fa-solid fa-chevron-right text-xs"></i>
                    </button>
                </div>

            </div>

        </div>
    </div>
@endsection
