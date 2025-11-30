@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <x-breadcrumb :items="[['label' => 'Anggota', 'url' => route('users.index')], ['label' => 'Edit Anggota']]" />

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Edit Anggota</h3>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
            <!-- FOTO PROFIL -->
            <div
                class="border border-[#E0E0E0] rounded-xl dark:border-gray-700 h-fit dark:bg-white/5 p-6 flex flex-col items-center">

                <!-- Foto Profil -->
                <div class="w-full">
                    <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('storage/imgUsers/default-image.png') }}"
                        alt="Foto Profil" class="h-full w-full object-cover rounded-3xl">
                </div>

                <!-- Tombol Ganti & Hapus -->
                <div class="flex flex-inline w-full gap-x-3 items-center justify-center">
                    <!-- Tombol Ganti -->
                    <form action="{{ route('users.update-photo', $user->id) }}" method="POST" enctype="multipart/form-data"
                        class="w-full">
                        @csrf
                        @method('PUT')

                        <label for="photo-{{ $user->id }}"
                            class="text-sm text-white p-2.5 mt-6 border-2 border-[#7753AF] bg-[#7753AF] w-full rounded-xl cursor-pointer flex items-center justify-center">
                            Ganti
                        </label>

                        <input type="file" id="photo-{{ $user->id }}" name="photo" class="hidden" accept="image/*"
                            onchange="this.form.submit()">
                    </form>


                    <!-- Tombol Hapus -->
                    <form action="{{ route('users.delete-photo', $user->id) }}" method="POST" class="w-full"
                        onsubmit="return confirm('Yakin ingin menghapus foto user ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-sm text-[#7753AF] p-2.5 mt-6 border-2 border-[#7753AF] dark:border-gray-700 bg-transparent w-full rounded-xl dark:text-white focus:outline-none cursor-pointer flex items-center justify-center">
                            Hapus
                        </button>
                    </form>
                </div>

                {{-- <div class="flex flex-inline w-full gap-x-3 items-center justify-center">
                    <a href="{{ route('users.edit', $user->id) }}" title="Edit"
                        class="p-2.5 mt-6 border-2 border-[#7753AF] dark:border-gray-700 bg-[#7753AF] w-full rounded-xl dark:text-white focus:outline-none cursor-pointer flex items-center justify-center">
                        <span class="text-sm text-white">Ganti</span>
                    </a>
                    <a href="{{ route('users.edit', $user->id) }}" title="Edit"
                        class="p-2.5 mt-6 border-2 border-[#7753AF] dark:border-gray-700 bg-transparent w-full rounded-xl dark:text-white focus:outline-none cursor-pointer flex items-center justify-center">
                        <span class="text-sm text-[#7753AF]">Hapus</span>
                    </a>
                </div> --}}
            </div>

            <!-- INFORMASI -->
            <div class="md:col-span-3 flex flex-col gap-5">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <!-- INFORMASI PRIBADI -->
                    <div class="p-4 border border-[#E0E0E0] mb-3 rounded-xl dark:border-gray-700 dark:bg-white/5">
                        <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Pribadi</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mt-5">

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Nama Lengkap
                                </label>

                                <input type="text" name="full_name" value="{{ old('full_name', $user->full_name) }}"
                                    placeholder="Masukan nama lengkap"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('full_name') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('full_name')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('full_name')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                    Tanggal Lahir
                                </label>

                                <div class="relative">
                                    <input type="date" name="birth_date"
                                        value="{{ old('birth_date', $user->birth_date) }}" placeholder="Pilih tanggal"
                                        onclick="this.showPicker()"
                                        class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('birth_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                                fill="" />
                                        </svg>
                                    </span>
                                    @error('birth_date')
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
                                @error('birth_date')
                                    <p class="text-theme-xs text-error-500 mt-1.5">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                    Jenis Kelamin
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="gender"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('gender') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="male"
                                            {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Laki-laki
                                        </option>
                                        <option value="female"
                                            {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Perempuan
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
                                </div>

                                @error('gender')
                                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- INFORMASI AKADEMIK -->
                    <div class="p-4 border border-[#E0E0E0] mb-3 rounded-xl dark:border-gray-700 dark:bg-white/5">
                        <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Akademik</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-5">

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    NRP
                                </label>

                                <input type="text" name="nrp" value="{{ old('nrp', $user->nrp) }}"
                                    placeholder="Masukan nama lengkap" disabled
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md bg-gray-100 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('nrp') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('nrp')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('nrp')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Program Studi
                                </label>

                                <input type="text" name="major" value="{{ old('major', $user->major) }}"
                                    placeholder="Masukan program studi"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('major') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('major')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('major')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Angkatan
                                </label>

                                <input type="text" name="generation"
                                    value="{{ old('generation', $user->generation) }}" placeholder="Masukan nama lengkap"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('generation') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('generation')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('generation')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Tahun
                                </label>

                                <input type="text" name="batch" value="{{ old('batch', $user->batch) }}"
                                    placeholder="Masukan nama lengkap"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('batch') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('batch')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('batch')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- INFORMASI KONTAK -->
                    <div class="p-4 border border-[#E0E0E0] mb-3 rounded-xl dark:border-gray-700 dark:bg-white/5">
                        <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Kontak</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Email
                                </label>

                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    placeholder="Masukan nama lengkap"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('email') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('email')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('email')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    No Telp
                                </label>

                                <input type="text" name="phone_number"
                                    value="{{ old('phone_number', $user->phone_number) }}" placeholder="Masukan no telp"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('phone_number') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('phone_number')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('phone_number')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- INFORMASI AKUN -->
                    <div class="p-4 border border-[#E0E0E0] mb-3 rounded-xl dark:border-gray-700 dark:bg-white/5">
                        <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi Akun</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 mt-5">

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Role
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="role"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('role') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Admin
                                        </option>
                                        <option value="logistics"
                                            {{ old('role', $user->role) == 'logistics' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Logistik
                                        </option>
                                        <option value="member"
                                            {{ old('role', $user->role) == 'member' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Anggota
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
                                </div>

                                @error('role')
                                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Status
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="status"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('status') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="active"
                                            {{ old('status', $user->status) == 'active' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Aktif
                                        </option>
                                        <option value="inactive"
                                            {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Tidak Aktif
                                        </option>
                                        <option value="alumni"
                                            {{ old('status', $user->status) == 'alumni' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Alumni
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
                                </div>

                                @error('status')
                                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                    Jabatan
                                </label>
                                <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                    <select name="position"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('position') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">
                                        <option value="leader"
                                            {{ old('position', $user->position) == 'leader' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Ketua
                                        </option>
                                        <option value="secretary"
                                            {{ old('position', $user->position) == 'secretary' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Sekretaris
                                        </option>
                                        <option value="logistics"
                                            {{ old('position', $user->position) == 'logistics' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Logistik
                                        </option>
                                        <option value="member"
                                            {{ old('position', $user->position) == 'member' ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            Anggota
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
                                </div>

                                @error('position')
                                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>


                            <div>
                                <label
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                    Kata Sandi
                                </label>
                                <div x-data="{ showPassword: false }" class="relative">
                                    <input :type="showPassword ? 'text' : 'password'" name="password"
                                        value="{{ old('password') }}" placeholder="Masukan kata sandi"
                                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-6 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('password') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror" />

                                    <!-- Tombol tampil/sembunyikan password -->
                                    <span @click="showPassword = !showPassword"
                                        class="absolute top-1/2 right-4 z-30 -translate-y-5/6 cursor-pointer">
                                        <!-- Icon Mata Tertutup -->
                                        <svg x-show="!showPassword" class="fill-gray-500 dark:fill-gray-400"
                                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M10.0002 13.8619C7.23361 13.8619 4.86803 12.1372 3.92328 9.70241C4.86804 7.26761 7.23361 5.54297 10.0002 5.54297C12.7667 5.54297 15.1323 7.26762 16.0771 9.70243C15.1323 12.1372 12.7667 13.8619 10.0002 13.8619ZM10.0002 4.04297C6.48191 4.04297 3.49489 6.30917 2.4155 9.4593C2.3615 9.61687 2.3615 9.78794 2.41549 9.94552C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C13.5184 15.3619 16.5055 13.0957 17.5849 9.94555C17.6389 9.78797 17.6389 9.6169 17.5849 9.45932C16.5055 6.30919 13.5184 4.04297 10.0002 4.04297ZM9.99151 7.84413C8.96527 7.84413 8.13333 8.67606 8.13333 9.70231C8.13333 10.7286 8.96527 11.5605 9.99151 11.5605H10.0064C11.0326 11.5605 11.8646 10.7286 11.8646 9.70231C11.8646 8.67606 11.0326 7.84413 10.0064 7.84413H9.99151Z" />
                                        </svg>

                                        <!-- Icon Mata Terbuka -->
                                        <svg x-show="showPassword" class="fill-gray-500 dark:fill-gray-400"
                                            width="20" height="20" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M4.63803 3.57709C4.34513 3.2842 3.87026 3.2842 3.57737 3.57709C3.28447 3.86999 3.28447 4.34486 3.57737 4.63775L4.85323 5.91362C3.74609 6.84199 2.89363 8.06395 2.4155 9.45936C2.3615 9.61694 2.3615 9.78801 2.41549 9.94558C3.49488 13.0957 6.48191 15.3619 10.0002 15.3619C11.255 15.3619 12.4422 15.0737 13.4994 14.5598L15.3625 16.4229C15.6554 16.7158 16.1302 16.7158 16.4231 16.4229C16.716 16.13 16.716 15.6551 16.4231 15.3622L4.63803 3.57709ZM12.3608 13.4212L10.4475 11.5079C10.3061 11.5423 10.1584 11.5606 10.0064 11.5606H9.99151C8.96527 11.5606 8.13333 10.7286 8.13333 9.70237C8.13333 9.5461 8.15262 9.39434 8.18895 9.24933L5.91885 6.97923C5.03505 7.69015 4.34057 8.62704 3.92328 9.70247C4.86803 12.1373 7.23361 13.8619 10.0002 13.8619C10.8326 13.8619 11.6287 13.7058 12.3608 13.4212ZM16.0771 9.70249C15.7843 10.4569 15.3552 11.1432 14.8199 11.7311L15.8813 12.7925C16.6329 11.9813 17.2187 11.0143 17.5849 9.94561C17.6389 9.78803 17.6389 9.61696 17.5849 9.45938C16.5055 6.30925 13.5184 4.04303 10.0002 4.04303C9.13525 4.04303 8.30244 4.17999 7.52218 4.43338L8.75139 5.66259C9.1556 5.58413 9.57311 5.54303 10.0002 5.54303C12.7667 5.54303 15.1323 7.26768 16.0771 9.70249Z" />
                                        </svg>
                                    </span>
                                    <p class="text-xs text-[#616161] ml-1">Isi jika ubah sandi.</p>
                                </div>

                                @error('password')
                                    <p class="mt-1 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="flex justify-end items-center mt-4">
                        <div class="flex gap-3 w-56 justify-end items-center">
                            <!-- Tombol Batal -->
                            <a href="{{ route('users.index') }}" title="Hapus"
                                class="p-2.5 border-2 text-sm border-[#7753AF] bg-transparent w-full rounded-xl text-[#7753AF] text-center hover:bg-[#F3E8FF] transition">
                                Batal
                            </a>

                            <!-- Tombol Simpan -->
                            <button type="submit"
                                class="p-2.5 border-2 text-sm border-[#7753AF] bg-[#7753AF] w-full rounded-xl text-white text-center hover:bg-[#67419B] transition">
                                Simpan
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
