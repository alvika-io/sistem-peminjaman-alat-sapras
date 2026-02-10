<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Peminjaman</title>
    <link rel="stylesheet" href="{{ asset('petugas/css/dashboard.css') }}">
</head>
<body>

@include('petugas.partials.navbar')

<div class="main-wrapper">
    @include('petugas.partials.sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Data Peminjaman</h1>
        </div>

        <div class="card">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Peminjam</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($peminjamans as $index => $peminjaman)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ $peminjaman->user->name ?? '-' }}</td>
                            <td>{{ $peminjaman->tanggal_pinjam }}</td>
                            <td>{{ $peminjaman->tanggal_kembali }}</td>

                            <td>
                                @if ($peminjaman->status === 'pending')
                                    <span class="btn btn-secondary">Pending</span>
                                @elseif ($peminjaman->status === 'disetujui')
                                    <span class="btn btn-primary">Dipinjam</span>
                                @elseif ($peminjaman->status === 'ditolak')
                                    <span class="btn btn-delete">Ditolak</span>
                                @elseif ($peminjaman->status === 'selesai')
                                    <span class="btn btn-success">Selesai</span>
                                @endif
                            </td>

                            <td>
                                {{-- DETAIL --}}
                                <a href="{{ route('petugas.peminjaman.show', $peminjaman->id) }}"
                                   class="btn btn-secondary btn-sm">
                                    Detail
                                </a>

                                {{-- AKSI SAAT PENDING --}}
                                @if ($peminjaman->status === 'pending')

                                    {{-- SETUJUI --}}
                                    <form action="{{ route('petugas.peminjaman.updateStatus', $peminjaman->id) }}"
                                          method="POST"
                                          style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="disetujui">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Setujui
                                        </button>
                                    </form>

                                    {{-- TOLAK --}}
                                    <form action="{{ route('petugas.peminjaman.updateStatus', $peminjaman->id) }}"
                                          method="POST"
                                          style="display:inline-block;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="ditolak">
                                        <button type="submit" class="btn btn-delete btn-sm">
                                            Tolak
                                        </button>
                                    </form>

                                @endif

                                {{-- PROSES PENGEMBALIAN --}}
                                @if ($peminjaman->status === 'disetujui')
                                    <a href="{{ route('petugas.pengembalian.create', $peminjaman->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Proses Pengembalian
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;">
                                Belum ada data peminjaman
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
