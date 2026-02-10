<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogAktivitas;
use App\Models\User;

class LogAktivitasController extends Controller
{
    /**
     * Tampilkan daftar log aktivitas
     */
    public function index(Request $request)
    {
        // Ambil query log aktivitas
        $query = LogAktivitas::with(['user', 'peminjaman.alats'])->latest();

        // Filter berdasarkan user
        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $logs = $query->get();

        // Ambil semua user untuk filter di Blade
        $users = User::all();

        return view('admin.log_aktivitas.index', compact('logs', 'users'));
    }
}
