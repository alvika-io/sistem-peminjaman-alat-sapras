<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PengaturanDenda;
use Illuminate\Http\Request;

class DendaSettingController extends Controller
{
    /**
     * Menampilkan halaman pengaturan denda
     */
    public function index()
    {
        // Mengambil data pertama dari tabel pengaturan denda
        $pengaturan = PengaturanDenda::first();
        
        return view('petugas.denda.index', compact('pengaturan'));
    }

    /**
     * Memperbarui tarif denda di database
     */
    public function update(Request $request)
    {
        // Validasi input agar hanya angka positif yang masuk
        $request->validate([
            'denda_telat_per_hari' => 'required|numeric|min:0',
            'denda_rusak'          => 'required|numeric|min:0',
            'denda_hilang'         => 'required|numeric|min:0',
        ]);

        $pengaturan = PengaturanDenda::first();
        
        // Update data dengan semua input dari form
        $pengaturan->update($request->all());

        return back()->with('success', 'Tarif denda berhasil diperbarui oleh sistem!');
    }
}