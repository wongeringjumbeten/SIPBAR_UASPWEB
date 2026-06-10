@extends('layouts.V_templateadmin')

@section('title', 'Riwayat Peminjaman - SIPBAR Admin')
@section('breadcrumb', 'Riwayat Peminjaman')

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-blue-500 rounded-full border-2 border-white animate-pulse"></div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                    <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Riwayat Peminjaman</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1 ml-3">Semua data peminjaman barang</p>
            </div>
        </div>
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <span>{{ $peminjaman->count() ?? 0 }} Total Peminjaman</span>
        </div>
    </div>

    <!-- Filter Tabs -->
    <div class="flex flex-wrap gap-2 mb-6 animate-fadeInUp" style="animation-delay: 0.1s">
        <button onclick="filterStatus('all')" id="tab-all" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-md">Semua</button>
        <button onclick="filterStatus('pending')" id="tab-pending" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Menunggu</button>
        <button onclick="filterStatus('disetujui')" id="tab-disetujui" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Disetujui</button>
        <button onclick="filterStatus('dipinjam')" id="tab-dipinjam" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Dipinjam</button>
        <button onclick="filterStatus('selesai')" id="tab-selesai" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Selesai</button>
        <button onclick="filterStatus('ditolak')" id="tab-ditolak" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Ditolak</button>
        <button onclick="filterStatus('terlambat')" id="tab-terlambat" class="filter-tab px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Terlambat</button>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-2xl shadow-lg p-4 mb-6 animate-fadeInUp" style="animation-delay: 0.15s">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" id="searchPeminjaman" placeholder="Cari berdasarkan kode peminjaman atau nama mahasiswa..."
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
        </div>
    </div>

    <!-- Tabel Riwayat -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Denda</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($peminjaman ?? [] as $item)
                    <tr class="hover:bg-gray-50 transition peminjaman-row" data-status="{{ $item->status }}" data-kode="{{ $item->kode_peminjaman }}" data-nama="{{ $item->mahasiswa->name ?? '' }}">
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
                            @elseif($item->status == 'ditolak')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                            @elseif($item->status == 'dipinjam')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Dipinjam</span>
                            @elseif($item->status == 'selesai')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Selesai</span>
                            @elseif($item->status == 'terlambat')
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Terlambat</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold {{ $item->total_denda > 0 ? 'text-red-600' : 'text-gray-600' }}">
                            Rp {{ number_format($item->total_denda, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            <button onclick="showDetail({{ $item->id }})" class="text-blue-600 hover:text-blue-800 transition" title="Detail">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p>Belum ada data peminjaman</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(method_exists($peminjaman, 'links'))
    <div class="mt-6">
        {{ $peminjaman->links() }}
    </div>
    @endif
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closeDetailModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] animate-modalPop overflow-hidden flex flex-col">
        <!-- Header (tetap di atas, tidak ikut scroll) -->
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4 flex-shrink-0">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white">Detail Peminjaman</h3>
                </div>
                <button onclick="closeDetailModal()" class="text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Konten Scroll (seluruh konten dalam modal bisa di-scroll) -->
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
<script>
    // Filter by status
    let currentFilter = 'all';

    function filterStatus(status) {
        currentFilter = status;

        document.querySelectorAll('.filter-tab').forEach(btn => {
            btn.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white', 'shadow-md');
            btn.classList.add('bg-gray-100', 'text-gray-600');
        });

        const activeTab = document.getElementById(`tab-${status}`);
        if (activeTab) {
            activeTab.classList.remove('bg-gray-100', 'text-gray-600');
            activeTab.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white', 'shadow-md');
        }

        const rows = document.querySelectorAll('.peminjaman-row');
        rows.forEach(row => {
            if (status === 'all') {
                row.style.display = 'table-row';
            } else {
                const rowStatus = row.dataset.status;
                if (rowStatus === status) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }

    // Search
    const searchInput = document.getElementById('searchPeminjaman');
    const rows = document.querySelectorAll('.peminjaman-row');

    function searchPeminjaman() {
        const searchTerm = searchInput.value.toLowerCase();
        rows.forEach(row => {
            const kode = row.dataset.kode?.toLowerCase() || '';
            const nama = row.dataset.nama?.toLowerCase() || '';
            if (searchTerm === '' || kode.includes(searchTerm) || nama.includes(searchTerm)) {
                if (currentFilter === 'all' || row.dataset.status === currentFilter) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', searchPeminjaman);

    // Detail Modal
    const detailModal = document.getElementById('detailModal');
    const detailContent = document.getElementById('detailContent');

    function showDetail(id) {
        detailModal.classList.remove('hidden');
        detailModal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        fetch(`/admin/peminjaman/${id}/detail`)
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
    @keyframes modalPop {
        from { opacity: 0; transform: scale(0.9) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-modalPop {
        animation: modalPop 0.3s ease-out forwards;
    }

    /* Custom scrollbar untuk modal detail */
    #detailContent .overflow-y-auto::-webkit-scrollbar {
        width: 6px;
    }
    #detailContent .overflow-y-auto::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 10px;
    }
    #detailContent .overflow-y-auto::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
    }
    #detailContent .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
    }
    #detailContent .overflow-y-auto {
        scrollbar-width: thin;
        scrollbar-color: #667eea #e2e8f0;
    }
</style>
@endsection
