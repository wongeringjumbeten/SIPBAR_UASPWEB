@extends('layouts.V_templateadmin')

@section('title', 'Kelola Kategori - SIPBAR Admin')
@section('breadcrumb', 'Kelola Kategori')

@section('content')
<div class="max-w-6xl mx-auto">
    <!-- Header Section dengan Animasi Mewah -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="animate-slideInLeft">
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="w-14 h-14 bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                            </svg>
                        </div>
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full border-2 border-white animate-pulse"></div>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <div class="w-1 h-8 bg-gradient-to-b from-purple-500 to-pink-500 rounded-full"></div>
                            <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Kelola Kategori</h1>
                        </div>
                        <p class="text-gray-500 text-sm mt-1 ml-3">Kelola kategori barang untuk memudahkan pencarian</p>
                    </div>
                </div>
            </div>
            <button onclick="openModal('tambah')" class="group relative animate-slideInRight overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-pink-500 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                <div class="relative bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center space-x-2 group-hover:scale-105">
                    <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-semibold">Tambah Kategori</span>
                </div>
            </button>
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

    @if(session('error'))
    <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 animate-slideInRight">
        <div class="flex items-center">
            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
            <span class="font-semibold">{{ session('error') }}</span>
        </div>
    </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-8">
        <div class="group bg-gradient-to-r from-purple-500 to-indigo-600 rounded-2xl p-5 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.1s">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $totalKategori ?? 0 }}</span>
            </div>
            <p class="font-semibold mt-3">Total Kategori</p>
            <p class="text-xs opacity-80">Jenis barang tersedia</p>
        </div>

        <div class="group bg-gradient-to-r from-pink-500 to-rose-500 rounded-2xl p-5 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.15s">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $totalBarang ?? 0 }}</span>
            </div>
            <p class="font-semibold mt-3">Total Barang</p>
            <p class="text-xs opacity-80">Terdaftar dalam kategori</p>
        </div>

        <div class="group bg-gradient-to-r from-cyan-500 to-blue-500 rounded-2xl p-5 text-white shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" style="animation-delay: 0.2s">
            <div class="flex items-center justify-between">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold">{{ $kategoriAktif ?? $totalKategori ?? 0 }}</span>
            </div>
            <p class="font-semibold mt-3">Kategori Aktif</p>
            <p class="text-xs opacity-80">Digunakan saat ini</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-2xl shadow-lg p-5 mb-6 animate-fadeInUp" style="animation-delay: 0.25s">
        <div class="relative group">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" id="searchKategori" placeholder="Cari kategori berdasarkan nama..."
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300">
        </div>
    </div>

    <!-- Kategori Grid View - ANTI MAINSTREAM -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="kategoriGrid">
        @forelse($kategoris ?? [] as $kategori)
        <div class="group kategori-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 animate-scaleIn" data-nama="{{ $kategori->nama_kategori }}">
            <!-- Card Header with Gradient -->
            <div class="relative h-32 bg-gradient-to-r from-purple-500 via-pink-500 to-red-500">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-all duration-300"></div>
                <div class="absolute -bottom-6 left-4">
                    <div class="w-16 h-16 bg-white rounded-2xl shadow-lg flex items-center justify-center group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                        <svg class="w-7 h-7 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="absolute top-3 right-3">
                    <div class="relative group/aksi">
                        <button class="w-8 h-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center shadow-md hover:bg-white transition-all">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-xl opacity-0 invisible group-hover/aksi:opacity-100 group-hover/aksi:visible transition-all duration-300 z-20">
                            <button onclick="openModal('edit', {{ $kategori->id }}, '{{ $kategori->nama_kategori }}', '{{ $kategori->deskripsi ?? '' }}')" class="flex items-center space-x-2 px-4 py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-t-xl transition w-full">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" class="block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center space-x-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-xl transition w-full" onclick="return confirm('Yakin hapus kategori {{ $kategori->nama_kategori }}? Data barang dalam kategori ini akan kehilangan kategori.')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Content -->
            <div class="p-5 pt-8">
                <h3 class="font-bold text-xl text-gray-800 mb-1 line-clamp-1">{{ $kategori->nama_kategori }}</h3>
                <p class="text-sm text-gray-500 mb-4 line-clamp-2">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}</p>

                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <div class="flex items-center space-x-1">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                        <span class="text-xs text-gray-500">{{ $kategori->barang_count ?? 0 }} Barang</span>
                    </div>
                    <button onclick="openModal('edit', {{ $kategori->id }}, '{{ $kategori->nama_kategori }}', '{{ $kategori->deskripsi ?? '' }}')" class="text-purple-600 hover:text-purple-700 text-sm font-semibold flex items-center space-x-1 group/edit">
                        <span>Kelola</span>
                        <svg class="w-4 h-4 group-hover/edit:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State Mewah -->
        <div class="col-span-full">
            <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-12 text-center animate-scaleIn">
                <div class="relative inline-block mb-6">
                    <div class="w-32 h-32 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full flex items-center justify-center mx-auto animate-float">
                        <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-pulse">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Kategori</h3>
                <p class="text-gray-500 mb-6 max-w-md mx-auto">Tambahkan kategori barang agar memudahkan pengelompokan dan pencarian barang.</p>
                <button onclick="openModal('tambah')" class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-semibold">Tambah Kategori Sekarang</span>
                </button>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah/Edit Kategori -->
<div id="kategoriModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-scaleIn overflow-hidden">
        <div class="bg-gradient-to-r from-purple-500 to-pink-500 px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l5 5a2 2 0 01.586 1.414V19a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2z"></path>
                    </svg>
                </div>
                <h3 id="modalTitle" class="text-white font-bold text-xl">Tambah Kategori</h3>
            </div>
            <button onclick="closeModal()" class="text-white/80 hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <form id="kategoriForm" method="POST" class="p-6 space-y-5">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            <input type="hidden" name="id" id="kategoriId">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Nama Kategori <span class="text-red-500">*</span>
                </label>
                <input type="text" name="nama_kategori" id="namaKategori" required
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300"
                    placeholder="Contoh: Elektronik, Laboratorium, Inventaris">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsiKategori" rows="3"
                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all duration-300"
                    placeholder="Deskripsikan kategori ini..."></textarea>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" onclick="closeModal()" class="px-5 py-2 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="px-5 py-2 bg-gradient-to-r from-purple-500 to-pink-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition hover:scale-105">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Search Function
    const searchInput = document.getElementById('searchKategori');
    const kategoriCards = document.querySelectorAll('.kategori-card');

    function filterKategori() {
        const searchTerm = searchInput.value.toLowerCase();
        kategoriCards.forEach(card => {
            const nama = card.dataset.nama?.toLowerCase() || '';
            if (searchTerm === '' || nama.includes(searchTerm)) {
                card.style.display = 'block';
                card.classList.add('animate-scaleIn');
            } else {
                card.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', filterKategori);

    // Modal Functions
    const modal = document.getElementById('kategoriModal');
    const modalTitle = document.getElementById('modalTitle');
    const kategoriForm = document.getElementById('kategoriForm');
    const methodField = document.getElementById('methodField');
    const kategoriId = document.getElementById('kategoriId');
    const namaKategori = document.getElementById('namaKategori');
    const deskripsiKategori = document.getElementById('deskripsiKategori');

    function openModal(action, id = null, nama = '', deskripsi = '') {
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        if (action === 'tambah') {
            modalTitle.innerHTML = 'Tambah Kategori';
            kategoriForm.action = "{{ route('kategori.store') }}";
            methodField.value = 'POST';
            kategoriId.value = '';
            namaKategori.value = '';
            deskripsiKategori.value = '';
        } else if (action === 'edit') {
            modalTitle.innerHTML = 'Edit Kategori';
            kategoriForm.action = `/admin/kategori/${id}`;
            methodField.value = 'PUT';
            kategoriId.value = id;
            namaKategori.value = nama;
            deskripsiKategori.value = deskripsi || '';
        }
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function closeModalOnClick(event) {
        if (event.target === modal) {
            closeModal();
        }
    }
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
    @keyframes pulse {
        0%, 100% { transform: scale(1); opacity: 1; }
        50% { transform: scale(1.1); opacity: 0.8; }
    }
    .animate-pulse {
        animation: pulse 2s ease-in-out infinite;
    }
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
