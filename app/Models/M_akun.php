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
        'is_active',
        'status_approval',
        'remember_token'  

    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'status_approval' => 'string',
    ];

    // Scope untuk user yang sudah disetujui
    public function scopeApproved($query)
    {
        return $query->where('status_approval', 'approved');
    }

    // Scope untuk user yang menunggu persetujuan
    public function scopePendingApproval($query)
    {
        return $query->where('status_approval', 'pending');
    }

    // Scope untuk user yang aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Relasi
    public function peminjaman()
    {
        return $this->hasMany(M_peminjaman::class, 'user_id');
    }

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
