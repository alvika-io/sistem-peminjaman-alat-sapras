<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function pengembalian(Request $request)
    {
        $query = Pengembalian::with('peminjaman.user');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_kembali_real', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        $pengembalians = $query->latest()->get();
        $totalDenda    = $pengembalians->sum('denda');

        return view('petugas.laporan.index', compact(
            'pengembalians',
            'totalDenda'
        ));
    }

    public function cetak(Request $request)
    {
        $query = Pengembalian::with('peminjaman.user');

        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_kembali_real', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        $pengembalians = $query->get();
        $totalDenda    = $pengembalians->sum('denda');

      $pdf = Pdf::loadView('petugas.laporan.pdf', compact(
    'pengembalians',
    'totalDenda'
));


        return $pdf->download('laporan-pengembalian.pdf');
    }
}
