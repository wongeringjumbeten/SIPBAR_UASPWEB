<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Peminjaman - SIPBAR</title>
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
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(102, 126, 234, 0.4);
        }
        .btn-outline {
            transition: all 0.3s ease;
        }
        .btn-outline:hover {
            transform: translateY(-2px);
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
                        <p class="text-xs text-blue-100">Keranjang Peminjaman</p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        <span>Tambah Barang</span>
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
            <div class="text-center mb-8 animate-fadeInUp">
                <div class="inline-block p-3 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl mb-3">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M4 5h16"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Keranjang Peminjaman</h1>
                <p class="text-gray-500 mt-2">Review barang yang akan dipinjam</p>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-xl mb-6 animate-scaleIn">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 animate-scaleIn">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            @if(empty($cart) || count($cart) == 0)
            <!-- Empty Cart -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
                <div class="p-12 text-center">
                    <div class="w-32 h-32 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-float">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M4 5h16"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Keranjang Kosong</h3>
                    <p class="text-gray-500 mb-6">Belum ada barang yang ditambahkan ke keranjang.</p>
                    <a href="{{ route('mahasiswa.peminjaman.barang') }}" class="btn-gradient text-white px-6 py-3 rounded-xl shadow-lg hover:shadow-xl transition inline-flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Tambah Barang Sekarang</span>
                    </a>
                </div>
            </div>
            @else
            <!-- Cart Content -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cart as $index => $item)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden animate-scaleIn card-hover" style="animation-delay: {{ $index * 0.05 }}s">
                        <div class="p-5">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-800">{{ $item['nama_barang'] }}</h3>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full text-gray-600">Denda: Rp {{ number_format($item['denda_per_hari'], 0, ',', '.') }}/hari</span>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('mahasiswa.peminjaman.removeFromCart', $index) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 transition" onclick="return confirm('Hapus barang ini dari keranjang?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="flex items-center justify-between mt-4 pt-3 border-t border-gray-100">
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-500">Jumlah:</span>
                                    <span class="font-semibold text-gray-800">{{ $item['jumlah'] }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-sm text-gray-500">Subtotal Denda/hari</span>
                                    <p class="font-bold text-blue-600">Rp {{ number_format($item['denda_per_hari'] * $item['jumlah'], 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Summary Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden sticky top-24 animate-slideInRight">
                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-5 py-4">
                            <h3 class="text-white font-bold text-lg flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <span>Ringkasan</span>
                            </h3>
                        </div>
                        <div class="p-5">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Barang</span>
                                    <span class="font-semibold text-gray-800">{{ count($cart) }} item</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Unit</span>
                                    <span class="font-semibold text-gray-800">
                                        {{ array_sum(array_column($cart, 'jumlah')) }} unit
                                    </span>
                                </div>
                                <div class="border-t border-gray-100 my-2"></div>
                                <div class="flex justify-between">
                                    <span class="text-gray-700 font-semibold">Total Denda per Hari</span>
                                    <span class="text-xl font-bold text-blue-600">Rp {{ number_format($totalDendaPerHari, 0, ',', '.') }}</span>
                                </div>
                                <div class="bg-blue-50 rounded-xl p-3 mt-3">
                                    <div class="flex items-start space-x-2">
                                        <svg class="w-4 h-4 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <p class="text-xs text-blue-700">Denda akan dihitung per hari jika terjadi keterlambatan pengembalian.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 space-y-3">
                                <a href="{{ route('mahasiswa.peminjaman.form') }}" class="btn-gradient text-white px-5 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition flex items-center justify-center space-x-2 w-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Lanjut ke Form Peminjaman</span>
                                </a>
                                <a href="{{ route('mahasiswa.peminjaman.barang') }}" class="btn-outline border-2 border-gray-300 text-gray-700 px-5 py-3 rounded-xl font-semibold hover:bg-gray-50 transition flex items-center justify-center space-x-2 w-full">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    <span>Tambah Barang Lagi</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
        }
    </style>
</body>
</html>
