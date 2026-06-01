@extends('layouts.V_templatepetugas')

@section('title', 'Dashboard Petugas - SIPBAR')
@section('breadcrumb', 'Dashboard')

@section('content')
<!-- Floating Background -->
<div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
</div>

<div class="relative z-10">
    <!-- Welcome Section -->
    <div class="mb-8 animate-fadeInUp">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 opacity-10">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
            </div>
            <div class="relative">
                <div class="flex items-center space-x-2 mb-3">
                    <span class="bg-white/20 px-3 py-1 rounded-full text-xs backdrop-blur-sm">Hari ini</span>
                    <span class="bg-white/20 px-3 py-1 rounded-full text-xs backdrop-blur-sm">{{ date('d F Y') }}</span>
                    <span class="bg-white/20 px-3 py-1 rounded-full text-xs backdrop-blur-sm">{{ date('H:i') }} WIB</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                <p class="text-blue-100 text-lg">Kelola peminjaman barang dengan mudah dan cepat</p>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $pendingCount ?? 0 }}</span>
            </div>
            <h3 class="font-semibold text-lg">Pending</h3>
            <p class="text-sm opacity-80">Menunggu persetujuan</p>
        </div>

        <div class="bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $dipinjamCount ?? 0 }}</span>
            </div>
            <h3 class="font-semibold text-lg">Dipinjam</h3>
            <p class="text-sm opacity-80">Barang sedang dipinjam</p>
        </div>

        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $terlambatCount ?? 0 }}</span>
            </div>
            <h3 class="font-semibold text-lg">Terlambat</h3>
            <p class="text-sm opacity-80">Melebihi batas waktu</p>
        </div>

        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl p-6 text-white shadow-lg card-hover animate-scaleIn">
            <div class="flex items-center justify-between mb-3">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $totalPeminjaman ?? 0 }}</span>
            </div>
            <h3 class="font-semibold text-lg">Total Peminjaman</h3>
            <p class="text-sm opacity-80">Keseluruhan</p>
        </div>
    </div>

    <!-- Recent Pending Loans -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800 animate-slideInLeft">Pengajuan Pending Terbaru</h3>
            <a href="{{ route('petugas.pengajuan.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold animate-slideInRight flex items-center space-x-1">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pengajuanTerbaru ?? [] as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->kode_peminjaman }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $item->mahasiswa->name ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">NIM: {{ $item->mahasiswa->nim_nip ?? '-' }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                @foreach($item->detailPeminjaman as $detail)
                                    {{ $detail->barang->nama_barang }} ({{ $detail->jumlah }})
                                    @if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ \Carbon\Carbon::parse($item->tgl_kembali_rencana)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <button onclick="openApproveModal({{ $item->id }})" class="px-3 py-1 bg-green-500 text-white text-xs rounded-lg hover:bg-green-600 transition">Setuju</button>
                                    <button onclick="openRejectModal({{ $item->id }})" class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600 transition">Tolak</button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p>Tidak ada pengajuan pending</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl p-6 text-white card-hover animate-scaleIn">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Aturan Peminjaman</h4>
                    <p class="text-sm opacity-90">Maksimal 3 barang per mahasiswa. Durasi pinjam 3-7 hari.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-r from-teal-400 to-cyan-500 rounded-2xl p-6 text-white card-hover animate-scaleIn">
            <div class="flex items-start space-x-4">
                <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Denda Keterlambatan</h4>
                    <p class="text-sm opacity-90">Rp 5.000 - Rp 25.000/hari tergantung jenis barang.</p>
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
@endsection
