@extends('layouts.V_templateadmin')

@section('title', 'Tambah Barang - SIPBAR Admin')
@section('breadcrumb', 'Tambah Barang')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header Mewah dengan Animasi -->
    <div class="flex items-center space-x-4 mb-8 animate-fadeInUp">
        <a href="{{ route('barang.index') }}" class="group relative">
            <div class="w-12 h-12 bg-white rounded-2xl shadow-lg flex items-center justify-center group-hover:shadow-xl group-hover:-translate-x-1 transition-all duration-300 border border-gray-100">
                <svg class="w-5 h-5 text-gray-600 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </div>
        </a>
        <div>
            <div class="flex items-center space-x-2">
                <div class="w-1 h-8 bg-gradient-to-b from-emerald-500 to-teal-500 rounded-full"></div>
                <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Tambah Barang</h1>
            </div>
            <p class="text-gray-500 text-sm mt-1 ml-3">Tambahkan inventaris barang baru ke sistem</p>
        </div>
    </div>

    <!-- Alert Error Global -->
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
                    <div class="w-14 h-14 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-emerald-500 rounded-full border-2 border-white animate-pulse"></div>
                </div>
                <div>
                    <h3 class="font-bold text-xl text-gray-800">Form Tambah Barang</h3>
                    <p class="text-sm text-gray-500 mt-0.5">Lengkapi data di bawah ini dengan benar</p>
                </div>
            </div>
        </div>

        <!-- Form Body -->
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kode Barang -->
                <div class="animate-slideInLeft" style="animation-delay: 0.1s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path>
                            </svg>
                            <span>Kode Barang</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                            </svg>
                        </div>
                        <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" required
                            class="w-full pl-10 pr-4 py-3 border-2 {{ $errors->has('kode_barang') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300"
                            placeholder="Contoh: BRG-001">
                    </div>
                    @error('kode_barang')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Barang -->
                <div class="animate-slideInRight" style="animation-delay: 0.1s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                            <span>Nama Barang</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <input type="text" name="nama_barang" value="{{ old('nama_barang') }}" required
                            class="w-full pl-10 pr-4 py-3 border-2 {{ $errors->has('nama_barang') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300"
                            placeholder="Contoh: Laptop Asus ROG">
                    </div>
                    @error('nama_barang')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kategori -->
                <div class="animate-slideInLeft" style="animation-delay: 0.15s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                            </svg>
                            <span>Kategori</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori_id" required
                        class="w-full px-4 py-3 border-2 {{ $errors->has('kategori_id') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kondisi -->
                <div class="animate-slideInRight" style="animation-delay: 0.15s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Kondisi</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="relative flex cursor-pointer">
                            <input type="radio" name="kondisi" value="baik" class="peer sr-only" {{ old('kondisi') == 'baik' ? 'checked' : '' }}>
                            <div class="w-full p-3 text-center rounded-xl border-2 border-gray-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition-all duration-300">
                                <span class="text-green-600 text-lg"></span>
                                <p class="text-sm font-semibold mt-1">Baik</p>
                            </div>
                        </label>
                        <label class="relative flex cursor-pointer">
                            <input type="radio" name="kondisi" value="rusak_ringan" class="peer sr-only" {{ old('kondisi') == 'rusak_ringan' ? 'checked' : '' }}>
                            <div class="w-full p-3 text-center rounded-xl border-2 border-gray-200 peer-checked:border-yellow-500 peer-checked:bg-yellow-50 transition-all duration-300">
                                <span class="text-yellow-600 text-lg"></span>
                                <p class="text-sm font-semibold mt-1">Rusak Ringan</p>
                            </div>
                        </label>
                        <label class="relative flex cursor-pointer">
                            <input type="radio" name="kondisi" value="rusak_berat" class="peer sr-only" {{ old('kondisi') == 'rusak_berat' ? 'checked' : '' }}>
                            <div class="w-full p-3 text-center rounded-xl border-2 border-gray-200 peer-checked:border-red-500 peer-checked:bg-red-50 transition-all duration-300">
                                <span class="text-red-600 text-lg"></span>
                                <p class="text-sm font-semibold mt-1">Rusak Berat</p>
                            </div>
                        </label>
                    </div>
                    @error('kondisi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Stok Total -->
                <div class="animate-slideInLeft" style="animation-delay: 0.2s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>Stok Total</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stok" value="{{ old('stok') }}" required min="0"
                        class="w-full px-4 py-3 border-2 {{ $errors->has('stok') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300"
                        placeholder="0">
                    @error('stok')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Stok Tersedia -->
                <div class="animate-slideInRight" style="animation-delay: 0.2s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Stok Tersedia</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="stok_tersedia" value="{{ old('stok_tersedia') }}" required min="0"
                        class="w-full px-4 py-3 border-2 {{ $errors->has('stok_tersedia') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300"
                        placeholder="0">
                    @error('stok_tersedia')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Lokasi -->
                <div class="animate-slideInLeft" style="animation-delay: 0.25s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Lokasi Penyimpanan</span>
                        </div>
                    </label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}"
                        class="w-full px-4 py-3 border-2 {{ $errors->has('lokasi') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300"
                        placeholder="Contoh: Rak A-1, Gudang Utama">
                    @error('lokasi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Denda per Hari -->
                <div class="animate-slideInRight" style="animation-delay: 0.25s">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Denda per Hari</span>
                        </div>
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 font-semibold">Rp</span>
                        </div>
                        <input type="number" name="denda_per_hari" value="{{ old('denda_per_hari') }}" required min="0"
                            class="w-full pl-12 pr-4 py-3 border-2 {{ $errors->has('denda_per_hari') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300"
                            placeholder="0">
                    </div>
                    @error('denda_per_hari')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Upload Foto (WAJIB) -->
            <div class="animate-fadeInUp" style="animation-delay: 0.3s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Foto Barang</span>
                    </div>
                    <span class="text-red-500">*</span>
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-emerald-500 transition-all duration-300" id="dropzone">
                    <div class="space-y-2 text-center">
                        <div class="w-20 h-20 mx-auto bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center animate-float">
                            <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div class="flex text-sm text-gray-600">
                            <label for="foto" class="relative cursor-pointer bg-white rounded-md font-semibold text-emerald-600 hover:text-emerald-500 focus-within:outline-none">
                                <span>Upload file</span>
                                <input id="foto" name="foto" type="file" class="sr-only" accept="image/*" required onchange="previewImage(event)">
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                        <div id="imagePreview" class="hidden mt-3">
                            <img id="previewImg" class="w-32 h-32 object-cover rounded-xl shadow-lg mx-auto">
                            <button type="button" onclick="removeImage()" class="mt-2 text-xs text-red-500 hover:text-red-700">Hapus</button>
                        </div>
                    </div>
                </div>
                @error('foto')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="animate-fadeInUp" style="animation-delay: 0.35s">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                        </svg>
                        <span>Deskripsi</span>
                    </div>
                </label>
                <textarea name="deskripsi" rows="4"
                    class="w-full px-4 py-3 border-2 {{ $errors->has('deskripsi') ? 'border-red-500 bg-red-50' : 'border-gray-200 focus:border-emerald-500' }} rounded-xl focus:ring-2 focus:ring-emerald-200 transition-all duration-300"
                    placeholder="Deskripsikan barang ini...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-100 animate-fadeInUp" style="animation-delay: 0.4s">
                <a href="{{ route('barang.index') }}"
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
                    <span>Simpan Barang</span>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Image Preview
    function previewImage(event) {
        const input = event.target;
        const previewContainer = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        const input = document.getElementById('foto');
        const previewContainer = document.getElementById('imagePreview');
        input.value = '';
        previewContainer.classList.add('hidden');
    }

    // Drag and drop
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('foto');

    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-emerald-500', 'bg-emerald-50');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-emerald-500', 'bg-emerald-50');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-emerald-500', 'bg-emerald-50');
        const files = e.dataTransfer.files;
        if (files.length) {
            fileInput.files = files;
            previewImage({ target: fileInput });
        }
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
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }
    .animate-pulse {
        animation: pulse 2s ease-in-out infinite;
    }
    .btn-gradient {
        background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg, #059669 0%, #0d9488 100%);
    }
</style>
@endsection
