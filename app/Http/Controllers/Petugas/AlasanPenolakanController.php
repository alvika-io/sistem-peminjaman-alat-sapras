<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\AlasanPenolakan;
use Illuminate\Http\Request;

class AlasanPenolakanController extends Controller
{
    /**
     * Menampilkan daftar alasan penolakan
     */
    public function index()
    {
        $alasans = AlasanPenolakan::latest()->get();
        return view('petugas.alasan.index', compact('alasans'));
    }

    /**
     * Menyimpan alasan penolakan baru ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'alasan' => 'required|string|max:255|unique:alasan_penolakans,alasan',
        ], [
            'alasan.required' => 'Teks alasan tidak boleh kosong!',
            'alasan.unique' => 'Alasan ini sudah ada dalam daftar.',
        ]);

        AlasanPenolakan::create([
            'alasan' => $request->alasan
        ]);

        return back()->with('success', 'Alasan penolakan baru berhasil ditambahkan!');
    }

    /**
     * Menghapus alasan penolakan
     */
    public function destroy($id)
    {
        $alasan = AlasanPenolakan::findOrFail($id);
        $alasan->delete();

        return back()->with('success', 'Alasan berhasil dihapus dari daftar.');
    }

    // Method create, show, edit, update dikosongkan dulu karena kita pakai modal di halaman index saja agar lebih ringkas
}