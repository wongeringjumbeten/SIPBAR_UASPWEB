@extends('layouts.V_templateadmin')

@section('breadcrumb', 'Kelola Barang')
@section('title', 'Kelola Barang - SIPBAR Admin')

@section('content')
<!-- Header Section dengan Animasi Mewah -->
<div class="mb-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="animate-slideInLeft">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full border-2 border-white animate-pulse"></div>
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <div class="w-1 h-8 bg-gradient-to-b from-emerald-500 to-teal-500 rounded-full"></div>
                        <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Kelola Barang</h1>
                    </div>
                    <p class="text-gray-500 text-sm mt-1 ml-3">Kelola inventaris barang kampus dengan mudah</p>
                </div>
            </div>
        </div>
        <a href="{{ route('barang.create') }}" class="group relative animate-slideInRight overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            <div class="relative bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2 group-hover:scale-105">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-semibold">Tambah Barang</span>
            </div>
        </a>
    </div>
</div>

<!-- Alert Success -->
@if(session('success'))
<div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 animate-slideInRight">
    <div class="flex items-center">
        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        <span class="font-semibold">{{ session('success') }}</span>
    </div>
</div>
@endif

<!-- Stats Cards Ringkasan -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    <div class="group bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl p-5 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.1s">
        <div class="flex items-center justify-between">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <span class="text-3xl font-bold">{{ $totalBarang ?? 0 }}</span>
        </div>
        <p class="font-semibold mt-3">Total Barang</p>
        <p class="text-xs opacity-80">Seluruh inventaris</p>
    </div>

    <div class="group bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl p-5 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.15s">
        <div class="flex items-center justify-between">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="text-3xl font-bold">{{ $barangTersedia ?? 0 }}</span>
        </div>
        <p class="font-semibold mt-3">Tersedia</p>
        <p class="text-xs opacity-80">Stok siap pakai</p>
    </div>

    <div class="group bg-gradient-to-r from-amber-500 to-orange-500 rounded-2xl p-5 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.2s">
        <div class="flex items-center justify-between">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <span class="text-3xl font-bold">{{ $barangDipinjam ?? 0 }}</span>
        </div>
        <p class="font-semibold mt-3">Sedang Dipinjam</p>
        <p class="text-xs opacity-80">Tidak tersedia sementara</p>
    </div>

    <div class="group bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl p-5 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.25s">
        <div class="flex items-center justify-between">
            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                </svg>
            </div>
            <span class="text-3xl font-bold">{{ $totalKategori ?? 0 }}</span>
        </div>
        <p class="font-semibold mt-3">Kategori</p>
        <p class="text-xs opacity-80">Jenis barang</p>
    </div>
</div>

<!-- Filter & Search Bar -->
<div class="bg-white rounded-2xl shadow-lg p-5 mb-6 animate-fadeInUp" style="animation-delay: 0.3s">
    <div class="flex flex-col md:flex-row gap-4">
        <div class="flex-1 relative group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" id="searchInput" placeholder="Cari barang berdasarkan nama atau kode..."
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-300">
        </div>
        <div class="flex gap-3">
            <select id="filterKategori" class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-300">
                <option value="">Semua Kategori</option>
                @foreach($kategoris ?? [] as $kategori)
                <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                @endforeach
            </select>
            <select id="filterKondisi" class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition-all duration-300">
                <option value="">Semua Kondisi</option>
                <option value="baik">Baik</option>
                <option value="rusak_ringan">Rusak Ringan</option>
                <option value="rusak_berat">Rusak Berat</option>
            </select>
            <button onclick="resetFilters()" class="px-5 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition-all duration-300 flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                <span>Reset</span>
            </button>
        </div>
    </div>
</div>

<!-- Barang Grid View - ANTI MAINSTREAM -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="barangGrid">
    @forelse($barangs ?? [] as $barang)
    <div class="group barang-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" data-nama="{{ $barang->nama_barang }}" data-kode="{{ $barang->kode_barang }}" data-kategori="{{ $barang->kategori->nama_kategori ?? '-' }}" data-kondisi="{{ $barang->kondisi }}">
        <!-- Badge Kondisi -->
        <div class="relative">
            <div class="absolute top-3 left-3 z-10">
                @if($barang->kondisi == 'baik')
                    <span class="px-2 py-1 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs rounded-full shadow-lg">Baik</span>
                @elseif($barang->kondisi == 'rusak_ringan')
                    <span class="px-2 py-1 bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs rounded-full shadow-lg">Rusak Ringan</span>
                @else
                    <span class="px-2 py-1 bg-gradient-to-r from-red-500 to-rose-500 text-white text-xs rounded-full shadow-lg">Rusak Berat</span>
                @endif
            </div>
            <div class="absolute top-3 right-3 z-10">
                <div class="relative group/aksi">
                    <button class="w-8 h-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center shadow-md hover:bg-white transition-all">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover/aksi:opacity-100 group-hover/aksi:visible transition-all duration-300 z-20">
                        <a href="{{ route('barang.edit', $barang->id) }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-t-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            <span>Edit</span>
                        </a>
                        <form action="#" method="POST" class="block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center space-x-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-xl transition w-full" onclick="return confirm('Hapus barang ini?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Image Placeholder -->
            <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                <div class="w-24 h-24 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-5">
            <div class="flex items-start justify-between mb-3">
                <div>
                    <h3 class="font-bold text-lg text-gray-800 line-clamp-1">{{ $barang->nama_barang }}</h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $barang->kode_barang }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">Kategori</p>
                    <p class="text-sm font-semibold text-emerald-600">{{ $barang->kategori->nama_kategori ?? '-' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3 mb-4">
                <div class="bg-gray-50 rounded-xl p-2 text-center">
                    <p class="text-xs text-gray-400">Stok Total</p>
                    <p class="text-xl font-bold text-gray-800">{{ $barang->stok }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-2 text-center">
                    <p class="text-xs text-gray-400">Stok Tersedia</p>
                    <p class="text-xl font-bold {{ $barang->stok_tersedia > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $barang->stok_tersedia }}</p>
                </div>
            </div>

            <div class="flex items-center justify-between text-sm mb-3">
                <div class="flex items-center space-x-1 text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span>{{ $barang->lokasi ?? 'Tidak ada lokasi' }}</span>
                </div>
                <div class="flex items-center space-x-1 text-gray-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Rp {{ number_format($barang->denda_per_hari ?? 0, 0, ',', '.') }}/hari</span>
                </div>
            </div>

            <div class="pt-3 border-t border-gray-100 flex items-center justify-between">
                <div class="flex -space-x-2">
                    <div class="w-7 h-7 bg-emerald-100 rounded-full flex items-center justify-center text-[10px] font-bold text-emerald-600 border-2 border-white">ST</div>
                    <div class="w-7 h-7 bg-blue-100 rounded-full flex items-center justify-center text-[10px] font-bold text-blue-600 border-2 border-white">{{ substr($barang->nama_barang, 0, 2) }}</div>
                </div>
                <a href="{{ route('barang.show', $barang->id) }}" class="text-emerald-600 hover:text-emerald-700 text-sm font-semibold flex items-center space-x-1 group">
                    <span>Detail</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @empty
    <!-- Empty State Mewah -->
    <div class="col-span-full">
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-12 text-center animate-scaleIn">
            <div class="relative inline-block mb-6">
                <div class="w-32 h-32 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto animate-float">
                    <svg class="w-16 h-16 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-pulse">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Data Barang</h3>
            <p class="text-gray-500 mb-6 max-w-md mx-auto">Yuk, mulai tambahkan barang ke dalam sistem agar mahasiswa dapat melakukan peminjaman dengan mudah.</p>
            <a href="{{ route('barang.create') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span class="font-semibold">Tambah Barang Sekarang</span>
            </a>
        </div>
    </div>
    @endforelse
</div>

@if(count($barangs ?? []) > 0)
<!-- Pagination -->
<div class="mt-8 flex justify-center animate-fadeInUp">
    {{-- $barangs->links() --}}
    <div class="flex space-x-2">
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition">Previous</button>
        <button class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg shadow-md">1</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition">2</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition">3</button>
        <button class="px-4 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition">Next</button>
    </div>
</div>
@endif

<script>
    // Search and Filter Functionality
    const searchInput = document.getElementById('searchInput');
    const filterKategori = document.getElementById('filterKategori');
    const filterKondisi = document.getElementById('filterKondisi');
    const barangCards = document.querySelectorAll('.barang-card');

    function filterBarang() {
        const searchTerm = searchInput.value.toLowerCase();
        const kategoriTerm = filterKategori.value.toLowerCase();
        const kondisiTerm = filterKondisi.value.toLowerCase();

        barangCards.forEach(card => {
            const nama = card.dataset.nama?.toLowerCase() || '';
            const kode = card.dataset.kode?.toLowerCase() || '';
            const kategori = card.dataset.kategori?.toLowerCase() || '';
            const kondisi = card.dataset.kondisi?.toLowerCase() || '';

            const matchesSearch = searchTerm === '' || nama.includes(searchTerm) || kode.includes(searchTerm);
            const matchesKategori = kategoriTerm === '' || kategori === kategoriTerm;
            const matchesKondisi = kondisiTerm === '' || kondisi === kondisiTerm;

            if (matchesSearch && matchesKategori && matchesKondisi) {
                card.style.display = 'block';
                card.classList.add('animate-scaleIn');
            } else {
                card.style.display = 'none';
            }
        });
    }

    function resetFilters() {
        searchInput.value = '';
        filterKategori.value = '';
        filterKondisi.value = '';
        filterBarang();
    }

    searchInput.addEventListener('keyup', filterBarang);
    filterKategori.addEventListener('change', filterBarang);
    filterKondisi.addEventListener('change', filterBarang);
</script>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    @keyframes scaleIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    .animate-scaleIn {
        animation: scaleIn 0.4s ease-out forwards;
    }
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
