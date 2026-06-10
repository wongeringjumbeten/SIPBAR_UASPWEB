<div class="space-y-4 max-h-[70vh] overflow-y-auto pr-2" style="scrollbar-width: thin; scrollbar-color: #667eea #e2e8f0;">
    <style>
        .max-h-\[70vh\]::-webkit-scrollbar {
            width: 6px;
        }
        .max-h-\[70vh\]::-webkit-scrollbar-track {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .max-h-\[70vh\]::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 10px;
        }
        .max-h-\[70vh\]::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        }
    </style>

    <!-- Info Mahasiswa -->
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="flex items-center space-x-2 mb-3">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <h4 class="font-semibold text-gray-800">Informasi Peminjam</h4>
        </div>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><p class="text-gray-400 text-xs">Nama</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->name ?? '-' }}</p></div>
            <div><p class="text-gray-400 text-xs">NIM</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->nim_nip ?? '-' }}</p></div>
            <div><p class="text-gray-400 text-xs">Jurusan</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->jurusan ?? '-' }}</p></div>
            <div><p class="text-gray-400 text-xs">No. HP</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->no_hp ?? '-' }}</p></div>
        </div>
    </div>

    <!-- Info Pengembalian -->
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="flex items-center space-x-2 mb-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h4 class="font-semibold text-gray-800">Detail Pengembalian</h4>
        </div>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><p class="text-gray-400 text-xs">Kode Peminjaman</p><p class="font-semibold font-mono">{{ $pengembalian->peminjaman->kode_peminjaman }}</p></div>
            <div><p class="text-gray-400 text-xs">Tanggal Pengembalian</p><p class="font-semibold">{{ \Carbon\Carbon::parse($pengembalian->tanggal_pengembalian)->translatedFormat('d F Y H:i') }}</p></div>
            <div><p class="text-gray-400 text-xs">Total Denda</p><p class="font-semibold text-red-600">Rp {{ number_format($pengembalian->total_denda, 0, ',', '.') }}</p></div>
            <div><p class="text-gray-400 text-xs">Status Denda</p>
                <span class="px-2 py-0.5 text-xs rounded-full {{ $pengembalian->status_denda == 'lunas' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $pengembalian->status_denda == 'lunas' ? 'Lunas' : 'Belum Lunas' }}
                </span>
            </div>
            @if($pengembalian->tgl_bayar)
            <div><p class="text-gray-400 text-xs">Tanggal Bayar</p><p class="font-semibold">{{ \Carbon\Carbon::parse($pengembalian->tgl_bayar)->translatedFormat('d F Y') }}</p></div>
            @endif
            @if($pengembalian->catatan)
            <div class="col-span-2"><p class="text-gray-400 text-xs">Catatan</p><p class="text-sm">{{ $pengembalian->catatan }}</p></div>
            @endif
        </div>
    </div>

    <!-- Daftar Barang -->
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="flex items-center space-x-2 mb-3">
            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <h4 class="font-semibold text-gray-800">Daftar Barang</h4>
        </div>
        <div class="space-y-2 max-h-48 overflow-y-auto">
            @foreach($pengembalian->peminjaman->detailPeminjaman as $detail)
            <div class="bg-white rounded-lg p-3">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <p class="font-medium text-gray-800">{{ $detail->barang->nama_barang }}</p>
                        <p class="text-xs text-gray-500">Jumlah: {{ $detail->jumlah }} unit</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Kondisi Kembali</p>
                        <span class="text-sm font-semibold">
                            @if($detail->kondisi_kembali == 'baik')
                                <span class="text-green-600">Baik</span>
                            @elseif($detail->kondisi_kembali == 'rusak_ringan')
                                <span class="text-yellow-600">Rusak Ringan</span>
                            @elseif($detail->kondisi_kembali == 'rusak_berat')
                                <span class="text-orange-600">Rusak Berat</span>
                            @else
                                <span class="text-red-600">Hilang</span>
                            @endif
                        </span>
                    </div>
                </div>
                @if($detail->subtotal_denda > 0)
                <div class="mt-2 text-xs text-red-600">
                    Subtotal denda: Rp {{ number_format($detail->subtotal_denda, 0, ',', '.') }}
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
