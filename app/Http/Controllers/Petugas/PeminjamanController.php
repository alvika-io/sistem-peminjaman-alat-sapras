<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\LogAktivitas;

class PeminjamanController extends Controller
{
    public function index()
    {
        // Menampilkan status 'pending' di paling atas, lalu diurutkan dari yang terbaru
        $peminjamans = Peminjaman::with(['user', 'alats'])
            ->orderByRaw("FIELD(status, 'pending', 'disetujui', 'selesai', 'ditolak') ASC")
            ->orderBy('created_at', 'desc')
            ->get();

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

        // ===============================
        // KURANGI STOK (pending → disetujui)
        // ===============================
        if ($statusLama === 'pending' && $statusBaru === 'disetujui') {
            foreach ($peminjaman->alats as $alat) {
                if ($alat->stok_tersedia < $alat->pivot->jumlah) {
                    return back()->with(
                        'error',
                        'Stok alat "' . $alat->nama . '" tidak mencukupi'
                    );
                }

                $alat->stok_tersedia -= $alat->pivot->jumlah;
                $alat->save();
            }
        }

        // ===============================
        // BALIKIN STOK (disetujui → selesai)
        // ===============================
        if ($statusLama === 'disetujui' && $statusBaru === 'selesai') {
            foreach ($peminjaman->alats as $alat) {
                $alat->stok_tersedia += $alat->pivot->jumlah;
                $alat->save();
            }
        }

        // UPDATE STATUS
        $peminjaman->update([
            'status' => $statusBaru
        ]);

        // 🔥 SIMPAN LOG AKTIVITAS
        LogAktivitas::create([
            'user_id'         => $peminjaman->user_id,
            'peminjaman_id'   => $peminjaman->id,
            'tanggal_pinjam'  => $peminjaman->tanggal_pinjam,
            'tanggal_kembali' => $peminjaman->tanggal_kembali,
            'status'          => $statusBaru,
            'denda'           => 0
        ]);

        return back()->with(
            'success',
            'Status peminjaman berhasil diperbarui.'
        );
    }

    public function laporan()
    {
        $peminjamans = Peminjaman::with(['user', 'alats'])
            ->latest()
            ->get();
            
        return view('petugas.peminjaman.laporan', compact('peminjamans'));
    }
}