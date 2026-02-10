<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ajukan Peminjaman</title>

    {{-- CSS dashboard peminjam --}}
    <link rel="stylesheet" href="{{ asset('peminjam/css/dashboard.css') }}">
</head>
<body>

{{-- Navbar --}}
@include('peminjam.partials.navbar')

<div class="main-wrapper">

    {{-- Sidebar --}}
    @include('peminjam.partials.sidebar')

    {{-- Content --}}
    <div class="content">
        <div class="page-title">
            <h1>Ajukan Peminjaman Alat</h1>
        </div>

        <div class="card">

            {{-- Error validation --}}
            @if ($errors->any())
                <div style="margin-bottom:15px; color:red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('peminjam.peminjaman.store') }}" method="POST">
                @csrf

                {{-- Tanggal --}}
                <div style="margin-bottom:15px;">
                    <label>Tanggal Pinjam</label><br>
                    <input type="date" name="tanggal_pinjam" required>
                </div>

                <div style="margin-bottom:15px;">
                    <label>Tanggal Kembali</label><br>
                    <input type="date" name="tanggal_kembali" required>
                </div>

                <hr style="margin:20px 0">

                {{-- Alat --}}
                <h3>Pilih Alat</h3>

                @foreach ($alats as $alat)
                    <div style="margin-bottom:10px;">
                        <input type="checkbox"
                               name="alat_id[]"
                               value="{{ $alat->id }}"
                               id="alat{{ $alat->id }}">

                        <label for="alat{{ $alat->id }}">
                            {{ $alat->nama }} (Stok: {{ $alat->stok_tersedia }})
                        </label>

                        <input type="number"
                               name="jumlah[]"
                               min="1"
                               max="{{ $alat->stok_tersedia }}"
                               placeholder="Jumlah"
                               style="width:80px; margin-left:10px;">
                    </div>
                @endforeach

                <hr style="margin:20px 0">

                <button type="submit" class="btn-primary">
                    Ajukan Peminjaman
                </button>

            </form>
        </div>
    </div>
</div>

</body>
</html>
