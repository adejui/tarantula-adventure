@extends('dashboard.layouts.app')

@section('content')
    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Detail Anggota</h3>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <!-- FOTO PROFIL -->
            <div
                class="border border-[#E0E0E0] rounded-xl dark:border-gray-700 h-fit dark:bg-white/5 p-6 flex flex-col items-center">
                <div class="w-full">
                    @if ($user->photo)
                        <img src="{{ Storage::url($user->photo) }}" alt="Foto {{ $user->full_name }}"
                            class="h-full w-full object-cover rounded-3xl" />
                    @else
                        <img src="{{ asset('storage/imgUsers/default-image.png') }}" alt="Foto Default"
                            class="h-full w-full object-cover rounded-3xl" />
                    @endif
                </div>
            </div>

            <!-- INFORMASI -->
            <div class="md:col-span-3 flex flex-col gap-5">
                <!-- INFORMASI PRIBADI -->
                <div class="p-4 border border-[#E0E0E0] rounded-xl dark:border-gray-700 dark:bg-white/5">
                    <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Pribadi</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-5">
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Nama Lengkap</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">{{ $user->full_name }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Jenis Kelamin</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">
                                {{ $user->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Tanggal Lahir</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">
                                {{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') }}
                            </p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Umur</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">
                                {{ \Carbon\Carbon::parse($user->birth_date)->age }} tahun
                            </p>
                        </div>
                    </div>
                </div>

                <!-- INFORMASI AKADEMIK -->
                <div class="p-4 border border-[#E0E0E0] rounded-xl dark:border-gray-700 dark:bg-white/5">
                    <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Akademik</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-5">
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">NRP</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">{{ $user->nrp }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Program Studi</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">{{ $user->major }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Angkatan</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">{{ $user->generation }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Tahun</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">{{ $user->batch }}</p>
                        </div>
                    </div>
                </div>

                <!-- INFORMASI KONTAK -->
                <div class="p-4 border border-[#E0E0E0] rounded-xl dark:border-gray-700 dark:bg-white/5">
                    <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Kontak</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Email</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">{{ $user->email }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">No Telp</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">{{ $user->phone_number }}</p>
                        </div>
                    </div>
                </div>

                <!-- INFORMASI AKUN -->
                <div class="p-4 border border-[#E0E0E0] rounded-xl dark:border-gray-700 dark:bg-white/5">
                    <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Akun</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-5">
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Role</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">
                                @if ($user->role === 'admin')
                                    Admin
                                @elseif ($user->role === 'logistics')
                                    Logistik
                                @else
                                    Anggota
                                @endif
                            </p>

                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Status</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">
                                @if ($user->status === 'active')
                                    Aktif
                                @elseif ($user->status === 'inactive')
                                    Tidak Aktif
                                @else
                                    Alumni
                                @endif
                            </p>
                        </div>
                        <div>
                            <h4 class="text-[#9E9E9E] font-medium text-xs mb-2">Jabatan</h4>
                            <p class="text-[#212121] font-normal text-xs dark:text-white/90">
                                @if ($user->position === 'leader')
                                    Ketua
                                @elseif ($user->position === 'secretary')
                                    Sekretaris
                                @elseif ($user->position === 'logistics')
                                    Logistik
                                @else
                                    Anggota
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
