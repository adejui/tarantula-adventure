@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
        @if (session('error'))
            <x-alert-error title="Berhasil!" :message="session('error')" />
        @endif

        @if ($errors->any())
            <x-alert-error title="Gagal!" message="Periksa kembali inputan kamu." />
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.HSOverlay.open('#hs-scale-animation-modal');
                });
            </script>
        @endif
    </div>

    <x-breadcrumb :items="[
        ['label' => 'Kegiatan', 'url' => route('activities.index')],
        ['label' => 'Kalender Kegiatan', 'url' => route('activities.index')],
    ]" />

    <div x-data="{
        open: false,
        dateStr: '',
        showForm: {{ $errors->any() ? 'true' : 'false' }},
        init() {
            window.openAddEventModal = (date) => {
                this.dateStr = date;
                this.open = true;
            };
        }
    }">

        <!-- TELEPORT MODAL -->
        <template x-teleport="body">
            <div x-cloak x-show="open" class="fixed inset-0 z-index flex items-center justify-end">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-black/50" @click="open = false"></div>

                <!-- Modal -->
                <div x-show="open" x-transition:enter="transform transition duration-500"
                    x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                    x-transition:leave="transform transition duration-500" x-transition:leave-start="translate-x-0"
                    x-transition:leave-end="translate-x-full"
                    class="relative mr-8 w-full sm:w-[500px] h-fit bg-white dark:bg-gray-800 p-6 border-l border-gray-200 shadow-2xl dark:border-neutral-700 overflow-y-auto rounded-2xl">

                    <div class="flex justify-between items-center pb-3 mb-4">
                        <h2 class="text-2xl font-semibold mb-4">Tambah Kegiatan</h2>
                        <button @click="open = false" class="text-gray-500 hover:text-gray-700 text-2xl leading-none">
                            &times;
                        </button>
                    </div>

                    <form action="{{ route('activities.store') }}" method="POST"
                        class="max-h-[calc(85vh-2rem)] overflow-y-auto ps-3 py-4 rounded-2xl custom-scroll">
                        @csrf

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Nama Kegiatan
                            </label>

                            <input type="text" name="title" value="{{ old('title') }}"
                                placeholder="Masukan nama kegiatan"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('title') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('title')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('title')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                Jenis Kegiatan
                            </label>
                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select name="activity_type"
                                    class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('start_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true">
                                    <option value="" {{ old('activity_type') == '' ? 'selected' : '' }}
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        -- pilih jenis kegiatan --
                                    </option>
                                    <option value="meeting" {{ old('activity_type') == 'meeting' ? 'selected' : '' }}
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Rapat
                                    </option>
                                    <option value="basic training"
                                        {{ old('activity_type') == 'basic training' ? 'selected' : '' }}
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Diksar
                                    </option>
                                    <option value="exploration"
                                        {{ old('activity_type') == 'exploration' ? 'selected' : '' }}
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Pengembaraan
                                    </option>
                                    <option value="anniversary"
                                        {{ old('activity_type') == 'anniversary' ? 'selected' : '' }}
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Hari Jadi
                                    </option>
                                    <option value="others" {{ old('activity_type') == 'others' ? 'selected' : '' }}
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Lain-lain
                                    </option>
                                </select>

                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                                @error('start_date')
                                    <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>
                            @error('activity_type')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Mulai
                            </label>

                            <div class="relative">
                                <input type="date" x-model="dateStr" name="start_date" value="{{ old('start_date') }}"
                                    placeholder="Pilih tanggal" onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('start_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('start_date')
                                    <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>
                            @error('start_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Selesai
                            </label>

                            <div class="relative">
                                <input type="date" name="end_date" value="{{ old('end_date') }}"
                                    placeholder="Pilih tanggal" onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('end_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('end_date')
                                    <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>
                            @error('end_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Lokasi
                            </label>

                            <input type="text" name="location" value="{{ old('location') }}"
                                placeholder="Masukan lokasi"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('location') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('location')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('location')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Deskripsi
                            </label>
                            <textarea name="description" rows="3" placeholder="Masukan deskripsi"
                                class="text-[#212121] font-normal text-xs w-full rounded-lg border bg-transparent px-4 py-2.5 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('description') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"></textarea>
                            @error('description')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end items-center w-full mt-8">
                            <div class="flex gap-5 w-full justify-end items-center">
                                <a href="{{ route('activities.index') }}" title="Hapus"
                                    class="p-2 border-2 text-sm dark:text-white border-[#7753AF] bg-transparent w-full rounded-lg text-[#7753AF] text-center dark:hover:bg-gray-800 hover:bg-[#F3E8FF] transition">
                                    Batal
                                </a>

                                <button type="submit"
                                    class="p-2 border-2 text-sm border-[#7753AF] bg-[#7753AF] w-full rounded-lg text-white text-center hover:bg-[#67419B] transition">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </template>

    </div>

    <div x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
    }">


        <div x-data="{ showFilter: false }">
            <div
                class="flex justify-between bg-white border mb-4 border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
                <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 m-2">Kalender Kegiatan</h3>

                <button @click="showForm = true"
                    class="inline-flex items-center gap-2 px-4 h-10 text-sm font-medium text-white bg-[#7653afaa] transition rounded-lg shadow-theme-xs hover:bg-[#68489C]">
                    <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="Tambah" class="h-4 w-4">
                    Tambah
                </button>
            </div>

            <!-- Modal Form -->
            <template x-teleport="body">
                <div x-cloak x-show="showForm" class="fixed inset-0 z-index flex items-center justify-end">
                    <div class="absolute inset-0 bg-black/50" @click="showForm = false"></div>

                    <div x-show="showForm" x-transition:enter="transform transition ease-in-out duration-500"
                        x-transition:enter-start="translate-x-full opacity-0"
                        x-transition:enter-end="translate-x-0 opacity-100"
                        class="relative mr-8 z-index bg-white dark:bg-gray-800 w-full sm:w-[500px] h-fit shadow-2xl border-l border-gray-200 dark:border-neutral-700 p-6 overflow-y-auto rounded-2xl">

                        <div class="flex justify-between items-center pb-3 mb-4">
                            <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Tambah Kegiatan</h2>
                            <button @click="showForm = false"
                                class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                        </div>

                        <form action="{{ route('activities.store') }}" method="POST"
                            class="max-h-[calc(85vh-2rem)] overflow-y-auto ps-3 py-4 rounded-2xl custom-scroll">
                            @csrf

                            <div class="relative mb-4">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Nama Kegiatan
                                </label>

                                <input type="text" name="title" value="{{ old('title') }}"
                                    placeholder="Masukan nama kegiatan"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('title') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('title')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('title')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative mb-4">
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Jenis Kegiatan
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="activity_type"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden @error('start_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="" {{ old('activity_type') == '' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            -- pilih jenis kegiatan --
                                        </option>
                                        <option value="meeting" {{ old('activity_type') == 'meeting' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Rapat
                                        </option>
                                        <option value="basic training"
                                            {{ old('activity_type') == 'basic training' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Diksar
                                        </option>
                                        <option value="exploration"
                                            {{ old('activity_type') == 'exploration' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Pengembaraan
                                        </option>
                                        <option value="anniversary"
                                            {{ old('activity_type') == 'anniversary' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Hari Jadi
                                        </option>
                                        <option value="others" {{ old('activity_type') == 'others' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Lain-lain
                                        </option>
                                    </select>

                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                    @error('start_date')
                                        <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                    fill="#F04438" />
                                            </svg>
                                        </span>
                                    @enderror
                                </div>
                                @error('activity_type')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative mb-4">
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                    Tanggal Mulai
                                </label>

                                <div class="relative">
                                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                                        placeholder="Pilih tanggal" onclick="this.showPicker()"
                                        class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('start_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                fill="" />
                                        </svg>
                                    </span>
                                    @error('start_date')
                                        <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                    fill="#F04438" />
                                            </svg>
                                        </span>
                                    @enderror
                                </div>
                                @error('start_date')
                                    <p class="text-theme-xs text-error-500 mt-1.5">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="relative mb-4">
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                    Tanggal Selesai
                                </label>

                                <div class="relative">
                                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                                        placeholder="Pilih tanggal" onclick="this.showPicker()"
                                        class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('end_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                fill="" />
                                        </svg>
                                    </span>
                                    @error('end_date')
                                        <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                    fill="#F04438" />
                                            </svg>
                                        </span>
                                    @enderror
                                </div>
                                @error('end_date')
                                    <p class="text-theme-xs text-error-500 mt-1.5">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div class="relative mb-4">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Lokasi
                                </label>

                                <input type="text" name="location" value="{{ old('location') }}"
                                    placeholder="Masukan lokasi"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('location') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('location')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('location')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative mb-4">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Deskripsi
                                </label>
                                <textarea name="description" rows="3" placeholder="Masukan deskripsi"
                                    class="text-[#212121] font-normal text-xs w-full rounded-lg border bg-transparent px-4 py-2.5 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('description') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"></textarea>
                                @error('description')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex justify-end items-center w-full mt-8">
                                <div class="flex gap-5 w-full justify-end items-center">
                                    <a href="{{ route('activities.index') }}" title="Hapus"
                                        class="p-2 border-2 text-sm dark:text-white border-[#7753AF] bg-transparent w-full rounded-lg text-[#7753AF] text-center dark:hover:bg-gray-800 hover:bg-[#F3E8FF] transition">
                                        Batal
                                    </a>

                                    <button type="submit"
                                        class="p-2 border-2 text-sm border-[#7753AF] bg-[#7753AF] w-full rounded-lg text-white text-center hover:bg-[#67419B] transition">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div x-data="calendarForm" x-init="init()">
        <!--     MODAL EDIT     -->
        <template x-teleport="body">
            <div x-cloak x-show="showEditForm" class="fixed inset-0 z-index flex items-center justify-end">

                <!-- BACKDROP -->
                <div class="absolute inset-0 bg-black/50" @click="showEditForm = false"></div>

                <!-- SIDEBAR FORM -->
                <div x-show="showEditForm" x-transition:enter="transform transition ease-in-out duration-500"
                    x-transition:enter-start="translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    class="relative mr-8 bg-white w-full sm:w-[500px] rounded-2xl p-6 shadow-2xl">

                    <!-- HEADER -->
                    <div class="flex justify-between items-center pb-3 mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Edit Kegiatan</h2>
                        <button @click="showEditForm = false" class="text-gray-500 text-2xl leading-none">&times;</button>
                    </div>

                    <!-- FORM EDIT -->
                    <form id="editEventForm" method="POST" :action="`/activities/${edit.id}`">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="id" x-model="edit.id">

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Nama Kegiatan
                            </label>

                            <input type="text" x-model="edit.title" name="title" value="{{ old('title') }}"
                                placeholder="Masukan nama kegiatan"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('title') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('title')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('title')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                Jenis Kegiatan
                            </label>

                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select name="activity_type" x-model="edit.activity_type"
                                    class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                                    @change="isOptionSelected = (edit.activity_type !== '')">
                                    <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        -- pilih jenis kegiatan --
                                    </option>

                                    <option value="meeting" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Rapat
                                    </option>

                                    <option value="basic training"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Diksar
                                    </option>

                                    <option value="exploration" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Pengembaraan
                                    </option>

                                    <option value="anniversary" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Hari Jadi
                                    </option>

                                    <option value="others" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        Lain-lain
                                    </option>
                                </select>

                                <!-- Icon dropdown -->
                                <span
                                    class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20">
                                        <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </span>
                            </div>
                        </div>



                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Lokasi
                            </label>

                            <input type="text" x-model="edit.location" name="location" value="{{ old('location') }}"
                                placeholder="Masukan lokasi"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('location') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('location')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                            @error('location')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Mulai
                            </label>

                            <div class="relative">
                                <input type="date" x-model="edit.start_date" name="start_date"
                                    value="{{ old('start_date') }}" placeholder="Pilih tanggal"
                                    onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('start_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('start_date')
                                    <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>
                            @error('start_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Selesai
                            </label>

                            <div class="relative">
                                <input type="date" x-model="edit.end_date" name="end_date"
                                    value="{{ old('end_date') }}" placeholder="Pilih tanggal"
                                    onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('end_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('end_date')
                                    <span class="absolute top-1/2 right-10 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                            </div>
                            @error('end_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Deskripsi
                            </label>
                            <textarea name="description" x-model="edit.description" rows="3" placeholder="Masukan deskripsi"
                                class="text-[#212121] font-normal text-xs w-full rounded-lg border bg-transparent px-4 py-2.5 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('description') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"></textarea>
                            @error('description')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg w-full">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </template>

    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("calendarForm", () => ({
                showEditForm: false,

                edit: {
                    id: "",
                    title: "",
                    activity_type: "",
                    location: "",
                    start_date: "",
                    end_date: "",
                    description: "",
                },

                init() {
                    // Fungsi dipanggil FullCalendar
                    window.openEditEventModal = (data) => {
                        this.edit = data; // isi data ke form
                        this.showEditForm = true; // tampilkan modal edit
                    };
                },
            }));
        });
    </script>

    <div class="p-0 grid sm:grid-cols-5">

        <div class="col-span-3">
            <div id="calendar" class="bg-white dark:bg-gray-900 p-0 rounded-xl shadow"></div>
        </div>



        <div class="col-span-2 ps-4">
            <div class="rounded-2xl border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Kegiatan Mendatang
                    </h3>
                </div>

                <div class="custom-scrollbar max-w-full overflow-x-auto">
                    <div class="">
                        <div class="flex flex-col gap-2">

                            <div class="flex h-[505px] flex-col mt-3">
                                <div class="custom-scrollbar flex h-auto flex-col overflow-y-auto pr-3">
                                    @forelse ($upcomingSchedules as $upcomingSchedule)
                                        <div class="ps-2 my-2 first:mt-0">
                                            <h3 class="text-xs font-medium uppercase text-gray-500 dark:text-neutral-400">
                                                {{ \Carbon\Carbon::parse($upcomingSchedule->start_date)->translatedFormat('l, j F Y') }}
                                            </h3>
                                        </div>

                                        <div
                                            class="flex gap-x-3 relative group rounded-lg hover:bg-gray-100 dark:hover:bg-white/10">
                                            <div class="z-1 absolute inset-0"></div>

                                            <div
                                                class="relative last:after:hidden after:absolute after:top-0 after:bottom-0 after:start-3.5 after:w-px after:-translate-x-[0.5px] after:bg-gray-200 dark:after:bg-neutral-700 dark:group-hover:after:bg-neutral-600">
                                                <div class="relative z-10 size-7 flex justify-center items-center">
                                                    <div
                                                        class="size-2 rounded-full bg-white border-2 border-gray-300 group-hover:border-gray-600 dark:bg-neutral-800 dark:border-neutral-600 dark:group-hover:border-neutral-600">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="grow p-2 pb-8">
                                                <h3
                                                    class="flex gap-x-1.5 mb-1 text-theme-sm font-medium text-gray-800 dark:text-gray-400">
                                                    {{ $upcomingSchedule->title ?? 'Nama Kegiatan' }}
                                                </h3>

                                                @if ($upcomingSchedule->description)
                                                    <p class="mt-1 text-theme-xs text-gray-500 dark:text-gray-400">
                                                        {{ $upcomingSchedule->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-500 text-sm">Tidak ada jadwal mendatang.</p>
                                    @endforelse
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
@endsection
