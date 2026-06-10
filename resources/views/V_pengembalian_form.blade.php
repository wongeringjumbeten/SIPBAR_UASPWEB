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
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out forwards; }
        .animate-fadeInUp { animation: fadeInUp 0.4s ease-out forwards; }
        .animate-slideDown { animation: slideDown 0.3s ease-out forwards; }

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

        .radio-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .radio-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px -5px rgba(0, 0, 0, 0.1);
        }
        input[type="radio"]:checked + .radio-card {
            border-color: #10b981;
            background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        }
        input[type="radio"]:checked + .radio-card.radio-rusak_ringan {
            border-color: #eab308;
            background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        }
        input[type="radio"]:checked + .radio-card.radio-rusak_berat {
            border-color: #f97316;
            background: linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%);
        }
        input[type="radio"]:checked + .radio-card.radio-hilang {
            border-color: #ef4444;
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
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

        button[type="submit"]:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none !important;
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
        <div class="max-w-5xl mx-auto">

            <!-- Header -->
            <div class="text-center mb-8 animate-fadeInUp">
                <div class="inline-block p-3 bg-gradient-to-r from-green-100 to-emerald-100 rounded-2xl mb-3">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-800">Proses Pengembalian</h1>
                <p class="text-gray-500 mt-2">Input kondisi dan jumlah barang yang rusak/hilang</p>
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
                            <p class="text-xs text-gray-500">Pilih kondisi dan isi jumlah yang rusak/hilang</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    @foreach($peminjaman->detailPeminjaman as $index => $detail)
                    @php
                        $maxJumlah = $detail->jumlah;
                        $dendaPerHari = $detail->barang->denda_per_hari;
                        $hargaBarang = $detail->barang->harga_perolehan ?? 0;
                    @endphp
                    <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition barang-item" data-id="{{ $detail->id }}">
                        <!-- Info Barang -->
                        <div class="mb-4 pb-3 border-b border-gray-100">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="font-semibold text-gray-800 text-lg">{{ $detail->barang->nama_barang }}</h4>
                                    <p class="text-xs text-gray-500">Kode: {{ $detail->barang->kode_barang }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-gray-800">{{ $maxJumlah }} unit</p>
                                    <p class="text-xs text-gray-500">Denda: Rp {{ number_format($dendaPerHari, 0, ',', '.') }}/hari</p>
                                    <p class="text-xs text-gray-500">Harga: Rp {{ number_format($hargaBarang, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Radio Button Kondisi dengan data attributes -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="kondisi[{{ $detail->id }}]" value="baik"
                                    class="kondisi-radio sr-only"
                                    data-barang-id="{{ $detail->id }}"
                                    data-jumlah-dipinjam="{{ $maxJumlah }}"
                                    data-denda-per-hari="{{ $dendaPerHari }}"
                                    data-harga-barang="{{ $hargaBarang }}"
                                    {{ $loop->first ? 'checked' : '' }}>
                                <div class="radio-card border-2 rounded-xl p-3 text-center transition-all">
                                    <div class="text-xl mb-1"></div>
                                    <div class="font-semibold text-sm">Baik</div>
                                    <div class="text-xs text-gray-500">0% denda</div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="kondisi[{{ $detail->id }}]" value="rusak_ringan"
                                    class="kondisi-radio sr-only"
                                    data-barang-id="{{ $detail->id }}"
                                    data-jumlah-dipinjam="{{ $maxJumlah }}"
                                    data-denda-per-hari="{{ $dendaPerHari }}"
                                    data-harga-barang="{{ $hargaBarang }}">
                                <div class="radio-card radio-rusak_ringan border-2 rounded-xl p-3 text-center transition-all">
                                    <div class="text-xl mb-1"></div>
                                    <div class="font-semibold text-sm">Rusak Ringan</div>
                                    <div class="text-xs text-gray-500">25% dari harga</div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="kondisi[{{ $detail->id }}]" value="rusak_berat"
                                    class="kondisi-radio sr-only"
                                    data-barang-id="{{ $detail->id }}"
                                    data-jumlah-dipinjam="{{ $maxJumlah }}"
                                    data-denda-per-hari="{{ $dendaPerHari }}"
                                    data-harga-barang="{{ $hargaBarang }}">
                                <div class="radio-card radio-rusak_berat border-2 rounded-xl p-3 text-center transition-all">
                                    <div class="text-xl mb-1"></div>
                                    <div class="font-semibold text-sm">Rusak Berat</div>
                                    <div class="text-xs text-gray-500">50% dari harga</div>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="kondisi[{{ $detail->id }}]" value="hilang"
                                    class="kondisi-radio sr-only"
                                    data-barang-id="{{ $detail->id }}"
                                    data-jumlah-dipinjam="{{ $maxJumlah }}"
                                    data-denda-per-hari="{{ $dendaPerHari }}"
                                    data-harga-barang="{{ $hargaBarang }}">
                                <div class="radio-card radio-hilang border-2 rounded-xl p-3 text-center transition-all">
                                    <div class="text-xl mb-1"></div>
                                    <div class="font-semibold text-sm">Hilang</div>
                                    <div class="text-xs text-gray-500">100% dari harga</div>
                                </div>
                            </label>
                        </div>

                        <!-- Input Jumlah Rusak -->
                        <div id="jumlah-container-{{ $detail->id }}" class="jumlah-container hidden transition-all duration-300">
                            <div class="bg-yellow-50 rounded-xl p-4 border border-yellow-200">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="font-semibold text-gray-700">
                                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                        Jumlah Unit yang Rusak/Hilang
                                    </label>
                                    <span class="text-xs text-gray-500">Maksimal {{ $maxJumlah }} unit</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <button type="button" onclick="decrementJumlah({{ $detail->id }}, {{ $maxJumlah }})" class="w-10 h-10 rounded-xl bg-white border border-gray-300 hover:bg-gray-100 transition flex items-center justify-center text-xl font-bold">-</button>
                                    <input type="number" name="jumlah_rusak[{{ $detail->id }}]" id="jumlah-rusak-{{ $detail->id }}"
                                        value="1" min="1" max="{{ $maxJumlah }}"
                                        class="jumlah-rusak-input w-24 text-center text-xl font-bold py-2 border-2 border-gray-200 rounded-xl focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 transition-all"
                                        onchange="hitungTotalDenda()">
                                    <button type="button" onclick="incrementJumlah({{ $detail->id }}, {{ $maxJumlah }})" class="w-10 h-10 rounded-xl bg-white border border-gray-300 hover:bg-gray-100 transition flex items-center justify-center text-xl font-bold">+</button>
                                    <div class="ml-4 text-sm">
                                        <p class="text-gray-600">Denda kerusakan = <span class="font-semibold text-red-600" id="denda-kerusakan-{{ $detail->id }}">Rp 0</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Subtotal denda -->
                        <div class="mt-3 text-sm bg-gray-50 rounded-lg p-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Denda keterlambatan ({{ $hariTerlambat ?? 0 }} hari):</span>
                                <span class="font-semibold text-gray-800">Rp <span id="denda-telat-{{ $detail->id }}">0</span></span>
                            </div>
                            <div class="flex justify-between mt-1">
                                <span class="text-gray-600">+ Denda kerusakan/hilang:</span>
                                <span id="subtotal-kerusakan-{{ $detail->id }}" class="font-semibold text-red-600">Rp 0</span>
                            </div>
                            <div class="border-t border-gray-200 mt-2 pt-2 flex justify-between">
                                <span class="font-semibold text-gray-700">SUBTOTAL BARANG INI:</span>
                                <span id="subtotal-total-{{ $detail->id }}" class="font-bold text-red-600 text-lg">Rp 0</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Catatan -->
                <div class="px-6 pb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (opsional)</label>
                    <textarea name="catatan" rows="2" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                </div>

                <!-- Ringkasan Denda -->
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-t border-gray-200">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <p class="text-sm text-gray-500">TOTAL DENDA</p>
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
    const hariTerlambat = {{ $hariTerlambat ?? 0 }};

    // Fungsi validasi semua form
    function validateForm() {
        let isValid = true;
        const items = document.querySelectorAll('.barang-item');

        items.forEach(item => {
            const radio = item.querySelector('.kondisi-radio:checked');
            if (!radio) {
                isValid = false;
                return;
            }

            const kondisi = radio.value;
            if (kondisi !== 'baik') {
                const barangId = radio.dataset.barangId;
                const jumlahDipinjam = parseInt(radio.dataset.jumlahDipinjam) || 1;
                const jumlahInput = document.getElementById(`jumlah-rusak-${barangId}`);
                let jumlahRusak = jumlahInput ? parseInt(jumlahInput.value) : 1;

                // Validasi jumlah tidak boleh melebihi yang dipinjam
                if (isNaN(jumlahRusak) || jumlahRusak < 1) {
                    isValid = false;
                    if (jumlahInput) jumlahInput.classList.add('border-red-500');
                } else if (jumlahRusak > jumlahDipinjam) {
                    isValid = false;
                    if (jumlahInput) {
                        jumlahInput.classList.add('border-red-500');
                        showError(jumlahInput, `Jumlah tidak boleh melebihi ${jumlahDipinjam} unit`);
                    }
                } else {
                    if (jumlahInput) {
                        jumlahInput.classList.remove('border-red-500');
                        removeError(jumlahInput);
                    }
                }
            }
        });

        // Enable/disable tombol submit
        const submitBtn = document.querySelector('button[type="submit"]');
        if (submitBtn) {
            if (isValid) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                submitBtn.classList.add('hover:scale-105');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                submitBtn.classList.remove('hover:scale-105');
            }
        }

        return isValid;
    }

    // Tampilkan pesan error
    function showError(input, message) {
        let errorSpan = input.parentElement.querySelector('.error-message');
        if (!errorSpan) {
            errorSpan = document.createElement('p');
            errorSpan.className = 'error-message text-red-500 text-xs mt-1';
            input.parentElement.appendChild(errorSpan);
        }
        errorSpan.textContent = message;
    }

    function removeError(input) {
        const errorSpan = input.parentElement.querySelector('.error-message');
        if (errorSpan) {
            errorSpan.remove();
        }
    }

    // Fungsi untuk menghitung total denda
    function hitungTotalDenda() {
        let totalSemua = 0;
        const items = document.querySelectorAll('.barang-item');

        items.forEach(item => {
            const radio = item.querySelector('.kondisi-radio:checked');
            if (!radio) return;

            const kondisi = radio.value;
            const barangId = radio.dataset.barangId;
            const jumlahDipinjam = parseInt(radio.dataset.jumlahDipinjam) || 1;
            const dendaPerHari = parseInt(radio.dataset.dendaPerHari) || 0;
            const hargaBarang = parseInt(radio.dataset.hargaBarang) || 0;

            // Ambil jumlah yang rusak (jika kondisi bukan baik)
            let jumlahRusak = 0;
            if (kondisi !== 'baik') {
                const jumlahInput = document.getElementById(`jumlah-rusak-${barangId}`);
                let rawValue = jumlahInput ? jumlahInput.value : '1';
                jumlahRusak = parseInt(rawValue);

                // Validasi dan koreksi
                if (isNaN(jumlahRusak) || jumlahRusak < 1) {
                    jumlahRusak = 1;
                    if (jumlahInput) jumlahInput.value = 1;
                }
                if (jumlahRusak > jumlahDipinjam) {
                    jumlahRusak = jumlahDipinjam;
                    if (jumlahInput) jumlahInput.value = jumlahDipinjam;
                }
            }

            // 1. Denda keterlambatan (untuk SEMUA unit yang dipinjam)
            const dendaTelat = hariTerlambat * dendaPerHari * jumlahDipinjam;

            // 2. Denda kerusakan/hilang (hanya untuk jumlah yang rusak/hilang)
            let dendaKerusakan = 0;
            if (kondisi === 'rusak_ringan') {
                dendaKerusakan = (hargaBarang * 0.25) * jumlahRusak;
            } else if (kondisi === 'rusak_berat') {
                dendaKerusakan = (hargaBarang * 0.5) * jumlahRusak;
            } else if (kondisi === 'hilang') {
                dendaKerusakan = hargaBarang * jumlahRusak;
            }

            const subtotal = dendaTelat + dendaKerusakan;

            // Update tampilan (hanya jika elemen ada)
            const telatEl = document.getElementById(`denda-telat-${barangId}`);
            if (telatEl) telatEl.textContent = dendaTelat.toLocaleString('id-ID');

            const kerusakanEl = document.getElementById(`subtotal-kerusakan-${barangId}`);
            if (kerusakanEl) kerusakanEl.textContent = `Rp ${dendaKerusakan.toLocaleString('id-ID')}`;

            const totalEl = document.getElementById(`subtotal-total-${barangId}`);
            if (totalEl) totalEl.textContent = `Rp ${subtotal.toLocaleString('id-ID')}`;

            const dendaKerusakanSpan = document.getElementById(`denda-kerusakan-${barangId}`);
            if (dendaKerusakanSpan) dendaKerusakanSpan.textContent = `Rp ${dendaKerusakan.toLocaleString('id-ID')}`;

            totalSemua += subtotal;
        });

        const totalElement = document.getElementById('totalDenda');
        if (totalElement) {
            totalElement.textContent = `Rp ${totalSemua.toLocaleString('id-ID')}`;
        }

        // Jalankan validasi setelah hitung
        validateForm();
    }

    // Toggle tampilan input jumlah berdasarkan radio
    function toggleJumlahContainer(barangId, kondisi) {
        const container = document.getElementById(`jumlah-container-${barangId}`);
        if (container) {
            if (kondisi === 'baik') {
                container.classList.add('hidden');
            } else {
                container.classList.remove('hidden');
                container.classList.add('animate-slideDown');
                const input = document.getElementById(`jumlah-rusak-${barangId}`);
                if (input && (input.value === '0' || input.value === '')) {
                    input.value = '1';
                }
            }
        }
        hitungTotalDenda();
    }

    // Increment jumlah
    function incrementJumlah(barangId, maxJumlah) {
        const input = document.getElementById(`jumlah-rusak-${barangId}`);
        if (input) {
            let val = parseInt(input.value) || 1;
            if (val < maxJumlah) {
                input.value = val + 1;
                removeError(input);
                hitungTotalDenda();
            } else {
                showError(input, `Maksimal ${maxJumlah} unit`);
            }
        }
    }

    // Decrement jumlah
    function decrementJumlah(barangId, maxJumlah) {
        const input = document.getElementById(`jumlah-rusak-${barangId}`);
        if (input) {
            let val = parseInt(input.value) || 1;
            if (val > 1) {
                input.value = val - 1;
                removeError(input);
                hitungTotalDenda();
            }
        }
    }

    // Event listener untuk input manual
    function setupJumlahInput(barangId, maxJumlah) {
        const input = document.getElementById(`jumlah-rusak-${barangId}`);
        if (input) {
            input.addEventListener('input', function() {
                let val = parseInt(this.value);

                // Cek NaN atau kosong
                if (isNaN(val) || this.value === '') {
                    this.value = 1;
                    val = 1;
                }

                // Cek melebihi batas
                if (val > maxJumlah) {
                    this.value = maxJumlah;
                    showError(this, `Jumlah tidak boleh melebihi ${maxJumlah} unit`);
                } else if (val < 1) {
                    this.value = 1;
                    removeError(this);
                } else {
                    removeError(this);
                }

                hitungTotalDenda();
            });
        }
    }

    // Setup semua event listener
    document.addEventListener('DOMContentLoaded', function() {
        // Setup radio buttons
        const radios = document.querySelectorAll('.kondisi-radio');
        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                const barangId = this.dataset.barangId;
                toggleJumlahContainer(barangId, this.value);
            });

            if (radio.checked) {
                const barangId = radio.dataset.barangId;
                toggleJumlahContainer(barangId, radio.value);
            }
        });

        // Setup jumlah inputs
        const jumlahInputs = document.querySelectorAll('.jumlah-rusak-input');
        jumlahInputs.forEach(input => {
            const maxJumlah = parseInt(input.getAttribute('max')) || 1;
            input.addEventListener('change', hitungTotalDenda);
            input.addEventListener('keyup', hitungTotalDenda);
            setupJumlahInput(input.id.split('-').pop(), maxJumlah);
        });

        // Initial hitung dan validasi
        hitungTotalDenda();

        // Cegah submit jika tombol disabled
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    alert('Mohon lengkapi data dengan benar sebelum mengkonfirmasi pengembalian.');
                }
            });
        }
    });
</script>
</body>
</html>
