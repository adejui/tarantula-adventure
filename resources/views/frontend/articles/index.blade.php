@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-7xl mx-auto">

            <div class="flex justify-between items-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 tracking-tight">Artikel</h1>
                <nav class="flex text-sm font-medium text-gray-500">
                    <a href="{{ route('frontend.home') }}" class="hover:text-[#7C3AED] transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#7C3AED]">Artikel</span>
                </nav>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                <div class="lg:col-span-8 space-y-20">

                    <article class="flex flex-col gap-6">
                        <h2
                            class="text-3xl md:text-4xl font-bold text-gray-900 leading-snug hover:text-[#7C3AED] transition-colors cursor-pointer">
                            Pendidikan Dasar Mapala Tarantula Adventure angkatan XII siap digelar. Siapkan pendidikan dasar
                            untuk calon anggota baru.
                        </h2>

                        <div class="w-full aspect-[16/9] rounded-3xl overflow-hidden shadow-sm">
                            <img src="{{ asset('frontend/images/artikel-1.jpeg') }}"
                                alt="Diksar Mapala"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>

                        <div class="flex items-center text-sm text-gray-500 font-medium">
                            <span>Yogyakarta, 22 Mei 2025</span>
                            <span class="mx-3">•</span>
                            <span>Admin Mapala</span>
                        </div>

                        <div class="text-gray-600 leading-relaxed text-justify space-y-5">
                            <p>
                                Dalam rangka menyambut dan membina calon anggota baru, Mahasiswa Pecinta Alam (MAPALA)
                                Tarantula Adventure Yogyakarta akan menggelar kegiatan tahunan bertajuk "Pendidikan Dasar
                                MAPALA Angkatan XII". Kegiatan ini merupakan agenda penting dalam proses rekrutmen anggota
                                baru yang bertujuan membentuk karakter, meningkatkan kesadaran lingkungan, dan menumbuhkan
                                semangat kepecintaalaman di kalangan mahasiswa.
                            </p>
                            <p>
                                Kegiatan Pendidikan Dasar (Diksar) ini akan diselenggarakan selama empat hari, mulai tanggal
                                29 Mei hingga 1 Juni 2025, dan diikuti oleh para calon anggota yang telah melewati proses
                                seleksi administrasi dan fisik. Sebagai langkah awal sebelum keberangkatan ke lokasi
                                pelatihan, akan dilaksanakan upacara pelepasan resmi di halaman kampus.
                            </p>
                            <p>
                                Setelah dilepas secara simbolis, peserta akan diberangkatkan menuju Bukit Sigepak, Katerban,
                                Purworejo, Jawa Tengah, yang menjadi lokasi utama kegiatan pelatihan. Bukit Sigepak dipilih
                                karena kondisi geografisnya yang menantang namun aman, serta dinilai representatif untuk
                                menyelenggarakan pelatihan dasar kepecintaalaman.
                            </p>
                        </div>
                    </article>


                    <article class="flex flex-col gap-6 border-t border-gray-100 pt-16">
                        <h2
                            class="text-3xl md:text-4xl font-bold text-gray-900 leading-snug hover:text-[#7C3AED] transition-colors cursor-pointer">
                            Eksplorasi Goa Pindul: Menguak Keindahan Bawah Tanah Gunungkidul
                        </h2>
                        <div class="w-full aspect-[16/9] rounded-3xl overflow-hidden shadow-sm">
                            <img src="{{ asset('frontend/images/artikel-2.jpeg') }}"
                                alt="Caving"
                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        </div>
                        <div class="flex items-center text-sm text-gray-500 font-medium">
                            <span>Gunungkidul, 15 April 2025</span>
                            <span class="mx-3">•</span>
                            <span>Divisi Caving</span>
                        </div>
                        <div class="text-gray-600 leading-relaxed text-justify space-y-5">
                            <p>
                                Tim Divisi Caving Mapala Tarantula sukses melakukan pemetaan dan eksplorasi di kawasan karst
                                Gunungkidul, khususnya di sistem Goa Pindul. Kegiatan ini bertujuan untuk mendata potensi
                                speleologi sekaligus melakukan aksi bersih goa sebagai bentuk kepedulian terhadap
                                kelestarian lingkungan bawah tanah.
                            </p>
                            <p class="hidden md:block">
                                Perjalanan dimulai dengan briefing teknis mengenai keamanan penelusuran goa berair (cave
                                tubing). Peserta diajak menyusuri sungai bawah tanah sepanjang kurang lebih 350 meter dengan
                                pemandangan stalaktit dan stalagmit yang memukau.
                            </p>
                        </div>
                    </article>

                    <div class="pt-8 flex items-center gap-2">
                        <span class="px-4 py-2 text-sm font-medium text-gray-500 bg-gray-100 rounded-md cursor-not-allowed">
                            Previous
                        </span>
                        <span class="px-4 py-2 text-sm font-medium text-white bg-[#7C3AED] rounded-md">
                            1
                        </span>
                        <a href="#"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            2
                        </a>
                        <a href="#"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            3
                        </a>
                        <a href="#"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                            Next
                        </a>
                    </div>

                </div>

                <div class="lg:col-span-4">
                    <div class="sticky top-32">

                        <h3 class="text-2xl font-bold text-gray-900 mb-8">Artikel Terbaru</h3>

                        <div class="space-y-8">

                            <a href="#" class="group flex gap-5 items-start">
                                <div class="w-28 h-28 flex-shrink-0 rounded-2xl overflow-hidden shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1501555088652-021faa106b9b?q=80&w=200&auto=format&fit=crop"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h4
                                        class="text-base font-bold text-gray-900 leading-snug line-clamp-3 group-hover:text-[#7C3AED] transition-colors">
                                        Survei Lokasi Pendidikan Dasar Mapala UBSI Yogyakarta
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-gray-400 font-medium">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>12 jam yang lalu</span>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="group flex gap-5 items-start">
                                <div class="w-28 h-28 flex-shrink-0 rounded-2xl overflow-hidden shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=200&auto=format&fit=crop"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h4
                                        class="text-base font-bold text-gray-900 leading-snug line-clamp-3 group-hover:text-[#7C3AED] transition-colors">
                                        Pengembaraan Mapala UBSI angkatan XII di Gunung Sumbing
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-gray-400 font-medium">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>1 hari yang lalu</span>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="group flex gap-5 items-start">
                                <div class="w-28 h-28 flex-shrink-0 rounded-2xl overflow-hidden shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1533130061792-64b345e4a833?q=80&w=200&auto=format&fit=crop"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h4
                                        class="text-base font-bold text-gray-900 leading-snug line-clamp-3 group-hover:text-[#7C3AED] transition-colors">
                                        Upacara Pelepasan Ekspedisi Gunung Sumbing
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-gray-400 font-medium">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>2 hari yang lalu</span>
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="group flex gap-5 items-start">
                                <div class="w-28 h-28 flex-shrink-0 rounded-2xl overflow-hidden shadow-sm">
                                    <img src="https://images.unsplash.com/photo-1599939571322-792a326991f2?q=80&w=200&auto=format&fit=crop"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                </div>
                                <div class="flex flex-col gap-2">
                                    <h4
                                        class="text-base font-bold text-gray-900 leading-snug line-clamp-3 group-hover:text-[#7C3AED] transition-colors">
                                        Berbagi senyum dan kasih bersama anak-anak Panti Asuhan
                                    </h4>
                                    <div class="flex items-center gap-2 text-xs text-gray-400 font-medium">
                                        <i class="fa-regular fa-clock"></i>
                                        <span>1 minggu yang lalu</span>
                                    </div>
                                </div>
                            </a>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
