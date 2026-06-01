<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_barang;
use App\Models\M_kategoriBarang;

class C_barang extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        $barangs = M_barang::where('is_delete', false)->with('kategori')->get();
        $kategoris = M_kategoriBarang::all();

        $totalBarang = M_barang::where('is_delete', false)->count();
        $barangTersedia = M_barang::where('is_delete', false)->sum('stok_tersedia');
        $barangDipinjam = M_barang::where('is_delete', false)->sum('stok') - M_barang::where('is_delete', false)->sum('stok_tersedia');
        $totalKategori = M_kategoriBarang::count();

        return view('V_kelolabarangadmin', compact('barangs', 'kategoris', 'totalBarang', 'barangTersedia', 'barangDipinjam', 'totalKategori'));
    }

    // Menampilkan form tambah barang
    public function create()
    {
        $kategoris = M_kategoriBarang::all();
        return view('V_barang_create', compact('kategoris'));
    }

    // Menyimpan barang baru
    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori_barang,id',
            'kode_barang' => 'required|unique:barang,kode_barang',
            'nama_barang' => 'required|string|max:200',
            'stok' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi' => 'nullable|string|max:100',
            'denda_per_hari' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/barang'), $namaFoto);
            $fotoPath = 'uploads/barang/' . $namaFoto;
        }

        M_barang::create([
            'kategori_id' => $request->kategori_id,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'stok_tersedia' => $request->stok_tersedia,
            'kondisi' => $request->kondisi,
            'lokasi' => $request->lokasi,
            'denda_per_hari' => $request->denda_per_hari,
            'deskripsi' => $request->deskripsi,
            'foto' => $fotoPath,
            'is_delete' => false
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    // Menampilkan detail barang
    public function show($id)
    {
        $barang = M_barang::with(['kategori', 'detailPeminjaman.peminjaman'])->findOrFail($id);
        return view('V_barang_detail', compact('barang'));
    }

    // Menampilkan form edit barang
    public function edit($id)
    {
        $barang = M_barang::findOrFail($id);
        $kategoris = M_kategoriBarang::all();
        return view('V_barang_edit', compact('barang', 'kategoris'));
    }

    // Mengupdate barang
    public function update(Request $request, $id)
    {
        $barang = M_barang::findOrFail($id);

        $request->validate([
            'kategori_id' => 'required|exists:kategori_barang,id',
            'kode_barang' => 'required|unique:barang,kode_barang,' . $id,
            'nama_barang' => 'required|string|max:200',
            'stok' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi' => 'nullable|string|max:100',
            'denda_per_hari' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($barang->foto && file_exists(public_path($barang->foto))) {
                unlink(public_path($barang->foto));
            }

            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads/barang'), $namaFoto);
            $data['foto'] = 'uploads/barang/' . $namaFoto;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate!');
    }

    // Menghapus barang (soft delete)
    public function destroy($id)
    {
        $barang = M_barang::findOrFail($id);
        $barang->update(['is_delete' => true]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
