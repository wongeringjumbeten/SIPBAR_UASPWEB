<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - SIPBAR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.02); opacity: 0.9; }
        }
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out forwards; }
        .animate-slideInLeft { animation: slideInLeft 0.4s ease-out forwards; }
        .animate-slideInRight { animation: slideInRight 0.4s ease-out forwards; }
        .animate-fadeInUp { animation: fadeInUp 0.4s ease-out forwards; }
        .animate-pulse { animation: pulse 2s ease-in-out infinite; }

        .gradient-bg {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.25);
        }

        /* Status Badge Styles */
        .badge-pending {
            background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);
        }
        .badge-disetujui {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .badge-ditolak {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        .badge-dipinjam {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .badge-selesai {
            background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        }
        .badge-terlambat {
            background: linear-gradient(135deg, #ff0844 0%, #ffb199 100%);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    @include('components.V_notifikasi')


    <!-- Floating Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Navbar -->
    <nav class="gradient-bg text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 animate-slideInLeft">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">SIPBAR</h1>
                        <p class="text-xs text-blue-100">Riwayat Peminjaman</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 animate-slideInRight">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100">Mahasiswa</p>
                        <p class="text-xs text-blue-200">NIM: {{ Auth::user()->nim_nip ?? '-' }}</p>
                    </div>
                    <a href="{{ route('mahasiswa.peminjaman.barang') }}" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Pinjam Barang</span>
                    </a>
                    <a href="{{ route('mahasiswa.peminjaman.cart') }}" class="relative bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M4 5h16"></path>
                        </svg>
                        <span>Keranjang</span>
                        @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8">

        <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 animate-fadeInUp">
        <div class="flex items-center space-x-4">
            <div class="relative">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <div class="w-1 h-8 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                    <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Riwayat Peminjaman</h1>
                </div>
                <p class="text-gray-500 text-sm mt-1 ml-3">Lihat semua peminjaman yang pernah kamu lakukan</p>
            </div>
        </div>

        <!-- Tombol Kembali ke Dashboard -->
        <a href="{{ route('dashboard.mahasiswa') }}"
        class="group flex items-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold shadow-md hover:shadow-lg transition-all hover:scale-105">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span>Kembali ke Dashboard</span>
        </a>
    </div>

        <!-- Tabs Filter -->
        <div class="flex flex-wrap gap-2 mb-6 animate-fadeInUp" style="animation-delay: 0.1s">
            <button onclick="filterStatus('all')" id="tab-all" class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-md">Semua</button>
            <button onclick="filterStatus('pending')" id="tab-pending" class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Menunggu</button>
            <button onclick="filterStatus('disetujui')" id="tab-disetujui" class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Disetujui</button>
            <button onclick="filterStatus('dipinjam')" id="tab-dipinjam" class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Dipinjam</button>
            <button onclick="filterStatus('selesai')" id="tab-selesai" class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Selesai</button>
            <button onclick="filterStatus('ditolak')" id="tab-ditolak" class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Ditolak</button>
            <button onclick="filterStatus('terlambat')" id="tab-terlambat" class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-gray-200">Terlambat</button>
        </div>

        <!-- Search Bar -->
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-6 animate-fadeInUp" style="animation-delay: 0.15s">
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <input type="text" id="searchRiwayat" placeholder="Cari berdasarkan kode peminjaman..."
                    class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
            </div>
        </div>

        <!-- Riwayat List -->
        <div class="space-y-4" id="riwayatContainer">
            @forelse($peminjaman ?? [] as $index => $item)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-scaleIn riwayat-card" data-status="{{ $item->status }}" data-kode="{{ $item->kode_peminjaman }}" style="animation-delay: {{ $index * 0.05 }}s">
                <div class="p-5">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <!-- Left Section -->
                        <div class="flex items-start space-x-4">
                            <div class="w-14 h-14 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <h3 class="font-bold text-lg text-gray-800">{{ $item->kode_peminjaman }}</h3>
                                    @if($item->status == 'pending')
                                        <span class="badge-pending text-white text-xs px-2 py-0.5 rounded-full">Menunggu</span>
                                    @elseif($item->status == 'disetujui')
                                        <span class="badge-disetujui text-white text-xs px-2 py-0.5 rounded-full">Disetujui</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge-ditolak text-white text-xs px-2 py-0.5 rounded-full">Ditolak</span>
                                    @elseif($item->status == 'dipinjam')
                                        <span class="badge-dipinjam text-white text-xs px-2 py-0.5 rounded-full">Dipinjam</span>
                                    @elseif($item->status == 'selesai')
                                        <span class="badge-selesai text-gray-700 text-xs px-2 py-0.5 rounded-full">Selesai</span>
                                    @elseif($item->status == 'terlambat')
                                        <span class="badge-terlambat text-white text-xs px-2 py-0.5 rounded-full">Terlambat</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-500">
                                    Diajukan: {{ \Carbon\Carbon::parse($item->tgl_pengajuan)->format('d M Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Middle Section -->
                        <div class="flex flex-wrap gap-4 text-sm">
                            <div>
                                <p class="text-gray-400 text-xs">Tanggal Pinjam</p>
                                <p class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs">Tanggal Kembali</p>
                                <p class="font-semibold text-gray-700">{{ \Carbon\Carbon::parse($item->tgl_kembali_rencana)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-xs">Total Denda</p>
                                <p class="font-semibold {{ $item->total_denda > 0 ? 'text-red-600' : 'text-gray-700' }}">
                                    Rp {{ number_format($item->total_denda, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <!-- Right Section - Action Button -->
                        <a href="{{ route('mahasiswa.riwayat.detail', $item->id) }}"
                           class="group flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold hover:shadow-lg transition-all hover:scale-105">
                            <span>Detail</span>
                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <!-- Empty State -->
            <div class="col-span-full">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-12 text-center animate-scaleIn">
                    <div class="relative inline-block mb-6">
                        <div class="w-32 h-32 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto animate-float">
                            <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-pulse">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Riwayat</h3>
                    <p class="text-gray-500 mb-6 max-w-md mx-auto">Kamu belum pernah melakukan peminjaman barang. Yuk, mulai pinjam barang sekarang!</p>
                    <a href="{{ route('mahasiswa.peminjaman.barang') }}" class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-500 to-purple-600 text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span class="font-semibold">Pinjam Barang Sekarang</span>
                    </a>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <script>
        // Filter by status
        let currentFilter = 'all';

        function filterStatus(status) {
            currentFilter = status;

            // Update active tab style
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white', 'shadow-md');
                btn.classList.add('bg-gray-100', 'text-gray-600');
            });

            const activeTab = document.getElementById(`tab-${status}`);
            if (activeTab) {
                activeTab.classList.remove('bg-gray-100', 'text-gray-600');
                activeTab.classList.add('bg-gradient-to-r', 'from-blue-500', 'to-purple-600', 'text-white', 'shadow-md');
            }

            const cards = document.querySelectorAll('.riwayat-card');
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

        // Search by kode peminjaman
        const searchInput = document.getElementById('searchRiwayat');
        const riwayatCards = document.querySelectorAll('.riwayat-card');

        function searchRiwayat() {
            const searchTerm = searchInput.value.toLowerCase();
            riwayatCards.forEach(card => {
                const kode = card.dataset.kode?.toLowerCase() || '';
                if (searchTerm === '' || kode.includes(searchTerm)) {
                    if (currentFilter === 'all' || card.dataset.status === currentFilter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchInput.addEventListener('keyup', searchRiwayat);
    </script>

    @if(session('notification_type'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showNotification(
                '{{ session('notification_type') }}',
                '{{ session('notification_message') }}',
                '{{ session('notification_title') ?? '' }}'
            );
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showNotification('success', '{{ session('success') }}', 'Berhasil!');
        });
    </script>
    @endif

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            showNotification('error', '{{ session('error') }}', 'Gagal!');
        });
    </script>
    @endif
</body>
</html>
