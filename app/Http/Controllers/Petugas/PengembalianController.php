<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with('peminjaman.user')
            ->latest()
            ->get();

        return view('petugas.pengembalian.index', compact('pengembalians'));
    }

    public function create(Peminjaman $peminjaman)
    {
        return view('petugas.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id'        => 'required|exists:peminjamans,id',
            'tanggal_kembali_real' => 'required|date',
            'kondisi'              => 'required',
            'denda'                => 'required|numeric|min:0',
        ]);

        // 🔥 WAJIB LOAD ALATS + PIVOT
        $peminjaman = Peminjaman::with('alats')
            ->findOrFail($request->peminjaman_id);

        // ⛔ PENGAMAN BIAR STOK GA BALIK 2x
        if ($peminjaman->status === 'selesai') {
            return back()->with('error', 'Peminjaman ini sudah dikembalikan');
        }

        // SIMPAN DATA PENGEMBALIAN
        $denda = (int) $request->denda;

        Pengembalian::create([
            'peminjaman_id'        => $peminjaman->id,
            'tanggal_kembali_real' => $request->tanggal_kembali_real,
            'kondisi'              => $request->kondisi,
            'denda'                => $denda,
            'denda_status'         => $denda > 0 ? 'belum_dibayar' : 'lunas',
            'status'               => 'selesai',
        ]);

     
       // 🔥 BALIKIN STOK ALAT (FIX FINAL)
foreach ($peminjaman->alats as $alat) {
    $alat->update([
        'stok_tersedia' => $alat->stok_tersedia + $alat->pivot->jumlah
    ]);
}

        // UPDATE STATUS PEMINJAMAN
        $peminjaman->update([
            'status' => 'selesai'
        ]);

        return redirect()
            ->route('petugas.pengembalian.index')
            ->with('success', 'Pengembalian berhasil & stok alat dikembalikan');
    }

    // 🔁 TOMBOL "TANDAI DIBAYAR"
    public function updateStatusDenda($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);

        if ($pengembalian->denda > 0 && $pengembalian->denda_status === 'belum_dibayar') {
            $pengembalian->update([
                'denda_status' => 'lunas'
            ]);
        }

        return back()->with('success', 'Status denda berhasil diperbarui');
    }
}
