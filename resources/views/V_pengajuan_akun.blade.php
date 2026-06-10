@extends('layouts.V_templateadmin')

@section('title', 'Pengajuan Akun - SIPBAR Admin')
@section('breadcrumb', 'Pengajuan Akun')

@section('content')
<!-- Floating Background -->
<div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
    <div class="absolute top-20 left-10 w-72 h-72 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-orange-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-amber-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
</div>

<div class="relative z-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 animate-fadeInUp">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <div class="w-14 h-14 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-500 rounded-full border-2 border-white animate-pulse"></div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-8 bg-gradient-to-b from-yellow-500 to-orange-500 rounded-full"></div>
                    <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Pengajuan Akun</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1 ml-3">Daftar akun yang menunggu persetujuan</p>
            </div>
        </div>
        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-4 py-2 rounded-xl text-sm font-semibold shadow-md flex items-center space-x-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>{{ $pengajuan->count() ?? 0 }} Menunggu Persetujuan</span>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white rounded-2xl shadow-lg p-4 mb-6 animate-fadeInUp" style="animation-delay: 0.1s">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" id="searchPengajuan" placeholder="Cari berdasarkan nama atau email..."
                class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all duration-300">
        </div>
    </div>

    <!-- Daftar Pengajuan -->
    <div class="space-y-4" id="pengajuanContainer">
        @forelse($pengajuan ?? [] as $index => $item)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-scaleIn pengajuan-card"
             data-nama="{{ $item->name }}"
             data-email="{{ $item->email }}"
             style="animation-delay: {{ $index * 0.05 }}s">

            <div class="p-5">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <!-- Left Section - Info Pengaju -->
                    <div class="flex items-start space-x-4">
                        <div class="w-14 h-14 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-2xl flex items-center justify-center">
                            <svg class="w-7 h-7 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2 mb-1 flex-wrap gap-2">
                                <h3 class="font-bold text-lg text-gray-800">{{ $item->name }}</h3>
                                <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white text-xs px-2 py-0.5 rounded-full animate-pulse">Menunggu</span>
                            </div>
                            <p class="text-sm text-gray-600">{{ $item->email }}</p>
                            <p class="text-xs text-gray-500 mt-1">Role: {{ ucfirst($item->role) }} | NIM/NIP: {{ $item->nim_nip ?? '-' }}</p>
                            <p class="text-xs text-gray-400 mt-1">Daftar: {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y, H:i') }}</p>
                        </div>
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
                        <button onclick="openApproveModal({{ $item->id }}, '{{ $item->name }}')"
                                class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold shadow-md hover:shadow-lg transition hover:scale-105 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Setujui</span>
                        </button>
                        <button onclick="openRejectModal({{ $item->id }}, '{{ $item->name }}')"
                                class="px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl font-semibold shadow-md hover:shadow-lg transition hover:scale-105 flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            <span>Tolak</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <!-- Empty State -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
            <div class="p-12 text-center">
                <div class="w-32 h-32 bg-gradient-to-r from-yellow-100 to-orange-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-float">
                    <svg class="w-16 h-16 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">Tidak Ada Pengajuan</h3>
                <p class="text-gray-500 max-w-md mx-auto">Semua pengajuan akun sudah diproses. Tidak ada yang menunggu persetujuan.</p>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Detail Pengajuan -->
<div id="detailModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closeDetailModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] animate-modalPop overflow-hidden flex flex-col">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4 flex-shrink-0">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white">Detail Pengajuan</h3>
                </div>
                <button onclick="closeDetailModal()" class="text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6 overflow-y-auto flex-1" id="detailContent">
            <div class="text-center py-8">
                <div class="w-10 h-10 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
                <p class="text-gray-500 mt-3">Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Setujui -->
<div id="approveModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closeApproveModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-modalPop overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white">Setujui Pengajuan</h3>
                </div>
                <button onclick="closeApproveModal()" class="text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-gray-600">Setujui pengajuan akun <span id="approveName" class="font-semibold"></span>?</p>
                <p class="text-xs text-gray-400 mt-2">Akun akan aktif dan dapat login.</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeApproveModal()"
                    class="px-5 py-2 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Batal
                </button>
                <form id="approveForm" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition hover:scale-105">
                        Ya, Setujui
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Tolak -->
<div id="rejectModal" class="fixed inset-0 z-[9999] hidden items-center justify-center p-4" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="closeRejectModalOnClick(event)">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-modalPop overflow-hidden">
        <div class="bg-gradient-to-r from-red-500 to-rose-600 px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                    <h3 class="font-bold text-xl text-white">Tolak Pengajuan</h3>
                </div>
                <button onclick="closeRejectModal()" class="text-white/80 hover:text-white transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="text-center mb-4">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <p class="text-gray-600">Tolak pengajuan akun <span id="rejectName" class="font-semibold"></span>?</p>
                <p class="text-xs text-gray-400 mt-2">Akun akan dihapus secara permanen.</p>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" onclick="closeRejectModal()"
                    class="px-5 py-2 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Batal
                </button>
                <form id="rejectForm" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2 bg-gradient-to-r from-red-500 to-rose-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transition hover:scale-105">
                        Ya, Tolak
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchPengajuan');
    const pengajuanCards = document.querySelectorAll('.pengajuan-card');

    function searchPengajuan() {
        const searchTerm = searchInput.value.toLowerCase();
        pengajuanCards.forEach(card => {
            const nama = card.dataset.nama?.toLowerCase() || '';
            const email = card.dataset.email?.toLowerCase() || '';
            if (searchTerm === '' || nama.includes(searchTerm) || email.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', searchPengajuan);

    // Detail Modal
    const detailModal = document.getElementById('detailModal');
    const detailContent = document.getElementById('detailContent');

    function showDetail(id) {
        detailModal.classList.remove('hidden');
        detailModal.classList.add('flex');
        document.body.style.overflow = 'hidden';

        fetch(`/admin/pengajuan-akun/${id}/detail`)
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

    // Approve Modal
    const approveModal = document.getElementById('approveModal');
    const approveForm = document.getElementById('approveForm');

    function openApproveModal(id, name) {
        document.getElementById('approveName').innerText = name;
        approveForm.action = `/admin/pengajuan-akun/${id}/setujui`;
        approveModal.classList.remove('hidden');
        approveModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeApproveModal() {
        approveModal.classList.add('hidden');
        approveModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function closeApproveModalOnClick(event) {
        if (event.target === approveModal) {
            closeApproveModal();
        }
    }

    // Reject Modal
    const rejectModal = document.getElementById('rejectModal');
    const rejectForm = document.getElementById('rejectForm');

    function openRejectModal(id, name) {
        document.getElementById('rejectName').innerText = name;
        rejectForm.action = `/admin/pengajuan-akun/${id}/tolak`;
        rejectModal.classList.remove('hidden');
        rejectModal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeRejectModal() {
        rejectModal.classList.add('hidden');
        rejectModal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function closeRejectModalOnClick(event) {
        if (event.target === rejectModal) {
            closeRejectModal();
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
