<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_peminjaman',
        'user_id',
        'petugas_id',
        'status',
        'tgl_pengajuan',
        'tgl_pinjam',
        'tgl_kembali_rencana',
        'tgl_kembali_aktual',
        'total_denda',
        'keterangan',
        'alasan_penolakan'
    ];

    // Relasi ke user (mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(M_akun::class, 'user_id');
    }

    // Relasi ke petugas
    public function petugas()
    {
        return $this->belongsTo(M_akun::class, 'petugas_id');
    }

    // Relasi ke detail peminjaman
    public function detailPeminjaman()
    {
        return $this->hasMany(M_detailPeminjaman::class, 'peminjaman_id');
    }

    // Relasi ke pengembalian
    public function pengembalian()
    {
        return $this->hasOne(M_pengembalian::class, 'peminjaman_id');
    }

    // Generate kode peminjaman otomatis
    public static function generateKode()
    {
        $last = self::latest()->first();
        $number = $last ? intval(substr($last->kode_peminjaman, -4)) + 1 : 1;
        return 'PJM/' . date('Y/m/') . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
