<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok_total' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();
        $data['stok_tersedia'] = $data['stok_total'];

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        Alat::create($data);

        return redirect()->route('admin.alats.index')
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, Alat $alat)
    {
        $request->validate([
            'nama' => 'required',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok_total' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        // Jika stok total diubah, update stok_tersedia
        $stok_diff = $request->stok_total - $alat->stok_total;
        $data['stok_tersedia'] = $alat->stok_tersedia + $stok_diff;

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($alat->gambar) {
                Storage::disk('public')->delete($alat->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($data);

        return redirect()->route('admin.alats.index')
            ->with('success', 'Alat berhasil diperbarui.');
    }

    public function destroy(Alat $alat)
    {
        if ($alat->gambar) {
            Storage::disk('public')->delete($alat->gambar);
        }
        $alat->delete();
        return redirect()->route('admin.alats.index')
            ->with('success', 'Alat berhasil dihapus.');
    }

    // ===== Tambahkan method show =====
    public function show(Alat $alat)
    {
        return view('admin.alat.show', compact('alat'));
    }
}
