<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alats'])->get();
        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'alats']);
        return view('petugas.peminjaman.show', compact('peminjaman'));
    }

    public function updateStatus(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:pending,disetujui,ditolak,selesai'
        ]);

        $statusLama = $peminjaman->status;
        $statusBaru = $request->status;

        /**
         * =====================================================
         * KURANGI STOK → SAAT PENDING → DISETUJUI
         * =====================================================
         */
        if ($statusLama === 'pending' && $statusBaru === 'disetujui') {

            foreach ($peminjaman->alats as $alat) {

                // Cek stok cukup
                if ($alat->stok_tersedia < $alat->pivot->jumlah) {
                    return redirect()->back()->with(
                        'error',
                        'Stok alat "' . $alat->nama . '" tidak mencukupi'
                    );
                }

                // Kurangi stok
                $alat->stok_tersedia -= $alat->pivot->jumlah;
                $alat->save();
            }
        }

        /**
         * =====================================================
         * KEMBALIKAN STOK → SAAT DISETUJUI → SELESAI
         * =====================================================
         */
        if ($statusLama === 'disetujui' && $statusBaru === 'selesai') {

            foreach ($peminjaman->alats as $alat) {
                $alat->stok_tersedia += $alat->pivot->jumlah;
                $alat->save();
            }
        }

        // Update status peminjaman
        $peminjaman->status = $statusBaru;
        $peminjaman->save();

        return redirect()->back()->with(
            'success',
            'Status peminjaman berhasil diperbarui.'
        );
    }

    public function laporan()
    {
        $peminjamans = Peminjaman::with(['user', 'alats'])->get();
        return view('petugas.peminjaman.laporan', compact('peminjamans'));
    }
}
