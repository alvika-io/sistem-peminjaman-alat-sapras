<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; font-size:12px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #000; padding:6px; }
    </style>
</head>
<body>

<h2>LAPORAN PENGEMBALIAN ALAT</h2>

<table>
<tr>
    <th>No</th>
    <th>Peminjam</th>
    <th>Tanggal</th>
    <th>Denda</th>
</tr>

@foreach($pengembalians as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->peminjaman->user->name }}</td>
    <td>{{ $item->tanggal_kembali_real }}</td>
    <td>Rp {{ number_format($item->denda,0,',','.') }}</td>
</tr>
@endforeach
</table>

<h3>Total Denda: Rp {{ number_format($totalDenda,0,',','.') }}</h3>

</body>
</html>
