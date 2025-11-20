 <table class="min-w-full">
     <!-- table header start -->
     <thead>
         <tr class="border-b border-gray-100 text-[#616161] dark:border-gray-800">
             <th class="py-3 text-left">
                 <div class="flex items-center">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         Nama
                     </p>
                 </div>
             </th>

             <th class="py-3 hidden lg:table-cell">
                 <div class="flex justify-start">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         No Telp
                     </p>
                 </div>
             </th>

             <th class="py-3 hidden lg:table-cell">
                 <div class="flex justify-start">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         Kampus
                     </p>
                 </div>
             </th>

             <th class="py-3 hidden lg:table-cell">
                 <div class="flex justify-start">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         Organisasi
                     </p>
                 </div>
             </th>

             {{-- <th class="py-3 hidden lg:table-cell">
                 <div class="flex justify-start">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         Pinjam
                     </p>
                 </div>
             </th> --}}

             <th class="py-3 text-center">
                 <div class="flex items-center justify-center">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         Aksi
                     </p>
                 </div>
             </th>
         </tr>
     </thead>

     <!-- table header end -->

     <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
         @forelse ($opas as $opa)
             <tr>
                 <td class="py-3 relative">
                     <div class="flex items-center">
                         <div class="flex items-center gap-3">
                             <div class="relative">

                                 <!-- Nama -->
                                 <p class="font-medium text-[#2E2E2E] text-theme-sm dark:text-white/90 inline-block">
                                     {{ $opa->name }}
                                 </p>

                                 <!-- Total peminjaman kecil di pojok kanan atas -->
                                 <span class="absolute -top-1 text-[12px]  text-black px-1.5 rounded-full">
                                     {{ $opa->total_peminjaman }}
                                 </span>

                                 <!-- Email -->
                                 <span class="block text-[#2E2E2E] text-theme-xs dark:text-gray-400 mt-0.5">
                                     {{ $opa->email }}
                                 </span>

                             </div>
                         </div>
                     </div>
                 </td>

                 <td class="py-3 hidden lg:table-cell">
                     <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                         {{ $opa->phone_number }}
                     </p>
                 </td>
                 <td class="py-3 hidden lg:table-cell">
                     <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                         {{ $opa->campus_name }}
                     </p>
                 </td>
                 <td class="py-3 hidden lg:table-cell">
                     <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                         {{ $opa->organization_name }}
                     </p>
                 </td>
                 {{-- <td class="py-3 hidden lg:table-cell">
                     <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                         {{ $opa->total_peminjaman }} kali
                     </p>
                 </td> --}}
                 <td class="py-3">
                     <div class="flex items-center justify-center">
                         <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                         <div class="flex justify-center items-center gap-2">
                             <x-modal-confirm-delete :id="'delete-opa-' . $opa->id" :action="route('opas.destroy', $opa->id)" :item="$opa->name" />
                         </div>
                         </p>
                     </div>
                 </td>
             </tr>
         @empty
             <tr>
                 <td colspan="5" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">
                     @if (request('search'))
                         Data peminjam tidak ditemukan.
                     @else
                         Belum ada data peminjam.
                     @endif
                 </td>
             </tr>
         @endforelse
     </tbody>
 </table>

 <div class="mt-4">
     {{ $opas->appends(request()->query())->links() }}
 </div>
