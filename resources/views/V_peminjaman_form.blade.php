<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman - SIPBAR</title>
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
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
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
        .animate-slideUp { animation: slideUp 0.5s ease-out forwards; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out forwards; }
        .animate-pulse { animation: pulse 2s ease-in-out infinite; }

        .gradient-bg {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        .gradient-form {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    @include('components.V_notifikasi')

    <!-- Floating Background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Navbar -->
    <nav class="gradient-bg text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold tracking-tight">SIPBAR</h1>
                        <p class="text-xs text-blue-100">Form Peminjaman</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100">Mahasiswa</p>
                    </div>
                    <a href="{{ route('mahasiswa.peminjaman.barang') }}" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
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
        <div class="max-w-3xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-8 animate-slideUp">
                <div class="inline-block p-3 bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl mb-3">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Lengkapi Data Peminjaman</h1>
                <p class="text-gray-500 mt-2">Isi tanggal peminjaman dan rencana pengembalian</p>
            </div>

            <!-- Alert Error -->
            @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-xl mb-6 animate-scaleIn">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-semibold">Terjadi kesalahan. Silakan periksa kembali.</span>
                </div>
            </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden animate-scaleIn">
                <!-- Ringkasan Barang yang Dipinjam -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center animate-pulse">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Ringkasan Peminjaman</h3>
                            <p class="text-xs text-gray-500">{{ count($cart) }} barang akan dipinjam</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-3">
                    @foreach($cart as $item)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $item['nama_barang'] }}</p>
                                <p class="text-xs text-gray-500">Jumlah: {{ $item['jumlah'] }} | Denda: Rp {{ number_format($item['denda_per_hari'], 0, ',', '.') }}/hari</p>
                            </div>
                        </div>
                        <span class="text-sm font-semibold text-gray-600">Subtotal: Rp {{ number_format($item['denda_per_hari'] * $item['jumlah'], 0, ',', '.') }}/hari</span>
                    </div>
                    @endforeach

                    <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                        <span class="font-semibold text-gray-700">Total Denda per Hari</span>
                        <span class="text-xl font-bold text-blue-600">Rp {{ number_format($totalDendaPerHari, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('mahasiswa.peminjaman.store') }}" method="POST" class="p-6 space-y-6">
                    @csrf

                    <!-- Tanggal Pinjam -->
                    <div class="animate-slideUp" style="animation-delay: 0.1s">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Tanggal Pinjam</span>
                            </div>
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tgl_pinjam" id="tgl_pinjam" value="{{ old('tgl_pinjam', date('Y-m-d')) }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                            min="{{ date('Y-m-d') }}">
                        @error('tgl_pinjam')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Kembali Rencana -->
                    <div class="animate-slideUp" style="animation-delay: 0.2s">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>Rencana Tanggal Kembali</span>
                            </div>
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tgl_kembali_rencana" id="tgl_kembali_rencana" value="{{ old('tgl_kembali_rencana') }}" required
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300">
                        <p id="durasi_info" class="text-xs text-gray-500 mt-1"></p>
                        @error('tgl_kembali_rencana')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="animate-slideUp" style="animation-delay: 0.3s">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <div class="flex items-center space-x-1">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                <span>Keterangan (Alasan Peminjaman)</span>
                            </div>
                        </label>
                        <textarea name="keterangan" rows="3"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                            placeholder="Contoh: Untuk praktikum mata kuliah...">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Tambahan -->
                    <div class="bg-blue-50 rounded-xl p-4 animate-slideUp" style="animation-delay: 0.4s">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm">
                                <p class="font-semibold text-blue-800">Perhatian!</p>
                                <p class="text-blue-700">• Pastikan tanggal kembali sesuai dengan kebutuhan maksimal 7 hari</p>
                                <p class="text-blue-700">• Pengembalian terlambat akan dikenakan denda sesuai ketentuan</p>
                                <p class="text-blue-700">• Setelah submit, pengajuan akan diproses oleh petugas</p>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex justify-end space-x-4 pt-4 border-t border-gray-100 animate-slideUp" style="animation-delay: 0.5s">
                        <a href="{{ route('mahasiswa.peminjaman.barang') }}"
                            class="px-6 py-2.5 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Kembali</span>
                        </a>
                        <button type="submit"
                            class="btn-gradient text-white px-6 py-2.5 rounded-xl shadow-lg hover:shadow-xl transition flex items-center space-x-2 group">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Ajukan Peminjaman</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        // Hitung durasi dan validasi tanggal
        const tglPinjam = document.getElementById('tgl_pinjam');
        const tglKembali = document.getElementById('tgl_kembali_rencana');
        const durasiInfo = document.getElementById('durasi_info');

        function hitungDurasi() {
            if (tglPinjam.value && tglKembali.value) {
                const pinjam = new Date(tglPinjam.value);
                const kembali = new Date(tglKembali.value);
                const diffTime = Math.abs(kembali - pinjam);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (kembali < pinjam) {
                    durasiInfo.innerHTML = 'Tanggal kembali harus setelah tanggal pinjam!';
                    durasiInfo.classList.add('text-red-500');
                    durasiInfo.classList.remove('text-gray-500');
                } else if (diffDays > 7) {
                    durasiInfo.innerHTML = 'Maksimal durasi peminjaman adalah 7 hari!';
                    durasiInfo.classList.add('text-red-500');
                    durasiInfo.classList.remove('text-gray-500');
                } else {
                    durasiInfo.innerHTML = `Durasi peminjaman: ${diffDays} hari`;
                    durasiInfo.classList.add('text-green-500');
                    durasiInfo.classList.remove('text-gray-500', 'text-red-500');
                }
            }
        }

        // Set minimal tanggal kembali (H+1 dari tanggal pinjam)
        function setMinKembali() {
            if (tglPinjam.value) {
                const minDate = new Date(tglPinjam.value);
                minDate.setDate(minDate.getDate() + 1);
                tglKembali.min = minDate.toISOString().split('T')[0];

                // Set default tanggal kembali = H+3
                const defaultKembali = new Date(tglPinjam.value);
                defaultKembali.setDate(defaultKembali.getDate() + 3);
                if (!tglKembali.value) {
                    tglKembali.value = defaultKembali.toISOString().split('T')[0];
                }
                hitungDurasi();
            }
        }

        tglPinjam.addEventListener('change', setMinKembali);
        tglKembali.addEventListener('change', hitungDurasi);

        // Trigger on load
        setMinKembali();
        </script>

@if(session('notification'))
    <script>
document.addEventListener('DOMContentLoaded', function() {
        showNotification(
            '{{ session('notification.type') }}',
            '{{ session('notification.message') }}',
            '{{ session('notification.title') }}'
        );
    });
</script>
@endif

@if(session('notification_type'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        showNotification(
            '{{ session('notification_type') }}',
            '{{ session('notification_message') }}',
            '{{ session('notification_title') }}'
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
