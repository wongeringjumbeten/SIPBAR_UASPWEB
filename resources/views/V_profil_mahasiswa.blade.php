<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - SIPBAR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.9; }
        }
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out forwards; }
        .animate-slideInLeft { animation: slideInLeft 0.4s ease-out forwards; }
        .animate-slideInRight { animation: slideInRight 0.4s ease-out forwards; }
        .animate-fadeInUp { animation: fadeInUp 0.4s ease-out forwards; }
        .animate-pulse { animation: pulse 2s ease-in-out infinite; }
        .animate-gradient { background-size: 200% 200%; animation: gradient 3s ease infinite; }

        .gradient-bg {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.25);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    @include('components.V_notifikasi')

    <!-- Floating Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Navbar -->
    <nav class="gradient-bg text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 animate-slideInLeft">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">SIPBAR</h1>
                        <p class="text-xs text-blue-100">Profil Mahasiswa</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 animate-slideInRight">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100">Mahasiswa</p>
                    </div>
                    <a href="{{ route('dashboard.mahasiswa') }}" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">
        <div class="max-w-4xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-8 animate-fadeInUp">
                <div class="inline-block p-3 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl mb-3">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Profil Saya</h1>
                <p class="text-gray-500 mt-2">Kelola informasi akun Anda</p>
            </div>

            <!-- Alert Error -->
            @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 animate-scaleIn">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold">Terjadi kesalahan. Silakan periksa kembali.</span>
                </div>
            </div>
            @endif

            <!-- Profile Card -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-scaleIn">
                <!-- Hero Section dengan Gradien Animasi -->
                <div class="relative h-32 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 animate-gradient">
                    <div class="absolute inset-0 bg-black/10"></div>
                </div>

                <!-- Avatar Default (SVG Logo Orang) -->
                <div class="relative px-6 flex justify-center">
                    <div class="absolute -top-16">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center shadow-xl ring-4 ring-white">
                            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Nama & Info Dasar -->
                <div class="mt-20 text-center px-6">
                    <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <div class="flex items-center justify-center space-x-2 mt-1">
                        <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs rounded-full">Mahasiswa</span>
                        <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-xs rounded-full">{{ Auth::user()->nim_nip ?? '-' }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mt-2">{{ Auth::user()->jurusan ?? '-' }}</p>
                </div>

                <!-- Form Edit Profil -->
                <form action="{{ route('mahasiswa.profil.update') }}" method="POST" class="p-6 space-y-5">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Email -->
                        <div class="animate-slideInLeft" style="animation-delay: 0.1s">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span>Email</span>
                                </div>
                            </label>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No HP -->
                        <div class="animate-slideInRight" style="animation-delay: 0.1s">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <div class="flex items-center space-x-1">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span>No. HP</span>
                                </div>
                            </label>
                            <input type="text" name="no_hp" value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                                placeholder="Contoh: 081234567890">
                            @error('no_hp')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-400 mt-1">Hanya angka, tanpa spasi atau tanda hubung</p>
                        </div>
                    </div>

                    <!-- Informasi yang Tidak Bisa Diubah -->
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-5 animate-fadeInUp" style="animation-delay: 0.2s">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-gray-700">Data Tidak Dapat Diubah</span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm mb-4">
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="text-xs text-gray-400">NIM</p>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->nim_nip ?? '-' }}</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="text-xs text-gray-400">Jurusan</p>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->jurusan ?? '-' }}</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="text-xs text-gray-400">Nama Lengkap</p>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="bg-white rounded-lg p-3 shadow-sm">
                                <p class="text-xs text-gray-400">Role</p>
                                <p class="font-semibold text-gray-800">Mahasiswa</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-xl border-l-4 border-blue-500">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm">
                                <p class="font-semibold text-blue-800">Perhatian</p>
                                <p class="text-blue-700 text-xs">
                                    Data seperti NIM, Jurusan, Nama Lengkap, dan Role tidak dapat diubah secara mandiri.
                                    Jika terdapat kesalahan atau ketidaksesuaian data, silakan hubungi <span class="font-semibold">Admin SIPBAR</span>
                                    melalui email <span class="font-semibold">admin@sipbar.ac.id</span> atau datang langsung ke ruang administrasi kampus.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-100 animate-fadeInUp" style="animation-delay: 0.3s">
                        <a href="{{ route('dashboard.mahasiswa') }}"
                            class="px-6 py-2.5 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Batal</span>
                        </a>
                        <button type="submit"
                            class="btn-gradient text-white px-6 py-2.5 rounded-xl shadow-lg hover:shadow-xl transition flex items-center space-x-2 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Simpan Perubahan</span>
                        </button>
                    </div>
                </form>

                <!-- Tombol Ganti Password -->
                <div class="px-6 pb-6">
                    <button onclick="openPasswordModal()"
                        class="w-full flex items-center justify-center space-x-2 px-5 py-3 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v-2l4.257-4.257A6 6 0 0121 9zM7 17h.01M6 20h12a2 2 0 002-2V9a2 2 0 00-2-2h-2.5"></path>
                        </svg>
                        <span>Ganti Password</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function toggleModalPassword(fieldId) {
            const input = document.getElementById(fieldId);
            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
            input.setAttribute('type', type);
        }

        // Live validation for modal
        const modalPasswordBaru = document.getElementById('modal_password_baru');
        const modalPasswordConfirm = document.getElementById('modal_password_confirmation');
        const modalMatchMessage = document.getElementById('modalPasswordMatchMessage');

        function validateModalPasswordMatch() {
            if (modalPasswordBaru && modalPasswordConfirm && modalPasswordBaru.value && modalPasswordConfirm.value) {
                if (modalPasswordBaru.value !== modalPasswordConfirm.value) {
                    modalMatchMessage.innerHTML = '<div class="flex items-center space-x-2 text-red-600 bg-red-50 p-2 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Password baru tidak cocok!</span></div>';
                    modalMatchMessage.classList.remove('hidden');
                } else {
                    modalMatchMessage.innerHTML = '<div class="flex items-center space-x-2 text-green-600 bg-green-50 p-2 rounded-lg"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span>Password cocok!</span></div>';
                    modalMatchMessage.classList.remove('hidden');
                }
            } else {
                if (modalMatchMessage) modalMatchMessage.classList.add('hidden');
            }
        }

        if (modalPasswordBaru && modalPasswordConfirm) {
            modalPasswordBaru.addEventListener('keyup', validateModalPasswordMatch);
            modalPasswordConfirm.addEventListener('keyup', validateModalPasswordMatch);
        }

        // Modal functions
        const passwordModal = document.getElementById('passwordModal');

        function openPasswordModal() {
            if (passwordModal) {
                passwordModal.classList.remove('hidden');
                passwordModal.classList.add('flex');
                document.body.style.overflow = 'hidden';
            }
        }

        function closePasswordModal() {
            if (passwordModal) {
                passwordModal.classList.add('hidden');
                passwordModal.classList.remove('flex');
                document.body.style.overflow = 'auto';
                resetModalPasswordForm();
            }
        }

        function closePasswordModalOnClick(event) {
            if (event.target === passwordModal) {
                closePasswordModal();
            }
        }

        function resetModalPasswordForm() {
            const lama = document.getElementById('modal_password_lama');
            const baru = document.getElementById('modal_password_baru');
            const konfirmasi = document.getElementById('modal_password_confirmation');
            if (lama) lama.value = '';
            if (baru) baru.value = '';
            if (konfirmasi) konfirmasi.value = '';
            if (modalMatchMessage) modalMatchMessage.classList.add('hidden');
        }
    </script>

    <style>
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>

    <!-- Modal Ganti Password -->
    <div id="passwordModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closePasswordModalOnClick(event)">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-slideDown overflow-hidden">
            <!-- Header Modal -->
            <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v-2l4.257-4.257A6 6 0 0121 9zM7 17h.01M6 20h12a2 2 0 002-2V9a2 2 0 00-2-2h-2.5"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-white">Ganti Password</h3>
                            <p class="text-sm text-white/80">Perbarui password akun Anda</p>
                        </div>
                    </div>
                    <button onclick="closePasswordModal()" class="text-white/80 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Form Ganti Password -->
            <form action="{{ route('mahasiswa.profil.ganti-password') }}" method="POST" class="p-6 space-y-5">
                @csrf
                @method('PUT')

                <!-- Password Lama -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Password Lama</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password_lama" id="modal_password_lama" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-300 pr-12"
                            placeholder="Masukkan password lama">
                        <button type="button" onclick="toggleModalPassword('modal_password_lama')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password_lama')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Baru -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Password Baru</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password_baru" id="modal_password_baru" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-300 pr-12"
                            placeholder="Minimal 6 karakter">
                        <button type="button" onclick="toggleModalPassword('modal_password_baru')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password_baru')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Konfirmasi Password Baru</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password_baru_confirmation" id="modal_password_confirmation" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-2 focus:ring-orange-200 transition-all duration-300 pr-12"
                            placeholder="Ulangi password baru">
                        <button type="button" onclick="toggleModalPassword('modal_password_confirmation')" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Live Validation -->
                <div id="modalPasswordMatchMessage" class="text-sm hidden"></div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="closePasswordModal()"
                        class="px-5 py-2 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-orange-500 to-red-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition hover:scale-105">
                        Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate
