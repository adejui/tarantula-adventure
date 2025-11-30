@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <x-breadcrumb :items="[
        ['label' => 'Inventoris', 'url' => route('items.index')],
        ['label' => 'Daftar Alat', 'url' => route('items.index')],
    ]" />


    <div x-data="{
        showForm: {{ $errors->any() ? 'true' : 'false' }},
    }">

        <div x-data="{ showFilter: false }">
            <div
                class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
                <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Daftar Alat</h3>

                <div class="flex justify-between items-center my-2">
                    {{-- Search --}}
                    <div class="hidden lg:max-w-[430px] md:block">
                        <div class="relative">
                            <span class="absolute top-1/2 left-4 -translate-y-1/2">
                                <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20"
                                    viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M3.04175 9.37363C3.04175 5.87693 5.87711 3.04199 9.37508 3.04199C12.8731 3.04199 15.7084 5.87693 15.7084 9.37363C15.7084 12.8703 12.8731 15.7053 9.37508 15.7053C5.87711 15.7053 3.04175 12.8703 3.04175 9.37363ZM9.37508 1.54199C5.04902 1.54199 1.54175 5.04817 1.54175 9.37363C1.54175 13.6991 5.04902 17.2053 9.37508 17.2053C11.2674 17.2053 13.003 16.5344 14.357 15.4176L17.177 18.238C17.4699 18.5309 17.9448 18.5309 18.2377 18.238C18.5306 17.9451 18.5306 17.4703 18.2377 17.1774L15.418 14.3573C16.5365 13.0033 17.2084 11.2669 17.2084 9.37363C17.2084 5.04817 13.7011 1.54199 9.37508 1.54199Z" />
                                </svg>
                            </span>
                            <input type="text" placeholder="Search" id="search-input"
                                class="dark:bg-dark-900 shadow-theme-xs focus:border-[#7653afaa] focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-sm rounded-lg border-2 border-gray-300 bg-transparent py-2.5 pr-14 pl-12 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-800 dark:bg-white/3 dark:text-white/90 dark:placeholder:text-white/30" />
                        </div>
                    </div>

                    {{-- Filter & Tambah --}}
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 text-xs">
                            <span class="dark:text-white">Showing</span>

                            <div class="relative">
                                <select id="perPageSelect" name="perPage"
                                    class="appearance-none border border-gray-300 rounded-lg ps-3 pe-8 py-2.5 focus:outline-hidden dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800 text-sm">
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25</option>
                                </select>
                                <img src="{{ asset('assets/images/icons/chevron-down.svg') }}" alt="arrow light"
                                    class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 w-4 h-4 opacity-70 block dark:hidden">
                                <img src="{{ asset('assets/images/icons/chevron-down-dark.svg') }}" alt="arrow dark"
                                    class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 w-4 h-4 opacity-80 hidden dark:block">
                            </div>
                        </div>

                        <!-- Tombol Filter -->
                        <button @click="showFilter = !showFilter" type="button"
                            :class="showFilter
                                ?
                                'bg-[#7653afaa] text-white border-0 dark:bg-[#7653afaa] dark:border-[#7653afaa] dark:text-white' :
                                'bg-white text-gray-700 border-gray-300 hover:bg-gray-50 hover:text-gray-800 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-700 dark:hover:bg-white/3 dark:hover:text-gray-200'"
                            class="hidden md:inline-flex items-center gap-2 border rounded-lg px-4 py-2.5 text-sm font-medium shadow-theme-xs transition">

                            <!-- Icon saat tidak aktif -->
                            <img x-show="!showFilter" src="{{ asset('assets/images/icons/funnell.svg') }}"
                                alt="Filter Icon Light" class="w-4 h-4 opacity-70 block dark:hidden">
                            <img x-show="!showFilter" src="{{ asset('assets/images/icons/funnel-darkk.svg') }}"
                                alt="Filter Icon Dark" class="w-4 h-4 opacity-80 hidden dark:block">

                            <!-- Icon saat aktif -->
                            <img x-show="showFilter" src="{{ asset('assets/images/icons/funnell-dark.svg') }}"
                                alt="Filter Icon Active Light" class="w-4 h-4 opacity-90 block">

                            <span class="text-sm font-medium">Filter</span>
                        </button>

                        <button @click="showForm = true"
                            class="inline-flex items-center gap-2 px-4 h-10 text-sm font-medium text-white bg-[#7653afaa] transition rounded-lg shadow-theme-xs hover:bg-[#68489C]">
                            <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="Tambah" class="h-4 w-4">
                            Tambah
                        </button>
                    </div>
                </div>
            </div>

            <!-- Filter Section -->
            <div x-show="showFilter" x-transition
                class="bg-white border border-[#E0E0E0] rounded-xl h-auto mt-2 p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
                <div class="flex justify-start items-center my-2 gap-x-5">

                    <div class="hs-dropdown [--auto-close:inside] relative">
                        <div class="flex flex-col">
                            <span class="font-medium text-sm mb-1 dark:text-white">Kategori</span>
                            <button id="categoryDropdownBtn" type="button"
                                class="hs-dropdown-toggle py-3 w-52 px-4 inline-flex items-center justify-between gap-x-2 text-sm font-normal rounded-lg border border-gray-300 bg-white text-gray-800 shadow-2xs focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-white/3 dark:hover:text-gray-200 dark:focus:bg-gray-800"
                                aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                {{ ucfirst(request('category', 'Semua Kategori')) }}
                                <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg"
                                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>
                        </div>

                        <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="categoryDropdownBtn">
                            <div class="p-1 space-y-0.5">
                                <button type="button" data-value="all"
                                    class="category-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                    Semua Kategori
                                </button>

                                @foreach ($categories as $category)
                                    <button type="button" data-value="{{ $category->id }}"
                                        class="category-option flex items-center w-full gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700">
                                        {{ $category->name }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <button id="resetFiltersBtn"
                        class="px-3 mt-6 py-3 border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium flex items-center gap-2 dark:bg-gray-800 dark:border dark:border-gray-700 dark:divide-gray-700 dark:hover:bg-gray-600 dark:text-gray-200 transition-colors">
                        <img src="{{ asset('assets/images/icons/rotate-cw.svg') }}" alt="reset light"
                            class="w-4 h-4 opacity-70 block dark:hidden">
                        <img src="{{ asset('assets/images/icons/rotate-cw-dark.svg') }}" alt="reset dark"
                            class="w-4 h-4 opacity-80 hidden dark:block">
                        <span class="text-gray-700 dark:text-gray-400">Reset</span>
                    </button>

                </div>
            </div>

        </div>

        <div
            class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 mt-3.5 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
            <div class="w-full overflow-x-auto">
                <div id="item-table">
                    @include('dashboard.admin.items.partials.table')
                </div>
            </div>
        </div>

        <template x-teleport="body">
            <div x-cloak x-show="showForm" class="fixed inset-0 z-index flex items-center justify-end">
                <div class="absolute inset-0 bg-black/50" @click="showForm = false"></div>

                <div x-show="showForm" x-transition:enter="transform transition ease-in-out duration-500"
                    x-transition:enter-start="translate-x-full opacity-0"
                    x-transition:enter-end="translate-x-0 opacity-100"
                    class="relative mr-8 z-index bg-white dark:bg-gray-800 w-full sm:w-[500px] max-h-[90vh] my-10 shadow-2xl border border-gray-200 dark:border-neutral-700 p-6 overflow-y-auto rounded-2xl scrollbar-hide">

                    <div class="flex justify-between items-center pb-3 mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">Form Alat</h2>
                        <button @click="showForm = false"
                            class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                    </div>

                    <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Nama Alat
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                placeholder="Masukan nama alat"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('name') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 dark:focus:border-brand-800 @enderror" />
                            @error('name')
                                <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-data="{
                            isOptionSelected: false,
                            category_id: '',
                            code: '',
                            async updateCode() {
                                if (!this.category_id) return this.code = '';
                                const res = await fetch(`/items/generate-code/${this.category_id}`);
                                const data = await res.json();
                                this.code = data.code;
                            }
                        }" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                            {{-- Kategori --}}
                            <div>
                                <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Kategori
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select name="category_id" x-model="category_id"
                                        @change="isOptionSelected = true; updateCode();"
                                        class="text-[#212121] font-normal text-xs dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full appearance-none rounded-lg border bg-none px-4 py-3 pr-11 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 
                @error('category_id') border-error-500 dark:border-error-500 
                @else border-gray-300 dark:border-gray-700 @enderror"
                                        :class="isOptionSelected && 'text-gray-800 dark:text-white/90'">
                                        <option value="">--pilih kategori--</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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

                                @error('category_id')
                                    <p class="text-theme-xs text-error-500 mt-1.5">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kode --}}
                            <div>
                                <label for="code"
                                    class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                    Kode
                                </label>
                                <input type="text" name="code" id="code" x-model="code" readonly
                                    placeholder="Otomatis terisi"
                                    class="dark:bg-dark-900 dark:border-0 bg-gray-100 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border bg-none px-4 py-3.5 text-xs text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:text-white/90 dark:placeholder:text-white/30" />
                            </div>
                        </div>


                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Jumlah
                            </label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}"
                                placeholder="Masukan jumlah"
                                class="text-[#212121] font-normal text-xs dark:text-white/90 h-11 w-full rounded-lg border px-4 py-2.5 pr-10 text-md placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:bg-gray-900 dark:placeholder:text-white/30 focus:border-brand-300 focus:ring-brand-500/10 @error('quantity') border-error-500 focus:border-error-500 focus:ring-error-500/10 dark:border-error-500 dark:focus:border-error-500 @else border-gray-300 dark:border-gray-700 @enderror" />
                            @error('quantity')
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

                        <!-- Dropzone -->
                        <label for=""
                            class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">Foto
                            Alat</label>
                        <div id="dropzone"
                            class="border-2 border-dashed border-gray-300 rounded-xl p-2 text-center cursor-pointer hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-800 transition"
                            onclick="document.getElementById('fileInput').click()">
                            <div id="preview" class="flex flex-wrap justify-center gap-3 mb-3"></div>
                            <div class="flex flex-col items-center text-gray-600 dark:text-gray-400">
                                <svg class="w-10 h-10 mb-3 text-gray-400 dark:text-gray-500" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6H16a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="font-medium">Tarik atau klik untuk upload gambar</p>
                                <p class="text-sm text-gray-400 dark:text-gray-500">Format: JPG, PNG, WEBP, SVG — Max 2MB
                                </p>
                            </div>
                            <input type="file" id="fileInput" name="photos[]" multiple accept="image/*"
                                class="hidden">
                        </div>

                        @error('photos')
                            <p class="text-sm text-red-500 mt-2 text-center">{{ $message }}</p>
                        @enderror

                        <script>
                            const dropzone = document.getElementById('dropzone');
                            const input = document.getElementById('fileInput');
                            const preview = document.getElementById('preview');
                            let filesArray = [];

                            dropzone.addEventListener('dragover', e => {
                                e.preventDefault();
                                dropzone.classList.add('bg-gray-100', 'dark:bg-gray-800');
                            });
                            dropzone.addEventListener('dragleave', () => {
                                dropzone.classList.remove('bg-gray-100', 'dark:bg-gray-800');
                            });
                            dropzone.addEventListener('drop', e => {
                                e.preventDefault();
                                dropzone.classList.remove('bg-gray-100', 'dark:bg-gray-800');
                                addFiles(e.dataTransfer.files);
                            });
                            input.addEventListener('change', e => addFiles(e.target.files));

                            function addFiles(newFiles) {
                                for (let file of newFiles) {
                                    if (!filesArray.find(f => f.name === file.name && f.size === file.size)) {
                                        filesArray.push(file);
                                    }
                                }
                                renderPreview();
                            }

                            function renderPreview() {
                                preview.innerHTML = "";
                                filesArray.forEach((file, index) => {
                                    const reader = new FileReader();
                                    reader.onload = e => {
                                        const wrapper = document.createElement('div');
                                        wrapper.classList = "relative";

                                        const img = document.createElement('img');
                                        img.src = e.target.result;
                                        img.classList =
                                            "w-20 h-20 object-cover rounded-lg border border-gray-300 dark:border-gray-700";

                                        const removeBtn = document.createElement('button');
                                        removeBtn.innerHTML = "×";
                                        removeBtn.type = "button";
                                        removeBtn.classList =
                                            "absolute top-0 right-0 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-600";
                                        removeBtn.addEventListener('click', (ev) => {
                                            ev.stopPropagation();
                                            filesArray.splice(index, 1);
                                            updateInputFiles();
                                            renderPreview();
                                        });

                                        wrapper.appendChild(img);
                                        wrapper.appendChild(removeBtn);
                                        preview.appendChild(wrapper);
                                    };
                                    reader.readAsDataURL(file);
                                });
                                updateInputFiles();
                            }

                            function updateInputFiles() {
                                const dataTransfer = new DataTransfer();
                                filesArray.forEach(file => dataTransfer.items.add(file));
                                input.files = dataTransfer.files;
                            }
                        </script>

                        <div class="flex justify-end items-center w-full mt-8">
                            <div class="flex gap-5 w-full justify-end items-center">
                                <a href="{{ route('items.index') }}"
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector("#search-input");
            const tableContainer = document.querySelector("#item-table");
            const perPageSelect = document.querySelector("#perPageSelect");
            const categoryButtons = document.querySelectorAll(".category-option");
            const categoryBtnLabel = document.querySelector("#categoryDropdownBtn");
            const resetBtn = document.querySelector("#resetFiltersBtn");

            let searchTimeout = null;
            let currentCategory = "{{ request('category', 'all') }}";

            async function fetchData(url = "{{ route('items.index') }}") {
                const params = new URLSearchParams({
                    search: searchInput.value,
                    perPage: perPageSelect.value,
                    category: currentCategory,
                });

                if (url.includes("?")) {
                    const baseUrl = url.split("?")[0];
                    const existingParams = new URLSearchParams(url.split("?")[1]);
                    existingParams.set("search", searchInput.value);
                    existingParams.set("perPage", perPageSelect.value);
                    existingParams.set("category", currentCategory);
                    url = `${baseUrl}?${existingParams.toString()}`;
                } else {
                    url = `${url}?${params.toString()}`;
                }

                const response = await fetch(url, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
                });
                const html = await response.text();
                tableContainer.innerHTML = html;

                // 🧠 Tambahkan ini supaya modal & komponen aktif lagi
                if (window.HSStaticMethods) {
                    window.HSStaticMethods.autoInit();
                }

                // 🧩 Tambahkan ulang event listener untuk form delete (karena DOM diganti)
                initDeleteForms();
            }

            // Fungsi untuk inisialisasi ulang tombol/form delete
            function initDeleteForms() {
                const deleteForms = document.querySelectorAll('form.btn-delete');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(e) {
                        const confirmed = confirm('Yakin ingin menghapus data ini?');
                        if (!confirmed) e.preventDefault();
                    });
                });
            }

            // Jalankan sekali di awal
            initDeleteForms();

            // 🔍 Pencarian otomatis
            searchInput.addEventListener("input", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => fetchData(), 300);
            });

            // Ganti jumlah per halaman
            perPageSelect.addEventListener("change", function() {
                fetchData();
            });

            // Filter Kategori
            categoryButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    currentCategory = this.dataset.value;
                    categoryBtnLabel.innerHTML = this.textContent + `
            <svg class='hs-dropdown-open:rotate-180 size-4' xmlns='http://www.w3.org/2000/svg'
                width='24' height='24' viewBox='0 0 24 24' fill='none'
                stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                <path d='m6 9 6 6 6-6'/>
            </svg>`;
                    fetchData();
                });
            });

            // Pagination AJAX
            document.addEventListener("click", function(e) {
                const link = e.target.closest(".pagination a");
                if (link) {
                    e.preventDefault();
                    fetchData(link.getAttribute("href"));
                }
            });

            // Reset Filter
            resetBtn.addEventListener("click", function() {
                currentCategory = "all";
                searchInput.value = "";

                // 🔁 Update label dropdown kategori
                categoryBtnLabel.innerHTML = `Semua Kategori
                <svg class='hs-dropdown-open:rotate-180 size-4' xmlns='http://www.w3.org/2000/svg'
                    width='24' height='24' viewBox='0 0 24 24' fill='none'
                    stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'>
                    <path d='m6 9 6 6 6-6'/>
                </svg>`;

                fetchData();
            });

        });
    </script>
@endsection
