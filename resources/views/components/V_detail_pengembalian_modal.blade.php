<div class="space-y-4">
    <!-- Info Mahasiswa -->
    <div class="bg-gray-50 rounded-xl p-4">
        <h4 class="font-semibold text-gray-800 mb-2">Informasi Peminjam</h4>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><p class="text-gray-400 text-xs">Nama</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->name ?? '-' }}</p></div>
            <div><p class="text-gray-400 text-xs">NIM</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->nim_nip ?? '-' }}</p></div>
            <div><p class="text-gray-400 text-xs">Jurusan</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->jurusan ?? '-' }}</p></div>
            <div><p class="text-gray-400 text-xs">No. HP</p><p class="font-semibold">{{ $pengembalian->peminjaman->mahasiswa->no_hp ?? '-' }}</p></div>
        </div>
    </div>

    <!-- Info Pengembalian -->
    <div class="bg-gray-50 rounded-xl p-4">
        <h4 class="font-semibold text-gray-800 mb-2">Detail Pengembalian</h4>
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
        <h4 class="font-semibold text-gray-800 mb-2">Daftar Barang</h4>
        <div class="space-y-2">
            @foreach($pengembalian->peminjaman->detailPeminjaman as $detail)
            <div class="bg-white rounded-lg p-3">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{ $detail->barang->nama_barang }}</p>
                        <p class="text-xs text-gray-500">Jumlah: {{ $detail->jumlah }} unit</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500">Kondisi Kembali</p>
                        <span class="text-sm font-semibold">
                            {{ $detail->kondisi_kembali == 'baik' ? 'Baik' :
                            ($detail->kondisi_kembali == 'rusak_ringan' ? 'Rusak Ringan' :
                            ($detail->kondisi_kembali == 'rusak_berat' ? 'Rusak Berat' : 'Hilang')) }}
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
