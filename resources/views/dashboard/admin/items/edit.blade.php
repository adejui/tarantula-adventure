@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Edit Alat</h3>

        <div class="">
            <div class="md:col-span-3 flex flex-col gap-5">

                <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <input type="hidden" name="code" value="{{ $item->code }}">

                    <input type="hidden" id="originalCategory" value="{{ $item->category_id }}">
                    <input type="hidden" id="originalCode" value="{{ $item->code }}">

                    <!-- Dropzone -->
                    <div>
                        <h3 class="font-semibold text-md text-[#212121] dark:text-white/90 mb-3">Foto</h3>

                        <div id="dropzone"
                            class="border border-gray-300 rounded-xl p-4 hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800 transition flex flex-wrap gap-4">

                            <!-- PREVIEW FOTO DARI DATABASE -->
                            @foreach ($item->photos as $p)
                                <div class="relative w-28 h-28 group">

                                    <img src="{{ Storage::url($p->photo_path) }}"
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

                            <!-- INPUT FILE REAL -->
                            <input type="file" id="fileInput" name="photos[]" multiple accept="image/*" class="hidden">
                        </div>

                        <input type="hidden" name="deleted_photos" id="deletedPhotosInput">
                    </div>
                    <script>
                        let deletedPhotos = [];

                        // Fix: file picker terbuka hanya sekali
                        function openFilePicker(event) {
                            event.stopPropagation(); // cegah klik menyebar
                            document.getElementById('fileInput').click();
                        }

                        function removeExistingImage(btn, photoId) {
                            deletedPhotos.push(photoId);
                            document.getElementById('deletedPhotosInput').value = JSON.stringify(deletedPhotos);
                            btn.parentElement.remove();
                        }

                        // Tampilkan preview gambar baru
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


                    <div class="p-4 border mt-4 border-[#E0E0E0] rounded-xl dark:border-gray-700 dark:bg-white/5 w-1/2">
                        <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Nama Alat
                                </label>

                                <input type="text" name="name" value="{{ old('name', $item->name) }}"
                                    placeholder="Masukan nama lengkap"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('name') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('name')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('name')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Kategori
                                </label>

                                <select id="categorySelect" name="category_id"
                                    class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs w-full rounded-lg border px-4 py-3 pr-11 dark:bg-gray-900 dark:text-white/90 border-gray-300 dark:border-gray-700">

                                    <option value="" disabled>Pilih kategori</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Kode
                                </label>
                                <input type="text" id="code" name="code" readonly value="{{ $item->code }}"
                                    class="dark:bg-gray-700 bg-gray-100 h-11 w-full rounded-lg border-0 focus:outline-0 px-4 py-3.5 text-xs text-gray-800 dark:text-white/90" />
                            </div>
                            <script>
                                document.getElementById('categorySelect').addEventListener('change', function() {
                                    const categoryId = this.value;

                                    const originalCategory = document.getElementById('originalCategory').value;
                                    const originalCode = document.getElementById('originalCode').value;

                                    // Jika kembali ke kategori awal → pakai kode lama
                                    if (categoryId == originalCategory) {
                                        document.getElementById('code').value = originalCode;
                                        return;
                                    }

                                    // Jika pilih kategori lain → generate kode baru
                                    fetch(`/items/generate-code/${categoryId}`)
                                        .then(res => res.json())
                                        .then(data => {
                                            document.getElementById('code').value = data.code;
                                        });
                                });
                            </script>

                            <div class="relative">
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Jumlah
                                </label>

                                <input type="text" name="quantity" value="{{ old('quantity', $item->quantity) }}"
                                    placeholder="Masukan nama lengkap"
                                    class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('quantity') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                                @error('quantity')
                                    <span class="absolute top-1/2 right-3.5 -translate-y-1/2">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M2.58325 7.99967C2.58325 5.00813 5.00838 2.58301 7.99992 2.58301C10.9915 2.58301 13.4166 5.00813 13.4166 7.99967C13.4166 10.9912 10.9915 13.4163 7.99992 13.4163C5.00838 13.4163 2.58325 10.9912 2.58325 7.99967ZM7.99992 1.08301C4.17995 1.08301 1.08325 4.17971 1.08325 7.99967C1.08325 11.8196 4.17995 14.9163 7.99992 14.9163C11.8199 14.9163 14.9166 11.8196 14.9166 7.99967C14.9166 4.17971 11.8199 1.08301 7.99992 1.08301ZM7.09932 5.01639C7.09932 5.51345 7.50227 5.91639 7.99932 5.91639H7.99999C8.49705 5.91639 8.89999 5.51345 8.89999 5.01639C8.89999 4.51933 8.49705 4.11639 7.99999 4.11639H7.99932C7.50227 4.11639 7.09932 4.51933 7.09932 5.01639ZM7.99998 11.8306C7.58576 11.8306 7.24998 11.4948 7.24998 11.0806V7.29627C7.24998 6.88206 7.58576 6.54627 7.99998 6.54627C8.41419 6.54627 8.74998 6.88206 8.74998 7.29627V11.0806C8.74998 11.4948 8.41419 11.8306 7.99998 11.8306Z"
                                                fill="#F04438" />
                                        </svg>
                                    </span>
                                @enderror
                                @error('quantity')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>

                        <div class="relative mb-4 mt-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Deskripsi
                            </label>
                            <textarea name="description" rows="6" placeholder="Masukan deskripsi"
                                class="text-[#212121] font-normal text-xs w-full rounded-lg border bg-transparent px-4 py-2.5 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('description') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror">{{ $item->description }}</textarea>
                            @error('description')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end items-center mt-4">
                            <div class="flex gap-3 w-56 justify-end items-center">
                                <!-- Tombol Batal -->
                                <a href="{{ route('items.index') }}" title="Hapus"
                                    class="p-2.5 border-2 text-sm border-[#7753AF] bg-transparent w-full rounded-xl text-[#7753AF] text-center hover:bg-[#F3E8FF] transition">
                                    Kembali
                                </a>

                                <!-- Tombol Simpan -->
                                <button type="submit"
                                    class="p-2.5 border-2 text-sm border-[#7753AF] bg-[#7753AF] w-full rounded-xl text-white text-center hover:bg-[#67419B] transition">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
