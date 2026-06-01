<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_detailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'detail_peminjaman';
    protected $primaryKey = 'id';

    protected $fillable = [
        'peminjaman_id',
        'barang_id',
        'jumlah',
        'subtotal_denda',
        'kondisi_pinjam',
        'kondisi_kembali'
    ];

    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(M_peminjaman::class, 'peminjaman_id');
    }

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(M_barang::class, 'barang_id');
    }
}
