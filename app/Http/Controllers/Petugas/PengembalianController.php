<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        // Mengambil data pengembalian beserta relasi user dan alats
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alats'])
            ->latest()
            ->get();

        // Menghitung total denda untuk ditampilkan di box summary dashboard
        $totalDenda = $pengembalians->sum('denda');

        return view('petugas.pengembalian.index', compact('pengembalians', 'totalDenda'));
    }

    public function create(Peminjaman $peminjaman)
    {
        // Load data alats agar daftar barang muncul di form pengembalian
        $peminjaman->load(['user', 'alats']);
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

        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::with('alats')
                ->findOrFail($request->peminjaman_id);

            if ($peminjaman->status === 'selesai') {
                return back()->with('error', 'Peminjaman ini sudah dikembalikan');
            }

            $denda = (int) $request->denda;

            // 1. SIMPAN PENGEMBALIAN
            Pengembalian::create([
                'peminjaman_id'        => $peminjaman->id,
                'tanggal_kembali_real' => $request->tanggal_kembali_real,
                'kondisi'              => $request->kondisi,
                'denda'                => $denda,
                'denda_status'         => $denda > 0 ? 'belum_dibayar' : 'lunas',
            ]);

            // 2. BALIKIN STOK ALAT
            foreach ($peminjaman->alats as $alat) {
                $alat->update([
                    'stok_tersedia' => $alat->stok_tersedia + $alat->pivot->jumlah
                ]);
            }

            // 3. UPDATE STATUS PEMINJAMAN
            $peminjaman->update([
                'status' => 'selesai'
            ]);

            // 4. SIMPAN LOG AKTIVITAS (Untuk history Admin & Petugas)
            LogAktivitas::create([
                'user_id'         => $peminjaman->user_id,
                'peminjaman_id'   => $peminjaman->id,
                'tanggal_pinjam'  => $peminjaman->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali_real,
                'status'          => 'selesai',
                'denda'           => $denda
            ]);

            DB::commit();
            return redirect()
                ->route('petugas.pengembalian.index')
                ->with('success', 'Pengembalian berhasil & stok alat dikembalikan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * METHOD SHOW (FIX ERROR: Call to undefined method)
     * Digunakan untuk menampilkan detail struk pengembalian
     */
    public function show(Pengembalian $pengembalian)
    {
        // Load relasi agar data peminjam dan daftar alat muncul di detail
        $pengembalian->load(['peminjaman.user', 'peminjaman.alats']);

        return view('petugas.pengembalian.show', compact('pengembalian'));
    }

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