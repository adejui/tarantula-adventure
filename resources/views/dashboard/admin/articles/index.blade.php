@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <x-breadcrumb :items="[['label' => 'Artikel', 'url' => route('articles.index')]]" />


    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Daftar Kategori</h3>

        <div class="flex justify-between items-center my-2">
            {{-- Search --}}
            <div class="hidden lg:max-w-[430px] md:block">
                <div class="relative">
                    <span class="absolute top-1/2 left-4 -translate-y-1/2">
                        <svg class="fill-gray-500 dark:fill-gray-400" width="20" height="20" viewBox="0 0 20 20"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
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
                        <select id="perPageSelect"
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

                <button @click="openCreate()"
                    class="inline-flex items-center gap-2 px-4 h-10 text-sm font-medium text-white bg-[#7653afaa] transition rounded-lg shadow-theme-xs hover:bg-[#68489C]">
                    <img src="{{ asset('assets/images/icons/plus.svg') }}" alt="Tambah" class="h-4 w-4">
                    Tambah
                </button>
            </div>
        </div>
    </div>

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 mt-3.5 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <div class="w-full overflow-x-auto">
            <div id="article-table">
                @include('dashboard.admin.articles.partials.table')
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector("#search-input");
            const tableContainer = document.querySelector("#article-table");
            const perPageSelect = document.querySelector("#perPageSelect");
            const statusButtons = document.querySelectorAll(".status-option");
            const statusBtnLabel = document.querySelector("#statusDropdownBtn");;
            const resetBtn = document.querySelector("#resetFiltersBtn");

            let searchTimeout = null;
            let currentStatus = "{{ request('status', 'all') }}";

            async function fetchData(url = "{{ route('articles.index') }}") {
                const params = new URLSearchParams({
                    search: searchInput.value,
                    perPage: perPageSelect.value,
                    status: currentStatus,

                });

                if (url.includes("?")) {
                    const baseUrl = url.split("?")[0];
                    const existingParams = new URLSearchParams(url.split("?")[1]);
                    existingParams.set("search", searchInput.value);
                    existingParams.set("perPage", perPageSelect.value);
                    existingParams.set("status", currentStatus);
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

            // Filter Status
            statusButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    currentStatus = this.dataset.value;
                    statusBtnLabel.innerHTML = this.textContent + `
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
                currentStatus = "all";
                searchInput.value = "";
                fetchData();
            });
        });
    </script>
@endsection
