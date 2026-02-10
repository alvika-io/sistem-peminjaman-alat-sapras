<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengembalian</title>
    <link rel="stylesheet" href="{{ asset('petugas/css/dashboard.css') }}">
</head>
<body>

@include('petugas.partials.navbar')

<div class="main-wrapper">
    @include('petugas.partials.sidebar')

    <div class="content">
        <h1>Laporan Pengembalian</h1>

        <form method="GET"
              action="{{ route('petugas.laporan.pengembalian') }}"
              style="display:flex;gap:10px;margin-bottom:15px;align-items:end;">

            <div>
                <label>Tanggal Mulai</label><br>
                <input type="date"
                       name="tanggal_mulai"
                       value="{{ request('tanggal_mulai') }}"
                       required>
            </div>

            <div>
                <label>Tanggal Selesai</label><br>
                <input type="date"
                       name="tanggal_selesai"
                       value="{{ request('tanggal_selesai') }}"
                       required>
            </div>

            <button class="btn btn-primary">Filter</button>

            <a href="{{ route('petugas.laporan.pengembalian.cetak', request()->all()) }}"
               class="btn btn-success">
                Cetak PDF
            </a>
        </form>

        <div class="card">
            <table width="100%" border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengembalians as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->peminjaman->user->name }}</td>
                            <td>{{ $item->tanggal_kembali_real }}</td>
                            <td>
                                Rp {{ number_format($item->denda, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center;">
                                Data pengembalian tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h3 style="margin-top:15px;">
            Total Denda:
            <strong>
                Rp {{ number_format($totalDenda, 0, ',', '.') }}
            </strong>
        </h3>
    </div>
</div>

</body>
</html>
