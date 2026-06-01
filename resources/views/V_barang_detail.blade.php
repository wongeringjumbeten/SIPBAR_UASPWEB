@extends('layouts.V_templateadmin')

@section('title', 'Detail Barang - SIPBAR Admin')
@section('breadcrumb', 'Detail Barang')

@section('content')
<div class="max-w-5xl mx-auto">
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
                <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Detail Barang</h1>
            </div>
            <p class="text-gray-500 text-sm mt-1 ml-3">Informasi lengkap data inventaris barang</p>
        </div>
    </div>

    <!-- Detail Card -->
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-scaleIn">
        <!-- Hero Section dengan Logo SVG & Gradien Animasi -->
        <div class="relative h-56 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 animate-gradient">
            <div class="absolute inset-0 bg-black/20"></div>

            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="url(#pattern)"/>
                </svg>
            </div>

            <!-- Floating Logo SVG -->
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="w-24 h-24 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center shadow-2xl animate-float">
                    <svg class="w-14 h-14 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>

            <!-- Badge Kondisi di pojok kanan atas -->
            <div class="absolute top-4 right-4 z-10">
                @if($barang->kondisi == 'baik')
                    <div class="px-3 py-1 bg-green-500/90 backdrop-blur rounded-full text-white text-xs font-semibold flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span>Kondisi Baik</span>
                    </div>
                @elseif($barang->kondisi == 'rusak_ringan')
                    <div class="px-3 py-1 bg-yellow-500/90 backdrop-blur rounded-full text-white text-xs font-semibold flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Rusak Ringan</span>
                    </div>
                @else
                    <div class="px-3 py-1 bg-red-500/90 backdrop-blur rounded-full text-white text-xs font-semibold flex items-center space-x-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>Rusak Berat</span>
                    </div>
                @endif
            </div>

            <!-- Kode Barang di pojok kiri bawah -->
            <div class="absolute bottom-4 left-4 z-10">
                <div class="px-3 py-1 bg-black/50 backdrop-blur rounded-full text-white text-xs font-mono">
                    {{ $barang->kode_barang }}
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Info Barang -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Nama Barang -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $barang->nama_barang }}</h2>
                        <p class="text-sm text-gray-500 mt-1">Kategori: {{ $barang->kategori->nama_kategori ?? '-' }}</p>
                    </div>

                    <!-- Informasi Umum Card -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg text-gray-800">Informasi Umum</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-gray-400">Lokasi Penyimpanan</p>
                                <p class="font-semibold text-gray-800">{{ $barang->lokasi ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-400">Denda per Hari</p>
                                <p class="font-semibold text-red-600">Rp {{ number_format($barang->denda_per_hari, 0, ',', '.') }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-gray-400">Deskripsi</p>
                                <p class="text-gray-700 mt-1">{{ $barang->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Statistik Stok Card -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-cyan-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg text-gray-800">Statistik Stok</h3>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white rounded-xl p-4 text-center">
                                <p class="text-xs text-gray-400">Stok Total</p>
                                <p class="text-2xl font-bold text-gray-800">{{ $barang->stok }}</p>
                            </div>
                            <div class="bg-white rounded-xl p-4 text-center">
                                <p class="text-xs text-gray-400">Stok Tersedia</p>
                                <p class="text-2xl font-bold {{ $barang->stok_tersedia > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $barang->stok_tersedia }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-600">Ketersediaan</span>
                                <span class="text-gray-600">{{ round(($barang->stok_tersedia / max($barang->stok, 1)) * 100) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 rounded-full" style="width: {{ ($barang->stok_tersedia / max($barang->stok, 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Riwayat Peminjaman Card -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg text-gray-800">Riwayat Peminjaman</h3>
                        </div>
                        <div class="space-y-3">
                            @forelse($barang->detailPeminjaman ?? [] as $detail)
                            <div class="bg-white rounded-xl p-3 flex items-center justify-between">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $detail->peminjaman->kode_peminjaman ?? '-' }}</p>
                                    <p class="text-xs text-gray-500">Jumlah: {{ $detail->jumlah }} unit</p>
                                </div>
                                <div class="text-right">
                                    <span class="text-xs px-2 py-1 rounded-full
                                        {{ $detail->peminjaman->status == 'selesai' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ $detail->peminjaman->status ?? '-' }}
                                    </span>
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-6 text-gray-400">
                                <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <p>Belum ada riwayat peminjaman</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column - Foto & Tombol Aksi -->
                <div class="space-y-6">
                    <!-- Foto Barang Card -->
                    <div class="bg-gray-50 rounded-xl p-5">
                        <div class="flex items-center space-x-3 mb-4">
                            <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg text-gray-800">Foto Barang</h3>
                        </div>
                        <div class="flex justify-center mb-4">
                            @if($barang->foto && file_exists(public_path($barang->foto)))
                                <img src="{{ asset($barang->foto) }}" alt="{{ $barang->nama_barang }}"
                                     class="w-48 h-48 object-cover rounded-2xl shadow-lg hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-48 h-48 bg-gradient-to-r from-gray-200 to-gray-300 rounded-2xl flex items-center justify-center">
                                    <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Tombol Aksi (Edit & Hapus) di bawah foto -->
                        <div class="flex flex-col space-y-3">
                            <a href="{{ route('barang.edit', $barang->id) }}"
                               class="flex items-center justify-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span>Edit Barang</span>
                            </a>
                            <button onclick="confirmDelete({{ $barang->id }})"
                                    class="flex items-center justify-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <span>Hapus Barang</span>
                            </button>
                            <a href="{{ route('barang.index') }}"
                               class="flex items-center justify-center space-x-2 px-5 py-2.5 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition-all hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                <span>Kembali ke Daftar</span>
                            </a>
                        </div>
                    </div>

                    <!-- Info Tambahan Card -->
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl p-5 text-white animate-gradient">
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-bold text-lg">Info Tambahan</h3>
                        </div>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="opacity-80">Dibuat pada</span>
                                <span class="font-semibold">{{ \Carbon\Carbon::parse($barang->created_at)->translatedFormat('d F Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="opacity-80">Terakhir update</span>
                                <span class="font-semibold">{{ \Carbon\Carbon::parse($barang->updated_at)->translatedFormat('d F Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Yakin ingin menghapus barang ini? Data tidak akan hilang permanen (soft delete).')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/barang/${id}`;
            form.innerHTML = `
                @csrf
                @method('DELETE')
            `;
            document.body.appendChild(form);
            form.submit();
        }
    }
</script>

<style>
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-scaleIn {
        animation: scaleIn 0.4s ease-out forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
        animation: fadeInUp 0.4s ease-out forwards;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 3s ease infinite;
    }
</style>
@endsection
