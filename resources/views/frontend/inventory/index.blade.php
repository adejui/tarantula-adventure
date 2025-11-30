@extends('frontend.layouts.app')

@section('content')
    <div class="bg-white min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-screen-2xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Inventaris Peralatan</h1>
                    <p class="text-gray-500 mt-1">Mahasiswa Pencinta Alam Universitas Bina Sarana Informatika</p>
                </div>
                <nav class="flex text-sm font-medium text-gray-500">
                    <a href="{{ route('frontend.home') }}" class="hover:text-[#7C3AED] transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#7C3AED]">Inventaris</span>
                </nav>
            </div>

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-10">

                <div class="relative w-full lg:w-1/3">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" placeholder="Cari barang..."
                        class="w-full py-3 pl-11 pr-4 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm placeholder-gray-400 shadow-sm">
                </div>

                <div class="grid grid-cols-2 gap-3 w-full lg:w-auto lg:flex lg:items-center">

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-3">
                        <span class="text-xs sm:text-sm font-semibold text-gray-700">Kategori</span>
                        <select
                            class="w-full sm:w-auto py-2.5 px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-[#7C3AED] cursor-pointer shadow-sm">
                            <option>Semua</option>
                            <option>Tenda</option>
                            <option>Tas</option>
                            <option>Alat Masak</option>
                        </select>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center gap-1.5 sm:gap-3">
                        <span class="text-xs sm:text-sm font-semibold text-gray-700">Urutkan</span>
                        <select
                            class="w-full sm:w-auto py-2.5 px-3 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:outline-none focus:border-[#7C3AED] cursor-pointer shadow-sm">
                            <option>Terbaru</option>
                            <option>Terlama</option>
                            <option>A-Z</option>
                        </select>
                    </div>

                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 mb-12">

                @forelse ($items as $item)
                    <div
                        class="w-full bg-white border-2 border-gray-200 rounded-3xl flex flex-col hover:shadow-xl hover:-translate-y-2 transition-all duration-300 overflow-hidden group h-full">

                        <div class="relative w-full h-56 bg-gray-100 flex items-center justify-center overflow-hidden">

                            <span
                                class="absolute top-4 left-4 bg-black/20 backdrop-blur-sm text-black text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wide z-10">
                                {{ $item->category->name ?? 'Umum' }}
                            </span>

                            <img src="{{ $item->photo ? asset('storage/' . $item->photo) : asset('frontend/images/tas.jpg') }}"
                                alt="{{ $item->name }}"
                                class="w-full h-full object-contain p-6 mix-blend-multiply transition-transform duration-500 group-hover:scale-110">
                        </div>

                        <div class="p-5 flex justify-between items-end grow border-t border-gray-100">
                            <div>
                                <h3 class="text-gray-900 font-semibold text-base leading-tight mb-1 line-clamp-2">
                                    {{ $item->name }}
                                </h3>
                                <p class="text-gray-500 text-sm font-medium">
                                    {{ $item->quantity ?? ($item->stock ?? 0) }} Unit
                                </p>
                            </div>

                            <div class="flex items-center gap-2">

                                <button onclick="addToCart({{ $item->id }})"
                                    class="w-10 h-10 rounded-xl border-2 border-[#7C3AED] text-[#7C3AED] flex items-center justify-center hover:bg-[#7C3AED] hover:text-white transition-all duration-300 shadow-sm">
                                    <i class="fa-solid fa-plus text-sm"></i>
                                </button>



                                <a href="{{ route('frontend.inventory.show', $item->id) }}"
                                    class="w-10 h-10 bg-[#7753AF] rounded-xl flex items-center justify-center text-white hover:bg-[#5e3d8e] hover:scale-110 transition-all duration-300 shadow-md group/btn"
                                    title="Lihat Detail">

                                    <i
                                        class="fa-solid fa-arrow-right -rotate-45 group-hover/btn:rotate-0 transition-transform duration-300"></i>

                                </a>

                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                        <div
                            class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-gray-400 text-3xl">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Belum ada barang</h3>
                        <p class="text-gray-500 text-sm">Inventaris saat ini masih kosong.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-12">
                {{ $items->links('vendor.pagination.custom') }}
            </div>

        </div>
    </div>
    <div onclick="toggleCart()" class="fixed bottom-8 right-8 z-40">
        <button
            class="relative w-16 h-16 bg-[#7C3AED] text-white rounded-full shadow-2xl hover:bg-[#6D28D9] hover:scale-110 transition-all duration-300 flex items-center justify-center group">
            <i class="fa-solid fa-cart-shopping text-2xl group-hover:animate-bounce"></i>

            <span id="cart-badge"
                class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center 
            {{ count(session('cart', [])) > 0 ? '' : 'hidden' }}">
                {{ count(session('cart', [])) }}
            </span>

        </button>
    </div>
    <div id="cart-drawer" class="fixed inset-0 z-50 hidden" aria-modal="true">

        <!-- Overlay -->
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity opacity-0 cart-overlay"
            onclick="toggleCart()"></div>

        <!-- Drawer Wrapper -->
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">

            <!-- Drawer Panel -->
            <div id="cart-panel"
                class="pointer-events-auto w-screen max-w-md transform transition-all duration-500 ease-in-out translate-x-full bg-white shadow-2xl flex flex-col h-full">

                <!-- HEADER -->
                <div class="flex items-start justify-between px-6 py-6 border-b border-gray-100">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900">Keranjang Alat</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            <span id="drawer-count">{{ count(session('cart', [])) }}</span> Jenis Barang dipilih
                        </p>
                    </div>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="toggleCart()">
                        <i class="fa-solid fa-xmark text-2xl"></i>
                    </button>
                </div>

                <!-- CART ITEMS -->
                <div class="flex-1 overflow-y-auto px-6 py-6 space-y-6" id="cart-items">
                    @foreach (session('cart', []) as $cart)
                        <div class="flex gap-4">
                            <div class="h-20 w-20 shrink-0 rounded-xl border border-gray-200 bg-gray-50 overflow-hidden">
                                <img src="{{ $cart['photo'] ? asset('storage/' . $cart['photo']) : asset('frontend/images/tas.jpg') }}"
                                    class="h-full w-full object-contain p-2 mix-blend-multiply">
                            </div>

                            <div class="flex flex-1 flex-col">
                                <div>
                                    <div class="flex justify-between text-base font-semibold text-gray-900">
                                        <h3>{{ $cart['name'] }}</h3>
                                        <p class="ml-4 text-[#7C3AED] font-bold">#{{ $cart['code'] }}</p>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Kategori: {{ $cart['category'] }}</p>
                                </div>

                                <div class="flex flex-1 items-end justify-between text-sm mt-2">

                                    <!-- QTY CONTROL -->
                                    <div class="flex items-center border border-gray-300 rounded-lg">
                                        <button onclick="updateQty({{ $cart['id'] }}, {{ $cart['qty'] - 1 }})"
                                            class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-r border-gray-300">-</button>

                                        <span class="px-3 py-1 font-medium text-gray-900">{{ $cart['qty'] }}</span>

                                        <button onclick="updateQty({{ $cart['id'] }}, {{ $cart['qty'] + 1 }})"
                                            class="px-3 py-1 text-gray-600 hover:bg-gray-100 border-l border-gray-300">+</button>
                                    </div>

                                    <!-- REMOVE -->
                                    <button onclick="removeItem({{ $cart['id'] }})"
                                        class="font-medium text-red-500 hover:text-red-700 flex items-center gap-1">
                                        <i class="fa-regular fa-trash-can"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- FOOTER -->
                <div class="border-t border-gray-100 px-6 py-6 bg-gray-50">
                    <div class="flex justify-between text-base font-semibold text-gray-900 mb-4">

                        <p>Total Barang</p>
                        <p><span id="cart-total">{{ collect(session('cart', []))->sum('qty') }}</span> Unit</p>

                    </div>

                    <p class="text-sm text-gray-500 mb-6">Pastikan barang sudah sesuai sebelum mengajukan peminjaman.</p>

                    <a href="{{ route('frontend.pinjaman') }}"
                        class="flex items-center justify-center rounded-xl bg-[#7C3AED] px-6 py-4 text-base font-bold text-white shadow-lg hover:bg-[#6D28D9] transition-all">
                        Lanjut Isi Formulir <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>


                    <div class="mt-6 text-center text-sm text-gray-500">
                        atau
                        <button type="button" class="font-medium text-[#7C3AED]" onclick="toggleCart()">Lanjut Cari Barang
                            →</button>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <script>
        // --- FUNGSI BARU: UPDATE BADGE MERAH ---
        function updateFloatingBadge(total) {
            const badge = document.getElementById("cart-badge");

            if (badge) {
                // Update angkanya
                badge.innerText = total;

                // Logic: Jika 0 sembunyikan, jika > 0 munculkan
                if (total > 0) {
                    badge.classList.remove("hidden");
                } else {
                    badge.classList.add("hidden");
                }
            }
        }

        // --- FUNGSI DRAWER (BUKA/TUTUP) ---
        function toggleCart() {
            const drawer = document.getElementById("cart-drawer");
            const panel = document.getElementById("cart-panel");
            const overlay = document.querySelector(".cart-overlay");

            if (drawer.classList.contains("hidden")) {
                drawer.classList.remove("hidden");
                setTimeout(() => {
                    overlay.classList.remove("opacity-0");
                    panel.classList.remove("translate-x-full");
                }, 10);
            } else {
                overlay.classList.add("opacity-0");
                panel.classList.add("translate-x-full");
                setTimeout(() => {
                    drawer.classList.add("hidden");
                }, 500);
            }
        }

        // --- RELOAD ISI DALAM DRAWER ---
        function reloadCart() {
            fetch("{{ route('frontend.inventory') }}?cart=1")
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, "text/html");

                    // 1. Update List Barang (Seperti biasa)
                    document.getElementById("cart-items").innerHTML =
                        doc.querySelector("#cart-items").innerHTML;

                    // 2. Update Footer Total (Total Unit)
                    const newTotal = doc.querySelector("#cart-total").innerText;
                    const footerTotal = document.getElementById("cart-total");
                    if (footerTotal) {
                        footerTotal.innerText = newTotal;
                    }

                    // 3. UPDATE HEADER COUNT (YANG KAMU TANYAKAN)
                    // Kita ambil angka dari HTML baru, lalu tempel ke HTML sekarang
                    const newHeaderCount = doc.querySelector("#drawer-count").innerText;
                    const headerCountElement = document.getElementById("drawer-count");

                    if (headerCountElement) {
                        headerCountElement.innerText = newHeaderCount;
                    }
                });
        }

        // --- ADD TO CART ---
        function addToCart(id) {
            fetch("/inventory/cart/add/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    reloadCart(); // Refresh list drawer
                    toggleCart(); // Buka drawer otomatis

                    // UPDATE BADGE MERAH DISINI
                    if (data.total !== undefined) {
                        updateFloatingBadge(data.total);
                    }
                })
                .catch(err => console.error("Error:", err));
        }

        // --- UPDATE QUANTITY ---
        function updateQty(id, qty) {
            fetch("/inventory/cart/update-qty", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id,
                        qty
                    })
                })
                .then(res => res.json())
                .then(data => {
                    reloadCart();

                    // UPDATE BADGE MERAH DISINI
                    if (data.total !== undefined) {
                        updateFloatingBadge(data.total);
                    }
                })
                .catch(err => console.error("Error:", err));
        }

        // --- REMOVE ITEM ---
        function removeItem(id) {
            // Optional: Confirm sebelum hapus
            // if(!confirm("Hapus item ini?")) return;

            fetch("/inventory/cart/remove/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(res => res.json())
                .then(data => {
                    reloadCart();

                    // UPDATE BADGE MERAH DISINI
                    if (data.total !== undefined) {
                        updateFloatingBadge(data.total);
                    }
                });
        }
    </script>
@endsection
