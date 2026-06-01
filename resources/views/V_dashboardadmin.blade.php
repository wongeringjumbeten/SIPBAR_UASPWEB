@extends('layouts.V_templateadmin')

@section('title', 'Dashboard Admin - SIPBAR')

@section('content')

<!-- Welcome Hero Section -->
<div class="mb-8 animate-fadeInUp">
    <div class="gradient-bg rounded-3xl p-8 text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 opacity-10">
            <svg class="w-96 h-96" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <div class="relative">
            <div class="flex items-center space-x-2 mb-3">
                <span class="bg-white/20 px-3 py-1 rounded-full text-xs">Hari ini</span>
                <span class="bg-white/20 px-3 py-1 rounded-full text-xs">{{ date('d F Y') }}</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! </h2>
            <p class="text-blue-100 text-lg mb-4">Semangat mengelola sistem peminjaman barang kampus!</p>
            <div class="flex flex-wrap gap-3">
                <div class="bg-white/20 rounded-xl px-4 py-2">
                    <p class="text-xs opacity-75">Total Pendapatan Denda</p>
                    <p class="text-xl font-bold">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/20 rounded-xl px-4 py-2">
                    <p class="text-xs opacity-75">Tingkat Pengembalian</p>
                    <p class="text-xl font-bold">94%</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards Mewah -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card Total User -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.1s">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $totalUsers ?? 0 }}</span>
                <p class="text-green-500 text-sm group-hover:text-green-200">+12% minggu ini</p>
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Total User</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Admin, Petugas, Mahasiswa</p>
        <div class="mt-3 flex items-center text-xs text-purple-500 group-hover:text-purple-200">
            <span>Detail</span>
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </div>

    <!-- Card Total Barang -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.2s">
        <div class="absolute inset-0 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $totalBarang ?? 0 }}</span>
                <p class="text-green-500 text-sm group-hover:text-green-200">+5% minggu ini</p>
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Total Barang</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Semua barang tersedia</p>
        <div class="mt-3 flex items-center text-xs text-pink-500 group-hover:text-pink-200">
            <span>Detail</span>
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </div>

    <!-- Card Peminjaman Aktif -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.3s">
        <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">{{ $peminjamanAktif ?? 0 }}</span>
                <p class="text-red-500 text-sm group-hover:text-red-200">-2% minggu ini</p>
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Peminjaman Aktif</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Sedang berlangsung</p>
        <div class="mt-3 flex items-center text-xs text-cyan-500 group-hover:text-cyan-200">
            <span>Detail</span>
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </div>

    <!-- Card Total Denda -->
    <div class="group relative bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.4s">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 -z-10"></div>
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="text-right">
                <span class="text-3xl font-bold text-gray-800 group-hover:text-white transition-colors duration-300">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</span>
                <p class="text-green-500 text-sm group-hover:text-green-200">+23% minggu ini</p>
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Pendapatan Denda</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Total keseluruhan</p>
        <div class="mt-3 flex items-center text-xs text-emerald-500 group-hover:text-emerald-200">
            <span>Detail</span>
            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </div>
    </div>
</div>

<!-- Charts & Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Chart Card -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.2s">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-lg">Statistik Peminjaman</h3>
            <div class="flex space-x-2">
                <button class="px-3 py-1 text-xs rounded-lg bg-blue-100 text-blue-600 font-semibold">Minggu</button>
                <button class="px-3 py-1 text-xs rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition">Bulan</button>
                <button class="px-3 py-1 text-xs rounded-lg bg-gray-100 text-gray-600 hover:bg-gray-200 transition">Tahun</button>
            </div>
        </div>
        <div class="p-6">
            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-xl">
                <div class="text-center">
                    <svg class="w-20 h-20 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    <p class="text-gray-400">Grafik akan tampil di sini</p>
                    <p class="text-gray-300 text-sm mt-1">Data peminjaman per periode</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.3s">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-lg">Aktivitas Terbaru</h3>
        </div>
        <div class="p-4 space-y-3 max-h-80 overflow-y-auto">
            <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800">User baru ditambahkan</p>
                    <p class="text-xs text-gray-500">Admin menambahkan user baru</p>
                </div>
                <span class="text-xs text-gray-400">2 menit lalu</span>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-xl hover:bg-green-100 transition">
                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800">Peminjaman disetujui</p>
                    <p class="text-xs text-gray-500">Petugas menyetujui peminjaman</p>
                </div>
                <span class="text-xs text-gray-400">1 jam lalu</span>
            </div>
            <div class="flex items-center space-x-3 p-3 bg-yellow-50 rounded-xl hover:bg-yellow-100 transition">
                <div class="w-10 h-10 bg-yellow-500 rounded-full flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-semibold text-gray-800">Pengembalian barang</p>
                    <p class="text-xs text-gray-500">Mahasiswa mengembalikan barang</p>
                </div>
                <span class="text-xs text-gray-400">3 jam lalu</span>
            </div>
        </div>
    </div>
</div>

<!-- Top Barang & Quick Access -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Top Barang Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.4s">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-lg">Barang Paling Sering Dipinjam</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Laptop Asus ROG</span>
                        <span class="text-sm text-gray-500">24 kali</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 h-2 rounded-full" style="width: 85%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Projector Epson</span>
                        <span class="text-sm text-gray-500">18 kali</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-pink-500 to-rose-500 h-2 rounded-full" style="width: 65%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Whiteboard</span>
                        <span class="text-sm text-gray-500">12 kali</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">Kamera DSLR</span>
                        <span class="text-sm text-gray-500">8 kali</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Access Card Mewah -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.5s">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-lg">Akses Cepat</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-2 gap-4">
                <a href="{{ route('user.create') }}" class="group relative bg-gradient-to-br from-purple-500 to-indigo-600 rounded-xl p-5 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <svg class="w-10 h-10 text-white mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    <p class="text-white font-semibold">Tambah User</p>
                    <p class="text-white text-xs opacity-75 mt-1">Kelola akun baru</p>
                </a>
                <a href="#" class="group relative bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-5 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <svg class="w-10 h-10 text-white mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="text-white font-semibold">Tambah Barang</p>
                    <p class="text-white text-xs opacity-75 mt-1">Tambah inventaris</p>
                </a>
                <a href="#" class="group relative bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl p-5 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <svg class="w-10 h-10 text-white mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                    </svg>
                    <p class="text-white font-semibold">Tambah Kategori</p>
                    <p class="text-white text-xs opacity-75 mt-1">Kelompokkan barang</p>
                </a>
                <a href="#" class="group relative bg-gradient-to-br from-orange-500 to-red-600 rounded-xl p-5 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <svg class="w-10 h-10 text-white mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    <p class="text-white font-semibold">Export Laporan</p>
                    <p class="text-white text-xs opacity-75 mt-1">PDF & Excel</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- User Distribution & Info -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-6">
    <!-- User Distribution -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.6s">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-lg">Distribusi User</h3>
        </div>
        <div class="p-6">
            <div class="flex justify-around text-center">
                <div>
                    <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center mx-auto mb-2">
                        <span class="text-2xl font-bold text-purple-600">{{ $totalAdmin ?? 0 }}</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Admin</p>
                </div>
                <div>
                    <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-2">
                        <span class="text-2xl font-bold text-blue-600">{{ $totalPetugas ?? 0 }}</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Petugas</p>
                </div>
                <div>
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-2">
                        <span class="text-2xl font-bold text-green-600">{{ $totalMahasiswa ?? 0 }}</span>
                    </div>
                    <p class="text-sm font-semibold text-gray-700">Mahasiswa</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Penting -->
    <div class="lg:col-span-2 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.7s">
        <div class="px-6 py-4 border-b border-white/20">
            <h3 class="font-bold text-white text-lg">Pengumuman Penting</h3>
        </div>
        <div class="p-6 text-white">
            <div class="space-y-3">
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm opacity-90">Pastikan data barang selalu update setiap awal bulan</p>
                </div>
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm opacity-90">Lakukan backup data secara rutin untuk menghindari kehilangan data</p>
                </div>
                <div class="flex items-start space-x-3">
                    <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm opacity-90">Sistem maintenance setiap hari Minggu pukul 02:00 - 04:00 WIB</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.2);
    }
    .animate-scaleIn {
        animation: scaleIn 0.5s ease-out forwards;
    }
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
</style>

@endsection
