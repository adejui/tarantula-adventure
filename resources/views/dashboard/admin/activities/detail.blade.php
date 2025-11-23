@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Detail Kegiatan</h3>

        <div class="grid sm:grid-cols-2 gap-4">
            <div class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                <div class="mb-9 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Informasi Kegiatan
                    </h3>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Nama Kegiatan</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        {{ $activity->title }}
                    </p>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Jenis Kegiatan</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        @if ($activity->activity_type == 'meeting')
                            Rapat
                        @elseif($activity->activity_type == 'basic training')
                            Diksar
                        @elseif($activity->activity_type == 'exploration')
                            Pengembaraan
                        @elseif($activity->activity_type == 'anniversary')
                            Hari Jadi
                        @elseif($activity->activity_type == 'others')
                            Lain-lain
                        @else
                            Tidak diketahui
                        @endif
                    </p>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Lokasi</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        {{ $activity->location }}
                    </p>
                </div>

                <div class="flex flex-raw gap-20 mb-5">
                    <div class="flex flex-col gap-y-1 w-fit justify-center">
                        <p class="text-theme-xs text-gray-500 dark:text-gray-400">Tanggal Mulai</p>
                        <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($activity->start_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                    <div class="flex flex-col gap-y-1 w-fit justify-center">
                        <p class="text-theme-xs text-gray-500 dark:text-gray-400">Tanggal Selesai</p>
                        <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                            {{ \Carbon\Carbon::parse($activity->end_date)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Deskripsi</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        {{ $activity->description ?? '-' }}
                    </p>

                </div>
            </div>


            <div class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                <div class="mb-9 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Anggota Kegiatan
                    </h3>
                </div>

                <div class="flex h-[372px] flex-col">
                    <div class="custom-scrollbar flex h-auto flex-col overflow-y-auto pr-3">
                        @forelse ($activity_members as $activity_member)
                            <div
                                class="flex items-center justify-between border-b border-gray-200 pb-4 pt-4 first:pt-0 last:border-b-0 last:pb-0 dark:border-gray-800">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10">
                                        <img src="{{ $activity_member->user->photo ? asset('storage/' . $activity_member->user->photo) : asset('storage/imgUsers/default-image.png') }}"
                                            alt="Foto Profil" class="h-full w-full object-cover rounded-3xl">
                                    </div>

                                    <div>
                                        <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                                            {{ $activity_member->user->full_name }}
                                        </h3>
                                        <span class="block text-theme-xs text-gray-500 dark:text-gray-400">
                                            {{ $activity_member->user->generation }} - {{ $activity_member->user->major }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-theme-sm text-gray-500 dark:text-gray-400">
                                Belum ada anggota.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>

        <div class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
            <div class="mb-9 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Dokumentasi Kegiatan
                </h3>
            </div>

            @if ($activity_documentation)
                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Link Google Drive</p>

                    <a href="{{ $activity_documentation->google_drive_link }}" target="_blank" rel="noopener noreferrer"
                        class="block text-theme-sm font-medium text-blue-600 hover:underline dark:text-blue-400">
                        {{ $activity_documentation->google_drive_link }}
                    </a>
                </div>
            @else
                <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                    <p class="text-theme-xs text-gray-500 dark:text-gray-400">Link Google Drive</p>
                    <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                        -
                    </p>
                </div>
            @endif

            <p class="text-theme-xs text-gray-500 dark:text-gray-400 mb-2">Foto Dokumentasi</p>

            @if ($activity_photos->count() > 0)
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                    @foreach ($activity_photos as $photo)
                        <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="Foto Dokumentasi"
                            class="rounded-xl border border-gray-200 dark:border-gray-700 w-full">
                    @endforeach
                </div>
            @else
                <p class="text-theme-sm text-gray-500 dark:text-gray-400">Tidak ada foto dokumentasi.</p>
            @endif

        </div>
    </div>
@endsection
