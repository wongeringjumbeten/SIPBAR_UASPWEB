@extends('layouts.V_templateadmin')

@section('title', 'Edit User - SIPBAR Admin')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header dengan Animasi -->
    <div class="flex items-center space-x-4 mb-8 animate-fadeInUp">
        <a href="{{ route('user.index') }}" class="group relative">
            <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-gray-200 transition-all duration-300 group-hover:-translate-x-1">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </div>
        </a>
        <div>
            <div class="flex items-center space-x-2">
                <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Edit User</h1>
            </div>
            <p class="text-gray-500 text-sm mt-1 ml-3">Edit data akun <span class="font-semibold text-gray-700">{{ $user->name }}</span></p>
        </div>
    </div>

    <!-- Alert Error Global -->
    @if($errors->any())
    <div class="bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 animate-shake">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 mr-3 mt-0.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div>
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
        <!-- Card Header -->
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center animate-pulse-slow">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Form Edit User</h3>
                    <p class="text-xs text-gray-500">Lengkapi data di bawah ini</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('user.update', $user->id) }}" method="POST" class="p-6 space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- Nama Lengkap -->
                <div class="animate-slideInLeft" style="animation-delay: 0.1s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Nama Lengkap
                        </span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-4 py-3 border-2 {{ $errors->has('name') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1 flex items-center"><svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="animate-slideInRight" style="animation-delay: 0.1s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Email
                        </span>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full px-4 py-3 border-2 {{ $errors->has('email') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Password (Opsional) -->
            <div class="animate-fadeInUp" style="animation-delay: 0.2s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        Password
                    </span>
                </label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-200 focus:border-blue-500 transition-all duration-300 pr-12"
                        placeholder="Kosongkan jika tidak ingin mengubah password">
                    <button type="button" id="togglePassword" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-400 mt-1">Minimal 6 karakter jika diisi</p>
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Role -->
            <div class="animate-fadeInUp" style="animation-delay: 0.2s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Role
                    </span>
                    <span class="text-red-500">*</span>
                </label>
                <select name="role" id="role" required
                    class="w-full px-4 py-3 border-2 {{ $errors->has('role') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                    <option value="petugas" {{ old('role', $user->role) == 'petugas' ? 'selected' : '' }}>Petugas</option>
                    <option value="mahasiswa" {{ old('role', $user->role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- NIM/NIP (dynamic) -->
                <div id="nim_nip_container" class="animate-slideInLeft" style="animation-delay: 0.3s">
                    <label id="nim_nip_label" class="block text-sm font-semibold text-gray-700 mb-2">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path>
                            </svg>
                            NIM
                        </span>
                    </label>
                    <input type="text" name="nim_nip" id="nim_nip" value="{{ old('nim_nip', $user->nim_nip) }}"
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
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            No. HP
                        </span>
                    </label>
                    <input type="text" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                        class="w-full px-4 py-3 border-2 {{ $errors->has('no_hp') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                        placeholder="Contoh: 081234567890">
                    <p class="text-xs text-gray-400 mt-1">Hanya angka, tanpa spasi atau tanda hubung</p>
                    @error('no_hp')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Jurusan (dynamic) -->
            <div id="jurusan_container" style="{{ $user->role == 'mahasiswa' ? 'display: block;' : 'display: none;' }}" class="animate-fadeInUp" style="animation-delay: 0.4s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        Jurusan
                    </span>
                </label>
                <input type="text" name="jurusan" value="{{ old('jurusan', $user->jurusan) }}"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('jurusan') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-blue-500' }} rounded-xl focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                    placeholder="Contoh: Teknik Informatika">
                <p class="text-xs text-gray-400 mt-1">Khusus untuk mahasiswa</p>
                @error('jurusan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status User -->
            <div class="bg-gray-50 rounded-xl p-4 animate-fadeInUp" style="animation-delay: 0.4s">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full {{ $user->is_active ? 'bg-green-100' : 'bg-red-100' }} flex items-center justify-center">
                            <svg class="w-5 h-5 {{ $user->is_active ? 'text-green-600' : 'text-red-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Status Akun</p>
                            <p class="text-xs text-gray-500">{{ $user->is_active ? 'Akun aktif dan dapat digunakan' : 'Akun nonaktif' }}</p>
                        </div>
                    </div>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4 pt-4 border-t border-gray-100 animate-fadeInUp" style="animation-delay: 0.5s">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span>Update User</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Toggle Password Visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('svg').classList.toggle('text-blue-500');
        });
    }

    // Dynamic Form berdasarkan Role
    const roleSelect = document.getElementById('role');
    const nimNipLabel = document.getElementById('nim_nip_label');
    const nimNipHint = document.getElementById('nim_nip_hint');
    const nimNipInput = document.getElementById('nim_nip');
    const jurusanContainer = document.getElementById('jurusan_container');

    function updateFormByRole() {
        const role = roleSelect.value;

        if (role === 'mahasiswa') {
            nimNipLabel.innerHTML = '<span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path></svg>NIM <span class="text-red-500">*</span></span>';
            nimNipHint.innerHTML = 'Nomor Induk Mahasiswa (hanya angka, contoh: 202401001)';
            nimNipInput.placeholder = 'Masukkan NIM';
            nimNipInput.required = true;
            jurusanContainer.style.display = 'block';
        } else if (role === 'petugas') {
            nimNipLabel.innerHTML = '<span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path></svg>NIP <span class="text-red-500">*</span></span>';
            nimNipHint.innerHTML = 'Nomor Induk Pegawai (hanya angka, contoh: 198501012010011001)';
            nimNipInput.placeholder = 'Masukkan NIP';
            nimNipInput.required = true;
            jurusanContainer.style.display = 'none';
            document.querySelector('input[name="jurusan"]').value = '';
        } else {
            nimNipLabel.innerHTML = '<span class="flex items-center"><svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path></svg>NIM/NIP</span>';
            nimNipHint.innerHTML = 'Isi jika ada (opsional, hanya angka)';
            nimNipInput.placeholder = 'Masukkan NIM/NIP (opsional)';
            nimNipInput.required = false;
            jurusanContainer.style.display = 'none';
            document.querySelector('input[name="jurusan"]').value = '';
        }
    }

    roleSelect.addEventListener('change', updateFormByRole);

    // Animations
    document.addEventListener('DOMContentLoaded', function() {
        updateFormByRole();

        // Add animation classes
        const elements = document.querySelectorAll('.animate-fadeInUp, .animate-slideInLeft, .animate-slideInRight, .animate-scaleIn');
        elements.forEach(el => {
            el.style.opacity = '1';
        });
    });
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
    @keyframes pulse-slow {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.05); opacity: 0.9; }
    }
    .animate-pulse-slow {
        animation: pulse-slow 2s ease-in-out infinite;
    }
    .btn-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }
</style>
@endsection
