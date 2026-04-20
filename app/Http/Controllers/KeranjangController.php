<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Alat;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $items = Keranjang::with('alat')
            ->where('user_id', Auth::id())
            ->get();

        return view('peminjam.keranjang.index', compact('items'));
    }

    // UPDATE JUMLAH (Method baru buat nampung klik +/- di keranjang)
    public function updateQuantity(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah'  => 'required|integer|min:1'
        ]);

        $keranjang = Keranjang::where('user_id', Auth::id())
                              ->where('alat_id', $request->alat_id)
                              ->first();

        if ($keranjang) {
            $alat = Alat::find($request->alat_id);
            
            // FIX: Ganti ->stok menjadi ->stok_tersedia sesuai Model Alat kamu
            if ($request->jumlah > $alat->stok_tersedia) {
                return response()->json(['error' => 'Stok tidak mencukupi!'], 422);
            }

            $keranjang->update(['jumlah' => $request->jumlah]);
            return response()->json(['success' => 'Jumlah berhasil diperbarui']);
        }

        return response()->json(['error' => 'Item tidak ditemukan'], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $keranjang = Keranjang::where('user_id', Auth::id())
                              ->where('alat_id', $request->alat_id)
                              ->first();

        if ($keranjang) {
            $alat = Alat::find($request->alat_id);

            // FIX: Tambahkan validasi stok juga di sini biar aman pas nambah dari luar
            if (($keranjang->jumlah + $request->jumlah) > $alat->stok_tersedia) {
                 return response()->json(['error' => 'Total melebihi stok tersedia!'], 422);
            }

            $keranjang->update([
                'jumlah' => $keranjang->jumlah + $request->jumlah
            ]);
        } else {
            Keranjang::create([
                'user_id' => Auth::id(),
                'alat_id' => $request->alat_id,
                'jumlah' => $request->jumlah
            ]);
        }

        return response()->json(['success' => 'Alat berhasil ditambahkan ke keranjang!']);
    }

    public function destroy(Keranjang $keranjang)
    {
        if($keranjang->user_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        $keranjang->delete();
        return back()->with('success', 'Alat dihapus dari keranjang.');
    }
}