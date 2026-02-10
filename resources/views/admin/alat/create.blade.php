<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alat</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')
<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Tambah Alat</h1>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('admin.alats.store') }}" class="form form-confirm" enctype="multipart/form-data" data-message="Yakin ingin menambahkan alat ini?">
                @csrf

                <div class="form-group">
                    <label>Nama Alat</label>
                    <input type="text" name="nama" required>
                </div>

                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategori_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Stok Total</label>
                    <input type="number" name="stok_total" min="0" required>
                </div>

                <div style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.alats.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.admin-scripts')

</body>
</html>
