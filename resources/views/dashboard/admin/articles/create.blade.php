@extends('dashboard.layouts.app')

@section('content')
    <x-breadcrumb :items="[['label' => 'Artikel', 'url' => route('articles.index')], ['label' => 'Tambah Artikel']]" />

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl items-start h-auto p-8 overflow-visibles  dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Tambah Artikel</h3>

        <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
            @csrf

            <input type="hidden" name="content" id="content-input">


            <div class="grid sm:grid-cols-2 gap-5">

                <div>
                    <div class="relative mb-4">
                        <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                            Judul
                        </label>

                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukan judul"
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

                    <div class="mb-4">
                        <label class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                            Jenis Kegiatan
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                            <select name="activity_id"
                                class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('activity_id') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                @change="isOptionSelected = true">
                                <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    --pilih kegiatan--
                                </option>

                                @forelse ($activities as $activity)
                                    <option value="{{ $activity->id }}"
                                        class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                        {{ $activity->title }}
                                    </option>
                                @empty
                                @endforelse
                            </select>

                            <span
                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        @error('activity_id')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                            Status
                        </label>
                        <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                            <select name="status"
                                class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('status') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                @change="isOptionSelected = true">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Draft
                                </option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}
                                    class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                    Published
                                </option>
                            </select>

                            <span
                                class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </div>

                        @error('status')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="file_path"
                            class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                            Thumbnail
                        </label>

                        <div class="relative">
                            <input type="file" name="file_path"
                                class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 w-full overflow-hidden rounded-lg border bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3.5 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/3 dark:file:text-gray-400 dark:placeholder:text-gray-400 @error('file_path') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 dark:border-gray-700 @enderror" />

                            @error('file_path')
                                <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                            fill="#F04438" />
                                    </svg>
                                </span>
                            @enderror
                        </div>

                        @error('file_path')
                            <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                        Isi
                    </label>

                    <div id="editor-wrapper">
                        <div id="editor"></div>
                    </div>

                    <script>
                        var quill = new Quill('#editor', {
                            theme: 'snow'
                        });
                    </script>
                </div>



            </div>
            <div class="flex justify-end items-center w-auto mt-8">
                <div class="flex gap-5 justify-end items-center">
                    <!-- Tombol Batal -->
                    <a href="{{ route('articles.index') }}" title="Hapus"
                        class="p-2 border-2 text-sm border-[#7753AF] bg-transparent rounded-lg text-[#7753AF] text-center hover:bg-[#F3E8FF] transition">
                        Batal
                    </a>

                    <!-- Tombol Simpan -->
                    <button type="submit"
                        class="p-2 border-2 text-sm border-[#7753AF] bg-[#7753AF] rounded-lg text-white text-center hover:bg-[#67419B] transition">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
