@extends('dashboard.layouts.app')

@section('content')
    <div
        class="bg-[#9C87CA] border border-[#E0E0E0] rounded-xl mb-5 mt-6 p-6 overflow-hidden dark:border-gray-800 dark:bg-white/3">
        <h3 class="text-white font-semibold text-3xl">
            Welcome Back,
            {{ auth()->user()->role === 'admin' ? 'Admin' : 'Logistik' }}!
        </h3>

        <p class="text-white mt-4 w-full lg:w-5/7 text-md font-light">
            Di halaman {{ auth()->user()->role === 'admin' ? 'Admin' : 'Logistik' }} ini, Anda dapat melihat dan mengatur
            @if (auth()->user()->role === 'admin')
                anggota, kegiatan, artikel, inventaris, dan peminjaman.
            @else
                inventaris dan peminjaman.
            @endif
        </p>

    </div>

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">

        <div class="flex justify-between items-center my-2">

            <div class="grid md:grid-cols-2 lg:grid-cols-4 w-full gap-4">
                @if (auth()->user()->role === 'admin')
                    <div class="bg-white border border-[#E0E0E0] rounded-xl p-3 dark:border-gray-800 dark:bg-white/3">
                        <div class="flex gap-3 items-center">
                            <div class="bg-[#FFF7E6] w-fit p-3 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                    fill="none" stroke="#F59E0B" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M18 21a8 8 0 0 0-16 0" />
                                    <circle cx="10" cy="8" r="5" />
                                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                                </svg>
                            </div>
                            <h2 class="font-semibold text-3xl dark:text-white/90">{{ $user }}</h2>
                        </div>

                        <div class="flex justify-between items-center mt-5">
                            <h3 class="text-gray-800 text-md font-semibold dark:text-gray-400">Anggota</h3>

                            <a href="{{ route('users.index') }}"
                                class="bg-black p-3.5 rounded-xl flex justify-center items-center hover:bg-gray-700 duration-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M7 7h10v10" />
                                    <path d="M7 17 17 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="bg-white border border-[#E0E0E0] rounded-xl p-3 dark:border-gray-800 dark:bg-white/3">
                    <div class="flex gap-3 items-center">
                        <div class="bg-[#E8F9F0] w-fit p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                fill="none" stroke="#22c55e" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-package-icon lucide-package">
                                <path
                                    d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z" />
                                <path d="M12 22V12" />
                                <polyline points="3.29 7 12 12 20.71 7" />
                                <path d="m7.5 4.27 9 5.15" />
                            </svg>
                        </div>
                        <h2 class="font-semibold text-3xl dark:text-white/90">{{ $item }}</h2>
                    </div>

                    <div class="flex justify-between items-center mt-5">
                        <h3 class="text-gray-800 text-md font-semibold dark:text-gray-400">Alat</h3>

                        <a href="{{ route('items.index') }}"
                            class="bg-black p-3.5 rounded-xl flex justify-center items-center hover:bg-gray-700 duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M7 7h10v10" />
                                <path d="M7 17 17 7" />
                            </svg>
                        </a>

                    </div>
                </div>

                @if (auth()->user()->role === 'logistics')
                    <div class="bg-white border border-[#E0E0E0] rounded-xl p-3 dark:border-gray-800 dark:bg-white/3">
                        <div class="flex gap-3 items-center">
                            <div class="bg-[#EEF1FF] w-fit p-3 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                    fill="none" stroke="#6366F1" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="lucide lucide-tags-icon lucide-tags">
                                    <path
                                        d="M13.172 2a2 2 0 0 1 1.414.586l6.71 6.71a2.4 2.4 0 0 1 0 3.408l-4.592 4.592a2.4 2.4 0 0 1-3.408 0l-6.71-6.71A2 2 0 0 1 6 9.172V3a1 1 0 0 1 1-1z" />
                                    <path d="M2 7v6.172a2 2 0 0 0 .586 1.414l6.71 6.71a2.4 2.4 0 0 0 3.191.193" />
                                    <circle cx="10.5" cy="6.5" r=".5" fill="currentColor" />
                                </svg>
                            </div>
                            <h2 class="font-semibold text-3xl dark:text-white/90">{{ $category }}</h2>
                        </div>

                        <div class="flex justify-between items-center mt-5">
                            <h3 class="text-gray-800 text-md font-semibold dark:text-gray-400">Kategori</h3>

                            <a href="{{ route('categories.index') }}"
                                class="bg-black p-3.5 rounded-xl flex justify-center items-center hover:bg-gray-700 duration-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                    fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M7 7h10v10" />
                                    <path d="M7 17 17 7" />
                                </svg>
                            </a>

                        </div>
                    </div>
                @endif

                <div class="bg-white border border-[#E0E0E0] rounded-xl p-3 dark:border-gray-800 dark:bg-white/3">
                    <div class="flex gap-3 items-center">
                        <div class="bg-[#EBF3FF] w-fit p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                                fill="none" stroke="#3B82F6" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-notepad-text-icon lucide-notepad-text">
                                <path d="M8 2v4" />
                                <path d="M12 2v4" />
                                <path d="M16 2v4" />
                                <rect width="16" height="18" x="4" y="4" rx="2" />
                                <path d="M8 10h6" />
                                <path d="M8 14h8" />
                                <path d="M8 18h5" />
                            </svg>
                        </div>
                        <h2 class="font-semibold text-3xl dark:text-white/90">{{ $loan }}</h2>
                    </div>

                    <div class="flex justify-between items-center mt-5">
                        <h3 class="text-gray-800 text-md font-semibold dark:text-gray-400">Peminjaman</h3>

                        <a href="{{ route('loans.index') }}"
                            class="bg-black p-3.5 rounded-xl flex justify-center items-center hover:bg-gray-700 duration-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M7 7h10v10" />
                                <path d="M7 17 17 7" />
                            </svg>
                        </a>

                    </div>
                </div>

                @if (auth()->user()->role === 'admin')
                    <div class="bg-white border border-[#E0E0E0] rounded-xl p-3 dark:border-gray-800 dark:bg-white/3">
                        <div class="flex gap-3 items-center">
                            <div class="bg-[#F3EFFF] w-fit p-3 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                    viewBox="0 0 24 24" fill="none" stroke="#8460ba" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-days-icon lucide-calendar-days">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                    <path d="M8 14h.01" />
                                    <path d="M12 14h.01" />
                                    <path d="M16 14h.01" />
                                    <path d="M8 18h.01" />
                                    <path d="M12 18h.01" />
                                    <path d="M16 18h.01" />
                                </svg>
                            </div>
                            <h2 class="font-semibold text-3xl dark:text-white/90">{{ $activity }}</h2>
                        </div>

                        <div class="flex justify-between items-center mt-5">
                            <h3 class="text-gray-800 text-md font-semibold dark:text-gray-400">Kegiatan</h3>

                            <a href="{{ route('activities.index') }}"
                                class="bg-black p-3.5 rounded-xl flex justify-center items-center hover:bg-gray-700 duration-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 7h10v10" />
                                    <path d="M7 17 17 7" />
                                </svg>
                            </a>

                        </div>
                    </div>
                @endif

                @if (auth()->user()->role === 'logistics')
                    <div class="bg-white border border-[#E0E0E0] rounded-xl p-3 dark:border-gray-800 dark:bg-white/3">
                        <div class="flex gap-3 items-center">
                            <div class="bg-[#E8F9F9] w-fit p-3 rounded-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                    viewBox="0 0 24 24" fill="none" stroke="#14B8A6" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-users-round-icon lucide-users-round">
                                    <path d="M18 21a8 8 0 0 0-16 0" />
                                    <circle cx="10" cy="8" r="5" />
                                    <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                                </svg>
                            </div>
                            <h2 class="font-semibold text-3xl dark:text-white/90">{{ $opa }}</h2>
                        </div>

                        <div class="flex justify-between items-center mt-5">
                            <h3 class="text-gray-800 text-md font-semibold dark:text-gray-400">Data Peminjam</h3>

                            <a href="{{ route('opas.index') }}"
                                class="bg-black p-3.5 rounded-xl flex justify-center items-center hover:bg-gray-700 duration-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M7 7h10v10" />
                                    <path d="M7 17 17 7" />
                                </svg>
                            </a>

                        </div>
                    </div>
                @endif


            </div>


        </div>
    </div>
@endsection
