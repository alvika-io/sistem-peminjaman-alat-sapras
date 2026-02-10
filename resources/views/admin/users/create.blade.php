<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <h1>Tambah User</h1>

        <form method="POST" 
              action="{{ route('admin.users.store') }}" 
              class="form-confirm" 
              data-message="Yakin ingin menambahkan user ini?"> {{-- SweetAlert konfirmasi --}}
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="peminjam">Peminjam</option>
                    <option value="petugas">Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div style="margin-top:20px;">
                <button type="submit" class="btn">Simpan</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@include('partials.admin-scripts') {{-- Partial SweetAlert & DataTables --}}
</body>
</html>
