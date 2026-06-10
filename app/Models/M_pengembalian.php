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
        'catatan',
        'status_denda',  // TAMBAHKAN: 'belum' / 'lunas'
        'tgl_bayar'      // TAMBAHKAN: tanggal pembayaran
    ];

    protected $casts = [
        'tgl_bayar' => 'date',
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

    // Scope untuk denda belum lunas
    public function scopeBelumLunas($query)
    {
        return $query->where('status_denda', 'belum');
    }

    // Scope untuk denda sudah lunas
    public function scopeLunas($query)
    {
        return $query->where('status_denda', 'lunas');
    }

    // Method untuk menandai lunas
    public function tandaiLunas()
    {
        $this->status_denda = 'lunas';
        $this->tgl_bayar = now();
        $this->save();
    }
}
