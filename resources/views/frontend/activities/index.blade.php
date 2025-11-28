@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-7xl mx-auto">

            <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="w-full md:w-3/4">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                        Upcoming Activities Schedule
                    </h1>
                    <p class="text-gray-500 text-sm md:text-base">
                        Tetap terhubung dengan kegiatan petualangan dan pengembangan anggota Tarantula Adventure.
                    </p>
                </div>

                <div class="flex-shrink-0">
                    <a href="#jadwal"
                        class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white font-medium px-6 py-3 rounded-xl transition shadow-md whitespace-nowrap">
                        Lihat Jadwal Kegiatan
                    </a>
                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">

                <div class="w-full lg:w-7/12">

                    <div class="flex justify-between items-center mb-8 px-4 sm:px-12">
                        <button id="prevMonth"
                            class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white rounded-full p-2 transition shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                        </button>
                        <h2 id="monthTitle" class="text-xl font-semibold text-gray-800"></h2>
                        <button id="nextMonth"
                            class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white rounded-full p-2 transition shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    </div>

                    <div id="calendar"
                        class="grid grid-cols-7 text-center text-sm md:text-base border border-gray-200 rounded-2xl overflow-hidden shadow-sm bg-white">
                    </div>
                </div>

                <div class="w-full lg:w-5/12 space-y-6">

                    @for ($i = 0; $i < 3; $i++)
                        <div
                            class="border border-gray-200 rounded-2xl p-4 hover:shadow-lg transition duration-300 bg-white">

                            <div class="flex justify-between items-start mb-4">
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <div
                                        class="inline-flex items-center bg-gray-50 border border-gray-200 rounded-full px-3 py-1.5 shadow-sm text-xs sm:text-sm">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-regular fa-calendar text-gray-500"></i>
                                            <span class="font-medium text-gray-700">07 Nov 2025</span>
                                        </div>
                                        <div class="w-px h-4 bg-gray-300 mx-2"></div>
                                        <div class="flex items-center gap-2">
                                            <span class="font-medium text-gray-700">09 Nov 2025</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex -space-x-2">
                                    <div class="w-8 h-8 rounded-full bg-gray-300 border-2 border-white"></div>
                                    <div class="w-8 h-8 rounded-full bg-gray-400 border-2 border-white"></div>
                                    <div
                                        class="w-8 h-8 rounded-full bg-[#7753AF] text-white text-[10px] flex items-center justify-center border-2 border-white font-bold">
                                        3+</div>
                                </div>
                            </div>

                            <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug">
                                Pelatihan Navigasi Darat (Navrat) Dasar
                            </h3>
                            <p class="text-gray-500 text-sm leading-relaxed mb-4">
                                Mengajarkan kemampuan membaca peta, menggunakan kompas, memahami azimut, serta teknik
                                orientasi di lapangan.
                            </p>
                            <a href="#"
                                class="inline-flex items-center gap-2 text-[#7753AF] font-semibold text-sm hover:underline">
                                View Event Details <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    @endfor

                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendar = document.getElementById("calendar");
            const monthTitle = document.getElementById("monthTitle");
            let date = new Date();

            function renderCalendar() {
                calendar.innerHTML = "";

                const year = date.getFullYear();
                const month = date.getMonth();

                const monthNames = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                monthTitle.textContent = `${monthNames[month]} ${year}`;

                const firstDay = new Date(year, month, 1).getDay(); // 0 = Sun
                const totalDays = new Date(year, month + 1, 0).getDate();
                const prevMonthDays = new Date(year, month, 0).getDate();

                const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                // Render header
                days.forEach(day => {
                    calendar.innerHTML += `
            <div class='py-3 bg-gray-50 text-gray-400 font-semibold text-xs uppercase tracking-wider border'>
                ${day}
            </div>`;
                });

                // Track total cell count (penting agar grid stabil!)
                let cellCount = 0;

                // Render previous month
                for (let i = 0; i < firstDay; i++) {
                    const dayNum = prevMonthDays - firstDay + 1 + i;
                    calendar.innerHTML += `
            <div class='h-20 border bg-gray-50/50 p-2 text-gray-300'>
                ${dayNum}
            </div>`;
                    cellCount++;
                }

                // Render current month
                const today = new Date();
                for (let d = 1; d <= totalDays; d++) {
                    const isToday =
                        d === today.getDate() &&
                        month === today.getMonth() &&
                        year === today.getFullYear();

                    calendar.innerHTML += `
            <div class="h-20 border p-2 ${isToday ? 'bg-purple-50 text-purple-600 font-bold' : 'bg-white text-gray-700'}">
                ${d}
            </div>`;
                    cellCount++;
                }

                // Render next month (agar total cell divisible by 7)
                while (cellCount % 7 !== 0) {
                    calendar.innerHTML += `
            <div class='h-20 border bg-gray-50/50 text-gray-300 p-2'></div>`;
                    cellCount++;
                }
            }

            renderCalendar();

            document.getElementById("prevMonth").addEventListener("click", () => {
                date.setMonth(date.getMonth() - 1);
                renderCalendar();
            });

            document.getElementById("nextMonth").addEventListener("click", () => {
                date.setMonth(date.getMonth() + 1);
                renderCalendar();
            });
        });
    </script>
@endsection
