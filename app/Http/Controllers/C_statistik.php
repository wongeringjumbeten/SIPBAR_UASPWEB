<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_akun;
use App\Models\M_barang;
use App\Models\M_peminjaman;
use App\Models\M_pengembalian;
use App\Models\M_detailPeminjaman;
use Illuminate\Support\Facades\DB;

class C_statistik extends Controller
{
    public function index()
    {
        // 1. Statistik User
        $totalAdmin = M_akun::where('role', 'admin')->where('status_approval', 'approved')->count();
        $totalPetugas = M_akun::where('role', 'petugas')->where('status_approval', 'approved')->count();
        $totalMahasiswa = M_akun::where('role', 'mahasiswa')->where('status_approval', 'approved')->count();
        $totalUsers = $totalAdmin + $totalPetugas + $totalMahasiswa;

        // 2. Statistik Barang
        $totalBarang = M_barang::where('is_delete', false)->count();
        $totalStok = M_barang::where('is_delete', false)->sum('stok');
        $totalStokTersedia = M_barang::where('is_delete', false)->sum('stok_tersedia');

        // 3. Statistik Peminjaman
        $totalPeminjaman = M_peminjaman::count();
        $peminjamanPending = M_peminjaman::where('status', 'pending')->count();
        $peminjamanDisetujui = M_peminjaman::where('status', 'disetujui')->count();
        $peminjamanDipinjam = M_peminjaman::where('status', 'dipinjam')->count();
        $peminjamanSelesai = M_peminjaman::where('status', 'selesai')->count();
        $peminjamanDitolak = M_peminjaman::where('status', 'ditolak')->count();
        $peminjamanTerlambat = M_peminjaman::where('status', 'terlambat')->count();

        // 4. Statistik Denda
        $totalDenda = M_pengembalian::sum('total_denda');
        $dendaBelumLunas = M_pengembalian::where('status_denda', 'belum')->sum('total_denda');
        $dendaLunas = M_pengembalian::where('status_denda', 'lunas')->sum('total_denda');

        // 5. Statistik per Bulan (6 bulan terakhir)
        $bulanLabels = [];
        $bulanData = [];
        for ($i = 5; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $bulanLabels[] = $bulan->translatedFormat('M Y');
            $jumlah = M_peminjaman::whereYear('created_at', $bulan->year)
                ->whereMonth('created_at', $bulan->month)
                ->count();
            $bulanData[] = $jumlah;
        }

        // 6. Statistik per Tahun
        $tahunLabels = [];
        $tahunData = [];
        $tahunMulai = 2024;
        $tahunSekarang = now()->year;
        for ($i = $tahunMulai; $i <= $tahunSekarang; $i++) {
            $tahunLabels[] = $i;
            $jumlah = M_peminjaman::whereYear('created_at', $i)->count();
            $tahunData[] = $jumlah;
        }

        // 7. Top 5 Barang Terpopuler
        $topBarang = DB::table('barang')
            ->select('barang.nama_barang', DB::raw('COUNT(detail_peminjaman.id) as total_dipinjam'))
            ->leftJoin('detail_peminjaman', 'barang.id', '=', 'detail_peminjaman.barang_id')
            ->where('barang.is_delete', false)
            ->groupBy('barang.id', 'barang.nama_barang')
            ->orderBy('total_dipinjam', 'desc')
            ->limit(5)
            ->get();

        // 8. Top 5 Peminjam Teraktif
        $topPeminjam = M_peminjaman::select('user_id', DB::raw('COUNT(*) as total'))
            ->with('mahasiswa')
            ->groupBy('user_id')
            ->orderBy('total', 'desc')
            ->limit(5)
            ->get();

        // 9. Statistik Kondisi Barang Kembali
        $kondisiBaik = M_detailPeminjaman::where('kondisi_kembali', 'baik')->count();
        $kondisiRusakRingan = M_detailPeminjaman::where('kondisi_kembali', 'rusak_ringan')->count();
        $kondisiRusakBerat = M_detailPeminjaman::where('kondisi_kembali', 'rusak_berat')->count();
        $kondisiHilang = M_detailPeminjaman::where('kondisi_kembali', 'hilang')->count();

        return view('V_statistikadmin', compact(
            'totalAdmin', 'totalPetugas', 'totalMahasiswa', 'totalUsers',
            'totalBarang', 'totalStok', 'totalStokTersedia',
            'totalPeminjaman', 'peminjamanPending', 'peminjamanDisetujui',
            'peminjamanDipinjam', 'peminjamanSelesai', 'peminjamanDitolak', 'peminjamanTerlambat',
            'totalDenda', 'dendaBelumLunas', 'dendaLunas',
            'bulanLabels', 'bulanData', 'tahunLabels', 'tahunData',
            'topBarang', 'topPeminjam',
            'kondisiBaik', 'kondisiRusakRingan', 'kondisiRusakBerat', 'kondisiHilang'
        ));
    }
}
