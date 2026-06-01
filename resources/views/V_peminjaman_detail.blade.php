<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Peminjaman - SIPBAR</title>
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
        @keyframes floatSlow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.9; }
        }
        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        @keyframes shimmer {
            0% { background-position: -1000px 0; }
            100% { background-position: 1000px 0; }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-float-slow { animation: floatSlow 4s ease-in-out infinite; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out forwards; }
        .animate-slideInLeft { animation: slideInLeft 0.5s ease-out forwards; }
        .animate-slideInRight { animation: slideInRight 0.5s ease-out forwards; }
        .animate-fadeInUp { animation: fadeInUp 0.4s ease-out forwards; }
        .animate-pulse { animation: pulse 2s ease-in-out infinite; }
        .animate-rotate { animation: rotate 20s linear infinite; }

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

        .status-pending { background: linear-gradient(135deg, #f6d365 0%, #fda085 100%); }
        .status-disetujui { background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); }
        .status-ditolak { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); }
        .status-dipinjam { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .status-selesai { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); }
        .status-terlambat { background: linear-gradient(135deg, #ff0844 0%, #ffb199 100%); }

        .timeline-dot {
            transition: all 0.3s ease;
        }
        .timeline-dot:hover {
            transform: scale(1.3);
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

    <!-- Floating Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float-slow"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float-slow" style="animation-delay: 4s;"></div>
        <div class="absolute bottom-40 left-1/4 w-64 h-64 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 3s;"></div>
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
                        <p class="text-xs text-blue-100">Detail Peminjaman</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 animate-slideInRight">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100">Mahasiswa</p>
                    </div>
                    <a href="{{ route('mahasiswa.riwayat') }}" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Kembali</span>
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
        <div class="max-w-5xl mx-auto">

            <!-- Header -->
            <div class="mb-8 animate-fadeInUp">
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
                            <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Detail Peminjaman</h1>
                        </div>
                        <p class="text-gray-500 text-sm mt-1 ml-3">Informasi lengkap peminjaman Anda</p>
                    </div>
                </div>
            </div>

            <!-- Status Card -->
            <div class="mb-6 animate-scaleIn">
                <div class="rounded-2xl p-6 text-white {{
                    $peminjaman->status == 'pending' ? 'status-pending' :
                    ($peminjaman->status == 'disetujui' ? 'status-disetujui' :
                    ($peminjaman->status == 'ditolak' ? 'status-ditolak' :
                    ($peminjaman->status == 'dipinjam' ? 'status-dipinjam' :
                    ($peminjaman->status == 'selesai' ? 'status-selesai' : 'status-terlambat'))))
                }} shadow-lg">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center animate-pulse">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm opacity-90">Status Peminjaman</p>
                                <p class="text-2xl font-bold">
                                    @if($peminjaman->status == 'pending') Menunggu Persetujuan
                                    @elseif($peminjaman->status == 'disetujui') Disetujui
                                    @elseif($peminjaman->status == 'ditolak') Ditolak
                                    @elseif($peminjaman->status == 'dipinjam') Sedang Dipinjam
                                    @elseif($peminjaman->status == 'selesai') Selesai
                                    @else Terlambat
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm opacity-90">Kode Peminjaman</p>
                            <p class="text-xl font-mono font-bold">{{ $peminjaman->kode_peminjaman }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two Column Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Info Peminjaman -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Info Peminjaman Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slideInLeft">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Informasi Peminjaman</h3>
                                    <p class="text-xs text-gray-500">Detail tanggal dan keterangan</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 rounded-xl p-3">
                                    <p class="text-xs text-gray-500">Tanggal Pengajuan</p>
                                    <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($peminjaman->tgl_pengajuan)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div class="bg-green-50 rounded-xl p-3">
                                    <p class="text-xs text-gray-500">Tanggal Pinjam</p>
                                    <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div class="bg-yellow-50 rounded-xl p-3">
                                    <p class="text-xs text-gray-500">Rencana Kembali</p>
                                    <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_rencana)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div class="bg-purple-50 rounded-xl p-3">
                                    <p class="text-xs text-gray-500">Tanggal Kembali Aktual</p>
                                    <p class="font-semibold text-gray-800">{{ $peminjaman->tgl_kembali_aktual ? \Carbon\Carbon::parse($peminjaman->tgl_kembali_aktual)->translatedFormat('d F Y') : '-' }}</p>
                                </div>
                            </div>
                            @if($peminjaman->keterangan)
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 mb-1">Keterangan / Alasan</p>
                                <p class="text-sm text-gray-700">{{ $peminjaman->keterangan }}</p>
                            </div>
                            @endif
                            @if($peminjaman->alasan_penolakan)
                            <div class="bg-red-50 rounded-xl p-4 border-l-4 border-red-500">
                                <p class="text-xs text-red-600 font-semibold mb-1">Alasan Penolakan</p>
                                <p class="text-sm text-red-700">{{ $peminjaman->alasan_penolakan }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Daftar Barang Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slideInLeft" style="animation-delay: 0.1s">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Daftar Barang Dipinjam</h3>
                                    <p class="text-xs text-gray-500">{{ $peminjaman->detailPeminjaman->count() }} item barang</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 space-y-3">
                            @foreach($peminjaman->detailPeminjaman as $detail)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $detail->barang->nama_barang }}</p>
                                        <p class="text-xs text-gray-500">Kode: {{ $detail->barang->kode_barang }} | Jumlah: {{ $detail->jumlah }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Denda/hari</p>
                                    <p class="font-semibold text-gray-800">Rp {{ number_format($detail->barang->denda_per_hari, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                            <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                                <span class="font-semibold text-gray-700">Total Denda per Hari</span>
                                <span class="text-xl font-bold text-red-600">Rp {{ number_format($peminjaman->detailPeminjaman->sum(function($d) { return $d->barang->denda_per_hari * $d->jumlah; }), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Timeline & Denda -->
                <div class="space-y-6">
                    <!-- Timeline Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slideInRight">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-orange-500 to-red-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Status Peminjaman</h3>
                                    <p class="text-xs text-gray-500">Proses peminjaman barang</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="relative">
                                <!-- Garis vertikal connector -->
                                <div class="absolute left-5 top-0 bottom-0 w-0.5 bg-gray-200"></div>

                                <div class="space-y-0">
                                    <!-- Step 1: Pengajuan Peminjaman -->
                                    <div class="relative flex items-start pb-8">
                                        <div class="relative z-10 mr-4">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-lg
                                                {{ in_array($peminjaman->status, ['pending', 'disetujui', 'dipinjam', 'selesai', 'terlambat']) ? 'bg-green-500' : 'bg-gray-300' }}">
                                                @if(in_array($peminjaman->status, ['pending', 'disetujui', 'dipinjam', 'selesai', 'terlambat']))
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                @else
                                                    <span class="text-gray-500 text-sm font-bold">1</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1 pb-2">
                                            <p class="font-semibold text-gray-800">Pengajuan Peminjaman</p>
                                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($peminjaman->tgl_pengajuan)->translatedFormat('d F Y, H:i') }}</p>
                                            @if($peminjaman->status == 'pending')
                                                <p class="text-xs text-yellow-600 mt-1 flex items-center">
                                                    <svg class="w-3 h-3 mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Menunggu persetujuan petugas
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Step 2: Verifikasi Petugas (Setujui/Tolak) -->
                                    <div class="relative flex items-start pb-8">
                                        <div class="relative z-10 mr-4">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-lg
                                                {{ $peminjaman->status == 'disetujui' ? 'bg-green-500' :
                                                ($peminjaman->status == 'ditolak' ? 'bg-red-500' :
                                                (in_array($peminjaman->status, ['dipinjam', 'selesai', 'terlambat']) ? 'bg-green-500' : 'bg-gray-300')) }}">
                                                @if($peminjaman->status == 'disetujui' || in_array($peminjaman->status, ['dipinjam', 'selesai', 'terlambat']))
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                @elseif($peminjaman->status == 'ditolak')
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                @else
                                                    <span class="text-gray-500 text-sm font-bold">2</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1 pb-2">
                                            <p class="font-semibold text-gray-800">
                                                @if($peminjaman->status == 'ditolak')
                                                    Pengajuan Ditolak
                                                @else
                                                    Verifikasi Petugas
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                @if($peminjaman->status == 'disetujui' || in_array($peminjaman->status, ['dipinjam', 'selesai', 'terlambat']))
                                                    {{ $peminjaman->updated_at ? \Carbon\Carbon::parse($peminjaman->updated_at)->translatedFormat('d F Y') : '-' }}
                                                @endif
                                            </p>
                                            @if($peminjaman->status == 'ditolak' && $peminjaman->alasan_penolakan)
                                                <p class="text-xs text-red-600 mt-1 bg-red-50 p-2 rounded-lg">
                                                    Alasan: {{ $peminjaman->alasan_penolakan }}
                                                </p>
                                            @endif
                                            @if($peminjaman->status == 'pending')
                                                <p class="text-xs text-gray-400 mt-1">Belum diverifikasi oleh petugas</p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Step 3: Pengambilan Barang -->
                                    <div class="relative flex items-start pb-8">
                                        <div class="relative z-10 mr-4">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-lg
                                                {{ in_array($peminjaman->status, ['dipinjam', 'selesai', 'terlambat']) ? 'bg-blue-500' : 'bg-gray-300' }}">
                                                @if(in_array($peminjaman->status, ['dipinjam', 'selesai', 'terlambat']))
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                @elseif($peminjaman->status == 'disetujui')
                                                    <svg class="w-5 h-5 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                @else
                                                    <span class="text-gray-500 text-sm font-bold">3</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1 pb-2">
                                            <p class="font-semibold text-gray-800">Pengambilan Barang</p>
                                            <p class="text-xs text-gray-500">
                                                @if(in_array($peminjaman->status, ['dipinjam', 'selesai', 'terlambat']))
                                                    {{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->translatedFormat('d F Y') }}
                                                @elseif($peminjaman->status == 'disetujui')
                                                    Menunggu pengambilan barang
                                                @else
                                                    -
                                                @endif
                                            </p>
                                            @if($peminjaman->status == 'disetujui')
                                                <p class="text-xs text-blue-600 mt-1 flex items-center">
                                                    <svg class="w-3 h-3 mr-1 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Segera ambil barang ke petugas
                                                </p>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Step 4: Pengembalian Barang -->
                                    <div class="relative flex items-start">
                                        <div class="relative z-10 mr-4">
                                            <div class="w-10 h-10 rounded-full flex items-center justify-center shadow-lg
                                                {{ $peminjaman->status == 'selesai' ? 'bg-purple-500' :
                                                ($peminjaman->status == 'terlambat' ? 'bg-red-500' : 'bg-gray-300') }}">
                                                @if($peminjaman->status == 'selesai')
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                @elseif($peminjaman->status == 'terlambat')
                                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                @elseif(in_array($peminjaman->status, ['dipinjam']))
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                @else
                                                    <span class="text-gray-500 text-sm font-bold">4</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex-1">
                                            <p class="font-semibold text-gray-800">
                                                @if($peminjaman->status == 'selesai')
                                                    Pengembalian Barang ✅
                                                @elseif($peminjaman->status == 'terlambat')
                                                    Pengembalian Terlambat ⚠️
                                                @else
                                                    Pengembalian Barang
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500">
                                                @if($peminjaman->status == 'selesai' || $peminjaman->status == 'terlambat')
                                                    {{ $peminjaman->tgl_kembali_aktual ? \Carbon\Carbon::parse($peminjaman->tgl_kembali_aktual)->translatedFormat('d F Y') : '-' }}
                                                @elseif($peminjaman->status == 'dipinjam')
                                                    Batas waktu: {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_rencana)->translatedFormat('d F Y') }}
                                                @endif
                                            </p>
                                            @if($peminjaman->status == 'dipinjam')
                                                @php
                                                    $today = \Carbon\Carbon::now();
                                                    $deadline = \Carbon\Carbon::parse($peminjaman->tgl_kembali_rencana);
                                                    $daysLeft = $today->diffInDays($deadline, false);
                                                @endphp
                                                @if($daysLeft >= 0)
                                                    <p class="text-xs text-orange-600 mt-1 flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Sisa {{ $daysLeft }} hari lagi
                                                    </p>
                                                @endif
                                            @endif
                                            @if($peminjaman->status == 'terlambat')
                                                <p class="text-xs text-red-600 mt-1 flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Melebihi batas waktu pengembalian!
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Denda Card -->
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-slideInRight" style="animation-delay: 0.1s">
                        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-red-500 to-pink-500 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-800">Informasi Denda</h3>
                                    <p class="text-xs text-gray-500">Detail denda jika terlambat</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4">
                                <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                    <span class="text-gray-600">Total Denda</span>
                                    <span class="text-2xl font-bold text-red-600">Rp {{ number_format($peminjaman->total_denda, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Denda per Hari (keterlambatan)</span>
                                    <span class="font-semibold text-gray-800">Rp {{ number_format($peminjaman->detailPeminjaman->sum(function($d) { return $d->barang->denda_per_hari * $d->jumlah; }), 0, ',', '.') }}</span>
                                </div>
                                <div class="bg-yellow-50 rounded-xl p-3 mt-2">
                                    <div class="flex items-start space-x-2">
                                        <svg class="w-4 h-4 text-yellow-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-xs text-yellow-700">Denda dihitung per hari jika terjadi keterlambatan pengembalian barang.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
</body>
</html>
