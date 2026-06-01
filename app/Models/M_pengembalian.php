<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $primaryKey = 'id';

    protected $fillable = [
        'peminjaman_id',
        'petugas_id',
        'tanggal_pengembalian',
        'total_denda',
        'catatan'
    ];

    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(M_peminjaman::class, 'peminjaman_id');
    }

    // Relasi ke petugas
    public function petugas()
    {
        return $this->belongsTo(M_akun::class, 'petugas_id');
    }
}
