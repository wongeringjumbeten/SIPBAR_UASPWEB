<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajukan Peminjaman - SIPBAR</title>
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
        @keyframes modalPop {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }
        .animate-scaleIn { animation: scaleIn 0.4s ease-out forwards; }
        .animate-slideInLeft { animation: slideInLeft 0.4s ease-out forwards; }
        .animate-slideInRight { animation: slideInRight 0.4s ease-out forwards; }
        .animate-fadeInUp { animation: fadeInUp 0.4s ease-out forwards; }
        .animate-modalPop { animation: modalPop 0.3s ease-out forwards; }
        .animate-shake { animation: shake 0.3s ease-in-out; }

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

        .badge-tersedia {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        .badge-habis {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        /* Chrome, Safari, Edge, Opera - Hilangkan spinner number input */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
            appearance: textfield;
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
                        <p class="text-xs text-blue-100">Sistem Peminjaman Barang Kampus</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4 animate-slideInRight">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-blue-100">Mahasiswa</p>
                        <p class="text-xs text-blue-200">NIM: {{ Auth::user()->nim_nip ?? '-' }}</p>
                    </div>
                    <a href="{{ route('mahasiswa.peminjaman.cart') }}" class="relative bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-1.5 6M17 13l1.5 6M9 21h6M4 5h16"></path>
                        </svg>
                        <span>Keranjang</span>
                        @if(session()->has('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                    <a href="{{ route('mahasiswa.riwayat') }}" class="bg-white/20 px-4 py-2 rounded-lg text-sm hover:bg-white/30 transition flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <span>Riwayat</span>
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
        <!-- Header dengan Logo dan Tombol Kembali -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8 animate-fadeInUp">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <div class="w-14 h-14 bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg animate-float">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-1 -right-1 w-4 h-4 bg-green-500 rounded-full border-2 border-white animate-pulse"></div>
                </div>
                <div>
                    <div class="flex items-center space-x-2">
                        <div class="w-1 h-7 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                        <h1 class="text-2xl md:text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Ajukan Peminjaman</h1>
                    </div>
                    <p class="text-gray-500 text-sm mt-1 ml-3">Pilih barang yang ingin kamu pinjam</p>
                </div>
            </div>

            <a href="{{ route('dashboard.mahasiswa') }}"
            class="group flex items-center space-x-2 px-5 py-2.5 bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-xl font-semibold shadow-md hover:shadow-lg transition-all hover:scale-105">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white rounded-2xl shadow-lg p-5 mb-6 animate-fadeInUp" style="animation-delay: 0.1s">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="searchBarang" placeholder="Cari barang..."
                        class="w-full pl-10 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                </div>
                <select id="filterKategori" class="px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris ?? [] as $kategori)
                    <option value="{{ $kategori->nama_kategori }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                </select>
                <button onclick="resetFilters()" class="px-5 py-3 bg-gray-100 text-gray-600 rounded-xl hover:bg-gray-200 transition flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    <span>Reset</span>
                </button>
            </div>
        </div>

        <!-- Barang Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="barangGrid">
            @forelse($barangs ?? [] as $barang)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover animate-scaleIn barang-card"
                data-nama="{{ $barang->nama_barang }}"
                data-kategori="{{ $barang->kategori->nama_kategori ?? '-' }}"
                data-id="{{ $barang->id }}"
                data-stok="{{ $barang->stok_tersedia }}">

                <!-- Image -->
                <div class="h-48 bg-gradient-to-r from-blue-400 to-purple-500 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-24 h-24 bg-white/20 rounded-2xl flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    @if($barang->stok_tersedia > 0)
                    <div class="absolute top-3 right-3">
                        <span class="badge-tersedia text-white text-xs px-2 py-1 rounded-full shadow-md">Tersedia</span>
                    </div>
                    @else
                    <div class="absolute top-3 right-3">
                        <span class="badge-habis text-white text-xs px-2 py-1 rounded-full shadow-md">Stok Habis</span>
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-lg text-gray-800">{{ $barang->nama_barang }}</h3>
                        <span class="text-xs text-gray-400">{{ $barang->kode_barang }}</span>
                    </div>

                    <div class="flex items-center space-x-2 mb-3">
                        <span class="text-xs bg-gray-100 px-2 py-1 rounded-full text-gray-600">{{ $barang->kategori->nama_kategori ?? '-' }}</span>
                        <span class="text-xs {{ $barang->kondisi == 'baik' ? 'text-green-600' : ($barang->kondisi == 'rusak_ringan' ? 'text-yellow-600' : 'text-red-600') }}">
                            {{ $barang->kondisi == 'baik' ? 'Baik' : ($barang->kondisi == 'rusak_ringan' ? 'Rusak Ringan' : 'Rusak Berat') }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-3 mb-4">
                        <div class="bg-gray-50 rounded-xl p-2 text-center">
                            <p class="text-xs text-gray-400">Stok Tersedia</p>
                            <p class="text-xl font-bold {{ $barang->stok_tersedia > 0 ? 'text-green-600' : 'text-red-500' }}">{{ $barang->stok_tersedia }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-xl p-2 text-center">
                            <p class="text-xs text-gray-400">Denda/Hari</p>
                            <p class="text-xl font-bold text-gray-800">Rp {{ number_format($barang->denda_per_hari, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                        <div class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>{{ $barang->lokasi ?? 'Tidak ada' }}</span>
                        </div>
                    </div>

                    @if($barang->stok_tersedia > 0)
                    <button onclick="openModal({{ $barang->id }}, '{{ $barang->nama_barang }}', {{ $barang->stok_tersedia }})"
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2.5 rounded-xl font-semibold hover:shadow-lg transition-all hover:scale-105">
                        Pinjam Sekarang
                    </button>
                    @else
                    <button disabled class="w-full bg-gray-300 text-gray-500 py-2.5 rounded-xl font-semibold cursor-not-allowed">
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-3xl p-12 text-center">
                    <div class="w-32 h-32 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-float">
                        <svg class="w-16 h-16 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Belum Ada Barang</h3>
                    <p class="text-gray-500">Belum ada barang yang tersedia untuk dipinjam.</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Jumlah -->
    <div id="jumlahModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeModalOnClick(event)">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full animate-modalPop overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 px-6 py-4">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <h3 class="text-white font-bold text-xl" id="modalTitle">Masukkan Jumlah</h3>
                    </div>
                    <button onclick="closeModal()" class="text-white/80 hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <div class="p-6">
                <div class="text-center mb-4">
                    <p class="text-gray-600">Barang: <span id="barangNama" class="font-semibold text-gray-800"></span></p>
                    <p class="text-sm text-gray-500 mt-1">Stok tersedia: <span id="stokTersedia" class="font-semibold text-green-600"></span></p>
                </div>

                <form id="addToCartForm" method="POST" action="">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                        <div class="flex items-center space-x-3">
                            <button type="button" onclick="decrementJumlah()" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 transition flex items-center justify-center text-xl font-bold text-gray-600">-</button>
                            <input type="number" name="jumlah" id="jumlahInput" value="1" min="1"
                                class="flex-1 text-center text-xl font-bold py-2 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all"
                                oninput="validateJumlah(this)">
                            <button type="button" onclick="incrementJumlah()" class="w-10 h-10 rounded-xl bg-gray-100 hover:bg-gray-200 transition flex items-center justify-center text-xl font-bold text-gray-600">+</button>
                        </div>
                        <p id="jumlahError" class="text-red-500 text-xs mt-2 hidden"></p>
                    </div>

                    <div class="flex space-x-3">
                        <button type="button" onclick="closeModal()" class="flex-1 px-4 py-2 border-2 border-gray-300 rounded-xl text-gray-700 font-semibold hover:bg-gray-50 transition">Batal</button>
                        <button type="submit" class="flex-1 btn-gradient text-white px-4 py-2 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">Tambah ke Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let currentBarangId = null;
        let currentStok = 0;

        // Search & Filter
        const searchInput = document.getElementById('searchBarang');
        const filterKategori = document.getElementById('filterKategori');
        const barangCards = document.querySelectorAll('.barang-card');

        function filterBarang() {
            const searchTerm = searchInput.value.toLowerCase();
            const kategoriTerm = filterKategori.value.toLowerCase();

            barangCards.forEach(card => {
                const nama = card.dataset.nama?.toLowerCase() || '';
                const kategori = card.dataset.kategori?.toLowerCase() || '';

                const matchSearch = searchTerm === '' || nama.includes(searchTerm);
                const matchKategori = kategoriTerm === '' || kategori === kategoriTerm;

                if (matchSearch && matchKategori) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        function resetFilters() {
            searchInput.value = '';
            filterKategori.value = '';
            filterBarang();
        }

        searchInput.addEventListener('keyup', filterBarang);
        filterKategori.addEventListener('change', filterBarang);

        // Modal Functions
        const modal = document.getElementById('jumlahModal');
        const jumlahInput = document.getElementById('jumlahInput');
        const jumlahError = document.getElementById('jumlahError');
        const stokTersediaSpan = document.getElementById('stokTersedia');
        const barangNamaSpan = document.getElementById('barangNama');
        const addToCartForm = document.getElementById('addToCartForm');

        function openModal(barangId, barangNama, stok) {
            currentBarangId = barangId;
            currentStok = stok;
            barangNamaSpan.textContent = barangNama;
            stokTersediaSpan.textContent = stok;
            jumlahInput.value = 1;
            jumlahInput.max = stok;
            jumlahError.classList.add('hidden');
            jumlahInput.classList.remove('border-red-500');

            addToCartForm.action = `/mahasiswa/peminjaman/cart/add/${barangId}`;

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function closeModalOnClick(event) {
            if (event.target === modal) {
                closeModal();
            }
        }

        // Validasi jumlah - hanya angka, tidak boleh kosong, tidak melebihi stok
        function validateJumlah(input) {
            let value = input.value;

            // Hapus semua karakter non-digit
            value = value.replace(/[^0-9]/g, '');

            // Jika kosong, set ke 1
            if (value === '' || value === '0') {
                value = '1';
            }

            let numValue = parseInt(value);

            // Cek tidak melebihi stok
            if (numValue > currentStok) {
                jumlahError.textContent = `Jumlah tidak boleh melebihi stok (${currentStok})`;
                jumlahError.classList.remove('hidden');
                input.classList.add('border-red-500');
                numValue = currentStok;
            } else {
                jumlahError.classList.add('hidden');
                input.classList.remove('border-red-500');
            }

            input.value = numValue;
        }

        function incrementJumlah() {
            let currentVal = parseInt(jumlahInput.value) || 1;
            if (currentVal < currentStok) {
                jumlahInput.value = currentVal + 1;
                jumlahError.classList.add('hidden');
                jumlahInput.classList.remove('border-red-500');
            } else {
                jumlahError.textContent = `Jumlah tidak boleh melebihi stok (${currentStok})`;
                jumlahError.classList.remove('hidden');
                jumlahInput.classList.add('border-red-500');
            }
        }

        function decrementJumlah() {
            let currentVal = parseInt(jumlahInput.value) || 1;
            if (currentVal > 1) {
                jumlahInput.value = currentVal - 1;
                jumlahError.classList.add('hidden');
                jumlahInput.classList.remove('border-red-500');
            }
        }

        // Event listener untuk input manual
        jumlahInput.addEventListener('input', function() {
            validateJumlah(this);
        });
    </script>

    <style>
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .btn-gradient:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
    </style>
</body>
</html>
