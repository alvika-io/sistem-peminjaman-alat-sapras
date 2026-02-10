<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Peminjam</title>

    <!-- CSS Peminjam -->
    <link rel="stylesheet" href="{{ asset('peminjam/css/dashboard.css') }}">
</head>
<body>

    {{-- Navbar Peminjam --}}
    @include('peminjam.partials.navbar')

    <div class="main-wrapper">
        
        {{-- Sidebar Peminjam --}}
        @include('peminjam.partials.sidebar')

        {{-- Content --}}
        <div class="content">
            <div class="page-title">
                <h1>Dashboard Peminjam</h1>
            </div>

            <div class="card">
                <p>Selamat datang di dashboard peminjam.</p>
            </div>
        </div>

    </div>

</body>
</html>
