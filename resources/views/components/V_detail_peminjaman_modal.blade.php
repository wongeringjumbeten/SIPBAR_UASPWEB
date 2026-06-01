<div class="space-y-4">
    <!-- Informasi Mahasiswa -->
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="flex items-center space-x-2 mb-3">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <h4 class="font-semibold text-gray-800">Informasi Peminjam</h4>
        </div>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
                <p class="text-gray-400 text-xs">Nama</p>
                <p class="font-semibold">{{ $peminjaman->mahasiswa->name ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">NIM</p>
                <p class="font-semibold">{{ $peminjaman->mahasiswa->nim_nip ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Jurusan</p>
                <p class="font-semibold">{{ $peminjaman->mahasiswa->jurusan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">No. HP</p>
                <p class="font-semibold">{{ $peminjaman->mahasiswa->no_hp ?? '-' }}</p>
            </div>
        </div>
    </div>

    <!-- Informasi Peminjaman -->
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="flex items-center space-x-2 mb-3">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h4 class="font-semibold text-gray-800">Detail Peminjaman</h4>
        </div>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
                <p class="text-gray-400 text-xs">Kode Peminjaman</p>
                <p class="font-semibold font-mono">{{ $peminjaman->kode_peminjaman }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Tanggal Pengajuan</p>
                <p class="font-semibold">{{ \Carbon\Carbon::parse($peminjaman->tgl_pengajuan)->translatedFormat('d F Y, H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Tanggal Pinjam</p>
                <p class="font-semibold">{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->translatedFormat('d F Y') }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Rencana Kembali</p>
                <p class="font-semibold">{{ \Carbon\Carbon::parse($peminjaman->tgl_kembali_rencana)->translatedFormat('d F Y') }}</p>
            </div>
        </div>
        @if($peminjaman->keterangan)
        <div class="mt-3 pt-3 border-t border-gray-200">
            <p class="text-gray-400 text-xs">Keterangan</p>
            <p class="text-sm text-gray-700">{{ $peminjaman->keterangan }}</p>
        </div>
        @endif
    </div>

    <!-- Daftar Barang -->
    <div class="bg-gray-50 rounded-xl p-4">
        <div class="flex items-center space-x-2 mb-3">
            <svg class="w-5 h-5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <h4 class="font-semibold text-gray-800">Daftar Barang</h4>
        </div>
        <div class="space-y-2">
            @foreach($peminjaman->detailPeminjaman as $detail)
            <div class="flex justify-between items-center p-2 bg-white rounded-lg">
                <div>
                    <p class="font-medium text-gray-800">{{ $detail->barang->nama_barang }}</p>
                    <p class="text-xs text-gray-500">Kode: {{ $detail->barang->kode_barang }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-gray-800">{{ $detail->jumlah }} unit</p>
                    <p class="text-xs text-gray-500">Denda: Rp {{ number_format($detail->barang->denda_per_hari, 0, ',', '.') }}/hari</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
