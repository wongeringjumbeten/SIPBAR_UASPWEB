@extends('layouts.V_templateadmin')

@section('title', 'Statistik & Grafik - SIPBAR Admin')
@section('breadcrumb', 'Statistik & Grafik')

@section('content')
<!-- Floating Background -->
<div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
</div>

<div class="relative z-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 animate-fadeInUp">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 rounded-full border-2 border-white animate-pulse"></div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                    <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Statistik & Grafik</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1 ml-3">Analisis data peminjaman barang kampus</p>
            </div>
        </div>
        <div class="flex space-x-3">
            <button onclick="window.print()" class="bg-gradient-to-r from-gray-500 to-gray-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                <span>Cetak Laporan</span>
            </button>

            <!-- Dropdown Export -->
            <div class="relative" x-data="{ open: false }">
                <button onclick="openExportModal()" class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md hover:shadow-lg transition flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    <span>Export Excel</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $totalUsers ?? 0 }}</span>
            </div>
            <p class="font-semibold mt-2">Total User</p>
            <div class="flex justify-between text-xs mt-2 opacity-80">
                <span>Admin: {{ $totalAdmin ?? 0 }}</span>
                <span>Petugas: {{ $totalPetugas ?? 0 }}</span>
                <span>Mahasiswa: {{ $totalMahasiswa ?? 0 }}</span>
            </div>
        </div>

        <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $totalBarang ?? 0 }}</span>
            </div>
            <p class="font-semibold mt-2">Total Barang</p>
            <div class="flex justify-between text-xs mt-2 opacity-80">
                <span>Stok Total: {{ $totalStok ?? 0 }}</span>
                <span>Tersedia: {{ $totalStokTersedia ?? 0 }}</span>
            </div>
        </div>

        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $totalPeminjaman ?? 0 }}</span>
            </div>
            <p class="font-semibold mt-2">Total Peminjaman</p>
            <div class="flex justify-between text-xs mt-2 opacity-80">
                <span>Selesai: {{ $peminjamanSelesai ?? 0 }}</span>
                <span>Aktif: {{ ($peminjamanDisetujui ?? 0) + ($peminjamanDipinjam ?? 0) }}</span>
            </div>
        </div>

        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</span>
            </div>
            <p class="font-semibold mt-2">Total Denda</p>
            <div class="flex justify-between text-xs mt-2 opacity-80">
                <span>Belum Lunas: Rp {{ number_format($dendaBelumLunas ?? 0, 0, ',', '.') }}</span>
                <span>Lunas: Rp {{ number_format($dendaLunas ?? 0, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Chart Peminjaman per Bulan -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg">Peminjaman per Bulan</h3>
            </div>
            <div class="p-6">
                <canvas id="bulanChart" height="250"></canvas>
            </div>
        </div>

        <!-- Chart Peminjaman per Tahun -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg">Peminjaman per Tahun</h3>
            </div>
            <div class="p-6">
                <canvas id="tahunChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Status Peminjaman -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg">Status Peminjaman</h3>
            </div>
            <div class="p-6">
                <canvas id="statusChart" height="250"></canvas>
                <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                    <div class="flex items-center"><div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>Pending: {{ $peminjamanPending ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>Disetujui: {{ $peminjamanDisetujui ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>Dipinjam: {{ $peminjamanDipinjam ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-green-300 rounded-full mr-2"></div>Selesai: {{ $peminjamanSelesai ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>Ditolak: {{ $peminjamanDitolak ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-red-700 rounded-full mr-2"></div>Terlambat: {{ $peminjamanTerlambat ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- Kondisi Barang Kembali -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg">Kondisi Barang Kembali</h3>
            </div>
            <div class="p-6">
                <canvas id="kondisiChart" height="250"></canvas>
                <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                    <div class="flex items-center"><div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>Baik: {{ $kondisiBaik ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>Rusak Ringan: {{ $kondisiRusakRingan ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-orange-500 rounded-full mr-2"></div>Rusak Berat: {{ $kondisiRusakBerat ?? 0 }}</div>
                    <div class="flex items-center"><div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>Hilang: {{ $kondisiHilang ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Top Barang Terpopuler -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg">Top 5 Barang Terpopuler</h3>
            </div>
            <div class="p-6">
                @forelse($topBarang ?? [] as $item)
                <div class="mb-4">
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
                <div class="text-center py-8 text-gray-400">Belum ada data</div>
                @endforelse
            </div>
        </div>

        <!-- Top Peminjam Teraktif -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-lg">Top 5 Peminjam Teraktif</h3>
            </div>
            <div class="p-6">
                @forelse($topPeminjam ?? [] as $item)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl mb-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr($item->mahasiswa->name ?? 'U', 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $item->mahasiswa->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500">NIM: {{ $item->mahasiswa->nim_nip ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="text-xl font-bold text-blue-600">{{ $item->total }}</span>
                        <p class="text-xs text-gray-500">kali pinjam</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-400">Belum ada data</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Export Data -->
<div id="exportModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closeExportModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-modalPop overflow-hidden">
        <!-- Header Modal -->
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4-4m0 0L8 8m4-4v12"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white">Export Data</h3>
                </div>
                <button onclick="closeExportModal()" class="text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Body Modal -->
        <div class="p-6 space-y-3">
            <p class="text-gray-500 text-sm mb-4">Pilih data yang ingin diexport ke Excel:</p>

            <!-- Export Peminjaman -->
            <a href="{{ route('admin.export', 'peminjaman') }}" class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 group-hover:bg-blue-200 transition">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">Data Peminjaman</p>
                    <p class="text-xs text-gray-500">Export semua data peminjaman barang</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>

            <!-- Export Pengembalian -->
            <a href="{{ route('admin.export', 'pengembalian') }}" class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 group-hover:bg-green-200 transition">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">Data Pengembalian</p>
                    <p class="text-xs text-gray-500">Export semua data pengembalian barang</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-green-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>

            <!-- Export User -->
            <a href="{{ route('admin.export', 'user') }}" class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 group-hover:bg-purple-200 transition">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">Data User</p>
                    <p class="text-xs text-gray-500">Export semua data user aktif</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>

            <!-- Export Barang -->
            <a href="{{ route('admin.export', 'barang') }}" class="flex items-center p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition group">
                <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center mr-4 group-hover:scale-110 group-hover:bg-orange-200 transition">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">Data Barang</p>
                    <p class="text-xs text-gray-500">Export semua data inventaris barang</p>
                </div>
                <svg class="w-5 h-5 text-gray-400 group-hover:text-orange-500 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>

        <!-- Footer Modal -->
        <div class="px-6 py-4 border-t border-gray-100 flex justify-end">
            <button onclick="closeExportModal()" class="px-5 py-2 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<style>
    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-modalPop {
        animation: modalPop 0.3s ease-out forwards;
    }
</style>

<script>
    function openExportModal() {
        const modal = document.getElementById('exportModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeExportModal() {
        const modal = document.getElementById('exportModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function closeExportModalOnClick(event) {
        if (event.target === document.getElementById('exportModal')) {
            closeExportModal();
        }
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Peminjaman per Bulan
        new Chart(document.getElementById('bulanChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($bulanLabels ?? []) !!},
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: {!! json_encode($bulanData ?? []) !!},
                    borderColor: 'rgb(99, 102, 241)',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });

        // Chart Peminjaman per Tahun
        new Chart(document.getElementById('tahunChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($tahunLabels ?? []) !!},
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: {!! json_encode($tahunData ?? []) !!},
                    backgroundColor: 'rgba(99, 102, 241, 0.7)',
                    borderRadius: 8
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });

        // Chart Status Peminjaman
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Disetujui', 'Dipinjam', 'Selesai', 'Ditolak', 'Terlambat'],
                datasets: [{
                    data: [
                        {{ $peminjamanPending ?? 0 }},
                        {{ $peminjamanDisetujui ?? 0 }},
                        {{ $peminjamanDipinjam ?? 0 }},
                        {{ $peminjamanSelesai ?? 0 }},
                        {{ $peminjamanDitolak ?? 0 }},
                        {{ $peminjamanTerlambat ?? 0 }}
                    ],
                    backgroundColor: ['#eab308', '#22c55e', '#3b82f6', '#86efac', '#ef4444', '#dc2626']
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });

        // Chart Kondisi Barang
        new Chart(document.getElementById('kondisiChart'), {
            type: 'pie',
            data: {
                labels: ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang'],
                datasets: [{
                    data: [
                        {{ $kondisiBaik ?? 0 }},
                        {{ $kondisiRusakRingan ?? 0 }},
                        {{ $kondisiRusakBerat ?? 0 }},
                        {{ $kondisiHilang ?? 0 }}
                    ],
                    backgroundColor: ['#22c55e', '#eab308', '#f97316', '#ef4444']
                }]
            },
            options: { responsive: true, maintainAspectRatio: true }
        });
    });
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
