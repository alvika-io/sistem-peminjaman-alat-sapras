<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// TAMBAHKAN INI AGAR RELASI TERBACA
use App\Models\Peminjaman;
use App\Models\User;

class LogAktivitas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'peminjaman_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'status',
        'denda'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peminjaman()
    {
        // Pastikan Peminjaman sudah di-import di atas
        return $this->belongsTo(Peminjaman::class);
    }
}