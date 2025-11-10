 <table class="min-w-full">
     <!-- table header start -->
     <thead>
         <tr class="border-b border-gray-100 text-[#616161] dark:border-gray-800">
             <th class="py-3 text-left">
                 <div class="flex items-center">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         Nama Kategori
                     </p>
                 </div>
             </th>

             <th class="py-3 hidden lg:table-cell">
                 <div class="flex items-center justify-center">
                     <p class="font-medium text-theme-md dark:text-gray-400">
                         Jumlah Alat
                     </p>
                 </div>
             </th>

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
         @forelse ($categories as $category)
             <tr>
                 <td class="py-3">
                     <div class="flex items-center">
                         <div class="flex items-center gap-3">
                             <div>
                                 <p class="font-medium text-[#2E2E2E] text-theme-sm dark:text-white/90">
                                     {{ $category->name }}
                                 </p>
                             </div>
                         </div>
                     </div>
                 </td>
                 <td class="py-3 hidden lg:table-cell">
                     <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400 flex items-center justify-center">
                         {{ $category->items->count() }}
                     </p>
                 </td>
                 <td class="py-3">
                     <div class="flex items-center justify-center">
                         <p class="text-[#2E2E2E] text-theme-sm dark:text-gray-400">
                         <div class="flex justify-center items-center gap-2">
                             <button @click="openEdit({ id: {{ $category->id }}, name: '{{ $category->name }}' })"
                                 class="p-2.5 border-2 border-gray-300 rounded-xl hover:bg-slate-200 dark:hover:bg-black dark:text-white focus:outline-none cursor-pointer"
                                 title="Edit">
                                 <img src="{{ asset('assets/images/icons/pencil-line.svg') }}" alt="Edit"
                                     class="h-4 w-4 block dark:hidden">
                                 <img src="{{ asset('assets/images/icons/pencil-line-dark.svg') }}" alt="Edit (Dark)"
                                     class="h-4 w-4 hidden dark:block">
                             </button>
                             <x-modal-confirm-delete :id="'delete-category-' . $category->id" :action="route('categories.destroy', $category->id)" :item="$category->name" />
                         </div>
                         </p>
                     </div>
                 </td>
             </tr>
         @empty
             <tr>
                 <td colspan="3" class="px-3 py-6 text-center text-gray-500 dark:text-gray-400">
                     @if (request('search'))
                         Data kategori tidak ditemukan.
                     @else
                         Belum ada data kategori.
                     @endif
                 </td>
             </tr>
         @endforelse
     </tbody>
 </table>

 <div class="mt-4">
     {{ $categories->appends(request()->query())->links() }}
 </div>
