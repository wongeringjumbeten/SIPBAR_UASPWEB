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
            <h2 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
            <p class="text-blue-100 text-lg mb-4">Semangat mengelola sistem peminjaman barang kampus!</p>
            <div class="flex flex-wrap gap-3">
                <div class="bg-white/20 rounded-xl px-4 py-2">
                    <p class="text-xs opacity-75">Total Pendapatan Denda</p>
                    <p class="text-xl font-bold">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white/20 rounded-xl px-4 py-2">
                    <p class="text-xs opacity-75">Tingkat Pengembalian</p>
                    <p class="text-xl font-bold">{{ $tingkatPengembalian ?? 0 }}%</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards Mewah dengan Data Real -->
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
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Total User</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Admin, Petugas, Mahasiswa</p>

        <!-- Shortcut ke Pengajuan Akun -->
        <div class="mt-3 flex items-center justify-between">
            <a href="{{ route('user.index') }}" class="flex items-center text-xs text-purple-500 group-hover:text-purple-200">
                <span>Kelola User</span>
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
            <a href="{{ route('admin.pengajuan-akun.index') }}" class="flex items-center text-xs text-yellow-500 group-hover:text-yellow-200">
                @if($pendingApproval > 0)
                <span class="bg-red-500 text-white px-1.5 py-0.5 rounded-full text-xs mr-1 animate-pulse">{{ $pendingApproval }}</span>
                @endif
                <span>Pengajuan Akun</span>
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
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
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Total Barang</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Semua barang tersedia</p>
        <div class="mt-3 flex items-center text-xs text-pink-500 group-hover:text-pink-200">
            <a href="{{ route('barang.index') }}" class="flex items-center">
                <span>Kelola Barang</span>
                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
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
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Peminjaman Aktif</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Sedang berlangsung</p>
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
            </div>
        </div>
        <h3 class="text-gray-600 font-semibold group-hover:text-white transition-colors duration-300">Pendapatan Denda</h3>
        <p class="text-gray-400 text-sm mt-1 group-hover:text-gray-300">Total keseluruhan</p>
    </div>
</div>

<!-- Chart & Top Barang -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Chart Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.2s">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-lg">Statistik Peminjaman</h3>
        </div>
        <div class="p-6">
            <div class="h-80">
                <canvas id="peminjamanChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Barang Card (Data Real) -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.3s">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="font-bold text-gray-800 text-lg">Barang Paling Sering Dipinjam</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($topBarang ?? [] as $item)
                <div>
                    <div class="flex justify-between mb-1">
                        <span class="text-sm font-medium text-gray-700">{{ $item->nama_barang }}</span>
                        <span class="text-sm text-gray-500">{{ $item->total_dipinjam }} kali</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        @php
                            $maxCount = $topBarang->first()->total_dipinjam ?? 1;
                            $percentage = ($item->total_dipinjam / $maxCount) * 100;
                        @endphp
                        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400">
                    <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p>Belum ada data peminjaman</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Recent Peminjaman Table -->
<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold text-gray-800 animate-slideInLeft">Peminjaman Terbaru</h3>
        <a href="{{ route('admin.peminjaman.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold animate-slideInRight flex items-center space-x-1">
            <span>Lihat Semua</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden animate-scaleIn">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($peminjamanTerbaru ?? [] as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->kode_peminjaman }}</td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $item->mahasiswa->name ?? '-' }}</p>
                                <p class="text-xs text-gray-500">NIM: {{ $item->mahasiswa->nim_nip ?? '-' }}</p>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->tgl_kembali_rencana)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            @if($item->status == 'pending')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu</span>
                            @elseif($item->status == 'disetujui')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                            @elseif($item->status == 'dipinjam')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Dipinjam</span>
                            @elseif($item->status == 'selesai')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                            @elseif($item->status == 'ditolak')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                            @elseif($item->status == 'terlambat')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p>Belum ada peminjaman</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Quick Access & Info -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Quick Access Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.4s">
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
                <a href="{{ route('barang.create') }}" class="group relative bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl p-5 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <svg class="w-10 h-10 text-white mx-auto mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <p class="text-white font-semibold">Tambah Barang</p>
                    <p class="text-white text-xs opacity-75 mt-1">Tambah inventaris</p>
                </a>
                <a href="{{ route('kategori.create') }}" class="group relative bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl p-5 text-center hover:shadow-2xl transition-all duration-300 hover:-translate-y-1 overflow-hidden">
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

    <!-- User Distribution -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn" style="animation-delay: 0.5s">
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
</div>

<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.2);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Peminjaman
        const ctx = document.getElementById('peminjamanChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels ?? []) !!},
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: {!! json_encode($chartData ?? []) !!},
                    borderColor: 'rgb(99, 102, 241)',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgb(99, 102, 241)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Peminjaman'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Periode'
                        }
                    }
                }
            }
        });
    });
</script>
@endsection
