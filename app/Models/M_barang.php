<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kategori_id',
        'kode_barang',
        'nama_barang',
        'stok',
        'stok_tersedia',
        'kondisi',
        'lokasi',
        'denda_per_hari',
        'foto',
        'deskripsi',
        'is_delete',
        'harga_perolehan',
    ];

    protected $casts = [
        'is_delete' => 'boolean',
    ];

    // Relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(M_kategoriBarang::class, 'kategori_id');
    }

    // Relasi ke detail peminjaman (TAMBAHKAN INI)
    public function detailPeminjaman()
    {
        return $this->hasMany(M_detailPeminjaman::class, 'barang_id');
    }

    // Scope untuk barang aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->where('is_delete', false);
    }

    // Update stok tersedia
    public function kurangiStok($jumlah)
    {
        $this->stok_tersedia -= $jumlah;
        $this->save();
    }

    public function tambahStok($jumlah)
    {
        $this->stok_tersedia += $jumlah;
        $this->save();
    }
}
