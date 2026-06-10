<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_barang;
use App\Models\M_kategoriBarang;
use App\Models\M_peminjaman;
use App\Models\M_detailPeminjaman;

class C_peminjaman extends Controller
{
    // Halaman daftar barang untuk dipinjam
    public function barang()
    {
        $barangs = M_barang::where('is_delete', false)->where('stok_tersedia', '>', 0)->with('kategori')->get();
        $kategoris = M_kategoriBarang::all();

        return view('V_peminjaman_barang', compact('barangs', 'kategoris'));
    }

    // Halaman form peminjaman (ambil dari session)
    public function form()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('mahasiswa.peminjaman.cart')
                ->with('notification_type', 'warning')
                ->with('notification_title', 'Keranjang Kosong')
                ->with('notification_message', 'Silakan pilih barang terlebih dahulu.');
        }

        $totalDendaPerHari = 0;
        foreach ($cart as $item) {
            $totalDendaPerHari += $item['denda_per_hari'] * $item['jumlah'];
        }

        return view('V_peminjaman_form', compact('cart', 'totalDendaPerHari'));
    }

    // Proses simpan peminjaman
    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('mahasiswa.peminjaman.barang')
                ->with('notification_type', 'error')
                ->with('notification_message', 'Keranjang kosong. Silakan pilih barang terlebih dahulu.');
        }

        $request->validate([
            'tgl_pinjam' => 'required|date|after_or_equal:today',
            'tgl_kembali_rencana' => 'required|date|after:tgl_pinjam',
            'keterangan' => 'nullable|string'
        ]);

        $tglPinjam = new \DateTime($request->tgl_pinjam);
        $tglKembali = new \DateTime($request->tgl_kembali_rencana);
        $diff = $tglPinjam->diff($tglKembali)->days;

        if ($diff > 7) {
            return back()->withErrors(['tgl_kembali_rencana' => 'Maksimal durasi peminjaman adalah 7 hari'])->withInput();
        }

        $lastPinjam = M_peminjaman::latest()->first();
        $number = $lastPinjam ? intval(substr($lastPinjam->kode_peminjaman, -4)) + 1 : 1;
        $kodePeminjaman = 'PJM/' . date('Y/m/') . str_pad($number, 4, '0', STR_PAD_LEFT);

        $peminjaman = M_peminjaman::create([
            'kode_peminjaman' => $kodePeminjaman,
            'user_id' => auth()->id(),
            'petugas_id' => null,
            'status' => 'pending',
            'tgl_pengajuan' => now(),
            'tgl_pinjam' => $request->tgl_pinjam,
            'tgl_kembali_rencana' => $request->tgl_kembali_rencana,
            'tgl_kembali_aktual' => null,
            'total_denda' => 0,
            'keterangan' => $request->keterangan,
            'alasan_penolakan' => null
        ]);

        foreach ($cart as $item) {
            M_detailPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'barang_id' => $item['barang_id'],
                'jumlah' => $item['jumlah'],
                'subtotal_denda' => 0,
                'kondisi_pinjam' => 'baik',
                'kondisi_kembali' => null
            ]);

            $barang = M_barang::find($item['barang_id']);
            if ($barang) {
                $barang->stok_tersedia -= $item['jumlah'];
                $barang->save();
            }
        }

        session()->forget('cart');

        return redirect()->route('mahasiswa.riwayat')
            ->with('notification_type', 'success')
            ->with('notification_title', 'Pengajuan Berhasil! 🎉')
            ->with('notification_message', 'Peminjaman dengan kode ' . $kodePeminjaman . ' telah diajukan. Petugas akan segera memproses.');
    }

    // Halaman riwayat peminjaman
    public function riwayat()
    {
        $peminjaman = M_peminjaman::where('user_id', auth()->id())->orderBy('created_at', 'desc')->get();
        return view('V_peminjaman_riwayat', compact('peminjaman'));
    }

    // Detail riwayat peminjaman
    public function detail($id)
    {
        $peminjaman = M_peminjaman::with('detailPeminjaman.barang')->where('user_id', auth()->id())->findOrFail($id);
        return view('V_peminjaman_detail', compact('peminjaman'));
    }

    // Tambah ke keranjang
    public function addToCart(Request $request, $barangId)
    {
        $barang = M_barang::findOrFail($barangId);
        $jumlah = $request->input('jumlah', 1);

        if ($barang->stok_tersedia < $jumlah) {
            return redirect()->route('mahasiswa.peminjaman.barang')
                ->with('notification_type', 'error')
                ->with('notification_message', 'Stok tidak mencukupi! Stok tersedia: ' . $barang->stok_tersedia);
        }

        $cart = session()->get('cart', []);
        $found = false;

        foreach ($cart as $key => $item) {
            if ($item['barang_id'] == $barangId) {
                $cart[$key]['jumlah'] += $jumlah;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'barang_id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'jumlah' => $jumlah,
                'denda_per_hari' => $barang->denda_per_hari,
                'stok_tersedia' => $barang->stok_tersedia
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('mahasiswa.peminjaman.cart')
            ->with('notification_type', 'success')
            ->with('notification_title', 'Berhasil!')
            ->with('notification_message', $barang->nama_barang . ' berhasil ditambahkan ke keranjang.');
    }

    // Lihat keranjang
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        $totalDendaPerHari = 0;

        foreach ($cart as $item) {
            $totalDendaPerHari += $item['denda_per_hari'] * $item['jumlah'];
        }

        return view('V_peminjaman_cart', compact('cart', 'totalDendaPerHari'));
    }

    // Hapus dari keranjang
    public function removeFromCart($index)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$index])) {
            $namaBarang = $cart[$index]['nama_barang'];
            unset($cart[$index]);
            session()->put('cart', array_values($cart));

            return redirect()->route('mahasiswa.peminjaman.cart')
                ->with('notification_type', 'success')
                ->with('notification_title', 'Dihapus!')
                ->with('notification_message', $namaBarang . ' berhasil dihapus dari keranjang.');
        }

        return redirect()->route('mahasiswa.peminjaman.cart')
            ->with('notification_type', 'error')
            ->with('notification_message', 'Barang tidak ditemukan di keranjang.');
    }

    public function adminRiwayat()
    {
        $peminjaman = M_peminjaman::with(['mahasiswa', 'petugas'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('V_peminjaman_admin', compact('peminjaman'));
    }

    // Detail peminjaman untuk admin (API modal)
    public function adminDetail($id)
    {
        $peminjaman = M_peminjaman::with(['mahasiswa', 'petugas', 'detailPeminjaman.barang'])
            ->findOrFail($id);

        $html = view('components.V_detail_peminjaman_admin', compact('peminjaman'))->render();

        return response()->json(['success' => true, 'html' => $html]);
    }
}
