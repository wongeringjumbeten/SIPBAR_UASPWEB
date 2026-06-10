<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPBAR</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out forwards;
        }
        .animate-slideInLeft {
            animation: slideInLeft 0.8s ease-out forwards;
        }
        .animate-slideInRight {
            animation: slideInRight 0.8s ease-out forwards;
        }
        .animate-shake {
            animation: shake 0.3s ease-in-out;
        }
        .delay-100 {
            animation-delay: 0.1s;
            opacity: 0;
        }
        .delay-200 {
            animation-delay: 0.2s;
            opacity: 0;
        }
        .delay-300 {
            animation-delay: 0.3s;
            opacity: 0;
        }
        .bg-gradient-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gradient-custom min-h-screen">
    <div class="container mx-auto px-4 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-6xl">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="grid md:grid-cols-2">
                    <!-- Left Side - Info / Branding -->
                    <div class="bg-gradient-to-br from-blue-600 to-purple-700 p-8 text-white flex flex-col justify-between">
                        <div class="animate-slideInLeft">
                            <div class="mb-8">
                                <h1 class="text-4xl font-bold mb-2">SIPBAR</h1>
                                <p class="text-blue-100">Sistem Peminjaman Barang Kampus</p>
                            </div>
                            <div class="space-y-6">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Mudah & Cepat</p>
                                        <p class="text-sm text-blue-100">Proses peminjaman jadi lebih mudah</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold">Terintegrasi</p>
                                        <p class="text-sm text-blue-100">Terhubung dengan sistem kampus</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold">24/7 Akses</p>
                                        <p class="text-sm text-blue-100">Akses kapan saja, di mana saja</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-8 text-sm text-blue-100 animate-slideInLeft delay-100">
                            <p>© 2025 SIPBAR. All rights reserved.</p>
                        </div>
                    </div>

                    <!-- Right Side - Login Form -->
                    <div class="p-8 md:p-12">
                        <div class="animate-fadeInUp">
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang!</h2>
                                <p class="text-gray-500">Silakan login untuk melanjutkan</p>
                            </div>

                            <!-- Success Message -->
                            @if(session('success'))
                                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 animate-fadeInUp delay-100">
                                    <p class="text-sm">{{ session('success') }}</p>
                                </div>
                            @endif

                            <!-- Error Messages -->
                            @if ($errors->any())
                                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 animate-shake">
                                    @foreach ($errors->all() as $error)
                                        <p class="text-sm">{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                                @csrf
                                <div class="animate-fadeInUp delay-100">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email Address
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                            </svg>
                                        </div>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                            class="pl-10 w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                            placeholder="masukkan@email.com">
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="animate-fadeInUp delay-200">
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Password
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                            </svg>
                                        </div>
                                        <input type="password" name="password" id="password" required
                                            class="pl-10 w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                            placeholder="••••••••">
                                    </div>
                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-between animate-fadeInUp delay-300">
                                    <label class="flex items-center cursor-pointer">
                                        <input type="checkbox" name="remember" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded cursor-pointer">
                                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                                    </label>
                                    <a href="#" class="text-sm text-blue-600 hover:text-blue-700 transition">Lupa password?</a>
                                </div>

                                <button type="submit"
                                    class="animate-fadeInUp delay-300 w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                                    Login
                                </button>
                            </form>

                            <div class="mt-6 text-center animate-fadeInUp delay-300">
                                <p class="text-gray-600">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold ml-1 transition">
                                        Daftar Sekarang
                                    </a>
                                </p>
                            </div>

                            <!-- Demo Credentials -->
                            <div class="mt-8 pt-6 border-t border-gray-200 animate-fadeInUp delay-300">
                                <p class="text-xs text-gray-400 text-center mb-2">Demo Account (untuk testing)</p>
                                <div class="grid grid-cols-3 gap-2 text-xs">
                                    <div class="bg-gray-50 p-2 rounded text-center">
                                        <p class="font-semibold text-gray-700">Admin</p>
                                        <p class="text-gray-500">admin@gmail.com</p>
                                        <p class="text-gray-400">pwadmin</p>
                                    </div>
                                    <div class="bg-gray-50 p-2 rounded text-center">
                                        <p class="font-semibold text-gray-700">Petugas</p>
                                        <p class="text-gray-500">petugas@gmail.com</p>
                                        <p class="text-gray-400">pwdummy</p>
                                    </div>
                                    <div class="bg-gray-50 p-2 rounded text-center">
                                        <p class="font-semibold text-gray-700">Mahasiswa</p>
                                        <p class="text-gray-500">mahasiswa@gmail.com</p>
                                        <p class="text-gray-400">pwdummy</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
