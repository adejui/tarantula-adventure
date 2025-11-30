<div x-data="{ show: false }" x-init="setTimeout(() => show = true, 2000);
setTimeout(() => show = false, 6000);" x-show="show"
    x-transition:enter="transform transition ease-out duration-700" x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100" x-transition:leave="transform transition ease-in duration-700"
    x-transition:leave-start="translate-x-0 opacity-100" x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-24 right-6 z-50 flex justify-between w-full max-w-[558px] p-4 rounded-[15px] bg-[#F5ACAF] text-gray-800 shadow-md border">

    <div class="flex items-start space-x-3">
        <img src="{{ asset('assets/images/icons/error.svg') }}" alt="Success" class="w-7 h-7">

        <div>
            <h4 class="font-semibold text-[#E6353D] mb-1">
                {{ 'Gagal!' }}
            </h4>
            <p class="text-sm text-[#424242] max-w-[480px]">
                {{ $message ?? 'Semua informasi gagal disimpan ke dalam sistem.' }}
            </p>
        </div>
    </div>

    <button type="button" @click="show = false" class="flex items-start justify-center text-gray-700 hover:text-black">
        <img src="{{ asset('assets/images/icons/close.svg') }}" alt="Close" class="w-7 h-7">
    </button>
</div>
