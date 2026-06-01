<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_peminjaman;
use App\Models\M_barang;
use App\Models\M_akun;
use App\Models\M_kategoriBarang;

class C_dashboard extends Controller
{
    // Dashboard Mahasiswa
    public function mahasiswa()
    {
        $userId = auth()->id();

        $totalPeminjaman = M_peminjaman::where('user_id', $userId)->count();
        $sedangDipinjam = M_peminjaman::where('user_id', $userId)
            ->whereIn('status', ['disetujui', 'dipinjam'])
            ->count();
        $totalDenda = M_peminjaman::where('user_id', $userId)->sum('total_denda');
        $peminjamanTerbaru = M_peminjaman::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('V_dashboardmahasiswa', compact('totalPeminjaman', 'sedangDipinjam', 'totalDenda', 'peminjamanTerbaru'));
    }

    // Dashboard Petugas
    public function petugas()
    {
        $pendingCount = M_peminjaman::where('status', 'pending')->count();
        $disetujuiCount = M_peminjaman::where('status', 'disetujui')->count();
        $dipinjamCount = M_peminjaman::where('status', 'dipinjam')->count();
        $terlambatCount = M_peminjaman::where('status', 'terlambat')->count();
        $totalPeminjaman = M_peminjaman::count();

        $pengajuanTerbaru = M_peminjaman::with(['mahasiswa', 'detailPeminjaman.barang'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('V_dashboardpetugas', compact(
            'pendingCount', 'disetujuiCount', 'dipinjamCount', 'terlambatCount', 'totalPeminjaman', 'pengajuanTerbaru'
        ));
    }
    // Dashboard Admin
    public function admin()
    {
        $totalUsers = M_akun::count();
        $totalAdmin = M_akun::where('role', 'admin')->count();
        $totalPetugas = M_akun::where('role', 'petugas')->count();
        $totalMahasiswa = M_akun::where('role', 'mahasiswa')->count();

        $totalBarang = M_barang::where('is_delete', false)->count();
        $barangTersedia = M_barang::where('is_delete', false)->sum('stok_tersedia');
        $totalKategori = M_kategoriBarang::count();

        $peminjamanAktif = M_peminjaman::whereIn('status', ['disetujui', 'dipinjam'])->count();
        $totalDenda = M_peminjaman::sum('total_denda');
        $pendingCount = M_peminjaman::where('status', 'pending')->count();

        $peminjamanTerbaru = M_peminjaman::with('mahasiswa')->orderBy('created_at', 'desc')->limit(5)->get();

        return view('V_dashboardadmin', compact(
            'totalUsers', 'totalAdmin', 'totalPetugas', 'totalMahasiswa',
            'totalBarang', 'barangTersedia', 'totalKategori',
            'peminjamanAktif', 'totalDenda', 'pendingCount', 'peminjamanTerbaru'
        ));
    }
}
