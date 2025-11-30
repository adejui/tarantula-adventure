@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-end mb-10 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Alat</h1>
                    <p class="text-gray-500 mt-1">Informasi lengkap mengenai spesifikasi dan kondisi alat.</p>
                </div>
                <nav class="flex text-sm font-medium text-gray-500">
                    <a href="{{ route('frontend.home') }}" class="hover:text-[#7C3AED] transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('frontend.inventory') }}" class="hover:text-[#7C3AED] transition-colors">Alat</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#7C3AED]">Detail Alat</span>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">

                <div class="space-y-4">
                    <div
                        class="w-full aspect-[4/3] bg-gray-100 rounded-3xl overflow-hidden flex items-center justify-center border border-gray-200">
                        <img src="{{ asset('frontend/images/tas2.jpg') }}" alt="Main Image"
                            class="w-3/4 h-3/4 object-contain mix-blend-multiply hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        @for ($i = 0; $i < 4; $i++)
                            <div
                                class="aspect-square bg-gray-100 rounded-2xl cursor-pointer hover:border-2 hover:border-[#7C3AED] border-2 border-transparent transition-all overflow-hidden flex items-center justify-center">
                                <img src="{{ asset('frontend/images/tas.jpg') }}"
                                    class="w-2/3 h-2/3 object-contain mix-blend-multiply opacity-70 hover:opacity-100">
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="flex flex-col justify-center">

                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Mountain Backpack 60L</h2>

                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">Deskripsi</h3>
                        <p class="text-gray-500 leading-relaxed text-justify">
                            Mountain Backpack 60L adalah ransel gunung berkapasitas besar yang dirancang untuk perjalanan
                            jauh dan pendakian multi-hari. Dilengkapi banyak kompartemen, bahan tahan cuaca, serta bantalan
                            punggung yang ergonomis, tas ini memberikan kenyamanan dan daya tampung maksimal untuk membawa
                            perlengkapan outdoor secara aman dan terorganisir.
                        </p>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">Kategori</h3>
                        <span class="inline-block bg-gray-100 text-gray-600 px-4 py-1.5 rounded-full text-sm font-medium">
                            Tas Gunung / Carrier
                        </span>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">Stock</h3>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center border border-gray-300 rounded-xl px-2 py-1">
                                <button
                                    class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-[#7C3AED] transition text-lg font-bold">-</button>
                                <input type="text" value="1"
                                    class="w-8 text-center text-gray-900 font-bold focus:outline-none border-none p-0"
                                    readonly>
                                <button
                                    class="w-8 h-8 flex items-center justify-center text-gray-500 hover:text-[#7C3AED] transition text-lg font-bold">+</button>
                            </div>
                            <span class="text-sm text-green-600 font-medium flex items-center gap-1">
                                <i class="fa-solid fa-check-circle"></i> Tersedia 2 Unit
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 mt-auto">

                        <button
                            class="flex-1 py-3.5 px-6 rounded-xl border-2 border-[#7C3AED] text-[#7C3AED] font-bold hover:bg-purple-50 transition-all active:scale-95">
                            Masukan Keranjang
                        </button>

                        <a href="{{ route('frontend.pinjaman') }}"
                            class="flex-1 py-3.5 px-6 rounded-xl bg-[#7753AF] text-white font-bold text-center hover:bg-[#5e3d8e] shadow-lg shadow-purple-200 transition-all active:scale-95">
                            Pinjam Sekarang
                        </a>

                    </div>

                </div>
            </div>

            <div class="border-t border-gray-100 pt-16">

                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Inventaris Peralatan</h2>
                        <p class="text-gray-500 text-sm mt-1">Pastikan setiap item siap untuk ekspedisi Anda berikutnya.</p>
                    </div>
                    <a href="{{ route('frontend.inventory') }}"
                        class="hidden md:inline-block bg-[#7753AF] text-white px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#5e3d8e] transition">
                        Lihat Semua
                    </a>
                </div>

                {{-- card --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-12">
                    @for ($i = 0; $i < 5; $i++)
                        <div
                            class="w-full bg-white border-2 border-gray-200 rounded-3xl flex flex-col hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group h-full">

                            <div class="relative w-full h-56 bg-gray-100 flex items-center justify-center overflow-hidden">

                                <span
                                    class="absolute top-4 left-4 bg-black/20 backdrop-blur-sm text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide z-10">
                                    Kategori
                                </span>

                                <img src="{{ asset('frontend/images/tas.jpg') }}" alt="tas jpg"
                                    class="w-full h-full object-contain p-6 mix-blend-multiply transition-transform duration-500 group-hover:scale-110">
                            </div>

                            <div class="p-5 flex justify-between items-end flex-grow border-t border-gray-100">
                                <div>
                                    <h3 class="text-gray-900 font-semibold text-base leading-tight mb-1 line-clamp-2">
                                        Cerrier 60L
                                    </h3>
                                    <p class="text-gray-500 text-sm font-medium">
                                        2 Unit
                                    </p>
                                </div>

                                <div class="flex items-center gap-2">

                                    <button
                                        class="w-10 h-10 rounded-xl border-2 border-[#7C3AED] text-[#7C3AED] flex items-center justify-center hover:bg-[#7C3AED] hover:text-white transition-all duration-300 shadow-sm group/cart"
                                        title="Tambah ke Keranjang">
                                        <i
                                            class="fa-solid fa-plus text-sm group-hover/cart:rotate-90 transition-transform duration-300"></i>
                                    </button>

                                    <button
                                        class="w-10 h-10 bg-[#7753AF] rounded-xl flex items-center justify-center text-white hover:bg-[#5e3d8e] hover:scale-110 transition-all duration-300 shadow-md group/btn"
                                        title="Lihat Detail">
                                        <i
                                            class="fa-solid fa-arrow-right -rotate-45 group-hover/btn:rotate-0 transition-transform duration-300"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endfor
                    {{-- <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                      <div
                          class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400 text-3xl">
                          <i class="fa-solid fa-box-open"></i>
                      </div>
                      <h3 class="text-lg font-semibold text-gray-900">Belum ada barang</h3>
                      <p class="text-gray-500 text-sm">Inventaris saat ini masih kosong.</p>
                  </div> --}}

                </div>
            </div>


        </div>
    </div>
@endsection
