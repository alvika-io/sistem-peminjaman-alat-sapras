<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')
<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Tambah Kategori</h1>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('admin.kategoris.store') }}" class="form form-confirm" data-message="Yakin ingin menambahkan kategori ini?">
                @csrf

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" required>
                </div>

                <div style="margin-top:20px;">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.admin-scripts')

</body>
</html>
