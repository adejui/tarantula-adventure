@extends('dashboard.layouts.app')

@section('content')
    <x-breadcrumb :items="[
        ['label' => 'Inventoris', 'url' => route('items.index')],
        ['label' => 'Daftar Alat', 'url' => route('items.index')],
        ['label' => 'Detail Alat'],
    ]" />

    <div
        class="bg-white border border-[#E0E0E0] rounded-xl h-auto p-4 overflow-hidden px-4 pb-3 pt-4 dark:border-gray-800 dark:bg-white/3 sm:px-6s">
        <h3 class="font-bold text-2xl text-gray-800 dark:text-white/90 mb-6">Detail Alat</h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <!-- FOTO PROFIL -->
            <div
                class="border border-[#E0E0E0] rounded-xl dark:border-gray-700 h-fit dark:bg-white/5 p-6 flex flex-col items-center">

                <div class="flex items-start justify-start w-full mb-4">
                    <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Foto</h3>
                </div>

                <div x-data="{
                    photos: [
                        @foreach ($item->photos->take(4) as $p)
                '{{ Storage::url($p->photo_path) }}', @endforeach
                    ],
                    current: '{{ $item->photos->first() ? Storage::url($item->photos->first()->photo_path) : '' }}',
                
                    swap(img) {
                        let old = this.current;
                        this.current = img;
                        this.photos = this.photos.map(p => p === img ? old : p);
                    }
                }" class="w-full">

                    <!-- GAMBAR BESAR (Hanya muncul kalau current tidak kosong) -->
                    <div class="w-full h-full">
                        <template x-if="current">
                            <img :src="current" class="w-full h-full object-cover rounded-3xl" />
                        </template>
                    </div>

                    <!-- GAMBAR KECIL / THUMBNAIL (Hanya muncul kalau photos ada isinya) -->
                    <div class="flex gap-2 mt-6 justify-center items-center">
                        <template x-if="photos.length > 1">
                            <template x-for="(img, index) in photos.slice(1, 4)" :key="index">
                                <img :src="img" @click="swap(img)"
                                    class="max-w-24 max-h-24 object-cover rounded-2xl cursor-pointer border-2 border-transparent hover:border-amber-500">
                            </template>
                        </template>
                    </div>

                </div>

            </div>


            <!-- INFORMASI -->
            <div class="md:col-span-2 flex flex-col gap-5">
                <div class="p-4 border border-[#E0E0E0] rounded-xl dark:border-gray-700 dark:bg-white/5">
                    <h3 class="font-semibold text-md text-[#212121] dark:text-white/90">Informasi</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-10 mt-5">
                        <div>
                            <h4 class="text-[#616161] font-medium text-sm mb-2">Nama Alat</h4>
                            <p class="text-[#212121] font-normal text-sm dark:text-white/90">{{ $item->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#616161] font-medium text-sm mb-2">Kode</h4>
                            <p class="text-[#212121] font-normal text-sm dark:text-white/90">{{ $item->code }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#616161] font-medium text-sm mb-2">Kategori</h4>
                            <p class="text-[#212121] font-normal text-sm dark:text-white/90">{{ $item->category->name }}</p>
                        </div>
                        <div>
                            <h4 class="text-[#616161] font-medium text-sm mb-2">Jumlah</h4>
                            <p class="text-[#212121] font-normal text-sm dark:text-white/90">{{ $item->quantity }}</p>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-[#616161] font-medium text-sm mb-2 mt-10">Deskripsi</h4>
                        <p class="text-[#212121] font-normal text-sm dark:text-white/90">{{ $item->description }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
