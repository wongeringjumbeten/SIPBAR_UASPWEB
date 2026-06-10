@extends('layouts.V_templatepetugas')

@section('title', 'Riwayat Pengembalian - SIPBAR Petugas')
@section('breadcrumb', 'Riwayat Pengembalian')

@section('content')
<!-- Floating Background -->
<div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute top-20 left-10 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-teal-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
</div>

<div class="relative z-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 animate-fadeInUp">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <div class="w-14 h-14 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-8 bg-gradient-to-b from-green-500 to-emerald-500 rounded-full"></div>
                    <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Riwayat Pengembalian</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1 ml-3">Daftar semua barang yang sudah dikembalikan</p>
            </div>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ $pengembalian->count() ?? 0 }} Pengembalian</span>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-2 mb-6 animate-fadeInUp" style="animation-delay: 0.1s">
        <button onclick="filterStatus('all')" id="tab-all" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-md">Semua</button>
        <button onclick="filterStatus('belum')" id="tab-belum" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Belum Lunas</button>
        <button onclick="filterStatus('lunas')" id="tab-lunas" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Sudah Lunas</button>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-2xl shadow-lg p-4 mb-6 animate-fadeInUp" style="animation-delay: 0.15s">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" id="searchPengembalian" placeholder="Cari berdasarkan kode peminjaman atau nama mahasiswa..."
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all duration-300">
        </div>
    </div>

    <!-- Pengembalian List -->
    <div class="space-y-4" id="pengembalianContainer">
        @forelse($pengembalian ?? [] as $index => $item)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-scaleIn pengembalian-card"
             data-kode="{{ $item->peminjaman->kode_peminjaman ?? '' }}"
             data-nama="{{ $item->peminjaman->mahasiswa->name ?? '' }}"
             data-status="{{ $item->status_denda }}"
             style="animation-delay: {{ $index * 0.05 }}s">

            <div class="p-5">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Left Section - Info Mahasiswa -->
                    <div class="flex items-start space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-r from-green-100 to-emerald-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2 mb-1 flex-wrap gap-2">
                                <h3 class="font-bold text-lg text-gray-800">{{ $item->peminjaman->kode_peminjaman ?? '-' }}</h3>
                                @if($item->status_denda == 'belum')
                                    <span class="bg-gradient-to-r from-red-500 to-rose-500 text-white text-xs px-2 py-0.5 rounded-full">Belum Lunas</span>
                                @else
                                    <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white text-xs px-2 py-0.5 rounded-full">Sudah Lunas</span>
                                @endif
                            </div>
                            <p class="font-semibold text-gray-800">{{ $item->peminjaman->mahasiswa->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500">NIM: {{ $item->peminjaman->mahasiswa->nim_nip ?? '-' }} | Jurusan: {{ $item->peminjaman->mahasiswa->jurusan ?? '-' }}</p>
                            <p class="text-xs text-gray-400 mt-1">Dikembalikan: {{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>

                    <!-- Middle Section - Info Denda -->
                    <div class="flex flex-wrap gap-4 text-sm">
                        <div class="bg-gray-50 rounded-xl px-3 py-2">
                            <p class="text-gray-400 text-xs">Total Denda</p>
                            <p class="font-semibold text-red-600">Rp {{ number_format($item->total_denda, 0, ',', '.') }}</p>
                        </div>
                        @if($item->status_denda == 'lunas')
                        <div class="bg-gray-50 rounded-xl px-3 py-2">
                            <p class="text-gray-400 text-xs">Tanggal Bayar</p>
                            <p class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tgl_bayar)->translatedFormat('d M Y') }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Right Section - Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <button onclick="showDetail({{ $item->id }})"
                                class="px-4 py-2 border-2 border-gray-300 rounded-xl text-gray-600 font-semibold hover:bg-gray-50 transition flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <span>Detail</span>
                        </button>
                        @if($item->status_denda == 'belum' && $item->total_denda > 0)
                        <button onclick="openBayarModal({{ $item->id }}, {{ $item->total_denda }})"
                                class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold shadow-md hover:shadow-lg transition hover:scale-105 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Tandai Lunas</span>
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="p-12 text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-float">
                    <svg class="w-16 h-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Pengembalian</h3>
                <p class="text-gray-500 max-w-md mx-auto">Belum ada proses pengembalian barang yang tercatat.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Detail Pengembalian -->
<div id="detailModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closeDetailModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] animate-modalPop overflow-hidden flex flex-col">
        <!-- Header (tetap di atas) -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4 flex-shrink-0">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white">Detail Pengembalian</h3>
                </div>
                <button onclick="closeDetailModal()" class="text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Konten Scroll -->
        <div class="p-6 overflow-y-auto flex-1" id="detailContent" style="scrollbar-width: thin; scrollbar-color: #667eea #e2e8f0;">
            <style>
                #detailContent::-webkit-scrollbar {
                    width: 6px;
                }
                #detailContent::-webkit-scrollbar-track {
                    background: #e2e8f0;
                    border-radius: 10px;
                }
                #detailContent::-webkit-scrollbar-thumb {
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    border-radius: 10px;
                }
            </style>
            <div class="text-center py-8" id="loadingContent">
                <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
                <p class="text-gray-500 mt-3">Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Tandai Lunas -->
<div id="bayarModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closeBayarModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-modalPop overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white">Konfirmasi Pembayaran</h3>
                </div>
                <button onclick="closeBayarModal()" class="text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-gray-600">Konfirmasi bahwa mahasiswa telah membayar denda sebesar</p>
                <p class="text-2xl font-bold text-red-600" id="totalDendaModal">Rp 0</p>
                <p class="text-xs text-gray-400 mt-2">Setelah dikonfirmasi, status denda akan berubah menjadi <span class="font-semibold text-green-600">LUNAS</span></p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeBayarModal()"
                    class="px-5 py-2 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Batal
                </button>
                <form id="bayarForm" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition hover:scale-105">
                        Ya, Tandai Lunas
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchPengembalian');
    const pengembalianCards = document.querySelectorAll('.pengembalian-card');

    function searchPengembalian() {
        const searchTerm = searchInput.value.toLowerCase();
        pengembalianCards.forEach(card => {
            const kode = card.dataset.kode?.toLowerCase() || '';
            const nama = card.dataset.nama?.toLowerCase() || '';
            if (searchTerm === '' || kode.includes(searchTerm) || nama.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', searchPengembalian);

    // Filter by status
    let currentFilter = 'all';

    function filterStatus(status) {
        currentFilter = status;

        // Update active tab style
        document.querySelectorAll('.filter-tab').forEach(btn => {
            btn.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white', 'shadow-md');
            btn.classList.add('bg-gray-100', 'text-gray-600');
        });

        const activeTab = document.getElementById(`tab-${status}`);
        if (activeTab) {
            activeTab.classList.remove('bg-gray-100', 'text-gray-600');
            activeTab.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white', 'shadow-md');
        }

        const cards = document.querySelectorAll('.pengembalian-card');
        cards.forEach(card => {
            if (status === 'all') {
                card.style.display = 'block';
            } else {
                const cardStatus = card.dataset.status;
                if (cardStatus === status) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }

    // Detail Modal
    const detailModal = document.getElementById('detailModal');
    const detailContent = document.getElementById('detailContent');

    function showDetail(id) {
        detailModal.classList.remove('hidden');
        detailModal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        fetch(`/petugas/pengembalian/${id}/detail`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    detailContent.innerHTML = data.html;
                } else {
                    detailContent.innerHTML = '<div class="text-center py-8 text-red-500">Gagal memuat data</div>';
                }
            })
            .catch(error => {
                detailContent.innerHTML = '<div class="text-center py-8 text-red-500">Terjadi kesalahan</div>';
            });
    }

    function closeDetailModal() {
        detailModal.classList.add('hidden');
        detailModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function closeDetailModalOnClick(event) {
        if (event.target === detailModal) {
            closeDetailModal();
        }
    }

    // Bayar Modal
    const bayarModal = document.getElementById('bayarModal');
    const bayarForm = document.getElementById('bayarForm');

    function openBayarModal(id, totalDenda) {
        document.getElementById('totalDendaModal').textContent = `Rp ${totalDenda.toLocaleString('id-ID')}`;
        bayarForm.action = `/petugas/pengembalian/${id}/tandai-lunas`;
        bayarModal.classList.remove('hidden');
        bayarModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeBayarModal() {
        bayarModal.classList.add('hidden');
        bayarModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function closeBayarModalOnClick(event) {
        if (event.target === bayarModal) {
            closeBayarModal();
        }
    }
</script>

<style>
    .card-hover {
        transition: all 0.3s ease;
    }
    .card-hover:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>
@endsection
