<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mahasiswa - SIPBAR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        @keyframes glow {
            0%, 100% { box-shadow: 0 0 5px rgba(255,255,255,0.3); }
            50% { box-shadow: 0 0 20px rgba(255,255,255,0.6); }
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.9; }
        }
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-float-slow { animation: floatSlow 4s ease-in-out infinite; }
        .animate-glow { animation: glow 2s ease-in-out infinite; }
        .animate-slideUp { animation: slideUp 0.6s ease-out forwards; }
        .animate-slideInLeft { animation: slideInLeft 0.6s ease-out forwards; }
        .animate-slideInRight { animation: slideInRight 0.6s ease-out forwards; }
        .animate-scaleIn { animation: scaleIn 0.5s ease-out forwards; }
        .animate-bounce { animation: bounce 2s ease-in-out infinite; }
        .animate-pulse-slow { animation: pulse 2s ease-in-out infinite; }
        .animate-rotate { animation: rotate 20s linear infinite; }

        .delay-100 { animation-delay: 0.1s; opacity: 0; }
        .delay-200 { animation-delay: 0.2s; opacity: 0; }
        .delay-300 { animation-delay: 0.3s; opacity: 0; }
        .delay-400 { animation-delay: 0.4s; opacity: 0; }
        .delay-500 { animation-delay: 0.5s; opacity: 0; }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .gradient-card-1 { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .gradient-card-2 { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }
        .gradient-card-3 { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .gradient-card-4 { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.25);
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

        nav, nav .container, nav .relative {
            overflow: visible !important;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100">

    @include('components.V_notifikasi')

    <!-- Floating Background Elements yang Lebih Ramai -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float-slow" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-40 left-1/4 w-64 h-64 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 3s;"></div>
        <div class="absolute top-40 right-1/4 w-56 h-56 bg-yellow-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float-slow" style="animation-delay: 5s;"></div>
        <div class="absolute bottom-1/2 left-1/2 w-48 h-48 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 1s;"></div>
    </div>

        <!-- Navbar -->
    <nav class="gradient-bg text-white shadow-lg relative z-50">
        <div class="container mx-auto px-6 py-4 relative overflow-visible">
            <div class="flex items-center justify-between">
                <!-- Logo Kiri -->
                <div class="flex items-center space-x-3 animate-slideInLeft">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center animate-glow">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">SIPBAR</h1>
                        <p class="text-xs text-blue-100">Dashboard Mahasiswa</p>
                    </div>
                </div>

                <!-- Kanan: Profil + Keranjang + User Info + Logout -->
                <div class="flex items-center space-x-4 animate-slideInRight">
                    <!-- Tombol Profil -->
                    <a href="{{ route('mahasiswa.profil') }}" class="bg-white/20 px-3 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2" title="Profil">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="hidden md:inline">Profil</span>
                    </a>

                    <!-- Tombol Keranjang -->
                    <a href="{{ route('mahasiswa.peminjaman.cart') }}" class="relative bg-white/20 px-3 py-2 rounded-lg text-sm hover:bg-white/30 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M4 5h16"></path>
                        </svg>
                        @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ count(session('cart')) }}</span>
                        @endif
                    </a>

                    <!-- User Info -->
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100">Mahasiswa</p>
                    </div>

                    <!-- Tombol Logout -->
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center hover:bg-white/30 hover:scale-110 transition-all duration-300" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-6 py-8 relative z-10">

        <!-- Welcome Section yang Lebih Mewah -->
        <div class="mb-8 animate-slideUp">
            <div class="gradient-bg rounded-3xl p-8 text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 opacity-10">
                    <svg class="w-96 h-96" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="absolute bottom-0 left-0 opacity-5">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <div class="relative">
                    <div class="flex items-center space-x-2 mb-3">
                        <span class="bg-white/20 px-3 py-1 rounded-full text-xs backdrop-blur-sm">Hari ini</span>
                        <span class="bg-white/20 px-3 py-1 rounded-full text-xs backdrop-blur-sm">{{ date('d F Y') }}</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h2>
                    <p class="text-blue-100 text-lg mb-4">Siap meminjam barang untuk kegiatan kampusmu?</p>
                    <div class="flex flex-wrap gap-3">
                        <span class="bg-white/20 px-4 py-2 rounded-full text-sm backdrop-blur-sm flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-4 0h4"></path>
                            </svg>
                            <span>NIM: {{ Auth::user()->nim_nip ?? '-' }}</span>
                        </span>
                        <span class="bg-white/20 px-4 py-2 rounded-full text-sm backdrop-blur-sm flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span>Jurusan: {{ Auth::user()->jurusan ?? '-' }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards dengan Data Real -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="gradient-card-1 rounded-2xl p-6 text-white shadow-lg card-hover animate-slideInLeft delay-100">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold">{{ $totalPeminjaman ?? 0 }}</span>
                </div>
                <h3 class="font-semibold text-lg">Total Peminjaman</h3>
                <p class="text-sm opacity-80">Seluruh riwayat peminjaman</p>
            </div>

            <div class="gradient-card-2 rounded-2xl p-6 text-white shadow-lg card-hover animate-slideInLeft delay-200">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold">{{ $sedangDipinjam ?? 0 }}</span>
                </div>
                <h3 class="font-semibold text-lg">Sedang Dipinjam</h3>
                <p class="text-sm opacity-80">Barang yang sedang kamu pinjam</p>
            </div>

            <div class="gradient-card-3 rounded-2xl p-6 text-white shadow-lg card-hover animate-slideInLeft delay-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</span>
                </div>
                <h3 class="font-semibold text-lg">Total Denda</h3>
                <p class="text-sm opacity-80">Denda yang harus dibayar</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 animate-slideInLeft delay-100">Aksi Cepat</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('mahasiswa.peminjaman.barang') }}" class="group bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-6 shadow-lg card-hover animate-slideInLeft delay-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <h4 class="text-white font-bold text-lg mb-1">Ajukan Peminjaman</h4>
                            <p class="text-blue-100 text-sm">Pinjam barang untuk kebutuhanmu</p>
                        </div>
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>

                <a href="{{ route('mahasiswa.riwayat') }}" class="group bg-gradient-to-r from-green-400 to-blue-500 rounded-2xl p-6 shadow-lg card-hover animate-slideInRight delay-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-white font-bold text-lg mb-1">Riwayat Peminjaman</h4>
                            <p class="text-blue-100 text-sm">Lihat histori peminjamanmu</p>
                        </div>
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 group-hover:translate-x-2 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Loans dengan Data Real -->
        <div>
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800 animate-slideInLeft delay-100">Peminjaman Terbaru</h3>
                <a href="{{ route('mahasiswa.riwayat') }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold animate-slideInRight delay-100 flex items-center space-x-1">
                    <span>Lihat Semua</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden animate-scaleIn delay-200">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pinjam</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kembali</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($peminjamanTerbaru ?? [] as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->kode_peminjaman }}</td>
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
                                <td class="px-6 py-4">
                                    <a href="{{ route('mahasiswa.riwayat.detail', $item->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                    Belum ada riwayat peminjaman
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Info Cards yang Lebih Mewah -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <div class="bg-gradient-to-r from-yellow-400 to-orange-500 rounded-2xl p-6 text-white card-hover animate-slideInLeft delay-300 group">
                <div class="flex items-start space-x-4">
                    <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-1">Info Penting</h4>
                        <p class="text-sm opacity-90">Kembalikan barang tepat waktu untuk menghindari denda keterlambatan</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-purple-400 to-pink-500 rounded-2xl p-6 text-white card-hover animate-slideInRight delay-300 group">
                <div class="flex items-start space-x-4">
                    <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-xl mb-1">Jam Operasional</h4>
                        <p class="text-sm opacity-90">Senin-Jumat: 08.00-16.00 | Sabtu: 08.00-12.00</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth animations
            console.log('Dashboard Mahasiswa Loaded');
        });
    </script>
</body>
</html>
