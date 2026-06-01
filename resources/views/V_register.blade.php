<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SIPBAR</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.7;
            }
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
        .delay-400 {
            animation-delay: 0.4s;
            opacity: 0;
        }
        .bg-gradient-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .role-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .role-card:hover {
            transform: translateY(-5px);
        }
        .role-card.selected {
            border: 2px solid;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .role-mahasiswa.selected {
            border-color: #10b981;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        }
        .role-petugas.selected {
            border-color: #3b82f6;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        }
        input:focus, select:focus {
            transform: scale(1.01);
            transition: all 0.2s ease;
        }
    </style>
</head>
<body class="bg-gradient-custom min-h-screen py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="p-8 md:p-10">
                    <div class="text-center mb-8 animate-fadeInUp">
                        <div class="flex justify-center mb-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                                </svg>
                            </div>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Daftar Akun</h2>
                        <p class="text-gray-500">Bergabunglah dengan SIPBAR</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 animate-fadeInUp delay-100">
                            @foreach ($errors->all() as $error)
                                <p class="text-sm">{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Pilihan Role dengan Card Cantik -->
                        <div class="animate-fadeInUp delay-100">
                            <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Role *</label>
                            <div class="grid grid-cols-2 gap-4">
                                <!-- Role Mahasiswa -->
                                <div id="role-mahasiswa-card"
                                     class="role-card role-mahasiswa p-4 rounded-xl border-2 border-gray-200 cursor-pointer transition-all text-center"
                                     onclick="selectRole('mahasiswa')">
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-2">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                        </div>
                                        <h3 class="font-bold text-gray-800">Mahasiswa</h3>
                                        <p class="text-xs text-gray-500 mt-1">Pinjam barang kampus</p>
                                    </div>
                                </div>

                                <!-- Role Petugas -->
                                <div id="role-petugas-card"
                                     class="role-card role-petugas p-4 rounded-xl border-2 border-gray-200 cursor-pointer transition-all text-center"
                                     onclick="selectRole('petugas')">
                                    <div class="flex flex-col items-center">
                                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-2">
                                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="font-bold text-gray-800">Petugas</h3>
                                        <p class="text-xs text-gray-500 mt-1">Kelola peminjaman</p>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="role" id="role-input" value="{{ old('role') }}">
                            @error('role')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="animate-fadeInUp delay-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="John Doe">
                        </div>

                        <!-- Email -->
                        <div class="animate-fadeInUp delay-200">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                placeholder="email@example.com">
                        </div>

                        <!-- Password & Konfirmasi -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="animate-fadeInUp delay-300">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password *</label>
                                <input type="password" name="password" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="Minimal 6 karakter">
                            </div>

                            <div class="animate-fadeInUp delay-300">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password *</label>
                                <input type="password" name="password_confirmation" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                                    placeholder="Ulangi password">
                                </div>
                            </div>

                            <!-- NIM/NIP (dynamic label) -->
                        <div class="animate-fadeInUp delay-400" id="nim-nip-container">
                            <label id="nim-nip-label" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                            <input type="text" name="nim_nip" value="{{ old('nim_nip') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Masukkan NIM">
                            <p id="nim-nip-hint" class="text-xs text-gray-500 mt-1">Untuk mahasiswa, isi dengan NIM (hanya angka)</p>
                            @error('nim_nip')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- No. HP -->
                        <div class="animate-fadeInUp delay-400">
                            <label class="block text-sm font-medium text-gray-700 mb-2">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="081234567890">
                            <p class="text-xs text-gray-500 mt-1">Hanya angka, tanpa spasi atau tanda hubung</p>
                            @error('no_hp')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jurusan (hanya untuk mahasiswa) -->
                        <div id="jurusan-container" class="animate-fadeInUp delay-400">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200"
                            placeholder="Contoh: Teknik Informatika, Sistem Informasi, Manajemen, dll">
                            <p class="text-xs text-gray-500 mt-1">Isi dengan jurusan Anda (khusus mahasiswa)</p>
                        </div>

                        <button type="submit"
                            class="animate-fadeInUp delay-400 w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                            Daftar Sekarang
                        </button>
                    </form>

                    <div class="mt-6 text-center animate-fadeInUp delay-400">
                        <p class="text-gray-600">
                            Sudah punya akun?
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold ml-1 transition">
                                Login di sini
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set role yang sudah dipilih sebelumnya (jika ada error)
        let selectedRole = '{{ old('role') }}';

        function selectRole(role) {
            selectedRole = role;
            document.getElementById('role-input').value = role;

            // Update tampilan card
            const mahasiswaCard = document.getElementById('role-mahasiswa-card');
            const petugasCard = document.getElementById('role-petugas-card');

            // Reset semua card
            mahasiswaCard.classList.remove('selected', 'role-mahasiswa-selected');
            petugasCard.classList.remove('selected', 'role-petugas-selected');

            // Tambah class selected ke card yang dipilih
            if (role === 'mahasiswa') {
                mahasiswaCard.classList.add('selected');
                mahasiswaCard.classList.add('role-mahasiswa-selected');
                petugasCard.classList.remove('ring-2', 'ring-blue-500');

                // Update label dan placeholder untuk NIM
                document.getElementById('nim-nip-label').innerHTML = 'NIM';
                document.getElementById('nim-nip-hint').innerHTML = 'Nomor Induk Mahasiswa (contoh: 202401001)';
                document.querySelector('input[name="nim_nip"]').placeholder = 'Masukkan NIM';

                // Tampilkan jurusan
                document.getElementById('jurusan-container').style.display = 'block';
            } else {
                petugasCard.classList.add('selected');
                petugasCard.classList.add('role-petugas-selected');
                mahasiswaCard.classList.remove('ring-2', 'ring-green-500');

                // Update label dan placeholder untuk NIP
                document.getElementById('nim-nip-label').innerHTML = 'NIP';
                document.getElementById('nim-nip-hint').innerHTML = 'Nomor Induk Pegawai untuk petugas';
                document.querySelector('input[name="nim_nip"]').placeholder = 'Masukkan NIP';

                // Sembunyikan jurusan
                document.getElementById('jurusan-container').style.display = 'none';
                document.querySelector('select[name="jurusan"]').value = '';
            }
        }

        // Highlight card yang sudah dipilih sebelumnya
        if (selectedRole === 'mahasiswa') {
            selectRole('mahasiswa');
        } else if (selectedRole === 'petugas') {
            selectRole('petugas');
        }

        // Hover effect tambahan
        const cards = document.querySelectorAll('.role-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                if (!this.classList.contains('selected')) {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 10px 15px -3px rgba(0, 0, 0, 0.1)';
                }
            });
            card.addEventListener('mouseleave', function() {
                if (!this.classList.contains('selected')) {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = 'none';
                }
            });
        });
    </script>

    <style>
        .role-mahasiswa-selected {
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
            border-color: #10b981;
            transform: scale(1.02);
        }
        .role-petugas-selected {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-color: #3b82f6;
            transform: scale(1.02);
        }
        #jurusan-container {
            transition: all 0.3s ease;
        }
    </style>
</body>
</html>
