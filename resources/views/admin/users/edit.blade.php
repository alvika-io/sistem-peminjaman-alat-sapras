<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <h1>Edit User</h1>

        <div class="card">
            <form method="POST" 
                  action="{{ route('admin.users.update', $user->id) }}" 
                  class="form-confirm" 
                  data-message="Yakin ingin memperbarui user ini?"> {{-- SweetAlert konfirmasi --}}
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text"
                           name="name"
                           value="{{ $user->name }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           value="{{ $user->email }}"
                           required>
                </div>

                <div class="form-group">
                    <label>Password (opsional)</label>
                    <input type="password"
                           name="password"
                           placeholder="Kosongkan jika tidak diubah">
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select name="role" required>
                        <option value="peminjam" {{ $user->role == 'peminjam' ? 'selected' : '' }}>
                            Peminjam
                        </option>
                        <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>
                            Petugas
                        </option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                            Admin
                        </option>
                    </select>
                </div>

                <div style="margin-top:20px;">
                    <button type="submit" class="btn btn-edit">
                        Update
                    </button>

                    <a href="{{ route('admin.users.index') }}"
                       class="btn"
                       style="margin-left:10px;">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('partials.admin-scripts') {{-- Partial SweetAlert & DataTables --}}
</body>
</html>
