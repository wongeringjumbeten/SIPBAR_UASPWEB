<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_peminjaman;
use App\Models\M_barang;
use App\Models\M_akun;
use App\Models\M_kategoriBarang;
use App\Models\M_pengembalian;
use Illuminate\Support\Facades\DB;

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
    // Statistik User
    $totalUsers = M_akun::count();
    $totalAdmin = M_akun::where('role', 'admin')->count();
    $totalPetugas = M_akun::where('role', 'petugas')->count();
    $totalMahasiswa = M_akun::where('role', 'mahasiswa')->count();

    // Statistik Barang
    $totalBarang = M_barang::where('is_delete', false)->count();

    // Statistik Peminjaman
    $peminjamanAktif = M_peminjaman::whereIn('status', ['disetujui', 'dipinjam'])->count();
    $totalDenda = M_pengembalian::sum('total_denda');

    // Tingkat Pengembalian
    $totalPeminjaman = M_peminjaman::count();
    $totalSelesai = M_peminjaman::where('status', 'selesai')->count();
    $tingkatPengembalian = $totalPeminjaman > 0 ? round(($totalSelesai / $totalPeminjaman) * 100) : 0;

    // Top Barang Paling Sering Dipinjam (Query Builder biasa)
    $topBarang = DB::table('barang')
        ->select('barang.*', DB::raw('COUNT(detail_peminjaman.id) as total_dipinjam'))
        ->leftJoin('detail_peminjaman', 'barang.id', '=', 'detail_peminjaman.barang_id')
        ->where('barang.is_delete', false)
        ->groupBy('barang.id')
        ->orderBy('total_dipinjam', 'desc')
        ->limit(5)
        ->get();

    // Peminjaman Terbaru
    $peminjamanTerbaru = M_peminjaman::with('mahasiswa')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();

    // Chart Data
    $chartLabels = [];
    $chartData = [];
    for ($i = 5; $i >= 0; $i--) {
        $bulan = now()->subMonths($i);
        $chartLabels[] = $bulan->translatedFormat('M Y');
        $jumlah = M_peminjaman::whereYear('created_at', $bulan->year)
            ->whereMonth('created_at', $bulan->month)
            ->count();
        $chartData[] = $jumlah;
    }
    

    return view('V_dashboardadmin', compact(
        'totalUsers', 'totalAdmin', 'totalPetugas', 'totalMahasiswa',
        'totalBarang', 'peminjamanAktif', 'totalDenda', 'tingkatPengembalian',
        'topBarang', 'peminjamanTerbaru', 'chartLabels', 'chartData'
    ));
}
}
