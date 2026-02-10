<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengembalian</title>
    <link rel="stylesheet" href="{{ asset('petugas/css/dashboard.css') }}">
</head>
<body>

@include('petugas.partials.navbar')

<div class="main-wrapper">
    @include('petugas.partials.sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Detail Pengembalian</h1>
        </div>

        <div class="card">
            <p><strong>Peminjam:</strong> {{ $pengembalian->peminjaman->user->name }}</p>
            <p><strong>Barang:</strong> {{ $pengembalian->peminjaman->alat->nama_alat }}</p>
            <p><strong>Tanggal Kembali:</strong> {{ $pengembalian->tanggal_kembali }}</p>
            <p><strong>Kondisi:</strong> {{ ucfirst($pengembalian->kondisi_barang) }}</p>
            <p><strong>Denda:</strong> Rp {{ number_format($pengembalian->denda) }}</p>

            <button onclick="window.print()" class="btn btn-primary">
                Cetak
            </button>
        </div>

    </div>
</div>

@include('petugas.partials.scripts')
</body>
</html>
