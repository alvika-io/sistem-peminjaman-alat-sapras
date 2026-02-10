<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $fillable = [
        'nama',
        'gambar',
        'kategori_id',
        'stok_total',
        'stok_tersedia'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjamans()
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_alat')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}
