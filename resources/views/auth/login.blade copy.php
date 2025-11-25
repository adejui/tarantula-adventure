<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

    <div class="min-h-screen flex">

        <!-- LEFT SIDE -->
        <div class="hidden md:flex w-1/2 bg-gray-300 items-center justify-center p-10">
            <div class="max-w-sm">
                <h1 class="text-2xl font-semibold text-gray-800 mb-2">Login to Your Account</h1>
                <p class="text-gray-600 text-sm">
                    Masukkan email dan password untuk mengakses dashboard.
                </p>
            </div>
        </div>

        <!-- RIGHT SIDE (FORM) -->
        <div class="flex w-full md:w-1/2 items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">

                <h1 class="text-xl font-semibold text-center text-gray-800">Login to Your Account</h1>
                <p class="text-center text-sm text-gray-500 mb-8">
                    Masukkan email dan password untuk mengakses dashboard.
                </p>

                <!-- FORM -->
                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf

                    <!-- EMAIL -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required
                            class="w-full rounded-lg border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-purple-500 focus:outline-none"
                            placeholder="email123@xyz.com">
                    </div>

                    <!-- PASSWORD -->
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>

                        <div class="relative">
                            <input type="password" name="password" required
                                class="w-full rounded-lg border border-gray-200 px-4 py-2.5 text-sm focus:ring-2 focus:ring-purple-500 focus:outline-none"
                                placeholder="Password" id="password">

                            <!-- EYE ICON -->
                            <button type="button" onclick="togglePassword()"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-400">
                                👁️
                            </button>
                        </div>
                    </div>

                    <!-- REMEMBER ME + FORGOT -->
                    <div class="flex justify-between items-center mb-6">
                        <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                            <input type="checkbox" name="remember"
                                class="rounded border-gray-300 focus:ring-purple-500">
                            Remember Me
                        </label>

                        <a href="#" class="text-xs text-purple-600 hover:underline">Forgot Password?</a>
                    </div>

                    <!-- LOGIN BUTTON -->
                    <button
                        class="w-full py-3 bg-purple-600 text-white rounded-lg font-medium hover:bg-purple-700 transition">
                        Login
                    </button>
                </form>

                <!-- SIGN UP -->
                <p class="mt-6 text-center text-xs text-gray-500">
                    Don’t have an account?
                    <a href="#" class="text-purple-600 font-medium hover:underline">Sign Up</a>
                </p>
            </div>
        </div>

    </div>

    <!-- JS SHOW/HIDE PASSWORD -->
    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            input.type = input.type === "password" ? "text" : "password";
        }
    </script>

</body>

</html>
