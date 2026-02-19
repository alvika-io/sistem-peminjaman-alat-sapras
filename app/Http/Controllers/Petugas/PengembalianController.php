<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use App\Models\PengaturanDenda;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjaman.user', 'peminjaman.alats'])
            ->latest()
            ->get();
        $totalDenda = $pengembalians->sum('denda');
        return view('petugas.pengembalian.index', compact('pengembalians', 'totalDenda'));
    }

    public function create(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'alats']);
        return view('petugas.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id'        => 'required|exists:peminjamans,id',
            'tanggal_kembali_real' => 'required|date',
            'kondisi'              => 'required|in:baik,rusak,hilang',
        ]);

        try {
            DB::beginTransaction();

            $peminjaman = Peminjaman::with('alats')->findOrFail($request->peminjaman_id);

            if ($peminjaman->status === 'selesai') {
                return back()->with('error', 'Peminjaman ini sudah dikembalikan sebelumnya.');
            }

            // 1. Ambil tarif dari database (Pastikan nilainya Integer)
            $config = PengaturanDenda::first();
            if (!$config) {
                throw new \Exception('Tarif denda belum diatur di sistem.');
            }

            // 2. LOGIKA DENDA KETERLAMBATAN (Start of Day + Absolte)
            $tglHarusKembali = Carbon::parse($peminjaman->tanggal_kembali)->startOfDay();
            $tglRealitas     = Carbon::parse($request->tanggal_kembali_real)->startOfDay();
            $dendaTelat      = 0;

            if ($tglRealitas->gt($tglHarusKembali)) {
                // diffInDays dengan parameter true agar selalu positif
                $selisihHari = $tglRealitas->diffInDays($tglHarusKembali, true);
                $dendaTelat  = (int) $selisihHari * (int) $config->denda_telat_per_hari;
            }

            // 3. LOGIKA DENDA KONDISI (Gunakan Casting Integer)
            $dendaKondisi = 0;
            if ($request->kondisi === 'rusak') {
                $dendaKondisi = (int) $config->denda_rusak;
            } elseif ($request->kondisi === 'hilang') {
                $dendaKondisi = (int) $config->denda_hilang;
            }

            // 4. TOTAL AKHIR (Gunakan Penjumlahan Eksplisit)
            // Jika Telat 2 hari (20.000) + Rusak (50.000) = 70.000
            $totalDenda = $dendaTelat + $dendaKondisi;

            // 5. SIMPAN PENGEMBALIAN
            Pengembalian::create([
                'peminjaman_id'        => $peminjaman->id,
                'tanggal_kembali_real' => $request->tanggal_kembali_real,
                'kondisi'              => $request->kondisi,
                'denda'                => $totalDenda,
                'denda_status'         => $totalDenda > 0 ? 'belum_dibayar' : 'lunas',
                'status'               => 'selesai'
            ]);

            // 6. UPDATE STOK (Hanya jika tidak hilang)
            if ($request->kondisi !== 'hilang') {
                foreach ($peminjaman->alats as $alat) {
                    $alat->increment('stok_tersedia', $alat->pivot->jumlah);
                }
            }

            $peminjaman->update(['status' => 'selesai']);

            // 7. SIMPAN LOG AKTIVITAS
            LogAktivitas::create([
                'user_id'         => $peminjaman->user_id,
                'peminjaman_id'   => $peminjaman->id,
                'tanggal_pinjam'  => $peminjaman->tanggal_pinjam,
                'tanggal_kembali' => $request->tanggal_kembali_real,
                'status'          => 'selesai',
                'denda'           => $totalDenda
            ]);

            DB::commit();

            return redirect()->route('petugas.pengembalian.index')
                ->with('success', "Berhasil! Denda Telat: Rp ".number_format($dendaTelat)." + Denda Kondisi: Rp ".number_format($dendaKondisi)." = Rp ".number_format($totalDenda, 0, ',', '.'));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show(Pengembalian $pengembalian)
    {
        $pengembalian->load(['peminjaman.user', 'peminjaman.alats']);
        return view('petugas.pengembalian.show', compact('pengembalian'));
    }

    public function updateStatusDenda($id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        if ($pengembalian->denda > 0 && $pengembalian->denda_status === 'belum_dibayar') {
            $pengembalian->update(['denda_status' => 'lunas']);
            return back()->with('success', 'Pembayaran denda berhasil diverifikasi!');
        }
        return back()->with('error', 'Data denda tidak valid.');
    }
}