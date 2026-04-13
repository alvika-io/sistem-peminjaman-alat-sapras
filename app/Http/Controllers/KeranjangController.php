<?php

namespace App\Http\Controllers; // Pastikan cuma satu App-nya

use Illuminate\Http\Request;
use App\Models\Keranjang;
use App\Models\Alat;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Halaman List Keranjang
    public function index()
    {
        $items = Keranjang::with('alat')
            ->where('user_id', Auth::id())
            ->get();

        return view('peminjam.keranjang.index', compact('items'));
    }

    // Simpan ke Keranjang
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

    // Hapus item dari keranjang
    public function destroy(Keranjang $keranjang)
    {
        // Pastikan yang hapus adalah pemiliknya
        if($keranjang->user_id !== Auth::id()) {
            return back()->with('error', 'Akses ditolak.');
        }

        $keranjang->delete();
        return back()->with('success', 'Alat dihapus dari keranjang.');
    }
}