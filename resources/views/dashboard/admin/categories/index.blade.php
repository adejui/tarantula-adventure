@extends('dashboard.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>

    <x-breadcrumb :items="[
        ['label' => 'Inventoris', 'url' => route('categories.index')],
        ['label' => 'Daftar Kategori', 'url' => route('categories.index')],
    ]" />

    <div x-data="formHandler()">
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
                <div id="category-table">
                    @include('dashboard.admin.categories.partials.table')
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <template x-teleport="body">
            <div x-cloak x-show="showForm" class="fixed inset-0 z-index flex items-center justify-end">
                <div class="absolute inset-0 bg-black/50" @click="showForm = false"></div>

                <div x-show="showForm" x-transition:enter="transform transition ease-in-out duration-500"
                    x-transition:enter-start="translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
                    class="relative mr-8 z-index bg-white dark:bg-gray-800 w-full sm:w-[500px] h-fit shadow-2xl border-l border-gray-200 dark:border-neutral-700 p-6 overflow-y-auto rounded-2xl">

                    <div class="flex justify-between items-center pb-3 mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white"
                            x-text="formMode === 'create' ? 'Tambah Kategori' : 'Edit Kategori'"></h2>
                        <button @click="showForm = false"
                            class="text-gray-500 hover:text-gray-700 text-2xl leading-none">&times;</button>
                    </div>

                    <form
                        :action="formMode === 'create'
                            ?
                            '{{ route('categories.store') }}' :
                            '{{ url('categories') }}/' + formData.id"
                        method="POST">
                        @csrf
                        <template x-if="formMode === 'edit'">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <div class="relative mb-4">
                            <label class="text-[#616161] font-medium text-xs mb-2 block text-md dark:text-gray-400">
                                Nama Kategori
                            </label>
                            <input type="text" name="name" x-model="formData.name" placeholder="Masukan nama kategori"
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

                        <div class="flex justify-end items-center w-full mt-8">
                            <div class="flex gap-5 w-full justify-end items-center">
                                <button type="button" @click="showForm = false"
                                    class="p-2 border-2 text-sm dark:text-white border-[#7753AF] bg-transparent w-full rounded-lg text-[#7753AF] text-center dark:hover:bg-gray-800 hover:bg-[#F3E8FF] transition">
                                    Batal
                                </button>

                                <button type="submit"
                                    class="p-2 border-2 text-sm border-[#7753AF] bg-[#7753AF] w-full rounded-lg text-white text-center hover:bg-[#67419B] transition">
                                    <span x-text="formMode === 'create' ? 'Simpan' : 'Simpan'"></span>
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </template>
    </div>

    <script>
        function formHandler() {
            return {
                showForm: {{ $errors->any() ? 'true' : 'false' }},
                formMode: 'create',
                formData: {
                    id: '',
                    name: ''
                },

                openCreate() {
                    this.formMode = 'create';
                    this.formData = {
                        id: '',
                        name: ''
                    };
                    this.showForm = true;
                },

                openEdit(category) {
                    this.formMode = 'edit';
                    this.formData = {
                        ...category
                    };
                    this.showForm = true;
                }
            };
        }
    </script>

    {{-- Table search and pagination --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchInput = document.querySelector("#search-input");
            const perPageSelect = document.querySelector("#perPageSelect");
            const tableContainer = document.querySelector("#category-table");

            let searchTimeout = null;

            async function fetchData(url = "{{ route('categories.index') }}") {
                const params = new URLSearchParams({
                    search: searchInput.value,
                    perPage: perPageSelect.value
                });

                if (url.includes("?")) {
                    const baseUrl = url.split("?")[0];
                    const existingParams = new URLSearchParams(url.split("?")[1]);
                    existingParams.set("search", searchInput.value);
                    existingParams.set("perPage", perPageSelect.value);
                    url = `${baseUrl}?${existingParams.toString()}`;
                } else {
                    url = `${url}?${params.toString()}`;
                }

                const response = await fetch(url, {
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    }
                });

                const html = await response.text();
                tableContainer.innerHTML = html;
                window.HSStaticMethods.autoInit();
            }

            searchInput.addEventListener("input", function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => fetchData(), 300);
            });

            perPageSelect.addEventListener("change", function() {
                fetchData();
            });

            document.addEventListener("click", function(e) {
                const link = e.target.closest(".pagination a");
                if (link) {
                    e.preventDefault();
                    fetchData(link.getAttribute("href"));
                }
            });
        });
    </script>
@endsection
