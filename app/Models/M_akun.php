<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class M_akun extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nim_nip',
        'no_hp',
        'jurusan',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi: seorang mahasiswa bisa punya banyak peminjaman
    public function peminjaman()
    {
        return $this->hasMany(M_peminjaman::class, 'user_id');
    }

    // Relasi: petugas yang memproses peminjaman
    public function peminjamanDiproses()
    {
        return $this->hasMany(M_peminjaman::class, 'petugas_id');
    }

    // Cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPetugas()
    {
        return $this->role === 'petugas';
    }

    public function isMahasiswa()
    {
        return $this->role === 'mahasiswa';
    }
}
