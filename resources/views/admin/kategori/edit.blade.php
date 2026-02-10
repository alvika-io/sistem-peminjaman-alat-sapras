<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')
<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Edit Kategori</h1>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('admin.kategoris.update', $kategori->id) }}" class="form form-confirm" data-message="Yakin ingin memperbarui kategori ini?">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" name="nama" value="{{ $kategori->nama }}" required>
                </div>

                <div style="margin-top:20px;">
                    <button type="submit" class="btn btn-edit">Update</button>
                    <a href="{{ route('admin.kategoris.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.admin-scripts')

</body>
</html>
