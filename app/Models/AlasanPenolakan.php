<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlasanPenolakan extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'alasan_penolakans';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'alasan'
    ];
}