@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-7xl mx-auto">

            <div class="mb-10 flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6">

                <div class="w-full lg:w-1/2">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3 leading-tight">
                        Jadwal & Agenda
                    </h1>
                    <p class="text-gray-500 text-base leading-relaxed">
                        Pantau terus kegiatan seru Tarantula Adventure atau login untuk melihat jadwal rapat internal.
                    </p>
                </div>

                <div class="flex flex-col items-start lg:items-end gap-3">

                    <nav class="flex text-sm font-medium text-gray-500">
                        <a href="{{ route('frontend.home') }}" class="hover:text-[#7C3AED] transition-colors">Home</a>
                        <span class="mx-2">/</span>
                        <span class="text-[#7C3AED]">Kegiatan</span>
                    </nav>

                    <div class="flex items-center gap-3 bg-gray-100 p-1.5 rounded-2xl">
                        <a href="{{ route('frontend.kegiatan') }}"
                            class="px-6 py-3 rounded-xl text-sm font-bold shadow-sm transition-all duration-300
                {{ request('type') != 'meeting' ? 'bg-[#7753AF] text-white' : 'text-gray-500 hover:text-[#7753AF]' }}">
                            Jadwal Kegiatan
                        </a>

                        <button onclick="accessRapat()"
                            class="px-6 py-3 rounded-xl text-sm font-bold transition-all duration-300
                {{ request('type') == 'meeting' ? 'bg-[#7753AF] text-white shadow-sm' : 'text-gray-500 hover:text-[#7753AF] hover:bg-white' }}">
                            Jadwal Rapat <i class="fa-solid fa-lock ml-1 text-xs opacity-70"></i>
                        </button>
                    </div>

                </div>
            </div>

            <div class="flex flex-col lg:flex-row gap-8 items-start">

                <div class="w-full lg:w-7/12">
                    <div class="flex justify-between items-center mb-6 px-2">
                        <button id="prevMonth"
                            class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white rounded-full w-10 h-10 flex items-center justify-center transition shadow-md">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                        <h2 id="monthTitle" class="text-xl font-bold text-gray-800"></h2>
                        <button id="nextMonth"
                            class="bg-[#7753AF] hover:bg-[#5e3d8e] text-white rounded-full w-10 h-10 flex items-center justify-center transition shadow-md">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>

                    <div id="kalender"
                        class="grid grid-cols-7 text-sm border border-gray-200 rounded-2xl overflow-hidden shadow-sm bg-white">
                    </div>
                </div>

                <div class="w-full lg:w-5/12 space-y-6">

                    @forelse ($upcomingActivities as $activity)
                        <div
                            class="group bg-white border border-gray-100 rounded-3xl p-6 hover:shadow-xl hover:shadow-purple-100/50 hover:border-purple-100 transition-all duration-300 relative overflow-hidden">

                            <div class="flex justify-between items-start mb-4">
                                <div
                                    class="inline-flex items-center gap-3 bg-gray-50 border border-gray-100 rounded-full px-4 py-2">
                                    <i class="fa-regular fa-calendar text-[#7753AF]"></i>
                                    <div class="flex items-center gap-2 text-xs md:text-sm font-semibold text-gray-700">
                                        <span>{{ \Carbon\Carbon::parse($activity->start_date)->format('d M') }}</span>
                                        <i class="fa-solid fa-arrow-right text-gray-300 text-[10px]"></i>
                                        <span>{{ \Carbon\Carbon::parse($activity->end_date ?? $activity->start_date)->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <div class="flex -space-x-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($activity->title) }}&background=random&color=fff"
                                        class="w-8 h-8 rounded-full border-2 border-white">
                                    <div
                                        class="w-8 h-8 rounded-full bg-[#7753AF] text-white text-[10px] flex items-center justify-center border-2 border-white font-bold">
                                        ...</div>
                                </div>
                            </div>

                            <div>
                                <h3
                                    class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#7C3AED] transition-colors leading-snug">
                                    {{ $activity->title }}
                                </h3>
                                <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2">
                                    {{ $activity->description ?? 'Tidak ada deskripsi untuk kegiatan ini.' }}
                                </p>

                                <span class="inline-flex items-center gap-2 text-[#7C3AED] font-bold text-sm">
                                    Lihat Detail <i
                                        class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                </span>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded-3xl border border-gray-100">
                            <p class="text-gray-400 font-medium">Belum ada agenda mendatang.</p>
                        </div>
                    @endforelse

                </div>

            </div>
        </div>
    </div>


    <script>
        const eventsData = @json($events);

        function accessRapat() {
            const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
            if (isLoggedIn) {
                window.location.href = "{{ route('frontend.kegiatan') }}?type=meeting";
            } else {
                Swal.fire({
                    title: 'Akses Terbatas!',
                    text: "Jadwal Rapat hanya dapat diakses oleh anggota yang sudah login.",
                    icon: 'lock',
                    showCancelButton: true,
                    confirmButtonColor: '#7C3AED',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Login Sekarang',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.dispatchEvent(new CustomEvent('open-login-modal'));
                    }
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const kalender = document.getElementById("kalender");
            const monthTitle = document.getElementById("monthTitle");
            let date = new Date();

            function renderKalender() {
                kalender.innerHTML = "";
                const year = date.getFullYear();
                const month = date.getMonth();
                const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus",
                    "September", "Oktober", "November", "Desember"
                ];

                monthTitle.textContent = `${monthNames[month]} ${year}`;

                const firstDay = new Date(year, month, 1).getDay();
                const totalDays = new Date(year, month + 1, 0).getDate();
                const prevMonthDays = new Date(year, month, 0).getDate();
                const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

                days.forEach(day => {
                    kalender.innerHTML +=
                        `<div class='py-3 bg-gray-50 text-gray-400 font-bold text-xs uppercase tracking-wider border border-gray-100 text-center'>${day}</div>`;
                });

                let cellCount = 0;

                for (let i = 0; i < firstDay; i++) {
                    const dayNum = prevMonthDays - firstDay + 1 + i;
                    kalender.innerHTML +=
                        `<div class='h-28 border border-gray-100 bg-gray-50/30 p-2 text-gray-300 text-left'>${dayNum}</div>`;
                    cellCount++;
                }

                const today = new Date();
                for (let d = 1; d <= totalDays; d++) {
                    const isToday = d === today.getDate() && month === today.getMonth() && year === today
                        .getFullYear();
                    const currentStringDate =
                        `${year}-${String(month + 1).padStart(2, '0')}-${String(d).padStart(2, '0')}`;

                    const daysEvents = eventsData.filter(e => e.start === currentStringDate);

                    let eventHTML = '';

                    const colorMap = {
                        'warning': '#F59E0B',
                        'danger': '#EF4444',
                        'success': '#10B981',
                        'info': '#3B82F6',
                        'primary': '#7C3AED',
                        'secondary': '#6B7280',
                        'orange': 'orange',
                        'red': 'red',
                        'blue': 'blue'
                    };

                    daysEvents.forEach(evt => {
                        let rawColor = evt.color ? evt.color.trim().toLowerCase() : '';
                        const bgColor = colorMap[rawColor] || rawColor || '#7C3AED';

                        eventHTML += `
                            <div class="w-full mt-1 px-2 py-1 text-[10px] font-semibold text-white rounded truncate shadow-sm cursor-pointer hover:opacity-80 transition" 
                                 style="background-color: ${bgColor};" 
                                 title="${evt.title}">
                                ${evt.title}
                            </div>`;
                    });

                    kalender.innerHTML += `
                    <div class="h-28 border border-gray-100 p-1 flex flex-col justify-start items-start relative group transition hover:bg-gray-50 overflow-hidden">
                        <span class="w-7 h-7 flex items-center justify-center rounded-full text-sm font-bold mb-1 ${isToday ? 'bg-[#7C3AED] text-white shadow-md' : 'text-gray-700'}">
                            ${d}
                        </span>
                        <div class="w-full flex flex-col gap-0.5 overflow-y-auto custom-scrollbar" style="max-height: 70px;">
                            ${eventHTML}
                        </div>
                    </div>`;
                    cellCount++;
                }

                let nextMonthDay = 1;
                while (cellCount % 7 !== 0) {
                    kalender.innerHTML +=
                        `<div class='h-28 border border-gray-100 bg-gray-50/30 text-gray-300 p-2 text-left'>${nextMonthDay++}</div>`;
                    cellCount++;
                }
            }

            renderKalender();

            document.getElementById("prevMonth").addEventListener("click", () => {
                date.setMonth(date.getMonth() - 1);
                renderKalender();
            });
            document.getElementById("nextMonth").addEventListener("click", () => {
                date.setMonth(date.getMonth() + 1);
                renderKalender();
            });
        });
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 3px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 20px;
        }
    </style>
@endsection
