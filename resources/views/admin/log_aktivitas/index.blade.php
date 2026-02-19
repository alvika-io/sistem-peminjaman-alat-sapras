<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas - SIPRAS</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <style>
        /* Mencegah scroll di body utama agar sidebar tidak ikut terangkat */
        body, html { 
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
            font-family: 'Instrument Sans', sans-serif; 
            background-color: #f8fafc; 
        }

        /* Wrapper utama setinggi layar penuh */
        .main-wrapper { 
            display: flex; 
            height: 100vh; 
            width: 100%;
        }

        /* Sidebar Wrapper tetap diam di kiri */
        .sidebar-wrapper {
            height: 100vh;
            flex-shrink: 0;
            z-index: 50;
        }

        /* Area konten yang bisa di-scroll secara mandiri */
        .content-area { 
            flex: 1; 
            display: flex; 
            flex-direction: column; 
            height: 100vh; 
            overflow-y: auto; 
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        /* Custom Table Styling */
        .sipras-table thead th {
            background-color: #f1f5f9;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            font-weight: 800;
            padding: 1.25rem 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .sipras-table tbody tr { border-bottom: 1px solid #f1f5f9; transition: all 0.2s; }
        .sipras-table tbody tr:hover { background-color: #f8fafc; }

        /* Style DataTables agar menyatu dengan tema */
        .dataTables_wrapper .dataTables_filter { margin-bottom: 0px !important; }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('partials.admin-sidebar')
    </div>

    <div class="content-area">
        @include('partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2 text-blue-600">
                    <span class="h-1 w-8 bg-blue-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Monitoring System</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Log Aktivitas</h1>
                <p class="text-gray-500 font-medium mt-1">Rekam jejak seluruh transaksi peminjaman alat sapras.</p>
            </div>

            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 mb-8">
                <form method="GET" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px] space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Pilih Pengguna</label>
                        <select name="user_id" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Semua User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1 min-w-[200px] space-y-2">
                        <label class="text-[10px] font-black text-gray-400 uppercase ml-1">Status Pinjam</label>
                        <select name="status" class="w-full bg-gray-50 border border-gray-100 rounded-xl px-4 py-3 font-bold text-gray-700 outline-none focus:ring-2 focus:ring-blue-100">
                            <option value="">Semua Status</option>
                            {{-- SINKRONISASI VALUE FILTER DENGAN DATABASE --}}
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black rounded-xl shadow-lg shadow-blue-100 transition-all text-sm uppercase tracking-widest">
                            Filter
                        </button>
                        <a href="{{ route('admin.log-aktivitas.index') }}" class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-500 font-black rounded-xl transition-all text-sm uppercase tracking-widest text-center">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <table id="logTable" class="w-full text-left sipras-table">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">ID</th>
                                <th>Pengguna</th>
                                <th>Alat Sapras</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @foreach($logs as $log)
                            <tr>
                                <td class="py-5 text-center font-bold text-gray-400">{{ $log->id }}</td>
                                <td class="py-5">
                                    <div class="flex flex-col">
                                        <span class="text-gray-900 font-black tracking-tight">{{ $log->user->name }}</span>
                                        <span class="text-[10px] text-blue-600 font-bold uppercase tracking-tighter">{{ $log->user->role }}</span>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span class="text-gray-700 font-bold">
                                        @if($log->peminjaman && $log->peminjaman->alats->count() > 0)
                                            {{ $log->peminjaman->alats->pluck('nama')->implode(', ') }}
                                        @else
                                            <span class="text-gray-300 italic">-</span>
                                        @endif
                                    </span>
                                </td>
                                <td class="py-5 font-mono text-xs">{{ \Carbon\Carbon::parse($log->tanggal_pinjam)->format('d/m/Y') }}</td>
                                <td class="py-5 font-mono text-xs">
                                    {{ $log->tanggal_kembali ? \Carbon\Carbon::parse($log->tanggal_kembali)->format('d/m/Y') : '-' }}
                                </td>
                                <td class="py-5">
                                    {{-- UPGRADE BADGE STATUS DINAMIS --}}
                                    @php
                                        $statusClass = match($log->status) {
                                            'disetujui' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'ditolak'   => 'bg-red-50 text-red-600 border-red-100',
                                            'selesai'   => 'bg-gray-50 text-gray-500 border-gray-200',
                                            default     => 'bg-blue-50 text-blue-600 border-blue-100',
                                        };
                                    @endphp
                                    <span class="px-3 py-1.5 border rounded-lg text-[10px] font-black uppercase tracking-widest {{ $statusClass }}">
                                        {{ $log->status }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    <span class="font-black {{ $log->denda > 0 ? 'text-red-500' : 'text-gray-300' }}">
                                        Rp {{ number_format($log->denda, 0, ',', '.') }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest">
                SIPRAS Audit Trail System &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('partials.admin-scripts')

<script>
$(document).ready(function() {
    $('#logTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "order": [[ 0, "desc" ]], // Terbaru muncul di atas
        "language": {
            "search": "",
            "searchPlaceholder": "Cari data log...",
            "lengthMenu": "_MENU_",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data"
        }
    });
});
</script>
</body>
</html>