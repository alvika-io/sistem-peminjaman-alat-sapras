<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

class DashboardController extends Controller
{
    public function index()
    {
        // Peminjaman yang butuh persetujuan petugas
        $peminjamanPending = Peminjaman::where('status', 'pending')->count();

        // Peminjaman yang sedang aktif (alat dibawa user)
        $sedangDipinjam = Peminjaman::where('status', 'disetujui')->count();

        // Riwayat peminjaman yang sudah selesai
        $totalSelesai = Peminjaman::where('status', 'selesai')->count();

        // Kasus denda yang belum selesai diproses (status 'diproses' di tabel pengembalians)
        $dendaBelumLunas = Pengembalian::where('denda', '>', 0)
                                    ->where('status', 'diproses')
                                    ->count();

        return view('petugas.dashboard', compact(
            'peminjamanPending', 
            'sedangDipinjam', 
            'totalSelesai', 
            'dendaBelumLunas'
        ));
    }
}