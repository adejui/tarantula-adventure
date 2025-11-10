<div class="flex justify-between w-full max-w-[558px] p-4 rounded-[15px] bg-[#FFDF97] text-gray-800 shadow-md border">
    <div class="flex items-start space-x-3">
        <img src="{{ asset('assets/images/icons/warning.svg') }}" alt="Warning" class="w-7 h-7">

        <div>
            <h4 class="font-semibold text-[#FFB201] mb-1">
                Periksa Kembali Data Kamu!
            </h4>
            <p class="text-sm text-[#424242] max-w-[480px]">
                Beberapa kolom masih belum diisi dengan benar. Pastikan semua informasi lengkap agar proses dapat
                dilanjutkan tanpa kendala.
            </p>
        </div>
    </div>
    <button type="button" onclick="this.parentElement.style.display='none'"
        class="flex items-start justify-center text-gray-700 hover:text-black">
        <img src="{{ asset('assets/images/icons/close.svg') }}" alt="Close" class="w-7 h-7">
    </button>
</div>

{{-- <div x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 2000);
             setTimeout(() => show = false, 6000);"
    x-show="show"
    x-transition:enter="transform transition ease-out duration-700"
    x-transition:enter-start="translate-x-full opacity-0"
    x-transition:enter-end="translate-x-0 opacity-100"
    x-transition:leave="transform transition ease-in duration-700"
    x-transition:leave-start="translate-x-0 opacity-100"
    x-transition:leave-end="translate-x-full opacity-0"
    class="fixed top-24 right-6 z-50 flex justify-between w-full max-w-[558px] p-4 rounded-[15px] bg-[#FFDF97] text-gray-800 shadow-md border">

    <div class="flex items-start space-x-3">
        <img src="{{ asset('assets/images/icons/warning.svg') }}" alt="Warning" class="w-7 h-7">

        <div>
            <h4 class="font-semibold text-[#FFB201] mb-1">
                Periksa Kembali Data Kamu!
            </h4>
            <p class="text-sm text-[#424242] max-w-[480px]">
                Beberapa kolom masih belum diisi dengan benar. Pastikan semua informasi lengkap agar proses dapat
                dilanjutkan tanpa kendala.
            </p>
        </div>
    </div>

    <button type="button" @click="show = false"
        class="flex items-start justify-center text-gray-700 hover:text-black">
        <img src="{{ asset('assets/images/icons/close.svg') }}" alt="Close" class="w-7 h-7">
    </button>
</div> --}}
