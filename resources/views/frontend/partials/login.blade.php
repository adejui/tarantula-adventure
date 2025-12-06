<div x-show="loginOpen" x-cloak class="fixed inset-0 z-[9999] overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div x-show="loginOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm transition-opacity" @click="loginOpen = false"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">

        <div x-show="loginOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all w-full max-w-md md:max-w-6xl my-8"
            @click.away="loginOpen = false">

            <button @click="loginOpen = false"
                class="absolute top-4 right-4 z-20 w-8 h-8 flex items-center justify-center rounded-full bg-black/10 text-gray-600 hover:bg-[#7C3AED] hover:text-white transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>

            <div class="grid grid-cols-1 md:grid-cols-2 h-full">

                <div class="hidden md:block relative h-full min-h-[600px] bg-gray-100">
                    <img src="{{ asset('frontend/images/login.jpeg') }}" alt="Login Background"
                        class="absolute inset-0 w-full h-full object-cover">

                    <div
                        class="absolute inset-0 bg-gradient-to-t from-[#7C3AED]/90 via-[#7C3AED]/40 to-transparent mix-blend-multiply">
                    </div>

                    <div class="absolute bottom-0 left-0 p-10 text-white z-10">
                        <h3 class="text-3xl font-bold mb-2 leading-tight">Welcome Back,<br>Adventurer!</h3>
                        <p class="text-gray-100 text-sm opacity-90">Siap melanjutkan perjalananmu? Masuk sekarang untuk
                            akses dashboard anggota.</p>
                    </div>
                </div>

                <div class="p-10 md:p-16 flex flex-col justify-center h-full">

                    <div class="text-center mb-8">
                        <img src="{{ asset('frontend/images/logo.jpeg') }}" alt="Logo"
                            class="mx-auto h-12 w-12 rounded-full object-cover border-2 border-[#7C3AED] mb-4">
                        <h2 class="text-2xl font-bold text-gray-900">Sign In Account</h2>
                        <p class="mt-2 text-sm text-gray-500">Masukkan email dan password kamu.</p>
                    </div>

                    <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-5">

                        @csrf

                        @if ($errors->has('email'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm"
                                role="alert">
                                {{ $errors->first('email') }}
                            </div>
                        @endif

                        <div>
                            <label
                                class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Email</label>

                            <input type="email" name="email" value="{{ old('email') }}"
                                class="block w-full px-4 py-3 border rounded-lg bg-gray-50 text-gray-900 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent transition-all outline-none text-sm
                                @error('email') border-red-500 ring-red-500 @else border-gray-200 @enderror"
                                placeholder="nama@email.com">

                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex justify-between items-center mb-1">
                                <label
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-wider">Password</label>
                            </div>

                            <input type="password" name="password"
                                class="block w-full px-4 py-3 border border-gray-200 rounded-lg bg-gray-50 text-gray-900 placeholder-gray-400 focus:bg-white focus:ring-2 focus:ring-[#7C3AED] focus:border-transparent transition-all outline-none text-sm
                                @error('password') border-red-500 ring-red-500 @else border-gray-200 @enderror"
                                placeholder="••••••••">

                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between text-sm">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" name="remember"
                                    class="w-4 h-4 rounded border-gray-300 text-[#7C3AED] focus:ring-[#7C3AED]">
                                <span class="ml-2 text-gray-600">Ingat saya</span>
                            </label>
                            <a href="#" class="text-[#7C3AED] hover:text-[#6D28D9] font-medium">Lupa Password?</a>
                        </div>

                        <button type="submit"
                            class="w-full flex justify-center py-3.5 px-4 rounded-xl shadow-lg shadow-purple-500/30 text-sm font-bold text-white bg-[#7C3AED] hover:bg-[#6D28D9] transform hover:-translate-y-0.5 transition-all duration-200">
                            Sign In
                        </button>
                    </form>

                    <div class="mt-10 flex flex-col items-center justify-center text-center opacity-60">
                        <span class="text-[12px] font-bold tracking-widest text-gray-400 uppercase">
                            Tarantula Adventure
                        </span>
                        <span class="text-[10px] text-gray-400 mt-1">
                            Portal Anggota & Alumni
                        </span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
