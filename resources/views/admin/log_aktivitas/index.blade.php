<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Log Aktivitas Peminjaman</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
</head>
<body>

@include('partials.navbar')
<div class="main-wrapper">
    @include('partials.admin-sidebar')

    <div class="content">
        <div class="page-title">
            <h1>Log Aktivitas </h1>
        </div>

        <!-- ===== Filter ===== -->
        <form method="GET" class="filter-form" style="margin-bottom: 20px;">
            <select name="user_id">
                <option value="">Semua User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

          <select name="status">
    <option value="">Semua Status</option>
    <option value="Dipinjam" {{ request('status')=='Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
    <option value="Dikembalikan" {{ request('status')=='Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
</select>


            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('admin.log-aktivitas.index') }}" class="btn btn-secondary">Reset</a>
        </form>

        <!-- ===== Table ===== -->
        <div class="card" style="margin-top:20px;">
            <table id="logTable" class="table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Alat</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $log->user->name }}</td>
                        <td>
                            @if($log->peminjaman && $log->peminjaman->alats)
                                {{ $log->peminjaman->alats->pluck('nama_alat')->join(', ') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($log->tanggal_pinjam)->format('d-m-Y') }}</td>
                        <td>
                            {{ $log->tanggal_kembali ? \Carbon\Carbon::parse($log->tanggal_kembali)->format('d-m-Y') : '-' }}
                        </td>
                        <td>{{ $log->status }}</td>
                        <td>{{ $log->denda }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('partials.admin-scripts')

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#logTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "order": [[ 0, "desc" ]]
    });
});
</script>

</body>
</html>
