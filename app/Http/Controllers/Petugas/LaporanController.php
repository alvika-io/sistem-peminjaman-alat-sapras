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
        $query = Pengembalian::with(['peminjaman.user', 'peminjaman.alats']);

        // Filter Rentang Tanggal
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_kembali_real', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        // Filter Kondisi Alat (Baru)
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        // Filter Status Pembayaran Denda (Baru)
        if ($request->filled('denda_status')) {
            $query->where('denda_status', $request->denda_status);
        }

        $pengembalians = $query->latest()->get();

        // Rekapitulasi Statistik untuk Statistik Card di View
        $stats = [
            'total_denda'    => $pengembalians->sum('denda'),
            'total_lunas'    => $pengembalians->where('denda_status', 'lunas')->sum('denda'),
            'total_piutang'  => $pengembalians->where('denda_status', 'belum_dibayar')->sum('denda'),
            'total_rusak'    => $pengembalians->where('kondisi', 'rusak')->count(),
            'total_hilang'   => $pengembalians->where('kondisi', 'hilang')->count(),
        ];

        return view('petugas.laporan.index', compact(
            'pengembalians',
            'stats'
        ));
    }

    public function cetak(Request $request)
    {
        $query = Pengembalian::with(['peminjaman.user', 'peminjaman.alats']);

        // Terapkan filter yang sama untuk hasil cetak
        if ($request->filled('tanggal_mulai') && $request->filled('tanggal_selesai')) {
            $query->whereBetween('tanggal_kembali_real', [
                $request->tanggal_mulai,
                $request->tanggal_selesai
            ]);
        }

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->filled('denda_status')) {
            $query->where('denda_status', $request->denda_status);
        }

        $pengembalians = $query->get();
        $totalDenda    = $pengembalians->sum('denda');

        $pdf = Pdf::loadView('petugas.laporan.pdf', compact(
            'pengembalians',
            'totalDenda'
        ))->setPaper('a4', 'landscape'); // Landscape agar tabel alat tidak terpotong

        return $pdf->download('laporan-sapras-' . date('Y-m-d') . '.pdf');
    }
}