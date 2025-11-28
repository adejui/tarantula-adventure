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

                @forelse ($items as $item)
                    <div
                        class="w-full bg-white border-2 border-gray-200 rounded-3xl flex flex-col hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group h-full">

                        <div class="relative w-full h-56 bg-gray-100 flex items-center justify-center overflow-hidden">

                            <span
                                class="absolute top-4 left-4 bg-black/20 backdrop-blur-sm text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide z-10">
                                {{ $item->category->name ?? 'Umum' }}
                            </span>

                            <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('frontend/images/tas.jpg') }}"
                                alt="{{ $item->name }}"
                                class="w-full h-full object-contain p-6 mix-blend-multiply transition-transform duration-500 group-hover:scale-110">
                        </div>

                        <div class="p-5 flex justify-between items-end flex-grow border-t border-gray-100">
                            <div>
                                <h3 class="text-gray-900 font-semibold text-base leading-tight mb-1 line-clamp-2">
                                    {{ $item->name }}
                                </h3>
                                <p class="text-gray-500 text-sm font-medium">
                                    {{ $item->quantity ?? ($item->stock ?? 0) }} Unit
                                </p>
                            </div>

                            <button
                                class="w-12 h-12 bg-[#7753AF] rounded-xl flex items-center justify-center text-white hover:bg-[#5e3d8e] hover:scale-110 transition-all duration-300 shadow-md flex-shrink-0 group/btn">
                                <i
                                    class="fa-solid fa-arrow-right -rotate-45 group-hover/btn:rotate-0 transition-transform duration-300"></i>
                            </button>
                        </div>
                    </div>

                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                        <div
                            class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400 text-3xl">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Belum ada barang</h3>
                        <p class="text-gray-500 text-sm">Inventaris saat ini masih kosong.</p>
                    </div>
                @endforelse

            </div>

            <div class="mt-12">
                {{ $items->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div>
@endsection
