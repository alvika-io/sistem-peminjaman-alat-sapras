<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Petugas</title>
    <!-- Panggil CSS khusus petugas -->
    <link rel="stylesheet" href="{{ asset('petugas/css/dashboard.css') }}">
</head>
<body>

@include('petugas.partials.navbar')

<div class="main-wrapper">
    @include('petugas.partials.sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Dashboard Petugas</h1>
        </div>

        <div class="card">
            <p>Selamat datang, {{ auth()->user()->name }}!</p>
            <p>Gunakan sidebar untuk mengakses fitur peminjaman, pengembalian, dan laporan.</p>
        </div>
    </div>
</div>

</body>
</html>
