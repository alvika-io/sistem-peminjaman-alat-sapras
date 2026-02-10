<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Alat</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')
<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Edit Alat</h1>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('admin.alats.update', $alat->id) }}" class="form form-confirm" enctype="multipart/form-data" data-message="Yakin ingin memperbarui alat ini?">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Alat</label>
                    <input type="text" name="nama" value="{{ $alat->nama }}" required>
                </div>

                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" accept="image/*">
                    @if($alat->gambar)
                        <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->nama }}" width="80" style="margin-top:10px;">
                    @endif
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ $alat->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Stok Total</label>
                    <input type="number" name="stok_total" min="0" value="{{ $alat->stok_total }}" required>
                </div>

                <div style="margin-top:20px;">
                    <button type="submit" class="btn btn-edit">Update</button>
                    <a href="{{ route('admin.alats.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.admin-scripts')

</body>
</html>
