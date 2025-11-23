@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Kelola Kegiatan</h3>

        <div class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
            <div class="mb-6 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                    Kegiatan
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
                </h3>

                <div x-data="{ openDropDown: false }" class="relative">
                    <button @click="openDropDown = !openDropDown"
                        :class="openDropDown ? 'text-gray-700 dark:text-white' :
                            'text-gray-900 hover:text-gray-700 dark:hover:text-white'">
                        <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z"
                                fill="" />
                        </svg>
                    </button>
                    <div x-show="openDropDown" @click.outside="openDropDown = false"
                        class="absolute right-0 top-full z-40 w-40 space-y-1 rounded-2xl border border-gray-200 bg-white p-2 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark">
                        <button type="button"
                            class="flex w-full rounded-lg px-3 py-2 text-left text-theme-xs font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300"
                            data-hs-overlay="#delete-activity-modal" @click="openDropDown = false">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>


            <div class="grid sm:grid-cols-2">
                <div>
                    <div class="mb-5">
                        <h3 class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">{{ $activity->title }}
                        </h3>
                    </div>

                    <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                        <p class="text-theme-xs text-gray-500 dark:text-gray-400">Lokasi</p>
                        <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                            {{ $activity->location }}
                        </p>
                    </div>

                    <div class="flex flex-raw gap-7">
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
                </div>
            </div>
        </div>


        <div class="grid grid-cols-5 gap-4">

            <div class="col-span-2">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">

                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Anggota Kegiatan
                        </h3>
                    </div>

                    <div class="custom-scrollbar max-w-full overflow-x-auto">
                        <div class="w-full">
                            <div class="flex flex-col gap-2">

                                <div x-data="{
                                    users: {{ json_encode($users) }},
                                    selectedMembers: {{ json_encode($selectedMembers) }},
                                    items: {},
                                    selectAll: false,
                                    filterGeneration: '',
                                    filteredUsers: [],
                                
                                    init() {
                                        // Set default checked items
                                        this.users.forEach(u => {
                                            this.items[u.id] = this.selectedMembers.includes(u.id);
                                        });
                                
                                        // Load awal
                                        this.applyFilter();
                                    },
                                
                                    applyFilter() {
                                        // Tentukan user yang sedang difilter
                                        this.filteredUsers = this.filterGeneration === '' ?
                                            this.users :
                                            this.users.filter(u => u.generation == this.filterGeneration);
                                
                                        // Cek apakah seluruh filteredUsers sudah dipilih
                                        if (this.filteredUsers.length > 0 &&
                                            this.filteredUsers.every(u => this.items[u.id] === true)) {
                                            this.selectAll = true;
                                        } else {
                                            this.selectAll = false;
                                        }
                                    },
                                
                                    toggleAll() {
                                        this.selectAll = !this.selectAll;
                                
                                        // TAPI hanya user dalam filteredUsers yang ikut diubah
                                        this.filteredUsers.forEach(u => {
                                            this.items[u.id] = this.selectAll;
                                        });
                                    },
                                
                                    toggleItem(id) {
                                        this.items[id] = !this.items[id];
                                
                                        // Evaluasi ulang selectAll berdasarkan filteredUsers saja
                                        if (this.filteredUsers.every(u => this.items[u.id] === true)) {
                                            this.selectAll = true;
                                        } else {
                                            this.selectAll = false;
                                        }
                                    }
                                }">

                                    <!-- FORM POST -->
                                    <form x-ref="formMembers" action="{{ route('activity-members.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="user_ids" id="userIdsInput">
                                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                                    </form>

                                    <!-- Tombol -->
                                    <div class="flex justify-between items-center">

                                        <!-- KIRI: PILIH SEMUA + FILTER -->
                                        <div class="flex items-center gap-0">

                                            <!-- PILIH SEMUA -->
                                            <div @click="toggleAll()"
                                                class="flex cursor-pointer items-center gap-2 rounded-lg p-3 hover:bg-gray-50 dark:hover:bg-white/3">
                                                <div class="flex items-start gap-3">
                                                    <div class="flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]"
                                                        :class="selectAll ? 'border-brand-500 bg-brand-500' :
                                                            'bg-white border-gray-500'">
                                                        <svg :class="selectAll ? 'block' : 'hidden'" width="14"
                                                            height="14" fill="none" viewBox="0 0 14 14">
                                                            <path d="M11.6668 3.5L5.25016 9.91667L2.3335 7" stroke="white"
                                                                stroke-width="1.94437" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </div>

                                                <span
                                                    class="block text-theme-xs font-medium text-gray-700 dark:text-gray-400">
                                                    Pilih Semua
                                                </span>
                                            </div>

                                            <!-- FILTER GENERATION -->
                                            <div>
                                                <select
                                                    class="border rounded-lg p-2 text-theme-xs outline-1 outline-gray-300 font-medium text-gray-700 dark:text-gray-400"
                                                    x-model="filterGeneration" @change="applyFilter()">
                                                    <option value="">Semua Generasi</option>
                                                    @foreach ($generations as $gen)
                                                        <option value="{{ $gen }}">{{ $gen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- KANAN: TOMBOL SIMPAN -->
                                        <button type="button"
                                            @click="
            document.getElementById('userIdsInput').value = JSON.stringify(
                Object.keys(items).filter(id => items[id] === true)
            );
            $refs.formMembers.submit();
        "
                                            class="py-1.5 px-4 border-2 text-theme-xs border-[#7753AF] bg-[#7753AF] rounded-lg text-white text-center hover:bg-[#67419B] transition">
                                            Simpan
                                        </button>

                                    </div>


                                    <!-- LIST USER -->
                                    <div class="flex h-[350px] flex-col mt-3">
                                        <div class="custom-scrollbar flex h-auto flex-col overflow-y-auto pr-3">

                                            <template x-for="user in filteredUsers" :key="user.id">
                                                <div @click="toggleItem(user.id)"
                                                    class="flex cursor-pointer items-center gap-9 rounded-lg p-3 
                                               hover:bg-gray-50 dark:hover:bg-white/3">

                                                    <div class="flex items-start gap-3">
                                                        <div class="flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]"
                                                            :class="items[user.id] ? 'border-brand-500 bg-brand-500' :
                                                                'bg-white border-gray-500'">
                                                            <svg :class="items[user.id] ? 'block' : 'hidden'" width="14"
                                                                height="14" fill="none" viewBox="0 0 14 14">
                                                                <path d="M11.6668 3.5L5.25016 9.91667L2.3335 7"
                                                                    stroke="white" stroke-width="1.94437"
                                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <span
                                                            class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400"
                                                            x-text="user.full_name"></span>
                                                        <span class="text-theme-xs text-gray-500 dark:text-gray-400"
                                                            x-text="`${user.generation} - ${user.major}`">
                                                        </span>
                                                    </div>

                                                </div>
                                            </template>

                                            <div x-show="filteredUsers.length === 0" class="text-gray-500 text-sm p-3">
                                                Tidak ada anggota pada generasi ini.
                                            </div>

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-span-3">
                <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Dokumentasi Kegiatan
                        </h3>
                    </div>


                    <form action="{{ route('activity-documents.store') }}" method="POST">
                        @csrf

                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">

                        <div class="flex flex-row gap-4 w-full">
                            <div class="relative w-full">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Link Google Drive
                                </label>

                                <input type="text" name="google_drive_link"
                                    value="{{ old('google_drive_link', $activityDocument->google_drive_link ?? '') }}"
                                    placeholder="Masukan link google drive"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('google_drive_link') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('google_drive_link')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('google_drive_link')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end items-center w-fit mt-6">
                                <div class="flex gap-5 w-full justify-end items-center">
                                    <button type="submit"
                                        class="py-1.5 px-4 border-2 text-theme-xs border-[#7753AF] bg-[#7753AF] rounded-lg text-white text-center hover:bg-[#67419B] transition">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Dropzone -->
                    <form action="{{ route('activity-photos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="activity_id" value="{{ $activity->id }}">
                        <input type="hidden" name="deleted_photos" id="deletedPhotosInput">

                        <div class="mt-4">
                            <label class="text-[#616161] font-medium text-xs block text-md">Foto</label>

                            <div id="dropzone"
                                class="border mt-3 border-gray-300 rounded-xl p-3 gap-3 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800 transition flex flex-wrap">

                                <!-- FOTO DARI DATABASE -->
                                @foreach ($activity->activity_photos as $p)
                                    <div class="relative w-28 h-28 group">

                                        <img src="{{ asset('storage/' . $p->photo_path) }}"
                                            class="w-full h-full object-cover rounded-xl border border-gray-300">


                                        <button type="button"
                                            class="absolute -top-2 -right-2 bg-red-600 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs opacity-0 group-hover:opacity-100 transition"
                                            onclick="event.stopPropagation(); removeExistingImage(this, '{{ $p->id }}')">
                                            ✕
                                        </button>

                                    </div>
                                @endforeach

                                <!-- AREA UPLOAD -->
                                <div class="flex flex-col items-center justify-center w-28 h-28 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-gray-50 transition"
                                    onclick="openFilePicker(event)">

                                    <div class="flex flex-col items-center justify-center space-y-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 16.5v-9m-4.5 4.5h9M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-xs text-gray-600">Upload</p>
                                    </div>
                                </div>

                                <!-- INPUT FILE ASLI -->
                                <input type="file" id="fileInput" name="photos[]" multiple accept="image/*"
                                    class="hidden">
                            </div>
                        </div>

                        <button type="submit"
                            class="mt-5 py-1.5 px-4 border-2 text-theme-xs border-[#7753AF] bg-[#7753AF] rounded-lg text-white text-center hover:bg-[#67419B] transition">
                            Simpan
                        </button>
                    </form>

                    <script>
                        let deletedPhotos = [];

                        function openFilePicker(event) {
                            event.stopPropagation();
                            document.getElementById('fileInput').click();
                        }

                        function removeExistingImage(btn, photoId) {
                            deletedPhotos.push(photoId);
                            document.getElementById('deletedPhotosInput').value = JSON.stringify(deletedPhotos);
                            btn.parentElement.remove();
                        }

                        document.getElementById('fileInput').addEventListener('change', function(e) {
                            Array.from(e.target.files).forEach(file => {
                                const reader = new FileReader();
                                reader.onload = function(event) {
                                    const div = document.createElement("div");
                                    div.className = "relative w-28 h-28";

                                    div.innerHTML = `
                    <img src="${event.target.result}"
                        class="w-full h-full object-cover rounded-xl border border-gray-300">
                `;

                                    // Masukkan sebelum upload box
                                    document.getElementById('dropzone')
                                        .insertBefore(div, document.getElementById('dropzone').lastElementChild);
                                };
                                reader.readAsDataURL(file);
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

    <div id="delete-activity-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-index overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="delete-activity-modal-label">

        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center justify-center pointer-events-auto">

            <div
                class="w-[390px] flex flex-col px-4 py-6 bg-white border border-gray-200 shadow-2xs rounded-xl dark:bg-gray-800 dark:border-gray-700 dark:shadow-gray-700/70">

                <div class="flex flex-col justify-center items-center">
                    <img src="{{ asset('assets/images/icons/circle-alert.svg') }}" alt="Success" class="w-12 h-12">

                    <h3 id="delete-activity-modal-label" class="text-[#E6353D] text-xl mt-2 mb-1 font-semibold">Hapus
                        Data?
                    </h3>
                </div>

                <div class="mb-7 overflow-y-auto">
                    <p class="mt-1 text-gray-800 text-center dark:text-neutral-400">
                        Apakah Anda yakin ingin menghapus
                        <span class="font-semibold text-gray-800 dark:text-white">{{ $activity->title }}</span>
                        dari sistem?
                    </p>
                </div>

                <form action="{{ route('activities.destroy', $activity->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="flex justify-center items-center gap-x-2">
                        <button type="button"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                            data-hs-overlay="#delete-activity-modal">
                            Batal
                        </button>
                        <button type="submit"
                            class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#DD0000] text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
