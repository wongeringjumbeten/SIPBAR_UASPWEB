<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_kategoriBarang;
use App\Models\M_barang;

class C_kategori extends Controller
{
    // Menampilkan daftar kategori (hanya yang aktif)
    public function index()
    {
        $kategoris = M_kategoriBarang::active()->withCount('barang')->get();
        $totalKategori = M_kategoriBarang::active()->count();
        $totalBarang = M_barang::where('is_delete', false)->count();
        $kategoriAktif = M_kategoriBarang::active()->has('barang')->count();

        return view('V_kelolakategoriadmin', compact('kategoris', 'totalKategori', 'totalBarang', 'kategoriAktif'));
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_barang,nama_kategori',
            'deskripsi' => 'nullable|string'
        ]);

        M_kategoriBarang::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
            'is_delete' => false
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Mengupdate kategori
    public function update(Request $request, $id)
    {
        $kategori = M_kategoriBarang::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori_barang,nama_kategori,' . $id,
            'deskripsi' => 'nullable|string'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    // Soft delete kategori
    public function destroy($id)
    {
        $kategori = M_kategoriBarang::findOrFail($id);

        // Set barang dengan kategori ini menjadi null (kategorinya hilang)
        M_barang::where('kategori_id', $id)->update(['kategori_id' => null]);

        // Soft delete
        $kategori->softDelete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    // Restore kategori yang dihapus (opsional, untuk admin)
    public function restore($id)
    {
        $kategori = M_kategoriBarang::where('id', $id)->where('is_delete', true)->firstOrFail();
        $kategori->restore();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dipulihkan!');
    }

    // Lihat semua kategori termasuk yang dihapus (opsional)
    public function all()
    {
        $kategoris = M_kategoriBarang::withTrashed()->withCount('barang')->get();
        return view('V_kelolakategoriadmin_all', compact('kategoris'));
    }
}
