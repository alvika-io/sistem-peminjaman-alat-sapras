<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengembalian extends Model
{
    use HasFactory;

protected $fillable = [
    'peminjaman_id',
    'tanggal_kembali_real',
    'kondisi',
    'denda',
    'denda_status',
    'status',
];


    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
