<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peminjaman - SIPRAS Petugas</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <style>
        /* Mencegah scroll di body utama agar tidak double scroll */
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

        /* Sidebar tetap diam di kiri */
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
            overflow-y: auto; /* Hanya bagian ini yang scroll */
            min-width: 0; 
            scroll-behavior: smooth;
        }
        
        /* Styling Table tetap sama */
        .sipras-table thead th {
            background-color: #f1f5f9;
            color: #64748b;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.1em;
            font-weight: 800;
            padding: 1.25rem 1rem;
            position: sticky; /* Header tabel juga nempel pas di-scroll */
            top: 0;
            z-index: 10;
        }
        .sipras-table tbody tr { transition: all 0.2s; border-bottom: 1px solid #f1f5f9; }
        .sipras-table tbody tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="main-wrapper">
    <div class="sidebar-wrapper">
        @include('petugas.partials.sidebar')
    </div>

    <div class="content-area">
        @include('petugas.partials.navbar')

        <main class="p-8 lg:p-12">
            
            <div class="mb-10">
                <div class="flex items-center gap-3 mb-2 text-indigo-600">
                    <span class="h-1 w-8 bg-indigo-600 rounded-full"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em]">Transaction Management</span>
                </div>
                <h1 class="text-4xl font-black text-gray-900 tracking-tighter">Data Peminjaman</h1>
                <p class="text-gray-500 font-medium mt-1">Kelola permohonan dan status peminjaman alat secara real-time.</p>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-[0_20px_50px_rgba(79,70,229,0.02)] border border-gray-100 overflow-hidden">
                <div class="p-8 overflow-x-auto">
                    <table class="w-full text-left sipras-table datatable">
                        <thead>
                            <tr>
                                <th class="w-12 text-center">No</th>
                                <th>Peminjam</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Kembali</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm font-medium text-gray-600">
                            @forelse ($peminjamans as $index => $peminjaman)
                            <tr>
                                <td class="py-5 text-center font-bold text-gray-400">{{ $index + 1 }}</td>
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center font-black text-[10px]">
                                            {{ substr($peminjaman->user->name ?? '?', 0, 2) }}
                                        </div>
                                        <span class="text-gray-900 font-bold tracking-tight">{{ $peminjaman->user->name ?? '-' }}</span>
                                    </div>
                                </td>
                                <td class="py-5 font-mono text-xs">{{ $peminjaman->tanggal_pinjam }}</td>
                                <td class="py-5 font-mono text-xs">{{ $peminjaman->tanggal_kembali }}</td>

                                <td class="py-5 text-center">
                                    @switch($peminjaman->status)
                                        @case('pending')
                                            <span class="px-3 py-1 bg-amber-50 text-amber-600 border border-amber-100 rounded-lg text-[10px] font-black uppercase tracking-widest italic">Pending</span>
                                            @break
                                        @case('disetujui')
                                            <span class="px-3 py-1 bg-indigo-50 text-indigo-600 border border-indigo-100 rounded-lg text-[10px] font-black uppercase tracking-widest italic">Dipinjam</span>
                                            @break
                                        @case('ditolak')
                                            <span class="px-3 py-1 bg-red-50 text-red-600 border border-red-100 rounded-lg text-[10px] font-black uppercase tracking-widest italic">Ditolak</span>
                                            @break
                                        @case('selesai')
                                            <span class="px-3 py-1 bg-green-50 text-green-600 border border-green-100 rounded-lg text-[10px] font-black uppercase tracking-widest italic">Selesai</span>
                                            @break
                                    @endswitch
                                </td>

                                <td class="py-5 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('petugas.peminjaman.show', $peminjaman->id) }}"
                                           class="px-4 py-2 bg-gray-50 text-gray-500 hover:bg-gray-100 rounded-xl font-bold text-[11px] transition-all uppercase tracking-tighter border border-gray-100">
                                            Detail
                                        </a>

                                        @if ($peminjaman->status === 'pending')
                                            <form action="{{ route('petugas.peminjaman.updateStatus', $peminjaman->id) }}" method="POST" class="inline-block">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="disetujui">
                                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white hover:bg-indigo-700 rounded-xl font-bold text-[11px] transition-all shadow-md shadow-indigo-100 uppercase tracking-tighter">Setujui</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-20 text-center text-gray-400 italic font-bold uppercase text-[10px] tracking-widest">Belum ada data peminjaman</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <p class="text-center text-gray-300 text-[10px] mt-12 font-bold uppercase tracking-widest leading-loose">
                SIPRAS Traffic Control &copy; 2026
            </p>
        </main>
    </div>
</div>

@include('petugas.partials.scripts')

</body>
</html>