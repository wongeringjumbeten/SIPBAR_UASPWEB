<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengembalian - SIPBAR Petugas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.02); opacity: 0.9; }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out forwards; }
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
        <div class="absolute top-20 left-10 w-72 h-72 bg-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-emerald-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-teal-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Navbar -->
    <nav class="gradient-bg text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">SIPBAR</h1>
                        <p class="text-xs text-blue-100">Form Pengembalian</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100">Petugas</p>
                    </div>
                    <a href="{{ route('petugas.pengajuan.monitoring') }}" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
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
        <div class="max-w-4xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-8 animate-fadeInUp">
                <div class="inline-block p-3 bg-gradient-to-r from-green-100 to-emerald-100 rounded-2xl mb-3">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Proses Pengembalian</h1>
                <p class="text-gray-500 mt-2">Input kondisi barang dan hitung denda</p>
            </div>

            <!-- Info Peminjaman -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-white">Detail Peminjaman</h3>
                            <p class="text-white/80 text-sm">Kode: {{ $peminjaman->kode_peminjaman }}</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-400 text-xs">Peminjam</p>
                            <p class="font-semibold text-gray-800">{{ $peminjaman->mahasiswa->name ?? '-' }}</p>
                            <p class="text-xs text-gray-500">NIM: {{ $peminjaman->mahasiswa->nim_nip ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Tanggal Pinjam</p>
                            <p class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Batas Kembali</p>
                            <p class="font-semibold {{ $isTerlambat ? 'text-red-600' : 'text-gray-800' }}">
                                {{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_rencana)->translatedFormat('d F Y') }}
                                @if($isTerlambat)
                                <span class="text-xs ml-2 bg-red-100 text-red-700 px-2 py-0.5 rounded-full">Terlambat {{ $hariTerlambat }} hari</span>
                                @endif
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">Tanggal Pengembalian</p>
                            <p class="font-semibold text-gray-800">{{ now()->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Pengembalian -->
            <form action="{{ route('petugas.pengembalian.proses', $peminjaman->id) }}" method="POST" class="bg-white rounded-2xl shadow-xl overflow-hidden animate-scaleIn">
                @csrf

                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Daftar Barang</h3>
                            <p class="text-xs text-gray-500">Input kondisi setiap barang</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-4">
                    @foreach($peminjaman->detailPeminjaman as $index => $detail)
                    <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition barang-item" data-id="{{ $detail->id }}">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-3">
                            <div>
                                <h4 class="font-semibold text-gray-800">{{ $detail->barang->nama_barang }}</h4>
                                <p class="text-xs text-gray-500">Kode: {{ $detail->barang->kode_barang }} | Jumlah: {{ $detail->jumlah }} unit</p>
                                <p class="text-xs text-gray-500">Denda per hari: Rp {{ number_format($detail->barang->denda_per_hari, 0, ',', '.') }}</p>
                            </div>
                            <div class="w-full md:w-64">
                                <label class="block text-xs font-semibold text-gray-700 mb-1">Kondisi Kembali</label>
                                <select name="kondisi[{{ $detail->id }}]"
                                        class="kondisi-select w-full px-3 py-2 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                                        data-jumlah="{{ $detail->jumlah }}"
                                        data-denda="{{ $detail->barang->denda_per_hari }}"
                                        data-harga="{{ $detail->barang->harga_perolehan ?? 0 }}"
                                        data-terlambat="{{ $hariTerlambat ?? 0 }}">
                                    <option value="baik">Baik</option>
                                    <option value="rusak_ringan">Rusak Ringan (25%)</option>
                                    <option value="rusak_berat">Rusak Berat (50%)</option>
                                    <option value="hilang">Hilang (100%)</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500 bg-gray-50 rounded-lg p-2">
                            <span>Subtotal denda: <span class="subtotal-value font-semibold text-red-600">Rp 0</span></span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Catatan -->
                <div class="px-6 pb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (opsional)</label>
                    <textarea name="catatan" rows="3" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <!-- Ringkasan Denda -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Total Denda</p>
                            <p class="text-2xl font-bold text-red-600" id="totalDenda">Rp 0</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('petugas.pengajuan.monitoring') }}" class="px-6 py-2.5 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit" class="btn-gradient text-white px-6 py-2.5 rounded-xl shadow-lg hover:shadow-xl transition">
                                Konfirmasi Pengembalian
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Fungsi untuk menghitung total denda
    function hitungTotalDenda() {
        let total = 0;
        const items = document.querySelectorAll('.barang-item');

        items.forEach(item => {
            const select = item.querySelector('.kondisi-select');

            // Cek apakah select ditemukan
            if (!select) return;

            const jumlah = parseInt(select.dataset.jumlah) || 1;
            const dendaPerHari = parseInt(select.dataset.denda) || 0;
            const hargaBarang = parseInt(select.dataset.harga) || 0;
            const hariTerlambat = parseInt(select.dataset.terlambat) || 0;

            const kondisi = select.value;
            let subtotal = 0;

            // 1. Denda keterlambatan
            subtotal += hariTerlambat * dendaPerHari * jumlah;

            // 2. Denda kerusakan/hilang
            if (kondisi === 'rusak_ringan') {
                subtotal += (hargaBarang * 0.25) * jumlah;
            } else if (kondisi === 'rusak_berat') {
                subtotal += (hargaBarang * 0.5) * jumlah;
            } else if (kondisi === 'hilang') {
                subtotal += hargaBarang * jumlah;
            }

            // Tampilkan subtotal
            const subtotalSpan = item.querySelector('.subtotal-value');
            if (subtotalSpan) {
                subtotalSpan.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;
            }

            total += subtotal;
        });

        // Tampilkan total
        const totalElement = document.getElementById('totalDenda');
        if (totalElement) {
            totalElement.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }
    }

    // Event listener untuk semua select
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('.kondisi-select');
        selects.forEach(select => {
            select.addEventListener('change', hitungTotalDenda);
        });

        // Panggil sekali untuk hitung awal
        hitungTotalDenda();
    });
</script>
</body>
</html>
