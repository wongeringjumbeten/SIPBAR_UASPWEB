@extends('layouts.V_templateadmin')

@section('title', 'Tambah User - SIPBAR Admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header Mewah dengan Animasi -->
    <div class="flex items-center space-x-4 mb-8 animate-fadeInUp">
        <a href="{{ route('user.index') }}" class="group relative">
            <div class="w-12 h-12 bg-white rounded-2xl shadow-lg flex items-center justify-center group-hover:shadow-xl group-hover:-translate-x-1 transition-all duration-300 border border-gray-100">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-blue-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </div>
        </a>
        <div>
            <div class="flex items-center space-x-2">
                <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Tambah User</h1>
            </div>
            <p class="text-gray-500 text-sm mt-1 ml-3">Tambahkan akun baru untuk petugas atau mahasiswa</p>
        </div>
    </div>

    <!-- Alert Error Global dengan Animasi -->
    @if($errors->any())
    <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 animate-shake">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-3">
                <p class="font-semibold text-red-800">Terjadi kesalahan:</p>
                <ul class="list-disc list-inside text-sm mt-1 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <!-- Form Card Mewah -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-scaleIn">
        <!-- Card Header with Logo Animation -->
        <div class="bg-gradient-to-r from-gray-50 via-white to-gray-50 px-6 py-5 border-b border-gray-100">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-gray-800">Form Tambah User</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Lengkapi data di bawah ini dengan benar</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('user.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Lengkap -->
                <div class="animate-slideInLeft" style="animation-delay: 0.1s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Nama Lengkap</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full pl-10 pr-4 py-3 border-2 {{ $errors->has('name') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                            placeholder="Masukkan nama lengkap">
                    </div>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1 flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="animate-slideInRight" style="animation-delay: 0.1s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>Email</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full pl-10 pr-4 py-3 border-2 {{ $errors->has('email') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                            placeholder="email@example.com">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="animate-fadeInUp" style="animation-delay: 0.2s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Password</span>
                    </div>
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <input type="password" name="password" id="password" required
                        class="w-full pl-10 pr-12 py-3 border-2 {{ $errors->has('password') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                        placeholder="Minimal 6 karakter">
                    <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-400 mt-1">Password harus minimal 6 karakter</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role Selection dengan Card -->
            <div class="animate-fadeInUp" style="animation-delay: 0.25s">
                <label class="block text-sm font-semibold text-gray-700 mb-3">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <span>Role</span>
                    </div>
                    <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-4">
                    <div id="card-petugas" class="role-card cursor-pointer rounded-xl border-2 p-4 text-center transition-all duration-300" onclick="selectRole('petugas')">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800">Petugas</h4>
                        <p class="text-xs text-gray-500 mt-1">Kelola peminjaman</p>
                    </div>
                    <div id="card-mahasiswa" class="role-card cursor-pointer rounded-xl border-2 p-4 text-center transition-all duration-300" onclick="selectRole('mahasiswa')">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-gray-800">Mahasiswa</h4>
                        <p class="text-xs text-gray-500 mt-1">Pinjam barang kampus</p>
                    </div>
                </div>
                <input type="hidden" name="role" id="role" value="{{ old('role') }}">
                @error('role')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- NIM/NIP (dynamic) -->
            <div id="nim_nip_container" class="animate-slideInLeft" style="animation-delay: 0.3s">
                <label id="nim_nip_label" class="block text-sm font-semibold text-gray-700 mb-2">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path>
                        </svg>
                        <span>NIM</span>
                    </div>
                </label>
                <input type="text" name="nim_nip" id="nim_nip" value="{{ old('nim_nip') }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('nim_nip') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                    placeholder="Masukkan NIM">
                <p id="nim_nip_hint" class="text-xs text-gray-400 mt-1">Untuk mahasiswa, isi dengan NIM (hanya angka)</p>
                @error('nim_nip')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- No HP -->
            <div class="animate-slideInRight" style="animation-delay: 0.3s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span>No. HP</span>
                    </div>
                </label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('no_hp') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                    placeholder="Contoh: 081234567890">
                <p class="text-xs text-gray-400 mt-1">Hanya angka, tanpa spasi atau tanda hubung</p>
                @error('no_hp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Jurusan (hidden by default) -->
            <div id="jurusan_container" class="animate-fadeInUp" style="display: none; animation-delay: 0.4s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span>Jurusan</span>
                    </div>
                </label>
                <input type="text" name="jurusan" value="{{ old('jurusan') }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('jurusan') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                    placeholder="Contoh: Teknik Informatika">
                <p class="text-xs text-gray-400 mt-1">Khusus untuk mahasiswa</p>
                @error('jurusan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-100 animate-fadeInUp" style="animation-delay: 0.5s">
                <a href="{{ route('user.index') }}"
                    class="group px-6 py-2.5 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Batal</span>
                </a>
                <button type="submit"
                    class="group btn-gradient text-white px-6 py-2.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2">
                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Simpan User</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Toggle Password
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('svg').classList.toggle('text-blue-500');
    });

    // Role Selection dengan Card
    let selectedRole = '{{ old('role') }}';
    const nimNipLabel = document.getElementById('nim_nip_label');
    const nimNipHint = document.getElementById('nim_nip_hint');
    const nimNipInput = document.getElementById('nim_nip');
    const jurusanContainer = document.getElementById('jurusan_container');
    const roleInput = document.getElementById('role');

    const cardPetugas = document.getElementById('card-petugas');
    const cardMahasiswa = document.getElementById('card-mahasiswa');

    function selectRole(role) {
        selectedRole = role;
        roleInput.value = role;

        // Reset both cards
        cardPetugas.classList.remove('border-blue-500', 'bg-blue-50', 'selected-petugas');
        cardMahasiswa.classList.remove('border-green-500', 'bg-green-50', 'selected-mahasiswa');

        if (role === 'petugas') {
            cardPetugas.classList.add('border-blue-500', 'bg-blue-50', 'selected-petugas');
            nimNipLabel.innerHTML = '<div class="flex items-center space-x-1"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path></svg><span>NIP <span class="text-red-500">*</span></span></div>';
            nimNipHint.innerHTML = 'Nomor Induk Pegawai (hanya angka, contoh: 198501012010011001)';
            nimNipInput.placeholder = 'Masukkan NIP';
            nimNipInput.required = true;
            jurusanContainer.style.display = 'none';
            document.querySelector('input[name="jurusan"]').value = '';
        } else if (role === 'mahasiswa') {
            cardMahasiswa.classList.add('border-green-500', 'bg-green-50', 'selected-mahasiswa');
            nimNipLabel.innerHTML = '<div class="flex items-center space-x-1"><svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path></svg><span>NIM <span class="text-red-500">*</span></span></div>';
            nimNipHint.innerHTML = 'Nomor Induk Mahasiswa (hanya angka, contoh: 202401001)';
            nimNipInput.placeholder = 'Masukkan NIM';
            nimNipInput.required = true;
            jurusanContainer.style.display = 'block';
        }
    }

    // Set initial selected if any
    if (selectedRole === 'petugas') {
        selectRole('petugas');
    } else if (selectedRole === 'mahasiswa') {
        selectRole('mahasiswa');
    }
</script>

<style>
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .animate-shake {
        animation: shake 0.3s ease-in-out;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }
    .role-card {
        transition: all 0.3s ease;
    }
    .role-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .selected-petugas {
        transform: scale(1.02);
    }
    .selected-mahasiswa {
        transform: scale(1.02);
    }
    .animate-fadeInUp, .animate-slideInLeft, .animate-slideInRight, .animate-scaleIn {
        animation-duration: 0.5s;
        animation-fill-mode: forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-fadeInUp { animation: fadeInUp 0.5s ease-out; }
    .animate-slideInLeft { animation: slideInLeft 0.5s ease-out; }
    .animate-slideInRight { animation: slideInRight 0.5s ease-out; }
    .animate-scaleIn { animation: scaleIn 0.4s ease-out; }
</style>
@endsection
