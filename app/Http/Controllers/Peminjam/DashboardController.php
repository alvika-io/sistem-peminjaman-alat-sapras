<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Total riwayat peminjaman milik user ini
        $totalPinjamanSaya = Peminjaman::where('user_id', $userId)->count();

        // Jumlah alat yang sedang dibawa (status disetujui)
        $alatSedangDibawa = Peminjaman::where('user_id', $userId)
                                    ->where('status', 'disetujui')
                                    ->count();

        // Menghitung total denda dari pengembalian yang masih berstatus 'diproses'
        $totalDendaSaya = Peminjaman::where('user_id', $userId)
            ->whereHas('pengembalian', function($query) {
                $query->where('denda', '>', 0)
                      ->where('status', 'diproses'); 
            })
            ->with('pengembalian')
            ->get()
            ->sum(function($p) {
                return $p->pengembalian->denda ?? 0;
            });

        return view('peminjam.dashboard', compact(
            'totalPinjamanSaya', 
            'alatSedangDibawa', 
            'totalDendaSaya'
        ));
    }
}