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
            $kondisi = $request->kondisi[$detail->id];
            $jumlah = $detail->jumlah;
            $dendaPerHari = $detail->barang->denda_per_hari;
            $hargaBarang = $detail->barang->harga_perolehan ?? 0;

            $subtotal = 0;

            // Denda keterlambatan
            $subtotal += $hariTerlambat * $dendaPerHari * $jumlah;

            // Denda kerusakan
            if ($kondisi == 'rusak_ringan') {
                $subtotal += ($hargaBarang * 0.25) * $jumlah;
            } elseif ($kondisi == 'rusak_berat') {
                $subtotal += ($hargaBarang * 0.5) * $jumlah;
            } elseif ($kondisi == 'hilang') {
                $subtotal += $hargaBarang * $jumlah;
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
            'catatan' => $request->catatan
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
