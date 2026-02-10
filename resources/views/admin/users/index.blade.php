<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data User</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')

<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <h1>Data User</h1>

        <a href="{{ route('admin.users.create') }}" class="btn">
            + Tambah User
        </a>

        <table class="table datatable" style="margin-top:20px;">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        {{-- EDIT --}}
                        <a href="{{ route('admin.users.edit', $user->id) }}"
                           class="btn btn-edit">
                            Edit
                        </a>

                        {{-- HAPUS --}}
                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                              method="POST"
                              class="form-delete" {{-- pakai SweetAlert --}}
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@include('partials.admin-scripts') {{-- Partial SweetAlert & DataTables --}}
</body>
</html>
