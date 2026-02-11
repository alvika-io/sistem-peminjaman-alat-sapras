<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan daftar riwayat peminjaman milik user yang sedang login.
     */
    public function index()
    {
        $peminjamans = Peminjaman::with([
                'alats',
                'pengembalian' 
            ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    /**
     * Menampilkan form untuk mengajukan peminjaman alat baru.
     */
    public function create()
    {
        // Hanya menampilkan alat yang stoknya tersedia di atas 0
        $alats = Alat::where('stok_tersedia', '>', 0)->get();
        return view('peminjam.peminjaman.create', compact('alats'));
    }

    /**
     * Menyimpan data pengajuan peminjaman ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'tanggal_pinjam'   => 'required|date',
            'tanggal_kembali'  => 'required|date|after_or_equal:tanggal_pinjam',
            'alat_id'          => 'required|array|min:1',
            'jumlah'           => 'required|array'
        ]);

        try {
            // Menggunakan Transaction untuk menjaga integritas data
            DB::beginTransaction();

            // 2. Buat data induk peminjaman
            $peminjaman = Peminjaman::create([
                'user_id'          => Auth::id(),
                'tanggal_pinjam'   => $request->tanggal_pinjam,
                'tanggal_kembali'  => $request->tanggal_kembali,
                'status'           => 'pending' // Status awal selalu pending
            ]);

            // 3. Simpan relasi alat ke tabel pivot (peminjaman_alat)
            $anyAlatSaved = false;

            foreach ($request->alat_id as $index => $alatId) {
                // Ambil jumlah yang sejajar dengan index alat yang dicentang
                $qty = $request->jumlah[$index] ?? 0;

                if ($qty > 0) {
                    $peminjaman->alats()->attach($alatId, [
                        'jumlah' => $qty
                    ]);
                    $anyAlatSaved = true;
                }
            }

            // Jika tidak ada alat yang memiliki jumlah valid, batalkan proses
            if (!$anyAlatSaved) {
                DB::rollBack();
                return back()->withErrors(['error' => 'Gagal: Anda harus memasukkan jumlah minimal 1 untuk alat yang dipilih.'])->withInput();
            }

            DB::commit();

            return redirect()
                ->route('peminjam.peminjaman.index')
                ->with('success', 'Pengajuan peminjaman berhasil dikirim.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Mencatat error ke log untuk pengecekan lebih lanjut jika terjadi kegagalan sistem
            Log::error("Error saat simpan peminjaman: " . $e->getMessage());
            
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }
}