<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Pengembalian</title>
    <link rel="stylesheet" href="{{ asset('petugas/css/dashboard.css') }}">
</head>
<body>

@include('petugas.partials.navbar')

<div class="main-wrapper">
    @include('petugas.partials.sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Data Pengembalian</h1>
        </div>

        @if (session('success'))
            <div class="card" style="background:#dcfce7; color:#166534;">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Tgl Kembali</th>
                        <th>Kondisi</th>
                        <th>Denda</th>
                        <th>Status Denda</th>
                        <th>Status Pengembalian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse ($pengembalians as $pengembalian)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $pengembalian->peminjaman->user->name }}
                        </td>

                        <td>
                            {{ $pengembalian->tanggal_kembali_real }}
                        </td>

                        <td>
                            {{ ucfirst($pengembalian->kondisi) }}
                        </td>

                        {{-- DENDA --}}
                        <td>
                            @if ($pengembalian->denda > 0)
                                Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>

                        {{-- STATUS DENDA --}}
                        <td>
                            @if ($pengembalian->denda <= 0)
                                <span class="badge badge-secondary">
                                    Tidak Ada Denda
                                </span>
                            @elseif ($pengembalian->denda_status === 'belum_dibayar')
                                <span class="badge badge-danger">
                                    Belum Dibayar
                                </span>
                            @elseif ($pengembalian->denda_status === 'lunas')
                                <span class="badge badge-success">
                                    Lunas
                                </span>
                            @endif
                        </td>

                        {{-- STATUS PENGEMBALIAN --}}
                        <td>
                            <span class="badge badge-success">
                                Selesai
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td style="display:flex; gap:6px;">
                            <a href="{{ route('petugas.pengembalian.show', $pengembalian->id) }}"
                               class="btn btn-secondary">
                                Detail
                            </a>

                            {{-- TOMBOL BAYAR DENDA --}}
                            @if ($pengembalian->denda > 0 && $pengembalian->denda_status === 'belum_dibayar')
                                <form action="{{ route('petugas.pengembalian.updateStatusDenda', $pengembalian->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin denda sudah dibayar?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success">
                                        Tandai Dibayar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" align="center">
                            Belum ada data pengembalian
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('petugas.partials.scripts')
</body>
</html>
