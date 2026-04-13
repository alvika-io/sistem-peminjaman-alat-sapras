<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional jika nama tabelnya sudah 'keranjangs')
    protected $table = 'keranjangs';

    // Kolom yang boleh diisi melalui mass assignment
    protected $fillable = [
        'user_id',
        'alat_id',
        'jumlah',
    ];

    /**
     * Relasi ke User (Satu item keranjang dimiliki oleh satu User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Alat (Satu item keranjang merujuk ke satu Alat)
     * Pastikan nama model 'Alat' sesuai dengan nama model yang kamu punya.
     */
    public function alat()
    {
        return $this->belongsTo(Alat::class);
    }
}