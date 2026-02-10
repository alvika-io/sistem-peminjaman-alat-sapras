<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peminjaman Saya</title>
    <link rel="stylesheet" href="{{ asset('peminjam/css/dashboard.css') }}">
</head>
<body>

@include('peminjam.partials.navbar')

<div class="main-wrapper">
    @include('peminjam.partials.sidebar')

    <div class="content">
        <div class="page-title" style="display:flex;justify-content:space-between;align-items:center;">
            <h1>Peminjaman Saya</h1>

            <a href="{{ route('peminjam.peminjaman.create') }}" class="btn btn-primary">
                + Ajukan Peminjaman
            </a>
        </div>

        <div class="card">
            <table width="100%" cellspacing="0" cellpadding="10">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Alat</th>
                        <th>Status Peminjaman</th>
                        <th>Denda</th>
                        <th>Status Pengembalian</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($peminjamans as $peminjaman)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali }}</td>

                            {{-- ALAT --}}
                            <td>
                                <ul style="margin:0;padding-left:15px;">
                                    @foreach ($peminjaman->alats as $alat)
                                        <li>
                                            {{ $alat->nama }}
                                            ({{ $alat->pivot->jumlah }})
                                        </li>
                                    @endforeach
                                </ul>
                            </td>

                            {{-- STATUS PEMINJAMAN --}}
                            <td>
                                @switch($peminjaman->status)
                                    @case('pending')
                                        <span class="badge badge-warning">
                                            Menunggu Persetujuan
                                        </span>
                                        @break

                                    @case('disetujui')
                                        <span class="badge badge-primary">
                                            Sedang Dipinjam
                                        </span>
                                        @break

                                    @case('selesai')
                                        <span class="badge badge-success">
                                            Selesai
                                        </span>
                                        @break

                                    @default
                                        <span class="badge badge-secondary">
                                            Tidak Diketahui
                                        </span>
                                @endswitch
                            </td>

                            {{-- DENDA --}}
                            <td>
                                @if ($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0)
                                    Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>

                            {{-- STATUS PENGEMBALIAN --}}
                           <td>
    @if ($peminjaman->pengembalian)
        @if ($peminjaman->pengembalian->denda_status === 'lunas')
            <span class="badge badge-success">
                Denda Lunas
            </span>
        @else
            <span class="badge badge-danger">
                Belum Dibayar
            </span>
        @endif
    @else
        <span class="badge badge-secondary">
            Belum Dikembalikan
        </span>
    @endif
</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" align="center">
                                Belum ada data peminjaman
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
