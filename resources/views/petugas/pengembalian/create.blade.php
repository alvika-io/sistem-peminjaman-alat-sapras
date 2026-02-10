<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proses Pengembalian</title>
    <link rel="stylesheet" href="{{ asset('petugas/css/dashboard.css') }}">
</head>
<body>

@include('petugas.partials.navbar')

<div class="main-wrapper">
    @include('petugas.partials.sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Proses Pengembalian</h1>
        </div>

        <div class="card">
            <form action="{{ route('petugas.pengembalian.store') }}" method="POST">
                @csrf

                {{-- ID PEMINJAMAN --}}
                <input type="hidden" name="peminjaman_id" value="{{ $peminjaman->id }}">

                {{-- INFO PEMINJAM --}}
                <label>Nama Peminjam</label>
                <input type="text" value="{{ $peminjaman->user->name }}" readonly>

                <label>Tanggal Pinjam</label>
                <input type="text" value="{{ $peminjaman->tanggal_pinjam }}" readonly>

                <label>Tanggal Kembali (Rencana)</label>
                <input type="text" value="{{ $peminjaman->tanggal_kembali }}" readonly>

                {{-- DAFTAR ALAT --}}
                <label>Alat yang Dipinjam</label>
                <ul style="margin-bottom:15px;">
                    @foreach ($peminjaman->alats as $alat)
                        <li>
                            {{ $alat->nama }} ({{ $alat->pivot->jumlah }})
                        </li>
                    @endforeach
                </ul>

                {{-- TANGGAL KEMBALI REAL (INI YANG DIPAKAI CONTROLLER) --}}
                <label>Tanggal Dikembalikan</label>
                <input type="date" name="tanggal_kembali_real" required>

                {{-- KONDISI BARANG (AMAN, BELUM DIPAKAI LOGIKA) --}}
                <label>Kondisi Barang</label>
                <select name="kondisi">
                    <option value="baik">Baik</option>
                    <option value="rusak">Rusak</option>
                    <option value="hilang">Hilang</option>
                </select>

                {{-- DENDA MANUAL (OPSIONAL, TIDAK DIPAKAI CONTROLLER) --}}
                <label>Denda (Opsional)</label>
                <input type="number" name="denda" value="0" min="0">

                <button type="submit" class="btn btn-primary">
                    Simpan Pengembalian
                </button>
            </form>
        </div>
    </div>
</div>

@include('petugas.partials.scripts')
</body>
</html>
