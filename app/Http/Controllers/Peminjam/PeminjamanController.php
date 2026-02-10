<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // list peminjaman milik user login
    public function index()
    {
        $peminjamans = Peminjaman::with([
                'alats',
                'pengembalian' // 🔥 WAJIB
            ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    // form pengajuan
    public function create()
    {
        $alats = Alat::where('stok_tersedia', '>', 0)->get();
        return view('peminjam.peminjaman.create', compact('alats'));
    }

    // simpan pengajuan
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam'   => 'required|date',
            'tanggal_kembali'  => 'required|date|after_or_equal:tanggal_pinjam',
            'alat_id'          => 'required|array',
            'jumlah'           => 'required|array'
        ]);

        $peminjaman = Peminjaman::create([
            'user_id'          => Auth::id(),
            'tanggal_pinjam'   => $request->tanggal_pinjam,
            'tanggal_kembali'  => $request->tanggal_kembali,
            'status'           => 'pending'
        ]);

        foreach ($request->alat_id as $index => $alatId) {
            $peminjaman->alats()->attach($alatId, [
                'jumlah' => $request->jumlah[$index]
            ]);
        }

        return redirect()
            ->route('peminjam.peminjaman.index')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim.');
    }
}
