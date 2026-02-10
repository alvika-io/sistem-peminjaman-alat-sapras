<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Alat</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>

@include('partials.navbar')
<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Data Alat</h1>
        </div>

        <a href="{{ route('admin.alats.create') }}" class="btn btn-primary">+ Tambah Alat</a>

        <div class="card" style="margin-top:20px;">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Gambar</th>
                        <th>Kategori</th>
                        <th>Stok Total</th>
                        <th>Stok Tersedia</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alats as $alat)
                    <tr>
                        <td>{{ $alat->nama }}</td>
                        <td>
                            @if($alat->gambar)
                                <img src="{{ asset('storage/'.$alat->gambar) }}" alt="{{ $alat->nama }}" width="60">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $alat->kategori->nama }}</td>
                        <td>{{ $alat->stok_total }}</td>
                        <td>{{ $alat->stok_tersedia }}</td>
                        <td>
                            <a href="{{ route('admin.alats.show', $alat->id) }}" class="btn btn-primary">Lihat</a>
                            <a href="{{ route('admin.alats.edit', $alat->id) }}" class="btn btn-edit">Edit</a>

                            <form action="{{ route('admin.alats.destroy', $alat->id) }}"
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
