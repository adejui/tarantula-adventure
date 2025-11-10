@props([
    'id' => 'delete-modal',
    'action' => '#',
    'item' => 'data ini',
])

<button type="button"
    class="p-2.5 border-2 border-gray-300 dark:border-gray-700 rounded-xl hover:bg-red-100 dark:hover:bg-neutral-800 focus:outline-none"
    data-hs-overlay="#{{ $id }}">
    <img src="{{ asset('assets/images/icons/trash.svg') }}" alt="Hapus" class="h-4 w-4 block dark:hidden">
    <img src="{{ asset('assets/images/icons/trash-dark.svg') }}" alt="Hapus" class="h-4 w-4 hidden dark:block">
</button>

<div id="{{ $id }}"
    class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
    role="dialog" tabindex="-1" aria-labelledby="{{ $id }}-label">

    <div
        class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center justify-center">
        <div
            class="w-[390px] flex flex-col px-4 py-6 bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-gray-800 dark:border-gray-700 dark:shadow-gray-700/70">

            <div class="flex flex-col justify-center items-center">
                <img src="{{ asset('assets/images/icons/circle-alert.svg') }}" alt="Success" class="w-12 h-12">

                <h3 id="{{ $id }}-label" class="text-[#E6353D] text-xl mt-2 mb-1 font-semibold">Hapus Data?
                </h3>
            </div>

            <div class="mb-7 overflow-y-auto">
                <p class="mt-1 text-gray-800 text-center dark:text-neutral-400">
                    Apakah Anda yakin ingin menghapus
                    <span class="font-semibold text-gray-800 dark:text-white">{{ $item }}</span>
                    dari sistem?
                </p>
            </div>

            <form action="{{ $action }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="flex justify-center items-center gap-x-2">
                    <button type="submit"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-[#DD0000] text-white hover:bg-red-700 focus:outline-hidden focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        Hapus
                    </button>
                    <button type="button"
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700"
                        data-hs-overlay="#{{ $id }}">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
