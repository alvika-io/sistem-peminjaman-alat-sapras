<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELASI KE PEMINJAMAN
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

    // RELASI KE LOG AKTIVITAS
    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class);
    }
}
