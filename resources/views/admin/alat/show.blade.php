<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Alat</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Detail Alat</h1>
        </div>

        <div class="card" style="padding:20px; max-width:600px;">
            <p><strong>Nama:</strong> {{ $alat->nama }}</p>
            <p><strong>Kategori:</strong> {{ $alat->kategori->nama }}</p>
            <p><strong>Stok Total:</strong> {{ $alat->stok_total }}</p>
            <p><strong>Stok Tersedia:</strong> {{ $alat->stok_tersedia }}</p>
            <p><strong>Gambar:</strong></p>
            @if($alat->gambar)
                <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->nama }}" width="150">
            @else
                <p>-</p>
            @endif

            <div style="margin-top:20px;">
                <a href="{{ route('admin.alats.index') }}" class="btn btn-secondary">Kembali</a>
                <a href="{{ route('admin.alats.edit', $alat->id) }}" class="btn btn-edit">Edit</a>
            </div>
        </div>
    </div>
</div>

@include('partials.admin-scripts')

</body>
</html>
