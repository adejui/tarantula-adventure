@extends('frontend.layouts.app')

@section('content')
    <div class="mb-5 flex justify-end">
        @if (session('success'))
            <x-alert-success title="Berhasil!" :message="session('success')" />
        @endif
    </div>
    @if (session('error'))
        <x-alert-error title="Berhasil!" :message="session('error')" />
    @endif

    <div class="bg-gray-50 min-h-screen pt-32 pb-20 px-6 md:px-16">
        <div class="max-w-7xl mx-auto">

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Detail Peminjaman</h1>
                    <p class="text-gray-500 mt-1 text-sm">Lengkapi data peminjaman untuk proses verifikasi dan pengambilan
                        alat.</p>
                </div>
                <nav class="flex text-sm font-medium text-gray-500">
                    <a href="{{ route('frontend.home') }}" class="hover:text-[#7C3AED] transition-colors">Home</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('frontend.inventory') }}"
                        class="hover:text-[#7C3AED] transition-colors">Inventaris</a>
                    <span class="mx-2">/</span>
                    <span class="text-[#7C3AED]">Peminjaman</span>
                </nav>
            </div>

            <form action="{{ route('frontend.pinjaman.store') }}" method="POST">
                @csrf

                <input type="hidden" name="cart_items" id="cart_items_input" value="{{ json_encode($cartItems) }}">

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    <div class="lg:col-span-2 space-y-8">

                        <div class="bg-white rounded-4xl border border-gray-100 p-8 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Data Peminjam</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" name="name"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-900 placeholder-gray-400"
                                        placeholder="Masukkan nama lengkap sesuai KTP...">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Kampus
                                        Asal</label>
                                    <input type="text" name="campus_name"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-900 placeholder-gray-400"
                                        placeholder="Contoh: UBSI Yogyakarta">
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Organisasi</label>
                                    <input type="text" name="organization_name"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-900 placeholder-gray-400"
                                        placeholder="Mapala / UKM / Umum">
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">No
                                        WhatsApp</label>
                                    <input type="number" name="phone_number"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-900 placeholder-gray-400"
                                        placeholder="08xxxxxxxxxx">
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Email</label>
                                    <input type="email" name="email"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-900 placeholder-gray-400"
                                        placeholder="email@domain.com">
                                </div>

                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Alamat
                                        Lengkap</label>
                                    <textarea rows="3"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-900 placeholder-gray-400"
                                        placeholder="Masukkan alamat lengkap domisili saat ini..."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-4xl border border-gray-100 p-8 shadow-sm">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Informasi Peminjaman</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Tanggal
                                        Pinjam</label>
                                    <div class="relative">
                                        <input type="date" name="borrow_date"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-500 uppercase">
                                    </div>
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Tanggal
                                        Pengembalian</label>
                                    <div class="relative">
                                        <input type="date" name="return_date"
                                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-500 uppercase">
                                    </div>
                                </div>

                                <div class="md:col-span-2">
                                    <label
                                        class="block text-xs font-bold text-gray-700 uppercase tracking-wide mb-2">Keperluan
                                        Peminjaman</label>
                                    <textarea rows="4" name="notes"
                                        class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-[#7C3AED] focus:bg-white transition-all text-sm font-medium text-gray-900 placeholder-gray-400"
                                        placeholder="Jelaskan keperluan peminjaman secara detail (Contoh: Pendakian Masal Angkatan 2024 ke Gunung Merbabu)..."></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-4xl border border-gray-100 p-6 shadow-sm sticky top-32">
                            <h3 class="text-lg font-bold text-gray-900 mb-6">Ringkasan Peminjaman</h3>

                            <div class="space-y-4 mb-8 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">

                                @foreach ($cartItems as $item)
                                    <div
                                        class="flex gap-4 p-3 border border-gray-100 rounded-2xl bg-white hover:border-purple-100 transition-colors group">
                                        <div
                                            class="h-20 w-20 shrink-0 bg-gray-100 rounded-xl overflow-hidden flex items-center justify-center border border-gray-100">
                                            <img src="{{ $item['photo'] ? asset('storage/items/' . $item['photo']) : asset('frontend/images/tas.jpg') }}"
                                                class="h-full w-full object-contain p-2 mix-blend-multiply group-hover:scale-110 transition-transform">
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h4 class="font-bold text-gray-900 text-sm line-clamp-2 leading-tight">
                                                {{ $item['name'] }}
                                            </h4>
                                            <div class="flex items-center gap-2 mt-1">
                                                <span
                                                    class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded font-mono">#{{ $item['code'] }}</span>
                                                <span class="text-xs text-gray-400">|</span>
                                                <span class="text-xs font-bold text-[#7C3AED]">{{ $item['qty'] }}
                                                    Unit</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit"
                                class="w-full py-4 bg-[#7753AF] hover:bg-[#5e3d8e] text-white font-bold rounded-xl shadow-lg shadow-purple-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                Ajukan Peminjaman
                            </button>

                        </div>
                    </div>

                </div>
            </form>

        </div>
    </div>
@endsection
