<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_peminjaman;
use App\Models\M_pengembalian;
use App\Models\M_barang;
use Illuminate\Support\Facades\Auth;

class C_pengembalian extends Controller
{
    // Form pengembalian
    public function form($id)
    {
        $peminjaman = M_peminjaman::with(['mahasiswa', 'detailPeminjaman.barang'])->findOrFail($id);

        // Cek keterlambatan
        $tglKembaliRencana = \Carbon\Carbon::parse($peminjaman->tgl_kembali_rencana);
        $isTerlambat = $tglKembaliRencana->isPast();
        $hariTerlambat = $isTerlambat ? now()->diffInDays($tglKembaliRencana) : 0;

        return view('V_pengembalian_form', compact('peminjaman', 'isTerlambat', 'hariTerlambat'));
    }

    // Menampilkan daftar semua pengembalian
    public function index()
    {
        $pengembalian = M_pengembalian::with(['peminjaman.mahasiswa'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('V_pengembalian', compact('pengembalian'));
    }

    // Detail pengembalian
    public function detailPengembalian($id)
    {
        $pengembalian = M_pengembalian::with(['peminjaman.mahasiswa', 'peminjaman.detailPeminjaman.barang'])->findOrFail($id);

        $html = view('components.V_detail_pengembalian_modal', compact('pengembalian'))->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    // Tandai lunas
    public function tandaiLunas($id)
    {
        $pengembalian = M_pengembalian::findOrFail($id);
        $pengembalian->tandaiLunas();

        return redirect()->route('petugas.pengembalian.index')
            ->with('notification_type', 'success')
            ->with('notification_message', 'Denda telah ditandai lunas.');
    }

    // Proses pengembalian
    public function proses(Request $request, $id)
    {
        $peminjaman = M_peminjaman::with('detailPeminjaman.barang')->findOrFail($id);

        $request->validate([
            'kondisi' => 'required|array',
            'catatan' => 'nullable|string'
        ]);

        $totalDenda = 0;
        $tglKembaliRencana = \Carbon\Carbon::parse($peminjaman->tgl_kembali_rencana);
        $hariTerlambat = $tglKembaliRencana->isPast() ? now()->diffInDays($tglKembaliRencana) : 0;

        foreach ($peminjaman->detailPeminjaman as $detail) {
            // Ambil kondisi dari request, default 'baik' jika tidak ada
            $kondisi = $request->kondisi[$detail->id] ?? 'baik';
            $jumlah = $detail->jumlah;
            $dendaPerHari = $detail->barang->denda_per_hari;
            $hargaBarang = $detail->barang->harga_perolehan ?? 0;

            // Ambil jumlah rusak (jika ada)
            $jumlahRusak = $request->jumlah_rusak[$detail->id] ?? 0;
            if ($kondisi == 'baik') {
                $jumlahRusak = 0;
            }

            // Validasi jumlah rusak tidak melebihi jumlah dipinjam
            if ($jumlahRusak > $jumlah) {
                $jumlahRusak = $jumlah;
            }

            $subtotal = 0;

            // Denda keterlambatan (untuk SEMUA unit)
            $subtotal += $hariTerlambat * $dendaPerHari * $jumlah;

            // Denda kerusakan/hilang (hanya untuk jumlah yang rusak/hilang)
            if ($kondisi == 'rusak_ringan') {
                $subtotal += ($hargaBarang * 0.25) * $jumlahRusak;
            } elseif ($kondisi == 'rusak_berat') {
                $subtotal += ($hargaBarang * 0.5) * $jumlahRusak;
            } elseif ($kondisi == 'hilang') {
                $subtotal += $hargaBarang * $jumlahRusak;
            }

            $totalDenda += $subtotal;

            // Update detail peminjaman
            $detail->update([
                'kondisi_kembali' => $kondisi,
                'subtotal_denda' => $subtotal
            ]);

            // Kembalikan stok barang
            $barang = M_barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok_tersedia += $jumlah;
                $barang->save();
            }
        }

        // Simpan ke tabel pengembalian
        M_pengembalian::create([
            'peminjaman_id' => $peminjaman->id,
            'petugas_id' => Auth::id(),
            'tanggal_pengembalian' => now(),
            'total_denda' => $totalDenda,
            'catatan' => $request->catatan,
            'status_denda' => 'belum',
            'tgl_bayar' => null
        ]);

        // Update peminjaman
        $status = $hariTerlambat > 0 ? 'terlambat' : 'selesai';
        $peminjaman->update([
            'status' => $status,
            'tgl_kembali_aktual' => now(),
            'total_denda' => $totalDenda
        ]);

        return redirect()->route('petugas.pengajuan.monitoring')
            ->with('notification_type', 'success')
            ->with('notification_message', 'Pengembalian berhasil! Total denda: Rp ' . number_format($totalDenda, 0, ',', '.'));
    }
}
