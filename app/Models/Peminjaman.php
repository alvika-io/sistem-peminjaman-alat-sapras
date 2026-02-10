<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Alat;
use App\Models\Pengembalian;
use App\Models\LogAktivitas;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';

    protected $fillable = [
        'user_id',
        'status',
        'tanggal_pinjam',
        'tanggal_kembali'
    ];

    // RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI KE ALAT (many-to-many)
    public function alats()
    {
        return $this->belongsToMany(Alat::class, 'peminjaman_alat')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }

    // RELASI KE PENGEMBALIAN
    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class, 'peminjaman_id');
    }

    // RELASI KE LOG AKTIVITAS
    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class);
    }
}
