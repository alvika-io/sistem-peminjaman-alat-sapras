<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// ================= ADMIN =================
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\LogAktivitasController;

// ================= PETUGAS =================
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Petugas\PeminjamanController as PetugasPeminjamanController;
use App\Http\Controllers\Petugas\PengembalianController as PetugasPengembalianController;
use App\Http\Controllers\Petugas\LaporanController;
use App\Http\Controllers\Petugas\DendaSettingController; // <--- Namespace Baru

// ================= PEMINJAM =================
use App\Http\Controllers\Peminjam\DashboardController as PeminjamDashboardController;
use App\Http\Controllers\Peminjam\PeminjamanController as PeminjamPeminjamanController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);
        Route::resource('kategoris', KategoriController::class);
        Route::resource('alats', AlatController::class);

        // ===== LOG AKTIVITAS =====
        Route::get('/log-aktivitas', [LogAktivitasController::class, 'index'])
            ->name('log-aktivitas.index');
    });

/*
|--------------------------------------------------------------------------
| PETUGAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // Dashboard Petugas
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

        // ===== PEMINJAMAN =====
        Route::get('/peminjaman', [PetugasPeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        Route::get('/peminjaman/{peminjaman}', [PetugasPeminjamanController::class, 'show'])
            ->name('peminjaman.show');

        Route::patch('/peminjaman/{peminjaman}/status', [PetugasPeminjamanController::class, 'updateStatus'])
            ->name('peminjaman.updateStatus');

        // ===== PENGEMBALIAN =====
        Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])
            ->name('pengembalian.index');

        Route::get('/pengembalian/create/{peminjaman}', [PetugasPengembalianController::class, 'create'])
            ->name('pengembalian.create');

        Route::post('/pengembalian', [PetugasPengembalianController::class, 'store'])
            ->name('pengembalian.store');

        Route::get('/pengembalian/{pengembalian}', [PetugasPengembalianController::class, 'show'])
            ->name('pengembalian.show');

        Route::put('/pengembalian/{pengembalian}/status-denda', [PetugasPengembalianController::class, 'updateStatusDenda'])
            ->name('pengembalian.updateStatusDenda');

        // ===== LAPORAN =====
        Route::get('/laporan/pengembalian', [LaporanController::class, 'pengembalian'])
            ->name('laporan.pengembalian');

        Route::get('/laporan/pengembalian/cetak', [LaporanController::class, 'cetak'])
            ->name('laporan.pengembalian.cetak');

        // ===== PENGATURAN DENDA =====
        Route::get('/pengaturan-denda', [DendaSettingController::class, 'index'])
            ->name('denda.index');

        Route::put('/pengaturan-denda', [DendaSettingController::class, 'update'])
            ->name('denda.update');
    });

/*
|--------------------------------------------------------------------------
| PEMINJAM
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:peminjam'])
    ->prefix('peminjam')
    ->name('peminjam.')
    ->group(function () {

        // Dashboard Peminjam
        Route::get('/dashboard', [PeminjamDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/peminjaman', [PeminjamPeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        Route::get('/peminjaman/create', [PeminjamPeminjamanController::class, 'create'])
            ->name('peminjaman.create');

        Route::post('/peminjaman', [PeminjamPeminjamanController::class, 'store'])
            ->name('peminjaman.store');
    });

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';