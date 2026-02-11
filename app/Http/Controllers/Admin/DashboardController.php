<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Menghitung data sesuai DB
        $totalAlat = Alat::sum('stok_total');
        
        $alatDipinjam = DB::table('peminjaman_alat')
            ->join('peminjamans', 'peminjaman_alat.peminjaman_id', '=', 'peminjamans.id')
            ->where('peminjamans.status', 'disetujui')
            ->sum('jumlah');

        $peminjamAktif = User::where('role', 'peminjam')->count();
        $totalPetugas = User::where('role', 'petugas')->count();

        return view('admin.dashboard', compact(
            'totalAlat', 
            'alatDipinjam', 
            'peminjamAktif', 
            'totalPetugas'
        ));
    }
}