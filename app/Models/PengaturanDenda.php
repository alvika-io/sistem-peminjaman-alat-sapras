<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanDenda extends Model
{
    use HasFactory;

    // Menentukan nama tabel karena jamak otomatis Laravel berbeda
    protected $table = 'pengaturan_dendas';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'denda_telat_per_hari',
        'denda_rusak',
        'denda_hilang',
    ];
}