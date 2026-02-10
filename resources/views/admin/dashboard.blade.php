<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, {{ auth()->user()->name }}</p>

        <div class="dashboard-grid">
            <div class="card">Total Alat</div>
            <div class="card">Alat Dipinjam</div>
            <div class="card">Peminjam Aktif</div>
            <div class="card">Petugas</div>
        </div>
    </div>
</div>

</body>
</html>
