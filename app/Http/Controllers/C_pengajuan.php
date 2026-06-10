<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_peminjaman;
use App\Models\M_detailPeminjaman;
use App\Models\M_barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class C_pengajuan extends Controller
{
    // Menampilkan daftar pengajuan pending
    public function index()
    {
        $pengajuan = M_peminjaman::with('mahasiswa')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('V_daftar_pengajuan_petugas', compact('pengajuan'));
    }

    // Menyetujui pengajuan
    public function setujui($id)
    {
        $peminjaman = M_peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'disetujui',
            'petugas_id' => Auth::id()
        ]);

        // Kirim notifikasi ke mahasiswa (jika pakai notifikasi)
        // ...

        return redirect()->route('petugas.pengajuan.index')
            ->with('notification_type', 'success')
            ->with('notification_message', 'Pengajuan peminjaman ' . $peminjaman->kode_peminjaman . ' berhasil disetujui!');
    }

    // Menolak pengajuan dengan alasan
    public function tolak(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:10'
        ], [
            'alasan_penolakan.required' => 'Alasan penolakan wajib diisi',
            'alasan_penolakan.min' => 'Alasan penolakan minimal 10 karakter'
        ]);

        $peminjaman = M_peminjaman::findOrFail($id);

        // Kembalikan stok barang
        foreach ($peminjaman->detailPeminjaman as $detail) {
            $barang = M_barang::find($detail->barang_id);
            if ($barang) {
                $barang->stok_tersedia += $detail->jumlah;
                $barang->save();
            }
        }

        $peminjaman->update([
            'status' => 'ditolak',
            'petugas_id' => Auth::id(),
            'alasan_penolakan' => $request->alasan_penolakan
        ]);

        // Kirim notifikasi ke mahasiswa (jika pakai notifikasi)
        // ...

        return redirect()->route('petugas.pengajuan.index')
            ->with('notification_type', 'error')
            ->with('notification_message', 'Pengajuan peminjaman ' . $peminjaman->kode_peminjaman . ' ditolak.');
    }

    // Detail pengajuan (API untuk modal)
    public function detail($id)
    {
        $peminjaman = M_peminjaman::with(['mahasiswa', 'detailPeminjaman.barang'])->findOrFail($id);

        $html = view('components.V_detail_peminjaman_modal', compact('peminjaman'))->render();

        return response()->json(['success' => true, 'html' => $html]);
    }

    // Menampilkan daftar pengajuan yang sudah disetujui (menunggu pengambilan)
    public function disetujui()
    {
        $pengajuan = M_peminjaman::with('mahasiswa')
            ->where('status', 'disetujui')
            ->orderBy('updated_at', 'asc')
            ->get();

        return view('V_pengajuan_disetujui', compact('pengajuan'));
    }

    // Proses pengambilan barang (disetujui -> dipinjam)
    public function ambilBarang($id)
    {
        $peminjaman = M_peminjaman::findOrFail($id);

        $peminjaman->update([
            'status' => 'dipinjam',
            'tgl_pinjam' => now()->format('Y-m-d')
        ]);

        return redirect()->route('petugas.pengajuan.disetujui')
            ->with('notification_type', 'success')
            ->with('notification_message', 'Barang telah diambil oleh mahasiswa.');
    }

    // Menampilkan daftar peminjaman yang sedang dipinjam
    public function monitoring()
    {
        $pengajuan = M_peminjaman::with('mahasiswa')
            ->where('status', 'dipinjam')
            ->orderBy('tgl_kembali_rencana', 'asc')
            ->get();

        return view('V_monitoring_pinjaman', compact('pengajuan'));
    }

    
}
