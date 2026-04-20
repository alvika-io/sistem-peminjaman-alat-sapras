<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\Keranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['alats', 'pengembalian'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        // FIX: Ganti 'stok' menjadi 'stok_tersedia' sesuai Model Alat kamu
        $alats = Alat::where('stok_tersedia', '>', 0)->get();
        return view('peminjam.peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam'   => 'required|date|after_or_equal:today',
            'tanggal_kembali'  => 'required|date|after_or_equal:tanggal_pinjam',
            'alat_id'          => 'required|array|min:1',
            'jumlah'           => 'required|array'
        ]);

        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::create([
                'user_id'          => Auth::id(),
                'tanggal_pinjam'   => $request->tanggal_pinjam,
                'tanggal_kembali'  => $request->tanggal_kembali,
                'status'           => 'pending'
            ]);

            $selectedAlatIds = [];
            $anyAlatSaved = false;

            foreach ($request->alat_id as $index => $alatId) {
                // Ambil qty berdasarkan index alat yang dicentang
                $qty = (int) $request->jumlah[$index];

                if ($qty > 0) {
                    // Validasi stok real-time di server
                    $alat = Alat::lockForUpdate()->find($alatId);

                    // FIX: Ganti $alat->stok menjadi $alat->stok_tersedia
                    if (!$alat || $alat->stok_tersedia < $qty) {
                        throw new \Exception("Stok alat '{$alat->nama}' tidak mencukupi.");
                    }

                    $peminjaman->alats()->attach($alatId, ['jumlah' => $qty]);
                    $selectedAlatIds[] = $alatId;
                    $anyAlatSaved = true;
                }
            }

            if (!$anyAlatSaved) {
                throw new \Exception("Gagal: Anda harus memasukkan jumlah minimal 1.");
            }

            // BERSIHKAN KERANJANG UNTUK ITEM YANG DIPINJAM
            Keranjang::where('user_id', Auth::id())
                ->whereIn('alat_id', $selectedAlatIds)
                ->delete();

            DB::commit();

            return redirect()
                ->route('peminjam.peminjaman.index')
                ->with('success', 'Pengajuan peminjaman berhasil diajukan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Gagal Checkout: " . $e->getMessage());
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
}