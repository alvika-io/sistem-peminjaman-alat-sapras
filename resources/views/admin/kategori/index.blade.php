<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')
<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Data Kategori</h1>
        </div>

        <a href="{{ route('admin.kategoris.create') }}" class="btn btn-primary">+ Tambah Kategori</a>

        <div class="card" style="margin-top:20px;">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategoris as $kategori)
                    <tr>
                        <td>{{ $kategori->nama }}</td>
                        <td>
                            <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" class="btn btn-edit">Edit</a>

                            <form action="{{ route('admin.kategoris.destroy', $kategori->id) }}"
                                  method="POST"
                                  style="display:inline-block;"
                                  class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('partials.admin-scripts')

</body>
</html>
