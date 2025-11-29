@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Kelola Peminjaman</h3>

        <div class="grid sm:grid-cols-2 gap-4 items-start">

            <div class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                <div class="mb-6 flex items-center justify-between h-auto">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                        Data Peminjaman
                    </h3>
                </div>

                <div>

                    <form action="{{ route('loans.update', $loan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div class="grid sm:grid-cols-2 gap-2 mb-4">
                            <div>
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Nama OPA
                                </label>

                                <div x-data="{ isOptionSelected: {{ old('opa_id', $loan->opa_id ?? null) ? 'true' : 'false' }} }" class="relative z-20 bg-transparent">

                                    <select name="opa_id"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs
                    w-full appearance-none rounded-lg border px-4 py-3 pr-11
                    placeholder:text-gray-400 focus:ring-3 focus:outline-hidden
                    dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                    @error('opa_id') border-error-500 dark:border-error-500
                    @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">

                                        <option value="">--pilih opa--</option>

                                        @foreach ($opas as $opa)
                                            <option value="{{ $opa->id }}"
                                                {{ old('opa_id', $loan->opa_id ?? null) == $opa->id ? 'selected' : '' }}>
                                                {{ $opa->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                @error('opa_id')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Nama Anggota
                                </label>

                                <div x-data="{ isOptionSelected: {{ old('user_id', $loan->user_id ?? null) ? 'true' : 'false' }} }" class="relative z-20 bg-transparent">

                                    <select name="user_id"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs
                    w-full appearance-none rounded-lg border px-4 py-3 pr-11
                    placeholder:text-gray-400 focus:ring-3 focus:outline-hidden
                    dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30
                    @error('user_id') border-error-500 dark:border-error-500
                    @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                        @change="isOptionSelected = true">

                                        <option value="">--pilih anggota--</option>

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('user_id', $loan->user_id ?? null) == $user->id ? 'selected' : '' }}>
                                                {{ $user->full_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>

                                @error('user_id')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            @php
                                $statusList = [
                                    'requested' => 'Diajukan',
                                    'approved' => 'Disetujui',
                                    'borrowed' => 'Dipinjam',
                                    'returned' => 'Dikembalikan',
                                    'rejected' => 'Ditolak',
                                    'late' => 'Terlambat',
                                ];
                            @endphp
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md text-md dark:text-gray-400">
                                Status
                            </label>
                            <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                                <select name="status"
                                    class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 ttext-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 @error('status') border-error-500 dark:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror"
                                    :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                                    @change="isOptionSelected = true">
                                    @foreach ($statusList as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ old('status', $loan->status ?? null) == $value ? 'selected' : '' }}
                                            class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                                            {{ $label }}
                                        </option>
                                    @endforeach
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
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Pinjam
                            </label>

                            <div class="relative">
                                <input type="date" name="borrow_date"
                                    value="{{ old('borrow_date', $loan->borrow_date) }}" placeholder="Pilih tanggal"
                                    onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('borrow_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('borrow_date')
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
                            @error('borrow_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label
                                class="text-[#616161] font-medium text-xs mb-2 block text-md text-md  dark:text-gray-400">
                                Tanggal Kembali
                            </label>

                            <div class="relative">
                                <input type="date" name="return_date"
                                    value="{{ old('return_date', $loan->return_date) }}" placeholder="Pilih tanggal"
                                    onclick="this.showPicker()"
                                    class="h-11 w-full appearance-none rounded-lg border bg-transparent bg-none px-4 py-1.5 pr-11 pl-4 text-xs text-gray-800 placeholder:text-gray-400 shadow-theme-xs focus:ring-3 focus:outline-hidden @error('return_date') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 focus:border-brand-300 focus:ring-brand-500/10 dark:border-gray-700 dark:focus:border-brand-800 @enderror dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                                <span
                                    class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 20 20"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                                            fill="" />
                                    </svg>
                                </span>
                                @error('return_date')
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
                            @error('return_date')
                                <p class="text-theme-xs text-error-500 mt-1.5">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Catatan
                            </label>
                            <textarea name="notes" rows="4" placeholder="Masukan deskripsi"
                                class="text-[#212121] font-normal text-xs w-full rounded-lg border bg-transparent px-4 py-2.5 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('notes') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror">{{ $loan->notes }}</textarea>
                            @error('notes')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-7">
                            <label for="loan_document"
                                class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                File Dokumen
                            </label>

                            <div class="relative">
                                <input type="file" name="loan_document"
                                    class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 w-full overflow-hidden rounded-lg border bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3.5 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/3 dark:file:text-gray-400 dark:placeholder:text-gray-400 @error('loan_document') border-error-500 focus:border-red-500 focus:ring-red-500/10 dark:border-error-500 dark:focus:border-red-500 @else border-gray-300 dark:border-gray-700 @enderror" />

                                @error('loan_document')
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

                            @error('loan_document')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-y-1 w-fit justify-center mb-5">
                            <p class="text-theme-xs text-gray-500 dark:text-gray-400">Dokumen</p>

                            @if ($loan->loan_document)
                                <a href="{{ asset('storage/loanDocuments/' . basename($loan->loan_document)) }}"
                                    target="_blank"
                                    class="block text-theme-sm font-medium text-brand-600 hover:underline dark:text-brand-400">
                                    {{ basename($loan->loan_document) }}
                                </a>
                            @else
                                <p class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                    Tidak ada dokumen
                                </p>
                            @endif
                        </div>


                        <div class="flex justify-end items-center w-full mt-8">
                            <div class="flex gap-5 w-full justify-end items-center">

                                <button type="submit"
                                    class="mt-5 py-1.5 px-4 border-2 text-theme-xs border-[#7753AF] bg-[#7753AF] rounded-lg text-white text-center hover:bg-[#67419B] transition">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>


                </div>

            </div>

            <div class="flex flex-col">

                <!-- Tambah Alat Dipinjam -->
                <div
                    class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Tambah Alat Dipinjam
                        </h3>
                    </div>

                    <div class="custom-scrollbar max-w-full overflow-x-auto">
                        <div class="w-full flex flex-col gap-2">
                            <div x-data="loanItems()" x-init="init()">

                                <form x-ref="formItems" method="POST" action="{{ route('loan-details.store') }}">
                                    @csrf
                                    <input type="hidden" name="loan_id" value="{{ $loan->id }}">
                                </form>

                                <div class="flex justify-between items-center mb-3">
                                    <div class="flex items-center gap-2">
                                        <div @click="toggleAll()"
                                            class="flex cursor-pointer items-center gap-2 rounded-lg p-3 hover:bg-gray-50 dark:hover:bg-white/3">
                                            <div class="flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]"
                                                :class="selectAll ? 'border-brand-500 bg-brand-500' : 'bg-white border-gray-500'">
                                                <svg :class="selectAll ? 'block' : 'hidden'" width="14"
                                                    height="14">
                                                    <path d="M11.6 3.5L5.2 9.9L2.3 7" stroke="white" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </div>
                                            <span
                                                class="block text-theme-xs font-medium text-gray-700 dark:text-gray-400">Pilih
                                                Semua</span>
                                        </div>

                                        <select x-model="filterCategory" @change="applyFilter()"
                                            class="border rounded-lg p-2 text-theme-xs outline-1 outline-gray-300 font-medium text-gray-700 dark:text-gray-400">
                                            <option value="">Semua Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="button" @click="submitForm()"
                                        class="py-1.5 px-4 border-2 text-theme-xs border-[#7753AF] bg-[#7753AF] rounded-lg text-white hover:bg-[#67419B] transition">
                                        Simpan
                                    </button>
                                </div>

                                <!-- List Item -->
                                <div
                                    class="flex flex-col gap-2 max-h-[280px] custom-scrollbar h-auto overflow-y-auto pr-3">
                                    <template x-for="item in filteredItems" :key="item.id">
                                        <div class="flex flex-col gap-1">
                                            <!-- Item row -->
                                            <div @click="toggleItem(item.id)"
                                                class="flex cursor-pointer items-center gap-9 rounded-lg p-3 hover:bg-gray-50 dark:hover:bg-white/3">
                                                <div class="flex items-start gap-3">
                                                    <div class="flex h-5 w-5 items-center justify-center rounded-md border-[1.25px]"
                                                        :class="selectedMap[item.id] ? 'border-brand-500 bg-brand-500' :
                                                            'bg-white border-gray-500'">
                                                        <svg :class="selectedMap[item.id] ? 'block' : 'hidden'"
                                                            width="14" height="14" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path d="M11.6 3.5L5.2 9.9L2.3 7" stroke="white"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div>
                                                    <span
                                                        class="block text-theme-sm font-medium text-gray-700 dark:text-gray-400"
                                                        x-text="item.name"></span>
                                                    <span class="text-theme-xs text-gray-500 dark:text-gray-400"
                                                        x-text="`${item.category.name} - Stok: ${item.quantity}`"></span>
                                                </div>
                                            </div>

                                            <!-- Quantity input -->
                                            <div x-show="selectedMap[item.id]" x-transition class="ml-12 mb-2">
                                                <label class="text-theme-xs text-gray-600 dark:text-gray-400">Jumlah
                                                    Dipinjam</label>
                                                <input type="number" min="1" :max="item.quantity"
                                                    class="w-24 mt-1 px-2 py-1 border text-sm rounded-lg dark:text-white dark:bg-neutral-500 dark:border-gray-600"
                                                    x-model="quantityMap[item.id]">
                                            </div>
                                        </div>
                                    </template>

                                    <div x-show="filteredItems.length === 0" class="text-gray-500 text-sm p-3">
                                        Tidak ada alat pada kategori ini.
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <script>
                        function loanItems() {
                            return {
                                rawItems: @json($items),
                                selectedItems: @json($selectedItems),
                                loanDetailsQuantity: @json($loanDetailsQuantity),
                                selectedMap: {},
                                quantityMap: {},
                                filterCategory: '',
                                filteredItems: [],
                                selectAll: false,

                                init() {
                                    this.rawItems.forEach(item => {
                                        this.selectedMap[item.id] = this.selectedItems.includes(item.id);
                                        this.quantityMap[item.id] = this.loanDetailsQuantity[item.id] ?? 1;
                                    });
                                    this.applyFilter();
                                },

                                applyFilter() {
                                    this.filteredItems = this.filterCategory === '' ?
                                        this.rawItems :
                                        this.rawItems.filter(i => i.category_id == this.filterCategory);
                                    this.selectAll = this.filteredItems.every(i => this.selectedMap[i.id] === true);
                                },

                                toggleAll() {
                                    this.selectAll = !this.selectAll;
                                    this.filteredItems.forEach(i => {
                                        this.selectedMap[i.id] = this.selectAll;
                                        if (this.quantityMap[i.id] === undefined) this.quantityMap[i.id] = 1;
                                    });
                                },

                                toggleItem(id) {
                                    this.selectedMap[id] = !this.selectedMap[id];
                                    if (this.quantityMap[id] === undefined) this.quantityMap[id] = 1;
                                    this.selectAll = this.filteredItems.every(i => this.selectedMap[i.id] === true);
                                },

                                submitForm() {
                                    const form = this.$refs.formItems;

                                    // Hapus semua input lama supaya data lama tidak terkirim
                                    form.querySelectorAll('input[name^="item_ids"], input[name^="quantity"]').forEach(el => el.remove());

                                    let hasSelected = false;

                                    // Kirim semua item yang dipilih beserta quantity terbaru
                                    Object.keys(this.selectedMap).forEach(id => {
                                        if (this.selectedMap[id]) {
                                            hasSelected = true;

                                            const inputId = document.createElement('input');
                                            inputId.type = 'hidden';
                                            inputId.name = 'item_ids[]';
                                            inputId.value = id;
                                            form.appendChild(inputId);

                                            const inputQty = document.createElement('input');
                                            inputQty.type = 'hidden';
                                            inputQty.name = `quantity[${id}]`;
                                            inputQty.value = this.quantityMap[id];
                                            form.appendChild(inputQty);
                                        }
                                    });

                                    if (hasSelected) {
                                        form.submit(); // backend akan delete data lama & insert yang terbaru
                                    } else {
                                        alert('Tidak ada item yang dipilih.');
                                    }
                                }
                            }
                        }
                    </script>

                </div>

                <!-- Rincian Alat Dipinjam -->
                <div
                    class="rounded-2xl mb-4 border border-gray-200 bg-white p-5 dark:border-gray-800 dark:bg-white/3 sm:p-6">
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Rincian Alat Dipinjam
                        </h3>

                        <div x-data="{ openDropDown: false }" class="relative">
                            <button @click="openDropDown = !openDropDown"
                                :class="openDropDown ? 'text-gray-700 dark:text-white' :
                                    'text-gray-400 hover:text-gray-700 dark:hover:text-white'">
                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M10.2441 6C10.2441 5.0335 11.0276 4.25 11.9941 4.25H12.0041C12.9706 4.25 13.7541 5.0335 13.7541 6C13.7541 6.9665 12.9706 7.75 12.0041 7.75H11.9941C11.0276 7.75 10.2441 6.9665 10.2441 6ZM10.2441 18C10.2441 17.0335 11.0276 16.25 11.9941 16.25H12.0041C12.9706 16.25 13.7541 17.0335 13.7541 18C13.7541 18.9665 12.9706 19.75 12.0041 19.75H11.9941C11.0276 19.75 10.2441 18.9665 10.2441 18ZM11.9941 10.25C11.0276 10.25 10.2441 11.0335 10.2441 12C10.2441 12.9665 11.0276 13.75 11.9941 13.75H12.0041C12.9706 13.75 13.7541 12.9665 13.7541 12C13.7541 11.0335 12.9706 10.25 12.0041 10.25H11.9941Z"
                                        fill="" />
                                </svg>
                            </button>
                            <div x-show="openDropDown" @click.outside="openDropDown = false"
                                class="absolute right-0 top-full z-40 w-40 space-y-1 rounded-2xl border border-gray-200 bg-white p-2 shadow-theme-lg dark:border-gray-800 dark:bg-gray-dark">
                                <button
                                    class="flex w-full rounded-lg px-3 py-2 text-left text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                    View More
                                </button>
                                <button
                                    class="flex w-full rounded-lg px-3 py-2 text-left text-theme-xs font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700 dark:text-gray-400 dark:hover:bg-white/5 dark:hover:text-gray-300">
                                    Delete
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="flex h-[372px] flex-col">
                        <div class="custom-scrollbar flex h-auto flex-col overflow-y-auto pr-3">

                            @forelse ($loan->details as $detail)
                                <div
                                    class="flex items-center justify-between border-b border-gray-200 pb-4 pt-4 first:pt-0 last:border-b-0 last:pb-0 dark:border-gray-800">
                                    <div class="flex items-center gap-3">
                                        <div class="h-10 w-10">
                                            @php
                                                $photo = $detail->item->photos->first();
                                                $image = $photo
                                                    ? Storage::url($photo->photo_path)
                                                    : asset('assets/images/default.png');
                                            @endphp
                                            <img src="{{ $image }}" alt="item photo"
                                                class="h-full w-full object-cover rounded">
                                        </div>

                                        <div>
                                            <h3 class="text-base font-semibold text-gray-800 dark:text-white/90">
                                                {{ $detail->item->name }}
                                            </h3>
                                            <span class="block text-theme-xs text-gray-500 dark:text-gray-400">
                                                {{ $detail->item->category->name }} | {{ $detail->item->code }}
                                            </span>
                                        </div>
                                    </div>

                                    <div>
                                        <div>
                                            <h4
                                                class="mb-1 text-right text-theme-sm font-medium text-gray-700 dark:text-gray-400">
                                                {{ $detail->quantity }}
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-gray-500 text-sm p-3">
                                    Tidak ada alat dipinjam.
                                </div>
                            @endforelse

                        </div>
                    </div>

                </div>

            </div>

        </div>



    </div>
@endsection
