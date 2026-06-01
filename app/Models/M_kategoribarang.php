<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_kategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barang';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'is_delete'
    ];

    protected $casts = [
        'is_delete' => 'boolean',
    ];

    // Relasi ke barang
    public function barang()
    {
        return $this->hasMany(M_barang::class, 'kategori_id');
    }

    // Scope untuk kategori aktif (belum dihapus)
    public function scopeActive($query)
    {
        return $query->where('is_delete', false);
    }

    // Scope untuk kategori yang dihapus
    public function scopeDeleted($query)
    {
        return $query->where('is_delete', true);
    }

    // Method untuk "menghapus" kategori
    public function softDelete()
    {
        $this->is_delete = true;
        $this->save();
    }

    // Method untuk "mengembalikan" kategori
    public function restore()
    {
        $this->is_delete = false;
        $this->save();
    }
}
